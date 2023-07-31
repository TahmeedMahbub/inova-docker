<?php

namespace App\Modules\Recurringbill\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lib\sortBydate;
use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Inventory\ItemCategory;
use App\Models\MoneyOut\RecurringBill;
use App\Models\MoneyOut\RecurringBillEntry;
use App\Models\AccountChart\Account;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\User;
use Carbon\Carbon;
use DB;
use Auth;

class RecurringBillController extends Controller
{   
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function index()
    {  
        
        $from_date          = Carbon::parse()->format('d-m-Y');
        $to_date            = Carbon::parse()->format('d-m-Y');
        $branchs            = Branch::all();

        $branch_id          = session('branch_id');
        if($branch_id== 1)
        {
            $recurring_bills     = RecurringBill::orderBy('created_at','DESC')->get();

        }
        else
        {
            $targate_users       = $this->getBranchUsers($branch_id);
            $recurring_bills     = RecurringBill::orderBy('created_at','DESC')->whereIn('created_by',$targate_users)->get();
        }
       
        return view('recurringbill::index', compact('from_date', 'to_date', 'branchs', 'recurring_bills'));
    }

    public function create()
    {   

        $branch_id                      = session('branch_id');
        $customers                      = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                            return $query->where('users.branch_id', '=', $branch_id);
                                                        })
                                                    ->select('contact.*')
                                                    ->get();
        $item_category                  = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
                                                            return $query->where('branch_id', '=', $branch_id);
                                                        })
                                                        ->orderBy('item_category_name', 'ASC')
                                                        ->get();
        $recurring_bill_no              = 0001;

        $account                        = Account::whereIn('id',[4,5])->get();
        $accounts                       = Account::all();
        return view('recurringbill::create', compact('customers', 'branch_id', 'recurring_bill_no', 'item_category', 'account', 'accounts'));
    }

    public function store(Request $request)
    {  
       
        $this->validate($request, [
            'customer_id'          => 'required',
            'bill_date'            => 'required',
            'item_id.*'            => 'required',
            'quantity.*'           => 'required',
            'rate.*'               => 'required',
            'amount.*'             => 'required',
            'account_id'           => 'required',
            'item_category_id'     => 'required',
            'item_sub_category_id' => 'required',
        ]);
        $recurring_bill_no        =  RecurringBill::orderBy('id','desc')->first();
        if($recurring_bill_no)
        {
            $recurring_bill_no    = $recurring_bill_no->id; 
        }
        else
        {
            $recurring_bill_no    = 1;
        }
        $recurring_bill_no        = str_pad($recurring_bill_no,6,'0', STR_PAD_LEFT);
        try
        {
            DB::beginTransaction();
            
            $recurring_bill                           = new RecurringBill;
            $recurring_bill->customer_id              = $request->customer_id;
            $recurring_bill->order_no                 = $request->order_number;
            $recurring_bill->recurring_bill_no        = $recurring_bill_no;
            $recurring_bill->bill_date                = date('Y-m-d',strtotime($request->bill_date));
            $recurring_bill->start_date               = date('Y-m-d',strtotime($request->start_date));
            $recurring_bill->day_interval             = $request->day_interval;
            $recurring_bill->instance                 = $request->instance;
            $recurring_bill->item_category_id         = $request->item_category_id;
            $recurring_bill->item_sub_category_id     = $request->item_sub_category_id;
            $recurring_bill->total_tax                = $request->tax_total;
            $recurring_bill->adjustment               = $request->adjustment;
            $recurring_bill->amount                   = $request->total_amount;
            $recurring_bill->note                     = $request->customer_note;
            $recurring_bill->created_by               = Auth::user()->id;
            $recurring_bill->updated_by               = Auth::user()->id;
            
                if($recurring_bill->save())
                {
                    foreach($request->quantity as $key=>$value)
                    {
                        $recurring_bill_entry                      = new RecurringBillEntry;
                        $recurring_bill_entry->item_id             = $request->item_id[$key];
                        $recurring_bill_entry->description         = $request->description[$key];
                        $recurring_bill_entry->account_id          = $request->account_id[$key];
                        $recurring_bill_entry->quantity            = $request->quantity[$key];
                        $recurring_bill_entry->rate                = $request->rate[$key];
                        $recurring_bill_entry->amount              = $request->amount[$key];
                        $recurring_bill_entry->tax_id              = 1;
                        $recurring_bill_entry->recurring_bill_id   = $recurring_bill->id;
                        $recurring_bill_entry->created_by          = Auth::user()->id;
                        $recurring_bill_entry->updated_by          = Auth::user()->id;
                        $recurring_bill_entry->save();
                    }
                }
            DB::commit();
            return redirect()->route('recurring_bill_index')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Recurring Bill is Added Successfully');

        }
        catch(\Exception $ex)
        {
            DB::rollback();
            $msg                    = $ex->getMessage();
            return redirect()->route('bill')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', "Fail : $msg");
        }
    }

    public function edit($id)
    {   
        $branch_id                      = session('branch_id');
        $customers                      = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                            return $query->where('users.branch_id', '=', $branch_id);
                                                        })
                                                    ->select('contact.*')
                                                    ->get();

        $item_category                  = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
                                                        return $query->where('branch_id', '=', $branch_id);
                                                    })
                                                    ->orderBy('item_category_name', 'ASC')
                                                    ->get();
        $account                        = Account::whereIn('id',[4,5])->get();
        $accounts                       = Account::all();
        $recurring_bill             = RecurringBill::where('id', $id)->first();
        $recurring_bill_entry       = RecurringBillEntry::where('recurring_bill_id', $id)->get();
        $tax                        =  (100 * $recurring_bill['total_tax'])/ ($recurring_bill['amount'] -  $recurring_bill['total_tax']);

        return view('recurringbill::edit', compact('recurring_bill', 'recurring_bill_entry', 'id', 'customers', 'tax', 'item_category', 'account', 'accounts')); 
    }

    public function update(Request $request, $id)
    {  
        $this->validate($request, [
            'customer_id'          => 'required',
            'bill_date'            => 'required',
            'item_id.*'            => 'required',
            'quantity.*'           => 'required',
            'rate.*'               => 'required',
            'amount.*'             => 'required',
            'account_id'           => 'required', 
        ]);
        
        try
        {
            DB::beginTransaction();
            
            $recurring_bill                           = RecurringBill::find($id);
            $recurring_bill->customer_id              = $request->customer_id;
            $recurring_bill->order_no                 = $request->order_number;
            $recurring_bill->recurring_bill_no        = $request->recurring_bill_no;
            $recurring_bill->bill_date                = date('Y-m-d',strtotime($request->bill_date));
            $recurring_bill->start_date               = date('Y-m-d',strtotime($request->start_date));
            $recurring_bill->day_interval             = $request->day_interval;
            $recurring_bill->instance                 = $request->instance;
            $recurring_bill->item_category_id         = $recurring_bill['item_category_id'];
            $recurring_bill->item_sub_category_id     = $recurring_bill['item_sub_category_id'];
            $recurring_bill->total_tax                = $request->tax_total;
            $recurring_bill->adjustment               = $request->adjustment;
            $recurring_bill->amount                   = $request->total_amount;
            $recurring_bill->note                     = $request->customer_note;
            $recurring_bill->created_by               = Auth::user()->id;
            $recurring_bill->updated_by               = Auth::user()->id;

                if($recurring_bill->save())
                {   
                     //delete Recurring Bill Id
                    $delete_rec_entry   = RecurringBillEntry::where('recurring_bill_id',$id)->delete();

                    if($delete_rec_entry)
                    {
                        foreach($request->quantity as $key=>$value)
                        {
                            $recurring_bill_entry                      = new RecurringBillEntry;
                            $recurring_bill_entry->item_id             = $request->item_id[$key];
                            $recurring_bill_entry->description         = $request->description[$key];
                            $recurring_bill_entry->account_id          = $request->account_id[$key];
                            $recurring_bill_entry->quantity            = $request->quantity[$key];
                            $recurring_bill_entry->rate                = $request->rate[$key];
                            $recurring_bill_entry->amount              = $request->amount[$key];
                            $recurring_bill_entry->tax_id              = 1;
                            $recurring_bill_entry->recurring_bill_id   = $recurring_bill->id;
                            $recurring_bill_entry->created_by          = Auth::user()->id;
                            $recurring_bill_entry->updated_by          = Auth::user()->id;
                            $recurring_bill_entry->save();
                       }
                    }
                }
            DB::commit();
            return redirect()->route('recurring_bill_index')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Recurring Bill is Updated Successfully');

        }
        catch(\Exception $ex)
        {
            DB::rollback();
            $msg                    = $ex->getMessage();
            return redirect()->route('bill')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', "Fail : $msg");
        }
    }

    public function show($id)
    {  

        $recurring_bill                       = RecurringBill::find($id);
        $branch_id                            = session('branch_id');
        $targate_users                        =  $this->getBranchUsers($branch_id);
        if(!$recurring_bill)
        {
            return back()->with('alert.status', 'warning')->with('alert.message', 'Bill not found!');
        }

        $checkAccess                    = $this->checkIfUserHasAccess($recurring_bill);

        if($checkAccess == 1){
            return back();
        }

        $recurring_bills                = RecurringBill::orderBy('id', 'desc')->take(20)->get()->toArray();
        $date                           = "bill_date";
        $sort                           = new sortBydate();
        
        if ($branch_id == 1)
        {
           $recurring_bills             = $sort->get('\App\Models\MoneyOut\Bill', 'bill_date', 'd-m-Y', $recurring_bills);
        }
        else
        {
            $recurring_bills            = $sort->get('\App\Models\MoneyOut\Bill', 'bill_date', 'd-m-Y', $recurring_bills);
            $recurring_bills            = $recurring_bills->whereIn('created_by', $targate_users);
        }
        $recurring_bill_entries         = RecurringBillEntry::where('recurring_bill_id', $id)->get();
    
        $OrganizationProfile            = OrganizationProfile::find(1);
        $sub_total                      = 0;
        foreach ($recurring_bill_entries as $bill_entry)
        {
            $sub_total                  = $sub_total + $bill_entry->amount;
        }

        return view('recurringbill::show', compact('OrganizationProfile', 'recurring_bill', 'recurring_bills', 'recurring_bill_entries', 'sub_total'));

    }
   
    public function destroy($id)
    {
       $recurring_bill_delete   = RecurringBill::where('id',$id)->delete();
       if($recurring_bill_delete)
       {

            return redirect()
                        ->route('recurring_bill_index')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'recurring Bill delete succefully.');
        } 
        else
        {
            return redirect()
                        ->route('recurring_bill_index')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Something Went Wrong ');
  
        }               
    }
    public function checkIfUserHasAccess($bill)
    {

        $user_branch    = Auth::user()->branch_id;

        if($bill->createdBy->branch_id != $user_branch && $user_branch != 1){
            return 1;
        }

    }

    public function getBranchUsers($branch_id)
    {
      
       $targeted_users          = [];

       $users                   = User::where('branch_id', $branch_id)->get();
       foreach($users as $key=>$user)
       {
            $targeted_users[$key]   =  $user->id;
       } 
       return $targeted_users;
    }
}
