<?php

namespace App\Modules\Inventory\Http\Controllers;

use DB;
use Session;
use App\User;
use DateTime;

use Response;
use Exception;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Str;
use App\Models\Setting\Unit;
use Illuminate\Http\Request;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Company\Company;
use App\Models\Inventory\Stock;

// Models
use App\Http\Controllers\Controller;
use App\Models\Moneyin\InvoiceEntry;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\StockTransfer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class StockTransferWebController extends Controller
{
	public function index()
	{
		$data = StockTransfer::orderBy('id', 'DESC')->get();
		$branches 	= Branch::all();
		$branch_id = session('branch_id');

		return view('inventory::stock_transfer.index', compact('data', 'branches', 'branch_id'));
	}

	public function create()
	{
		$branches 	= Branch::all();
		$items 		= Item::all();
		$units = Unit::get();
		return view('inventory::stock_transfer.create', compact('branches', 'items', 'units'));
	}

	public function store(Request $request)
	{

		//  $this->validate($request, [
		//     'transfer_from' => 'required',
		//     'transfer_item' => 'required',
		//     'quantity'   	=> 'required',
		//     'transfer_to'   => 'required',
		//     'date'   		=> 'required',
		// ]);

		try {
			DB::beginTransaction();
			$helper = new \App\Lib\Helpers;
			$unit = Unit::where('id', $request->unit_id)->select('basic_unit_conversion')->first();

			$item 						= Item::findOrFail($request->transfer_item);


			$transfer 					= new StockTransfer;
			// dd($transfer);
			$transfer->transfer_from 	= $request->transfer_from;
			$transfer->transfer_to 		= $request->transfer_to;
			$transfer->item_category_id = $item->item_category_id;
			$transfer->item_id 			= $request->transfer_item;
			$transfer->quantity 		= $helper->unitQuantity($request->quantity, $unit->basic_unit_conversion);
			$transfer->unit_id          = $request->unit_id;
			$transfer->basic_unit_conversion    = $unit->basic_unit_conversion;
			$transfer->date 			= date('Y-m-d', strtotime($request->date));
			$transfer->created_by 		= Auth::user()->id;
			$transfer->updated_by 		= Auth::user()->id;


			$transfer->save();
			// dd( $transfer);


			$stock 						= new Stock;

			$stock->stock_transfer_id 	= $transfer->id;
			$stock->total 				= $transfer->quantity;
			$stock->date 				= $transfer->date;
			$stock->item_category_id 	= $transfer->item_category_id;
			$stock->item_id 			= $transfer->item_id;
			$stock->branch_id 			= $transfer->transfer_to;
			$stock->created_by 			= $transfer->created_by;
			$stock->updated_by 			= $transfer->updated_by;
			$stock->save();

			DB::commit();

			return redirect()
				->route('stock_transfer')
				->with('alert.status', 'success')
				->with('alert.message', 'Stock Transfer has done Successfully!');
		} catch (\Exception $e) {
			dd($e);
			DB::rollback();

			return redirect()
				->back()
				->with('alert.status', 'danger')
				->with('alert.message', 'Something went wrong, Please try again!');
		}
	}

	public function edit($id)
	{
		$data 		= StockTransfer::findOrFail($id);
		$branches 	= Branch::all();
		$items 		= Item::all();
		$units      = Unit::get();

		return view('inventory::stock_transfer.edit', compact('units', 'data', 'branches', 'items'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'transfer_from' => 'required',
			'transfer_item' => 'required',
			'quantity'   	=> 'required',
			'transfer_to'   => 'required',
			'date'   		=> 'required',
		]);

		try {
			DB::beginTransaction();
			$helper = new \App\Lib\Helpers;
			$unit = Unit::where('id', $request->unit_id)->select('basic_unit_conversion')->first();


			$item 						= Item::findOrFail($request->transfer_item);

			$transfer 					= StockTransfer::findOrFail($id);

			$transfer->transfer_from 	= $request->transfer_from;
			$transfer->transfer_to 		= $request->transfer_to;
			$transfer->item_category_id = $item->item_category_id;
			$transfer->item_id 			= $request->transfer_item;
			$transfer->quantity 		= $helper->unitQuantity($request->quantity, $unit->basic_unit_conversion);
			$transfer->unit_id          = $request->unit_id;
			$transfer->basic_unit_conversion    = $unit->basic_unit_conversion;
			$transfer->date 			= date('Y-m-d', strtotime($request->date));
			$transfer->created_by 		= Auth::user()->id;
			$transfer->updated_by 		= Auth::user()->id;
			$transfer->save();

			$stock 						= Stock::where('stock_transfer_id', $id)->first();

			$stock->stock_transfer_id 	= $transfer->id;
			$stock->total 				= $transfer->quantity;
			$stock->date 				= $transfer->date;
			$stock->item_category_id 	= $transfer->item_category_id;
			$stock->item_id 			= $transfer->item_id;
			$stock->branch_id 			= $transfer->transfer_to;
			$stock->created_by 			= $transfer->created_by;
			$stock->updated_by 			= $transfer->updated_by;
			$stock->save();

			DB::commit();

			return redirect()
				->route('stock_transfer')
				->with('alert.status', 'success')
				->with('alert.message', 'Stock Transfer updated Successfully!');
		} catch (\Exception $e) {
			dd($e);

			DB::rollback();

			return redirect()
				->back()
				->with('alert.status', 'danger')
				->with('alert.message', 'Something went wrong, Please try again!');
		}
	}

	public function destroy($id)
	{
		$transfer 	= StockTransfer::findOrFail($id);

		$stock 		= Stock::where('stock_transfer_id', $id)->first();
		$stock->delete();

		$transfer->delete();


		return redirect()
			->route('stock_transfer')
			->with('alert.status', 'success')
			->with('alert.message', 'Stock Transfer deleted Successfully!');
	}
}
