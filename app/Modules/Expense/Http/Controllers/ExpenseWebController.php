<?php

namespace App\Modules\Expense\Http\Controllers;

use App\User;
use DateTime;
use Validator;
use Carbon\Carbon;
use App\Models\Tax;
use RuntimeException;
use App\Http\Requests;
use App\Lib\sortBydate;
use App\Models\Cms\site;
use App\Models\Bank\Bank;
use Illuminate\Http\Request;
use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\MoneyOut\Expense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AccountChart\Account;
use App\Models\MoneyOut\PaymentMade;
use Illuminate\Support\Facades\Auth;
use App\Models\Recruit\RecruitExpense;
use App\Models\ManualJournal\JournalEntry;
use App\Models\ConveyanceBill\ConveyanceBill;
use App\Models\OrganizationProfile\OrganizationProfile;

class ExpenseWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function index()
    {
        $expenses       = [];
        $auth_id        = Auth::id();
        $branch_id      = session('branch_id');
        $branchs        = Branch::orderBy('id', 'asc')->get();
        $sort           = new sortBydate();

        $current_time   = Carbon::now()->toDayDateTimeString();
        $start          = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end            = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $date           = "date";

        if($branch_id == 1)
        {
            $expenses   = Expense::whereBetween('expense.date', [$start,$end])
                                    ->join('users','users.id','=','expense.created_by')
                                    ->join('branch','branch.id','=','users.branch_id')
                                    ->selectRaw('expense.*, branch.branch_name as branch_name')
                                    ->get()
                                    ->toArray();

            try{

                $expenses      = $sort->get('\App\Models\MoneyOut\Expense', $date, 'Y-m-d', $expenses);

                return view('expense::expense.index', compact('expenses', 'branchs', 'branch_id'));

            }catch(\Exception $exception){

                $exception->getMessage();
            }
        }
        else
        {
            $expenses       = Expense::select(DB::raw('expense.*'))
                                        ->whereBetween('expense.date', [$start,$end])
                                        ->join('users', 'users.id', '=', 'expense.created_by')
                                        ->where('users.branch_id', $branch_id)
                                        ->get()
                                        ->toArray();

            try{

                $expenses   = $sort->get('\App\Models\MoneyOut\Expense', $date, 'Y-m-d', $expenses);

                return view('expense::expense.index', compact('expenses', 'branchs', 'branch_id'));

            }catch(\Exception $exception){

                $exception->getMessage();
            }
        }
    }

    public function search(Request $request)
    {
        $branchs            = Branch::orderBy('id', 'asc')->get();
        $branch_id          = $request->branch_id;

        if(session('branch_id') == 1)
        {
            $branch_id      = $request->branch_id ? $request->branch_id : session('branch_id');
        }
        else
        {
            $branch_id      = session('branch_id');
        }

        $from_date          = date('Y-m-d', strtotime($request->from_date));
        $to_date            = date('Y-m-d', strtotime($request->to_date));
        $condition          = "str_to_date(date, '%Y-%m-%d') between '$from_date' and '$to_date'";

        if($branch_id == 1){

            $expenses       = Expense::select(DB::raw('expense.*'))->whereRaw($condition)->get()->toArray();

        }else{

            $expenses       = Expense::select(DB::raw('expense.*'))
                                        ->whereRaw($condition)
                                        ->join('users', 'users.id', '=', 'expense.created_by')
                                        ->where('users.branch_id', $branch_id)
                                        ->get()
                                        ->toArray();
        }

        $date               = "date";
        $sort               = new sortBydate();

        try{

            $expenses       = $sort->get('\App\Models\MoneyOut\Expense', $date, 'Y-m-d', $expenses);

            return view('expense::expense.index', compact('expenses', 'branchs', 'branch_id', 'from_date', 'to_date'));

        }catch (\Exception $exception){

            dd($exception->getMessage());

        }
    }

    public function create()
    {
        $branch_id          = session('branch_id');
        $show_all_contact   = OrganizationProfile::first();
        $show_all_contact   = $show_all_contact->show_all_contact;

        if($branch_id == 1 || $show_all_contact != 0) {

            $customers      = Contact::all();
        }else{

            $customers      = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
                                        ->where('users.branch_id', '=', $branch_id)
                                        ->selectRaw('contact.*')
                                        ->get();
        }
        $projects           = Contact::where('contact_category_id', 10)->get();
        $accounts           = Account::wherein('account_type_id',array(17,19))->get();
        $paid_throughs      = Account::wherein('account_type_id', array(4, 5))->get();

        return view('expense::expense.create', compact('customers', 'accounts', 'paid_throughs', 'projects'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $data                   = $request->all();

        $this->validate($request, [
            'expense_date'      => 'required',
            'account_id'        => 'required',
            'amount'            => 'required',
            'customer_id'       => 'required',
            'paid_through_id'   => 'required',
        ]);

        $total_tax              = 0;
        $user_id                = Auth::user()->id;

        if(isset($request->tax_id))
        {
            $tax_amount         = Tax::find($data['tax_id'])->amount_percentage;

            if($data['amount_is'] == 1)
            {
                $total_tax      = ($data['amount']*($tax_amount/100));
            }
            else
            {
                $total_tax      = ($data['amount']*($tax_amount/110));
            }
        }

        $expense_number_count   = Expense::orderBy('id', 'desc')->first();

        if($expense_number_count){

            $expense_number     = $expense_number_count->expense_number + 1;
        }else{

            $expense_number     = 1;
        }
        
        if(empty($data['paid_through_id']) || empty($data['cheque_number']))
        {
            $data['cheque_number']  = null;
            $data['issue_date']     = null;
        }

        $expense                    = new Expense;

        $expense->date              = date("Y-m-d", strtotime($data['expense_date']));
        $expense->amount            = round($data['amount'] + $total_tax, 2);
        $expense->expense_number    = $expense_number;
        $expense->paid_through_id   = $data['paid_through_id'];
        $expense->cheque_number     = $data['cheque_number'];
        $expense->issue_date        = date("Y-m-d", strtotime($data['issue_date']));
        $expense->tax_total         = round($total_tax, 2);
        $expense->reference         = $data['reference'];
        $expense->project_contact_id= $data['project_contact_id'];
        $expense->note              = $data['customer_note'];
        $expense->account_id        = $data['account_id'];
        $expense->vendor_id         = $data['customer_id'];

        if(isset($request->tax_id)) {
            $expense->tax_id        = $data['tax_id'];
        }
        if(isset($request->amount_is)) {
            $expense->tax_type      = $data['amount_is'];
        }

        $expense->created_by        = $user_id;
        $expense->updated_by        = $user_id;

        if($request->hasFile('file1'))
        {
            $file                   = $request->file('file1');

            if($expense->file_url){

                $delete_path        = public_path($expense->file_url);

                if(file_exists($delete_path)){
                    $delete         = unlink($delete_path);
                }
            }

            $file_name              = $file->getClientOriginalName();
            $without_extention      = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention         = $file->getClientOriginalExtension();
            $num                    = rand(1, 500);
            $new_file_name          = "expense-" . $expense_number . '.' . $file_extention;
            $success                = $file->move('uploads/expense', $new_file_name);

            if($success){
                $expense->file_url  = 'uploads/expense/' . $new_file_name;
            }else{
                $expense->file_url  = null;
            }
        }

        if(isset($data['bank_info']))
        {
            $expense->bank_info     = $data['bank_info'];
        }

        if(isset($data['invoice_show']))
        {
            $expense->invoice_show  = "on";
        }

        if($expense->save())
        {
            $expense_id             = $expense->id;

            $status                 = $this->insertExpenseInJournal($total_tax, $data['amount'], $data, $expense_id);

            if($status)
            {
                DB::commit();

                return redirect()
                    ->route('expense')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Expense added successfully!');
            }
            else
            {
                DB::rollBack();

                return redirect()
                    ->route('expense')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Something went wrong! Please try again.');
            }

        }
    }

    public function show($id)
    {
        $expenses       = [];
        $expense        = Expense::find($id);

        $checkAccess    = $this->checkIfUserHasAccess($expense);

        if($checkAccess == 1){
            return back();
        }

        $branch_id      = session('branch_id');

        $this->getBranchUsers($branch_id);

        if($branch_id == 1)
            $expenses               = Expense::orderBy('id', 'desc')->take(20)->get()->toArray();
        else
          $expenses                 = Expense::orderBy('id', 'desc')->whereIn('created_by',$this->targeted_users)->take(20)->get()->toArray();

        $date                       = "date";
        $sort                       = new sortBydate();
        $expenses                   = $sort->get('\App\Models\MoneyOut\Expense', $date, 'Y-m-d', $expenses);
        $OrganizationProfile        = OrganizationProfile::find(1);

        return view('expense::expense.show', compact('OrganizationProfile', 'expense', 'expenses'));
    }

    public function edit($id)
    {
        $branch_id          = session('branch_id');
        $show_all_contact   = OrganizationProfile::first();
        $show_all_contact   = $show_all_contact->show_all_contact;

        if($branch_id == 1 || $show_all_contact != 0) {

            $customers      = Contact::all();

        }else{

            $customers      = Contact::join('users', 'users.id', '=', 'contact.created_by')
                                        ->where('users.branch_id', '=', $branch_id)
                                        ->selectRaw('contact.*')
                                        ->get();
        }

        $expense            = Expense::find($id);

        $checkAccess        = $this->checkIfUserHasAccess($expense);

        if($checkAccess == 1){
            return back();
        }

        $accounts           = Account::wherein('account_type_id',array(17,19))->get();
        $paid_throughs      = Account::wherein('account_type_id', array(4, 5))->get();

        //CHEQUE AVAIALABLE CALCULATED FROM: PaymentMade, Expense. ASSUMING THAT: HOMECONTROLLER (getChequeNumber & availableChequeNumber) IS THE MAIN FUNCTION
        $chequebooks = Account::find($expense->paid_through_id)->chequeBooks;
        $payment_used_cheque_numbers = PaymentMade::where('account_id',     $expense->paid_through_id)->pluck('cheque_number')->toArray();
        $expense_used_cheque_numbers = Expense::where('paid_through_id',    $expense->paid_through_id)->pluck('cheque_number')->toArray();
        $bank_used_cheque_numbers    = Bank::where('account_id',            $expense->paid_through_id)->pluck('cheque_number')->toArray();
        $used_cheque_numbers = array_merge($payment_used_cheque_numbers, $expense_used_cheque_numbers, $bank_used_cheque_numbers);

        foreach ($chequebooks as $key => $chequebook) {
            $page_numbers = range($chequebook->start_page_no, ($chequebook->start_page_no + $chequebook->number_of_pages - 1), 1);
            $available_cheque_numbers = array_diff($page_numbers, $used_cheque_numbers);
            $cheque_numbers = array_merge([$expense->cheque_number], $available_cheque_numbers);
        }
        $cheque_numbers = $cheque_numbers ?? [];
        $projects           = Contact::where('contact_category_id', 10)->get();

        return view('expense::expense.edit', compact('customers', 'accounts', 'paid_throughs','expense', 'cheque_numbers', 'projects'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $data                   = $request->all();

        $this->validate($request, [
            'expense_date'      => 'required',
            'account_id'        => 'required',
            'amount'            => 'required',
            'customer_id'       => 'required',
            'paid_through_id'   => 'required',
        ]);

        $total_tax              = 0;
        $user_id                = Auth::user()->id;

        if(isset($request->tax_id)) {

            $tax_amount         = Tax::find($data['tax_id'])->amount_percentage;

            if($data['amount_is'] == 1)
            {
                $total_tax      = ($data['amount'] * ($tax_amount / 100));
            }
            else
            {
                $total_tax      = ($data['amount'] * ($tax_amount / 110));
            }
        }
        
        if(empty($data['paid_through_id']) || empty($data['cheque_number']))
        {
            $data['cheque_number']  = null;
            $data['issue_date']     = null;
        }

        $expense                    = Expense::find($id);
        $expense->date              = date("Y-m-d", strtotime($data['expense_date']));
        $expense->amount            = round($data['amount'] + $total_tax, 2);
        $expense->paid_through_id   = $data['paid_through_id'];
        $expense->cheque_number     = $data['cheque_number'];
        $expense->issue_date        = date("Y-m-d", strtotime($data['issue_date']));
        $expense->tax_total         = round($total_tax, 2);
        $expense->reference         = $data['reference'];
        $expense->project_contact_id= $data['project_contact_id'] ?? null;
        $expense->note              = $data['customer_note'];
        $expense->account_id        = $data['account_id'];
        $expense->vendor_id         = $data['customer_id'];

        if(isset($request->tax_id)) {
            $expense->tax_id        = $data['tax_id'];
        }

        if(isset($request->amount_is)) {
            $expense->tax_type      = $data['amount_is'];
        }

        $expense->updated_by        = $user_id;

        if($request->hasFile('file1'))
        {
            $file                   = $request->file('file1');

            if($expense->file_url){

                $delete_path        = public_path($expense->file_url);

                if(file_exists($delete_path)){
                    $delete         = unlink($delete_path);
                }

            }

            $file_name              = $file->getClientOriginalName();
            $without_extention      = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention         = $file->getClientOriginalExtension();
            $num                    = rand(1, 500);
            $new_file_name          = "expense-".$expense->expense_number.'.'.$file_extention;
            $success                = $file->move('uploads/expense', $new_file_name);

            if($success){
                $expense->file_url  = 'uploads/expense/' . $new_file_name;
            }else{
                $expense->file_url  = null;
            }
        }

        if(isset($data['bank_info']))
        {
            $expense->bank_info     = $data['bank_info'];
        }

        if(isset($data['invoice_show']))
        {
            $expense->invoice_show = "on";
        }
        else
        {
            $expense->invoice_show = "";
        }

        if($expense->update())
        {

            $status                 = $this->updateExpenseInJournal($total_tax, $data['amount'], $data, $id);

            if($status)
            {
                DB::commit();

                return redirect()
                    ->route('expense')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Expense updated successfully!');
            }
            else
            {
                DB::rollback();

                return redirect()
                    ->route('expense')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Something went wrong! Please try agian.');

            }
        }
    }

    public function destroy($id)
    {
        try{

            $expense            = Expense::find($id);

            $checkAccess = $this->checkIfUserHasAccess($expense);

            if($checkAccess == 1){
                return back();
            }

            if($expense->delete())
            {

                if($expense->file_url){

                    $delete_path = public_path($expense->file_url);

                    if(file_exists($delete_path)){

                        $delete = unlink($delete_path);

                    }

                }

                return redirect()
                    ->route('expense')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Expense deleted successfully!!!');

            }

            throw new \Exception(" ");

        }catch (\Exception $exception){

            $msg                = $exception->getMessage();

            return redirect()
                ->route('expense')
                ->with('alert.status', 'danger')
                ->with('alert.message', "Expense is not deleted!!!. $msg ");

        }
    }

    public function insertExpenseInJournal($total_tax, $total_amount, $data, $expense_id)
    {
        $user_id                            = Auth::user()->id;

        $journal_entry                      = new JournalEntry;
        $journal_entry->debit_credit        = 0;
        $journal_entry->amount              = round(($total_tax + $total_amount) , 2);
        $journal_entry->jurnal_type         = "expense";
        $journal_entry->account_name_id     = $data['paid_through_id'];
        $journal_entry->contact_id          = $data['customer_id'];
        $journal_entry->note                = $data['customer_note'];
        $journal_entry->expense_id          = $expense_id;
        $journal_entry->assign_date         = date('Y-m-d', strtotime($data['expense_date']));
        $journal_entry->created_by          = $user_id;
        $journal_entry->updated_by          = $user_id;

        if($journal_entry->save())
        {
            $journal_entry                  = new JournalEntry;
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = round($total_amount, 2);
            $journal_entry->jurnal_type     = "expense";
            $journal_entry->account_name_id = $data['account_id'];
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->expense_id      = $expense_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['expense_date']));
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;

            if($journal_entry->save())
            {
                if($total_tax > 0){

                    $journal_entry                  = new JournalEntry;
                    $journal_entry->debit_credit    = 1;
                    $journal_entry->amount          = round($total_tax, 2);
                    $journal_entry->jurnal_type     = "expense";
                    $journal_entry->account_name_id = 9;
                    $journal_entry->contact_id      = $data['customer_id'];
                    $journal_entry->note            = $data['customer_note'];
                    $journal_entry->assign_date     = date('Y-m-d', strtotime($data['expense_date']));
                    $journal_entry->expense_id      = $expense_id;
                    $journal_entry->created_by      = $user_id;
                    $journal_entry->updated_by      = $user_id;

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
                    return true;
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

    public function updateExpenseInJournal($total_tax, $total_amount, $data, $expense_id)
    {
        $user_id                        = Auth::user()->id;

        $expense_entries_delete         = Expense::find($expense_id)->journalEntries();

        if($expense_entries_delete->delete())
        {

        }

        $journal_entry                      = new JournalEntry;
        $journal_entry->debit_credit        = 0;
        $journal_entry->amount              = round(($total_tax + $total_amount), 2);
        $journal_entry->jurnal_type         = "expense";
        $journal_entry->account_name_id     = $data['paid_through_id'];
        $journal_entry->contact_id          = $data['customer_id'];
        $journal_entry->note                = $data['customer_note'];
        $journal_entry->expense_id          = $expense_id;
        $journal_entry->created_by          = $user_id;
        $journal_entry->updated_by          = $user_id;
        $journal_entry->assign_date         = date('Y-m-d', strtotime($data['expense_date']));

        if($journal_entry->save())
        {
            $journal_entry                  = new JournalEntry;
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = round($total_amount, 2);
            $journal_entry->jurnal_type     = "expense";
            $journal_entry->account_name_id = $data['account_id'];
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->expense_id      = $expense_id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['expense_date']));

            if($journal_entry->save())
            {
                if($total_tax > 0)
                {

                    $journal_entry                  = new JournalEntry;
                    $journal_entry->debit_credit    = 1;
                    $journal_entry->amount          = round($total_tax, 2);
                    $journal_entry->jurnal_type     = "expense";
                    $journal_entry->account_name_id = 9;
                    $journal_entry->contact_id      = $data['customer_id'];
                    $journal_entry->note            = $data['customer_note'];
                    $journal_entry->expense_id      = $expense_id;
                    $journal_entry->created_by      = $user_id;
                    $journal_entry->updated_by      = $user_id;
                    $journal_entry->assign_date     = date('Y-m-d', strtotime($data['expense_date']));

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
                    return true;
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

    public function checkIfUserHasAccess($expense)
    {

        $user_branch    = Auth::user()->branch_id;

        if($expense->createdBy->branch_id != $user_branch && $user_branch != 1){
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
