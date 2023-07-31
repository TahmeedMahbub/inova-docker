<?php

namespace App\Modules\Report\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Branch\Branch;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Moneyin\Invoice;
use App\Models\MoneyOut\Bill;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemSubCategory;
use App\Models\Contact\Contact;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
// use date
use DatePeriod;
use DateInterval;

class ProfitReportController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function index()
    {
    	$branch_id		 	 = session('branch_id');
    	$this->getBranchUsers($branch_id);
    	$branch 			 = Branch::all();
    	$current_time 		 = Carbon::now()->toDayDateTimeString();
    	$start 				 = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
    	$end 				 = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
       
        if($branch_id == 1) {

        	$invoices 			= Invoice::join('contact','contact.id','invoices.customer_id')
        									->whereBetween('invoices.invoice_date', [$start,$end])
        									->selectRaw('invoices.*')
        									->get();

        	$bills  			= Bill::join('contact','contact.id','bill.vendor_id')
            								->whereBetween('bill.bill_date', [$start,$end])
        									->selectRaw('bill.*')
        									->get();
        } else {
            $invoices           = Invoice::join('contact','contact.id','invoices.customer_id')
                                            ->whereBetween('invoices.invoice_date', [$start,$end])
                                            ->selectRaw('invoices.*')
                                            ->get();
            $invoices           = $invoices->whereIn('created_by', $this->targeted_users);

            $bills              = Bill::join('contact','contact.id','bill.vendor_id')
                                            ->whereBetween('bill.bill_date', [$start,$end])
                                            ->selectRaw('bill.*')
                                            ->get();
            $bills              =  $bills->whereIn('created_by', $this->targeted_users);
        }

        $OrganizationProfile = OrganizationProfile::find(1);
    	$branch_name 		 = Branch::find($branch_id);

    	return view('report::profitReport.profit_report',compact('OrganizationProfile','branch','branch_name','start','end','invoices','bills', 'branch_id'));
    }

    public function profiteSearch(Request $request)
    {
    	$OrganizationProfile    = OrganizationProfile::find(1);
    	if ($request->branch_id != null)
        {
            $branch_id          = $request->branch_id;
        }else{
            $branch_id          = session('branch_id');
        }
        $this->getBranchUsers($branch_id);

    	$branch 			 = Branch::all();
    	$start 				 = date('Y-m-d',strtotime($request->from_date));
    	$end 				 = date('Y-m-d',strtotime($request->to_date));

      if($branch_id == 1)
      {
    	$invoices 			 = Invoice::whereBetween('invoices.invoice_date', [$start,$end])
                                        ->join('contact','contact.id','invoices.customer_id')
    									->selectRaw('invoices.*')
                                        ->orderByRaw('invoices.invoice_date','ASC')
    									->get();
                                       
    	$bills 				 = Bill::whereBetween('bill.bill_date', [$start,$end])
        								->join('contact','contact.id','bill.vendor_id')
        								->selectRaw('bill.*')
                                        ->orderByRaw('bill.bill_date', 'ASC')
        								->get();

        }
        else
        {
            $invoices           = Invoice::whereBetween('invoices.invoice_date', [$start,$end])
                                        ->join('contact','contact.id','invoices.customer_id')
                                        ->selectRaw('invoices.*')
                                        ->orderByRaw('invoices.invoice_date','ASC')
                                        ->get();

            $invoices           = $invoices->whereIn('created_by', $this->targeted_users);
                                       
            $bills              = Bill::whereBetween('bill.bill_date', [$start,$end])
                                        ->join('contact','contact.id','bill.vendor_id')
                                        ->selectRaw('bill.*')
                                        ->orderByRaw('bill.bill_date', 'ASC')
                                        ->get();

            $bills             = $bills->whereIn('created_by', $this->targeted_users);                            
        }

    	$branch_name 		 = Branch::find($branch_id);

    	return view('report::profitReport.profit_report',compact('OrganizationProfile','branch','branch_name','start','end','invoices','bills', 'branch_id'));
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
