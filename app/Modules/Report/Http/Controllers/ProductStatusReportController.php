<?php

namespace App\Modules\Report\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Branch\Branch;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Inventory\ProductTransfer;
use App\Models\MoneyOut\StockSerial;
use App\Models\Moneyin\Invoice;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
// use date
use DatePeriod;
use DateInterval;
use App\Models\Crm\Zone\Zone;
use App\Models\Contact\Contact;
use App\Models\Inventory\Item;

class ProductStatusReportController extends Controller
{
    public function index()
    {
    	$branch_id		 	    = session('branch_id');
    	$branch 			    = Branch::all();
    	$current_time 		    = Carbon::now()->toDayDateTimeString();
    	$start 				    = isset($_GET['from']) ? $_GET['from'] : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
    	$end 				    = isset($_GET['to']) ? $_GET['to'] : (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $OrganizationProfile    = OrganizationProfile::find(1);
    
        $zones                  = Zone::get();
        $contacts               = Contact::get();
        $srs                    = User::get();
        $items                  = Item::get();
        
        $zone_id                = isset($_GET['zone_id']) ? $_GET['zone_id'] : 0;
        $sr_id                  = isset($_GET['sr_id']) ? $_GET['sr_id'] : 0;
        $customer_id            = isset($_GET['customer_id']) ? $_GET['customer_id'] : 0;
        $item_id                = isset($_GET['product_id']) ? $_GET['product_id'] : 0;
        
        $zone_name              = Zone::find($zone_id);
        $sr_name                = User::find($sr_id);
        $customer_name          = Contact::find($customer_id);
        $item_name              = Item::find($item_id);
                                                    
        $products               = Invoice::where(DB::Raw('STR_TO_DATE(invoices.invoice_date, "%d-%m-%Y")'), '>=', $start)
                                            ->where(DB::Raw('STR_TO_DATE(invoices.invoice_date, "%d-%m-%Y")'), '<=', $end)
                                            ->join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
                                            ->join('item', 'item.id', 'invoice_entries.item_id')
                                            ->join('contact', 'contact.id', 'invoices.customer_id')
                                            ->join('users', 'users.id', 'invoices.created_by')
                                            ->when($zone_id != 0,function($query) use ($zone_id){
                                                return $query->where('users.zone_id', $zone_id);
                                            })
                                            ->when($sr_id != 0,function($query) use ($sr_id){
                                                return $query->where('invoices.created_by', $sr_id);
                                            })
                                            ->when($customer_id != 0,function($query) use ($customer_id){
                                                return $query->where('invoices.customer_id', $customer_id);
                                            })
                                            ->when($item_id != 0,function($query) use ($item_id){
                                                return $query->where('item.id', $item_id);
                                            })
                                            ->selectRaw('invoices.invoice_number as invoice_number,
                                                         invoices.invoice_date as invoice_date,
                                                         item.id as item_id,
                                                         item.item_name as item_name,
                                                         invoices.total_amount as total_amount,
                                                         invoice_entries.quantity as quantity,
                                                         contact.display_name as customer_name,
                                                         users.name as created_by,
                                                         users.zone_id as zone_id')
                                            ->get();
        
        
        foreach($products as $key => $value)
        {   
            $data[$value->invoice_number]['invoice_number']         = $value->invoice_number;
            $data[$value->invoice_number]['invoice_date']           = $value->invoice_date;
            $data[$value->invoice_number]['item_id'][]              = $value->item_id;
            $data[$value->invoice_number]['item_name'][]            = $value->item_name;
            $data[$value->invoice_number]['total_amount']           = $value->total_amount;
            $data[$value->invoice_number]['quantity'][]             = $value->quantity;
            $data[$value->invoice_number]['rate'][]                 = $value->quantity;
            $data[$value->invoice_number]['customer_name']          = $value->customer_name;
            $data[$value->invoice_number]['sr_name']                = $value->created_by;
            $data[$value->invoice_number]['zone_id']                = $value->zone_id;
        }

    	return view('report::product_status',compact('OrganizationProfile', 'branch', 'branch_name', 'start', 'end', 'branch_id', 'product', 'data', 'zones', 'contacts', 'items', 'zone_id', 'sr_id', 'customer_id', 'item_id', 'srs', 'zone_name', 'sr_name', 'customer_name', 'item_name'));
    }
    
    public function indexStatus()
    {
        $branch_id              = session('branch_id');
        $branch                 = Branch::all();
        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = isset($_GET['from']) ? $_GET['from'] : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                    = isset($_GET['to']) ? $_GET['to'] : (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $OrganizationProfile    = OrganizationProfile::find(1);


        $zones                  = Zone::get();
        $srs                    = User::get();
        $items                  = Item::get();
        $status                 = DB::table('stock_serial_status')->get();

        $zone_id                = isset($_GET['zone_id']) ? $_GET['zone_id'] : 0;
        $sr_id                  = isset($_GET['sr_id']) ? $_GET['sr_id'] : 0;
        $item_id                = isset($_GET['product_id']) ? $_GET['product_id'] : 0;
        $imei_number            = isset($_GET['imei_number']) ? $_GET['imei_number'] : 0;
        $status_id              = isset($_GET['status_id']) ? $_GET['status_id'] : 0;

        $zone_name              = Zone::find($zone_id);
        $sr_name                = User::find($sr_id);
        $item_name              = Item::find($item_id);
        $status_name            = DB::table('stock_serial_status')->where('id', $status_id)->first();

        $products               = ProductTransfer::where(DB::Raw('STR_TO_DATE(product_transfers.date, "%d-%m-%Y")'), '>=', $start)
                                            ->where(DB::Raw('STR_TO_DATE(product_transfers.date, "%d-%m-%Y")'), '<=', $end)
                                            ->join('stock_serial', 'stock_serial.serial', 'product_transfers.serial')
                                            ->join('item', 'item.id', 'stock_serial.item_id')
                                            ->when($zone_id != 0,function($query) use ($zone_id){
                                                return $query->join('users', 'users.id', 'product_transfers.sr_id')->where('users.zone_id', $zone_id);
                                            })
                                            ->when($sr_id != 0,function($query) use ($sr_id){
                                                return $query->where('product_transfers.sr_id', $sr_id);
                                            })
                                            ->when($imei_number != 0,function($query) use ($imei_number){
                                                return $query->where('product_transfers.serial', $imei_number);
                                            })
                                            ->when($status_id != 0,function($query) use ($status_id){
                                                return $query->where('stock_serial.stock_status', $status_id);
                                            })
                                            ->when($item_id != 0,function($query) use ($item_id){
                                                return $query->where('item.id', $item_id);
                                            })            
                                            ->select('product_transfers.serial as product_serial', 
                                                         'item.item_name as product_name', 
                                                         'stock_serial.stock_status as status',
                                                         'stock_serial.invoice_id as invoice_id',
                                                         'product_transfers.sr_id as sr_id',
                                                         DB::raw('MAX(STR_TO_DATE(product_transfers.date, "%d-%m-%Y")) as transfer_date')) 
                                            ->orderBy('product_transfers.serial', 'ASC')
                                            ->groupBy('product_transfers.serial')
                                            ->get();
        // dd($products->toArray());

        $all  = User::when($sr_id != 0,function($query) use ($sr_id){
                            return $query->where('id', $sr_id);
                        })
                        ->get();

        foreach ($all as $key => $value)
        {   
            $pro                                = $products->where('sr_id', $value['id']);
            $data[$value['id']]['sr_id']        = $value['id'];
            $data[$value['id']]['sr_name']      = $value['name'];
            $data[$value['id']]['status_id']    = array_values($pro->groupBy('product_serial')->toArray());
        }

        // foreach ($products as $key => $value)
        // {   
        //     $pro                                = $products->where('sr_id', $value['id']);

        //     $data[$value->sr_id]['sr_id']                                           = $value['sr_id'];
        //     $data[$value->sr_id]['status_id'][]                                     = $value['status'];
        //     $data[$value->sr_id]['status_id']['invoice_id'][]                       = $value['invoice_id'];
        //     $data[$value->sr_id]['status_id']['invoice_id']['product_serial'][]     = $value['product_serial'];
        //     $data[$value->sr_id]['status_id']['invoice_id']['product_name'][]       = $value['product_name'];

        // }

        $data  = array_values($data);

        // dd($data);

        return view('report::product_status_report',compact('OrganizationProfile', 'branch', 'branch_name', 'start', 'end', 'branch_id', 'product', 'data', 'zones', 'contacts', 'items', 'zone_id', 'sr_id', 'item_id', 'srs', 'zone_name', 'sr_name', 'item_name','status_id', 'status', 'imei_number', 'status_name'));
    }
}
