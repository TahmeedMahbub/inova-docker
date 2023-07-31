<?php

namespace App\Modules\Report\Http\Controllers\Stock;

use App\Models\Inventory\Item;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\OrganizationProfile\OrganizationProfile;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Inventory\ItemSubCategory;
use App\Models\Moneyin\Invoice;
use App\Models\MoneyOut\Bill;

class PostController extends Controller
{


  public function index()
  {
    $OrganizationProfile    = OrganizationProfile::find(1);
    $current_time           = Carbon::now()->toDayDateTimeString();
    $start                  = isset($_GET['from_date']) ? date('Y-m-d', strtotime($_GET['from_date'])) : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
    $end                    = isset($_GET['to_date']) ? date('Y-m-d', strtotime($_GET['to_date'])) : (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
    $subcategories          = ItemSubCategory::all();

    $items                  = Item::all();

    $invoices               = Invoice::whereBetween('invoices.invoice_date', [$start, $end])
                                        ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                        ->selectRaw('invoice_entries.item_id as item_id, SUM(invoice_entries.amount) as sales_amount')
                                        ->groupBy('invoice_entries.item_id')
                                        ->get();

    $bills                  = Bill::whereBetween('bill.bill_date', [$start, $end])
                                        ->join('bill_entry', 'bill_entry.bill_id', 'bill.id')
                                        ->selectRaw('bill_entry.item_id as item_id, SUM(bill_entry.amount) as purchase_amount')
                                        ->groupBy('bill_entry.item_id')
                                        ->get();

    foreach ($items as $key => $item)
    {
        $data[$item->id]['item_id']             = $item->id;
        $data[$item->id]['item_name']           = $item->item_name;
        $data[$item->id]['total_purchases']     = $item->total_purchases;
        $data[$item->id]['sub_cat_id']          = $item->item_sub_category_id;
        $data[$item->id]['total_sales']         = $item->total_sales;
        $data[$item->id]['item_sales_rate']     = $item->item_sales_rate;
        $data[$item->id]['sales_amount']        = $invoices->where('item_id', $item->id)->sum('sales_amount');
        $data[$item->id]['purchase_amount']     = $bills->where('item_id', $item->id)->sum('purchase_amount');
    }

    return view('report::Stock.index',compact('end','start','OrganizationProfile','data','subcategories'));
  }
  
  public function filter(Request $request)
  {
    $OrganizationProfile = [];
    $OrganizationProfile = OrganizationProfile::find(1);

    $start = date('Y-m-d',strtotime($request->from_date));
    $end = date('Y-m-d',strtotime($request->to_date));

    $stock = [];

    $stock =  Item::all();
      $subcategories = ItemSubCategory::all();

    return view('report::Stock.index',compact('end','start','OrganizationProfile','stock','subcategories'));
  }
  
  public function details(Request $request,$id,$start=null,$end=null)
  {
    $OrganizationProfile=[];
    $OrganizationProfile = OrganizationProfile::find(1);
    if($request->from_date && $request->to_date){
        $start = date('Y-m-d',strtotime($request->from_date));
        $end = date('Y-m-d',strtotime($request->to_date));
    }else{
        $start = date('Y-m-d',strtotime($start));
        $end = date('Y-m-d',strtotime($end));
    }

    $stock = [];
    $stock =  Item::find($id);

    return view('report::Stock.details',compact('start','end','OrganizationProfile','stock'));
  }


}
