<?php

namespace App\Modules\Bank\Http\Controllers;

use DB;
use App\User;
use DateTime;
use Validator;
use Carbon\Carbon;
use App\Models\Tax;
use Dompdf\Exception;

use App\Http\Requests;
use App\Lib\BankReport;


use App\Lib\sortBydate;
use App\Models\Bank\Bank;

use Illuminate\Http\Request;
use App\Models\Bank\BankName;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Bank\ChequeBook;
use App\Models\Contact\Contact;
use App\Models\Inventory\Stock;
use App\Models\Moneyin\Invoice;
use App\Models\MoneyOut\Expense;
use App\Models\Inventory\Product;

use App\Http\Controllers\Controller;
use App\Models\AccountChart\Account;
use App\Models\MoneyOut\PaymentMade;
use Illuminate\Support\Facades\Auth;
use App\Models\ManualJournal\Journal;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ProductPhase;
use App\Models\Contact\ContactCategory;
use App\Models\Moneyin\PaymentReceives;
use App\Models\PaymentMode\PaymentMode;
use Illuminate\Support\Facades\Session;
use App\Models\AccountChart\AccountType;
use Illuminate\Support\Facades\Redirect;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\ManualJournal\JournalEntry;

use App\Models\Inventory\ProductPhaseItemAdd;
use App\Models\AccountChart\ParentAccountType;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\OrganizationProfile\OrganizationProfile;

class HomeController extends Controller
{
    private $branch_id       = 0;
    private $targeted_users  = [];

    public function deposit()
    {
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $condition = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";

        if ($branch_id == 1) {
            $branchs = Branch::orderBy('id', 'asc')->get();

            $banks = Bank::orderBy('date', 'desc')
                ->where('type', 'Deposit')
                ->whereRaw($condition)
                ->get()
                ->toArray();
            $date = "date";
            $sort = new sortBydate();
            try {
                $banks = $sort->get('\App\Models\Bank\Bank', $date, 'Y-m-d', $banks);
                return view('bank::deposit', compact('banks', 'branchs'));
            } catch (\Exception $exception) {
                return view('bank::deposit', compact('banks', 'branchs'));
            }
        } else {
            $branchs = Branch::orderBy('id', 'asc')->get();

            $banks = Bank::select('bank.*')
                ->where('bank.type', 'Deposit')
                ->whereRaw($condition)->join('users', 'users.id', '=', 'bank.created_by')->where('users.branch_id', $branch_id)->get()->toArray();
            $date = "date";
            $sort = new sortBydate();
            try {
                $banks = $sort->get('\App\Models\Bank\Bank', $date, 'Y-m-d', $banks);
                return view('bank::deposit', compact('banks', 'branchs'));
            } catch (\Exception $exception) {
                return view('bank::deposit', compact('banks', 'branchs'));
            }
        }
    }

    public function withdraw()
    {
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $condition = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";

        if ($branch_id == 1) {
            $branchs = Branch::orderBy('id', 'asc')->get();

            $banks = Bank::orderBy('date', 'desc')
                ->where('type', 'Withdrawal')
                ->whereRaw($condition)
                ->get()
                ->toArray();

            $date = "date";
            $sort = new sortBydate();
            try {
                $banks = $sort->get('\App\Models\Bank\Bank', $date, 'Y-m-d', $banks);
                return view('bank::withdraw', compact('banks', 'branchs'));
            } catch (\Exception $exception) {
                return view('bank::withdraw', compact('banks', 'branchs'));
            }
        } else {
            $branchs = Branch::orderBy('id', 'asc')->get();

            $banks = Bank::select('bank.*')
                ->where('bank.type', 'Withdrawal')
                ->whereRaw($condition)->join('users', 'users.id', '=', 'bank.created_by')->where('users.branch_id', $branch_id)->get()->toArray();
            $date = "date";
            $sort = new sortBydate();
            try {
                $banks = $sort->get('\App\Models\Bank\Bank', $date, 'Y-m-d', $banks);
                return view('bank::withdraw', compact('banks', 'branchs'));
            } catch (\Exception $exception) {
                return view('bank::withdraw', compact('banks', 'branchs'));
            }
        }
    }

    public function searchDeposit(Request $request)
    {
        $branchs = Branch::orderBy('id', 'asc')->get();
        if (session('branch_id') == 1) {
            $branch_id =  $request->branch_id ? $request->branch_id : session('branch_id');
        } else {
            $branch_id = session('branch_id');
        }
        $from_date =  date('Y-m-d', strtotime($request->from_date));
        $to_date =  date('Y-m-d', strtotime($request->to_date));
        $condition = "str_to_date(date, '%Y-%m-%d') between '$from_date' and '$to_date'";
        if ($branch_id == 1) {
            $banks = Bank::select('bank.*')
                ->whereRaw($condition)
                ->where('bank.type', 'Deposit')
                ->get()->toArray();
        } else {
            $banks = Bank::select('bank.*')
                ->whereRaw($condition)
                ->where('bank.type', 'Deposit')
                ->join('users', 'users.id', '=', 'bank.created_by')
                ->where('branch_id', $branch_id)
                ->get()->toArray();
        }
        $date = "date";
        $sort = new sortBydate();
        try {
            $banks = $sort->get('\App\Models\Bank\Bank', $date, 'Y-m-d', $banks);
            return view('bank::deposit', compact('banks', 'branchs', 'branch_id', 'from_date', 'to_date'));
        } catch (\Exception $exception) {
            return view('bank::deposit', compact('banks', 'branchs', 'branch_id', 'from_date', 'to_date'));
        }
    }

    public function searchWithdraw(Request $request)
    {
        $branchs = Branch::orderBy('id', 'asc')->get();
        if (session('branch_id') == 1) {
            $branch_id =  $request->branch_id ? $request->branch_id : session('branch_id');
        } else {
            $branch_id = session('branch_id');
        }

        $from_date =  date('Y-m-d', strtotime($request->from_date));
        $to_date =  date('Y-m-d', strtotime($request->to_date));
        $condition = "str_to_date(date, '%Y-%m-%d') between '$from_date' and '$to_date'";

        if ($branch_id == 1) {
            $banks = Bank::select('bank.*')
                ->whereRaw($condition)
                ->where('bank.type', 'Withdrawal')
                ->get()
                ->toArray();
        } else {
            $banks = Bank::select('bank.*')
                ->whereRaw($condition)
                ->where('bank.type', 'Withdrawal')
                ->join('users', 'users.id', '=', 'bank.created_by')
                ->where('branch_id', $branch_id)
                ->get()
                ->toArray();
        }
        $date = "date";
        $sort = new sortBydate();
        try {
            $banks = $sort->get('\App\Models\Bank\Bank', $date, 'Y-m-d', $banks);
            return view('bank::withdraw', compact('banks', 'branchs', 'branch_id', 'from_date', 'to_date'));
        } catch (\Exception $exception) {

            return view('bank::withdraw', compact('banks', 'branchs', 'branch_id', 'from_date', 'to_date'));
        }
    }

    public function create($id)
    {
        $bank_names = Contact::where('contact_category_id', 5)->get();
        $accounts = Account::where('account_type_id', 5)->get();
        $payment_mode = Account::whereIn('account_type_id', [4, 5])->get();
        return view('bank::create', compact('bank_names', 'accounts', 'payment_mode', 'id'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'type'           => 'required',
            'bank_name_id'   => 'required',
            'particulars'    => 'required',
            'date'           => 'required',
            'total_amount'   => 'required|numeric',
            'payment_mode'   => 'required',

        ]);

        DB::beginTransaction();
        try {

            $bankacc = explode('/', $data['bank_name_id']);
            $contact = Contact::find(!empty($bankacc[0]) ? $bankacc[0] : null);
            $contact = isset($contact->display_name) ? $contact->display_name : "no_name";
            $bank = new Bank;
            if (isset($request->invoice_show)) {
                $bank->invoice_show         = 1;
            } else {
                $bank->invoice_show         = 0;
            }

            if(empty($data['cheque_number']) || empty($data['issue_date']))
            {
                $data['cheque_number']  = null; 
                $data['issue_date']     = null;
            }
            
            $bank->type                 = $data['type'];
            $bank->contact_id           = $bankacc[0];
            $bank->particulars          = $data['particulars'];
            $bank->date                 =  date('Y-m-d', strtotime($data['date']));
            $bank->cheque_number        = $data['cheque_number'];
            $bank->issue_date           = $data['issue_date'];
            $bank->total_amount         = $data['total_amount'];
            $bank->notes                = $data['notes'];
            $bank->payment_mode_id      = $data['payment_mode'];
            $bank->account_id           = $bankacc[1];
            $bank->created_by           = Auth::id();
            $bank->updated_by           = Auth::id();
            $bank->bank_account_number  = isset($data['bank_account_number']) ? $data['bank_account_number'] : Null;
            if ($request->hasFile('file1')) {


                $file = $request->file('file1');

                if ($bank->file_url) {
                    $delete_path = public_path($bank->file_url);
                    if (file_exists($delete_path)) {
                        $delete = unlink($delete_path);
                    }
                }

                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1, 500);
                $new_file_name = "Bank-" . $bank->type . "-" . $num . '_' . $contact . '.' . $file_extention;
                $success = $file->move('uploads/bank', $new_file_name);
                if ($success) {
                    $bank->file_url = 'uploads/bank/' . $new_file_name;
                }
            }

            if ($bank->save()) {

                $bank = Bank::orderBy('created_at', 'desc')->first();

                $journal_entry = new JournalEntry;
                $journal_entry->amount              = $data['total_amount'];
                $journal_entry->contact_id           = $bankacc[0];
                $journal_entry->assign_date           = date('Y-m-d', strtotime($data['date']));
                $journal_entry->debit_credit        = $data['type'] == 'Deposit' ? 1 : 0;
                $journal_entry->account_name_id     = $bankacc[1];
                $journal_entry->jurnal_type         = 'bank';
                $journal_entry->bank_id             = $bank->id;
                $journal_entry->created_by          = Auth::id();
                $journal_entry->updated_by          = Auth::id();
                $journal_entry->save();

                $journal_entry = new JournalEntry;
                $journal_entry->amount              = $data['total_amount'];
                $journal_entry->contact_id           = $bankacc[0];
                $journal_entry->assign_date           = date('Y-m-d', strtotime($data['date']));
                $journal_entry->debit_credit        = $data['type'] == 'Deposit' ? 0 : 1;
                $journal_entry->account_name_id     = $data['payment_mode'];
                $journal_entry->jurnal_type         = 'bank';
                $journal_entry->bank_id             = $bank->id;
                $journal_entry->created_by          = Auth::id();
                $journal_entry->updated_by          = Auth::id();

                if ($journal_entry->save()) {
                    DB::commit();
                    if ($request->type == 'Deposit') {
                        return redirect()
                            ->route('bank_deposit')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Bank updated successfully!');
                    }
                    if ($request->type == 'Withdrawal') {
                        return redirect()
                            ->route('bank_withdraw')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Bank updated successfully!');
                    }
                } else {

                    if ($request->type == 'Deposit') {
                        return redirect()
                            ->route('bank_deposit')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! Please Insert Data Again.!');
                    }
                    if ($request->type == 'Withdrawal') {
                        return redirect()
                            ->route('bank_withdraw')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! Please Insert Data Again.!');
                    }
                }
            } else {

                DB::rollBack();
                if ($request->type == 'Deposit') {
                    return redirect()
                        ->route('bank_deposit')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Something went to wrong! Please Insert Data Again.!');
                }
                if ($request->type == 'Withdrawal') {
                    return redirect()
                        ->route('bank_withdraw')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Something went to wrong! Please Insert Data Again.!');
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            if ($exception instanceof \Illuminate\Database\QueryException) {

                if (\App::environment('development', 'local')) {
                    $msg = $exception->getMessage();
                }

                if (isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && count($exception->errorInfo) == 3) {
                    if (isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && isset($exception->errorInfo[2]) && $exception->errorInfo[0] == "42000" && $exception->errorInfo[1] == "1142") {
                        $msg = explode("@", $exception->errorInfo[2])[0];
                    }

                    if ($exception->getCode() == "42000") {
                        return back()
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'You not allowed at this moment' . " " . $msg);
                    }
                }
            }
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went to wrong! Please Insert Data Again.');
        }
    }

    public function show($id)
    {


        $bank_names = Contact::where('contact_category_id', 5)->get();

        $bank = Bank::find($id);

        $checkAccess = $this->checkIfUserHasAccess($bank);

        if ($checkAccess == 1) {
            return back();
        }

        $payment_mode = Account::where('id', $bank->payment_mode_id)->first();
        $accounts = Account::where('id', $bank->account_id)->first();
        $OrganizationProfile = OrganizationProfile::find(1);

        return view('bank::show', compact('bank', 'payment_mode', 'accounts', 'bank_names', 'OrganizationProfile'));
    }

    public function showupload(Request $request, $id = null)
    {
        $Bank = Bank::find($id);
        $validator = Validator::make($request->all(), [
            'file1' => 'required|max:10240',

        ]);
        $contact = isset($Bank->contact->display_name) ? $Bank->contact->display_name : 'no_name';
        if ($request->hasFile('file1')) {
            $file = $request->file('file1');

            if ($Bank->file_url) {
                $delete_path = public_path($Bank->file_url);
                if (file_exists($delete_path)) {
                    $delete = unlink($delete_path);
                }
            }

            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "Bank-" . $Bank->type . "-" . $num . '_' . $contact . '.' . $file_extention;

            $success = $file->move('uploads/bank', $new_file_name);

            if ($success) {
                $Bank->file_url = 'uploads/bank/' . $new_file_name;
                //$Bank->file_name = $new_file_name;

                $Bank->save();
                return response("success");
            } else {
                return response("success");
            }
        } else {
            return response("file not found");
        }
    }

    public function edit($id)
    {
        $bank_names = Contact::where('contact_category_id', 5)->get();
        $accounts = Account::where('account_type_id', 5)->get();
        $payment_mode = Account::whereIn('account_type_id', [4, 5])->get();

        $bank = Bank::find($id);

        $available_cheque_numbers = $this->availableChequeNumber($bank->account_id);

        $checkAccess = $this->checkIfUserHasAccess($bank);

        if ($checkAccess == 1) {
            return back();
        }

        return view('bank::edit', compact('bank', 'bank_names', 'payment_mode', 'accounts', 'available_cheque_numbers'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type'           => 'required',
            'bank_name_id'   => 'required',
            'particulars'    => 'required',
            'date'           => 'required',

            'total_amount'   => 'required|numeric',

            'payment_mode'   => 'required',
            'account'        => 'required',
        ]);
        DB::beginTransaction();
        try {

            $data = $request->all();
            $bankacc = explode('/', $data['bank_name_id']);
            $bank = Bank::find($id);
            $contact = Contact::find(!empty($bankacc[0]) ? $bankacc[0] : null);
            $contact = isset($contact->display_name) ? $contact->display_name : "no_name";
            if (isset($request->invoice_show)) {
                $bank->invoice_show         = 1;
            } else {
                $bank->invoice_show         = 0;
            }

            if ($request->hasFile('file1')) {


                $file = $request->file('file1');

                if ($bank->file_url) {
                    $delete_path = public_path($bank->file_url);
                    if (file_exists($delete_path)) {
                        $delete = unlink($delete_path);
                    }
                }

                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1, 500);
                $new_file_name = "Bank-" . $bank->type . "-" . $num . '_' . $contact . '.' . $file_extention;
                $success = $file->move('uploads/bank', $new_file_name);
                if ($success) {
                    $bank->file_url = 'uploads/bank/' . $new_file_name;
                }
            }

            $bank->type                 = $data['type'];
            $bank->contact_id           = $bankacc[0];
            $bank->particulars          = $data['particulars'];
            $bank->date                 = date('Y-m-d', strtotime($data['date']));
            $bank->cheque_number        = $data['cheque_number'];
            $bank->issue_date           = date("Y-m-d", strtotime($data['issue_date']));
            $bank->total_amount         = $data['total_amount'];
            $bank->notes                = $data['notes'];
            $bank->payment_mode_id      = $data['payment_mode'];
            $bank->account_id           = $bankacc[1];
            $bank->updated_by           = Auth::id();
            $bank->bank_account_number  = isset($data['bank_account_number']) ? $data['bank_account_number'] : Null;

            if ($bank->update()) {
                //Update Time
                $created = JournalEntry::where('bank_id', $id)->first();

                $created_by = $created->created_by;
                $created_at = $created->created_at->toDateTimeString();
                $updated_at = \Carbon\Carbon::now()->toDateTimeString();

                JournalEntry::where('bank_id', $id)->delete();
                $journal_entry = new JournalEntry;
                $journal_entry->amount              = $data['total_amount'];
                $journal_entry->contact_id           = $bankacc[0];
                $journal_entry->assign_date           = date('Y-m-d', strtotime($data['date']));
                $journal_entry->debit_credit        =  $data['type'] == 'Deposit' ? 1 : 0;
                $journal_entry->account_name_id     = $bankacc[1];
                $journal_entry->jurnal_type         = 'bank';
                $journal_entry->bank_id             = $bank->id;
                $journal_entry->created_by          = $created_by;
                $journal_entry->updated_by          = Auth::id();
                $journal_entry->created_at          = $created_at;
                $journal_entry->updated_at          = $updated_at;
                $journal_entry->save();

                $journal_entry = new JournalEntry;
                $journal_entry->amount              = $data['total_amount'];
                $journal_entry->contact_id           = $bankacc[0];
                $journal_entry->assign_date           = date('Y-m-d', strtotime($data['date']));
                $journal_entry->debit_credit        =  $data['type'] == 'Deposit' ? 0 : 1;
                $journal_entry->account_name_id     = $data['payment_mode'];
                $journal_entry->jurnal_type         = 'bank';
                $journal_entry->bank_id             = $bank->id;
                $journal_entry->created_by          = $created_by;
                $journal_entry->updated_by          = Auth::id();
                $journal_entry->created_at          = $created_at;
                $journal_entry->updated_at          = $updated_at;

                if ($journal_entry->save()) {
                    DB::commit();
                    if ($request->type == 'Deposit') {
                        return redirect()
                            ->route('bank_deposit')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Bank updated successfully!');
                    }
                    if ($request->type == 'Withdrawal') {
                        return redirect()
                            ->route('bank_withdraw')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Bank updated successfully!');
                    }
                } else {

                    DB::rollBack();
                    return redirect()
                        ->route('bank_edit', ['id' => $id])
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Something went to wrong! please check your input field!!!');
                }
            } else {
                DB::rollBack();
                return redirect()
                    ->route('bank_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Something went to wrong! please check your input field!!!');
            }
        } catch (\Exception $exception) {
            //dd($exception->getMessage());
            DB::rollBack();
            if ($exception instanceof \Illuminate\Database\QueryException) {

                if (\App::environment('development', 'local')) {
                    $msg = $exception->getMessage();
                }

                if (isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && count($exception->errorInfo) == 3) {
                    if (isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && isset($exception->errorInfo[2]) && $exception->errorInfo[0] == "42000" && $exception->errorInfo[1] == "1142") {
                        $msg = explode("@", $exception->errorInfo[2])[0];
                    }

                    if ($exception->getCode() == "42000") {
                        return back()
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'You not allowed at this moment' . ". " . $msg);
                    }
                }
            }
            return redirect()
                ->route('bank_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went to wrong! please check your input field!!!');
        }
    }

    public function destroy($id)
    {
        $bank = Bank::find($id);

        $checkAccess = $this->checkIfUserHasAccess($bank);

        if ($checkAccess == 1) {
            return back();
        }

        if ($bank->file_url) {
            $delete_path = public_path($bank->file_url);
            if (file_exists($delete_path)) {
                $delete = unlink($delete_path);
            }
        }
        if ($bank->delete()) {
            if ($bank->type == "Withdrawal") {
                return redirect()
                    ->route('bank_withdraw')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Bank Transaction deleted successfully!!!');
            } else {
                return redirect()
                    ->route('bank_deposit')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Bank Transaction deleted successfully!!!');
            }
        }
    }

    // report -----------

    public function report(Request $request)
    {
        if ($request->branch_id) {
            $branch_id    =  $request->branch_id;
        } else {
            $branch_id    =  session('branch_id');
        }

        $this->getBranchUsers($branch_id);

        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time        = Carbon::now()->toDayDateTimeString();
        $start               = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                 = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $branch              = Branch::all();

        if ($branch_id == 1) {
            if ($request->todaydeposit) {
                //masterdashboard
                $bank = JournalEntry::whereDate('journal_entries.assign_date', date('Y-m-d'))->join('account', 'journal_entries.account_name_id', '=', 'account.id')->where('account.account_type_id', 5)->where('journal_entries.debit_credit', 1)->get();

                // $bank  = $bank->whereIn('created_by', $this->targeted_users);

            } elseif ($request->todaywithdraw) {
                //masterdashboard
                $bank = JournalEntry::whereDate('journal_entries.assign_date', date('Y-m-d'))->join('account', 'journal_entries.account_name_id', '=', 'account.id')->where('account.account_type_id', 5)->where('journal_entries.debit_credit', 0)->get();

                // $bank  = $bank->whereIn('created_by', $this->targeted_users);

            } else {
                $bank = JournalEntry::join('contact', 'journal_entries.account_name_id', '=', 'contact.account_id')->where('contact.contact_category_id', 5)->groupBy('journal_entries.account_name_id')->get()->sortBy('assign_date');

                // $bank  = $bank->whereIn('created_by', $this->targeted_users);

            }
        } else {
            if ($request->todaydeposit) {
                //masterdashboard
                $bank = JournalEntry::whereDate('journal_entries.assign_date', date('Y-m-d'))->join('account', 'journal_entries.account_name_id', '=', 'account.id')->where('account.account_type_id', 5)->where('journal_entries.debit_credit', 1)->get();

                $bank  = $bank->whereIn('created_by', $this->targeted_users);
            } elseif ($request->todaywithdraw) {
                //masterdashboard
                $bank = JournalEntry::whereDate('journal_entries.assign_date', date('Y-m-d'))->join('account', 'journal_entries.account_name_id', '=', 'account.id')->where('account.account_type_id', 5)->where('journal_entries.debit_credit', 0)->get();

                $bank  = $bank->whereIn('created_by', $this->targeted_users);
            } else {
                $bank = JournalEntry::join('contact', 'journal_entries.account_name_id', '=', 'contact.account_id')->where('contact.contact_category_id', 5)->selectRaw('journal_entries.*, contact.display_name as display_name, contact.id as id')->groupBy('journal_entries.account_name_id')->get()->sortBy('assign_date');

                $bank  = $bank->whereIn('created_by', $this->targeted_users);
            }
        }

        $bank  = $bank->groupBy('account_name_id');

        $branch_name  = Branch::where('id', $branch_id)->first();

        return view('bank::bank_report', compact('OrganizationProfile', 'start', 'end', 'bank', 'branch', 'branch_id', 'branch_name'));
    }

    public function bankreportfilter(Request $request)
    {
        if ($request->branch_id) {
            $branch_id    =  $request->branch_id;
        } else {
            $branch_id    =  session('branch_id');
        }

        $this->getBranchUsers($branch_id);

        $this->validate($request, [
            'from_date' => 'required',
            'to_date'   => 'required',

        ]);

        $OrganizationProfile  = OrganizationProfile::find(1);
        $start                = $request->from_date;
        $end                  = $request->to_date;
        $branch               = Branch::all();

        if ($branch_id == 1) {
            $bank  = JournalEntry::join('contact', 'journal_entries.account_name_id', '=', 'contact.account_id')
                ->where('contact.contact_category_id', 5)
                // ->groupBy('journal_entries.account_name_id')
                ->whereIn('journal_entries.created_by', $this->targeted_users)
                ->get()
                ->sortBy('assign_date');
        } else {
            $bank  = JournalEntry::join('contact', 'journal_entries.account_name_id', '=', 'contact.account_id')
                ->where('contact.contact_category_id', 5)
                // ->groupBy('journal_entries.account_name_id')
                ->whereIn('journal_entries.created_by', $this->targeted_users)
                ->get()
                ->sortBy('assign_date');
        }

        $bank  = $bank->groupBy('account_name_id');

        $branch_name  = Branch::where('id', $branch_id)->first();

        return view('bank::bank_report', compact('OrganizationProfile', 'start', 'end', 'bank', 'branch', 'branch_id', 'branch_name'));
    }

    public function reportDetails($id, $branch_id = 1, $start = null, $end = null)
    {

        $branch_id                  = $branch_id;
        $this->getBranchUsers($branch_id);

        if ($branch_id != session('branch_id') && session('branch_id') != 1) {
            return back();
        }

        try {
            $OrganizationProfile  = OrganizationProfile::find(1);
            $current_time         = Carbon::now()->toDayDateTimeString();
            $start                = $start;
            $end                  = date('Y-m-d', strtotime($end . ' +0 day'));

            if ($branch_id == 1) {
                $bank                 = JournalEntry::join('contact', 'journal_entries.account_name_id', '=', 'contact.account_id')->where('account_name_id', $id)->whereBetween('assign_date', array($start, $end))->orderBy('assign_date', 'asc')->get();
            } else {
                $bank                 = JournalEntry::join('contact', 'journal_entries.account_name_id', '=', 'contact.account_id')->where('account_name_id', $id)->whereBetween('assign_date', array($start, $end))->selectRaw('journal_entries.*')->orderBy('assign_date', 'asc')->get();

                $bank  = $bank->whereIn('created_by', $this->targeted_users);
            }

            $bank_name            = Contact::where('account_id', $id)->first();
            $end                  = date('Y-m-d', strtotime($end . ' +0 day'));
            $branch               = Branch::all();
            $branch_name          = Branch::where('id', $branch_id)->first();

            return view('bank::report_details', compact('OrganizationProfile', 'start', 'end', 'bank', 'bank_name', 'id', 'branch', 'branch_id', 'branch_name'));
        } catch (\Exception $e) {
            return back();
        }
    }

    public function reportDetailsbyfilter($id, $start = null, $end = null)
    {
        if ($request->branch_id) {
            $branch_id  =  $request->branch_id;
        } else {
            $branch_id  =  session('branch_id');
        }

        $this->getBranchUsers($branch_id);

        if ($branch_id != session('branch_id') && session('branch_id') != 1) {
            return back();
        }

        try {

            $OrganizationProfile  = OrganizationProfile::find(1);
            $current_time         = Carbon::now()->toDayDateTimeString();
            $start                = $start;
            $end                  = $end;

            if ($branch_id == 1) {
                $bank                 = JournalEntry::where('contact_id', $id)->whereBetween('assign_date', array($start, $end))->get()->sortBy('assign_date');
            } else {
                $bank                 = JournalEntry::where('contact_id', $id)->whereBetween('assign_date', array($start, $end))->selectRAw('journal_entries.*')->get()->sortBy('assign_date');
                $bank                 = $bank->whereIn('created_by', $this->targeted_users);
            }

            $bank_name            = Contact::find($id);
            $branch               = Branch::all();


            return view('bank::report_details', compact('OrganizationProfile', 'start', 'end', 'bank', 'bank_name', 'branch', 'branch_id'));
        } catch (\Exception $e) {
            return back();
        }
    }

    public function processfilterForm(Request $request, $id)
    {
        try {
            $start      = $request->from_date;
            $end        = $request->to_date;
            $id         = $id;
            $branch_id  = $request->branch_id;

            return Redirect::to('bank/report' . '/' . $id . '/' . $branch_id . '/' . $start . '/' . $end);
        } catch (\Exception $e) {
            return back();
        }
    }

    public function getBranchUsers($branch_id)
    {
        $tmp_targeted_users      = [];
        $this->targeted_users    = [];

        $this->branch_id = $branch_id;

        if ($branch_id == 1) {
            $branch_users = User::all();
        } else {
            $branch_users = User::where('branch_id', $this->branch_id)->get();
        }

        if (isset($branch_users)) {

            foreach ($branch_users as $users) {
                $tmp_targeted_users[] = $users->id;
            }
        } else {

            $tmp_targeted_users = [];
        }

        $this->targeted_users = $tmp_targeted_users;
    }

    public function collectionAttributeSum($data)
    {
        $summed_value = 0;

        if (count($data) > 0) {

            foreach ($data as $tmp_data) {
                $summed_value = (float)$summed_value + (float)$tmp_data['amount'];
            }

            return $summed_value;
        } else {
            return 0;
        }
    }

    public function checkIfUserHasAccess($bank)
    {

        $user_branch    = Auth::user()->branch_id;

        if ($bank->createdBy->branch_id != $user_branch && $user_branch != 1) {
            return 1;
        }
    }

    public function chequeBook()
    {
        $cheque_books = ChequeBook::all();
        $branches = Branch::all();

        return view('bank::cheque_book.index', compact('cheque_books', 'branches'));
    }

    public function createChequeBook()
    {
        $branches = Branch::all();
        $banks = Account::where('account_type_id', 5)->get();
        return view('bank::cheque_book.create', compact('banks', 'branches'));
    }

    public function storeChequeBook(Request $request)
    {
        try {
            $validatiolist = [
                'collection_date'       => 'required',
                'bank_id'               => 'required',
                'start_page_no'         => 'required|numeric',
                'number_of_pages'       => 'required|numeric',
                'branch_id'             => 'required'
            ];

            $this->validate($request, $validatiolist);

            ChequeBook::create([
                'book_collection_date'  => date('Y-m-d', strtotime($request->collection_date)),
                'bank_id'               => $request->bank_id,
                'start_page_no'         => $request->start_page_no,
                'number_of_pages'       => $request->number_of_pages,
                'branch_id'             => $request->branch_id,
                'created_by'            => Auth::user()->id,
                'updated_by'            => Auth::user()->id,
                'created_at'            => Carbon::now()->toDateTimeString(),
                'updated_at'            => Carbon::now()->toDateTimeString()
            ]);

            return redirect()
                ->route('cheque_book')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Cheque Book added successfully!!!');
        } catch (\Exception $e) {
            return redirect()
                ->route('cheque_book')
                ->with('alert.status', 'danger')
                ->with('alert.message', $e->getMessage());
        }
    }

    public function editChequeBook($id)
    {
        try {
            $cheque_book = ChequeBook::findorfail($id);
            $branches = Branch::all();
            $banks = Account::where('account_type_id', 5)->get();
            return view('bank::cheque_book.edit', compact('cheque_book', 'banks', 'branches'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', $e->getMessage());
        }
    }

    public function updateChequeBook(Request $request, $id)
    {
        try {
            $validatiolist = [
                'collection_date'       => 'required',
                'bank_id'               => 'required',
                'start_page_no'         => 'required|numeric',
                'number_of_pages'       => 'required|numeric',
                'branch_id'             => 'required'
            ];

            $this->validate($request, $validatiolist);

            $cheque_book = ChequeBook::findorfail($id);

            $cheque_book->update([
                'book_collection_date'  => date('Y-m-d', strtotime($request->collection_date)),
                'bank_id'               => $request->bank_id,
                'start_page_no'         => $request->start_page_no,
                'number_of_pages'       => $request->number_of_pages,
                'branch_id'             => $request->branch_id,
                'created_by'            => Auth::user()->id,
                'updated_by'            => Auth::user()->id,
                'created_at'            => Carbon::now()->toDateTimeString(),
                'updated_at'            => Carbon::now()->toDateTimeString()
            ]);

            return redirect()
                ->route('cheque_book')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Cheque Book updated successfully!!!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', $e->getMessage());
        }
    }

    public function destroyChequeBook($id)
    {
        try {
            $cheque_book = ChequeBook::findorfail($id);
            $cheque_book->delete();

            return redirect()
                ->route('cheque_book')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Cheque Book deleted successfully!!!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', $e->getMessage());
        }
    }

    public function getChequeNumber($id){
        //CHEQUE AVAIALABLE CALCULATED FROM: PaymentMade, Expense. ASSUMING THAT: HOMECONTROLLER (getChequeNumber & availableChequeNumber) IS THE MAIN FUNCTION
        try{
            $chequebooks = Account::find($id)->chequeBooks;
            $payment_used_cheque_numbers = PaymentMade::where('account_id',     $id)->pluck('cheque_number')->toArray();
            $expense_used_cheque_numbers = Expense::where('paid_through_id',    $id)->pluck('cheque_number')->toArray();
            $bank_used_cheque_numbers    = Bank::where('account_id',            $id)->pluck('cheque_number')->toArray();
            $used_cheque_numbers = array_merge($payment_used_cheque_numbers, $expense_used_cheque_numbers, $bank_used_cheque_numbers);

            foreach ($chequebooks as $key => $chequebook) {
                $page_numbers = range($chequebook->start_page_no, ($chequebook->start_page_no + $chequebook->number_of_pages - 1), 1);
                $available_cheque_numbers = array_diff($page_numbers, $used_cheque_numbers);
                if(count($available_cheque_numbers) > 0){
                    return response()->json(['status' => 'success', 'message' => 'Check Number Available', 'data' => reset($available_cheque_numbers)]);
                }
            }
            return response()->json(['status' => 'danger', 'message' => 'No Cheque Number Available', 'data' => '']);
        }catch(\Exception $e){
            return response()->json(['status' => 'danger', 'message' => $e->getMessage(), 'data' => '']);
        }
    }

    public function availableChequeNumber($id){
        //CHEQUE AVAIALABLE CALCULATED FROM: PaymentMade, Expense. ASSUMING THAT: HOMECONTROLLER (getChequeNumber & availableChequeNumber) IS THE MAIN FUNCTION
        try{
            $chequebooks = Account::find($id)->chequeBooks;
            $payment_used_cheque_numbers = PaymentMade::where('account_id', $id)->pluck('cheque_number')->toArray();
            $expense_used_cheque_numbers = Expense::where('paid_through_id', $id)->pluck('cheque_number')->toArray();
            $bank_used_cheque_numbers    = Bank::where('account_id',            $id)->pluck('cheque_number')->toArray();
            $used_cheque_numbers = array_merge(
                                                $payment_used_cheque_numbers, 
                                                $expense_used_cheque_numbers, 
                                                $bank_used_cheque_numbers
                                            );

            foreach ($chequebooks as $key => $chequebook) {
                $page_numbers = range($chequebook->start_page_no, ($chequebook->start_page_no + $chequebook->number_of_pages - 1), 1);
                $available_cheque_numbers = array_diff($page_numbers, $used_cheque_numbers);
                if(count($available_cheque_numbers) > 0){
                    return response()->json(['status' => 'success', 'message' => 'Check Number Available', 'data' => $available_cheque_numbers]);
                }
            }
            return response()->json(['status' => 'danger', 'message' => 'No Cheque Number Available', 'data' => '']);
        }catch(\Exception $e){
            return response()->json(['status' => 'danger', 'message' => $e->getMessage(), 'data' => '']);
        }
    }
}
