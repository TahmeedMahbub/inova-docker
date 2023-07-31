<?php

namespace App\Modules\Income\Http\Controllers;

use App\Lib\sortBydate;
use App\Models\Branch\Branch;
use App\Models\OrganizationProfile\OrganizationProfile;
use Exception;
use Validator;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Moneyin\Income;
use App\Models\Contact\Contact;
use App\Models\AccountChart\Account;
use App\Models\Tax;
use App\Models\ManualJournal\JournalEntry;
use Carbon\Carbon;
use DateTime;

class IncomeWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function index()
    {
        $auth_id        = Auth::id();
        $branch_id      = session('branch_id');
        $branchs        = Branch::orderBy('id','asc')->get();

        $current_time   = Carbon::now()->toDayDateTimeString();
        $start          = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end            = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');

        if($branch_id == 1)
        {
            $incomes    = Income::orderBy('date', 'desc')
                                    ->whereBetween('incomes.date', [$start,$end])
                                    ->join('users','users.id','=','incomes.created_by')
                                    ->join('branch','branch.id','=','users.branch_id')
                                    ->selectRaw('incomes.*, branch.branch_name as branch_name')
                                    ->get()
                                    ->toArray();
        }
        else
        {
            $incomes    = Income::select(DB::raw('incomes.*'))
                                    ->orderBy('date', 'desc')
                                    ->whereBetween('incomes.date', [$start,$end])
                                    ->join('users','users.id','=','incomes.created_by')
                                    ->where('users.branch_id',$branch_id)
                                    ->get()
                                    ->toArray();
        }

        $date   = "date";
        $sort   = new sortBydate();

        try
        {
            $incomes    = $sort->get('\App\Models\Moneyin\Income',$date,'Y-m-d',$incomes);
            return view('income::income.index', compact('incomes','branchs', 'branch_id'));
        }
        catch (\Exception $exception)
        {
            return view('income::income.index', compact('incomes','branchs', 'branch_id'));
        }

    }
    public function search(Request $request)
    {
        $auth_id        = Auth::id();
        $branch_id      = session('branch_id');
        $branchs        = Branch::orderBy('id','asc')->get();

        if(session('branch_id') == 1)
        {
            $branch_id  =  $request->branch_id ? $request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id  = session('branch_id');
        }

        $from_date      =  date('Y-m-d',strtotime($request->from_date));
        $to_date        =  date('Y-m-d',strtotime($request->to_date));
        $condition      = "str_to_date(incomes.date, '%Y-%m-%d') between '$from_date' and '$to_date'";

        if($branch_id == 1)
        {
            $incomes    = Income::orderBy('date', 'desc')->whereRaw($condition)->get()->toArray();

        }else{
            $incomes    = Income::select(DB::raw('incomes.*'))->whereRaw($condition)->join('users','users.id','=','incomes.created_by')->where('branch_id',$branch_id)->get()->toArray();
        }

        $date   = "date";
        $sort   = new sortBydate();

        try{
            $incomes = $sort->get('\App\Models\Moneyin\Income',$date,'Y-m-d',$incomes);

            return view('income::income.index', compact('incomes','branchs','branch_id','from_date','to_date'));
        }catch (\Exception $exception){
           return view('income::income.index', compact('incomes','branchs','branch_id','from_date','to_date'));
        }
    }

    public function create()
    {
        $show_all_contact   = OrganizationProfile::first();
        $show_all_contact   = $show_all_contact->show_all_contact;

        $branch_id          = session('branch_id');

        $customers          = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                        ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                                            return $query->where('users.branch_id', '=', $branch_id);
                                        })
                                        ->select('contact.*')
                                        ->get();

        $accounts           = Account::wherein('account_type_id',array(15,16))->get();
        $received_throughs  = Account::wherein('account_type_id',array(4,5))->get();

        return view('income::income.create', compact('customers', 'accounts', 'received_throughs'));
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $this->validate($request, [
            'income_date'           => 'required',
            'account_id'            => 'required',
            'amount'                => 'required',
            'tax_id'                => 'required',
            'amount_is'             => 'required',
            'customer_id'           => 'required',
            'amount_is'             => 'required',
            'receive_through_id'    => 'required',
        ]);

        DB::beginTransaction();

        $total_tax  = 0;
        $user_id    = Auth::user()->id;

        $tax_amount = Tax::find($data['tax_id'])->amount_percentage;

        if($data['amount_is'] == 1)
        {
            $total_tax = ($data['amount']*($tax_amount/100));
        }
        else
        {
            $total_tax = ($data['amount']*($tax_amount/110));
        }

        $income_number_count = Income::orderBy('income_number','desc')->first();

        /*if(count($income_number_count)){*/
        if($income_number_count){
            $income_number = $income_number_count->income_number+1;
        }else{
            $income_number= 1;
        }

        $income = new Income;
        $income->date                   = date('Y-m-d',strtotime($data['income_date']));
        $income->amount                 = round($data['amount'], 2);
        $income->income_number          = $income_number;
        $income->receive_through_id     = $data['receive_through_id'];
        $income->tax_total              = round($total_tax, 2);
        $income->reference              = $data['reference'];
        $income->note                   = $data['customer_note'];
        $income->account_id             = $data['account_id'];
        $income->customer_id            = $data['customer_id'];
        $income->tax_id                 = $data['tax_id'];
        $income->tax_type               = $data['amount_is'];
        $income->created_by             = $user_id;
        $income->updated_by             = $user_id;

        if($request->hasFile('file1')){


            $file = $request->file('file1');

            if ($income->file_url) {
                $delete_path = public_path($income->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }

            }

            $file_name              = $file->getClientOriginalName();
            $without_extention      = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention         = $file->getClientOriginalExtension();
            $num                    = rand(1, 500);
            $new_file_name          = "income-".$income->income_number.'.'.$file_extention;
            $success                = $file->move('uploads/income', $new_file_name);

            if($success){
                $income->file_url   = 'uploads/income/' . $new_file_name;
            }else{
                $income->file_url   = null;
            }
        }

        if(isset($data['bank_info']))
        {
            $income->bank_info = $data['bank_info'];
        }

        if(isset($data['invoice_show']))
        {
            $income->invoice_show = "on";
        }

        if($income->save())
        {
            $income     = Income::orderBy('created_at', 'desc')->first();
            $income_id  = $income['id'];
            $status     = $this->insertIncomeInJournal($total_tax, $data['amount'], $data, $income_id);

            if($status)
            {
                DB::commit();
                return redirect()
                          ->route('income')
                          ->with('alert.status', 'success')
                          ->with('alert.message', 'Income added successfully!');
            }
            else
            {

                $income = Income::find($income_id);
                $income->delete();
                {
                    DB::rollBack();
                    return redirect()
                            ->route('income')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! Please check your input field');
                }
            }
        }
    }

    public function show($id)
    {
        $income       = Income::find($id);

        $checkAccess  = $this->checkIfUserHasAccess($income);

        if($checkAccess == 1){
            return back();
        }

        $branch_id      = session('branch_id');

        $this->getBranchUsers($branch_id);

        if($branch_id == 1)
          $incomes  = Income::orderBy('date','desc')->get()->toArray();
        else
          $incomes  = Income::orderBy('date','desc')->whereIn('created_by', $this->targeted_users)->get()->toArray();

        $date       = "date";
        $sort       = new sortBydate();
        $incomes    = $sort->get('\App\Models\Moneyin\Income',$date,'Y-m-d',$incomes);

        $OrganizationProfile = OrganizationProfile::find(1);

        return view('income::income.show', compact('income', 'incomes','OrganizationProfile'));
    }

    public function showupload(Request $request,$id=null)
    {
       try{

           $income = Income::find($id);
           $validator = Validator::make($request->all(), [
               'file1' => 'required|max:10240',

           ]);


           if($validator->fails()){
               return response("file size not allowed");
           }

           //  $contact = isset($income->contact->display_name)?$income->contact->display_name:'no_name';

           if($request->hasFile('file1'))
           {
               $file = $request->file('file1');

               if ($income->file_url)
               {
                   $delete_path = public_path($income->file_url);
                   if(file_exists($delete_path))
                   {
                       $delete = unlink($delete_path);
                   }

               }

               $file_name = $file->getClientOriginalName();
               $without_extention = substr($file_name, 0, strrpos($file_name, "."));
               $file_extention = $file->getClientOriginalExtension();
               $num = rand(1, 500);
               $new_file_name = "income-".$income->income_number.'.'.$file_extention;


               $success = $file->move('uploads/income', $new_file_name);

               if($success)
               {
                   $income->file_url = 'uploads/income/' . $new_file_name;
                   //$Bank->file_name = $new_file_name;
                   try{
                       $income->save();
                       return response("success");
                   }catch(\Exception $exception){
                       if($exception instanceof \Illuminate\Database\QueryException )
                       {

                           if (\App::environment('development', 'local'))
                           {
                               $msg = $exception->getMessage();
                           }

                           if(isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && count($exception->errorInfo)==3)
                           {
                               if(isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && isset($exception->errorInfo[2]) && $exception->errorInfo[0]=="42000" && $exception->errorInfo[1]=="1142")
                               {
                                   $msg = explode("@",$exception->errorInfo[2])[0];
                               }

                               if ($exception->getCode() == "42000")
                               {
                                   return response($msg);
                               }

                           }
                       }
                   }

                   return response("success");
               }
               else
               {
                   return response("file not found");
               }

           }
           else
           {
               return response("file not found");
           }

       }catch(Exception  $exception){
           return response("file size not allowed");
       }
    }

    public function edit($id)
    {
        $income = Income::find($id);

        $checkAccess = $this->checkIfUserHasAccess($income);

        if($checkAccess == 1){
            return back();
        }

        $show_all_contact   = OrganizationProfile::first();
        $show_all_contact   = $show_all_contact->show_all_contact;

        $branch_id          = session('branch_id');

        $customers          = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                        ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', '=', $branch_id);
                                            })
                                        ->select('contact.*')
                                        ->get();

        $accounts         = Account::wherein('account_type_id',array(15,16))->get();
        $receive_throughs = Account::whereIn('account_type_id',array(4,5))->get();

        return view('income::income.edit', compact('customers', 'accounts', 'receive_throughs','income'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->validate($request, [
            'income_date'           => 'required',
            'account_id'            => 'required',
            'amount'                => 'required',
            'tax_id'                => 'required',
            'amount_is'             => 'required',
            'customer_id'           => 'required',
            'amount_is'             => 'required',
            'receive_through_id'    => 'required',
        ]);

        $total_tax  = 0;
        $user_id    = Auth::user()->id;

        $tax_amount = Tax::find($data['tax_id'])->amount_percentage;
        
        if($data['amount_is'] == 1)
        {
            $total_tax = ($data['amount']*($tax_amount/100));
        }
        else
        {
            $total_tax = ($data['amount']*($tax_amount/110));
        }

        $income = Income::find($id);
        $income->date                   = date('Y-m-d',strtotime($data['income_date']));
        $income->amount                 = round($data['amount'], 2);
        $income->receive_through_id     = $data['receive_through_id'];
        $income->tax_total              = round($total_tax, 2);
        $income->reference              = $data['reference'];
        $income->note                   = $data['customer_note'];
        $income->account_id             = $data['account_id'];
        $income->customer_id            = $data['customer_id'];
        $income->tax_id                 = $data['tax_id'];
        $income->tax_type               = $data['amount_is'];
        $income->created_by             = $user_id;
        $income->updated_by             = $user_id;

        if($request->hasFile('file1')){


            $file = $request->file('file1');

            if ($income->file_url) {
                $delete_path = public_path($income->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }

            }

            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "Bank-".$income->income_number.'.'.$file_extention;
            $success = $file->move('uploads/income', $new_file_name);
            if ($success){
                $income->file_url = 'uploads/income/' . $new_file_name;

            }else{
                $income->file_url  = null;
            }
        }
        if(isset($data['bank_info']))
        {
            $income->bank_info = $data['bank_info'];
        }

        if(isset($data['invoice_show']))
        {
            $income->invoice_show = "on";
        }
        else
        {
            $income->invoice_show = "";
        }

        if($income->update())
        {
            $status = $this->updateIncomeInJournal($total_tax, $data['amount'], $data, $id);
            if($status)
            {
                return redirect()
                    ->route('income')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Income updated successfully!');
            }
            else
            {
                $income = Income::find($id);
                $income->delete();
                {
                    return redirect()
                        ->route('income')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Something went to wrong! Please check your input field');
                }
            }

        }
    }

    public function destroy($id)
    {
        $income = Income::find($id);

        $checkAccess = $this->checkIfUserHasAccess($income);

        if($checkAccess == 1){
            return back();
        }

        if($income->delete())
        {
            if ($income->file_url)
            {
                $delete_path = public_path($income->file_url);
                if(file_exists($delete_path))
                {
                    $delete = unlink($delete_path);
                }

            }
            return redirect()
                ->route('income')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Income deleted successfully!!!');
        }

        return redirect()
            ->route('income')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Something went to wrong!!!');
    }

    public function insertIncomeInJournal($total_tax, $total_amount, $data, $income_id)
    {
        $user_id = Auth::user()->id;

        $journal_entry = new JournalEntry;
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = round(($total_tax + $total_amount) , 2);
        $journal_entry->jurnal_type    = "income";
        $journal_entry->account_name_id = $data['receive_through_id'];
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->income_id       = $income_id;
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date      = date('Y-m-d',strtotime($data['income_date']));

        if($journal_entry->save())
        {
            $journal_entry = new JournalEntry;
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = round($total_amount, 2);
            $journal_entry->jurnal_type    = "income";
            $journal_entry->account_name_id = $data['account_id'];
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->income_id       = $income_id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['income_date']));

            if($journal_entry->save())
            {
                $journal_entry = new JournalEntry;
                $journal_entry->debit_credit    = 0;
                $journal_entry->amount          = round($total_tax, 2);
                $journal_entry->jurnal_type    = "income";
                $journal_entry->account_name_id = 9;
                $journal_entry->contact_id      = $data['customer_id'];
                $journal_entry->note            = $data['customer_note'];
                $journal_entry->income_id       = $income_id;
                $journal_entry->created_by      = $user_id;
                $journal_entry->updated_by      = $user_id;
                $journal_entry->assign_date      = date('Y-m-d',strtotime($data['income_date']));

                if($journal_entry->save())
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function updateIncomeInJournal($total_tax, $total_amount, $data, $income_id)
    {
        $user_id = Auth::user()->id;

        $income_entries_delete = Income::find($income_id)->journalEntries();

        if($income_entries_delete->delete())
        {

        }

        $journal_entry = new JournalEntry;
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = round(($total_tax + $total_amount), 2);
        $journal_entry->jurnal_type    = "income";
        $journal_entry->account_name_id = $data['receive_through_id'];
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->income_id       = $income_id;
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date      = date('Y-m-d',strtotime($data['income_date']));

        if($journal_entry->save())
        {
            $journal_entry = new JournalEntry;
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = round($total_amount, 2);
            $journal_entry->jurnal_type    = "income";
            $journal_entry->account_name_id = $data['account_id'];
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->income_id       = $income_id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['income_date']));

            if($journal_entry->save())
            {
                $journal_entry = new JournalEntry;
                $journal_entry->debit_credit    = 0;
                $journal_entry->amount          = round($total_tax, 2);
                $journal_entry->jurnal_type    = "income";
                $journal_entry->account_name_id = 9;
                $journal_entry->contact_id      = $data['customer_id'];
                $journal_entry->note            = $data['customer_note'];
                $journal_entry->income_id       = $income_id;
                $journal_entry->created_by      = $user_id;
                $journal_entry->updated_by      = $user_id;
                $journal_entry->assign_date      = date('Y-m-d',strtotime($data['income_date']));

                if($journal_entry->save())
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function checkIfUserHasAccess($income)
    {
        $user_branch    = Auth::user()->branch_id;

        if($income->createdBy->branch_id != $user_branch && $user_branch != 1){
            return 1;
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

}
