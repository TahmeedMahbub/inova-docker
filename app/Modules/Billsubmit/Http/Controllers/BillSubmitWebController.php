<?php

namespace App\Modules\Billsubmit\Http\Controllers;

use App\Lib\sortBydate;
use App\Models\AccountChart\Account;
use App\Models\Branch\Branch;
use App\Models\Flightnew\Confirmation;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\Manpower\Manpower_service;
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
use App\Models\MoneyOut\BillEntry;
use App\Models\MoneyOut\Expense;
use App\Models\MoneyOut\PaymentMade;
use App\Models\MoneyOut\PaymentMadeEntry;
use App\Models\Recruit\RecruiteExpensePax;
use App\Models\Recruit\RecruitExpense;

//For currency start
use App\Models\Setting\Currency\SettingCurrency;
use App\Models\Setting\Currency\SettingCurrencyRate;
use App\User;
use Response;
//For currency end
//bill submit start
use App\Models\BillSubmit\BillSubmit;
use App\Models\BillSubmit\BillSubmitDueDate;
use App\Models\BillSubmit\BillSubmitEntry;
use App\Models\BillSubmit\BillSubmitPax;
//bill submit end
use App\Models\Setting\RecruitmentSettingsAccounts;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemSubCategory;

class BillSubmitWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function index(Request $request)
    {
        $auth_id      = Auth::id();
        $branch_id    = session('branch_id');
        $branchs      = Branch::orderBy('id','asc')->get();
        $sort         = new sortBydate();
        $condition    = "YEAR(str_to_date(bill_submit.date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(bill_submit.date,'%Y-%m-%d')) = MONTH(CURDATE())";


        $bills  = [];
        $date   = "bill_date";

        if($branch_id == 1)
        {
            $bills  = BillSubmit::whereRaw($condition)
                               ->get()
                               ->toArray();

            $date   = "bill_date";

            try{

                $bills = $sort->get('\App\Models\BillSubmit\BillSubmit', $date, 'Y-m-d', $bills);

                return view('billsubmit::index', compact('bills', 'branchs', 'branch_currency'));
            }
            catch (\Exception $exception)
            {
                return view('billsubmit::index', compact('bills', 'branchs', 'branch_currency'));
            }
        }
        else
        {
            $bills  = BillSubmit::whereRaw($condition)
                               ->join('users','users.id','=','bill_submit.created_by')
                               ->where('users.branch_id',$branch_id)
                               ->select('bill_submit.*')
                               ->get()
                               ->toArray();

            $date   = "bill_date";

            try{

                $bills = $sort->get('\App\Models\BillSubmit\BillSubmit', $date, 'Y-m-d', $bills);

                return view('billsubmit::index', compact('bills', 'branchs', 'branch_currency'));
            }
            catch (\Exception $exception)
            {
                return view('billsubmit::index', compact('bills', 'branchs', 'branch_currency'));
            }
        }
    }

    public function search(Request $request)
    {
        $branchs    = Branch::orderBy('id','asc')->get();
        $branch_id  =  $request->branch_id;

        if(session('branch_id') == 1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }

        $from_date  =  date('Y-m-d',strtotime($request->from_date));
        $to_date    =  date('Y-m-d',strtotime($request->to_date));
        $condition  = "str_to_date(date, '%Y-%m-%d') between '$from_date' and '$to_date'";

        $bills      = [];

        if($branch_id == 1)
        {
            $bills = BillSubmit::whereRaw($condition)->select(DB::raw('bill_submit.*'))->get()->toArray();
        }
        else
        {
            $bills = BillSubmit::whereRaw($condition)->select(DB::raw('bill_submit.*'))->join('users','users.id','=','bill_submit.created_by')->where('branch_id',$branch_id)->get()->toArray();
        }

        $date   = "bill_date";
        $sort   = new sortBydate();

        try{
            $bills= $sort->get('\App\Models\BillSubmit\BillSubmit',$date,'Y-m-d',$bills);

            return view('billsubmit::index', compact('bills','branchs','branch_id','from_date','to_date', 'branch_currency'));

        }
        catch (\Exception $exception)
        {
            return view('billsubmit::index', compact('bills','branchs','branch_id','from_date','to_date', 'branch_currency'));
        }
    }

    public function create()
    {
        //$customers = Contact::whereIn('contact_category_id',[3,4])->get();
        $branch_id      = session('branch_id');
        $this->getBranchUsers($branch_id);
        if($branch_id ==1)
        $customers      = Contact::all();
        else
        $customers      = Contact::whereIn('created_by',$this->targeted_users)->get();
        $bills      = BillSubmit::all();
        //to find branch currency start
        $currencies         = SettingCurrency::all();
        $currency_id        = User::find(Auth::user()->id);

        if (isset($currency_id->branch->currency->id))
        {
            $currency_id        = $currency_id->branch->currency->id;
        }else{
            $currency_id        = null;
        }



        $account        = RecruitmentSettingsAccounts::join('account', 'account.id', 'recruitment_settings_accounts.account_id')
                                                    ->where('recruitment_settings_accounts.type', 'bill_submit')
                                                    ->selectRaw('account.*')
                                                    ->get();
        $accounts       = Account::all();
        $branch_id      = session('branch_id');
        $item_category                  = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
                                                            return $query->where('branch_id', '=', $branch_id);
                                                        })
                                                        ->orderBy('item_category_name', 'ASC')
                                                        ->get();




        return view('billsubmit::create', compact('account', 'accounts','item_category','customers','bill_number', 'currencies', 'currency_id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id'    => 'required',
            'bill_date'      => 'required',
            'rate.*'         => 'required',
            'tax_id.*'       => 'required',
            'amount.*'       => 'required',
            'account_id'     => 'required',
        ]);

        $data       = $request->all();
        $user_id    = Auth::user()->id;
        $helper     = new \App\Lib\Helpers;

        DB::beginTransaction();

        try{
            $tax_total      = $data['tax_total'];
            $total_amount   = $data['total_amount'];

            $bill           = new BillSubmit;

            if($request->hasFile('file1'))
            {
                $file               = $request->file('file1');
                $file_name          = $file->getClientOriginalName();
                $without_extention  = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention     = $file->getClientOriginalExtension();
                $num                = rand(1,500);
                $new_file_name      = $without_extention.$request->bill_number.'.'.$file_extention;
                $success            = $file->move('uploads/bill',$new_file_name);

                if($success)
                {
                    $bill->file_url     = 'uploads/bill/'.$new_file_name;
                    $bill->file_name    = $new_file_name;
                }
            }

            if(isset($data['save']))
            {
                $bill->save = 1;
            }

            $bill->order_number             = $data['order_number'];
            $bill->amount                   = $total_amount;
            $bill->date                     = date("Y-m-d", strtotime($data['bill_date']));
            $bill->note                     = $data['customer_note'];
            $bill->vendor_name              = $data['customer_id'];
            $bill->status                   = 0;
            $bill->tax_total                = $data['tax_total'];
            $bill->adjustment               = $data['adjustment'];
            $bill->item_category_id         = $data['item_category_id'];
            $bill->item_sub_category_id     = $data['item_sub_category_id'];
            $bill->created_by               = $user_id;
            $bill->updated_by               = $user_id;
            $bill->no_of_installment       = $data['no_of_installment'];
            $bill->day_interval            = $data['time_interval'];
            $bill->start_date              = $data['start_date'];

            if($bill->save())
            {
                $i          = 0;
                $bill_entry = [];
                $bill_id    = $bill['id'];

                //end payment made
                foreach($data['account_id'] as $item)
                {
                        $bill_entry[] = [
                            'quantity'          => $data['quantity'][$i],
                            'rate'              => $data['rate'][$i],
                            'item_id'           => $data['item_id'][$i],
                            'amount'            => $data['amount'][$i],
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

                if(DB::table('bill_submit_entries')->insert($bill_entry))
                {
                    $date        = $request->due_date;
                    $due_amount   = $request->amount_val;
                    foreach($request->amount_val as $key=>$value)
                    {
                     if($value != 0 || ($key == 0 && count($due_amount) ==1  ))
                     {
                       $bill_submit_due_dat                  = new BillSubmitDueDate;
                       $bill_submit_due_dat->bill_submit_id  = $bill_id;
                       $bill_submit_due_dat->due_date        = date('Y-m-d',strtotime($date[$key]));
                       $bill_submit_due_dat->amount          = $value ? $value : 0 ;
                       $bill_submit_due_dat->created_by      = Auth::user()->id;
                       $bill_submit_due_dat->updated_by      = Auth::user()->id;
                       $bill_submit_due_dat->save();
                     }
                    }

                    DB::commit();

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

    public function show($id)
    {
      $bill                           = BillSubmit::find($id);
      $branch_id                      = session('branch_id');

      $this->getBranchUsers($branch_id);

      if(!$bill)
      {
          return back()->with('alert.status', 'warning')->with('alert.message', 'Bill not found!');
      }

      $checkAccess                    = $this->checkIfUserHasAccess($bill);

      if($checkAccess == 1){
          return back();
      }

      $bills                          = BillSubmit::orderBy('id', 'desc')->take(20)->get()->toArray();
      $date                           = "bill_date";
      $sort                           = new sortBydate();


          $sort                           = new sortBydate();
      if ($branch_id == 1)
      {
         $bills                    = $sort->get('\App\Models\MoneyOut\Bill', 'bill_date', 'd-m-Y', $bills);
      }
      else
      {
          $bills                   = $sort->get('\App\Models\MoneyOut\Bill', 'bill_date', 'd-m-Y', $bills);
          $bills                   = $bills->whereIn('created_by', $this->targeted_users);
      }
      $bill_entries                   = BillSubmitEntry::where('bill_id', $id)->get();
      $OrganizationProfile            = OrganizationProfile::find(1);
      $due_date                       = DB::table('bill_submits_due_dates')->where('bill_submit_id',$id)->select('due_date')->first();

      $sub_total                      = 0;

      foreach ($bill_entries as $bill_entry)
      {
          $sub_total                  = $sub_total + $bill_entry->amount;
      }

      return view('billsubmit::show', compact('OrganizationProfile', 'bill', 'bills', 'bill_entries', 'sub_total', 'payment_made_entries', 'due_date'));
    }

    public function showupload(Request $request,$id=null)
    {
        $bill       = Bill::find($id);

        $validator  = Validator::make($request->all(), [
            'file1' => 'required|max:10240',
        ]);

        if($validator->fails()){
            return response("file size not allowed ");
        }

        if($request->hasFile('file1'))
        {
            $file = $request->file('file1');

            if ($bill->file_url)
            {
                $delete_path = public_path($bill->file_url);
                if(file_exists($delete_path))
                {
                    $delete = unlink($delete_path);
                }
            }

            $file_name              = $file->getClientOriginalName();
            $without_extention      = substr($bill, 0, strrpos($file_name, "."));
            $file_extention         = $file->getClientOriginalExtension();
            $num                    = rand(1, 500);
            $new_file_name          = "bill-".$bill->bill_number.'.'.$file_extention;

            $success                = $file->move('uploads/bill', $new_file_name);

            if ($success)
            {
                $bill->file_url     = 'uploads/bill/' . $new_file_name;
                //$Bank->file_name  = $new_file_name;

                $bill->save();
                return response("success");
            }
            else
            {
                return response("success");
            }
        }
        else
        {
            return response("file not found");
        }
    }

    public function edit($id)
    {

        $branch_id      = session('branch_id');
        $this->getBranchUsers($branch_id);
        if($branch_id ==1)
        $customers      = Contact::all();
        else
        $customers      = Contact::whereIn('created_by',$this->targeted_users)->get();
        $bill           = BillSubmit::find($id);
        $accounts       = Account::all();
        $branch_id      = session('branch_id');
        $due_bill_sub   = BillSubmitDueDate::where('bill_submit_id', $id)->get();
        $bill_entry     = BillSubmitEntry::where('bill_id', $id)->get();
        $item_category  = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
                                                            return $query->where('branch_id', '=', $branch_id);
                                                        })
                                                        ->orderBy('item_category_name', 'ASC')
                                                        ->get();
        return view('billsubmit::edit', compact('customers', 'bill', 'item_category', 'accounts', 'currency_id','currency_rate', 'bill_entry', 'due_bill_sub'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
          'customer_id'    => 'required',
          'bill_date'      => 'required',
          'rate.*'         => 'required',
          'tax_id.*'       => 'required',
          'amount.*'       => 'required',
          'account_id'     => 'required',
        ]);

        $data       = $request->all();
        $user_id    = Auth::user()->id;
        $helper     = new \App\Lib\Helpers;

        try{
            $tax_total      = $data['tax_total'];
            $total_amount   = $data['total_amount'];

            $bill           = BillSubmit::find($id);
            if($request->hasFile('file1'))
            {
                $file               = $request->file('file1');
                $file_name          = $file->getClientOriginalName();
                $without_extention  = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention     = $file->getClientOriginalExtension();
                $num                = rand(1,500);
                $new_file_name      = $without_extention.$request->bill_number.'.'.$file_extention;
                $success            = $file->move('uploads/bill',$new_file_name);

                if($success)
                {
                    $bill->file_url     = 'uploads/bill/'.$new_file_name;
                    $bill->file_name    = $new_file_name;
                }
            }

            if(isset($data['save']))
            {
                $bill->save = 1;
            }

            $bill->order_number             = $data['order_number'];
            $bill->amount                   = $total_amount;
            $bill->date                     = date("Y-m-d", strtotime($data['bill_date']));
            $bill->note                     = $data['customer_note'];
            $bill->vendor_name              = $data['customer_id'];
            $bill->status                   = 0;
            $bill->tax_total                = $data['tax_total'];
            $bill->adjustment               = $data['adjustment'];
            $bill->item_category_id         = $data['item_category_id'];
            $bill->item_sub_category_id     = $data['item_sub_category_id'];
            $bill->created_by               = $user_id;
            $bill->updated_by               = $user_id;
            $bill->no_of_installment       = $data['no_of_installment'];
            $bill->day_interval            = $data['time_interval'];
            $bill->start_date              = $data['start_date'];


            if($bill->save())
            {
                BillSubmitEntry::where('bill_id',$id)->delete();

                $i          = 0;
                $bill_entry = [];
                $bill_id    = $bill['id'];

                //end payment made
                foreach($data['account_id'] as $item)
                {
                    $bill_entry[] = [
                        'quantity'          => $data['quantity'][$i],
                        'rate'              => $data['rate'][$i],
                        'item_id'           => $data['item_id'][$i],
                        'amount'            => $data['amount'][$i],
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

                if(DB::table('bill_submit_entries')->insert($bill_entry))
                {
                  if(BillSubmitDueDate::where('bill_submit_id',$id)->delete())
                  {
                    $date         = $request->due_date;
                    $due_date     = $request->due_date;
                    $due_amount   = $request->amount_val;
                    foreach($request->amount_val as $key=>$value)
                    {
                      if($value != 0 || ( $key == 0 && count($due_amount) == 1 ) )
                      {
                        $bill_submit_due_dat                  = new BillSubmitDueDate;
                        $bill_submit_due_dat->bill_submit_id  = $bill_id;
                        $bill_submit_due_dat->due_date        = date('Y-m-d',strtotime($date[$key]));
                        $bill_submit_due_dat->amount          = $value ? $value : 0;
                        $bill_submit_due_dat->created_by      = Auth::user()->id;
                        $bill_submit_due_dat->updated_by      = Auth::user()->id;
                        $bill_submit_due_dat->save();
                      }
                    }
                  }
                    DB::commit();

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

    public function markupdate($id)
    {
        DB::beginTransaction();
        $branch_id = session('branch_id');
        try{
            $bill = Bill::find($id);
            $bill->save = null;
            $bill->save();
            $datas= $bill->billEntries->toArray();
            $user_id = Auth::user()->id;
            $i = 0;
            $account_array = array_fill(1, 100, 0);
            foreach($datas as $data)
            {
                $amount = $data['quantity']*$data['rate'];
                $account_array[$data['account_id']] =  $account_array[$data['account_id']] + $amount;
                $i++;
            }
            //insert total amount as debit
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $bill->note;
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $bill->amount;
            $journal_entry->account_name_id = 11;
            $journal_entry->jurnal_type     = "bill";
            $journal_entry->bill_id         =$id;
            $journal_entry->contact_id      = $bill->vendor_id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($bill->bill_date));
            if($journal_entry->save())
            {
                     if($bill->total_tax>0)
                     {
                         $journal_entry = new JournalEntry;
                         $journal_entry->note            = $bill->note;
                         $journal_entry->debit_credit    = 1;
                         $journal_entry->amount          = $bill->total_tax;
                         $journal_entry->account_name_id = 9;
                         $journal_entry->jurnal_type     = "bill";
                         $journal_entry->bill_id         = $bill->id;
                         $journal_entry->contact_id      = $bill->vendor_id;
                         $journal_entry->created_by      = $user_id;
                         $journal_entry->updated_by      = $user_id;
                         $journal_entry->assign_date      = date('Y-m-d',strtotime($bill->bill_date));
                         $journal_entry->save();

                     }

                     $bill_entry = [];
                     for($j = 1; $j<count($account_array)-2; $j++)
                     {
                         if ($account_array[$j] != 0)
                         {
                             $bill_entry[] = [
                                 'note'              => $bill->note,
                                 'debit_credit'      => 1,
                                 'amount'            => $account_array[$j],
                                 'account_name_id'   => $j,
                                 'jurnal_type'       => 'bill',
                                 'bill_id'           => $bill->id,
                                 'contact_id'        => $bill->vendor_id,
                                 'created_by'        => $user_id,
                                 'updated_by'        => $user_id,
                                 'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                                 'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                                 'assign_date'      => date('Y-m-d',strtotime($bill->bill_date)),
                             ];

                         }
                     }
                 }
                 else
                 {
                     throw new \Exception();
                 }


          if(DB::table('journal_entries')->insert($bill_entry))
            {


                foreach ($datas as $item)
                {
                    $items = Item::find($item['item_id']);
                    $items->total_purchases += $item['quantity'];
                    $items->save();


                }

                foreach ($datas as $item)
                {
                    $stock = new Stock;
                    $stock->total = $item['quantity'];
                    $stock->date =  $bill->bill_date;
                    $stock->item_category_id = Item::find($item['item_id'])->itemCategory->id;
                    $stock->item_id = $item['item_id'];
                    $stock->bill_id = $bill->id;
                    $stock->branch_id = $branch_id;
                    $stock->created_by = $user_id;
                    $stock->updated_by = $user_id;
                    $stock->save();

                }
                DB::commit();
                return back()
                           ->with('alert.status', 'success')
                                  ->with('alert.message', 'Journal added.');
            }
            else
            {
                throw new \Exception('Unable');
            }

        }
        catch(\Exception $exception)
        {
            DB::rollBack();
            return back()
                       ->with('alert.status', 'danger')
                             ->with('alert.message', 'Transaction fail');
        }
    }

    public function destroy($id)
    {
        $delete = BillSubmit::find($id);
        $delete->delete();

            return redirect()
                ->route('bill_submit')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Bill deleted successfully!!!');
    }

    public function useExcessPayment(Request $request)
    {
        $data = $request->all();
        //return $data;
        $user_id = Auth::user()->id;
        $helper = new \App\Lib\Helpers;
        $i = 0;
        foreach ($data['excess_payment_amount'] as $excess_payment_amount)
        {
            if($excess_payment_amount && $excess_payment_amount > 0)
            {
                $helper->updatePaymentMadeEntryAfterExcessAmountUse($data['bill_id'], $data['payment_made_id'][$i], $excess_payment_amount, $user_id);

                $payment_made = PaymentMade::find($data['payment_made_id'][$i]);
                $payment_made->excess_amount = ($payment_made['excess_amount'] - $excess_payment_amount);
                $payment_made->update();

                $bill = Bill::find($data['bill_id']);
                $bill->due_amount = $bill['due_amount'] - $excess_payment_amount;
                $bill->update();
            }
            $i++;
        }


        $i = 0;
        foreach ($data['excess_payment_amount'] as $excess_payment_amount)
        {
            if($excess_payment_amount)
            {
                $helper->addOrUpdateJournalEntryAfterUsingExcessAmountInBill($data['bill_id'], $data['payment_made_id'][$i], $excess_payment_amount, $user_id);
            }
            $i++;
        }

        return redirect()
            ->route('bill_show', ['id' => $data['bill_id']])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Excess notes used successfully!');
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
    public function checkIfUserHasAccess($bill)
    {

        $user_branch    = Auth::user()->branch_id;

        if($bill->createdBy->branch_id != $user_branch && $user_branch != 1){
            return 1;
        }

    }

}
