<?php

namespace App\Modules\Billsubmit\Http\Controllers;

use App\Lib\sortBydate;
use App\Models\AccountChart\Account;
use App\Models\Branch\Branch;
use App\Models\Flightnew\Confirmation;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\Manpower\Manpower_service;
use App\Models\Recruit\Recruitorder;
use App\Modules\Bill\Http\Response\Payment;
use Dompdf\Exception;
use Illuminate\Support\Facades\App;
use Validator;
use App\Models\Visa\Ticket\Order\Order;
use App\Models\Visa\Visa;
use Illuminate\Http\Request;



use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Moneyin\Invoice;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\Journal;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\ExcessPayment;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNote;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillPax;
use App\Models\MoneyOut\BillEntry;
use App\Models\MoneyOut\Expense;
use App\Models\MoneyOut\PaymentMade;
use App\Models\MoneyOut\PaymentMadeEntry;
use App\Models\Recruit\RecruiteExpensePax;
use App\Models\Recruit\RecruitExpense;
use App\Models\MoneyOut\BillDueTable;

//For currency start
use App\Models\Setting\Currency\SettingCurrency;
use App\Models\Setting\Currency\SettingCurrencyRate;
use App\User;
use Response;
//For currency end
//bill submit start
use App\Models\BillSubmit\BillSubmit;
use App\Models\BillSubmit\BillSubmitEntry;
use App\Models\BillSubmit\BillSubmitPax;
//bill submit end
use App\Models\BillSubmit\BillSubmitDueDate;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemSubCategory;

class PendingBillController extends Controller
{     private $branch_id              = 0;
      protected $increasing_limit     = null;
      private $targeted_users         = [];
    public function index(Request $request)
    {
        $auth_id      = Auth::id();
        $branch_id    = session('branch_id');
        $branchs      = Branch::orderBy('id','asc')->get();
        $sort         = new sortBydate();
        $condition    = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";

        $branch_data  = Branch::find($branch_id);


        $bills  = [];
        $date   = "bill_date";

        if($branch_id==1)
        {
            if($request->due){
                $bills = BillSubmit::where('due_amount','!=',0)->where('bill_submit.status', '=', 0)->get()->toArray();
            }
            else
            {
                $bills = BillSubmit::whereRaw($condition)->where('bill_submit.status', '=', 0)->get()->toArray();
            }

           try{
               $bills = $sort->get('\App\Models\BillSubmit\BillSubmit', $date, 'Y-m-d', $bills);


               return view('billsubmit::pendingBill.index', compact('bills', 'branchs', 'branch_currency', 'currency_rate_data'));

           }catch (\Exception $exception){

               $bills = collect($bills);

               return view('billsubmit::pendingBill.index', compact('bills', 'branchs', 'branch_currency', 'currency_rate_data'));
           }

        }
        else
        {
            $bills = BillSubmit::whereRaw($condition)
                           ->join('users','users.id','=','bill_submit.created_by')
                           ->where('users.branch_id',$branch_id)
                           ->where('bill_submit.status', '=', 0)
                           ->select('bill_submit.*')
                           ->get()
                           ->toArray();

            $date = "bill_date";

            try{

                $bills = $sort->get('\App\Models\BillSubmit\BillSubmit', $date, 'Y-m-d', $bills);


                return view('billsubmit::pendingBill.index', compact('bills', 'branchs', 'branch_currency', 'currency_rate_data'));

            }catch (\Exception $exception){

                return view('billsubmit::pendingBill.index', compact('bills', 'branchs', 'branch_currency', 'currency_rate_data'));
            }

        }
    }

    public function search(Request $request)
    {
        $branchs    = Branch::orderBy('id','asc')->get();
        $branch_id  =  $request->branch_id;

        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }

        $from_date  =  date('Y-m-d',strtotime($request->from_date));
        $to_date    =  date('Y-m-d',strtotime($request->to_date));
        $condition  = "str_to_date(bill_date, '%Y-%m-%d') between '$from_date' and '$to_date'";

        //branch currency wise amount calculation start
        $branch_data                = Branch::find($branch_id);

        if ($branch_data->setting_currencies_id != null)
        {
            $currency_rate_data     = SettingCurrencyRate::where('currency_id', $branch_data->currency->id)->orderBy('created_at', 'DESC')->first();
            $branch_currency        = $currency_rate_data->conversion_rate;
        }else{
            $branch_currency        = 0;
        }
        //branch currency wise amount calculation end

        $bills      = [];

        if($branch_id==1){

            $bills = BillSubmit::whereRaw($condition)->where('bill_submit.status', '=', 0)->select(DB::raw('bill_submit.*'))->get()->toArray();

        }else{

            $bills = BillSubmit::whereRaw($condition)->where('bill_submit.status', '=', 0)->select(DB::raw('bill_submit.*'))->join('users','users.id','=','bill.created_by')->where('branch_id',$branch_id)->get()->toArray();

        }

        $date   = "date";
        $sort   = new sortBydate();

        try{

            $bills= $sort->get('\App\Models\BillSubmit\BillSubmit',$date,'Y-m-d',$bills);

            return view('billsubmit::pendingBill.index', compact('bills','branchs','branch_id','from_date','to_date', 'branch_currency', 'currency_rate_data'));

        }catch (\Exception $exception){

            return view('billsubmit::pendingBill.index', compact('bills','branchs','branch_id','from_date','to_date', 'branch_currency', 'currency_rate_data'));
        }
    }

    public function show($id)
    {
        $branch_id      = session('branch_id');
        $this->getBranchUsers($branch_id);
        if($branch_id ==1)
        $customers      = Contact::all();
        else
        $customers      = Contact::whereIn('created_by',$this->targeted_users)->get();
        $bill           = BillSubmit::find($id);


        $accounts       = Account::all();
        $due_bill_sub   = BillSubmitDueDate::where('bill_submit_id', $id)->get();
        $bill_entry     = BillSubmitEntry::where('bill_id', $id)->get();
        $item_category  = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
                                                            return $query->where('branch_id', '=', $branch_id);
                                                        })
                                                        ->orderBy('item_category_name', 'ASC')
                                                        ->get();

        return view('billsubmit::pendingBill.show', compact('customers', 'bill', 'due_bill_sub', 'bill_entry', 'item_category', 'accounts'));
    }

    public function update(Request $request, $id)
    {
      if(isset($request->approve))
      {
        $bill_submit_data       = BillSubmit::find($id);
        $bill_submit_entry_data = BillSubmitEntry::where('bill_id', '=', $id)->get();

        DB::beginTransaction();

        $this->validate($request, [
            'customer_id'          => 'required',
            'bill_date'            => 'required',
            //'due_date'             => 'required',
            'item_id.*'            => 'required',
            'quantity.*'           => 'required',
            'rate.*'               => 'required',
            'amount.*'             => 'required',
            'account_id'           => 'required',
            'item_category_id'     => 'required',
            'item_sub_category_id' => 'required',
        ]);

        $data                           = $request->all();
        $user_id                        = Auth::user()->id;
        $helper                         = new \App\Lib\Helpers;

        $bills                          = Bill::count();

        if($bills > 0)
        {
            $bill                       = Bill::orderBy('created_at', 'desc')->first();
            $bill_number                = $bill['bill_number'];
            $bill_number                = $bill_number + 1;
        }
        else
        {
            $bill_number                = 1;
        }

        $bill_number                    = str_pad($bill_number, 6, '0', STR_PAD_LEFT);

        try{

            $tax_total                  = $data['tax_total'];

            $total_amount               = $data['total_amount'];

            $bill                       = new Bill;

            if($request->hasFile('file1'))
            {
                $file                   = $request->file('file1');
                $file_name              = $file->getClientOriginalName();
                $without_extention      = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention         = $file->getClientOriginalExtension();
                $num                    = rand(1, 500);
                $new_file_name          = $without_extention . $request->bill_number . '.' . $file_extention;
                $success                = $file->move('uploads/bill', $new_file_name);

                if($success)
                {
                    $bill->file_url     = 'uploads/bill/' . $new_file_name;
                    $bill->file_name    = $new_file_name;
                }

            }

            $bill->order_number             = $data['order_number'];
            $bill->bill_number              = $bill_number;
            $bill->adjustment               = $data['adjustment'];
            $bill->amount                   = $total_amount;
            $bill->due_amount               = $total_amount;
            $bill->bill_date                = date("Y-m-d", strtotime($data['bill_date']));
            $bill->note                     = $data['customer_note'];
            $bill->total_tax                = $tax_total;
            $bill->vendor_id                = $data['customer_id'];
            $bill->item_category_id         = $data['item_category_id'];
            $bill->item_sub_category_id     = $data['item_sub_category_id'];
            $bill->created_by               = $user_id;
            $bill->updated_by               = $user_id;
            $bill->no_of_installment      = $data['no_of_installment'];
            $bill->day_interval           = $data['time_interval'];
            $bill->start_date             = $data['start_date'];

            if($bill->save())
            {

                $i                      = 0;
                $bill_entry             = [];
                $bill_id                = $bill['id'];

                //payment made
                    if($request->check_payment && $request->submit)
                    {
                        $payment            = new Payment();
                        $newpayment         = $payment->makePaymentMade($request, $bill_id);

                        $bill->due_amount   = $bill->due_amount - $newpayment['amount'];
                        $bill->save();

                    }
                //end payment made

                foreach($data['item_id'] as $item)
                {

                    $bill_entry[]           = [

                        'quantity'          => $data['quantity'][$i],
                        'rate'              => $data['rate'][$i],
                        'amount'            => $data['amount'][$i],
                        'item_id'           => $data['item_id'][$i],
                        'description'       => $data['description'][$i],
                        'bill_id'           => $bill_id,
                        'tax_id'            => 1,
                        'account_id'        => $data['account_id'][$i],
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),

                    ];

                    $i++;

                }

                if(DB::table('bill_entry')->insert($bill_entry))
                {

                    $this->insertBillInJournalEntries($data, $bill_id);
                    $helper->updateItemAfterCreatingBill($data, $bill_id, $user_id);
                    $due_date = $request->due_date;
                    $due_amount = $request->amount_val;
                    foreach($due_amount as $key=>$value)
                    {
                      if( $value !=0 || ($key == 0 && count($due_amount) ==1  ))
                    {
                      $due_invoice              = new BillDueTable;
                      $due_invoice->bill_id     = $bill_id;
                      $due_invoice->due_date    = $due_date[$key];
                      $due_invoice->due_amount  = $value ? $value : 0 ;
                      $due_invoice->created_by  = Auth::user()->id;
                      $due_invoice->updated_by  = Auth::user()->id;
                      $due_invoice->save();
                    }
                    }
                        DB::commit();
                        $bill_submit_data       = BillSubmit::find($id);
                        $bill_submit_entry_data = BillSubmitEntry::where('bill_id', '=', $id)->get();

                        BillSubmit::where('id',$id)->delete();
                        BillSubmitEntry::where('bill_id', $id)->delete();
                        BillSubmitDueDate::where('bill_submit_id', $id)->delete();

                        return redirect()->route('bill_submit')
                                              ->with('alert.status', 'success')
                                              ->with('alert.message', 'Bill has been save');


                    }
                }

                throw new \Exception("bill creation fail");
            }
            catch(\Exception $ex)
            {
                DB::rollback();
                $msg = $ex->getMessage();
                return redirect()->route('bill_submit')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', "Fail : $msg");
            }
          }
        if(isset($request->reject))
        {
            $dat                    = BillSubmit::find($id);
            $dat->status   = 1;

            if ($dat->save())
            {
                DB::commit();

                return redirect()->route('bill_submit_rejected_bill')
                                 ->with('alert.status', 'success')
                                 ->with('alert.message', 'Bill has been rejected');
            }
            else
            {
                DB::rollback();

                return back()->with('alert.status', 'danger')
                             ->with('alert.message', 'Something went wrong!');
            }
        }
    }

    public function insertBillInJournalEntries($data, $bill_id)
    {
        $user_id    = Auth::user()->id;
        $i          = 0;



        $journal_entry                  = new JournalEntry;

        $journal_entry->debit_credit    = 0;
        $journal_entry->amount          = $data['total_amount'];
        $journal_entry->account_name_id = 11;
        $journal_entry->jurnal_type     = "bill";
        $journal_entry->bill_id         = $bill_id;
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date     = date('Y-m-d',strtotime($data['bill_date']));

        if($journal_entry->save())
        {

        }
        else
        {
            //delete all journal entry for this invoice...
            $bill = Bill::find($bill_id);
            $bill->delete();
            return false;
        }

        if($data['tax_total'] > 0)
        {
            $journal_entry                  = new JournalEntry;


            // if ($data['currency_id'] != null)
            // {
            //     $journal_entry->setting_currencies_id       = $data['currency_id'];
            //     $journal_entry->setting_currency_rates      = $data['setting_currency_rates'];
            // }

            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $data['tax_total'];
            $journal_entry->account_name_id = 9;
            $journal_entry->jurnal_type     = "bill";
            $journal_entry->bill_id         = $bill_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d',strtotime($data['bill_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $bill = Bill::find($bill_id);
                $bill->delete();
                return false;
            }
        }

                $bill_entry = [];
                $i          = 0;
                $bill_id_find       = Bill::orderBy('created_at', 'DESC')->first();
                $bill_entry_find    = BillEntry::where('bill_id', $bill_id_find['id'])->get();


                for($j = 1; $j < count($bill_entry_find); $j++) {

                // if($data['currency_id'] != null){
                //
                //     $bill_entry[] = [
                //         'note'                      => $bill_entry_find[$j]['note'],
                //         'debit_credit'              => 1,
                //         'amount'                    => $bill_entry_find[$j]['amount'],
                //         "setting_currencies_id"     => $bill_entry_find[$j]['currency_id'],
                //         "setting_currency_rates"    => $data['setting_currency_rates'],
                //         'account_name_id'           => $j,
                //         'jurnal_type'               => 'bill',
                //         'bill_id'                   => $bill_id,
                //         'contact_id'                => $bill_entry_find[$j]['customer_id'],
                //         'created_by'                => $user_id,
                //         'updated_by'                => $user_id,
                //         'created_at'                => \Carbon\Carbon::now()->toDateTimeString(),
                //         'updated_at'                => \Carbon\Carbon::now()->toDateTimeString(),
                //         'assign_date'               => date('Y-m-d',strtotime($data['bill_date'])),
                //     ];
                //     $i++;
                // }else{

                    $bill_entry[] = [
                        // 'note'              => $bill_entry_find[$j]['note'],
                        'debit_credit'      => 1,
                        'amount'            => $bill_entry_find[$j]['amount'],
                        'account_name_id'   => $j,
                        'jurnal_type'       => 'bill',
                        'bill_id'           => $bill_id,
                        'contact_id'        => $bill_entry_find[$j]['customer_id'],
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'assign_date'        => date('Y-m-d',strtotime($data['bill_date'])),
                    ];
                    $i++;


        }

        if (DB::table('journal_entries')->insert($bill_entry))
        {
            return true;
        }
        else
        {
            //delete all journal entry for this invoice...
            $bill = Bill::find($bill_id);
            $bill->delete();
            return false;
        }

        return false;
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
