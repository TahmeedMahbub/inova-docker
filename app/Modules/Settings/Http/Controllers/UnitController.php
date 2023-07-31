<?php

namespace App\Modules\Settings\Http\Controllers;

use File;
use Hash;
use App\User;
use Exception;
use Carbon\Carbon;
use App\Http\Requests;
use GuzzleHttp\Client;
use App\Models\Setting\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Doctrine\Inflector\Rules\English\Uninflected;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::get();
        return view('settings::unit.index', compact('units'));
    }
    public function create()
    {
        return view('settings::unit.create');
    }
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name'                   => 'required',
            'basic_unit_conversion'    => 'required '

        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        try {
            DB::beginTransaction();
            $unit = new Unit();
            $unit->name        = $request->name;

            $unit->basic_unit_conversion = $request->basic_unit_conversion;
            $unit->note                 = $request->note;
            $unit->created_by         = Auth::user()->id;
            $unit->updated_by         = Auth::user()->id;
            $unit->created_at         = Carbon::now();
            $unit->updated_at         =  Carbon::now();

            $unit->save();

            DB::commit();

            return redirect()
                ->route('settings_unit_index')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Unit Added Successfully!');
        } catch (Exception $e) {
            dd($e);
            return redirect()
                ->route('settings_unit_create')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('settings::unit.edit', compact('unit'));
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $unit = Unit::findOrFail($id);

            $unit->name        = $request->name;
            $unit->basic_unit_conversion = $request->basic_unit_conversion;
            $unit->note                 = $request->note;
            $unit->created_by         = Auth::user()->id;
            $unit->updated_by         = Auth::user()->id;
            $unit->created_at         = Carbon::now();
            $unit->updated_at         =  Carbon::now();

            $unit->update();

            DB::commit();

            return redirect()
                ->route('settings_unit_index')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Unit Updated Successfully!');
        } catch (Exception $e) {
            dd($e);
            return redirect()
                ->route('settings_unit_edit')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }
    public function delete($id)
    {
        $unit = Unit::findOrFail($id)->delete();
        return redirect()
            ->route('settings_unit_index')
            ->with('alert.status', 'success')
            ->with('alert.message', 'Unit Deleted Successfully!');
    }
    // get unit data
    public function getData($id)
    {
        $unit = Unit::where('id', $id)->first();
        return response()->json(['unit' => $unit]);
    }
}
