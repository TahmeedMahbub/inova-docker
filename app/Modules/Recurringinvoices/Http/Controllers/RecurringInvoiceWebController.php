<?php

namespace App\Modules\Recurringinvoices\Http\Controllers;

use App\Lib\sortBydate;
use App\Lib\TemplateHeader;
use App\Models\AccountChart\Account;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\Manpower\Manpower_service;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\InvoiceDue;
use App\Models\MoneyOut\StockSerial;
use App\Models\Recruit\Recruitorder;
use App\Models\Template\HeaderTemplate;
use App\Models\Visa\Ticket\Order\Order;
use App\Models\VisaStamp\VisaStamp;
use App\Modules\Invoice\Http\Response\Payment;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use DB;

use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\RecurringInvoice;
use App\Models\Moneyin\RecurringInvoiceEntry;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\Journal;
use App\Models\ManualJournal\JournalEntries;
use App\Models\Moneyin\ExcessPayment;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNote;
use App\Models\Contact\Agent;
use App\Models\OrganizationProfile\OrganizationProfile;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use NumberToWords\NumberToWords;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemSubCategory;
use App\User;

class RecurringInvoiceWebController extends Controller
{

    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function __construct()
    {

      $this->increasing_limit = DB::statement('SET SESSION group_concat_max_len = 100000000000');
    }

    public function index(Request $request)
    {
       $invoice_no     = isset($request->invoice_no) ? $request->invoice_no :0;
       $invoice_no     = str_pad($invoice_no,6,0,STR_PAD_LEFT);
       $auth_id        = Auth::id();
       $sort           = new sortBydate();
       $branch_id      = session('branch_id');

       $this->getBranchUsers($branch_id);

       $branchs                  = Branch::orderBy('id','asc')->get();
       $recurring_invoices       = [];
       $condition                = "YEAR(str_to_date(invoice_date,'%d-%m-%Y')) = YEAR(CURDATE()) AND MONTH(str_to_date(invoice_date,'%d-%m-%Y')) = MONTH(CURDATE())";

       try{
           if($branch_id == 1)
           {
              
              
                $recurring_invoices   = RecurringInvoice::when($invoice_no != 0, function ($query) use ( $invoice_no) {
                                                                return $query->where('recurring_invoice_number', $invoice_no);
                                                                })
                                                            ->get();

            }             
           else
           {

               $recurring_invoices       =  RecurringInvoice::when($invoice_no != 0, function ($query) use ( $invoice_no) {
                                                                return $query->where('recurring_invoice_number', $invoice_no);
                                                                })
                                                            ->whereIn('created_by', $this->targeted_users)
                                                            ->get();
           }


           return view('recurringinvoices::index',compact('recurring_invoices','branchs'));

       }
       catch (\Exception $exception)
       {
           return view('recurringinvoices::index',compact('recurring_invoices','branchs'));
       }
    }

    public function search(Request $request)
    {
        $branchs        = Branch::orderBy('id','asc')->get();
        $branch_id      = $request->branch_id ? $request->branch_id : session('branch_id');

        $this->getBranchUsers($branch_id);
        if(session('branch_id')==1)
        {
            $branch_id  =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id  = session('branch_id');
        }

        $from_date               =  date('Y-m-d',strtotime($request->from_date));
        $to_date                 =  date('Y-m-d',strtotime($request->to_date));
        $condition               = "str_to_date(invoice_date, '%d-%m-%Y') between '$from_date' and '$to_date'";
        // $recurring_invoices       = [];

        try{
            if($branch_id == 1)
            {
                $recurring_invoices     = RecurringInvoice::whereRaw($condition)->get();
            }
            else
            {
                $recurring_invoices   = RecurringInvoice::select(DB::raw('recurring_invoices.*'))->whereRaw($condition)->get();
                $recurring_invoices   = $recurring_invoice->whereIn('created_by', $this->targeted_users);

            }

            $sort           = new sortBydate();

            // $recurring_invoices    = $sort->get('\App\Models\Moneyin\RecurringInvoice','invoice_date','d-m-Y',$recurring_invoice);
            // dd($recurring_invoices,$from_date,$to_date);

           return view('recurringinvoices::index',compact('recurring_invoices','branchs','branch_id','from_date','to_date'));

        }
       catch (\Exception $exception)
       {
           return view('recurringinvoices::index',compact('recurring_invoices','branchs','branch_id','from_date','to_date'));
       }
    }

    public function create()
    {

        $branch_id          = session('branch_id');
        $item_category      = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
                                                return $query->where('branch_id', '=', $branch_id);
                                            })
                                            ->orderBy('item_category_name', 'ASC')
                                            ->get();

        $customers          = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                        ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', '=', $branch_id);
                                            })
                                        ->select('contact.*')
                                        ->get();

        $agents             = $customers;
        $account            = Account::all();
        $accounts           = Account::whereIn('id',[4,5])->get();

        $recurring_invoices           = RecurringInvoice::count();

        $delivery_persons   = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                    ->where('contact_category_id', 3)
                                    ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id)
                                    {
                                        return $query->where('users.branch_id', '=', $branch_id);
                                    })
                                    ->get()
                                    ->sortBy('display_name');

        if($recurring_invoices > 0)
        {
            $recurring_invoice                   = RecurringInvoice::orderBy('created_at', 'desc')->first();
            $recurring_invoice_number            = $recurring_invoice['invoice_number'];
            $recurring_invoice_number            = $recurring_invoice_number + 1;
        }
        else
        {
            $recurring_invoice_number = 1;
        }

        $recurring_invoice_number     = str_pad($recurring_invoice_number, 6, '0', STR_PAD_LEFT);

        return view('recurringinvoices::create', compact('customers', 'recurring_invoice_number', 'agents','account', 'item_category', 'accounts', 'delivery_persons'));
    }

    public function store(Request $request)
    {   
         $validatiolist = [
             'customer_id'          => 'required',
             'invoice_date'         => 'required',
             'item_id.*'            => 'required',
             'quantity.*'           => 'required',
             'rate.*'               => 'required',
             'amount.*'             => 'required',
             'account_id'           => 'required',
             'item_category_id'     => 'required',
             'item_sub_category_id' => 'required',
         ];

         if($request->check_payment)
         {
             $validatiolist["payment_account"]       = "required";
             $validatiolist["payment_amount"]        = "required||numeric";

         }

         $payment                =  new Payment();


         $this->validate($request, $validatiolist);
         DB::beginTransaction();
         try
        {  

            $data                           = $request->all();
            $user_id                        = Auth::user()->id;
            
            $recurring_invoices       = RecurringInvoice::count();

            if($recurring_invoices > 0)
            {
                $recurring_invoice         = RecurringInvoice::orderBy('created_at', 'desc')->first();
                $recurring_invoice_number  = $recurring_invoice['recurring_invoice_number'];
                $recurring_invoice_number  = $recurring_invoice_number + 1;
            }
            else
            {
               $recurring_invoice_number = 1;
            }

             $recurring_invoice_number     = str_pad($recurring_invoice_number, 6, '0', STR_PAD_LEFT);
            $recurring_invoice                                  = new RecurringInvoice ;
            $recurring_invoice->recurring_invoice_number        = $recurring_invoice_number;
            $recurring_invoice->invoice_date                    = $data['invoice_date'];
            $recurring_invoice->reference                       = $data['reference'];
            $recurring_invoice->customer_note                   = $data['customer_note'];
            $recurring_invoice->personal_note                   = $data['personal_note'];
            $recurring_invoice->tax_total                       = $data['tax_total'];
            $recurring_invoice->shipping_charge                 = $data['shipping_charge'];
            $recurring_invoice->adjustment                      = $data['adjustment'];
            $recurring_invoice->total_amount                    = $data['total_amount'];
            $recurring_invoice->item_category_id                = $data['item_category_id'];
            $recurring_invoice->item_sub_category_id            = $data['item_sub_category_id'];
            $recurring_invoice->due_amount                      = $data['total_amount'];
            $recurring_invoice->delivery_person                 = empty($data['delivery_person_id']) ? null : $data['delivery_person_id'];
            $recurring_invoice->receive_person                  = empty($data['receive_person_id']) ? null : $data['receive_person_id'];
            $recurring_invoice->receive_date                    = empty($data['receive_date']) ?  null  : date("Y-m-d", strtotime($data['receive_date']));
            $recurring_invoice->no_of_installment               = $data['no_of_installment'];
            $recurring_invoice->day_interval                    = $data['day_interval'];
            $recurring_invoice->start_date                      = $data['start_date'];
            if($request->save)
            {
                $recurring_invoice->save              = 1;
            }

            $recurring_invoice->customer_id           = $data['customer_id'];
            $recurring_invoice->created_by            = $user_id;
            $recurring_invoice->updated_by            = $user_id;
            if($data['commission_type'] && $data['agent_id'] && $data['agentcommissionAmount'])
            {
                $recurring_invoice->agents_id                 = $data['agent_id'];
                $recurring_invoice->agentcommissionAmount     = $data['agentcommissionAmount'];
                $recurring_invoice->commission_type           = $data['commission_type'];

            }
            else
            {
                $recurring_invoice->agents_id                 = empty($data['agent_id']) ? null : $data['agent_id'];
            }
            if($recurring_invoice->save())
            {
                
                $i                                 = 0;

                foreach($data['item_id'] as $account)
                {
                    if(!$data['discount'][$i])
                    {

                        $recurring_invoice_entry[] = [
                            'quantity'          => $data['quantity'][$i],
                            'rate'              => $data['rate'][$i],
                            'description'       => $data['description'][$i],
                            'amount'            => $data['amount'][$i],
                            'discount'          => 0,
                            'discount_type'     => 0,
                            'item_id'           => $data['item_id'][$i],
                            'recurring_invoice_id' => $recurring_invoice->id,
                            'tax_id'            => 1,
                            'account_id'        => $data['account_id'][$i],
                            'created_by'        => $user_id,
                            'updated_by'        => $user_id,
                            'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                         ];

                    }
                    else 
                    {
                        $recurring_invoice_entry[] = [
                                'quantity'          => $data['quantity'][$i],
                                'rate'              => $data['rate'][$i],
                                'description'       => $data['description'][$i],
                                'amount'            => $data['amount'][$i],
                                'discount'          => $data['discount'][$i],
                                'discount_type'     => $data['discount_type'][$i],
                                'item_id'           => $data['item_id'][$i],
                                'recurring_invoice_id'        => $invoice_id,
                                'tax_id'            => 1,
                                'account_id'        => $data['account_id'][$i],
                                'created_by'        => $user_id,
                                'updated_by'        => $user_id,
                                'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                                'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        ];

                    }

                    if($data['discount'][$i] == 1)
                    {
                        $data['discount'][$i]   = ($data['discount'][$i] * $data['quantity'][$i] * 100) / $data['rate'][$i];
                    }

                    $i++;

                 }

                 if(DB::table('recurring_invoice_entries')->insert($recurring_invoice_entry))
                {
                    

                }


        }
            DB::commit();
                       return redirect()
                              ->route('recurring_invoices_index')
                              ->with('alert.status', 'success')
                              ->with('alert.message', 'Invoice Added Successfully!');

         }
        catch(\Exception $e)
        {
              DB::rollback();
               dd($e);
             $mesg = $e->getMessage();

             return redirect()
                       ->back()
                       ->with('alert.status', 'delete')
                       ->with('alert.message', " $mesg");
        }
    }

    public function show($id)
    {
        $recurring_invoices                           = [];

        try{
            $branch_id      = session('branch_id');
            $this->getBranchUsers($branch_id);

            $recurring_invoice                        = RecurringInvoice::find($id);

            if(!$recurring_invoice)
            {
                return back()->with('alert.status', 'warning')->with('alert.message', 'Recurring Invoice not found!');
            }

            $recurring_invoices                       = RecurringInvoice::orderBy('invoice_date', 'desc')->take(20)->get()->toArray();
            $sort                           = new sortBydate();


            if ($branch_id == 1)
            {
               $recurring_invoices                    = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $recurring_invoices);
            }
            else
            {
                $recurring_invoices                   = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $recurring_invoices);
                $recurring_invoices                   = $invoices->whereIn('created_by', $this->targeted_users);

            }

            $recurring_invoices_entries                = RecurringInvoiceEntry::where('recurring_invoice_id', $id)->get();
            $invoice_discount_count                    = RecurringInvoiceEntry::where([['recurring_invoice_id', '=', $id], ['discount', '!=', 0]])->count();


            $sub_total                      = 0;
            $OrganizationProfile            = OrganizationProfile::find(1);
   
            foreach ($recurring_invoices_entries as $invoice_entry)
            {
                $sub_total                  = $sub_total + $invoice_entry->amount;
            }
            return view('recurringinvoices::show', compact('recurring_invoices','recurring_invoice', 'recurring_invoices_entries', 'sub_total', 'recurring_invoices',  'OrganizationProfile', 'invoice_discount_count'));

        }

        catch (\Exception $exception){

            return back()->with('alert.status', 'delete')->with('alert.message', 'Recurring Invoice not found!');

        }
    }

    public function edit(Request $request,$id)
    {  

        $show_all_contact         = OrganizationProfile::first();
        $recurring_invoice_entry  = RecurringInvoiceEntry::where('recurring_invoice_id', $id)->get();
        $item_category            = ItemCategory::orderBy('item_category_name', 'ASC')->get();
        $branch_id                = session('branch_id');
        $delivery_persons         = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                            ->where('contact_category_id', 3)
                                            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id)
                                            {
                                                return $query->where('users.branch_id', '=', $branch_id);
                                            })
                                            ->get()
                                            ->sortBy('display_name');

        $account                = Account::all();

        $customers              = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                        ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', '=', $branch_id);
                                            })
                                        ->select('contact.*')
                                        ->get();

        $agents                 = $customers;
        $recurring_invoice                = RecurringInvoice::find($id);

        $recurring_invoice_shipincaharg   = $recurring_invoice->shipping_charge;
        $recurring_invoice_adjustment     = $recurring_invoice->adjustment;
        $recurring_invoice_tax_total      = $recurring_invoice->tax_total;
        $recurring_invoice_total_amount   = $recurring_invoice->total_amount;
        $sub_total                        = $recurring_invoice_total_amount -$recurring_invoice_shipincaharg  -$recurring_invoice_tax_total ;

        $tax                             = $sub_total == 0 ? 0 : (($recurring_invoice_tax_total) *100)/($sub_total);
           
        $checkAccess = $this->checkIfUserHasAccess($recurring_invoice);

        if($checkAccess == 1){
            return back();
        }

        return view('recurringinvoices::edit', compact('account','customers', 'recurring_invoice', 'agents', 'item_category', 'recurring_invoice_entry', 'delivery_persons', 'tax'));
    }

    public function update(Request $request, $id)
    {
           $validatiolist = [
             'customer_id'          => 'required',
             'invoice_date'         => 'required',
             'item_id.*'            => 'required',
             'quantity.*'           => 'required',
             'rate.*'               => 'required',
             'amount.*'             => 'required',
             'account_id'           => 'required'
         ];

          


            $data                           = $request->all();
            $recurring_invoice               =  RecurringInvoice::findOrfail($id);

            $total_received_payment         = $recurring_invoice->total_amount - $recurring_invoice->due_amount;

            if($data['total_amount'] >= $total_received_payment)
            {

                $recurring_invoice->due_amount        = $data['total_amount'] - $total_received_payment;
            }
            else
            {

                return redirect()
                    ->route('recurring_invoices_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry! Invoice Total Amount cannot be smaller than Total Received Payment.');
            }


            $user_id                        = Auth::user()->id;

            // $helper                         = new \App\Lib\Helpers;
            // $helper->updateItemAfterUpdatingInvoice($data);

            //Update
            $created_by                     = $recurring_invoice->created_by;
            $created_at                     = $recurring_invoice->created_at->toDateTimeString();
            $updated_at                     = \Carbon\Carbon::now()->toDateTimeString();

             $recurring_invoice->recurring_invoice_number        = $recurring_invoice->recurring_invoice_number;
             $recurring_invoice->invoice_date                    = $data['invoice_date'];
             $recurring_invoice->reference                       = $data['reference'];
             $recurring_invoice->customer_note                   = $data['customer_note'];
             $recurring_invoice->personal_note                   = $data['personal_note'];
             $recurring_invoice->tax_total                       = $data['tax_total'];
             $recurring_invoice->shipping_charge                 = $data['shipping_charge'];
             $recurring_invoice->adjustment                      = $data['adjustment'];
             $recurring_invoice->total_amount                    = $data['total_amount'];
             $recurring_invoice->item_category_id                = $recurring_invoice->item_category_id;
             $recurring_invoice->item_sub_category_id            = $recurring_invoice->item_sub_category_id;
             $recurring_invoice->due_amount                      = $data['total_amount'];
             $recurring_invoice->delivery_person                 = empty($data['delivery_person_id']) ? null : $data['delivery_person_id'];
             $recurring_invoice->receive_person                  = empty($data['receive_person_id']) ? null : $data['receive_person_id'];
             $recurring_invoice->receive_date                    = empty($data['receive_date']) ?  null  : date("Y-m-d", strtotime($data['receive_date']));
             $recurring_invoice->no_of_installment               = $data['no_of_installment'];
             $recurring_invoice->day_interval                    = $data['day_interval'];
             $recurring_invoice->start_date                      = $data['start_date'];
              if($data['commission_type'] && $data['agent_id'] && $data['agentcommissionAmount'])
             {
                 $recurring_invoice->agents_id                 = $data['agent_id'];
                 $recurring_invoice->agentcommissionAmount     = $data['agentcommissionAmount'];
                 $recurring_invoice->commission_type           = $data['commission_type'];

             }
             else{
                  $recurring_invoice->agents_id                 = empty($data['agent_id']) ? null : $data['agent_id'];
             }

            $recurring_invoice_entry_update                      = [];

            if($recurring_invoice->update())
            {

                $recurring_invoice_entry                  = RecurringInvoiceEntry::where('recurring_invoice_id',$id)->delete();

                if($recurring_invoice_entry) 
                {

                }

                $i = 0;

                foreach($data['item_id'] as $account) 
                {

                    if(!$data['discount'][$i]) {

                        $recurring_invoice_entry_update[] = [
                            'quantity'              => $data['quantity'][$i],
                            'rate'                  => $data['rate'][$i],
                            'description'           => $data['description'][$i],
                            'amount'                => $data['amount'][$i],
                            'discount'              => 0,
                            'discount_type'         => 0,
                            'item_id'               => $data['item_id'][$i],
                            'recurring_invoice_id'            => $id,
                            'tax_id'                => 1,
                            'account_id'            => $data['account_id'][$i],
                            'created_by'            => $created_by,
                            'updated_by'            => $user_id,
                            'created_at'            => $created_at,
                            'updated_at'            => $updated_at,
                        ];
                    }else {

                        $recurring_invoice_entry_update[] = [
                            'quantity'              => $data['quantity'][$i],
                            'rate'                  => $data['rate'][$i],
                            'description'           => $data['description'][$i],
                            'amount'                => $data['amount'][$i],
                            'discount'              => $data['discount'][$i],
                            'discount_type'         => $data['discount_type'][$i],
                            'item_id'               => $data['item_id'][$i],
                            'recurring_invoice_id'            => $id,
                            'tax_id'                => 1,
                            'account_id'            => $data['account_id'][$i],
                            'created_by'            => $created_by,
                            'updated_by'            => $user_id,
                            'created_at'            => $created_at,
                            'updated_at'            => $updated_at,
                        ];

                    }

                    if($data['discount_type'][$i] == 1) {
                        $data['discount'][$i]       = $data['discount'][$i];
                    }else{
                        $data['discount'][$i]       = $data['discount'][$i];
                    }

                    $i++;
                }
               
                if(DB::table('recurring_invoice_entries')->insert($recurring_invoice_entry_update))
                {

                    // $this->updateManualJournalEntries($data, $id);
                }

                    DB::commit();

                    return redirect()
                        ->route('recurring_invoices_index')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Recurring Invoice Updated Successfully!');

            }
    }


    public function destroy($id)
    {

        $recurring_invoice        = RecurringInvoice::find($id);

        $checkAccess    = $this->checkIfUserHasAccess($recurring_invoice);

        if($checkAccess == 1){
            return back();
        }


        if($recurring_invoice)
        {
            $recurring_invoice              = RecurringInvoice::where('id', $id)->delete();
            $recurring_invoice_entry        = RecurringInvoiceEntry::where('recurring_invoice_id', $id)->delete();
           
                return redirect()
                        ->route('recurring_invoices_index')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Recurring Invoice deleted successfully!!!');
                       
        }
    }

    public function insertManualJournalEntries($data,$recurring_invoice)
    {

        $user_id                = Auth::user()->id;

        $i                      = 0;
        $discount               = 0;
        $account_array          = array_fill(1, 100, 0);

        foreach ($data['item_id'] as $account)
        {
            if($data['discount'][$i] == "")
            {

            }
            else
            {
                $amount         = $data['quantity'][$i] * $data['rate'][$i];

                if($data['discount_type'][$i] == 1){

                    $discount   = $discount + $data['discount'][$i];

                }else{

                    $discount   = $discount + ($data['discount'][$i] * $amount) / 100;

                }

            }

            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i] * $data['rate'][$i]);

            $i++;

        }

        //return $account_array;
        $recurring_invoice             = $recurring_invoice;

        //insert total amount as debit
        $journal_entry                  = new JournalEntry;
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = $data['total_amount'];
        $journal_entry->account_name_id = 5;
        $journal_entry->jurnal_type     = "recurring_invoice";
        $journal_entry->recurring_invoice_id      = $recurring_invoice;
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

        if($journal_entry->save())
        {

        }
        else
        {
            //delete all journal entry for this invoice...
            $invoice                    = Invoice::find($recurring_invoice);
            $invoice->delete();
            return false;
        }

        //insert discount as credit
        if($discount > 0)
        {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $discount;
            $journal_entry->account_name_id = 21;
            $journal_entry->jurnal_type     = "recurring_invoice";
            $journal_entry->recurring_invoice_id      = $recurring_invoice;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice                   = Invoice::find($recurring_invoice);
                $invoice->delete();
                return false;
            }
        }


        //insert tax total as credit
        if($data['tax_total'] > 0)
        {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['tax_total'];
            $journal_entry->account_name_id = 9;
            $journal_entry->jurnal_type     = "recurring_invoice";
            $journal_entry->recurring_invoice_id      = $recurring_invoice;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice                   = Invoice::find($recurring_invoice);
                $invoice->delete();
                return false;
            }
        }

        //insert shipping charge as credit
        if($data['shipping_charge'] > 0)
        {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['shipping_charge'];
            $journal_entry->account_name_id = 20;
            $journal_entry->jurnal_type     = "recurring_invoice";
            $journal_entry->recurring_invoice_id      = $recurring_invoice;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice                   = Invoice::find($recurring_invoice);
                $invoice->delete();
                return false;
            }
        }


        //insert adjustment as credit
        if($data['adjustment'] != 0)
        {
            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = $data['customer_note'];

            if($data['adjustment'] > 0)
            {
                $journal_entry->debit_credit    = 0;
            }
            else
            {
                $journal_entry->debit_credit    = 1;
            }

            $journal_entry->amount              = abs($data['adjustment']);
            $journal_entry->account_name_id     = 18;
            $journal_entry->jurnal_type         = "recurring_invoice";
            $journal_entry->recurring_invoice_id          = $recurring_invoice;
            $journal_entry->contact_id          = $data['customer_id'];
            $journal_entry->created_by          = $user_id;
            $journal_entry->updated_by          = $user_id;
            $journal_entry->assign_date         = date('Y-m-d', strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice                        = Invoice::find($recurring_invoice);
                $invoice->delete();

                return false;
            }
        }


        //return $account_array;
        $recurring_invoice_entry                          = [];

        for($j = 1; $j<count($account_array)-2; $j++) {

            if($account_array[$j] != 0)
            {
                $recurring_invoice_entry[] = [
                    'note'              => $data['customer_note'],
                    'debit_credit'      => 0,
                    'amount'            => $account_array[$j],
                    'account_name_id'   => $j,
                    'jurnal_type'       => 'recurring_invoice',
                    'recurring_invoice_id'        => $recurring_invoice,
                    'contact_id'        => $data['customer_id'],
                    'created_by'        => $user_id,
                    'updated_by'        => $user_id,
                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'assign_date'       => date('Y-m-d', strtotime($data['invoice_date'])),
                ];

            }

        }

        if(DB::table('journal_entries')->insert($recurring_invoice_entry))
        {
            return true;
        }
        else
        {
            //delete all journal entry for this invoice...
            $invoice                = Invoice::find($recurring_invoice);
            $invoice->delete();

            return false;
        }

            return false;
    }

    public function updateManualJournalEntries($data, $id)
    {

        $invoice_entries_delete = JournalEntry::where('recurring_invoice_id',$id)->delete();

        if($invoice_entries_delete)
        {

        }

        $user_id = Auth::user()->id;
        $i = 0;
        $discount = 0;
        $account_array = array_fill(1, 100, 0);

        foreach ($data['item_id'] as $account)
        {

            if($data['discount'][$i] == "")
            {
                $amount = $data['quantity'][$i]*$data['rate'][$i];
                $discount = $discount + (0*$amount)/100;
                $discount1 = ($data['discount'][$i]*$amount)/100;
            }
            else
            {
                $amount = $data['quantity'][$i]*$data['rate'][$i];

                if($data['discount_type'][$i] == 1){
                    $discount = $discount+($data['discount'][$i] * $data['quantity'][$i]);
                }else{
                    $discount = $discount + ($data['discount'][$i]*$amount)/100;
                }

                $discount1 = ($data['discount'][$i]*$amount)/100;
            }

            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i]*$data['rate'][$i]);

            $i++;
        }


        //insert total amount as debit
        $journal_entry = new JournalEntry;
        $journal_entry->note                = $data['customer_note'];
        $journal_entry->debit_credit          = 1;
        $journal_entry->amount                 = $data['total_amount'];
        $journal_entry->account_name_id          = 5;
        $journal_entry->jurnal_type               = "recurring_invoice";
        $journal_entry->recurring_invoice_id      = $id;
        $journal_entry->contact_id               = $data['customer_id'];
        $journal_entry->created_by              = $user_id;
        $journal_entry->updated_by           = $user_id;
        $journal_entry->assign_date         = date('Y-m-d',strtotime($data['invoice_date']));

        if($journal_entry->save())
        {

        }
        else
        {
            //delete all journal entry for this invoice...
        }

        //insert discount as credit
        if($discount>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit              = 1;
            $journal_entry->amount                    = $discount;
            $journal_entry->account_name_id           = 21;
            $journal_entry->jurnal_type               = "recurring_invoice";
            $journal_entry->recurring_invoice_id      = $id;
            $journal_entry->contact_id                = $data['customer_id'];
            $journal_entry->created_by                = $user_id;
            $journal_entry->updated_by                = $user_id;
            $journal_entry->assign_date               = date('Y-m-d',strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
            }
        }


        //insert tax total as debit
        if($data['tax_total']>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note                      = $data['customer_note'];
            $journal_entry->debit_credit              = 0;
            $journal_entry->amount                    = $data['tax_total'];
            $journal_entry->account_name_id           = 9;
            $journal_entry->jurnal_type               = "recurring_invoice";
            $journal_entry->recurring_invoice_id      = $id;
            $journal_entry->contact_id                = $data['customer_id'];
            $journal_entry->created_by                = $user_id;
            $journal_entry->updated_by                = $user_id;
            $journal_entry->assign_date               = date('Y-m-d',strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
            }
        }


        //insert shipping charge as credit
        if($data['shipping_charge']>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note                       = $data['customer_note'];
            $journal_entry->debit_credit               = 0;
            $journal_entry->amount                     = $data['shipping_charge'];
            $journal_entry->account_name_id            = 20;
            $journal_entry->jurnal_type                = "recurring_invoice";
            $journal_entry->recurring_invoice_id       = $id;
            $journal_entry->contact_id                 = $data['customer_id'];
            $journal_entry->created_by                 = $user_id;
            $journal_entry->updated_by                 = $user_id;
            $journal_entry->assign_date                = date('Y-m-d',strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
            }
        }


        //insert adjustment as credit
        if($data['adjustment'] != 0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            if($data['adjustment']>0)
            {
                $journal_entry->debit_credit    = 0;
            }
            else
            {
                $journal_entry->debit_credit    = 1;
            }
            $journal_entry->amount                    = abs($data['adjustment']);
            $journal_entry->account_name_id           = 18;
            $journal_entry->jurnal_type               = "recurring_invoice";
            $journal_entry->recurring_invoice_id      = $id;
            $journal_entry->contact_id                = $data['customer_id'];
            $journal_entry->created_by                = $user_id;
            $journal_entry->updated_by                = $user_id;
            $journal_entry->assign_date               = date('Y-m-d',strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
            }
        }


        //return $account_array;

        $invoice_entry = [];
        for($j = 1; $j<count($account_array)-2; $j++) {
            if ($account_array[$j] != 0)
            {
                $invoice_entry[] = [
                    'note'                        => $data['customer_note'],
                    'debit_credit'                => 0,
                    'amount'                      => $account_array[$j],
                    'account_name_id'             => $j,
                    'jurnal_type'                 => 'invoice',
                    'recurring_invoice_id'        => $id,
                    'contact_id'                  => $data['customer_id'],
                    'created_by'                  => $user_id,
                    'updated_by'                  => $user_id,
                    'created_at'                  => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'                  => \Carbon\Carbon::now()->toDateTimeString(),
                    'assign_date'                 =>date('Y-m-d',strtotime($data['invoice_date'])),
                ];

            }
        }

        if (DB::table('journal_entries')->insert($invoice_entry))
        {
            return "successfull...";
        }
        else
        {
        //delete all journal entry for this invoice...
        }

        return "error";
    }

    public function useCredit(Request $request)
    {
        $data = $request->all();
        $i = 0;
        foreach ($data['credit_amount'] as $credit_amount)
        {
            if($credit_amount)
            {
                $credit_note = CreditNote::find($data['credit_note_id'][$i]);
                $credit_note->available_credit = ($credit_note['available_credit'] - $credit_amount);
                $credit_note->update();

                $invoice = Invoice::find($data['invoice_id']);
                $invoice->due_amount = $invoice['due_amount'] - $credit_amount;
                $invoice->update();

            }
            $i++;
        }
        $user_id = Auth::user()->id;

        $credit_note_payment_entry = [];
        for($i = 0; $i < count($data['credit_amount']); $i++) {
            if (!$data['credit_amount'][$i])
            {
                continue;
            }

            $credit_note_payment_entry[] = [
                'amount'            => $data['credit_amount'][$i],
                'invoice_id'        => $data['invoice_id'],
                'credit_note_id'    => $data['credit_note_id'][$i],
                'created_by'        => $user_id,
                'updated_by'        => $user_id,
                'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
            ];
        }

        if (DB::table('credit_note_payments')->insert($credit_note_payment_entry))
            {
                return redirect()
                ->route('invoice_show', ['id' => $data['invoice_id']])
                ->with('alert.status', 'success')
                ->with('alert.message', 'Credit notes used successfully!');
            }

            return redirect()
            ->route('invoice_show', ['id' => $data['invoice_id']])
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Something went to wrong! please check your input field!!!');
    }

  

    public function checkIfUserHasAccess($recurring_invoices)
    {

        $user_branch    = Auth::user()->branch_id;

        if($recurring_invoices->createdBy->branch_id != $user_branch && $user_branch != 1){
            return 1;
        }
    }

    public function itemCaegory($id)
    {
        $data = ItemSubCategory::where('item_category_id',$id)->get();

        return response($data);
    }

    public function itemList($id)
    {
        $data = Item::where('item_sub_category_id',$id)->get();

        return response($data);
    }

    public function itemListStockSerial()
    {
       $data = Item::select('id', 'item_name', 'barcode_no')->get();

       return response($data);
    }

    public function checkSerial($serial)
    {
         $item_id            = 0;
         $item_serial        = "";
         $item_sales_rate    = 0;
         $message            = "";

         $serial_entry       = StockSerial::where('serial', $serial)->where('invoice_id', null)->first();

         if($serial_entry){

             $item_id            = $serial_entry->item_id;
             $item_sales_rate    = $serial_entry->item->item_sales_rate > 0 ? $serial_entry->item->item_sales_rate : 0;
             $item_serial        = $serial;

         }else{

             $message            = "Serial was not found or already sold. Please try again.";

         }

         return response()->json([
             'item_id'           =>  $item_id,
             'item_serial'       =>  $item_serial,
             'item_sales_rate'   =>  $item_sales_rate,
             'message'           =>  $message,
         ], 201);
    }

    public function itemRate($id)
    {
      $data = Item::where('id',$id)->first();

      return response($data);
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

}
