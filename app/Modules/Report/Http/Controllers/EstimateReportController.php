<?php

namespace App\Modules\Report\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\MoneyOut\Expense;
use App\Models\AccountChart\Account;
use App\Models\ManualJournal\JournalEntry;
use App\Models\OrganizationProfile\OrganizationProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\User;
use Response;
use App\Models\Branch\Branch;
use App\Models\Moneyin\Estimate;
use App\Models\Moneyin\Estimate_Entry;
use App\Models\Moneyin\Invoice;
use App\Models\Contact\Contact;

class EstimateReportController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function estimateReport()
    {
        $hide_show              = 0;
        $branch_id              = session('branch_id');
        $this->getBranchUsers($branch_id);
        $OrganizationProfile    = OrganizationProfile::find(1);
        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end_time               = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $opening_end_time       = (new DateTime($current_time))->modify('-1 day')->format('Y-m-d');
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        $condition              = "str_to_date(date, '%Y-%m-%d') between '$start' and '$end_time'";
        $opening_condition      = "str_to_date(date, '%Y-%m-%d') between '$begin_time' and '$opening_end_time'";
        $contact_category       = 0;

        $total_estimates        = Estimate::all()->count();
        $total_invoices         = Estimate::count();


        if ($branch_id == 1)
        {
            $estimates          = Estimate::whereRaw($condition)
                                            ->join('estimate_entries', 'estimate_entries.estimate_id', 'estimates.id')
                                            ->join('item', 'item.id', 'estimate_entries.item_id')
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, estimates.*')
                                            ->groupBy("estimates.id")
                                            ->orderByRaw('str_to_date(estimates.date, "%Y-%m-%d"), "ASC"')
                                            ->get();
        }
        else
        {
            $estimates          = Estimate::whereRaw($condition)
                                            ->join('estimate_entries', 'estimate_entries.estimate_id', 'estimates.id')
                                            ->join('item', 'item.id', 'estimate_entries.item_id')
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, estimates.*')
                                            ->groupBy("estimates.id")
                                            ->orderByRaw('str_to_date(estimates.date, "%Y-%m-%d"), "ASC"')
                                            ->get();

            $estimates          = $estimates->whereIn('created_by', $this->targeted_users);
        }

        $branch                 = Branch::all();
        //reset end to request end date
        $end                    = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $category               = Contact::where('contact_category_id', 3)->orderBy('display_name', 'ASC')->get();


        return view('report::EstimateReport.estimate_report', compact('start','end_time' ,'OrganizationProfile', 'branch', 'current_time', 'estimates', 'category', 'contact_category', 'hide_show', 'opening_end_time', 'total_estimates', 'total_invoices'))->with('branch_id', $this->branch_id);
    }

    public function estimateReportFilter(Request $request)
    {
        // dd($request->toArray());
        $hide_show              = 1;
        $branch_id              = $request->branch_id;

        $this->getBranchUsers($branch_id);

        if($request->branch_id ){
            $this->branch_id =  $request->branch_id;
        }

        $OrganizationProfile    = OrganizationProfile::find(1);

        $total_estimates        = Estimate::all()->count();
        $total_invoices         = Estimate::count();

        $start                  = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->from_date_select)) : date("Y-m-d",strtotime($request->from_date));
        $end_time               = (empty($request->from_date)) ? date("Y-m-d",strtotime($request->to_date_select)) : date("Y-m-d",strtotime($request->to_date));

        $current_time           = Carbon::now()->toDayDateTimeString();
        $begin_time             = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $opening_end_time       = (new DateTime($start))->modify('-1 day')->format('Y-m-d');

        $condition              = "str_to_date(date, '%Y-%m-%d') between '$start' and '$end_time'";
        $opening_condition      = "str_to_date(date, '%Y-%m-%d') between '$begin_time' and '$opening_end_time'";
        $contact_category       = (!empty($request->contact_category_seaarch)) ? $request->contact_category_seaarch : 0;

        $contact_category_name  = Contact::find($request->contact_category_seaarch);


        if ($branch_id == 1)
        {
            if($request->contact_category_seaarch != 0)
            {
                $estimates      = Estimate::whereRaw($condition)
                                            ->join('estimate_entries', 'estimate_entries.estimate_id', 'estimates.id')
                                            ->join('item', 'item.id', 'estimate_entries.item_id')
                                            ->join('contact', 'contact.id', 'estimates.estimatted_by')
                                            ->where('contact.id', $request->contact_category_seaarch)
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, estimates.*')
                                            ->groupBy("estimates.id")
                                            ->orderByRaw('str_to_date(estimates.date, "%Y-%m-%d"), "ASC"')
                                            ->get();


            }
            else
            {
                $estimates       = Estimate::whereRaw($condition)
                                                ->join('estimate_entries', 'estimate_entries.estimate_id', 'estimates.id')
                                            	->join('item', 'item.id', 'estimate_entries.item_id')
                                                ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, estimates.*')
                                                ->groupBy("estimates.id")
                                                ->orderByRaw('str_to_date(estimates.date, "%Y-%m-%d"), "ASC"')
                                                ->get();

                                            // dd($estimates);

            }
        }
        else
        {
            if($request->contact_category_seaarch != 0)
            {
                $estimates      = Estimate::whereRaw($condition)
                                            ->join('estimate_entries', 'estimate_entries.estimate_id', 'estimates.id')
                                            ->join('item', 'item.id', 'estimate_entries.item_id')
                                            ->join('contact', 'contact.id', 'estimates.estimatted_by')
                                            ->where('contact.id', $request->contact_category_seaarch)
                                            ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, estimates.*')
                                            ->groupBy("estimates.id")
                                            ->orderByRaw('str_to_date(estimates.date, "%Y-%m-%d"), "ASC"')
                                            ->get();

                $estimates      = $estimates->whereIn('created_by', $this->targeted_users);
            }
            else
            {
                $estimates      = Estimate::whereRaw($condition)
                                                ->join('estimate_entries', 'estimate_entries.estimate_id', 'estimates.id')
                                            	->join('item', 'item.id', 'estimate_entries.item_id')
                                                ->selectRaw('GROUP_CONCAT(item.item_name) as item_name, estimates.*')
                                                ->groupBy("estimates.id")
                                                ->orderByRaw('str_to_date(estimates.date, "%Y-%m-%d"), "ASC"')
                                                ->get();

                $estimates      = $estimates->whereIn('created_by', $this->targeted_users);
            }
        }


        $branch                 = Branch::all();
        //reset end to request end date
        $end                    = date("Y-m-d",strtotime($request->input('to_date')."-0 day"));
        $category               = Contact::where('contact_category_id', 3)->orderBy('display_name', 'ASC')->get();

        // dd($category);
        return view('report::EstimateReport.estimate_report', compact('start','end_time' ,'OrganizationProfile', 'branch', 'current_time', 'estimates', 'category', 'contact_category', 'contact_category_name', 'hide_show', 'opening_end_time', 'total_estimates', 'total_invoices'))->with('branch_id', $this->branch_id);
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
