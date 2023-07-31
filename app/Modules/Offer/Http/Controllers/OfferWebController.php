<?php

namespace App\Modules\Offer\Http\Controllers;

use Carbon\Carbon;

use App\Models\Setting\Unit;
use Illuminate\Http\Request;
use App\Models\Offers\Offers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Attributes\Attributes;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemVariation;
use NumberToWords\Legacy\Numbers\Words\Locale\Id;

class OfferWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offers::get();
        return view('offer::index', compact('offers'));
    }

    public function create()
    {
        $attributes = Attributes::all();
        $item_variations = ItemCategory::all();
        $units = Unit::get();
        return view('offer::create', compact('attributes', 'item_variations', 'units'));
    }

    public function store(Request $request)
    {
        if ((isset($request->free_item_id) && $request->free_item_id != '' && isset($request->free_item_selected_variation) && $request->free_item_selected_variation != '' && isset($request->free_item_quantity) && $request->free_item_quantity != '') || (isset($request->cashback_amount) && $request->cashback_amount != '' && isset($request->cashback_type) && $request->cashback_type != '')) {
            $this->validate($request, [
                'start_date'                    => 'required|before:end_date',
                'end_date'                      => 'required|after:start_date',
                'item_id'                       => 'required',
                'base_quantity'                 => 'required',
            ]);
        } else {
            $this->validate($request, [
                'start_date'                    => 'required|before:end_date',
                'end_date'                      => 'required|after:start_date',
                'item_id'                       => 'required',
                'base_quantity'                 => 'required',
                'free_item_id'                  => 'required',
                'free_item_quantity'            => 'required',
                'cashback_amount'               => 'required',
                'cashback_type'                 => 'required',
            ]);
        }
        try {
            DB::beginTransaction();
            $unit = Unit::where('id', $request->unit_id)->select('basic_unit_conversion')->first();

            $helper = new \App\Lib\Helpers;


            $offer = new Offers;
            $offer->start_date = date('Y-m-d', strtotime($request->start_date));
            $offer->end_date = date('Y-m-d', strtotime($request->end_date));
            $offer->item_id = $request->item_id;
            $offer->item_variation_id = empty($request->item_selected_variation) ? null : $request->item_selected_variation;
            $offer->base_quantity = $helper->unitQuantity($request->base_quantity, $unit->basic_unit_conversion);
            $offer->free_item_id = $request->free_item_id == '' ? null : $request->free_item_id;
            $offer->free_item_variation_id = empty($request->free_item_selected_variation) ? null : $request->free_item_selected_variation;
            $offer->free_quantity = $request->free_item_quantity == '' || $request->free_item_quantity == 0 ? null : $request->free_item_quantity;
            $offer->cashback_amount = $request->cashback_amount == '' || $request->cashback_amount == 0 ? null : $request->cashback_amount;
            $offer->cashback_type = $request->cashback_type == '' ? null : $request->cashback_type;
            $offer->created_by = Auth::user()->id;
            $offer->updated_by = Auth::user()->id;
            $offer->created_at = Carbon::now();
            $offer->updated_at = Carbon::now();


            $offer->unit_id = $request->unit_id;
            $offer->basic_unit_conversion = $unit->basic_unit_conversion;
            $offer->save();
            DB::commit();
            return redirect()
                ->route('offers')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Offer Created Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $attributes = Attributes::all();
        $item_variations = ItemVariation::all();
        $offer = Offers::findorfail($id);
        $units = Unit::get();
        return view('offer::edit', compact('units', 'offer', 'attributes', 'item_variations'));
    }

    public function update(Request $request, $id)
    {
        $offer = Offers::find($id);
        if ((isset($request->free_item_id) && $request->free_item_id != '' && isset($request->free_item_quantity) && $request->free_item_quantity != '') || (isset($request->cashback_amount) && $request->cashback_amount != '' && isset($request->cashback_type) && $request->cashback_type != '')) {
            $this->validate($request, [
                'start_date'        => 'required|before:end_date',
                'end_date'          => 'required|after:start_date',
                'item_id'           => 'required',
                'base_quantity'     => 'required',
            ]);
        } else {
            $this->validate($request, [
                'start_date'        => 'required|before:end_date',
                'end_date'          => 'required|after:start_date',
                'item_id'           => 'required',
                'base_quantity'     => 'required',
                'free_item_id'      => 'required',
                'free_item_quantity' => 'required',
                'cashback_amount'   => 'required',
                'cashback_type'     => 'required',
            ]);
        }
        try {
            DB::beginTransaction();
            $unit = Unit::where('id', $request->unit_id)->select('basic_unit_conversion')->first();

            $helper = new \App\Lib\Helpers;
            $offer->start_date = date('Y-m-d', strtotime($request->start_date));
            $offer->end_date = date('Y-m-d', strtotime($request->end_date));
            $offer->item_id = $request->item_id;
            $offer->item_variation_id = empty($request->item_selected_variation) ? null : $request->item_selected_variation;
            $offer->base_quantity = $helper->unitQuantity($request->base_quantity, $unit->basic_unit_conversion);
            $offer->free_item_id = $request->free_item_id == '' ? null : $request->free_item_id;
            $offer->free_item_variation_id = empty($request->free_item_selected_variation) ? null : $request->free_item_selected_variation;
            $offer->free_quantity = $request->free_item_quantity == '' ? null : $request->free_item_quantity;
            $offer->cashback_amount = $request->cashback_amount == '' ? null : $request->cashback_amount;
            $offer->cashback_type = $request->cashback_type == '' ? null : $request->cashback_type;
            $offer->updated_by = Auth::user()->id;
            $offer->updated_at = Carbon::now();

            $offer->unit_id = $request->unit_id;
            $offer->basic_unit_conversion = $unit->basic_unit_conversion;
            $offer->update();
            DB::commit();
            return redirect()
                ->route('offers')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Offer Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $offer = Offers::findorfail($id);
            if (count($offer->billFreeEntry)) {
                return redirect()
                    ->route('offers')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'This offer is used in bills. First You have to delete bills with this offer.');
            }
            $offer->delete();
            DB::commit();
            return redirect()
                ->route('offers')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Offer Deleted Successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', $th->getMessage());
        }
    }

    public function getOffers($id, $variation_id = null)
    {
        $data = Offers::where('item_id', $id)
            ->when(!empty($variation_id), function ($qr) use ($variation_id){
                return $qr->where('item_variation_id', $variation_id);
            })
            ->where('start_date', '<=', date('Y-m-d'))
            ->where('end_date', '>', date('Y-m-d'))
            ->get();
        if (count($data) > 0) {
            return response()->json(['success' => 'Offer Exists', 'offers' => $data]);
        } else {
            return response()->json(['error' => 'Offers not found']);
        }
    }
}
