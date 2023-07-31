<?php

namespace App\Modules\Attributes\Http\Controllers;

use Attribute;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Inventory\Item;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Attributes\Attributes;
use App\Models\Inventory\ItemVariation;
use App\Models\Attributes\AttributeValues;
use App\Models\Inventory\ItemVariationAttributeValues;

class AttributesWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attributes::get();
        return view('attributes::index', compact('attributes'));
    }

    public function create()
    {
        return view('attributes::create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'attribute_name'            => 'required|unique:attributes,name',
            'attributes_value.*'        => 'required'
        ]);

        try {
            DB::beginTransaction();
            $attribute = new Attributes;
            $attribute->name = $request->attribute_name;
            $attribute->created_by = Auth::user()->id;
            $attribute->updated_by = Auth::user()->id;
            if ($attribute->save()) {
                foreach ($request->attributes_value as $key => $value) {
                    AttributeValues::create([
                        'attribute_id'  => $attribute->id,
                        'value'         => $value,
                        'created_by'    => Auth::user()->id,
                        'updated_by'    => Auth::user()->id,
                    ]);
                }
                DB::commit();
                return redirect()
                    ->route('attributes')
                    ->with('alert.status', 'success')
                    ->with('success', 'Attribute Created Successfully');
            } else {
                DB::rollback();
                return redirect()
                    ->route('attributes.create')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Attribute Creation Failed');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $attribute = Attributes::findorfail($id);
        $attribute_values = AttributeValues::where('attribute_id', $id)->get();
        return view('attributes::edit', compact('attribute', 'attribute_values'));
    }

    public function update(Request $request, $id)
    {
        $attribute = Attributes::find($id);
        if (strtolower($attribute->name) != strtolower($request->attribute_name)) {
            $this->validate($request, [
                'attribute_name'      => 'required|unique:attributes,name',
                'attributes_value.*'  => 'required'
            ]);
        } else {
            $this->validate($request, [
                'attribute_name'        => 'required',
                'attributes_value.*'    => 'required'
            ]);
        }
        try {
            DB::beginTransaction();

            $attribute->name = $request->attribute_name;
            $attribute->updated_by = Auth::user()->id;

            if ($attribute->update()) {

                $attribute->attributeValues()->delete();

                foreach ($request->attributes_value as $key => $value) {
                    AttributeValues::create([
                        'attribute_id'  => $attribute->id,
                        'value'         => $value,
                        'created_by'    => Auth::user()->id,
                        'updated_by'    => Auth::user()->id,
                    ]);
                }
                DB::commit();
                return redirect()
                    ->route('attributes')
                    ->with('alert.status', 'success')
                    ->with('success', 'Attribute Updated Successfully');
            } else {
                DB::rollback();
                return redirect()
                    ->route('attributes.edit', $id)
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Attribute Update Failed');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $attribute = Attributes::findorfail($id);
            if ($attribute->attributeValues()->delete() && $attribute->delete()) {
                DB::commit();
                return redirect()
                    ->route('attributes')
                    ->with('alert.status', 'success')
                    ->with('success', 'Attribute Deleted Successfully');
            } else {
                DB::rollback();
                return redirect()
                    ->back()
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Attribute Deletion Failed');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('error', $th->getMessage());
        }
    }

    public function attributeList(Request $request)
    {
        $data = Attributes::select('id', 'name', 'status')
            ->orderBy('id', 'desc')
            ->get();

        return response($data);
    }

    public function attributeValueList($id)
    {
        $data = AttributeValues::where('attribute_id', $id)
            ->orderBy('value', 'asc')
            ->get();

        return response($data);
    }

    public function attributeWithValueList()
    {
        $data = Attributes::select('id', 'name', 'status')
            ->with('attributeValues')
            ->orderBy('id', 'desc')
            ->get();

        return response($data);
    }

    public function attributeStore(Request $request)
    {
        $this->validate($request, [
            'attribute_name'      => 'required|unique:attributes,name',
            'attribute_values.*'  => 'required'
        ]);
        try {
            DB::beginTransaction();
            $attribute = new Attributes;
            $attribute->name = $request->attribute_name;
            $attribute->created_by = Auth::user()->id;
            $attribute->updated_by = Auth::user()->id;
            if ($attribute->save()) {
                foreach ($request->attribute_values as $key => $value) {
                    AttributeValues::create([
                        'attribute_id'  => $attribute->id,
                        'value'         => $value,
                        'created_by'    => Auth::user()->id,
                        'updated_by'    => Auth::user()->id,
                    ]);
                }
                DB::commit();
                return response()->json([
                    'success' => 'Attribute Created Successfully', 'id'   =>  $attribute->id,
                    'name'  =>  $attribute->name
                ]);
            } else {
                DB::rollback();
                return response()->json(['error' => 'Attribute Creation Failed']);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage(), 'message' => $th->getMessage()]);
        }
    }

    public function updateAttributeStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $attribute = Attributes::findorfail($request->attribute_id);
            $attribute->status = $request->status;
            if ($attribute->save()) {
                DB::commit();
                return response()->json(['success' => 'Attribute Status Updated Successfully']);
            } else {
                DB::rollback();
                return response()->json(['error' => 'Attribute Status Update Failed']);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function dynamicAttributeValueCheckStore($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            if (in_array("", $data['attribute_value_id'])) {
                $empty_row = array_filter($data['attribute_value_id'], function ($a) {
                    return $a == '';
                });
                foreach ($empty_row as $key => $value) {
                    if (!empty($data['new_attr_val'][$key])) {
                        $check_attribute_value = AttributeValues::where('value', $data['new_attr_val'][$key])->first();
                        if ($check_attribute_value != null) {
                            $data['attribute_value_id'][$key] = $check_attribute_value->id;
                        } else {
                            $attribute_values = new AttributeValues;
                            $attribute_values->attribute_id = $data['attribute_id'][$key];
                            $attribute_values->value = $data['new_attr_val'][$key];
                            $attribute_values->created_by = Auth::user()->id;
                            $attribute_values->updated_by = Auth::user()->id;
                            if ($attribute_values->save()) {
                                $data['attribute_value_id'][$key] = "" . $attribute_values->id;
                            } else {
                                DB::rollback();
                                return response()->json(['error' => 'Attribute Value Creation Failed']);
                            }
                        }
                    } else {
                        unset($data['new_attr_val'][$key]);
                        unset($data['attribute_value_id'][$key]);
                        unset($data['attribute_id'][$key]);
                    }
                }
            }

            // $item_variations = ItemVariation::join('item_variation_attribute_values', 'item_variation_attribute_values.item_variation_id', 'item_variations.id')
            //     ->where(function ($query) use ($data) {
            //         foreach ($data['attribute_value_id'] as $key => $value) {
            //             if ($key === 0) {
            //                 $query = $query->where('item_variation_attribute_values.attribute_values_id', $value);
            //             } else {
            //                 $query = $query->orWhere('item_variation_attribute_values.attribute_values_id', $value);
            //             }
            //         }

            //         return $query;
            //     })
            //     ->where('item_variations.item_id', $id)
            //     ->select('item_variations.*')
            //     ->with('itemVariationAttributeValues')
            //     ->get();

            $item_variations = ItemVariation::where('item_variations.item_id', $id)
                ->with('itemVariationAttributeValues')
                ->get();

            $matched_variations = [];
            foreach ($item_variations as $item_variation) {
                $item_variation->itemVariationAttributeValues_matched = $item_variation->itemVariationAttributeValues->whereIn('attribute_values_id', $data['attribute_value_id']);
                if ($item_variation->itemVariationAttributeValues->count() === count($data['attribute_value_id']) && count($data['attribute_value_id']) === $item_variation->itemVariationAttributeValues_matched->count()){
                    $matched_variations[] = $item_variation;
                }
            }

            if(count($matched_variations) == 0){
                $name = '';
                foreach($data['new_attr_val'] as $value){
                    $name = $name . $value . ' ';
                }
                $item_variation_create = new ItemVariation;
                $item_variation_create->variation_name = $name . Item::find($id)->item_name;
                $item_variation_create->item_id = $id;
                $item_variation_create->created_by = Auth::user()->id;
                $item_variation_create->updated_by = Auth::user()->id;
                if($item_variation_create->save()){
                    $item_variation_create->sku = str_pad($id, 6, 0, STR_PAD_LEFT) . '' . str_pad($item_variation_create->id, 6, 0, STR_PAD_LEFT);
                    foreach($data['attribute_value_id'] as $item_variation_values_id){
                        ItemVariationAttributeValues::create([
                            'item_variation_id'     => $item_variation_create->id,
                            'attribute_values_id'   => $item_variation_values_id,
                            'created_by'            => Auth::user()->id,
                            'updated_by'            => Auth::user()->id,
                            'created_at'            => Carbon::now()->toDateTimeString(),
                            'updated_at'            => Carbon::now()->toDateTimeString(),
                        ]);
                    }
                }
                $item_variation_create->save();
                $matched_variations[] = $item_variation_create;
            }
            DB::commit();
            return $matched_variations[0];
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
