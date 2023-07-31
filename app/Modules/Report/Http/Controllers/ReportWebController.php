<?php

namespace App\Modules\Report\Http\Controllers;

use App\Lib\BalanceSheet;
use App\Lib\CustomerDetailsReport;
use App\Lib\Report;
use App\Lib\sortBydate;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNoteEntry;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNoteRefund;
use App\Models\MoneyOut\VendorCredit;
use App\Models\MoneyOut\VendorCreditEntry;
use App\Models\MoneyOut\BillEntry;
use App\Modules\Report\Http\Response\GeneralLedgerResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManualJournalRequest;

use App\Models\ManualJournal\Journal;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Contact\Contact;
use App\Models\Contact\ContactCategory;
use App\Models\AccountChart\Account;
use App\Models\AccountChart\AccountType;
use App\Models\AccountChart\ParentAccountType;
use App\Models\Tax;
use Carbon\Carbon;
use DateTime;
//use Date;
use DatePeriod;
use DateInterval;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\MoneyOut\PaymentMade;
use App\Models\Branch\Branch;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\ProductPhaseItemAdd;
use App\Models\Inventory\Stock;
use App\Models\Inventory\StockTransfer;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\PaymentMode\PaymentMode;
use Auth;
use DB;
use App\Models\Bank;
use App\Models\MoneyOut\Bill;
use App\Models\Inventory\ItemSubCategory;
use App\User;
use Response;
use Redirect;

class ReportWebController extends Controller
{

    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function __construct()
    {

      $this->increasing_limit = DB::statement('SET SESSION group_concat_max_len = 100000000000');
    }

    public function index()
    { 
     return view('report::index');
    }

    public function accountTransactions()
    {
        $branch_id              = Auth::user()->branch_id;
        $this->getBranchUsers($branch_id);
        $accounts               = Account::all();

        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $end                    = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $end_time               = (new DateTime($current_time))->modify('-1 day')->format('Y-m-d');
        $OrganizationProfile    = OrganizationProfile::find(1);
        $branch                 = Branch::all();

        if ($branch_id == 1)
        {
            $JournalEntry           = JournalEntry::whereBetween('assign_date',[$start,$end])->orderBy('jurnal_type','DESC')->get()->sortBy('assign_date');

            // $JournalEntry           = $JournalEntry->whereIn('created_by', $this->targeted_users);

            $opening_debit          = JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',1)->get()->sortBy('assign_date');

            // $opening_debit          = $opening_debit->whereIn('created_by', $this->targeted_users);

            $opening_credit         = JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',0)->get()->sortBy('assign_date');

            // $opening_credit         = $opening_credit->whereIn('created_by', $this->targeted_users);

            $opening_debit          = $this->collectionAttributeSum($opening_debit);
            $opening_credit         = $this->collectionAttributeSum($opening_credit);

            $opening_balance        = $opening_debit - $opening_credit;
        }else{
            $JournalEntry           = JournalEntry::whereBetween('assign_date',[$start,$end])->orderBy('jurnal_type','DESC')->get()->sortBy('assign_date');

            $JournalEntry           = $JournalEntry->whereIn('created_by', $this->targeted_users);

            $opening_debit          = JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',1)->get()->sortBy('assign_date');

            $opening_debit          = $opening_debit->whereIn('created_by', $this->targeted_users);

            $opening_credit         = JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',0)->get()->sortBy('assign_date');

            $opening_credit         = $opening_credit->whereIn('created_by', $this->targeted_users);

            $opening_debit          = $this->collectionAttributeSum($opening_debit);
            $opening_credit         = $this->collectionAttributeSum($opening_credit);

            $opening_balance        = $opening_debit - $opening_credit;
        }

        return view('report::account_transactions',compact('JournalEntry','start','end','accounts','OrganizationProfile','opening_balance','branch','branch_id'))->with('branch_id',$this->branch_id);
    }

    public function accountTransactionsSearch(Request $request)
    {
        if ($request->branch_id != null)
        {
            $branch_id              = $request->branch_id;
        }else{
            $branch_id              = Auth::user()->branch_id;
        }

        $this->getBranchUsers($branch_id);

        $accounts                   = Account::all();
        $find_account               = Account::find($request->report_account_id);
        $start                      = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';
        $end                        = date("Y-m-d",strtotime($request->input('to_date')."+0 day")).' '.'00:00:00';
        $begin_time                 = (new DateTime($start))->modify('-999999 day')->format('Y-m-d');
        $end_time                   = date("Y-m-d",strtotime($request->input('from_date')."-1 day")).' '.'00:00:00';
        $data                       = $request->all();
        $OrganizationProfile        = OrganizationProfile::find(1);
        $branch                     = Branch::all();

        if ($branch_id == 1)
        {
            if($data['report_account_id']>0)
            {

                $JournalEntry           =  JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$request->report_account_id)->orderBy('jurnal_type','DESC')->get()->sortBy('assign_date');

                // $JournalEntry           = $JournalEntry->whereIn('created_by', $this->targeted_users);

                $opening_debit          =  JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',1)->where('account_name_id',$request->report_account_id)->get()->sortBy('assign_date');

                // $opening_debit          = $opening_debit->whereIn('created_by', $this->targeted_users);

                $opening_credit         =  JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',0)->where('account_name_id',$request->report_account_id)->get()->sortBy('assign_date');

                // $opening_credit         = $opening_credit->whereIn('created_by', $this->targeted_users);

                $opening_debit          = $this->collectionAttributeSum($opening_debit);
                $opening_credit         = $this->collectionAttributeSum($opening_credit);

                $opening_balance        = $opening_debit - $opening_credit;
            }else
            {

                $JournalEntry           =  JournalEntry::whereBetween('assign_date',[$start,$end])->orderBy('jurnal_type','DESC')->get()->sortBy('assign_date');

                // $JournalEntry           = $JournalEntry->whereIn('created_by', $this->targeted_users);


                $opening_debit          =  JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',1)->get()->sortBy('assign_date');

                // $opening_debit          = $opening_debit->whereIn('created_by', $this->targeted_users);

                $opening_credit         =  JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',0)->get()->sortBy('assign_date');

                // $opening_credit         = $opening_credit->whereIn('created_by', $this->targeted_users);

                $opening_debit          = $this->collectionAttributeSum($opening_debit);
                $opening_credit         = $this->collectionAttributeSum($opening_credit);

                $opening_balance = $opening_debit - $opening_credit;
            }

        }else
        {
            if($data['report_account_id']>0)
            {

                $JournalEntry           =  JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$request->report_account_id)->orderBy('jurnal_type','DESC')->get()->sortBy('assign_date');

                $JournalEntry           = $JournalEntry->whereIn('created_by', $this->targeted_users);

                $opening_debit          =  JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',1)->where('account_name_id',$request->report_account_id)->get()->sortBy('assign_date');

                $opening_debit          = $opening_debit->whereIn('created_by', $this->targeted_users);

                $opening_credit         =  JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',0)->where('account_name_id',$request->report_account_id)->get()->sortBy('assign_date');

                $opening_credit         = $opening_credit->whereIn('created_by', $this->targeted_users);

                $opening_debit          = $this->collectionAttributeSum($opening_debit);
                $opening_credit         = $this->collectionAttributeSum($opening_credit);

                $opening_balance        = $opening_debit - $opening_credit;
            }else
            {

                $JournalEntry           =  JournalEntry::whereBetween('assign_date',[$start,$end])->orderBy('jurnal_type','DESC')->get()->sortBy('assign_date');

                $JournalEntry           = $JournalEntry->whereIn('created_by', $this->targeted_users);


                $opening_debit          =  JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',1)->get()->sortBy('assign_date');

                $opening_debit          = $opening_debit->whereIn('created_by', $this->targeted_users);

                $opening_credit         =  JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',0)->get()->sortBy('assign_date');

                $opening_credit         = $opening_credit->whereIn('created_by', $this->targeted_users);

                $opening_debit          = $this->collectionAttributeSum($opening_debit);
                $opening_credit         = $this->collectionAttributeSum($opening_credit);

                $opening_balance = $opening_debit - $opening_credit;
            }
        }

        return view('report::account_transactions',compact('JournalEntry','start','end','accounts','OrganizationProfile','opening_balance','branch','find_account'))->with('branch_id',$branch_id);
    }

    public function accountTransactionsAccountSearch(Request $request, $id)
    {
        if ($request->branch_id != null)
        {
            $branch_id              = $request->branch_id;
        }else{
            $branch_id              = Auth::user()->branch_id;
        }

        $this->getBranchUsers($branch_id);

        $accounts                   = Account::all();
        $find_account               = Account::find($id);
        $OrganizationProfile        = OrganizationProfile::find(1);
        $branch                     = Branch::all();


        if(isset($request->start_date) && isset($request->end_date))
        {
            $start          = (new DateTime($_GET['start_date']))->modify('-0 day')->format('Y-m-d');
            $end            = (new DateTime($_GET['end_date']))->modify('+0 day')->format('Y-m-d');
            $begin_time     = (new DateTime($_GET['start_date']))->modify('-999999 day')->format('Y-m-d');
            $end_time       = (new DateTime($_GET['start_date']))->modify('-1 day')->format('Y-m-d');
        }else{
            $current_time   = Carbon::now()->toDayDateTimeString();
            $start          = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
            $end            = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
            $begin_time     = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
            $end_time       = (new DateTime($current_time))->modify('-1 day')->format('Y-m-d');
        }

        if ($branch_id == 1)
        {
           $JournalEntry           = JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$id)->orderBy('jurnal_type','DESC')->get()->sortBy('assign_date');

            // $JournalEntry           = $JournalEntry->whereIn('created_by', $this->targeted_users);

            $opening_debit          = JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',1)->where('account_name_id',$id)->get()->sortBy('assign_date');

            // $opening_debit          = $opening_debit->whereIn('created_by', $this->targeted_users);

            $opening_credit         = JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',0)->where('account_name_id',$id)->get()->sortBy('assign_date');

            // $opening_credit         = $opening_credit->whereIn('created_by', $this->targeted_users);

            $opening_debit          = $this->collectionAttributeSum($opening_debit);
            $opening_credit         = $this->collectionAttributeSum($opening_credit);

            $opening_balance        = $opening_debit - $opening_credit;
        }else{
            $JournalEntry           = JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$id)->orderBy('jurnal_type','DESC')->get()->sortBy('assign_date');

            $JournalEntry           = $JournalEntry->whereIn('created_by', $this->targeted_users);

            $opening_debit          = JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',1)->where('account_name_id',$id)->get()->sortBy('assign_date');

            $opening_debit          = $opening_debit->whereIn('created_by', $this->targeted_users);

            $opening_credit         = JournalEntry::whereBetween('assign_date',[$begin_time,$end_time])->where('debit_credit',0)->where('account_name_id',$id)->get()->sortBy('assign_date');

            $opening_credit         = $opening_credit->whereIn('created_by', $this->targeted_users);

            $opening_debit          = $this->collectionAttributeSum($opening_debit);
            $opening_credit         = $this->collectionAttributeSum($opening_credit);

            $opening_balance        = $opening_debit - $opening_credit;
        }

        return view('report::account_transactions',compact('JournalEntry','start','end','accounts','OrganizationProfile','opening_balance','branch','find_account'))->with('branch_id',$branch_id);
    }

    public function accountGeneralLedger()
    {
    
        $branch_id              = Auth::user()->branch_id;
        $this->getBranchUsers($branch_id);
        $accounts               = Account::orderby('account_name', 'ASC')->get();
        $OrganizationProfile    = OrganizationProfile::find(1);
        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                    = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $branch                 = Branch::all();
        if ($branch_id == 1)
        {
            $JournalEntry         = JournalEntry::whereBetween('assign_date',[$start,$end])->get();
            $OpeningJournalEntry  = JournalEntry::whereDate('assign_date',"<",$start)->get();

        }else{
            $JournalEntry         = JournalEntry::whereBetween('assign_date',[$start,$end])->get();
            $JournalEntry         = $JournalEntry->whereIn('created_by', $this->targeted_users);

            $OpeningJournalEntry  = JournalEntry::whereDate('assign_date',"<",$start)->get();
            $OpeningJournalEntry  = $OpeningJournalEntry->whereIn('created_by', $this->targeted_users);

        }

        //reset end to request end date
        $end                    = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');


        return view('report::Ajax.account_general_ledger',compact('JournalEntry','start','end','accounts','OrganizationProfile','OpeningJournalEntry','branch'))->with('branch_id',$this->branch_id);
    }

    public function reportSearchAjaxBranch(Request $request,$id)
    {
        $data    = ItemCategory::join('branch', 'branch.id', 'item_category.branch_id')
                                ->when($id != 1,function($query) use ($id)
                                   {
                                       return $query->where('item_category.branch_id',$id);
                                   })
                                ->selectRaw('item_category.*, branch.branch_name as branch_name')
                                ->get();

        return Response::json($data);
    }

    public function accountSalesLedgerAjaxSearch(Request $request, $id, $branch_id)
    {
        $data   = ItemSubCategory::join('users','users.id','item_sub_category.created_by')
                                    ->join('branch','branch.id','users.branch_id')
                                    ->when($id != 0,function($query) use ($id)
                                        {
                                            return $query->where('item_category_id',$id);
                                        })
                                    ->when($branch_id != 1,function($query) use ($branch_id)
                                        {
                                            return $query->where('branch.id',$branch_id);
                                        })
                                    ->selectRaw('branch.branch_name as branch_name,item_sub_category.*')
                                    ->get();

        return Response::json($data);
    }

    public function batchWiseStudent(Request $request, $id, $branch_id, $batch_id)
    {
        $data   = Invoice::join('users','users.id','invoices.created_by')
                            ->join('branch','branch.id','users.branch_id')
                            ->join('contact','contact.id','invoices.customer_id')
                            ->when($id != 0,function($query) use ($id)
                                {
                                    return $query->where('invoices.item_category_id', $id);
                                })
                            ->when($batch_id != 0,function($query) use ($batch_id)
                                {
                                    return $query->where('invoices.item_sub_category_id', $batch_id);
                                })
                            ->when($branch_id != 1,function($query) use ($branch_id)
                                {
                                    return $query->where('branch.id', $branch_id);
                                })
                            ->groupBy('invoices.customer_id')
                            ->selectRaw('invoices.customer_id as customer_id, contact.display_name as display_name, branch.branch_name as branch_name')
                            ->get();

        return Response::json($data);
    }
    // accounts Sales ledger

    public function accountSalesLedger()
    {
        $branch_id              = Auth::user()->branch_id;
        $this->getBranchUsers($branch_id);
        $OrganizationProfile    = OrganizationProfile::find(1);
        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end_time               = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $opening_end_time       = (new DateTime($current_time))->modify('-1 day')->format('Y-m-d');
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        if ($branch_id == 1)
        {
            $opening_balance    = Invoice::whereBetween('invoices.invoice_date', [$begin_time,$opening_end_time])
                                         ->selectRaw('sum(total_amount) as total_amount, sum(due_amount) as due_amount')
                                         ->get()
                                         ->toArray();

            $invoices           = Invoice::whereBetween('invoices.invoice_date', [$start,$end_time])
                                            ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                            ->join('item', 'item.id', 'invoice_entries.item_id')
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, invoices.*')
                                            ->groupBy("invoices.id")
                                            ->orderByRaw('str_to_date(invoices.invoice_date, "%d-%m-%Y"), "ASC"')
                                            ->get();
        }
        else
        {
            $opening_balance    = Invoice::whereBetween('invoices.invoice_date', [$begin_time,$opening_end_time])
                                         ->selectRaw('sum(total_amount) as total_amount, sum(due_amount) as due_amount, invoices.created_by as created_by')
                                         ->get();

            $opening_balance    = $opening_balance->whereIn('created_by', $this->targeted_users)->toArray();

            $invoices           = Invoice::whereBetween('invoices.invoice_date', [$start,$end_time])
                                            ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                            ->join('item', 'item.id', 'invoice_entries.item_id')
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, invoices.*')
                                            ->groupBy("invoices.id")
                                            ->orderByRaw('str_to_date(invoices.invoice_date, "%d-%m-%Y"), "ASC"')
                                            ->get();

            $invoices           = $invoices->whereIn('created_by', $this->targeted_users);
        }

        $branch                 = Branch::all();
        //reset end to request end date
        $end                    = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');

        return view('report::SalesLedger.account_sales_ledger', compact('opening_balance', 'start','end' ,'OrganizationProfile', 'branch', 'current_time', 'invoices'))->with('branch_id', $this->branch_id);
    }

    public function accountSalesLedgerSearch(Request $request)
    {
       if ($request->branch_id != null)
        {
            $branch_id          = $request->branch_id;
        }else{
            $branch_id          = Auth::user()->branch_id;
        }

        $this->getBranchUsers($branch_id);


        $OrganizationProfile    = OrganizationProfile::find(1);


        $start                  = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->from_date_select)) : date("Y-m-d",strtotime($request->from_date));
        $end_time               = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->to_date_select)) : date("Y-m-d",strtotime($request->to_date));

        $current_time           = Carbon::now()->toDayDateTimeString();
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $opening_end_time       = (new DateTime($start))->modify('-1 day')->format('Y-m-d');

        if ($branch_id == 1)
        {
            // dd($batch);
            $opening_balance    = Invoice::whereBetween('invoices.invoice_date', [$begin_time,$opening_end_time])
                                            ->selectRaw('sum(invoices.total_amount) as total_amount, sum(invoices.due_amount) as due_amount')
                                            ->get()
                                            ->toArray();

            $invoices           = Invoice::whereBetween('invoices.invoice_date', [$start,$end_time])
                                            ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                            ->join('item', 'item.id', 'invoice_entries.item_id')
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, invoices.*')
                                            ->groupBy("invoices.id")
                                            ->orderByRaw('str_to_date(invoices.invoice_date, "%d-%m-%Y"), "ASC"')
                                            ->get();

        }
        else
        {
            $opening_balance    = Invoice::selectRaw('sum(invoices.total_amount) as total_amount, sum(invoices.due_amount) as due_amount')
                                            ->get();

            $opening_balance    = $opening_balance->whereIn('created_by', $this->targeted_users)->toArray();


            $invoices           = Invoice::whereBetween('invoices.invoice_date', [$start,$end_time])
                                            ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                            ->join('item', 'item.id', 'invoice_entries.item_id')
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, invoices.*')
                                            ->groupBy("invoices.id")
                                            ->orderByRaw('str_to_date(invoices.invoice_date, "%d-%m-%Y"), "ASC"')
                                            ->get();

            $invoices           = $invoices->whereIn('created_by', $this->targeted_users);
        }

        $branch                 = Branch::all();
        //reset end to request end date
        $end                    = date("Y-m-d",strtotime($request->input('to_date')."-0 day"));

        return view('report::SalesLedger.account_sales_ledger', compact('opening_balance', 'start','end' ,'OrganizationProfile', 'branch', 'current_time', 'invoices'))->with('branch_id', $this->branch_id);
    }

    //Purchase Ledger

    public function accountPurchaseLedger()
    {
        $branch_id              = Auth::user()->branch_id;
        $this->getBranchUsers($branch_id);
        $OrganizationProfile    = OrganizationProfile::find(1);
        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end_time               = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $opening_end_time       = (new DateTime($current_time))->modify('-1 day')->format('Y-m-d');
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $end                    = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');

        if ($branch_id == 1)
        {
            $opening_balance    = Bill::whereBetween('bill.bill_date', [$begin_time,$opening_end_time])
                                         ->selectRaw('sum(amount) as total_amount, sum(due_amount) as due_amount')
                                         ->get()
                                         ->toArray();


            $bills              = Bill::whereBetween('bill.bill_date', [$start,$end_time])
                                            ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                            ->join('item', 'item.id', 'bill_entry.item_id')
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, bill.*')
                                            ->groupBy("bill.id")
                                            ->orderByRaw('str_to_date(bill.bill_date, "%Y-%m-%d"), "ASC"')
                                            ->get();
        }
        else
        {
            $opening_balance    = Bill::whereBetween('bill.bill_date', [$begin_time,$opening_end_time])
                                         ->selectRaw('sum(amount) as total_amount, sum(due_amount) as due_amount')
                                         ->get();

            $opening_balance    = $opening_balance->whereIn('created_by', $this->targeted_users)->toArray();

            $bills              = Bill::whereBetween('bill.bill_date',[$begin_time, $end])
                                            ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                            ->join('item', 'item.id', 'bill_entry.item_id')
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, bill.*')
                                            ->groupBy("bill.id")
                                            ->orderByRaw('str_to_date(bill.bill_date, "%Y-%m-%d"), "ASC"')
                                            ->get();

            $bills              = $bills->whereIn('created_by', $this->targeted_users);
        }

        $branch                 = Branch::all();
        //reset end to request end date

        return view('report::PurchaseLedger.account_purchase_ledger', compact('opening_balance', 'start','end' ,'OrganizationProfile', 'branch', 'current_time', 'bills'))->with('branch_id', $this->branch_id);
    }

    public function accountPurchaseLedgerSearch(Request $request)
    {
        if ($request->branch_id != null)
        {
            $branch_id          = $request->branch_id;
        }else{
            $branch_id          = Auth::user()->branch_id;
        }
        $this->getBranchUsers($branch_id);

        $OrganizationProfile    = OrganizationProfile::find(1);

        $start                  = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->from_date_select)) : date("Y-m-d",strtotime($request->from_date));
        $end_time               = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->to_date_select)) : date("Y-m-d",strtotime($request->to_date));

        $current_time           = Carbon::now()->toDayDateTimeString();
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $opening_end_time       = (new DateTime($start))->modify('-1 day')->format('Y-m-d');

        if ($branch_id == 1)
        {

            $opening_balance    = Bill::whereBetween('bill.bill_date', [$begin_time,$opening_end_time])
                                        ->selectRaw('sum(bill.amount) as total_amount, sum(bill.due_amount) as due_amount')
                                        ->get()
                                        ->toArray();


            $bills              = Bill::whereBetween('bill.bill_date', [$start,$end_time])
                                        ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                        ->join('item', 'item.id', 'bill_entry.item_id')
                                        ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, bill.*')
                                        ->groupBy("bill.id")
                                        ->orderByRaw('str_to_date(bill.bill_date, "%Y-%m-%d"), "ASC"')
                                        ->get();

        }
        else
        {

            $opening_balance    = Bill::whereBetween('bill.bill_date', [$begin_time,$opening_end_time])
                                    ->selectRaw('sum(bill.amount) as total_amount, sum(bill.due_amount) as due_amount')
                                    ->get();

            $opening_balance    = $opening_balance->whereIn('created_by', $this->targeted_users)->toArray();

            $bills              = Bill::whereBetween('bill.bill_date', [$start,$end_time])
                                    ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                    ->join('item', 'item.id', 'bill_entry.item_id')
                                    ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, bill.*')
                                    ->groupBy("bill.id")
                                    ->orderByRaw('str_to_date(bill.bill_date, "%Y-%m-%d"), "ASC"')
                                    ->get();

            $bills              = $bills->whereIn('created_by', $this->targeted_users);

        }


        $branch                 = Branch::all();
        //reset end to request end date
        $end                    = date("Y-m-d",strtotime($request->input('to_date')."-0 day"));

        return view('report::PurchaseLedger.account_purchase_ledger', compact('opening_balance', 'start','end' ,'OrganizationProfile', 'branch', 'current_time', 'bills'))->with('branch_id', $this->branch_id);
    }

    //Received Ledeger

    public function accountReceivedLedger()
    {
        $branch_id              = Auth::user()->branch_id;
        $this->getBranchUsers($branch_id);
        $OrganizationProfile    = OrganizationProfile::find(1);
        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end_time               = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        if ($branch_id == 1)
        {
            $payment_receives   = PaymentReceives::whereBetween('payment_receives.payment_date', [$start,$end_time])
                                                    ->leftjoin('payment_receives_entries', 'payment_receives_entries.payment_receives_id', 'payment_receives.id')
                                                    ->selectRaw('payment_receives.*')
                                                    ->groupBy("payment_receives.id")
                                                    ->orderByRaw('str_to_date(payment_receives.payment_date, "%Y-%m-%d"), "ASC"')
                                                    ->get();
        }
        else
        {
            $payment_receives   = PaymentReceives::whereBetween('payment_receives.payment_date', [$start,$end_time])
                                                    ->leftjoin('payment_receives_entries', 'payment_receives_entries.payment_receives_id', 'payment_receives.id')
                                                    ->selectRaw('payment_receives.*')
                                                    ->groupBy("payment_receives.id")
                                                    ->orderByRaw('str_to_date(payment_receives.payment_date, "%Y-%m-%d"), "ASC"')
                                                    ->get();

            $payment_receives   = $payment_receives->whereIn('created_by', $this->targeted_users);
        }

        $branch                 = Branch::all();
        //reset end to request end date
        $end                    = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');

        return view('report::ReceivedLedger.account_received_ledger', compact('start','end' ,'OrganizationProfile', 'branch', 'current_time', 'payment_receives'))->with('branch_id', $this->branch_id);
    }

    public function accountReceivedLedgerSearch(Request $request)
    {
        if ($request->branch_id != null)
        {
            $branch_id          = $request->branch_id;
        }else{
            $branch_id          = Auth::user()->branch_id;
        }
        $this->getBranchUsers($branch_id);

        $OrganizationProfile    = OrganizationProfile::find(1);

        $start                  = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->from_date_select)) : date("Y-m-d",strtotime($request->from_date));
        $end_time               = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->to_date_select)) : date("Y-m-d",strtotime($request->to_date));

        $current_time           = Carbon::now()->toDayDateTimeString();
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        if ($branch_id == 1)
        {
            $payment_receives   = PaymentReceives::whereBetween('payment_receives.payment_date', [$start,$end_time])
                                                ->leftjoin('payment_receives_entries', 'payment_receives_entries.payment_receives_id', 'payment_receives.id')
                                                ->join('contact', 'contact.id', 'payment_receives.customer_id')
                                                ->join('invoices', 'invoices.id', 'payment_receives_entries.invoice_id')
                                                ->selectRaw('payment_receives.*')
                                                ->groupBy("payment_receives.id")
                                                ->orderByRaw('str_to_date("payment_receives.payment_date", "%Y-%m-%d"), "ASC"')
                                                ->get();
        }
        else
        {
            $payment_receives   = PaymentReceives::whereBetween('payment_receives.payment_date', [$start,$end_time])
                                                ->leftjoin('payment_receives_entries', 'payment_receives_entries.payment_receives_id', 'payment_receives.id')
                                                ->join('contact', 'contact.id', 'payment_receives.customer_id')
                                                ->join('invoices', 'invoices.id', 'payment_receives_entries.invoice_id')
                                                ->selectRaw('payment_receives.*')
                                                ->groupBy("payment_receives.id")
                                                ->orderByRaw('str_to_date(payment_receives.payment_date, "%Y-%m-%d"), "ASC"')
                                                ->get();

            $payment_receives   = $payment_receives->whereIn('created_by', $this->targeted_users);
        }

        $branch                 = Branch::all();
        //reset end to request end date
        $end                    = date("Y-m-d",strtotime($request->input('to_date')."-0 day"));

        return view('report::ReceivedLedger.account_received_ledger', compact('start','end' ,'OrganizationProfile', 'branch', 'current_time', 'payment_receives'))->with('branch_id', $this->branch_id);
    }

    //Payment Ledger

    public function accountPaymentLedger()
    {
        $branch_id              = Auth::user()->branch_id;
        $this->getBranchUsers($branch_id);
        $OrganizationProfile    = OrganizationProfile::find(1);
        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end_time               = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        if ($branch_id == 1)
        {
            $payment_mades      = PaymentMade::whereBetween('payment_made.payment_date', [$start,$end_time])
                                                    ->leftjoin('payment_made_entry', 'payment_made_entry.payment_made_id', 'payment_made.id')
                                                    ->selectRaw('payment_made.*')
                                                    ->groupBy("payment_made.id")
                                                    ->orderByRaw('payment_made.payment_date', 'ASC')
                                                    ->get();
        }
        else
        {
            $payment_mades      = PaymentMade::whereBetween('payment_made.payment_date', [$start,$end_time])
                                                    ->leftjoin('payment_made_entry', 'payment_made_entry.payment_made_id', 'payment_made.id')
                                                    ->selectRaw('payment_made.*')
                                                    ->groupBy("payment_made.id")
                                                    ->orderByRaw('payment_made.payment_date', 'ASC')
                                                    ->get();

            $payment_mades      = $payment_mades->whereIn('created_by', $this->targeted_users);
        }

        $branch                 = Branch::all();
        //reset end to request end date
        $end                    = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');

        return view('report::PaymentLedger.account_payment_ledger', compact('start','end' ,'OrganizationProfile', 'branch', 'current_time', 'payment_mades'))->with('branch_id', $this->branch_id);
    }

    public function accountPaymentLedgerSearch(Request $request)
    {


        if ($request->branch_id != null)
        {
            $branch_id          = $request->branch_id;
        }else{
            $branch_id          = Auth::user()->branch_id;
        }
        $this->getBranchUsers($branch_id);

        $OrganizationProfile    = OrganizationProfile::find(1);

        $start                  = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->from_date_select)) : date("Y-m-d",strtotime($request->from_date));
        $end_time               = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->to_date_select)) : date("Y-m-d",strtotime($request->to_date));

        $current_time           = Carbon::now()->toDayDateTimeString();
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        if ($branch_id == 1)
        {
            $payment_mades      = PaymentMade::whereBetween('payment_made.payment_date', [$start,$end_time])
                                            ->leftjoin('payment_made_entry', 'payment_made_entry.payment_made_id', 'payment_made.id')
                                            ->leftjoin('bill', 'bill.id', 'payment_made_entry.bill_id')
                                            ->selectRaw('GROUP_CONCAT(bill.bill_number) as bill_number, payment_made.*')
                                            ->groupBy("payment_made.id")
                                            ->orderByRaw('str_to_date(payment_made.payment_date, "%d-%m-%Y"), "ASC"')
                                            ->get();
        }
        else
        {
            $payment_mades      = PaymentMade::whereBetween('payment_made.payment_date', [$start,$end_time])
                                            ->leftjoin('payment_made_entry', 'payment_made_entry.payment_made_id', 'payment_made.id')
                                            ->leftjoin('bill', 'bill.id', 'payment_made_entry.bill_id')
                                            ->selectRaw('GROUP_CONCAT(bill.bill_number) as bill_number, payment_made.*')
                                            ->groupBy("payment_made.id")
                                            ->orderByRaw('str_to_date(payment_made.payment_date, "%d-%m-%Y"), "ASC"')
                                            ->get();

            $payment_mades      = $payment_mades->whereIn('created_by', $this->targeted_users);
        }


        $branch                 = Branch::all();
        //reset end to request end date
        $end                    = date("Y-m-d",strtotime($request->input('to_date')."-0 day"));

        return view('report::PaymentLedger.account_payment_ledger', compact('start','end' ,'OrganizationProfile', 'branch', 'current_time', 'payment_mades'))->with('branch_id', $this->branch_id);
    }

    public function accountGeneralLedgerSearch(Request $request)
    {
        if ($request->branch_id != null)
        {
            $branch_id          = $request->branch_id;
        }else{
            $branch_id          = Auth::user()->branch_id;
        }

        $OrganizationProfile    = OrganizationProfile::find(1);
        $accounts               = Account::orderby('account_name', 'ASC')->get();
        $start                  = date("Y-m-d",strtotime($request->input('from_date')));
        $end                    = date("Y-m-d",strtotime($request->input('to_date')."+0 day"));
        $current_time           = Carbon::now()->toDayDateTimeString();
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $branch                 = Branch::all();

        if ($branch_id == 1)
        {
            $JournalEntry         = JournalEntry::whereBetween('assign_date',[$start,$end])->get();
            $OpeningJournalEntry  = JournalEntry::whereDate('assign_date',"<",$start)->get();

        }else{
            $JournalEntry         = JournalEntry::whereBetween('assign_date',[$start,$end])->get();
            $JournalEntry         = $JournalEntry->whereIn('created_by', $this->targeted_users);

            $OpeningJournalEntry  = JournalEntry::whereDate('assign_date',"<",$start)->get();
            $OpeningJournalEntry  = $OpeningJournalEntry->whereIn('created_by', $this->targeted_users);

        }


        //reset end to request end date
        $end = date("Y-m-d",strtotime($request->input('to_date')."+0 day"));

        return view('report::Ajax.account_general_ledger',compact('JournalEntry','start','end','accounts','OrganizationProfile','OpeningJournalEntry','branch'))->with('branch_id',$branch_id);
    }

    public function accountJournal()
    {
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        $JournalEntry=$this->checkBranch($JournalEntry);
        $journal = [];
        $k = 0;
        foreach ($JournalEntry  as $JournalEntryData)
        {

                if($JournalEntryData->jurnal_type == 'invoice') {

                    $i = 0;
                    foreach ($journal as $journalData) {
                        if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->invoice_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->invoice_id,
                        ];
                    }


                }elseif($JournalEntryData->jurnal_type == "payment_receive2" || $JournalEntryData->jurnal_type == "payment_receive1")
                {

                    $i = 0;
                    foreach ($journal as $journalData) {

                        if ($journalData['journal_id'] == $JournalEntryData->payment_receives_id) {
                          $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->payment_receives_id,
                        ];
                    }
                }elseif($JournalEntryData->jurnal_type == "bill")
                {
                    $i = 0;
                    foreach ($journal as $journalData) {
                        if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->bill_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->bill_id,
                        ];
                    }
                }elseif($JournalEntryData->jurnal_type == "11" || $JournalEntryData->jurnal_type == "12")
                {
                    $i = 0;
                    foreach ($journal as $journalData) {
                        if ($journalData['journal_id'] == $JournalEntryData->credit_note_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->credit_note_id,
                        ];
                    }
                }elseif($JournalEntryData->jurnal_type == "journal")
                {

                    $i = 0;
                    foreach ($journal as $journalData) {

                        if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->journal_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->journal_id,
                        ];
                    }

                }elseif($JournalEntryData->jurnal_type == "bank")
                {

                    $i = 0;
                    foreach ($journal as $journalData) {

                        if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->bank_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->bank_id,
                        ];
                    }

                }

        }
        $branch=Branch::all();
        return view('report::account_journal',compact('JournalEntry','start','end','OrganizationProfile','journal','branch'))->with('branch_id',$this->branch_id);
    }

    public function accountJournalSearch(Request $request)
    {
        if($request->branch_id ){
            $this->branch_id =  $request->branch_id;
        }
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $end = date("Y-m-d",strtotime($request->input('to_date')."+0 day"));
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        $JournalEntry=$this->checkBranch($JournalEntry);
        $journal = [];
        $k = 0;
        foreach ($JournalEntry  as $JournalEntryData)
        {

            if($JournalEntryData->jurnal_type == 'invoice') {

                $i = 0;
                foreach ($journal as $journalData) {
                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->invoice_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->invoice_id,
                    ];
                }


            }elseif($JournalEntryData->jurnal_type == "payment_receive2" || $JournalEntryData->jurnal_type == "payment_receive1")
            {

                $i = 0;
                foreach ($journal as $journalData) {

                    if ($journalData['journal_id'] == $JournalEntryData->	payment_receives_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->	payment_receives_id,
                    ];
                }
            }
            elseif($JournalEntryData->jurnal_type == "bill")
            {
                $i = 0;
                foreach ($journal as $journalData) {
                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->bill_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->bill_id,
                    ];
                }
            }
            elseif($JournalEntryData->jurnal_type == "11" || $JournalEntryData->jurnal_type == "12")
            {
                $i = 0;
                foreach ($journal as $journalData) {
                    if ($journalData['journal_id'] == $JournalEntryData->credit_note_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->credit_note_id,
                    ];
                }
            }
            elseif($JournalEntryData->jurnal_type == "journal")
            {

                $i = 0;
                foreach ($journal as $journalData) {

                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->journal_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->journal_id,
                    ];
                }

            }
            elseif($JournalEntryData->jurnal_type == "payment_made")
            {

                $i = 0;
                foreach ($journal as $journalData) {

                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->payment_made_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->payment_made_id,
                    ];
                }

            }
            elseif($JournalEntryData->jurnal_type == "expense")
            {

                $i = 0;
                foreach ($journal as $journalData) {

                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->expense_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->expense_id,
                    ];
                }

            }

        }
        $branch=Branch::all();
        return view('report::account_journal',compact('JournalEntry','start','end','Journal','OrganizationProfile','journal','branch'))->with('branch_id',$this->branch_id);
    }

    public function accountTrialBalance()
    {

        $account = Account::all();
        $accountType = AccountType::all();
        $parentAccountType = ParentAccountType::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        $branch=Branch::all();
        $JournalEntry=$this->checkBranch($JournalEntry);
        return view('report::account_trial_balance',compact('JournalEntry','start','end','OrganizationProfile','account','accountType','parentAccountType','branch'))->with('branch_id',$this->branch_id);
    }

    public function accountTrialBalanceSearch(Request $request)
    {
        if($request->branch_id ){
            $this->branch_id =  $request->branch_id;
        }
        $OrganizationProfile = OrganizationProfile::find(1);
        $account = Account::all();
        $accountType = AccountType::all();
        $parentAccountType = ParentAccountType::all();
        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $end = date("Y-m-d",strtotime($request->input('to_date')."+0 day"));
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        $JournalEntry=$this->checkBranch($JournalEntry);
        $branch=Branch::all();
        return view('report::account_trial_balance',compact('JournalEntry','start','end','OrganizationProfile','account','accountType','parentAccountType','branch'))->with('branch_id',$this->branch_id);
    }

    public function ProfitAndLoss()
    {
        $branch_id                  = Auth::user()->branch_id;
        $accounts                   = Account::all();
        $OrganizationProfile        = OrganizationProfile::find(1);
        $current_time               = Carbon::now()->toDayDateTimeString();
        $start                      = date('d-M-Y',strtotime(date('Y-01-01')));
        $end                        = date('d-M-Y',strtotime(date('Y-12-31')));
        $branch                     = Branch::all();

        $operatingincome            = Account::where('account_type_id',15)->get();
        $costofgoods                = Account::where('account_type_id',18)->get();

        $operatingExpense           = Account::where('account_type_id',17)->get();
        $nonoperatingix             = Account::whereIn('account_type_id',array(16,19))->get();
        $branch_name                = Branch::where('id', $branch_id)->first();
        
        //get opening stock and closing stock value
            
        //Opening Stock Calculation
        $start_date                 = date('Y-m-d',strtotime(date('Y-01-01')));
        // $total_open_stock_val       = $this->stockValueCalculation($start_date, $branch_id);
        $total_open_stock_val       = 0;
        //Opening Stock Calculation Ends
        
        //Closing Stock Calculation
        $end_date                   = date('Y-m-d', strtotime(date('Y-12-31') . '+1 day'));
        $total_close_stock_val      = $this->stockValueCalculation($end_date, $branch_id);
        //Closing Stock Calculation Ends
         
        //get opening stock and closing stock value ends

        return view('report::profitloss.profit_loss',compact('start','end','accounts','OrganizationProfile','operatingincome','costofgoods','operatingExpense',
        'nonoperatingix', 'branch','branch_name', 'total_close_stock_val', 'total_open_stock_val'))->with('branch_id',$branch_id);
    }
    
    public function stockValueCalculation($date, $branch_id){
        
        $total_stock_val        = 0;
        $branch_id              = $branch_id > 0 ? $branch_id : Auth::user()->branch_id;
        $this->getBranchUsers($branch_id);
        
        $items                  = Item::all();
        $date                   = date('Y-m-d',strtotime($date));
        
        $total_sales            = Invoice::where('invoices.invoice_date', '<', $date)
                                            ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                            ->selectRaw('invoice_entries.*, invoices.created_by as created_by')
                                            ->get();

        $total_purchase         = Bill::where('bill.bill_date', '<', $date)
                                            ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                            ->selectRaw('bill_entry.*, bill.created_by as created_by')
                                            ->get(); 

        $total_sales_ret        = CreditNote::where('credit_notes.credit_note_date', '<', $date)
                                            ->join('credit_note_entries', 'credit_note_entries.credit_note_id', 'credit_notes.id')
                                            ->selectRaw('credit_note_entries.*, credit_notes.created_by as created_by')
                                            ->get();

        $total_purchase_ret     = VendorCredit::where('vendor_credit.vendor_credit_date', '<', $date)
                                            ->join('vendor_credit_entry', 'vendor_credit_entry.vendor_credit_id', 'vendor_credit.id')
                                            ->selectRaw('vendor_credit_entry.*, vendor_credit.created_by as created_by')
                                            ->get();
                                            
        if($branch_id != 1){

            $total_sales           = $total_sales->whereIn('created_by', $this->targeted_users);
            $total_purchase        = $total_purchase->whereIn('created_by', $this->targeted_users);
            $total_sales_ret       = $total_sales_ret->whereIn('created_by', $this->targeted_users);
            $total_purchase_ret    = $total_purchase_ret->whereIn('created_by', $this->targeted_users);

        }
        
        foreach ($items as $key => $item)
        {
            $last_purchase_rate     = BillEntry::where('item_id', $item->id)->orderBy('id', 'DESC')->first();

            if($last_purchase_rate){
                $last_purchase_rate = $last_purchase_rate['rate'];
            }else{
                $last_purchase_rate = 0;                
            }

            $item->item_purchase_rate   = $item->item_purchase_rate > 0 ? $item->item_purchase_rate : $last_purchase_rate;
            
            $total_stock_val            += ($total_purchase->where('item_id', $item->id)->sum('quantity') - $total_purchase_ret->where('item_id', $item->id)->sum('quantity')
                                            - ($total_sales->where('item_id', $item->id)->sum('quantity') - $total_sales_ret->where('item_id', $item->id)->sum('quantity')))
                                            * $item->item_purchase_rate;
                                                    
            $test[$item->item_name]     = ($total_purchase->where('item_id', $item->id)->sum('quantity') - $total_purchase_ret->where('item_id', $item->id)->sum('quantity')
                                            - ($total_sales->where('item_id', $item->id)->sum('quantity') - $total_sales_ret->where('item_id', $item->id)->sum('quantity')))
                                            * $item->item_purchase_rate;
        }
        
        return $total_stock_val;
        
    }

    public function ProfitAndLossbyfilter(Request $request)
    {
        if ($request->branch_id)
        {
            $branch_id = $request->branch_id;
        }else{
            $branch_id = Auth::user()->branch_id;
        }

        $accounts                   = Account::all();
        $OrganizationProfile        = OrganizationProfile::find(1);
        $current_time               = Carbon::now()->toDayDateTimeString();
        
        $start                      = $request->from_date?$request->from_date:date('d-M-Y',strtotime(date('Y-01-01')));
        $end                        = $request->to_date?$request->to_date:$start;
        
        $start_date                 = date("Y-m-d", strtotime($start));
        $end_date                   = date("Y-m-d", strtotime($end));
        
        $start                      = date('d-M-Y',strtotime($start));
        $end                        = date('d-M-Y',strtotime($end));
        $branch                     = Branch::all();

        $operatingincome            = Account::where('account_type_id',15)->get();
        $costofgoods                = Account::where('account_type_id',18)->get();
        $operatingExpense           = Account::where('account_type_id',17)->get();
        $nonoperatingix             = Account::whereIn('account_type_id',array(16,19))->get();
        $branch_name                = Branch::where('id', $branch_id)->first();
            
        //Opening Stock Calculation
        // $total_open_stock_val       = $this->stockValueCalculation($start_date, $branch_id);
        $total_open_stock_val       = 0;
        //Opening Stock Calculation Ends
        
        //Closing Stock Calculation
        $end_date                   = date("Y-m-d", strtotime($end . '+1 day'));
        $total_close_stock_val      = $this->stockValueCalculation($end_date, $branch_id);
        //Closing Stock Calculation Ends

        return view('report::profitloss.profit_loss',compact('start','end','accounts','OrganizationProfile','operatingincome','costofgoods','operatingExpense',
        'nonoperatingix', 'branch','branch_name', 'total_close_stock_val', 'total_open_stock_val'))->with('branch_id',$branch_id);
    }

    public function BalanceAndSheet()
    {
        $branch_id                  = Auth::user()->branch_id;
        $this->getBranchUsers($branch_id);

        $accounts                       = Account::all();
        $OrganizationProfile            = OrganizationProfile::find(1);
        $current_time                   = Carbon::now()->toDayDateTimeString();
        $start                          = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $end                            = date('Y-m-d');

        $BalanceSheet                   =new BalanceSheet();
        $BalanceSheet->setDate($start,$end);

        //retained earnings calculation
        $end                            = date('Y-m-d',strtotime(date("Y-12-31") . '-1 year')); //modified at 22 january 2018
        $retainedEarnings               = new Report();
        $retainedEarnings->definedate($start,$end);
        $TotalretainedEarnings          = $retainedEarnings->netprofit($branch_id);

        //current year net profit calculation
        $start                          = date('Y-m-d',strtotime(date('Y-01-01')));
        $end                            = date('Y-m-d');
        $netprofit                      = new Report();
        $netprofit->definedate($start,$end);
        $Totalnetprofit                 = $netprofit->netprofit($branch_id);

        //assets calculation
        $current_asset                  = $BalanceSheet->current_asset($branch_id);
        $cash                           = $BalanceSheet->cash($branch_id);
        $others_asset                   = $BalanceSheet->others_asset($branch_id);
        $others_current_asset           = $BalanceSheet->others_current_asset($branch_id);
        $bank                           = $BalanceSheet->bank($branch_id);
        $stock                          = $BalanceSheet->stock($branch_id);
        $FixedAsset                     = $BalanceSheet->FixedAsset($branch_id);

        //liability calculation
        $currentLibilities              = $BalanceSheet->currentLibilities($branch_id);
        $longTermLibilities             = $BalanceSheet->longTermLibilities($branch_id);

        //equity calculation; let not the function name fool you
        $currentYearEarning             = $BalanceSheet->currentYearEarning($branch_id);
        
        //get opening stock and closing stock value
            
        //Opening Stock Calculation
        $start_date                 = date('Y-m-d', strtotime(date('Y-01-01')));
        // $total_open_stock_val       = $this->stockValueCalculation($start_date, $branch_id);
        $total_open_stock_val       = 0;
        //Opening Stock Calculation Ends
        
        //Closing Stock Calculation
        $end_date                   = date('Y-m-d');
        $end_date                   = date("Y-m-d", strtotime($end_date . '+1 day'));
        $total_close_stock_val      = $this->stockValueCalculation($end_date, $branch_id);
        //Closing Stock Calculation Ends
         
        //get opening stock and closing stock value ends

        $start                          = date('d-M-Y',strtotime(date('Y-01-01')));
        $end                            = date('d-M-Y');
        $branch                         = Branch::all();
        $branch_name                    = Branch::where('id', $branch_id)->first();
        $retain_open_stock_val          = 0;
        $retain_close_stock_val         = 0;
        
        return view('report::BalanceSheet.index',compact('currentYearEarning','longTermLibilities','currentLibilities','FixedAsset','stock','bank',
        'others_current_asset' ,'others_asset','cash','current_asset','start','end','accounts','OrganizationProfile','Totalnetprofit',
        'TotalretainedEarnings', 'branch','branch_name', 'total_open_stock_val', 'total_close_stock_val', 
        'retain_open_stock_val', 'retain_close_stock_val'))->with('branch_id',$branch_id);
    }

    public function BalanceAndSheetbyfilter(Request $request)
    {
        if($request->branch_id != null)
        {
           $branch_id                   = $request->branch_id;
        }else
        {
            $branch_id                  = Auth::user()->branch_id;
        }

        $this->getBranchUsers($branch_id);

        $end                            = $request->to_date;
        $year                           = date('Y',strtotime($end));
        $accounts                       = Account::all();
        $OrganizationProfile            = OrganizationProfile::find(1);
        $current_time                   = Carbon::now()->toDayDateTimeString();
        $start                          = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        $BalanceSheet                   = new BalanceSheet();
        $BalanceSheet->setDate($start,$end);

        //retained earnings calculation
        $end                            = date('Y-m-d',strtotime(date("Y-12-31") . '-1 year')); //modified at 22 january 2018
        $retainedEarnings               = new Report();
        $retainedEarnings->definedate($start,$end);
        $TotalretainedEarnings          = $retainedEarnings->netprofit($branch_id);
        
        //Opening Stock Calculation for retained earning
        $start_date                 = date('Y-m-d', strtotime($start));
        // $retain_open_stock_val       = $this->stockValueCalculation($start_date, $branch_id);
        $retain_open_stock_val       = 0;
        //Opening Stock Calculation for retained earning Ends
        
        //Closing Stock Calculation for retained earning
        $end_date                   = date("Y-m-d", strtotime($end . '+1 day'));
        $retain_close_stock_val      = $this->stockValueCalculation($end_date, $branch_id);
        //Closing Stock Calculation for retained earning Ends

        //current year net profit calculation
        $start                          = date('Y-m-d',strtotime(date('Y-01-01')));
        $end                            = date('Y-m-d');
        $netprofit                      = new Report();
        $netprofit->definedate($start,$end);
        $Totalnetprofit                 = $netprofit->netprofit($branch_id);

        //assets calculation
        $current_asset                  = $BalanceSheet->current_asset($branch_id);
        $cash                           = $BalanceSheet->cash($branch_id);
        $others_asset                   = $BalanceSheet->others_asset($branch_id);
        $others_current_asset           = $BalanceSheet->others_current_asset($branch_id);
        $bank                           = $BalanceSheet->bank($branch_id);
        $stock                          = $BalanceSheet->stock($branch_id);
        $FixedAsset                     = $BalanceSheet->FixedAsset($branch_id);

        //liability calculation
        $currentLibilities              = $BalanceSheet->currentLibilities($branch_id);
        $longTermLibilities             = $BalanceSheet->longTermLibilities($branch_id);

        //equity calculation; let not the function name fool you
        $currentYearEarning             = $BalanceSheet->currentYearEarning($branch_id);
        
        //Opening Stock Calculation
        $start_date                 = $year . "-01-01";
        $start_date                 = date('Y-m-d', strtotime($start_date));
        // $total_open_stock_val       = $this->stockValueCalculation($start_date, $branch_id);
        $total_open_stock_val       = 0;
        //Opening Stock Calculation Ends
        
        //Closing Stock Calculation
        $end_date                   = date("Y-m-d", strtotime($request->to_date . '+1 day'));
        $total_close_stock_val      = $this->stockValueCalculation($end_date, $branch_id);
        //Closing Stock Calculation Ends

        $start                          = date('d-M-Y',strtotime(date('Y-01-01')));
        $end                            = date('d-M-Y');
        $branch                         = Branch::all();
        $branch_name                    = Branch::where('id', $branch_id)->first();
        
        return view('report::BalanceSheet.index',compact('currentYearEarning','longTermLibilities','currentLibilities','FixedAsset','stock','bank',
        'others_current_asset' ,'others_asset','cash','current_asset','start','end','accounts','OrganizationProfile','Totalnetprofit',
        'TotalretainedEarnings', 'branch','branch_name', 'total_open_stock_val', 'total_close_stock_val', 
        'retain_open_stock_val', 'retain_close_stock_val'))->with('branch_id',$branch_id);
    }

    public function CashFlowStatement()
    {
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-14 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        return view('report::cash_flow_statement',compact('JournalEntry','start','end','accounts','OrganizationProfile'))->with('branch_id',$this->branch_id);
    }

    public function BalanceSheet()
    {
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-14 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        // foreach ($JournalEntry as $key ) {

        //     return $JournalEntry->AccountType->id;

        // }
        return view('report::balance_sheet',compact('JournalEntry','start','end','accounts','OrganizationProfile'))->with('branch_id',$this->branch_id);
    }

    public function customer()
    {
        $customerReport = [];
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->format('Y-m-d');
        $refund_start = (new DateTime($current_time))->modify('-30 day')->format('d-m-Y');
        $refund_end = (new DateTime($current_time))->modify('+0 day')->format('d-m-Y');
        $invoice_start = (new DateTime($current_time))->modify('-30 day')->format('d-m-Y');
        $invoice_end = (new DateTime($current_time))->modify('+0 day')->format('d-m-Y');
        $contacts = Contact::all();
        $condition = "str_to_date(invoice_date, '%d-%m-%Y') <= '$end'";
        $condition_refund = "str_to_date(credit_note_refunds.date, '%d-%m-%Y') <= '$end'";
        $condition_payment = "str_to_date(payment_date, '%Y-%m-%d') <= '$end'";

         foreach ($contacts as $contact)
         {

               $invoice =  Invoice::select('customer_id',DB::raw('SUM(due_amount) as due_amount'),DB::raw('count(*) as total'),DB::raw('SUM(total_amount) as total_sales'))->whereRaw($condition)->where('customer_id',$contact->id)->first();
               $credit_note_amount = CreditNote::where('credit_note_date',">=",$start)->where('credit_note_date',"<=",$end)->where('customer_id',$contact->id)->sum('total_credit_note');
               $credit_refund= CreditNote::join('credit_note_refunds','credit_note_refunds.credit_note_id','=','credit_notes.id')->whereRaw($condition_refund)->where('credit_notes.customer_id',$contact->id)->select('credit_note_refunds.*')->sum('amount');
               $credit_note_payment= CreditNote::join('credit_note_payments','credit_note_payments.credit_note_id','=','credit_notes.id')->where('credit_notes.customer_id',$contact->id)->where('credit_note_payments.created_at',"<=",$end)->select('credit_note_payments.*')->sum('amount');
               $paymentreceives =  PaymentReceives::select('customer_id', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_receives'),DB::raw('SUM(excess_payment) as total_excess_payment'))->whereRaw($condition_payment)->where('customer_id',$contact->id)->first();
               if(!empty($paymentreceives->total_excess_payment)||!empty($paymentreceives->total_receives)||!empty($paymentreceives->total)||!empty($invoice->due_amount)||!empty($invoice->total)|| !empty($credit_note_amount)||!empty($credit_refund)||!empty($credit_note_payment))
               {
                   $customerReport[] =[
                       'customer_id'          => $contact->id,
                       'display_name'         => $contact->display_name,
                       'invoices'             => $invoice->total,
                       'total_sales'          => $invoice->total_sales,
                       'total_cr_amount'      => $credit_note_amount,
                       'total_refund'      =>    $credit_refund,
                       'paymentreceives'      => $paymentreceives->total_receives,
                       'total_receives'       => ($paymentreceives->total_receives-$paymentreceives->total_excess_payment)+$credit_note_payment,
                       'total_excess_payment' => $paymentreceives->total_excess_payment,
                       'due'                  => $invoice->due_amount,
                   ];
               }
           }
           $ContactCategory=ContactCategory::all();
          return view('report::customer',compact('customerReport','start','end','accounts','OrganizationProfile','ContactCategory'));
    }

    public function customerCategory($id)
    {
        $customerReport = [];
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $refund_start = (new DateTime($current_time))->modify('-30 day')->format('d-m-Y');
        $refund_end = (new DateTime($current_time))->modify('+0 day')->format('d-m-Y');
        $invoice_start = (new DateTime($current_time))->modify('-30 day')->format('d.m.Y');
        $invoice_end = (new DateTime($current_time))->modify('+0 day')->format('d.m.Y');
        $contacts = Contact::where('contact_category_id',$id)->get();


         foreach ($contacts as $contact)
         {

               $invoice =  Invoice::select('customer_id',DB::raw('SUM(due_amount) as due_amount'),DB::raw('count(*) as total'),DB::raw('SUM(total_amount) as total_sales'))->where('invoice_date',"<=",$invoice_end)->where('customer_id',$contact->id)->first();
               $credit_note_amount = CreditNote::where('credit_note_date',"<=",$end)->where('customer_id',$contact->id)->sum('total_credit_note');
               $credit_refund= CreditNote::join('credit_note_refunds','credit_note_refunds.credit_note_id','=','credit_notes.id')->where('credit_note_refunds.date',"<=",$refund_end)->where('credit_notes.customer_id',$contact->id)->select('credit_note_refunds.*')->sum('amount');
               $credit_note_payment= CreditNote::join('credit_note_payments','credit_note_payments.credit_note_id','=','credit_notes.id')->where('credit_notes.customer_id',$contact->id)->where('credit_note_payments.created_at',"<=",$end)->select('credit_note_payments.*')->sum('amount');
               $paymentreceives =  PaymentReceives::select('customer_id', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_receives'),DB::raw('SUM(excess_payment) as total_excess_payment'))->where('payment_date',"<=",$end)->where('customer_id',$contact->id)->first();
               if(!empty($paymentreceives->total_excess_payment)||!empty($paymentreceives->total_receives)||!empty($paymentreceives->total)||!empty($invoice->due_amount)||!empty($invoice->total)|| !empty($credit_note_amount)||!empty($credit_refund)||!empty($credit_note_payment))
               {
                   $customerReport[] =[
                       'customer_id'          => $contact->id,
                       'display_name'         => $contact->display_name,
                       'invoices'             => $invoice->total,
                       'total_sales'          => $invoice->total_sales,
                       'total_cr_amount'      => $credit_note_amount,
                       'total_refund'      =>    $credit_refund,
                       'paymentreceives'      => $paymentreceives->total_receives,
                       'total_receives'       => ($paymentreceives->total_receives-$paymentreceives->total_excess_payment)+$credit_note_payment,
                       'total_excess_payment' => $paymentreceives->total_excess_payment,
                       'due'                  => $invoice->due_amount,
                   ];
               }
           }

           $ContactCategory=ContactCategory::all();

          return view('report::customer',compact('customerReport','start','end','accounts','OrganizationProfile','ContactCategory','id'));
    }

    public function customerSearch(Request $request)
    {
        $customerReport = [];
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';
        $end = date("Y-m-d",strtotime($request->input('to_date'))).' '.'23:59:59';
        $refund_start = date("d-m-Y",strtotime($request->input('from_date')));
        $refund_end = date("d-m-Y",strtotime($request->input('from_date')));
        $invoice_start = date("d.m-Y",strtotime($request->input('from_date')));
        $invoice_end = date("d-m-Y",strtotime($request->input('to_date')."+0 day"));
        $condition = "str_to_date(invoice_date, '%d-%m-%Y') <= '$end'";
        $condition_refund = "str_to_date(credit_note_refunds.date, '%d-%m-%Y') <= '$end'";
        $condition_payment = "str_to_date(payment_date, '%Y-%m-%d') <= '$end'";
        if ($request->input('id')) {
            $contacts = Contact::where('contact_category_id',$request->input('id'))->get();
            $id=$request->input('id');
        }
        else{

            $contacts = Contact::all();
            $id='';
        }
        foreach ($contacts as $contact)
        {
            $invoice =  Invoice::select('customer_id',DB::raw('SUM(due_amount) as due_amount'),DB::raw('count(*) as total'),DB::raw('SUM(total_amount) as total_sales'))->whereRaw($condition)->where('customer_id',$contact->id)->first();
            $credit_note_amount = CreditNote::orderBy('id','asc')->where('credit_note_date',"<=",$end)->where('customer_id',$contact->id)->sum('total_credit_note');
            $credit_refund= CreditNote::join('credit_note_refunds','credit_note_refunds.credit_note_id','=','credit_notes.id')->whereRaw($condition_refund)->where('credit_notes.customer_id',$contact->id)->select('credit_note_refunds.*')->sum('amount');
            $credit_note_payment= CreditNote::join('credit_note_payments','credit_note_payments.credit_note_id','=','credit_notes.id')->where('credit_notes.customer_id',$contact->id)->where('credit_note_payments.created_at',"<=",$end)->select('credit_note_payments.*')->sum('amount');

            $paymentreceives =  PaymentReceives::select('customer_id', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_receives'),DB::raw('SUM(excess_payment) as total_excess_payment'))->whereRaw($condition_payment)->where('customer_id',$contact->id)->first();
            if(!empty($paymentreceives->total_excess_payment)||!empty($paymentreceives->total_receives)||!empty($paymentreceives->total)||!empty($invoice->due_amount)||!empty($invoice->total)|| !empty($credit_note_amount)||!empty($credit_refund)||!empty($credit_note_payment))
            {
                $customerReport[] =[
                    'customer_id'          => $contact->id,
                    'display_name'         => $contact->display_name,
                    'invoices'             => $invoice->total,
                    'total_sales'          => $invoice->total_sales,
                    'total_cr_amount'      => $credit_note_amount,
                    'total_refund'      =>    $credit_refund,
                    'paymentreceives'      => $paymentreceives->total_receives,
                    'total_receives'       => ($paymentreceives->total_receives-$paymentreceives->total_excess_payment)+$credit_note_payment,
                    'total_excess_payment' => $paymentreceives->total_excess_payment,
                    'due'                  => $invoice->due_amount,
                ];
            }
        }
        $ContactCategory=ContactCategory::all();
        $date=1;
        return view('report::customer',compact('customerReport','start','end','accounts','OrganizationProfile','ContactCategory','date','id'));
    }

    public function customerCategoryDate($start,$end,$id)
    {
        $customerReport = [];
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = date("Y-m-d",strtotime($start)).' '.'00:00:00';
        $end = date("Y-m-d",strtotime($end)).' '.'23:59:59';


        // return $start.'-----------'.$end;
        $refund_start = date("d-m-Y",strtotime($start));
        $refund_end = date("d-m-Y",strtotime($end));
        $invoice_start = date("d.m-Y",strtotime($start));
        $invoice_end = date("d-m-Y",strtotime($end));
        $contacts = Contact::where('contact_category_id',$id)->get();
        foreach ($contacts as $contact)
        {
            $invoice =  Invoice::select('customer_id',DB::raw('SUM(due_amount) as due_amount'),DB::raw('count(*) as total'),DB::raw('SUM(total_amount) as total_sales'))->where('invoice_date',"<=",$invoice_end)->where('customer_id',$contact->id)->first();
            $credit_note_amount = CreditNote::where('credit_note_date',"<=",$end)->where('customer_id',$contact->id)->sum('total_credit_note');
            $credit_refund= CreditNote::join('credit_note_refunds','credit_note_refunds.credit_note_id','=','credit_notes.id')->where('credit_note_refunds.date',"<=",$refund_end)->where('credit_notes.customer_id',$contact->id)->select('credit_note_refunds.*')->sum('amount');
            $credit_note_payment= CreditNote::join('credit_note_payments','credit_note_payments.credit_note_id','=','credit_notes.id')->where('credit_notes.customer_id',$contact->id)->where('credit_note_payments.created_at',"<=",$end)->select('credit_note_payments.*')->sum('amount');
            $paymentreceives =  PaymentReceives::select('customer_id', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_receives'),DB::raw('SUM(excess_payment) as total_excess_payment'))->where('payment_date',"<=",$end)->where('customer_id',$contact->id)->first();
            if(!empty($paymentreceives->total_excess_payment)||!empty($paymentreceives->total_receives)||!empty($paymentreceives->total)||!empty($invoice->due_amount)||!empty($invoice->total)|| !empty($credit_note_amount)||!empty($credit_refund)||!empty($credit_note_payment))
            {
                $customerReport[] =[
                    'customer_id'          => $contact->id,
                    'display_name'         => $contact->display_name,
                    'invoices'             => $invoice->total,
                    'total_sales'          => $invoice->total_sales,
                    'total_cr_amount'      => $credit_note_amount,
                    'total_refund'      =>    $credit_refund,
                    'paymentreceives'      => $paymentreceives->total_receives,
                    'total_receives'       => ($paymentreceives->total_receives-$paymentreceives->total_excess_payment)+$credit_note_payment,
                    'total_excess_payment' => $paymentreceives->total_excess_payment,
                    'due'                  => $invoice->due_amount,
                ];
            }
        }
        $date=1;
        $ContactCategory=ContactCategory::all();
        return view('report::customer',compact('customerReport','start','end','accounts','OrganizationProfile','ContactCategory','id','date'));
    }

    public function customerDetails(Request $request, $id)
    {

        $customer_report = [];
        $accounts = Account::all();
        $contact = Contact::find($id);
        $OrganizationProfile = OrganizationProfile::find(1);
       $current_time = Carbon::now()->toDayDateTimeString();
        //
        //
        $start = date("Y-m-d",strtotime(Carbon::now()->toDateString()."-30 day")).' '.'00:00:00';
        $end = date("Y-m-d",strtotime(Carbon::now()->toDateString()."+0 day")).' '.'23:59:59';
        $invoice_start = (new DateTime($current_time))->modify('-30 day')->format('d-m-Y');
        $invoice_end = (new DateTime($current_time))->modify('+0 day')->format('d-m-Y');
       // $paymentMode = PaymentMode::all();
        $request->request->add(['from_date' => $invoice_start,'to_date'=>$invoice_end]);
        $this->customerDetailsSearch($request,$id,$customer);
        $customer_report =$customer;
        $adjustment = JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
                                    ->selectRaw('invoices.vat_adjustment as vat_adjustment, invoices.tax_adjustment as tax_adjustment, invoices.others_adjustment as others_adjustment')
                                    ->get();

       return view('report::customer_details',compact('customer_report', 'adjustment','start','end','accounts','contact','OrganizationProfile'));
    }

    public function array_unique_by_key(&$array, $key)
    {
        $tmp = array();
        $result = array();
        foreach ($array as $value) {
            if (!in_array($value[$key], $tmp)) {
                array_push($tmp, $value[$key]);
                array_push($result, $value);
            }
        }
        return $array = $result;
    }

    public function _group_by($array, $key)
    {
       $return = array();
       foreach($array as $val){

             $return[$val[$key]][] = $val;


       }


        $dta = array();
        foreach($return as $item){
            if(count($item)>1){
                $temp ='';
                foreach($item as $value){
                    $temp.= $value['item_name'].', ';

                }

                if(isset($item[0]['item_name'])){
                    $item[0]['item_name'] =trim($temp,', ');
                    $dta[] = $item;
                }

            }else{
                $dta[] = $item;
            }
        }

        $customer_report2 = array();
        foreach ($dta as $item){

            foreach ($item as $value){
                $customer_report2[] = $value;
            }

        }

        return $customer_report2;
    }

    public function customerDetailsSearch(Request $request,$id,&$output=null)
    {


        $customer_report = [];
        $accounts = Account::all();
        $contact = Contact::find($id);
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';
        $end = date("Y-m-d",strtotime($request->input('to_date')."+0 day")).' '.'23:59:59';
        $condition_cr = "str_to_date(credit_note_date, '%Y-%m-%d') between '$start' and '$end'";
       // $paymentMode = PaymentMode::all();
        $condition = "str_to_date(invoice_date, '%d-%m-%Y') between '$start' and '$end'";
        $condition_payment = "str_to_date(payment_date, '%Y-%m-%d') between '$start' and '$end'";
        $invoices =  Invoice::whereRaw($condition)->where('customer_id',$id)->get();
        $PaymentReceives = PaymentReceives::where('customer_id',$id)->whereRaw($condition_payment)->get();
        $creditnotes = CreditNote::where('customer_id',$id)->whereRaw($condition_cr)->get();
        $PaymentReceiveEntrysdata = array();

        //final start

         $final = new CustomerDetailsReport();
         $customer_report['final']= $final->generate($start,$end,$id);



        // final end
        foreach ($PaymentReceives as $key => $PaymentReceive)
        {
            $PaymentReceiveEntrysdata[$key] = PaymentReceiveEntryModel::where('payment_receives_id',$PaymentReceive->id)->get();
        }
        $creditnote_payament = CreditNotePayment::join('credit_notes','credit_notes.id','=','credit_note_payments.credit_note_id')
                                                ->where('customer_id',$id)
                                                ->whereBetween('credit_note_payments.created_at',[$start,$end])
                                                ->select(DB::raw('credit_note_payments.*'))
                                                ->groupBy(DB::raw('date(credit_note_payments.created_at)'))->get();
        $creditnote_payament_reports = [];
        foreach ($creditnote_payament as $item)
        {
           $data= $item->join('credit_notes','credit_notes.id','=','credit_note_payments.credit_note_id')
                       ->where('customer_id',$id)
                       ->where('credit_note_payments.created_at',$item->created_at)
                       ->select(DB::raw('credit_note_payments.*'),DB::raw('sum(credit_note_payments.amount) as totals_amount'))
                       ->groupBy('credit_note_id')->get();

              foreach ($data as $value)
              {

                 $p_particulars= $value->where('credit_note_id',$value->credit_note_id)->where('created_at',$value->created_at)->get();
                  $p_item='';
                  foreach ($p_particulars as $p_particular)
                  {
                      $p_item.= "INV-".$p_particular->invoice->invoice_number." - ".$p_particular->amount.","." ";
                  }


                  $creditnote_payament_reports[] = [
                    'id'                     => $value->id,
                    'cn_number'         => $value->creditNote->credit_note_number,
                    'item_name'         =>     "Invoice Payment <br/>"."(<span style='font-size:8px;'>".trim($p_item,', ').")</span>",
                    'type'                   => "creditnote_payaments",
                    'total_recieve_amount'   => $value->totals_amount,

                    'created_at'       => $value->created_at,
                    'payment_date'     => $value->created_at,
                    ];
              }

        }


        $creditnote_refunds_condition = "str_to_date(credit_note_refunds.date, '%d-%m-%Y') between '$start' and '$end'";
        $creditnote_refunds = CreditNoteRefund::join('credit_notes','credit_notes.id','=','credit_note_refunds.credit_note_id')
                                               ->where('customer_id',$id)
                                               ->whereRaw($creditnote_refunds_condition)
                                               ->select('credit_note_refunds.*','credit_note_refunds.date as date')
                                               ->get();


        $begin = new DateTime($start);
        $enddate = new DateTime($end);
        $enddate = $enddate->modify( '+0 day' );
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$enddate);

        foreach($daterange as $date)
        {

            foreach ($creditnote_payament_reports as $cr_single)
            {
                if($date->format('Y-m-d') == date('Y-m-d',strtotime($cr_single['created_at'])))
                {
                    $customer_report[] = $cr_single;
                }

            }


            foreach ($invoices as $key => $invoice)
            {
                if($date->format('Y-m-d') == date('Y-m-d',strtotime($invoice->invoice_date)))
                {
                  $item=  $this->getItem($invoice->invoiceEntries);
                    $customer_report[] = [
                    'id'              => $invoice->id,
                    'invoice_number'  => $invoice->invoice_number,
                    'item_name'  =>    $item,
                    'type'            => "invoice",
                    'invoice_date'    => $invoice->invoice_date,
                    'payment_date'    => $invoice->payment_date,
                    'total_amount'    => $invoice->total_amount,
                    'created_at'      => $invoice->created_at,
                    'invoice_date' => $invoice->invoice_date,
                    ];
                }
            }


            foreach ($PaymentReceives as $key => $PaymentReceive)
            {


                    if($date->format('Y-m-d') == date('Y-m-d',strtotime($PaymentReceive->payment_date)))
                    {
                         $particular = '';
                         foreach ($PaymentReceive->PaymentReceiveEntryData as $value){
                           $particular .= "INV-".$value->invoice->invoice_number." - ".$value->amount.', ';
                         }
                        if($particular)
                        {
                            $particular = "<span style='font-size: 8px'>" . trim($particular, ', ') . "</span>";
                            $particular = $particular ? "Invoice Payment<br/>(" . $particular . ")" : '';


                            $customer_report[] = [
                                'id' => $PaymentReceive->id,
                                'type' => "paymentreceiveinvoice",
                                'pr_number' => $PaymentReceive->pr_number,
                                'payment_mode' => $PaymentReceive->payment_mode_id,
                                'payment_date' => $PaymentReceive->payment_date,
                                'amount' => $PaymentReceive->amount - $PaymentReceive->excess_payment,
                                'receive_through' => isset($PaymentReceive->account->account_name) ? $PaymentReceive->account->account_name : '',
                                'created_at' => $PaymentReceive->created_at,
                                'updated_at' => $PaymentReceive->updated_at,
                                'item_name' => $particular,
                            ];
                        }
                    }

            }
            foreach ($PaymentReceives as $key => $PaymentReceive)
            {

                if($PaymentReceive->excess_payment > 0)
                {
                    if($date->format('Y-m-d') == date('Y-m-d',strtotime($PaymentReceive->payment_date)))
                    {
                        $customer_report[] = [
                        'id'                     => $PaymentReceive->id,
                        'type'                   => "paymentreceive",
                        'pr_number' => $PaymentReceive->pr_number,
                        'payment_mode'           => $PaymentReceive->payment_mode_id,
                        'payment_date'           => $PaymentReceive->payment_date,
                        'amount'                 => $PaymentReceive->excess_payment,
                        'receive_through' => isset($PaymentReceive->account->account_name) ? $PaymentReceive->account->account_name : '',
                        'created_at'             => $PaymentReceive->created_at,
                        'updated_at'             => $PaymentReceive->updated_at,
                        ];
                    }
                }
            }

            foreach($creditnotes as $key => $creditnote)
            {

                if($date->format('Y-m-d') == date('Y-m-d',strtotime($creditnote->credit_note_date)))
                    {
                    $item_name = CreditNote::join('credit_note_entries', 'credit_note_entries.credit_note_id', '=', 'credit_notes.id')->join('item', 'credit_note_entries.item_id', '=', 'item.id')->where('credit_note_id', $creditnote->id)->select(DB::raw("GROUP_CONCAT(item_name SEPARATOR ', ') as `item_name`"))->groupBy('credit_note_id')->first();

                    $item_name = implode(',', array_unique(explode(',', isset($item_name->item_name) ? $item_name->item_name : '')));

                    $customer_report[] = [
                        'id' => $creditnote->id,
                        'type' => "creditnote",
                        'cr_number' => $creditnote->credit_note_number,
                        'item_name' => !empty($item_name) ? $item_name : '',
                        'total_credit_amount' => $creditnote->total_credit_note,
                        'due' => $creditnote->available_credit,
                        'created_at' => $creditnote->created_at,
                        'credit_note_date' => $creditnote->credit_note_date,
                    ];
                }

            }

        //            foreach($creditnote_payament as $key => $creditnote_payaments)
        //            {
        //
        //                if ($date->format('Y-m-d') == date('Y-m-d',strtotime($creditnote_payaments->credit_note_date)))
        //                {
        //
        //                    $customer_report[] = [
        //                        'id' => $creditnote_payaments->id,
        //                        'type' => "creditnote_payaments",
        //                        'cn_number' => str_pad($creditnote_payaments->creditnote->credit_note_number,6, '0', STR_PAD_LEFT),
        //                        'item_name' => 'Credit Note Payment '."<br/>(CN-".str_pad($creditnote_payaments->creditnote->credit_note_number,6, '0', STR_PAD_LEFT).")",
        //                        'total_recieve_amount' => $creditnote_payaments->amount,
        //                        'due' => $creditnote_payaments->invoice->due_amount,
        //                        'created_at' => $creditnote_payaments->created_at,
        //                        'credit_note_date' => $creditnote_payaments->credit_note_date,
        //                    ];
        //                }
        //
        //            }

            foreach($creditnote_refunds as $key => $creditnote_refund)
            {

                if($date->format('Y-m-d') == date('Y-m-d',strtotime($creditnote_refund->date)))
                {

                    $customer_report[] = [
                        'id' => uniqid(),
                        'type' => "creditnote_refund",
                        'cr_number' => $creditnote_refund->creditNote->credit_note_number,
                        'item_name' => 'Credit Note Refund',
                        'total_refund' => $creditnote_refund->amount,
                        'due' => $creditnote_refund->available_credit,
                        'created_at' => $creditnote_refund->created_at,
                        'date' => $creditnote_refund->date,
                    ];
                }

            }
        }


        $start = date('d-m-Y',strtotime($request->input('from_date')));
        $end = date('d-m-Y',strtotime($request->input('to_date')));

        $output = $customer_report;
        return view('report::customer_details',compact('customer_report','start','end','accounts','contact','OrganizationProfile'));
    }

    public function getItem($entry)
    {
        $result = '';
        foreach ($entry as $value){

            $data= Item::find($value->item_id);
            if(isset($data->item_name)){
                $result.= $data->item_name.', ';
            }

        }
        return trim($result,', ');
    }

    public function item()
    {
        $branch                 = Branch::find(Auth::user()->branch_id);
        $this->getBranchUsers($branch->id);

        $branches               = Auth::user()->branch_id == 1 ? Branch::all() : Branch::where('id', $branch->id)->get();

        if ($branch->id != 1) {
            $items              = Item::where('branch_id', $branch->id)->get();
        }else
            $items              = Item::all();

         if ($branch->id != 1) {
            $categories             = ItemCategory::where('branch_id', $branch->id)->get();
        }else
            $categories             = ItemCategory::all();

        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                    = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');

        $OrganizationProfile    = OrganizationProfile::find(1);
        
        return view('report::item', compact('branch', 'branches', 'start', 'end', 'OrganizationProfile', 'items', 'categories'));
    }

    public function itemDetails($id, $branch_id, $start, $end)
    {
        $branch_id              = isset($branch_id) ? $branch_id : Auth::user()->branch_id;
        $selected_branch_id     = $branch_id;
        $this->getBranchUsers($branch_id);

        if(isset($branch_id) && (Auth::user()->branch_id != $branch_id) && Auth::user()->branch_id != 1)
        {
            return back();
        }

        $branch_name            = isset($branch_id) ? Branch::find($branch_id) : Branch::find(Auth::user()->branch_id);
        $branch                 = $branch_name;
        $branch_name            = $branch_name['branch_name'];
        

        // $branches                = Branch::all();
        $branches               = Auth::user()->branch_id == 1 ? Branch::all() : Branch::where('id', $branch->id)->get();
        $OrganizationProfile    = OrganizationProfile::find(1);

        if ($branch_id != 1) {
            $categories             = ItemCategory::where('branch_id', $branch_id)->get();
        }else
            $categories             = ItemCategory::all();
        
        $start                  = date('Y-m-d', strtotime($start));
        $end                    = date('Y-m-d', strtotime($end));
        
        $subcategories          = ItemSubCategory::all();

        if ($branch_id != 1) {
            $items              = Item::where('branch_id', $branch_id)->get();
        }else
            $items              = Item::all();

        $item                   = Item::findOrFail($id);

        $invoices               = Invoice::whereBetween('invoices.invoice_date', [$start, $end])
                                            ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                            ->selectRaw('invoice_entries.*, invoices.created_by as created_by, invoices.invoice_number as transaction, invoices.invoice_date as date, invoices.customer_id as customer_id')
                                            ->where('invoice_entries.item_id', $id)
                                            ->orderBy('invoices.invoice_date', 'ASC')
                                            ->get();

        $bills                  = Bill::whereBetween('bill.bill_date', [$start, $end])
                                            ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                            ->selectRaw('bill_entry.*, bill.created_by as created_by, bill.bill_number as transaction, bill.bill_date as date, bill.vendor_id as vendor_id')
                                            ->where('bill_entry.item_id', $id)
                                            ->orderBy('bill.bill_date', 'ASC')
                                            ->get(); 

        $credit_notes           = CreditNote::whereBetween('credit_notes.credit_note_date', [$start, $end])
                                            ->join('credit_note_entries', 'credit_note_entries.credit_note_id', 'credit_notes.id')
                                            ->selectRaw('credit_note_entries.*, credit_notes.created_by as created_by, credit_notes.credit_note_number as transaction, credit_notes.credit_note_date as date, credit_notes.customer_id as customer_id')
                                            ->where('credit_note_entries.item_id', $id)
                                            ->orderBy('credit_notes.credit_note_date', 'ASC')
                                            ->get();

        $vendor_credits         = VendorCredit::whereBetween('vendor_credit.vendor_credit_date', [$start, $end])
                                            ->join('vendor_credit_entry', 'vendor_credit_entry.vendor_credit_id', 'vendor_credit.id')
                                            ->selectRaw('vendor_credit_entry.*, vendor_credit.created_by as created_by, vendor_credit.vendor_credit_no as transaction, vendor_credit.vendor_credit_date as date, vendor_credit.vendor_name as vendor_name')
                                            ->where('vendor_credit_entry.item_id', $id)
                                            ->orderBy('vendor_credit.vendor_credit_date', 'ASC')
                                            ->get();

        //stock transfer starts
        $stock_transferred_to   = StockTransfer::whereBetween('date', [$start, $end])
                                            ->where('item_id', $id)
                                            ->where('transfer_from', $branch_id)
                                            ->orderBy('date', 'ASC')
                                            ->get();

        $stock_transferred_from = StockTransfer::whereBetween('date', [$start, $end])
                                            ->where('item_id', $id)
                                            ->where('transfer_to', $branch_id)
                                            ->orderBy('date', 'ASC')
                                            ->get();
        //stock transfer ends
                                            
        if($branch_id != 1){

            $invoices           = $invoices->whereIn('created_by', $this->targeted_users);
            $bills              = $bills->whereIn('created_by', $this->targeted_users);
            $credit_notes       = $credit_notes->whereIn('created_by', $this->targeted_users);
            $vendor_credits     = $vendor_credits->whereIn('created_by', $this->targeted_users);

        }

        return view('report::item_details', compact('subcategories', 'categories', 'start', 'end', 'branch',
                    'item', 'OrganizationProfile', 'branches', 'branch_name', 'invoices', 'bills', 
                    'credit_notes', 'vendor_credits', 'branch_id', 'selected_branch_id', 'items', 
                    'stock_transferred_to', 'stock_transferred_from'));
    }

    public function filter_item(Request $request)
    {
        $branch                 = Branch::find(isset($_GET['branch_id']) ? $_GET['branch_id'] : Auth::user()->branch_id);
        $this->getBranchUsers($branch->id);

        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = isset($_GET['start']) ? date('Y-m-d', strtotime($_GET['start'])) : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                    = isset($_GET['end']) ? date('Y-m-d', strtotime($_GET['end'])) : (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');

        $item                   = isset($_GET['item_id']) && $_GET['item_id'] != 0 ? Item::find($_GET['item_id']) : null;
        // if (isset($item)) return $this->itemDetails($item->id, $branch->id, $start, $end);

        $category               = isset($_GET['category_id']) && $_GET['category_id'] != 0 ? ItemCategory::find($_GET['category_id']) : null;

        // dd($branch, $item, $category);

        $branches               = Branch::all();
        $categories             = ItemCategory::all();
        $items                  = Item::when(isset($item), function($query) use ($item) {
                                    return $query->where('id', $item->id);
                                })
                                ->when(isset($category), function($query) use ($category) {
                                    return $query->where('item_category_id', $category->id);
                                })
                                ->get();

                                // ->when($branch->id != 1, function($query) use ($branch) {
                                //     return $query->where('branch_id', $branch->id);
                                // })
                                

        $OrganizationProfile    = OrganizationProfile::find(1);

        $data                   = [];
        foreach ($items as $key => $value)
        {
            $last_purchase_rate                     = BillEntry::where('item_id', $value->id)->orderBy('id', 'DESC')->first();

            if($last_purchase_rate){
                $last_purchase_rate = $last_purchase_rate['rate'];
            }else{
                $last_purchase_rate = 0;                
            }

            $value->item_purchase_rate               = $value->item_purchase_rate > 0 ? $value->item_purchase_rate : $last_purchase_rate;

            $data[$value->id]['item_id']             = $value->id;
            $data[$value->id]['item_name']           = $value->item_name;
            $data[$value->id]['total_manufacture']   = $value->total_manufacture;
            $data[$value->id]['cat_id']              = $value->item_category_id;
            $data[$value->id]['sub_cat_id']          = $value->item_sub_category_id;
            
            //Opening Stock Calculation
            $op_invoices            = Invoice::where('invoices.invoice_date', '<', $start)
                                                ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                                ->selectRaw('invoice_entries.*, invoices.created_by as created_by')
                                                ->where('branch_id', $branch->id)
                                                ->where('item_id', $value->id)->sum('quantity');

            $op_bills               = Bill::where('bill.bill_date', '<', $start)
                                                ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                                ->selectRaw('bill_entry.*, bill.created_by as created_by')
                                                ->where('branch_id', $branch->id)
                                                ->where('item_id', $value->id)->sum('quantity');

            $op_credit_notes        = CreditNote::where('credit_notes.credit_note_date', '<', $start)
                                                ->whereIn('credit_notes.created_by', $this->targeted_users)
                                                ->join('credit_note_entries', 'credit_note_entries.credit_note_id', 'credit_notes.id')
                                                ->selectRaw('credit_note_entries.*, credit_notes.created_by as created_by')
                                                ->where('item_id', $value->id)->sum('quantity');

            $op_vendor_credits      = VendorCredit::where('vendor_credit.vendor_credit_date', '<', $start)
                                                ->whereIn('vendor_credit.created_by', $this->targeted_users)
                                                ->join('vendor_credit_entry', 'vendor_credit_entry.vendor_credit_id', 'vendor_credit.id')
                                                ->selectRaw('vendor_credit_entry.*, vendor_credit.created_by as created_by')
                                                ->where('item_id', $value->id)->sum('quantity');
            //Opening Stock Calculation Ends

            //stock trnasfer calculation starts
            $op_transferred_to     =  StockTransfer::where('date', '<', $start)
                                                ->where('transfer_to', $branch->id)
                                                ->where('item_id', $value->id)->sum('quantity');

            $op_transferred_from   =  StockTransfer::where('date', '<', $start)
                                                ->where('transfer_from', $branch->id)
                                                ->where('item_id', $value->id)->sum('quantity');
            //stock trnasfer calculation ends

            $invoices               = Invoice::whereBetween('invoices.invoice_date', [$start, $end])
                                                ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                                ->selectRaw('invoice_entries.*, invoices.created_by as created_by')
                                                ->where('branch_id', $branch->id)
                                                ->where('item_id', $value->id)->sum('quantity');
                                                
            $invoice_amounts        = Invoice::whereBetween('invoices.invoice_date', [$start, $end])
                                                ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                                ->selectRaw('invoice_entries.*, invoices.created_by as created_by')
                                                ->where('branch_id', $branch->id)
                                                ->where('item_id', $value->id)->sum('invoice_entries.amount');                                    

            $bills                  = Bill::whereBetween('bill.bill_date', [$start, $end])
                                                ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                                ->selectRaw('bill_entry.*, bill.created_by as created_by')
                                                ->where('branch_id', $branch->id)
                                                ->where('item_id', $value->id)->sum('quantity');
                                                
            $bills_amounts          = Bill::whereBetween('bill.bill_date', [$start, $end])
                                                ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                                ->selectRaw('bill_entry.*, bill.created_by as created_by')
                                                ->where('branch_id', $branch->id)
                                                ->where('item_id', $value->id)->sum('bill_entry.amount');                                    

            $credit_notes           = CreditNote::whereBetween('credit_notes.credit_note_date', [$start, $end])
                                                ->whereIn('credit_notes.created_by', $this->targeted_users)
                                                ->join('credit_note_entries', 'credit_note_entries.credit_note_id', 'credit_notes.id')
                                                ->selectRaw('credit_note_entries.*, credit_notes.created_by as created_by')
                                                ->where('item_id', $value->id)->sum('quantity');
                                                
            $credit_notes_amounts   = CreditNote::whereBetween('credit_notes.credit_note_date', [$start, $end])
                                                ->whereIn('credit_notes.created_by', $this->targeted_users)
                                                ->join('credit_note_entries', 'credit_note_entries.credit_note_id', 'credit_notes.id')
                                                ->selectRaw('credit_note_entries.*, credit_notes.created_by as created_by')
                                                ->where('item_id', $value->id)->sum('credit_note_entries.amount');                                    

            $vendor_credits         = VendorCredit::whereBetween('vendor_credit.vendor_credit_date', [$start, $end])
                                                ->whereIn('vendor_credit.created_by', $this->targeted_users)
                                                ->join('vendor_credit_entry', 'vendor_credit_entry.vendor_credit_id', 'vendor_credit.id')
                                                ->selectRaw('vendor_credit_entry.*, vendor_credit.created_by as created_by')
                                                ->where('item_id', $value->id)->sum('quantity');
                                                
            $vendor_credits_amounts = VendorCredit::whereBetween('vendor_credit.vendor_credit_date', [$start, $end])
                                                ->whereIn('vendor_credit.created_by', $this->targeted_users)
                                                ->join('vendor_credit_entry', 'vendor_credit_entry.vendor_credit_id', 'vendor_credit.id')
                                                ->selectRaw('vendor_credit_entry.*, vendor_credit.created_by as created_by')
                                                ->where('item_id', $value->id)->sum('vendor_credit_entry.amount'); 
                                                
                                                
            //transferred stock calculation starts
            $ts_transferred_to      = StockTransfer::whereBetween('date', [$start, $end])
                                                ->where('transfer_to', $branch->id)
                                                ->where('item_id', $value->id)->sum('quantity');

            $ts_transferred_from    = StockTransfer::whereBetween('date', [$start, $end])
                                                ->where('transfer_from', $branch->id)
                                                ->where('item_id', $value->id)->sum('quantity');
            //transferred stock calculation ends

            $data[$value->id]['opening_stock']       = ((($op_bills - $op_vendor_credits) 
                                                        - ($op_invoices - $op_credit_notes)) 
                                                        + $op_transferred_to - $op_transferred_from)+ $data[$value->id]['total_manufacture'];
            
            $data[$value->id]['total_purchases']     = $bills - $vendor_credits;
            $data[$value->id]['transferred_stock']   = $ts_transferred_to - $ts_transferred_from;
            $data[$value->id]['total_sales']         = $invoices - $credit_notes;
            $data[$value->id]['barcode_no']         = $value->barcode_no;
            
            $data[$value->id]['sales_amount']        = $invoice_amounts - $credit_notes_amounts;
            $data[$value->id]['purchase_amount']     = $bills_amounts - $vendor_credits_amounts;
            
            $data[$value->id]['item_sales_rate']     = $value->item_sales_rate;
            $data[$value->id]['item_purchase_rate']  = $value->item_purchase_rate;

            if ($request->hide_0 && $data[$value->id]['total_purchases'] == 0 && $data[$value->id]['total_sales'] == 0) unset($data[$value->id]);
        }
        
        if ($branch->id != 1) {
            $items                  = Item::where('branch_id', $branch->id); 
        }else
            $items                  = Item::all();

        return view('report::item', compact('branch', 'category', 'item', 'branches', 'start', 'end', 'OrganizationProfile', 'items', 'categories', 'data'));
    }

    public function cashbook()
    {
        $branch_id  = Auth::user()->branch_id;
        $to_date    = Carbon::now(); // create a new DateTime object representing today's date/time
        $from_date  = Carbon::now()->subMonth(); // modify the DateTime object to go back one month
        
        $account_name_ids = Account::whereIn('account_type_id', array(4, 5))->pluck('id')->toArray();
        // dd($account_name_ids);

        $opening_balances = JournalEntry::select('journal_entries.account_name_id', 'account.account_name', DB::raw('SUM(CASE WHEN journal_entries.debit_credit = 1 THEN journal_entries.amount ELSE -journal_entries.amount END) AS balance'))
                                ->leftJoin('account', 'account.id', '=', 'journal_entries.account_name_id')
                                ->whereIn('account_name_id', $account_name_ids)
                                ->whereDate('assign_date', '<=', $from_date->format('Y-m-d'))
                                ->groupBy('account_name_id')
                                ->orderBy('account_name_id')
                                ->get();
                                
        $receipt_logs = JournalEntry::whereBetween('assign_date', [$from_date->format('Y-m-d'), $to_date->format('Y-m-d')])
                                    ->whereIn('account_name_id', $account_name_ids)
                                    ->where('debit_credit', 1)
                                    ->with('contact', 'updatedBy', 'paymentReceive', 'vendorCreditRefund')
                                    ->get();
                                    // ->where(function($query) {
                                    //     $query->whereNotNull('income_id')
                                    //           ->orWhereNotNull('payment_receives_id')
                                    //           ->orWhereNotNull('vendor_credit_refunds_id');
                                    // })

                                    // dd($receipt_logs);
                                
        $payment_logs = JournalEntry::whereBetween('assign_date', [$from_date->format('Y-m-d'), $to_date->format('Y-m-d')])
                                    ->whereIn('account_name_id', $account_name_ids) 
                                    ->where('debit_credit', 0)
                                    ->get();
                                    // ->latest()->first();
                                    // ->where(function($query) {
                                    //     $query->whereNotNull('expense_id')
                                    //           ->orWhereNotNull('payment_made_id')
                                    //           ->orWhereNotNull('credit_note_refunds_id');
                                    // })
                                    // dd($payment_logs);

                                    

        $closing_balances = JournalEntry::select('journal_entries.account_name_id', 'account.account_name', DB::raw('SUM(CASE WHEN journal_entries.debit_credit = 1 THEN journal_entries.amount ELSE -journal_entries.amount END) AS balance'))
                                        ->leftJoin('account', 'account.id', '=', 'journal_entries.account_name_id')
                                        ->whereIn('account_name_id', $account_name_ids)
                                        ->whereDate('assign_date', '<=', $to_date->format('Y-m-d'))
                                        ->groupBy('account_name_id')
                                        ->orderBy('account_name_id')
                                        ->get();

        // $this->getBranchUsers($branch_id);

        $OrganizationProfile    = OrganizationProfile::find(1);
        $branch                 = Branch::all();
        $branch_name            = $branch->where('id', $branch_id)->first();

        return view('report::cash_book',compact('opening_balances', 'closing_balances', 'receipt_logs', 'payment_logs', 'OrganizationProfile', 'from_date', 'to_date', 'branch','branch_name'));
    }

    public function cashbooksearch(Request $request)
    {
        // if ($request->branch_id != null)
        // {
        //     $branch_id              = $request->branch_id;
        // }else
        // {
        //     $branch_id              = Auth::user()->branch_id;
        // }
        
        $branch_id      = $request->branch_id != null ? $request->branch_id : Auth::user()->branch_id;
        $branch_users   = User::where('branch_id', $branch_id)->pluck('id')->toArray();
        $to_date        = $request->from_date != null ? date("Y-m-d", strtotime($request->from_date)) : Carbon::now(); // create a new DateTime object representing today's date/time
        $from_date      = $request->to_date != null ? date("Y-m-d", strtotime($request->to_date)) : Carbon::now()->subMonth(); // modify the DateTime object to go back one month
        
        
        $account_name_ids = Account::whereIn('account_type_id', array(4, 5))->pluck('id')->toArray();

        $opening_balances = JournalEntry::select('journal_entries.account_name_id', 'account.account_name', DB::raw('SUM(CASE WHEN journal_entries.debit_credit = 1 THEN journal_entries.amount ELSE -journal_entries.amount END) AS balance'))
                                ->where('journal_entries.created_by', $branch_users)
                                ->leftJoin('account', 'account.id', '=', 'journal_entries.account_name_id')
                                ->whereIn('account_name_id', $account_name_ids)
                                ->whereDate('assign_date', '<=', $from_date)
                                ->groupBy('account_name_id')
                                ->orderBy('account_name_id')
                                ->get();
                                
        $receipt_logs = JournalEntry::whereBetween('assign_date', [$from_date, $to_date])
                                    ->where('journal_entries.created_by', $branch_users)
                                    ->whereIn('account_name_id', $account_name_ids)
                                    ->where('debit_credit', 1)
                                    ->get();
                                    // ->where(function($query) {
                                    //     $query->whereNotNull('income_id')
                                    //           ->orWhereNotNull('payment_receives_id')
                                    //           ->orWhereNotNull('vendor_credit_refunds_id');
                                    // })
                                
        $payment_logs = JournalEntry::whereBetween('assign_date', [$from_date, $to_date])
                                    ->whereIn('account_name_id', $account_name_ids)
                                    ->where('debit_credit', 0)
                                    ->where('journal_entries.created_by', $branch_users)
                                    ->get();
                                    // ->where(function($query) {
                                    //     $query->whereNotNull('expense_id')
                                    //           ->orWhereNotNull('payment_made_id')
                                    //           ->orWhereNotNull('credit_note_refunds_id');
                                    // })

                                    

        $closing_balances = JournalEntry::select('journal_entries.account_name_id', 'account.account_name', DB::raw('SUM(CASE WHEN journal_entries.debit_credit = 1 THEN journal_entries.amount ELSE -journal_entries.amount END) AS balance'))
                                        ->leftJoin('account', 'account.id', '=', 'journal_entries.account_name_id')
                                        ->whereIn('account_name_id', $account_name_ids)
                                        ->where('journal_entries.created_by', $branch_users)
                                        ->whereDate('assign_date', '<=', $to_date)
                                        ->groupBy('account_name_id')
                                        ->orderBy('account_name_id')
                                        ->get();

        $this->getBranchUsers($branch_id);

        $accounts           = Account::all();

        $current_time       = Carbon::now()->toDayDateTimeString();
        $start              = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';
        $end                = date("Y-m-d",strtotime($request->input('to_date')."+0 day")).' '.'00:00:00';
        $yesterday          = date("Y-m-d",strtotime($request->input('from_date')."-1 day"));


        $begin_time         = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $account_type       = Account::where('account_type_id',4)->get();
        //$account_type = Account::all();


        $JournalEntrys                      = [];
        $total_cash_inhand                  = 0;
        $total_cash_inhand_debit            = 0;
        $total_cash_inhand_credit           = 0;
        $total_current_cash_inhand_debit    = 0;
        $total_current_cash_inhand_credit   = 0;

       if ($branch_id == 1)
        {
            foreach ($account_type as $key => $value)
            {

                 $JournalEntrys[] =  JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->get()->sortBy('assign_date');

                // current cash in hand
                $current_cash_inhand_debit = JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->where('debit_credit',1)->get()->sortBy('assign_date');

                $current_cash_inhand_credit = JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->where('debit_credit',0)->get()->sortBy('assign_date');
                $total_current_cash_inhand_debit = $total_current_cash_inhand_debit+$current_cash_inhand_debit[0]['amount'];
                $total_current_cash_inhand_credit = $total_current_cash_inhand_credit+$current_cash_inhand_credit[0]['amount'];
                $current_cash_in_hand = $total_current_cash_inhand_debit-$total_current_cash_inhand_credit;


                // total cash in hand
                //$start = (new DateTime($current_time))->modify('-1 day')->format('Y-m-d'); //$start changes as Opening balance will not include current time
                $cash_inhand_debit = JournalEntry::select(DB::raw('SUM(amount) as cash_inhand'))->whereBetween('assign_date',[$begin_time,$yesterday])->where('account_name_id',$value->id)->where('debit_credit',1)->get()->sortBy('assign_date');
                $cash_inhand_credit = JournalEntry::select(DB::raw('SUM(amount) as cash_inhand'))->whereBetween('assign_date',[$begin_time,$yesterday])->where('account_name_id',$value->id)->where('debit_credit',0)->get()->sortBy('assign_date');

                $total_cash_inhand_debit = $total_cash_inhand_debit+(int)$cash_inhand_debit[0]['cash_inhand'];
                $total_cash_inhand_credit = $total_cash_inhand_credit+(int)$cash_inhand_credit[0]['cash_inhand'];
                $total_cash_inhand = $total_cash_inhand_debit-$total_cash_inhand_credit;

                $current_cash_in_hand = $current_cash_in_hand + $total_cash_inhand;

                //dd($total_cash_inhand);
                $total_cash_inhand          = $total_cash_inhand_debit  - $total_cash_inhand_credit;

            }
        }else
        {
            foreach ($account_type as $key => $value)
            {

                $JournalEntrys[$key] = JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->get()->sortBy('assign_date');
                $JournalEntrys[$key] = $JournalEntrys[$key]->whereIn('created_by', $this->targeted_users);

                $current_cash_inhand_debit      = JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->where('debit_credit',1)->get()->sortBy('assign_date');
                $current_cash_inhand_debit      = $current_cash_inhand_debit->whereIn('created_by', $this->targeted_users);

                $current_cash_inhand_debit      = $current_cash_inhand_debit->whereIn('created_by', $this->targeted_users);

                $current_cash_inhand_credit     = JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->where('debit_credit',0)->get()->sortBy('assign_date');

                $current_cash_inhand_credit     = $current_cash_inhand_credit->whereIn('created_by', $this->targeted_users);

                $current_cash_inhand_credit     = $this->collectionAttributeSum($current_cash_inhand_credit);
                $current_cash_inhand_debit      = $this->collectionAttributeSum($current_cash_inhand_debit);


                $total_current_cash_inhand_debit     = $total_current_cash_inhand_debit  + $current_cash_inhand_debit;
                $total_current_cash_inhand_credit    = $total_current_cash_inhand_credit + $current_cash_inhand_credit;
                $current_cash_in_hand                = $total_current_cash_inhand_debit  - $total_current_cash_inhand_credit;


                // total cash in hand
                $start  = (new DateTime($current_time))->modify('-1 day')->format('Y-m-d'); //$start changes as Opening balance will not include current time

                $cash_inhand_debit      = JournalEntry::whereBetween('assign_date',[$begin_time,$yesterday])->where('account_name_id',$value->id)->where('debit_credit',1)->get()->sortBy('assign_date');

                $cash_inhand_debit      = $cash_inhand_debit->whereIn('created_by', $this->targeted_users);

                $cash_inhand_debit      = $this->collectionAttributeSum($cash_inhand_debit);

                $cash_inhand_credit     = JournalEntry::whereBetween('assign_date',[$begin_time,$yesterday])->where('account_name_id',$value->id)->where('debit_credit',0)->get()->sortBy('assign_date');

                $cash_inhand_credit     = $cash_inhand_credit->whereIn('created_by', $this->targeted_users);

                $cash_inhand_credit     = $this->collectionAttributeSum($cash_inhand_credit);

                $total_cash_inhand_debit    = $total_cash_inhand_debit  + (int)$cash_inhand_debit;
                $total_cash_inhand_credit   = $total_cash_inhand_credit + (int)$cash_inhand_credit;

                $total_cash_inhand          = $total_cash_inhand_debit  - $total_cash_inhand_credit;

                $current_cash_in_hand = $current_cash_in_hand + $total_cash_inhand;
            }
        }

        $cashdata = [];

        foreach ($JournalEntrys as $item)
        {
            foreach ($item as $value){
                $cashdata[] = $value->toArray();
            }

        }

        $sort                   = new sortBydate();
        $JournalEntrys          = $sort->get('\App\Models\ManualJournal\JournalEntry','assign_date','Y-m-d',$cashdata);
        $OrganizationProfile    = OrganizationProfile::find(1);
        $start                  = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00'; //$start changes as it is used in from to display
        $end                    = date("Y-m-d",strtotime($request->input('to_date')."+0 day")).' '.'00:00:00'; // $end changes as it is used in from to display
        $branch                 = Branch::all();
        $branch_name            = Branch::where('id', $branch_id)->first();

        // return view('report::cash_book',compact('JournalEntrys','start','end','accounts','OrganizationProfile','total_cash_inhand','current_cash_in_hand','total_current_cash_inhand_debit','total_current_cash_inhand_credit','total_cash_inhand_debit','total_cash_inhand_credit','branch','branch_name'))->with('branch_id',$branch_id);
        return view('report::cash_book',compact('opening_balances', 'closing_balances', 'receipt_logs', 'payment_logs', 'OrganizationProfile', 'from_date', 'to_date', 'branch','branch_name'));
    }

    public function checkBranch($data)
    {
        if ($this->branch_id==0) {
            $user=Auth::user();
            $this->branch_id=$user->branch_id;
        }

        if($this->branch_id!=1 && count($data)>0){
            $new=$data[0]->join('users','users.id','=','journal_entries.created_by')->where('branch_id',$this->branch_id)->get();
            return $new;
        }
        else{
            return $data;
        }
    }

    public function getBranchUsers($branch_id)
    {
        $tmp_targeted_users      = [];
        $this->targeted_users    = [];

        $this->branch_id = $branch_id;

        $branch_users = User::where('branch_id', $this->branch_id)->get();

        if(isset($branch_users)){

            foreach($branch_users as $users){
                $tmp_targeted_users[] = $users->id;
            }

        }else{

            $tmp_targeted_users = [];

        }

        $this->targeted_users = $tmp_targeted_users;
    }

    public function collectionAttributeSum($data)
    {
        $summed_value = 0;

        if(count($data)>0){

            foreach($data as $tmp_data){
                $summed_value = (double)$summed_value + (double)$tmp_data['amount'];
            }

            return $summed_value;

        }
        else{
            return 0;
        }
    }
}