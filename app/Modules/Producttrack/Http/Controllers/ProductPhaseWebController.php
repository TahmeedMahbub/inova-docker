<?php

namespace App\Modules\Producttrack\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\Item;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory\ItemVariation;
use App\Models\Inventory\ManufacturePhase;
use App\Models\Inventory\ManufacturePhaseDisburse;
use App\Models\Inventory\ManufacturePhaseRawMaterials;
use App\Models\Inventory\ManufacturePhaseReceiveFromFactory;

class ProductPhaseWebController extends Controller
{
    public function index()
    {
        return view('producttrack::phase.index');
    }

    public function rawMaterialCreate($id)
    {
        $manufacture_id = ManufacturePhase::find($id)->manufacture_id;
        $items = Item::with('itemVariations')->get();
        $raw_materials = ItemVariation::all();
        return view('producttrack::phase.raw-material.create', compact('items','raw_materials', 'id', 'manufacture_id'));
    }

    public function rawMaterialStore(Request $request)
    {
        $this->validate($request, [
            'item_variation.*' => 'required',
            'quantity_pcs.*' => 'required',
        ],
        [
            'item_variation.*.required' => 'Raw Material is required',
            'quantity_pcs.*.required' => 'Quantity is required',
        ]);
        try{
            DB::beginTransaction();
            foreach ($request->item_variation as $key => $value) {
                $raw_materials = ManufacturePhaseRawMaterials::create([
                    'manufacture_phase_id' => $request->manufacture_phase_id,
                    'item_id' => ItemVariation::where('id', $value)->first()->item->id,
                    'variation_id' => $value,
                    'quantity' => $request->quantity_pcs[$key],
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ]);
            }
            DB::commit();
            return redirect()
            ->route('phase_raw_material_show', ['id' => $raw_materials->manufacturePhase->id])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Raw Material Added Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function rawMaterialEdit($id)
    {
        try{
            $items = Item::with('itemVariations')->get();
            $raw_materials = ItemVariation::all();
            $manufacture_phase = ManufacturePhase::find($id);
            return view('producttrack::phase.raw-material.edit', compact('manufacture_phase', 'items', 'raw_materials'));
        }catch(\Exception $e){
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function rawMaterialUpdate(Request $request, $id){
        $this->validate($request, [
            'item_variation.*' => 'required',
            'quantity_pcs.*' => 'required',
        ],
        [
            'item_variation.*.required' => 'Raw Material is required',
            'quantity_pcs.*.required' => 'Quantity is required',
        ]);
        try{
            DB::beginTransaction();
            ManufacturePhaseRawMaterials::where('manufacture_phase_id', $id)->delete();
            foreach ($request->item_variation as $key => $value) {
                $raw_materials = ManufacturePhaseRawMaterials::create([
                    'manufacture_phase_id' => $id,
                    'item_id' => ItemVariation::where('id', $value)->first()->item->id,
                    'variation_id' => $value,
                    'quantity' => $request->quantity_pcs[$key],
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ]);
            }
            DB::commit();
            return redirect()
            ->route('phase_raw_material_show', ['id' => $raw_materials->manufacturePhase->id])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Raw Material Updated Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function rawMaterialDestroy($id){
        try{
            DB::beginTransaction();
            $raw_material = ManufacturePhaseRawMaterials::findorfail($id);
            $phase_id = $raw_material->manufacturePhase->id;
            $raw_material->delete();
            DB::commit();
            return redirect()
            ->route('phase_raw_material_show', ['id' => $phase_id])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Raw Material Deleted Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function rawMaterialShow($id)
    {
        try{
            $manufacture_phase = ManufacturePhase::find($id);
            return view('producttrack::phase.raw-material.show', compact('id', 'manufacture_phase'));
        }catch(\Exception $e){
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function disburseCreate($id)
    {
        $manufacture_id = ManufacturePhase::find($id)->manufacture_id;
        $items = Item::with('itemVariations')->get();
        $raw_materials = ItemVariation::all();
        return view('producttrack::phase.disburse.create', compact('items','raw_materials', 'id', 'manufacture_id'));
    }    

    public function disburseStore(Request $request)
    {
        $this->validate($request, [
            'item_variation.*'  => 'required',
            'quantity_pcs.*'    => 'required',
            'date.*'            => 'required',
        ],
        [
            'item_variation.*.required' => 'Raw Material is required',
            'quantity_pcs.*.required'   => 'Quantity is required',
            'date.*.required'           => 'Disburse Date is required',
        ]);
        try{
            DB::beginTransaction();
            foreach ($request->item_variation as $key => $value) {
                $disburses = ManufacturePhaseDisburse::create([
                    'date'                  => date('Y-m-d', strtotime($request->date[$key])),
                    'manufacture_phase_id'  => $request->manufacture_phase_id,
                    'item_id'               => ItemVariation::where('id', $value)->first()->item->id,
                    'variation_id'          => $value,
                    'quantity'              => $request->quantity_pcs[$key],
                    'created_by'            => Auth::user()->id,
                    'updated_by'            => Auth::user()->id,
                ]);
            }
            DB::commit();
            return redirect()
            ->route('phase_disburse_show', ['id' => $disburses->manufacturePhase->id])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Disbursed Material Added Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function disburseEdit($id)
    {
        try{
            $items = Item::with('itemVariations')->get();
            $raw_materials = ItemVariation::all();
            $manufacture_phase = ManufacturePhase::find($id);
            return view('producttrack::phase.disburse.edit', compact('manufacture_phase', 'items', 'raw_materials'));
        }catch(\Exception $e){
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function disburseUpdate(Request $request, $id){
        $this->validate($request, [
            'item_variation.*' => 'required',
            'quantity_pcs.*' => 'required',
            'date.*' => 'required',
        ],
        [
            'item_variation.*.required' => 'Disburse Material is required',
            'quantity_pcs.*.required' => 'Quantity is required',
            'date.*.required' => 'Disburse Date is required',
        ]);
        try{
            DB::beginTransaction();
            ManufacturePhaseDisburse::where('manufacture_phase_id', $id)->delete();
            foreach ($request->item_variation as $key => $value) {
                $disburses = ManufacturePhaseDisburse::create([
                    'date' => date('Y-m-d', strtotime($request->date[$key])),
                    'manufacture_phase_id' => $id,
                    'item_id' => ItemVariation::where('id', $value)->first()->item->id,
                    'variation_id' => $value,
                    'quantity' => $request->quantity_pcs[$key],
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ]);
            }
            DB::commit();
            return redirect()
            ->route('phase_disburse_show', ['id' => $disburses->manufacturePhase->id])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Disbursed Material Updated Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function disburseDestroy($id)
    {
        try{
            DB::beginTransaction();
            $disburse = ManufacturePhaseDisburse::findorfail($id);
            $phase_id = $disburse->manufacturePhase->id;
            $disburse->delete();
            DB::commit();
            return redirect()
            ->route('phase_disburse_show', ['id' => $phase_id])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Disbursed Material Deleted Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function disburseShow($id)
    {
        try{
            $manufacture_phase = ManufacturePhase::find($id);
            return view('producttrack::phase.disburse.show', compact('id', 'manufacture_phase'));
        }catch(\Exception $e){
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function receiveCreate($id)
    {
        $manufacture_id = ManufacturePhase::find($id)->manufacture_id;
        $items = Item::with('itemVariations')->get();
        $raw_materials = ItemVariation::all();
        return view('producttrack::phase.receive.create', compact('items','raw_materials', 'id', 'manufacture_id'));
    }    

    public function receiveStore(Request $request)
    {
        $this->validate($request, [
            'item_variation.*'  => 'required',
            'quantity_pcs.*'    => 'required',
            'date.*'            => 'required',
        ],
        [
            'item_variation.*.required' => 'Receive Material is required',
            'quantity_pcs.*.required'   => 'Quantity is required',
            'date.*.required'           => 'Disburse Date is required',
        ]);
        try{
            DB::beginTransaction();
            foreach ($request->item_variation as $key => $value) {
                $receives = ManufacturePhaseReceiveFromFactory::create([
                    'date'                  => date('Y-m-d', strtotime($request->date[$key])),
                    'manufacture_phase_id'  => $request->manufacture_phase_id,
                    'item_id'               => ItemVariation::where('id', $value)->first()->item->id,
                    'variation_id'          => $value,
                    'quantity'              => $request->quantity_pcs[$key],
                    'created_by'            => Auth::user()->id,
                    'updated_by'            => Auth::user()->id,
                ]);
            }
            DB::commit();
            return redirect()
            ->route('phase_receive_show', ['id' => $receives->manufacturePhase->id])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Receive From Factory Material Added Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function receiveEdit($id)
    {
        try{
            $items = Item::with('itemVariations')->get();
            $raw_materials = ItemVariation::all();
            $manufacture_phase = ManufacturePhase::find($id);
            return view('producttrack::phase.receive.edit', compact('manufacture_phase', 'items', 'raw_materials'));
        }catch(\Exception $e){
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function receiveUpdate(Request $request, $id){
        $this->validate($request, [
            'item_variation.*' => 'required',
            'quantity_pcs.*' => 'required',
            'date.*' => 'required',
        ],
        [
            'item_variation.*.required' => 'Raw Material is required',
            'quantity_pcs.*.required' => 'Quantity is required',
            'date.*.required' => 'Disburse Date is required',
        ]);
        try{
            DB::beginTransaction();
            ManufacturePhaseReceiveFromFactory::where('manufacture_phase_id', $id)->delete();
            foreach ($request->item_variation as $key => $value) {
                $receives = ManufacturePhaseReceiveFromFactory::create([
                    'date' => date('Y-m-d', strtotime($request->date[$key])),
                    'manufacture_phase_id' => $id,
                    'item_id' => ItemVariation::where('id', $value)->first()->item->id,
                    'variation_id' => $value,
                    'quantity' => $request->quantity_pcs[$key],
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ]);
            }
            DB::commit();
            return redirect()
            ->route('phase_receive_show', ['id' => $receives->manufacturePhase->id])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Receive From Factory Material Updated Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function receiveDestroy($id)
    {
        try{
            DB::beginTransaction();
            $receive = ManufacturePhaseReceiveFromFactory::findorfail($id);
            $phase_id = $receive->manufacturePhase->id;
            $receive->delete();
            DB::commit();
            return redirect()
            ->route('phase_receive_show', ['id' => $phase_id])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Receive From Factory Material Deleted Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function receiveShow($id)
    {
        try{
            $manufacture_phase = ManufacturePhase::find($id);
            return view('producttrack::phase.receive.show', compact('id', 'manufacture_phase'));
        }catch(\Exception $e){
            return redirect()
            ->back()
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        return view('producttrack::phase.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
