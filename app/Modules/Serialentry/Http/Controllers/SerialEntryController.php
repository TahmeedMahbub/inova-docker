<?php

namespace App\Modules\Serialentry\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\MoneyOut\StockSerial;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use DateTime;
class SerialEntryController extends Controller
{
   public function index()
   {
   	    $bill_number      = isset($_GET['bill_no']) ? $_GET['bill_no'] : 0;
        $current_time     = Carbon::now()->toDayDateTimeString();
   	    $start            = isset($_GET['from_date']) ? date('Y-m-d', strtotime($_GET['from_date'])) : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end              = isset($_GET['to_date']) ? date('Y-m-d', strtotime($_GET['to_date'])) : (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');

       $condition         = "str_to_date(bill_date, '%Y-%m-%d') between '$start' and '$end'";

   	    $bills            = Bill::whereRaw($condition)
                              ->when($bill_number != 0, function ($query) use ($bill_number)
                                    {
                                        return $query->where('bill.bill_number', $bill_number);
                                    })
   	                         ->get();
   	return view('serialentry::index',compact('bills'));
   }



 	public function edit($id)
 	{
	    $bill_entry 	= BillEntry::leftjoin('item', 'item.id', 'bill_entry.item_id')
	    							->where('bill_id', $id)
	    							->groupBy('item_id')
	    							->selectRaw('bill_entry.id, item_id, item_name, bill_id, SUM(quantity) as qty')
	    							->get();


	  	$serial_arr = [];

	    foreach($bill_entry as $bill_entry_tmp){

	    	$serials = StockSerial::where('item_id', $bill_entry_tmp->item_id)
    							->where('bill_id', $bill_entry_tmp->bill_id)
    							->get();


    		foreach($serials as $serials_tmp){

    			$serial_arr[$bill_entry_tmp->item_id]['serial'][] = $serials_tmp->serial;
    			$serial_arr[$bill_entry_tmp->item_id]['invoice_id'][] = $serials_tmp->invoice_id;

    		}

 		}

 		$select_bill = Bill::where('id',$id)->selectRaw('id, bill_number,bill_date')->first();

       	return view('serialentry::edit', compact('serial_arr', 'select_bill','bill_entry'));

 }

 	public function update(Request $request)
 	{
 		$user_id = Auth::user()->id;

 		DB::beginTransaction();

	   try{

		    StockSerial::where('bill_id', $request->bill_id)->where('invoice_id', null)->delete();

		    foreach ($request->serial as $key1 => $value)
		 	{
		 		array_search($key1, array_keys($value));

		 		$item_id = $key1;

		 		foreach ($value as $key2 => $data)
		 		{
		 			if($data != null)
		 			{
			 			$stock   				        = new StockSerial();

			 			$stock->entry_date   	  = date("Y-m-d", strtotime($request->date));
			 			$stock->bill_id         = $request->bill_id;
			 			$stock->item_id         = $item_id;
			 			$stock->serial   		    = $data;
			 			$stock->created_by      = $user_id;
            $stock->updated_by      = $user_id;

			 			$stock->save();
		 			}
		 		}
		 	}

		 	DB::commit();
		 	return redirect()->route('serial_entry')
                          ->with('alert.status', 'success')
                          ->with('alert.message', 'Serial Entry Updated Successfully!!!');


		}
		catch(\Exception $exception){

			DB::rollback();
		 	return redirect()->route('serial_entry')
	                          ->with('alert.status', 'danger')
	                          ->with('alert.message', 'Serial Entry  Not Updated Due To Duplicate Entries  !!!');

	    }

 }



}
