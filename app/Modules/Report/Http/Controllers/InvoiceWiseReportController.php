<?php

namespace App\Modules\Report\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contact\Contact;
use App\Models\Branch\Branch;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\MoneyOut\Bill;
use Carbon\Carbon;
use App\Models\MoneyOut\SelectInvoiceBill;
use DateTime;
use App\User;
use DB;
use Redirect;
use Auth;
use App\Models\OrganizationProfile\OrganizationProfile;
Use Session;

class InvoiceWiseReportController extends Controller
{	
	private $branch_id      = 0;
    private $targeted_users = [];

    public function index(Request $request,$start,$end,$id){

        $start                = isset($_GET['from_date']) ? date('Y-m-d', strtotime($_GET['from_date'])) : date('Y-m-d', strtotime($start));
        $end                  = isset($_GET['to_date']) ? date('Y-m-d', strtotime($_GET['to_date'])) : date('Y-m-d', strtotime($end));
      
        $invoice_pr = Invoice::where('customer_id',$id)
                                ->join('invoice_entries','invoices.id','invoice_entries.invoice_id')
                                ->join('item','invoice_entries.item_id','item.id')
                                ->selectRaw('invoices.id as id,invoices.total_amount,invoices.invoice_date,invoices.invoice_number, GROUP_CONCAT(item.item_name) as item_name, GROUP_CONCAT(invoice_entries.quantity) as item_qty, GROUP_CONCAT(invoice_entries.rate) as item_rate, GROUP_CONCAT(invoice_entries.amount) as item_amount')
                                ->where(DB::Raw('STR_TO_DATE(invoice_date, "%d-%m-%Y")'), '>=', $start)
                                ->where(DB::Raw('STR_TO_DATE(invoice_date, "%d-%m-%Y")'), '<=', $end)
                                ->groupBy('invoices.id')
                                ->get();
                                
        $OrganizationProfile = OrganizationProfile::find(1);
        $customer            = Contact::find($id,['display_name','id']);
        $branch              = Auth::user()->branch_id;
        $current_branch      = Branch::find($branch);
        $branch_name         = Branch::where('id', $branch)->first();
                        
        return view('report::invoice-wise-report.index', compact('invoice_pr','id','start', 'end', 'branch_name', 'OrganizationProfile', 'customer', 'current_branch'));
      
    }
    public function bill(Request $request,$start,$end,$id){
        $start               = isset($_GET['from_date']) ? date('Y-m-d', strtotime($_GET['from_date'])) : date('Y-m-d', strtotime($start));
        $end                 = isset($_GET['to_date']) ? date('Y-m-d', strtotime($_GET['to_date'])) : date('Y-m-d', strtotime($end));
        $condition           = "str_to_date(bill_date, '%Y-%m-%d') between '$start' and '$end'";
        $bill_pr             = Bill::where('vendor_id',$id)
                                    ->join('bill_entry',"bill.id",'=','bill_entry.bill_id')
                                    ->join('item','bill_entry.item_id','=','item.id')
                                    ->selectRaw('bill.id as id,bill.amount,bill.bill_date,bill.bill_number, GROUP_CONCAT(item.item_name) as item_name, GROUP_CONCAT(bill_entry.quantity) as item_qty, GROUP_CONCAT(bill_entry.rate) as item_rate, GROUP_CONCAT(bill_entry.amount) as item_amount')
                                    ->where(DB::Raw('STR_TO_DATE(bill_date, "%Y-%m-%d")'), '>=', $start)
                                    ->where(DB::Raw('STR_TO_DATE(bill_date, "%Y-%m-%d")'), '<=', $end)
                                    ->groupBy('bill.id')
                                    ->get();
                                    
       $branch               = Auth::user()->branch_id;
       $customer             = Contact::find($id,['display_name','id']);
       $OrganizationProfile  = OrganizationProfile::find(1);
       $current_branch       = Branch::find($branch);
       $branch_name          = Branch::where('id', $branch)->first();
       
      return view('report::invoice-wise-report.bill', compact('bill_pr','start', 'end','id', 'branch_name', 'OrganizationProfile', 'customer', 'current_branch'));
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

