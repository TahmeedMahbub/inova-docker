<?php

namespace App\Modules\Dashboard\Http\Controllers;

use App\Lib\Concatenote;
use App\Models\Bank\Bank;
use App\Models\Deshboard\Reminder;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\PaymentReceives;
use App\Models\MoneyOut\PaymentMade;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\Expense;
use App\Models\AccountChart\Account;
use App\Models\Moneyin\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use Response;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Branch\Branch;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;

class DashboardWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];
    public $OperatingincomeTotal    = null;

    public function index()
    {
        $branch_id              = Auth::user()->branch_id;
        $this->getBranchUsers($branch_id);

        $current_time           = Carbon::now()->toDayDateTimeString();
        $date_modify            = date('d');
        $st_month               = Carbon::now()->startOfMonth();

        $en_month               = Carbon::now()->endOfMonth();

        $time_diff              = date_diff($st_month, $en_month);

        $day                    = $time_diff->days;
        $days                   = $day + 1;
        $end_i                  = floor($days/3);
        $day_diffe              = 30;

        $start_date_count       = $date_modify;
        $end_date_count         = $days - $date_modify;

        $startdate_modify       = '-'.$date_modify.' day';
        $end_date_modify        = '+'.$end_date_count.' day';

        $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
        $end_time               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');

        $start_mounth           = date('Y-m-d', strtotime('-1 month',strtotime($st_month)));

        $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($st_month)));

        $date                   = (new DateTime($current_time))->format('d-m-Y');

        $today                  = Carbon::today()->format('d-m-Y');

        $date_time             = "str_to_date(invoices.invoice_date, '%Y-%m-%d') between '$st_month' and '$en_month'";

        $customer_sales        = Invoice::join('contact','contact.id', 'invoices.customer_id')
                                         ->whereRaw($date_time)
                                         ->selectRaw('SUM(invoices.total_amount) as amount, contact.display_name as display_name, invoices.created_by as created_by')
                                         ->groupBy('invoices.customer_id')
                                         ->orderByRaw('SUM(invoices.total_amount) DESC')
                                         ->get();

        if($branch_id != 1){

            $customer_sales     = $customer_sales->whereIn('created_by', $this->targeted_users)->take(10);

        }

        $branch_id               = Auth::user()->branch_id;
        $nextdatetime            = Carbon::today()->addYear(2);
        $nextreminder            = Reminder::whereBetween('reminddatetime',array(Carbon::tomorrow(),$nextdatetime))->get();
        $todayreminder           = Reminder::whereDate('reminddatetime',date('Y-m-d'))->get();

        $today                   = date('Y-m-d');

        $branch_id               = Auth::user()->branch_id;

        $first_day_crnt_nonth    = date('Y-m-d', strtotime('first day of this month'));
        $last_day_crnt_nonth     = date('Y-m-d', strtotime('last day of this month'));

        $todayincome             = DB::table('journal_entries')
                                        ->join('account', 'journal_entries.account_name_id', '=', 'account.id')
                                        ->join('users', 'journal_entries.created_by', '=', 'users.id')
                                        ->whereDate('journal_entries.assign_date',date('Y-m-d'))
                                        ->where('journal_entries.debit_credit', 1)
                                        ->where('account.account_type_id', 4)
                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', $branch_id);
                                            })
                                        ->sum('journal_entries.amount');

        $todayexpense           = DB::table('journal_entries')->join('account', 'journal_entries.account_name_id', '=', 'account.id')->join('users', 'journal_entries.created_by', '=', 'users.id')
                                                                ->whereDate('journal_entries.assign_date',date('Y-m-d'))->where('journal_entries.debit_credit',0)
                                                                ->where('account.account_type_id',4)
                                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                                ->sum('journal_entries.amount');

        $cash_in_hand           = DB::table('journal_entries')->join('account', 'journal_entries.account_name_id', '=', 'account.id')->join('users', 'journal_entries.created_by', '=', 'users.id')
                                                                ->where('journal_entries.debit_credit',0)->where('account.account_type_id',4)
                                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                                ->sum('journal_entries.amount');

        $total_minus            = DB::table('journal_entries')->join('account', 'journal_entries.account_name_id', '=', 'account.id')->join('users', 'journal_entries.created_by', '=', 'users.id')
                                                                ->where('journal_entries.debit_credit',1)->where('account.account_type_id',4)
                                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                                ->sum('journal_entries.amount');

        $cash_in_hand           = $total_minus - $cash_in_hand;

        $total_deposit          = JournalEntry::whereDate('journal_entries.assign_date',date('Y-m-d'))
                                                ->join('account','journal_entries.account_name_id','=','account.id')
                                                ->join('users', 'journal_entries.created_by', '=', 'users.id')
                                                ->where('account.account_type_id',5)
                                                ->where('journal_entries.debit_credit',1)
                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                        return $query->where('users.branch_id', $branch_id);
                                                    })
                                                ->sum('journal_entries.amount');

        $total_withdraw         = JournalEntry::whereDate('journal_entries.assign_date',date('Y-m-d'))
                                                ->join('account','journal_entries.account_name_id','=','account.id')
                                                ->join('users', 'journal_entries.created_by', '=', 'users.id')
                                                ->where('account.account_type_id',5)
                                                ->where('journal_entries.debit_credit',0)
                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                        return $query->where('users.branch_id', $branch_id);
                                                    })
                                                ->sum('journal_entries.amount');


        $total_receivale        = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                        return $query->where('users.branch_id', $branch_id);
                                                    })
                                            ->sum('due_amount');
                                            
        $total_invoice          = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                        return $query->where('users.branch_id', $branch_id);
                                                    })
                                            ->where('due_amount','!=',0)
                                            ->count();

        $total_payable          = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                        return $query->where('users.branch_id', $branch_id);
                                                    })
                                            ->sum('due_amount');

        $total_bill             = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                        return $query->where('users.branch_id', $branch_id);
                                                    })
                                            ->where('due_amount','!=',0)
                                            ->count();


        //Calculation of Receivable vs Received
            $start_day_current_month            = new Carbon('first day of this month');
            $start_day_current_month            = $start_day_current_month->startOfDay();
            
            $date                               = new Carbon('first day of this month');
            $date                               = $date->startOfDay();

            $daily_receivable                   = [];
            $daily_received                     = [];

            $daily_receivable_string            = "";
            $daily_received_string              = "";

            $total_receivable_this_month        = 0;
            $total_received_so_far              = 0;

            $count_total_days_in_current_month  = date("t");

            for($i = 0; $i < $count_total_days_in_current_month; $i++){

                if($i != 0){
                    $date->addDays(1);
                }

                if($i == 0){

                    $previous_receivable = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                    return $query->where('users.branch_id', $branch_id);
                                                                })
                                                        ->whereRaw('STR_TO_DATE(invoices.payment_date, "%Y-%m-%d") < "' . $date . '"')
                                                        ->selectRaw('SUM(due_amount) as total_invoice_amount')
                                                        ->get()
                                                        ->toArray();

                    $previous_receivable = count($previous_receivable) > 0 ? $previous_receivable[0]['total_invoice_amount'] : 0;

                }else{
                    $previous_receivable = 0;
                }

                $total_amount                   = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                    return $query->where('users.branch_id', $branch_id);
                                                                })
                                                        ->whereRaw('STR_TO_DATE(invoices.payment_date, "%Y-%m-%d") = "' . $date . '"')
                                                        ->selectRaw('SUM(total_amount) as total_invoice_amount')
                                                        ->get()
                                                        ->toArray();

                $total_amount                   = count($total_amount) > 0 ? $total_amount[0]['total_invoice_amount'] : 0;

                $received_total_till_last_month = Invoice::leftjoin('payment_receives_entries', 'payment_receives_entries.invoice_id', 'invoices.id')
                                                            ->leftjoin('payment_receives', 'payment_receives.id', 'payment_receives_entries.payment_receives_id')
                                                            ->join('users', 'invoices.created_by', '=', 'users.id')
                                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                            ->whereRaw('STR_TO_DATE(invoices.payment_date, "%Y-%m-%d") = "' . $date . '"')
                                                            ->whereRaw('STR_TO_DATE(payment_receives.payment_date, "%Y-%m-%d") < "' . $start_day_current_month . '"')
                                                            ->selectRaw('SUM(payment_receives_entries.amount) as received_total_till_last_month')
                                                            ->get()
                                                            ->toArray();

                $received_total_till_last_month = count($received_total_till_last_month) > 0 ? $received_total_till_last_month[0]['received_total_till_last_month'] : 0;

                $daily_receivable               = $previous_receivable + $total_amount - $received_total_till_last_month;

                $daily_received                 = PaymentReceives::join('users', 'payment_receives.created_by', '=', 'users.id')
                                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                            ->whereRaw('STR_TO_DATE(payment_receives.payment_date, "%Y-%m-%d") = "' . $date . '"')
                                                            ->sum('amount');

                $daily_receivable_string        .= '{ label: "'. $date->toDateString() .'", y: '. $daily_receivable .'},';
                $daily_received_string          .= '{ label: "'. $date->toDateString() .'", y: '. $daily_received .'},';

                $total_receivable_this_month    += $daily_receivable;
                $total_received_so_far          += $daily_received;

            }

        //Calculation of Receivable vs Received Ends

        //Calculation of Payable vs Paid
            $start_day_current_month            = new Carbon('first day of this month');
            $start_day_current_month            = $start_day_current_month->startOfDay();

            $date                               = new Carbon('first day of this month');
            $date                               = $date->startOfDay();

            $daily_payable                      = [];
            $daily_paid                         = [];

            $daily_payable_string               = "";
            $daily_paid_string                  = "";
            $expense_pie                        = "";
            $expense_pie2                       = "";

            $total_payable_this_month           = 0;
            $total_paid_so_far                  = 0;

            $count_total_days_in_current_month  = date("t");

            for($i = 0; $i < $count_total_days_in_current_month; $i++){

                if($i != 0){
                    $date->addDays(1);
                }

                if($i == 0){

                    $previous_payable = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                        return $query->where('users.branch_id', $branch_id);
                                                    })
                                            ->whereRaw('STR_TO_DATE(bill.due_date, "%Y-%m-%d") < "' . $date . '"')
                                            ->selectRaw('SUM(due_amount) as total_bill_amount')
                                            ->get()
                                            ->toArray();

                    $previous_payable = count($previous_payable) > 0 ? $previous_payable[0]['total_bill_amount'] : 0;

                }else{
                    $previous_payable = 0;
                }

                $total_amount                   = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                    return $query->where('users.branch_id', $branch_id);
                                                                })
                                                        ->whereRaw('STR_TO_DATE(bill.due_date, "%Y-%m-%d") = "' . $date . '"')
                                                        ->selectRaw('SUM(amount) as total_bill_amount')
                                                        ->get()
                                                        ->toArray();

                $total_amount                   = count($total_amount) > 0 ? $total_amount[0]['total_bill_amount'] : 0;

                $paid_total_till_last_month     = Bill::leftjoin('payment_made_entry', 'payment_made_entry.bill_id', 'bill.id')
                                                            ->leftjoin('payment_made', 'payment_made.id', 'payment_made_entry.payment_made_id')
                                                            ->join('users', 'bill.created_by', '=', 'users.id')
                                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                            ->whereRaw('STR_TO_DATE(bill.due_date, "%Y-%m-%d") = "' . $date . '"')
                                                            ->whereRaw('STR_TO_DATE(payment_made.payment_date, "%Y-%m-%d") < "' . $start_day_current_month . '"')
                                                            ->selectRaw('SUM(payment_made_entry.amount) as paid_total_till_last_month')
                                                            ->get()
                                                            ->toArray();

                $paid_total_till_last_month = count($paid_total_till_last_month) > 0 ? $paid_total_till_last_month[0]['paid_total_till_last_month'] : 0;

                $daily_payable              = $previous_payable + $total_amount - $paid_total_till_last_month;

                $daily_paid                 = PaymentMade::join('users', 'payment_made.created_by', '=', 'users.id')
                                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                    return $query->where('users.branch_id', $branch_id);
                                                                })
                                                        ->whereRaw('STR_TO_DATE(payment_made.payment_date, "%Y-%m-%d") = "' . $date . '"')
                                                        ->sum('amount');

                $daily_payable_string       .= '{ label: "'. $date->toDateString() .'", y: '. $daily_payable .'},';
                $daily_paid_string          .= '{ label: "'. $date->toDateString() .'", y: '. $daily_paid .'},';

                $total_payable_this_month   += $daily_payable;
                $total_paid_so_far          += $daily_paid;

            }
        //Calculation of Payable vs Paid Ends

        // start top 5 expense and income graph
          $expense = Expense::whereBetween('date', [$first_day_crnt_nonth, $last_day_crnt_nonth])
                            ->selectRaw('SUM(amount) as amount, account_id')
                            ->groupBy('account_id')
                            ->orderBy('amount', 'DESC')
                            ->limit(5)
                            ->get();
          $income  = Income::whereBetween('date', [$first_day_crnt_nonth, $last_day_crnt_nonth])
                            ->selectRaw('SUM(amount) as amount, account_id')
                            ->groupBy('account_id')
                            ->orderBy('amount', 'DESC')
                            ->limit(5)
                            ->get();

            $total_exp = 0 ;
            $total_inc = 0 ;

            foreach ($income as $key1 => $value2)
            {
             $total_inc += $value2->amount  ;
            }

            foreach ($income as $key => $value)
            {
              $inc_per = ( 100*$value->amount )/$total_inc;
              $expense_pie .='{ y: "'. number_format($inc_per,2) .'", label: '.' "'. $value->account->account_name.'('.$value->amount.')'.'" '.'},';
            }

            foreach ($expense as $key1 => $value2)
             {
              $total_exp += $value2->amount  ;
             }

            foreach ($expense as $key => $value)
             {
                $ind_per = (100 * $value->amount) / $total_exp;
                if($key % 2 == 0 && ($key ==0 || $key ==4))
                {
                  $expense_pie2 .='{ y: "'. number_format($ind_per,2) .'", label: '.' "'. $value->account->account_name.'('.$value->amount.')'.'",exploded: true' .'},';
                }
               else
                {
                   $expense_pie2 .='{ y: "'. number_format($ind_per,2) .'", label: '.' "'. $value->account->account_name.'('.$value->amount.')'.'" '.'},';
                }
            }
        //end top 5 income and expense graph

        //start net profit and loss graph
            $operatingincome            = Account::where('account_type_id',15)->get();
            $costofgoods                = Account::where('account_type_id',18)->get();
            $operatingExpense           = Account::where('account_type_id',17)->get();
            $nonoperatingix             = Account::whereIn('account_type_id',array(16,19))->get();
            $total_income     = 0;
            $total_expense    = 0;
            $total_cost_good  = 0;
            foreach($costofgoods as $item)
            {
              $Report = $this->OperatingincomeTotal($item->id);
              $total_cost_good += $Report;
            }

            foreach($operatingExpense as $item)
            {
              $Report = $this->OperatingincomeTotal($item->id);
              $total_expense += $Report;
            }

            foreach($operatingincome as $item)
            {
                $Report = $this->OperatingincomeTotal($item->id);
                $total_income += $Report;
            }
            $net_expense =0;
            $net_expense =-($total_expense+ $total_cost_good);
            $net_total = - $net_expense + $total_income;

            $net_income_pie ='{ y: "'. $total_income .'", label: "Income"}';
            $net_expnese_pie ='{ y: "'. $net_expense .'", label: "Expense"}';

        //end net profit and loss graph

            $current_month          = date('F');

            return view('dashboard::index', compact('todayreminder', 'nextreminder', 'total_receivale', 'total_invoice', 'total_payable', 'total_bill', 'todayincome', 'todayexpense',
                'cash_in_hand', 'total_deposit', 'total_withdraw',
                'daily_receivable_string', 'daily_received_string', 'total_receivable_this_month', 'total_received_so_far',
                'daily_payable_string', 'daily_paid_string', 'total_payable_this_month', 'total_paid_so_far',
                'current_month', 'expense_pie', 'expense_pie2','net_income_pie', 'net_expnese_pie','net_total'));
    }

    public function todayreminder()
    {
        $todayreminder  =  Reminder::whereDate('reminddatetime',date('Y-m-d'))->get();

       $con =  new Concatenote();
       echo $con->todaynote($todayreminder);



        return json_encode($todayreminder );
    }

    public function reOrder()
    {
        $reorder = [];

        $in_stock = Stock::groupBy('item_id')->selectRaw('*, sum(total) as sum')->get();
        $out_stock =  InvoiceEntry::groupBy('item_id')->selectRaw('*, sum(quantity) as sum')->get();

        $item = Item::all();

        foreach ($item as $value){
            $new_in_stock = $in_stock->where('item_id', $value->id)->first();
            $new_out_stock = $out_stock->where('item_id', $value->id)->first();
            if(isset($new_in_stock) && isset($new_out_stock)){


                $after_minus = $new_in_stock->sum-$new_out_stock->sum;
                if($after_minus)
                {
                    if($after_minus<=$value->reorder_point|| empty($value->reorder_point)){
                        $reorder[$value->id][] =  $after_minus;
                        $reorder[$value->id][] =  $value->item_name;
                    }
                }
            }

        }

        //return response($reorder);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function OperatingincomeTotal($id)
    {

        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

          $debt   = JournalEntry::join('users', 'journal_entries.created_by', '=', 'users.id')
                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                    return $query->where('users.branch_id', $branch_id);
                                })
                                  ->where('account_name_id',$id)
                                  ->where('debit_credit',0)
                                  ->whereYear('assign_date',date('Y'))
                                  ->get();

          // $debt   = $debt->whereIn('created_by', $this->targeted_users);

          $debt   = $this->collectionAttributeSum($debt);

          $crt    = JournalEntry::join('users', 'journal_entries.created_by', '=', 'users.id')
                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                    return $query->where('users.branch_id', $branch_id);
                                })
                                  ->where('account_name_id',$id)
                                  ->where('debit_credit',1)
                                  ->whereYear('assign_date',date('Y'))
                                  ->get();

          // $crt    = $crt->whereIn('created_by', $this->targeted_users);
          $crt    = $this->collectionAttributeSum($crt);

          $total  = (int)$debt-$crt;

          $this->OperatingincomeTotal = $this->OperatingincomeTotal+$total;
          return $total;

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

    public function position(Request $request)
    {
        $user               = Auth::user();

        $table_name         = 'gps_uid'.'_'.$user->id;

        DB::table($table_name)->insert(
            [
                'user_id'       => $user['id'],
                'lat'           => $request['lat'],
                'lng'           => $request['lng'],
                'created_at'    => carbon::now('Asia/Dhaka'),
            ]
        );
    }

    public function salesProduct($id,$form_date,$to_date)
    {
        $date                   = Carbon::now()->startOfMonth();
        $end_date               = Carbon::now()->endOfMonth();

        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        if($id == 1)
        {
            $start_date             = Carbon::now()->startOfMonth();
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 2) {

            $start_date             = date('Y-m-d', strtotime('-2 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 3) {

            $start_date             = date('Y-m-d', strtotime('-5 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 4) {
            $start_date             = date('Y-m-d', strtotime('-11 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($form_date != 0 || $to_date != 0) {
            $start_date             = date('Y-m-d', strtotime($form_date));
            $end_date               = date('Y-m-d', strtotime($to_date));
        }

        $date_time             = "str_to_date(invoices.invoice_date, '%Y-%m-%d') between '$start_date' and '$end_date'";

        $product_sales      = InvoiceEntry::join('invoices','invoices.id','invoice_entries.invoice_id')
                                            ->join('users', 'invoices.created_by', '=', 'users.id')
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', $branch_id);
                                            })
                                            ->join('item','item.id','invoice_entries.item_id')
                                            ->whereRaw($date_time)
                                            ->selectRaw('invoice_entries.*, CONCAT(invoice_entries.item_id) as item_t, CONCAT(sum(invoice_entries.amount)) as amount, item.item_name as item_name')
                                            ->groupBy('invoice_entries.item_id')
                                            ->orderByRaw('SUM(invoice_entries.amount) DESC')
                                            ->take(10)
                                            ->get();

        $end_date           = date('M d, Y',strtotime($end_date));

        $start_date         = date('M d, Y',strtotime($start_date));

        return Response::JSON(
            [
                'product_sales' => $product_sales,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
            ]
        );
    }

    public function incomeExpense($id,$form_date,$to_date)
    {

        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        $accounts               = Account::all();
        $OrganizationProfile    = OrganizationProfile::find(1);
        $branch                 = Branch::all();
        
        $current_time           = Carbon::now()->toDayDateTimeString();

        $date_modify            = date('d');

        $date                   = Carbon::now()->startOfMonth();

        $start_mounth           = date('Y-m-d', strtotime('-1 month',strtotime($date)));

        $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($date)));

        //Code for one month search start
        if($id == 1)
        {

            $st_month               = Carbon::now()->startOfMonth();

            $en_month               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-1 month',strtotime($st_month)));

            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($st_month)));

            $time_diff              = date_diff($st_month,$en_month);

            $day                    = $time_diff->days;

            $days                   = $day + 1;

            $end_i                  = floor($days/3);

            $day_diffe              = round($days/30);

            $start_date_count       = $date_modify;
            $end_date_count         = $days - $date_modify;

            $startdate_modify       = '-'.$date_modify.' day';
            $end_date_modify        = '+'.$end_date_count.' day';

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_time               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif($id == 2)
        {

            $st_month               = Carbon::now()->subMonth(2)->startOfMonth();

            $en_month               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-2 month',strtotime($st_month)));

            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($st_month)));

            $time_diff              = date_diff($st_month,$en_month);

            $day                    = $time_diff->days;

            $days                   = $day + 1;

            $end_i                  = floor($days/3);

            $day_diffe              = round($days/30);
           
            $start_date_count       = $day;
            $end_date_count         = $days - $day;

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_time               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif($id == 3)
        {
            $st_month               = Carbon::now()->subMonth(5)->startOfMonth();

            $en_month               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-5 month',strtotime($st_month)));
            
            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($st_month)));

            $time_diff              = date_diff($st_month,$en_month);
            
            $day                    = $time_diff->days;

            $days                   = $day + 1;

            $end_i                  = floor($days/6);

            $day_diffe              = round($days/30);
           
            $start_date_count       = $day;
            $end_date_count         = $days - $day;

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_time               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif($id == 4)
        {
            $st_month               = Carbon::now()->subMonth(11)->startOfMonth();
            $en_month               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-11 month',strtotime($st_month)));
            
            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($st_month)));

            $time_diff              = date_diff($st_month,$en_month);
            
            $day                    = $time_diff->days;

            $days                   = $day + 1;

            $end_i                  = floor($days/12);

            $day_diffe              = round($days/30);
           
            $start_date_count       = $day;
            $end_date_count         = $days - $day;

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_time               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif ($form_date != 0 || $to_date != 0) 
        {
            $str_date               = date_create($form_date);
            $end_date               = date_create($to_date);

            $time_diff              = date_diff($str_date, $end_date);
            $day                    = $time_diff->days;
            $days                   = $day;
            // dd($days);
            $end_i                  = floor($days/$days);

            $day_diffe              = round($days/30);

            $start_date             = (new DateTime($form_date))->format('Y-m-d');
            $end_time               = (new DateTime($to_date))->format('Y-m-d');    
        }

        $assign_date          = "str_to_date(assign_date,'%Y-%m-%d') between '$start_date' and '$end_time'";
        
        //Payment Receive Date Start
            $payment_start        = (new DateTime($start_date))->format('Y-m-d');
            $payment_end          = (new DateTime($end_time))->format('Y-m-d');
            $date_payment         = "str_to_date(payment_receives.payment_date,'%Y-%m-%d') between '$payment_start' and '$payment_end'";
            $pdate_payment        = "str_to_date(payment_receives.payment_date,'%Y-%m-%d') between '$start_mounth' and '$end_mounth'";
        //Payment Receive Date end

        //Income Start

            $JournalEntryIncome     = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                                  ->join('users', 'users.id', 'journal_entries.created_by')
                                                  ->orderBy('jurnal_type','DESC')
                                                  ->selectRaw('journal_entries.*')
                                                  ->where('account.parent_account_type_id', 4)
                                                  ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                  ->get()
                                                  ->sortBy('assign_date');

            $payment_receives_in    = PaymentReceives::join('users', 'users.id', 'payment_receives.created_by')
                                                ->whereRaw($date_payment)
                                                ->selectRaw('SUM(payment_receives.amount) as payment_receive_amount')
                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                ->first();

            $ppayment_receives_in   = PaymentReceives::join('users', 'users.id', 'payment_receives.created_by')
                                                ->whereRaw($pdate_payment)
                                                ->selectRaw('SUM(payment_receives.amount) as payment_receive_amount')
                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                ->first();

            $cos_debit              = $JournalEntryIncome->where('assign_date', '>=', $start_date)
                                                           ->where('assign_date', '<=', $end_time)
                                                           ->where('debit_credit', 1)
                                                           ->sum('amount');

            $cos_credit             = $JournalEntryIncome->where('assign_date', '>=', $start_date)
                                                           ->where('assign_date', '<=', $end_time)
                                                           ->where('debit_credit', 0)
                                                           ->sum('amount');

            // $income_total           = $payment_receives_in->payment_receive_amount + $cos_credit - $cos_debit;
            $income_total           = $cos_credit - $cos_debit;

            $pcos_debit             = $JournalEntryIncome->where('assign_date', '>=', $start_mounth)
                                                           ->where('assign_date', '<=', $end_mounth)
                                                           ->where('debit_credit', 1)
                                                           ->sum('amount');

            $pcos_credit            = $JournalEntryIncome->where('assign_date', '>=', $start_mounth)
                                                           ->where('assign_date', '<=', $end_mounth)
                                                           ->where('debit_credit', 0)
                                                           ->sum('amount');

            // $pincome_total          = $ppayment_receives_in->payment_receive_amount + $pcos_credit - $pcos_debit;
            $pincome_total          = $pcos_credit - $pcos_debit;

            $k = $day_diffe;

            for($i = 0; $i <= $days; $i += $day_diffe)
            {
                $day_num        = '+'.$i.' day';
                $day_end        = '+'.$k.' day';

                $start_diff                     = (new DateTime($start_date))->modify($day_num)->format('Y-m-d');
                $end_diff                       = (new DateTime($start_date))->modify($day_end)->format('Y-m-d');
                
                $cos_debit                      = $JournalEntryIncome->where('assign_date', '>=', $start_diff)
                                                               ->where('assign_date', '<=', $end_diff)
                                                               ->where('debit_credit', 1)
                                                               ->sum('amount');

                $cos_credit                     = $JournalEntryIncome->where('assign_date', '>=', $start_diff)
                                                               ->where('assign_date', '<=', $end_diff)
                                                               ->where('debit_credit', 0)
                                                               ->sum('amount');

                $time_slat_income_value[$i]     = $cos_credit - $cos_debit;

                $k = $k + $day_diffe;     
            }
        //Income End

        //Cost of goods sold start
            $JournalEntry           = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                                  ->join('users', 'users.id', 'journal_entries.created_by')
                                                  ->orderBy('jurnal_type','DESC')
                                                  ->selectRaw('journal_entries.*')
                                                  ->where('account.account_type_id', 18)
                                                  ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                  ->get()
                                                  ->sortBy('assign_date');

            $cos_debit              = $JournalEntry->where('assign_date', '>=', $start_date)
                                                   ->where('assign_date', '<=', $end_time)
                                                   ->where('debit_credit', 1)
                                                   ->sum('amount');

            $cos_credit             = $JournalEntry->where('assign_date', '>=', $start_date)
                                                   ->where('assign_date', '<=', $end_time)
                                                   ->where('debit_credit', 0)
                                                   ->sum('amount');

            $cost_of_goods_sold     = $cos_debit - $cos_credit;

            $pcos_debit             = $JournalEntry->where('assign_date', '>=', $start_mounth)
                                                   ->where('assign_date', '<=', $end_mounth)
                                                   ->where('debit_credit', 1)
                                                   ->sum('amount');

            $pcos_credit            = $JournalEntry->where('assign_date', '>=', $start_mounth)
                                                   ->where('assign_date', '<=', $end_mounth)
                                                   ->where('debit_credit', 0)
                                                   ->sum('amount');

            $pcost_of_goods_sold    = $pcos_debit - $pcos_credit;

            $k = $day_diffe;

            for($i = 0; $i <= $days; $i += $day_diffe)
            {
                $day_num                = '+'.$i.' day';
                $day_end                = '+'.$k.' day';

                $start_diff             = (new DateTime($start_date))->modify($day_num)->format('Y-m-d');
                $end_diff               = (new DateTime($start_date))->modify($day_end)->format('Y-m-d');

                $cos_debit              = $JournalEntry->where('assign_date', '>=', $start_diff)
                                                   ->where('assign_date', '<=', $end_diff)
                                                   ->where('debit_credit', 1)
                                                   ->sum('amount');

                $cos_credit             = $JournalEntry->where('assign_date', '>=', $start_diff)
                                                   ->where('assign_date', '<=', $end_diff)
                                                   ->where('debit_credit', 0)
                                                   ->sum('amount');

                $time_slat_value[$i]    = $cos_debit - $cos_credit;

                $k = $k + $day_diffe;
            }
        //cost of goods sold end

        //Payment Made Start
            $payable_start        = new Carbon($start_date);
            $payable_end          = new Carbon($end_time);

            $date_receive         = "str_to_date(payment_date,'%Y-%m-%d') between '$payable_start' and '$payable_end'";

            $pdate_receive        = "str_to_date(payment_date,'%Y-%m-%d') between '$start_mounth' and '$end_mounth'";
        //Payment Made End

        //Expense Start

            $JournalEntryexpense    = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                                  ->join('users', 'users.id', 'journal_entries.created_by')
                                                  ->orderBy('jurnal_type','DESC')
                                                  ->selectRaw('journal_entries.*')
                                                  ->where('account.parent_account_type_id', 5)
                                                  ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                  ->get()
                                                  ->sortBy('assign_date');

            $payment_made_in        = PaymentMade::join('users', 'users.id', 'payment_made.created_by')
                                                ->whereRaw($date_receive)
                                                ->selectRaw('SUM(amount) as payment_made_amount')
                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                ->first();

            $ppayment_made_in       = PaymentMade::join('users', 'users.id', 'payment_made.created_by')
                                                ->whereRaw($pdate_receive)
                                                ->selectRaw('SUM(amount) as payment_made_amount')
                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                ->first();

            $cos_debit              = $JournalEntryexpense->where('assign_date', '>=', $start_date)
                                                           ->where('assign_date', '<=', $end_time)
                                                           ->where('debit_credit', 1)
                                                           ->sum('amount');

            $cos_credit             = $JournalEntryexpense->where('assign_date', '>=', $start_date)
                                                           ->where('assign_date', '<=', $end_time)
                                                           ->where('debit_credit', 0)
                                                           ->sum('amount');

            // $expense_total          = $payment_made_in->payment_made_amount + $cos_debit - $cos_credit;
            $expense_total          = $cos_debit - $cos_credit;

            $pcos_debit             = $JournalEntryexpense->where('assign_date', '>=', $start_mounth)
                                                           ->where('assign_date', '<=', $end_mounth)
                                                           ->where('debit_credit', 1)
                                                           ->sum('amount');

            $pcos_credit            = $JournalEntryexpense->where('assign_date', '>=', $start_mounth)
                                                           ->where('assign_date', '<=', $end_mounth)
                                                           ->where('debit_credit', 0)
                                                           ->sum('amount');

            // $pexpense_total         = $ppayment_made_in->payment_made_amount + $pcos_debit - $pcos_credit;
            $pexpense_total         = $pcos_debit - $pcos_credit;

            $k = $day_diffe;

            for($i = 0; $i <= $days; $i += $day_diffe)
            {
                $day_num        = '+'.$i.' day';
                $day_end        = '+'.$k.' day';

                $start_diff                     = (new DateTime($start_date))->modify($day_num)->format('Y-m-d');
                $end_diff                       = (new DateTime($start_date))->modify($day_end)->format('Y-m-d');

                $cos_debit                      = $JournalEntryexpense->where('assign_date', '>=', $start_diff)
                                                               ->where('assign_date', '<=', $end_diff)
                                                               ->where('debit_credit', 1)
                                                               ->sum('amount');

                $cos_credit                     = $JournalEntryexpense->where('assign_date', '>=', $start_diff)
                                                               ->where('assign_date', '<=', $end_diff)
                                                               ->where('debit_credit', 0)
                                                               ->sum('amount');

                $time_slat_expense_value[$i]    = $cos_debit - $cos_credit;
                $k = $k + $day_diffe;
            }

            foreach ($time_slat_income_value as $key => $value)
            {
              $net_profite_time_slat[$key] = $value-$time_slat_expense_value[$key]-$time_slat_value[$key];
            } 

            $net_profit     = $income_total - $cost_of_goods_sold - $expense_total;
            $pnet_profit    = $pincome_total - $pcost_of_goods_sold - $pexpense_total;
        //Expense End

        //Receivable start
            $branch_id            = Auth::user()->branch_id;

            $payment_start        = (new DateTime($start_date))->format('Y-m-d');
            $payment_end          = (new DateTime($end_time))->format('Y-m-d');

            $date_difference      = "str_to_date(invoices.invoice_date,'%Y-%m-%d') between '$start_date' and '$end_time'";

            $pdate_difference     = "str_to_date(invoices.invoice_date,'%Y-%m-%d') between '$start_mounth' and '$end_mounth'";

            if($i == 0){
                $previous_receivable        = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                                      // ->join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                      ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                      ->whereRaw($date_difference)
                                                      ->selectRaw('SUM(invoices.due_amount) as total_invoice_amount')
                                                      ->get()
                                                      ->toArray();

                $previous_receivable = count($previous_receivable) > 0 ? $previous_receivable[0]['total_invoice_amount'] : 0;
            }else{
                $previous_receivable = 0;
            }
                

            $total_amount                     = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                                        // ->join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                    return $query->where('users.branch_id', $branch_id);
                                                                })
                                                        ->whereRaw($date_difference)
                                                        ->selectRaw('SUM(due_amount) as total_invoice_amount')
                                                        ->get()
                                                        ->toArray();

            $total_amount                     = count($total_amount) > 0 ? $total_amount[0]['total_invoice_amount'] : 0;

            $receivable                       = $total_amount;

            if($i == 0){
                $pprevious_receivable        = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                                      // ->join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                      ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                      ->whereRaw($pdate_difference)
                                                      ->selectRaw('SUM(invoices.due_amount) as total_invoice_amount')
                                                      ->get()
                                                      ->toArray();

                $previous_receivable = count($previous_receivable) > 0 ? $previous_receivable[0]['total_invoice_amount'] : 0;
            }else{
                $pprevious_receivable = 0;
            }
                

            $ptotal_amount                     = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                                        // ->join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                    return $query->where('users.branch_id', $branch_id);
                                                                })
                                                        ->whereRaw($pdate_difference)
                                                        ->selectRaw('SUM(due_amount) as total_invoice_amount')
                                                        ->get()
                                                        ->toArray();

            $ptotal_amount                     = count($ptotal_amount) > 0 ? $ptotal_amount[0]['total_invoice_amount'] : 0;

            $preceived_total_till_last_month   = Invoice::leftjoin('payment_receives_entries', 'payment_receives_entries.invoice_id', 'invoices.id')
                                                        ->leftjoin('payment_receives', 'payment_receives.id', 'payment_receives_entries.payment_receives_id')
                                                        ->join('users', 'invoices.created_by', '=', 'users.id')
                                                        // ->join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                    return $query->where('users.branch_id', $branch_id);
                                                                })
                                                        ->whereRaw($pdate_difference)
                                                        ->whereRaw($pdate_payment)
                                                        ->selectRaw('SUM(payment_receives_entries.amount) as received_total_till_last_month')
                                                        ->get()
                                                        ->toArray();


            $preceived_total_till_last_month   = count($preceived_total_till_last_month) > 0 ? $preceived_total_till_last_month[0]['received_total_till_last_month'] : 0;

            $preceivable                       = $ptotal_amount - $preceived_total_till_last_month;
        //Receivable End

        //Payable Start
            $payable_start        = new Carbon($start_date);
            $payable_end          = new Carbon($end_time);

            $date_difference      = "str_to_date(bill.bill_date,'%Y-%m-%d') between '$start_date' and '$end_time'";
            $date_made            = "str_to_date(payment_made.payment_date,'%Y-%m-%d') between '$payable_start' and '$payable_end'";

            $pdate_difference     = "str_to_date(bill.bill_date,'%Y-%m-%d') between '$start_mounth' and '$end_mounth'";
            $pdate_made          = "str_to_date(payment_made.payment_date,'%Y-%m-%d') between '$start_mounth' and '$end_mounth'";

            if($i == 0){

              $previous_payable = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                      // ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                      ->when($branch_id != 1, function ($query) use ($branch_id) {
                                          return $query->where('users.branch_id', $branch_id);
                                      })
                                      ->whereRaw($date_difference)
                                      ->selectRaw('SUM(bill.due_amount) as total_bill_amount')
                                      ->get()
                                      ->toArray();

              $previous_payable = count($previous_payable) > 0 ? $previous_payable[0]['total_bill_amount'] : 0;
            }else{
              $previous_payable = 0;
            }

            $total_amount                   = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                                  // ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                                  ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                      return $query->where('users.branch_id', $branch_id);
                                                  })
                                                  ->whereRaw($date_difference)
                                                  ->selectRaw('SUM(bill.amount) as total_bill_amount')
                                                  ->get()
                                                  ->toArray();

            $total_amount                   = count($total_amount) > 0 ? $total_amount[0]['total_bill_amount'] : 0;


            $paid_total_till_last_month     = Bill::leftjoin('payment_made_entry', 'payment_made_entry.bill_id', 'bill.id')
                                                      ->leftjoin('payment_made', 'payment_made.id', 'payment_made_entry.payment_made_id')
                                                      // ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                                      ->join('users', 'bill.created_by', '=', 'users.id')
                                                      ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                      ->whereRaw($date_difference)
                                                      ->whereRaw($date_made)
                                                      ->selectRaw('SUM(payment_made_entry.amount) as paid_total_till_last_month')
                                                      ->get()
                                                      ->toArray();

            $paid_total_till_last_month   = count($paid_total_till_last_month) > 0 ? $paid_total_till_last_month[0]['paid_total_till_last_month'] : 0;

            $payable                      = $total_amount - $paid_total_till_last_month;
        //Payableend

        //Start Previous Payable
            if($i == 0){
              $pprevious_payable    = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                          // ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                          ->when($branch_id != 1, function ($query) use ($branch_id) {
                                              return $query->where('users.branch_id', $branch_id);
                                          })
                                          ->whereRaw($pdate_difference)
                                          ->selectRaw('SUM(bill.due_amount) as total_bill_amount')
                                          ->get()
                                          ->toArray();

              $pprevious_payable = count($pprevious_payable) > 0 ? $pprevious_payable[0]['total_bill_amount'] : 0;
                                     

            }else{
              $pprevious_payable = 0;
            }

            $ptotal_amount                  = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                                  // ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                                  ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                      return $query->where('users.branch_id', $branch_id);
                                                  })
                                                  ->whereRaw($pdate_difference)
                                                  ->selectRaw('SUM(bill.amount) as total_bill_amount')
                                                  ->get()
                                                  ->toArray();

            $ptotal_amount                  = count($ptotal_amount) > 0 ? $ptotal_amount[0]['total_bill_amount'] : 0;


            $ppaid_total_till_last_month    = Bill::leftjoin('payment_made_entry', 'payment_made_entry.bill_id', 'bill.id')
                                                      ->leftjoin('payment_made', 'payment_made.id', 'payment_made_entry.payment_made_id')
                                                      // ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                                      ->join('users', 'bill.created_by', '=', 'users.id')
                                                      ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                      ->whereRaw($pdate_difference)
                                                      ->whereRaw($pdate_made)
                                                      ->selectRaw('SUM(payment_made_entry.amount) as paid_total_till_last_month')
                                                      ->get()
                                                      ->toArray();

            $ppaid_total_till_last_month    = count($ppaid_total_till_last_month) > 0 ? $ppaid_total_till_last_month[0]['paid_total_till_last_month'] : 0;

            $ppayable                      = $ptotal_amount - $ppaid_total_till_last_month;
        //End Previous Payable 

        //Cash in Hand Start
            $account_type           = Account::where('account_type_id',4)->get();

            $JournalEntrys          = [];

            $total_cash_inhand = 0;
            $total_cash_inhand_debit = 0;
            $total_cash_inhand_credit = 0;
            $total_current_cash_inhand_debit = 0;
            $total_current_cash_inhand_credit = 0;

            foreach ($account_type as $key => $value)
            {
                $JournalEntrys[]                    =  JournalEntry::join('users', 'users.id', 'journal_entries.created_by')
                                                                    ->whereBetween('assign_date',[$start_date,$end_time])
                                                                    ->where('account_name_id',$value->id)
                                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                          return $query->where('users.branch_id', $branch_id);
                                                                      })
                                                                    ->get()
                                                                    ->sortBy('assign_date');

                // current cash in hand
                $current_cash_inhand_debit          = JournalEntry::join('users', 'users.id', 'journal_entries.created_by')
                                                                    ->select(DB::raw('SUM(amount) as amount'))
                                                                    ->whereBetween('assign_date',[$start_date,$end_time])
                                                                    ->where('account_name_id',$value->id)
                                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                          return $query->where('users.branch_id', $branch_id);
                                                                      })
                                                                    ->where('debit_credit',1)
                                                                    ->get()
                                                                    ->sortBy('assign_date');

                $current_cash_inhand_credit         = JournalEntry::join('users', 'users.id', 'journal_entries.created_by')
                                                                    ->select(DB::raw('SUM(amount) as amount'))
                                                                    ->whereBetween('assign_date',[$start_date,$end_time])
                                                                    ->where('account_name_id',$value->id)
                                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                          return $query->where('users.branch_id', $branch_id);
                                                                      })
                                                                    ->where('debit_credit',0)
                                                                    ->get()
                                                                    ->sortBy('assign_date');

                $total_current_cash_inhand_debit    = $total_current_cash_inhand_debit+$current_cash_inhand_debit[0]['amount'];
                $total_current_cash_inhand_credit   = $total_current_cash_inhand_credit+$current_cash_inhand_credit[0]['amount'];
                $current_cash_in_hand               = $total_current_cash_inhand_debit-$total_current_cash_inhand_credit;

                // total cash in hand
                
                $cash_inhand_debit                  = JournalEntry::join('users', 'users.id', 'journal_entries.created_by')
                                                                    ->select(DB::raw('SUM(amount) as cash_inhand'))
                                                                    ->whereBetween('assign_date',[$start_mounth,$end_mounth])
                                                                    ->where('account_name_id',$value->id)
                                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                          return $query->where('users.branch_id', $branch_id);
                                                                      })
                                                                    ->where('debit_credit',1)
                                                                    ->get()
                                                                    ->sortBy('assign_date');

                $cash_inhand_credit                 = JournalEntry::join('users', 'users.id', 'journal_entries.created_by')
                                                                    ->select(DB::raw('SUM(amount) as cash_inhand'))
                                                                    ->whereBetween('assign_date',[$start_mounth,$end_mounth])
                                                                    ->where('account_name_id',$value->id)
                                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                          return $query->where('users.branch_id', $branch_id);
                                                                      })
                                                                    ->where('debit_credit',0)
                                                                    ->get()
                                                                    ->sortBy('assign_date');

                $total_cash_inhand_debit            = $total_cash_inhand_debit+(int)$cash_inhand_debit[0]['cash_inhand'];
                $total_cash_inhand_credit           = $total_cash_inhand_credit+(int)$cash_inhand_credit[0]['cash_inhand'];
                $previous_cash_inhand               = $total_cash_inhand_debit-$total_cash_inhand_credit;
            }
        //Cash in Hand end

        //Cash in Bank Start

            $bank                   = JournalEntry::join('account','journal_entries.account_name_id','=','account.id')
                                                    ->join('users', 'users.id', 'journal_entries.created_by')
                                                    ->where('account.account_type_id', 5)
                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                    ->get()
                                                    ->sortBy('assign_date');

            $bank_debit             = $bank->where('debit_credit',1)
                                            ->where('assign_date', '>=', $start_date)
                                            ->where('assign_date', '<=', $end_time)
                                            ->sum('amount');

            $bank_credit            = $bank->where('debit_credit',0)
                                            ->where('assign_date', '>=', $start_date)
                                            ->where('assign_date', '<=', $end_time)
                                            ->sum('amount');
        
            $total_bank             = $bank_debit - $bank_credit;

            $pbank_debit            = $bank->where('debit_credit',1)
                                            ->where('assign_date', '>=', $start_mounth)
                                            ->where('assign_date', '<=', $end_mounth)
                                            ->sum('amount');

            $pbank_credit           = $bank->where('debit_credit',0)
                                            ->where('assign_date', '>=', $start_mounth)
                                            ->where('assign_date', '<=', $end_mounth)
                                            ->sum('amount');
        
            $ptotal_bank            = $pbank_debit - $pbank_credit;
        //Cash in Bank End

        $start_date              = date('M d, Y',strtotime($start_date));  

        $end_time                = date('M d, Y',strtotime($end_time)); 

        $start_mounth            = date('M d, Y',strtotime($start_mounth));

        $end_mounth              = date('M d, Y',strtotime($end_mounth));
        
        return Response::JSON
        ([
                'income_total'              => $income_total,
                'pincome_total'             => $pincome_total,
                'time_slat_income_value'    => $time_slat_income_value,
                'time_slat_value'           => $time_slat_value,
                'cost_of_goods_sold'        => $cost_of_goods_sold,
                'pcost_of_goods_sold'       => $pcost_of_goods_sold,
                'time_slat_expense_value'   => $time_slat_expense_value,
                'net_profite_time_slat'     => $net_profite_time_slat,
                'expense_total'             => $expense_total,
                'pexpense_total'            => $pexpense_total,
                'net_profit'                => $net_profit,
                'pnet_profit'               => $pnet_profit,
                'start_date'                => $start_date,
                'end_time'                  => $end_time,
                'start_mounth'              => $start_mounth,
                'end_mounth'                => $end_mounth,
                'receivable'                => $receivable,
                'preceivable'               => $preceivable,
                'payable'                   => $payable,
                'ppayable'                  => $ppayable,
                'current_cash_in_hand'      => $current_cash_in_hand,
                'previous_cash_inhand'      => $previous_cash_inhand,
                'total_bank'                => $total_bank,
                'ptotal_bank'               => $ptotal_bank,
        ]);
    }

    public function topExpenseAccount($id,$form_date,$to_date)
    {
        $date                   = Carbon::now()->startOfMonth();
        $end_date               = Carbon::now()->endOfMonth();

        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        if($id == 1)
        {
            $start_date             = Carbon::now()->startOfMonth();
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 2) {

            $start_date             = date('Y-m-d', strtotime('-2 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 3) {

            $start_date             = date('Y-m-d', strtotime('-5 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 4) {
            $start_date             = date('Y-m-d', strtotime('-11 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($form_date != 0 || $to_date != 0) {
            $start_date             = date('Y-m-d', strtotime($form_date));
            $end_date               = date('Y-m-d', strtotime($to_date));
        }

        $top_expense        = JournalEntry::join('account','account.id','journal_entries.account_name_id')
                                            ->join('users', 'users.id', 'journal_entries.created_by')
                                            ->join('account_type','account_type.id','account.account_type_id')
                                            ->where('account_type.parent_account_type_id',5)
                                            ->whereBetween('journal_entries.assign_date',[$start_date,$end_date])
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                      return $query->where('users.branch_id', $branch_id);
                                                  })
                                            ->selectRaw(DB::raw("SUM( ( CASE WHEN journal_entries.debit_credit = 1 THEN journal_entries.amount ELSE 0 END ) ) AS debit_amount, SUM( ( CASE WHEN journal_entries.debit_credit = 0 THEN journal_entries.amount ELSE 0 END ) ) AS credit_amount, account.account_name,account.id as account_id"))
                                            ->groupBy('journal_entries.account_name_id')
                                            ->orderByRaw('SUM( ( CASE WHEN journal_entries.debit_credit = 1 THEN journal_entries.amount ELSE 0 END ) ) - SUM( ( CASE WHEN journal_entries.debit_credit = 0 THEN journal_entries.amount ELSE 0 END ) )  DESC')
                                            ->take(10)
                                            ->get();

        $end_date           = date('M d, Y',strtotime($end_date));

        $start_date         = date('M d, Y',strtotime($start_date));

        return Response::JSON([
            'top_expense'       => $top_expense,
            'start_date'        => $start_date,
            'end_date'          => $end_date
        ]);
    }

    public function topVendorExpense($id, $form_date, $to_date)
    {
        $date                       = Carbon::now()->startOfMonth();
        $end_date                   = Carbon::now()->endOfMonth();

        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        if($id == 1)
        {
            $start_date             = Carbon::now()->startOfMonth();
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 2) {

            $start_date             = date('Y-m-d', strtotime('-2 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 3) {

            $start_date             = date('Y-m-d', strtotime('-5 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 4) {
            $start_date             = date('Y-m-d', strtotime('-11 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($form_date != 0 || $to_date != 0) {
            $start_date             = date('Y-m-d', strtotime($form_date));
            $end_date               = date('Y-m-d', strtotime($to_date));
        }

        $vendor_expense             = JournalEntry::join('contact','contact.id','journal_entries.contact_id')
                                                    ->join('account','account.id','journal_entries.account_name_id')
                                                    ->join('users', 'users.id', 'journal_entries.created_by')
                                                    ->join('account_type','account_type.id','account.account_type_id')
                                                    ->whereBetween('journal_entries.assign_date',[$start_date,$end_date])
                                                    ->where('account_type.parent_account_type_id',5)
                                                    ->where('contact.contact_category_id',4)
                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                    ->selectRaw('SUM( ( CASE WHEN journal_entries.debit_credit = 1 THEN journal_entries.amount ELSE 0 END ) ) AS debit_amount, SUM( ( CASE WHEN journal_entries.debit_credit = 0 THEN journal_entries.amount ELSE 0 END ) ) AS credit_amount, contact.display_name as display_name')
                                                    ->groupBy('journal_entries.contact_id')
                                                    ->orderByRaw('SUM( ( CASE WHEN journal_entries.debit_credit = 1 THEN journal_entries.amount ELSE 0 END ) ) - SUM( ( CASE WHEN journal_entries.debit_credit = 0 THEN journal_entries.amount ELSE 0 END ) )  DESC')
                                                    ->take(10)
                                                    ->get();

        $end_date                   = date('M d, Y',strtotime($end_date));

        $start_date                 = date('M d, Y',strtotime($start_date));

        return Response::JSON([
            'vendor_expense'        => $vendor_expense,
            'start_date'            => $start_date,
            'end_date'              => $end_date
        ]);
    }

    public function expenseCount($id, $form_date, $to_date)
    {

        $date                   = Carbon::now()->startOfMonth();

        $end_date               = Carbon::now()->endOfMonth();

        $start_mounth           = date('Y-m-d', strtotime('-1 month',strtotime($date)));

        $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($date)));

        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        if($id == 1)
        {
            $start_date             = Carbon::now()->startOfMonth();

            $end_date               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-1 month',strtotime($start_date)));

            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($start_date)));
        }
        elseif ($id == 2) {

            $start_date             = date('Y-m-d', strtotime('-2 month',strtotime($date)));

            $end_date               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-2 month',strtotime($start_date)));
            
            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($start_date)));
        }
        elseif ($id == 3) {

            $start_date             = date('Y-m-d', strtotime('-5 month',strtotime($date)));

            $end_date               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-5 month',strtotime($start_date)));
            
            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($start_date)));
        }
        elseif ($id == 4) {
            $start_date             = date('Y-m-d', strtotime('-11 month',strtotime($date)));

            $end_date               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-11 month',strtotime($start_date)));
            
            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($start_date)));
        }
        elseif ($form_date != 0 || $to_date != 0) {
            $start_date             = date('Y-m-d', strtotime($form_date));
            $end_date               = date('Y-m-d', strtotime($to_date));

            $start_date1            = new DateTime($form_date);
            $end_date1              = new DateTime($end_date);

            $time_diff              = date_diff($start_date1,$end_date1);
            $days                   = $time_diff->d;
            $end_day                = $days+1;

            $start_mounth           = date('Y-m-d', strtotime('-'.$days.'day', strtotime($form_date)));
            
            $end_mounth             = date('Y-m-d', strtotime('-'.$end_day.'day', strtotime($to_date)));
        }

        $JournalEntryexpense    = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                              ->join('users', 'users.id', 'journal_entries.created_by')
                                              ->orderBy('jurnal_type','DESC')
                                              ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                      return $query->where('users.branch_id', $branch_id);
                                                  })
                                              ->selectRaw('journal_entries.*')
                                              ->whereIn('account.account_type_id', [17,19])
                                              ->get()
                                              ->sortBy('assign_date');

        $cos_debit              = $JournalEntryexpense->where('debit_credit', 1)
                                                        ->where('assign_date','>=',$start_date)
                                                        ->where('assign_date','<=',$end_date)
                                                       ->sum('amount');

        $cos_credit             = $JournalEntryexpense->where('debit_credit', 0)
                                                      ->where('assign_date','>=',$start_date)
                                                      ->where('assign_date','<=',$end_date)
                                                      ->sum('amount');

        $pcos_debit              = $JournalEntryexpense->where('debit_credit', 1)
                                                        ->where('assign_date','>=',$start_mounth)
                                                        ->where('assign_date','<=',$end_mounth)
                                                       ->sum('amount');

        $pcos_credit             = $JournalEntryexpense->where('debit_credit', 0)
                                                      ->where('assign_date','>=',$start_mounth)
                                                      ->where('assign_date','<',$end_mounth)
                                                      ->sum('amount');

        $expense_total           =   $cos_debit - $cos_credit;

        $pexpense_total          =   $pcos_debit - $pcos_credit;


        $start_date              = date('M d, Y',strtotime($start_date));

        $end_date                = date('M d, Y',strtotime($end_date));

        $start_mounth            = date('M d, Y',strtotime($start_mounth));

        $end_mounth              = date('M d, Y',strtotime($end_mounth));

        return Response::JSON([
            'expense_total'         => $expense_total,
            'pexpense_total'        => $pexpense_total,
            'start_date'            => $start_date,
            'end_date'              => $end_date,
            'start_mounth'          => $start_mounth,
            'end_mounth'            => $end_mounth,
        ]);
    }

    public function revenueCount($id, $form_date, $to_date)
    {
        $date                   = Carbon::now()->startOfMonth();

        $end_date               = Carbon::now()->endOfMonth();

        $start_mounth           = date('Y-m-d', strtotime('-1 month',strtotime($date)));

        $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($date)));

        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        if($id == 1)
        {
            $start_date             = Carbon::now()->startOfMonth();

            $end_date               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-1 month',strtotime($start_date)));

            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($start_date)));
        }
        elseif ($id == 2) {

            $start_date             = date('Y-m-d', strtotime('-2 month',strtotime($date)));

            $end_date               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-2 month',strtotime($start_date)));
            
            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($start_date)));
        }
        elseif ($id == 3) {

            $start_date             = date('Y-m-d', strtotime('-5 month',strtotime($date)));

            $end_date               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-5 month',strtotime($start_date)));
            
            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($start_date)));
        }
        elseif ($id == 4) {
            $start_date             = date('Y-m-d', strtotime('-11 month',strtotime($date)));

            $end_date               = Carbon::now()->endOfMonth();

            $start_mounth           = date('Y-m-d', strtotime('-11 month',strtotime($start_date)));
            
            $end_mounth             = date('Y-m-d', strtotime('0 month',strtotime($start_date)));
        }
        elseif ($form_date != 0 || $to_date != 0) {
            $start_date             = date('Y-m-d', strtotime($form_date));
            $end_date               = date('Y-m-d', strtotime($to_date));

            $start_date1            = new DateTime($form_date);
            $end_date1              = new DateTime($end_date);

            $time_diff              = date_diff($start_date1,$end_date1);
            $days                   = $time_diff->d;
            $end_day                = $days+1;

            $start_mounth           = date('Y-m-d', strtotime('-'.$days.'day', strtotime($form_date)));
            
            $end_mounth             = date('Y-m-d', strtotime('-'.$end_day.'day', strtotime($to_date)));
        }

        $JournalEntryIncome     = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                              ->join('users', 'users.id', 'journal_entries.created_by')
                                              ->orderBy('jurnal_type','DESC')
                                              ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                              ->selectRaw('journal_entries.*')
                                              ->whereIn('account.account_type_id', [15,16])
                                              ->get()
                                              ->sortBy('assign_date');

        $icos_debit             = $JournalEntryIncome->where('assign_date', '>=', $start_date)
                                                       ->where('assign_date', '<=', $end_date)
                                                       ->where('debit_credit', 1)
                                                       ->sum('amount');

        $icos_credit            = $JournalEntryIncome->where('assign_date', '>=', $start_date)
                                                       ->where('assign_date', '<=', $end_date)
                                                       ->where('debit_credit', 0)
                                                       ->sum('amount');

        $picos_debit            = $JournalEntryIncome->where('assign_date', '>=', $start_mounth)
                                                       ->where('assign_date', '<=', $end_mounth)
                                                       ->where('debit_credit', 1)
                                                       ->sum('amount');

        $picos_credit           = $JournalEntryIncome->where('assign_date', '>=', $start_mounth)
                                                       ->where('assign_date', '<=', $end_mounth)
                                                       ->where('debit_credit', 0)
                                                       ->sum('amount');

        $income_total           = $icos_credit - $icos_debit;
        $pincome_total          = $picos_credit - $picos_debit;

       

        $JournalEntryexpense    = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                              ->join('users', 'users.id', 'journal_entries.created_by')
                                              ->orderBy('jurnal_type','DESC')
                                              ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                              ->selectRaw('journal_entries.*')
                                              ->whereIn('account.account_type_id', [17,19])
                                              ->get()
                                              ->sortBy('assign_date');

        $ecos_debit              = $JournalEntryexpense->where('debit_credit', 1)
                                                        ->where('assign_date','>=',$start_date)
                                                        ->where('assign_date','<=',$end_date)
                                                       ->sum('amount');

        $ecos_credit            = $JournalEntryexpense->where('debit_credit', 0)
                                                      ->where('assign_date','>=',$start_date)
                                                      ->where('assign_date','<=',$end_date)
                                                      ->sum('amount');

        $pecos_debit            = $JournalEntryexpense->where('debit_credit', 1)
                                                        ->where('assign_date','>=',$start_mounth)
                                                        ->where('assign_date','<=',$end_mounth)
                                                        ->sum('amount');

        $pecos_credit           = $JournalEntryexpense->where('debit_credit', 0)
                                                      ->where('assign_date','>=',$start_mounth)
                                                      ->where('assign_date','<',$end_mounth)
                                                      ->sum('amount');

        $expense_total          = $ecos_debit - $ecos_credit;
        $pexpense_total         = $pecos_debit - $pecos_credit;

        
        $JournalEntry           = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                              ->join('users', 'users.id', 'journal_entries.created_by')
                                              ->orderBy('jurnal_type','DESC')
                                              ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                              ->selectRaw('journal_entries.*')
                                              ->where('account.account_type_id', 18)
                                              ->get()
                                              ->sortBy('assign_date');

        $ccos_debit             = $JournalEntry->where('assign_date', '>=', $start_date)
                                               ->where('assign_date', '<=', $end_date)
                                               ->where('debit_credit', 1)
                                               ->sum('amount');

        $ccos_credit            = $JournalEntry->where('assign_date', '>=', $start_date)
                                               ->where('assign_date', '<=', $end_date)
                                               ->where('debit_credit', 0)
                                               ->sum('amount');
        $pccos_debit            = $JournalEntry->where('assign_date', '>=', $start_mounth)
                                               ->where('assign_date', '<=', $end_mounth)
                                               ->where('debit_credit', 1)
                                               ->sum('amount');

        $pccos_credit           = $JournalEntry->where('assign_date', '>=', $start_mounth)
                                               ->where('assign_date', '<=', $end_mounth)
                                               ->where('debit_credit', 0)
                                               ->sum('amount');

        $cost_of_goods_sold     = $ccos_debit - $ccos_credit;
        $pcost_of_goods_sold    = $pccos_debit - $pccos_credit;


        $revenue                = $income_total - $expense_total - $cost_of_goods_sold;

        $prevenue                = $pincome_total - $pexpense_total - $pcost_of_goods_sold;

        $start_date              = date('M d, Y',strtotime($start_date));

        $end_date                = date('M d, Y',strtotime($end_date));

        $start_mounth            = date('M d, Y',strtotime($start_mounth));

        $end_mounth              = date('M d, Y',strtotime($end_mounth));
        
        return Response::JSON([
            'revenue'               => $revenue,
            'prevenue'              => $prevenue,
            'start_date'            => $start_date,
            'end_date'              => $end_date,
            'start_mounth'          => $start_mounth,
            'end_mounth'            => $end_mounth,
        ]);
    }
    
    public function yearlySales()
    {
        $date                     = Carbon::now();
        $startOfYear            = $date->copy()->startOfYear();

        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        $k = 0;

        for($i =1; $i <= 12; $i++)
        {
          $start_day                        = $k.' month';
          $end_day                          = $i.' month';

          $start_mounth                     = date('Y-m-d', strtotime($start_day,strtotime($startOfYear)));

          $end_mounth                       = date('Y-m-d', strtotime($end_day,strtotime($startOfYear)));

          $date_time                        = "str_to_date(invoices.invoice_date, '%Y-%m-%d') between '$start_mounth' and '$end_mounth'";

          $mounth_name                      = date('M', strtotime($start_day,strtotime($startOfYear)));

          $product_sales[$mounth_name]      = Invoice::join('users', 'users.id', 'invoices.created_by')
                                                    ->whereRaw($date_time)
                                                    ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                    ->selectRaw('sum(invoices.total_amount) as amount')
                                                    ->first();

          $k++;
        }

        return Response::JSON($product_sales);
    }
    
    public function receivableRecived($id,$form_date,$to_date)
    {
        $current_time           = Carbon::now()->toDayDateTimeString();

        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        if($id == 1)
        {
            $date_modify            = date('d');

            $st_month               = Carbon::now()->startOfMonth();
            $en_month               = Carbon::now()->endOfMonth();

            $time_diff              = date_diff($st_month,$en_month);
            $day                    = $time_diff->days;
            $days                   = $day + 1;

            $start_date_count       = $date_modify;
            $end_date_count         = $days - $date_modify;

            $startdate_modify       = '-'.$date_modify.' day';
            $end_date_modify        = '+'.$end_date_count.' day';

            $start_date             = (new DateTime($current_time))->modify($startdate_modify)->format('Y-m-d');
            $end_date               = (new DateTime($current_time))->modify($end_date_modify)->format('Y-m-d');
        }
        elseif($id == 2)
        {
            $st_month               = Carbon::now()->subMonth(2)->startOfMonth();
            $en_month               = Carbon::now()->endOfMonth();
            $time_diff              = date_diff($st_month,$en_month);
            
            $day                    = $time_diff->days;
            $days                   = $day + 1;
           
            $start_date_count       = $day;
            $end_date_count         = $days - $day;

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_date               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif($id == 3)
        {
            $st_month               = Carbon::now()->subMonth(5)->startOfMonth();
            $en_month               = Carbon::now()->endOfMonth();
            $time_diff              = date_diff($st_month,$en_month);
            
            $day                    = $time_diff->days;
            $days                   = $day + 1;
            
            $start_date_count       = $day;
            $end_date_count         = $days - $day;

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_date               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif($id == 4)
        {
            $st_month               = Carbon::now()->subMonth(11)->startOfMonth();
            $en_month               = Carbon::now()->endOfMonth();
            $time_diff              = date_diff($st_month,$en_month);
            
            $day                    = $time_diff->days;
            $days                   = $day + 1;
           
            $start_date_count       = $day;
            $end_date_count         = $days - $day;

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_date               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif ($form_date != 0 || $to_date != 0) 
        {
            $str_date               = date_create($form_date);
            $eto_date               = date_create($to_date);

            $time_diff              = date_diff($str_date, $eto_date);

            $day                    = $time_diff->days;

            $days                   = $day;

            // $start_date_count       = $day;
            // $end_date_count         = $days - $day;

            // $startdate_modify       = '-'.$start_date_count.' day';
            // $end_date_modify        = '+'.$end_date_count.' day';

            $start_date             = (new DateTime($form_date))->format('Y-m-d');
            $end_date               = (new DateTime($to_date))->format('Y-m-d');
        }

        //Calculate time slote interval start
          $day_diff               = floor(($days)/4);
          $four_day               = $days - ($day_diff * 3);
          $slot_1                 = '+'.$day_diff.' day';
          $slot_2                 = '+'.($day_diff + $day_diff).' day';
          $slot_3                 = '+'.($day_diff + $day_diff + $day_diff).' day';
          $slot_4                 = '+'.($day_diff + $day_diff + $day_diff + $four_day).' day';

        //Calculate time slote interval end

        //Making time slote array for query and graph start
          $time_slat[0][0]        = (new DateTime($start_date))->modify('-0 day')->format('Y-m-d');
          $time_slat[0][1]        = (new DateTime($start_date))->modify($slot_1)->format('Y-m-d');

          $time_slat[1][0]        = (new DateTime($start_date))->modify($slot_1)->format('Y-m-d');
          $time_slat[1][1]        = (new DateTime($start_date))->modify($slot_2)->format('Y-m-d');

          $time_slat[2][0]        = (new DateTime($start_date))->modify($slot_2)->format('Y-m-d');
          $time_slat[2][1]        = (new DateTime($start_date))->modify($slot_3)->format('Y-m-d');

          $time_slat[3][0]        = (new DateTime($start_date))->modify($slot_3)->format('Y-m-d');
          $time_slat[3][1]        = (new DateTime($start_date))->modify($slot_4)->format('Y-m-d');

        //Calculation of Receivable vs Received

            $daily_receivable                   = [];
            $daily_received                     = [];

            $daily_receivable_string            = "";
            $daily_received_string              = "";

            $total_receivable_this_month        = 0;
            $total_received_so_far              = 0;

            for($i = 0; $i < 4; $i++)
            {
                $query_start          =  $time_slat[$i][0];
                $query_end            =  $time_slat[$i][1];

                $payment_start        = (new DateTime($time_slat[$i][0]))->format('Y-m-d');
                $payment_end          = (new DateTime($time_slat[$i][1]))->format('Y-m-d');

                $date_difference      = "str_to_date(invoice_due_table.due_date,'%Y-%m-%d') between '$query_start' and '$query_end'";
                $date_payment         = "str_to_date(payment_receives.payment_date,'%Y-%m-%d') between '$payment_start' and '$payment_end'";

                if($i == 0){

                    $previous_receivable        = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                                          ->join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                          ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                              return $query->where('users.branch_id', $branch_id);
                                                          })
                                                          ->whereRaw($date_difference)
                                                          ->selectRaw('SUM(invoices.due_amount) as total_invoice_amount')
                                                          ->get()
                                                          ->toArray();

                    $previous_receivable = count($previous_receivable) > 0 ? $previous_receivable[0]['total_invoice_amount'] : 0;
                }else{
                    $previous_receivable = 0;
                }
                    

                $total_amount                     = Invoice::join('users', 'invoices.created_by', '=', 'users.id')
                                                            ->join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                            ->whereRaw($date_difference)
                                                            ->selectRaw('SUM(total_amount) as total_invoice_amount')
                                                            ->get()
                                                            ->toArray();

                $total_amount                     = count($total_amount) > 0 ? $total_amount[0]['total_invoice_amount'] : 0;

                $received_total_till_last_month   = Invoice::leftjoin('payment_receives_entries', 'payment_receives_entries.invoice_id', 'invoices.id')
                                                            ->leftjoin('payment_receives', 'payment_receives.id', 'payment_receives_entries.payment_receives_id')
                                                            ->join('users', 'invoices.created_by', '=', 'users.id')
                                                            ->join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                            ->whereRaw($date_difference)
                                                            ->whereRaw($date_payment)
                                                            ->selectRaw('SUM(payment_receives_entries.amount) as received_total_till_last_month')
                                                            ->get()
                                                            ->toArray();


                $received_total_till_last_month   = count($received_total_till_last_month) > 0 ? $received_total_till_last_month[0]['received_total_till_last_month'] : 0;

                $receivable[]                     = $total_amount - $received_total_till_last_month;

                $received[]                       = PaymentReceives::join('users', 'payment_receives.created_by', '=', 'users.id')
                                                                  ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                              return $query->where('users.branch_id', $branch_id);
                                                                          })
                                                                   ->whereRaw($date_payment)
                                                                  ->sum('amount');
            }

            $start_date           = date('M d, Y',strtotime($start_date));  

            $end_date             = date('M d, Y',strtotime($end_date));

            return Response::JSON([
              'receivable'        => $receivable,
              'received'          => $received,
              'time_slat'         => $time_slat,
              'start_date'        => $start_date,
              'end_date'          => $end_date,
            ]);
    }

    public function payablePaid($id,$form_date,$to_date)
    {
        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        $current_time           = Carbon::now()->toDayDateTimeString();

        if($id == 1)
        {
            $date_modify            = date('d');

            $st_month               = Carbon::now()->startOfMonth();
            $en_month               = Carbon::now()->endOfMonth();

            $time_diff              = date_diff($st_month,$en_month);
            $day                    = $time_diff->days;
            $days                   = $day + 1;

            $start_date_count       = $date_modify;
            $end_date_count         = $days - $date_modify;

            $startdate_modify       = '-'.$date_modify.' day';
            $end_date_modify        = '+'.$end_date_count.' day';

            $start_date             = (new DateTime($current_time))->modify($startdate_modify)->format('Y-m-d');
            $end_date               = (new DateTime($current_time))->modify($end_date_modify)->format('Y-m-d');
        }
        elseif($id == 2)
        {
            $st_month               = Carbon::now()->subMonth(2)->startOfMonth();
            $en_month               = Carbon::now()->endOfMonth();
            $time_diff              = date_diff($st_month,$en_month);
            
            $day                    = $time_diff->days;
            $days                   = $day + 1;
           
            $start_date_count       = $day;
            $end_date_count         = $days - $day;

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_date               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif($id == 3)
        {
            $st_month               = Carbon::now()->subMonth(5)->startOfMonth();
            $en_month               = Carbon::now()->endOfMonth();
            $time_diff              = date_diff($st_month,$en_month);
            
            $day                    = $time_diff->days;
            $days                   = $day + 1;
            
            $start_date_count       = $day;
            $end_date_count         = $days - $day;

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_date               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif($id == 4)
        {
            $st_month               = Carbon::now()->subMonth(11)->startOfMonth();
            $en_month               = Carbon::now()->endOfMonth();
            $time_diff              = date_diff($st_month,$en_month);
            
            $day                    = $time_diff->days;
            $days                   = $day + 1;
           
            $start_date_count       = $day;
            $end_date_count         = $days - $day;

            $start_date             = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_date               = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');
        }
        elseif ($form_date != 0 || $to_date != 0) 
        {
            $str_date               = date_create($form_date);
            $eto_date               = date_create($to_date);

            $time_diff              = date_diff($str_date, $eto_date);

            $day                    = $time_diff->days;

            $days                   = $day;

            $start_date             = (new DateTime($form_date))->format('Y-m-d');
            $end_date               = (new DateTime($to_date))->format('Y-m-d');
        }

        //Calculate time slote interval start
          $day_diff               = floor(($days)/4);
          $four_day               = $days - ($day_diff * 3);
          $slot_1                 = '+'.$day_diff.' day';
          $slot_2                 = '+'.($day_diff + $day_diff).' day';
          $slot_3                 = '+'.($day_diff + $day_diff + $day_diff).' day';
          $slot_4                 = '+'.($day_diff + $day_diff + $day_diff + $four_day).' day';

        //Calculate time slote interval end

        //Making time slote array for query and graph start
            $time_slat[0][0]        = (new DateTime($start_date))->modify('-0 day')->format('Y-m-d');
            $time_slat[0][1]        = (new DateTime($start_date))->modify($slot_1)->format('Y-m-d');

            $time_slat[1][0]        = (new DateTime($start_date))->modify($slot_1)->format('Y-m-d');
            $time_slat[1][1]        = (new DateTime($start_date))->modify($slot_2)->format('Y-m-d');

            $time_slat[2][0]        = (new DateTime($start_date))->modify($slot_2)->format('Y-m-d');
            $time_slat[2][1]        = (new DateTime($start_date))->modify($slot_3)->format('Y-m-d');

            $time_slat[3][0]        = (new DateTime($start_date))->modify($slot_3)->format('Y-m-d');
            $time_slat[3][1]        = (new DateTime($start_date))->modify($slot_4)->format('Y-m-d');
        //Making time slote array for query and graph start
            $daily_payable                      = [];
            $daily_paid                         = [];

            $daily_payable_string               = "";
            $daily_paid_string                  = "";
            $expense_pie                        = "";
            $expense_pie2                       = "";

            $total_payable_this_month           = 0;
            $total_paid_so_far                  = 0;

            for($i = 0; $i < 4; $i++){

                $query_start          =  $time_slat[$i][0];
                $query_end            =  $time_slat[$i][1];

                $payment_start        = new Carbon($time_slat[$i][0]);
                $payment_end          = new Carbon($time_slat[$i][1]);

                $date_difference      = "str_to_date(bill_due_table.due_date,'%Y-%m-%d') between '$query_start' and '$query_end'";
                $date_payment         = "str_to_date(payment_made.payment_date,'%Y-%m-%d') between '$payment_start' and '$payment_end'";

                if($i == 0){

                  $previous_payable = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                          ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                          ->when($branch_id != 1, function ($query) use ($branch_id) {
                                              return $query->where('users.branch_id', $branch_id);
                                          })
                                          ->whereRaw($date_difference)
                                          ->selectRaw('SUM(bill.due_amount) as total_bill_amount')
                                          ->get()
                                          ->toArray();

                  $previous_payable = count($previous_payable) > 0 ? $previous_payable[0]['total_bill_amount'] : 0;
                                         

                }else{
                  $previous_payable = 0;
                }

                $total_amount                   = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                                      ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                                      ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                      ->whereRaw($date_difference)
                                                      ->selectRaw('SUM(bill.amount) as total_bill_amount')
                                                      ->get()
                                                      ->toArray();

                $total_amount                   = count($total_amount) > 0 ? $total_amount[0]['total_bill_amount'] : 0;


                $paid_total_till_last_month     = Bill::leftjoin('payment_made_entry', 'payment_made_entry.bill_id', 'bill.id')
                                                          ->leftjoin('payment_made', 'payment_made.id', 'payment_made_entry.payment_made_id')
                                                          ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                                          ->join('users', 'bill.created_by', '=', 'users.id')
                                                          ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                              return $query->where('users.branch_id', $branch_id);
                                                          })
                                                          ->whereRaw($date_difference)
                                                          ->whereRaw($date_payment)
                                                          ->selectRaw('SUM(payment_made_entry.amount) as paid_total_till_last_month')
                                                          ->get()
                                                          ->toArray();

                $paid_total_till_last_month   = count($paid_total_till_last_month) > 0 ? $paid_total_till_last_month[0]['paid_total_till_last_month'] : 0;

                $payable[]                    = $total_amount - $paid_total_till_last_month;

                $paid[]                       = PaymentMade::join('users', 'payment_made.created_by', '=', 'users.id')
                                                          ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                              return $query->where('users.branch_id', $branch_id);
                                                          })
                                                          ->whereRaw($date_payment)
                                                          ->sum('amount');
            }

          $start_date           = date('M d, Y',strtotime($start_date));  

          $end_date             = date('M d, Y',strtotime($end_date));

        return Response::JSON([
            'payable'           => $payable,
            'paid'              => $paid,
            'time_slat'         => $time_slat,
            'start_date'        => $start_date,
            'end_date'          => $end_date,
        ]);
    }

    public function accoutPR()
    {
        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        $current_time           = Carbon::now()->toDayDateTimeString();

        $time_slat[0][0]        = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $time_slat[0][1]        = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');

        $time_slat[1][0]        = (new DateTime($current_time))->modify('-31 day')->format('Y-m-d');
        $time_slat[1][1]        = (new DateTime($current_time))->modify('-60 day')->format('Y-m-d');

        $time_slat[2][0]        = (new DateTime($current_time))->modify('-61 day')->format('Y-m-d');
        $time_slat[2][1]        = (new DateTime($current_time))->modify('-90 day')->format('Y-m-d');

        $time_slat[3][0]        = (new DateTime($current_time))->modify('-91 day')->format('Y-m-d');
        $time_slat[3][1]        = (new DateTime($current_time))->modify('-99999 day')->format('Y-m-d');

        //Payable start
            for($i = 0; $i < 4; $i++){

                $query_start            =  $time_slat[$i][0];
                $query_end              =  $time_slat[$i][1];

                $payment_start          = new Carbon($time_slat[$i][0]);
                $payment_end            = new Carbon($time_slat[$i][1]);

                $date_difference        = "str_to_date(bill_due_table.due_date,'%Y-%m-%d') between '$query_end' and '$query_start'";
                $date_payment           = "str_to_date(payment_made.payment_date,'%Y-%m-%d') between '$payment_end' and '$payment_start'";

                if($i == 0){

                  $previous_payable     = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                              ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                              ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                  return $query->where('users.branch_id', $branch_id);
                                              })
                                              ->whereRaw($date_difference)
                                              ->selectRaw('SUM(bill.due_amount) as total_bill_amount')
                                              ->get()
                                              ->toArray();

                  $previous_payable     = count($previous_payable) > 0 ? $previous_payable[0]['total_bill_amount'] : 0;
                                         

                }else{
                  $previous_payable = 0;
                }

                $total_amount                   = Bill::join('users', 'bill.created_by', '=', 'users.id')
                                                      ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                                      ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                          return $query->where('users.branch_id', $branch_id);
                                                      })
                                                      ->whereRaw($date_difference)
                                                      ->selectRaw('SUM(bill.amount) as total_bill_amount')
                                                      ->get()
                                                      ->toArray();

                $total_amount                   = count($total_amount) > 0 ? $total_amount[0]['total_bill_amount'] : 0;


                $paid_total_till_last_month     = Bill::leftjoin('payment_made_entry', 'payment_made_entry.bill_id', 'bill.id')
                                                          ->leftjoin('payment_made', 'payment_made.id', 'payment_made_entry.payment_made_id')
                                                          ->join('bill_due_table','bill_due_table.bill_id','bill.id')
                                                          ->join('users', 'bill.created_by', '=', 'users.id')
                                                          ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                              return $query->where('users.branch_id', $branch_id);
                                                          })
                                                          ->whereRaw($date_difference)
                                                          ->whereRaw($date_payment)
                                                          ->selectRaw('SUM(payment_made_entry.amount) as paid_total_till_last_month')
                                                          ->get()
                                                          ->toArray();

                $paid_total_till_last_month   = count($paid_total_till_last_month) > 0 ? $paid_total_till_last_month[0]['paid_total_till_last_month'] : 0;

                $payable[]                    = $total_amount - $paid_total_till_last_month;
            }
        //Payable end

        //Receivable start
            for($i = 0; $i < 4; $i++)
            {
                $query_start          =  $time_slat[$i][0];
                $query_end            =  $time_slat[$i][1];

                $payment_start        = (new DateTime($time_slat[$i][0]))->format('Y-m-d');
                $payment_end          = (new DateTime($time_slat[$i][1]))->format('Y-m-d');

                $date_difference      = "str_to_date(invoice_due_table.due_date,'%Y-%m-%d') between '$query_end' and '$query_start'";
                $date_payment         = "str_to_date(payment_receives.payment_date,'%Y-%m-%d') between '$payment_end' and '$payment_start'";

                if($i == 0){
                    $previous_receivable        = Invoice::join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                          ->join('users', 'invoices.created_by', '=', 'users.id')
                                                          ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                              return $query->where('users.branch_id', $branch_id);
                                                          })
                                                          ->whereRaw($date_difference)
                                                          ->selectRaw('SUM(invoices.due_amount) as total_invoice_amount')
                                                          ->get()
                                                          ->toArray();

                    $previous_receivable = count($previous_receivable) > 0 ? $previous_receivable[0]['total_invoice_amount'] : 0;
                }else{
                    $previous_receivable = 0;
                }

                $total_amount                     = Invoice::join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                            ->join('users', 'invoices.created_by', '=', 'users.id')
                                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                return $query->where('users.branch_id', $branch_id);
                                                            })
                                                            ->whereRaw($date_difference)
                                                            ->selectRaw('SUM(total_amount) as total_invoice_amount')
                                                            ->get()
                                                            ->toArray();

                $total_amount                     = count($total_amount) > 0 ? $total_amount[0]['total_invoice_amount'] : 0;

                $received_total_till_last_month   = Invoice::leftjoin('payment_receives_entries', 'payment_receives_entries.invoice_id', 'invoices.id')
                                                            ->leftjoin('payment_receives', 'payment_receives.id', 'payment_receives_entries.payment_receives_id')
                                                            ->join('invoice_due_table', 'invoice_due_table.invoice_id', 'invoices.id')
                                                            ->join('users', 'invoices.created_by', '=', 'users.id')
                                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                return $query->where('users.branch_id', $branch_id);
                                                            })
                                                            ->whereRaw($date_difference)
                                                            ->whereRaw($date_payment)
                                                            ->selectRaw('SUM(payment_receives_entries.amount) as received_total_till_last_month')
                                                            ->get()
                                                            ->toArray();


                $received_total_till_last_month   = count($received_total_till_last_month) > 0 ? $received_total_till_last_month[0]['received_total_till_last_month'] : 0;

                $receivable[]                     = $total_amount - $received_total_till_last_month;
            }
        //Receivable end

        return Response::JSON([
            'payable'           => $payable,
            'receivable'        => $receivable
        ]);
    }

    public function salesSummary()
    {
        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);

        $today                  = Carbon::today()->format('d-m-Y');
        //Invoise Start
        $invoice_difference     = "date_format(STR_TO_DATE(invoices.invoice_date, '%Y-%m-%d'),'$today')";

        $invoices               = Invoice::join('contact', 'contact.id', 'invoices.customer_id')
                                          ->join('users', 'invoices.created_by', '=', 'users.id')
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', $branch_id);
                                            })
                                          ->whereRaw($invoice_difference)
                                          ->selectRaw('invoices.*, contact.display_name as display_name')
                                          ->get()
                                          ->toArray();

        //Invoise End

        //Bill Start
        $bill_difference        = "date_format(STR_TO_DATE(bill.bill_date, '%Y-%m-%d'),'$today')";

        $bills                  = Bill::join('contact', 'contact.id', 'bill.vendor_id')
                                        ->join('users', 'bill.created_by', '=', 'users.id')
                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                            return $query->where('users.branch_id', $branch_id);
                                        })
                                        ->whereRaw($bill_difference)
                                        ->selectRaw('bill.*, contact.display_name as display_name')
                                        ->get()
                                        ->toArray();
        //Bill End

        //Revenue Start
        $income_difference        = "date_format(STR_TO_DATE(incomes.date, '%Y-%m-%d'),'$today')";
        $preceive_difference    = "date_format(STR_TO_DATE(payment_receives.payment_date, '%Y-%m-%d'),'$today')";

        $incomes                = Income::join('contact','contact.id','incomes.customer_id')
                                        ->join('users', 'incomes.created_by', '=', 'users.id')
                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                            return $query->where('users.branch_id', $branch_id);
                                        })
                                        ->whereRaw($income_difference)
                                        ->selectRaw('incomes.amount as amount, CONCAT("INC-",LPAD(incomes.income_number,6,0)) as in_pr_number, contact.display_name as display_name')
                                        ->get()
                                        ->toArray();

        $payment_receives       = PaymentReceives::join('contact','contact.id','payment_receives.customer_id')
                                            ->join('users', 'payment_receives.created_by', '=', 'users.id')
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', $branch_id);
                                            })
                                            ->whereRaw($preceive_difference)
                                            ->selectRaw('payment_receives.amount as amount, CONCAT("PR-",payment_receives.pr_number) as in_pr_number, contact.display_name as display_name')
                                            ->get()
                                            ->toArray();

        $income_payment    = array_merge($incomes,$payment_receives);
        //Revenue End

        //Expense Start
        $expense_difference     = "date_format(STR_TO_DATE(expense.date, '%Y-%m-%d'),'$today')";

        $payment_difference      = "date_format(STR_TO_DATE(payment_made.payment_date, '%Y-%m-%d'),'$today')";

        $expenses          = Expense::whereRaw($expense_difference)
                                        ->join('users', 'expense.created_by', '=', 'users.id')
                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                            return $query->where('users.branch_id', $branch_id);
                                        })
                                      ->join('branch','branch.id','=','users.branch_id')
                                      ->selectRaw('expense.amount as amount, CONCAT("EXP-",LPAD(expense.expense_number,6,0)) as ex_pm_number, users.name as display_name')
                                      ->get()
                                      ->toArray();

        $payment_mades      = PaymentMade::join('contact', 'contact.id', 'payment_made.vendor_id')
                                         ->join('users', 'payment_made.created_by', '=', 'users.id')
                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                            return $query->where('users.branch_id', $branch_id);
                                        })
                                         ->whereRaw($payment_difference)
                                         ->selectRaw('payment_made.amount as amount, CONCAT("PM-",payment_made.pm_number) as ex_pm_number, contact.display_name as display_name')
                                         ->get()
                                         ->toArray();

        $expense_payment    = array_merge($expenses,$payment_mades);  
        //Expense End

       return Response::JSON([
            'invoices'              => $invoices,
            'bills'                 => $bills,
            'expense_payment'       => $expense_payment,
            'income_payment'        => $income_payment,
        ]);
    }

    public function cashflow()
    {
        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);
        
        $date                     = Carbon::now();
        $startOfYear            = $date->copy()->startOfYear();

        $JournalEntryIncome     = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                            ->join('users', 'journal_entries.created_by', '=', 'users.id')
                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', $branch_id);
                                            })
                                              ->orderBy('jurnal_type','DESC')
                                              ->selectRaw('journal_entries.*')
                                              ->whereIn('account.account_type_id', [4,5])
                                              ->get()
                                              ->sortBy('assign_date');
        $k = 0;

        for($i =1; $i <= 12; $i++)
        {
            $start_day                        = $k.' month';
            $end_day                          = $i.' month';

            $start_mounth                     = date('Y-m-d', strtotime($start_day,strtotime($startOfYear)));

            $end_mounth                       = date('Y-m-d', strtotime($end_day,strtotime($startOfYear)));


            $mounth_name                      = date('M', strtotime($start_day,strtotime($startOfYear)));


            $income[$mounth_name]            = $JournalEntryIncome->where('assign_date', '>=', $start_mounth)
                                                           ->where('assign_date', '<=', $end_mounth)
                                                           ->where('debit_credit', 1)
                                                           ->sum('amount');

            $expense[$mounth_name]           = $JournalEntryIncome->where('assign_date', '>=', $start_mounth)
                                                           ->where('assign_date', '<=', $end_mounth)
                                                           ->where('debit_credit', 0)
                                                           ->sum('amount');

            $cashflow[$mounth_name]           = $income[$mounth_name] - $expense[$mounth_name];

          $k++;
        }


        return Response::JSON([
            'income'            => $income,
            'expense'           => $expense,
            'cashflow'          => $cashflow,
        ]);
    }

    public function customerSales($id,$form_date,$to_date)
    {
        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);
        
        $date                       = Carbon::now()->startOfMonth();
        $end_date                   = Carbon::now()->endOfMonth();

        if($id == 1)
        {
            $start_date             = Carbon::now()->startOfMonth();
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 2) {

            $start_date             = date('Y-m-d', strtotime('-2 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 3) {

            $start_date             = date('Y-m-d', strtotime('-5 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($id == 4) {
            $start_date             = date('Y-m-d', strtotime('-11 month',strtotime($date)));
            $end_date               = Carbon::now()->endOfMonth();
        }
        elseif ($form_date != 0 || $to_date != 0) {
            $start_date             = date('Y-m-d', strtotime($form_date));
            $end_date               = date('Y-m-d', strtotime($to_date));
        }

        $date_time             = "str_to_date(invoices.invoice_date, '%Y-%m-%d') between '$start_date' and '$end_date'";

        $customer_sales        = Invoice::join('contact','contact.id', 'invoices.customer_id')
                                        ->join('users', 'invoices.created_by', '=', 'users.id')
                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                            return $query->where('users.branch_id', $branch_id);
                                        })
                                         ->whereRaw($date_time)
                                         ->selectRaw('SUM(invoices.total_amount) as amount, contact.display_name as display_name')
                                         ->groupBy('invoices.customer_id')
                                         ->orderByRaw('SUM(invoices.total_amount) DESC')
                                         ->take(10)
                                         ->get();

        $end_date           = date('M d, Y',strtotime($end_date));

        $start_date         = date('M d, Y',strtotime($start_date));

        return Response::JSON([
            'customer_sales'    => $customer_sales,
            'start_date'        => $start_date,
            'end_date'          => $end_date
        ]);
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
