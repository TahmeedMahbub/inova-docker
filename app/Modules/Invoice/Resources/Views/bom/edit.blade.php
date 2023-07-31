@extends('layouts.main')

@section('title', 'Bill Of Materials')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style media="screen">
        
        table, td, th {
        border: 1px solid;
        border-color: gray;
        padding-left: 10px;
        padding-right: 10px;
    }

    td:last-child{
        border-width: 0 1px 0 1px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        }

        span.select2-container{
            z-index: 30 !important;
        }
        .uk-badge a{
            color:white
        }
        input{
            margin-top:10px;
        }
        .getMultipleRow input,discount_type{
            margin-top:-10px;
        }
        .discount_type{
            margin-top:-10px;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('bomUpdate', $id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Bill of Material</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="md-card">
                                        <div class="user_heading">
                                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            </div>
                                            <div class="user_heading_content"style="padding-bottom: 6px; padding-top: 6px;">
                                                <h2 class="heading_b"><span class="uk-text-truncate">General Info</span></h2>
                                            </div>
                                        </div>
                                        <div class="user_content">
                                            <div class="uk-margin-top">
                                                <div class="uk-grid" data-uk-grid-margin style="margin-left: -20px; margin-right: 15px; padding-top: 20px; padding-bottom: 20px;">
                                                    <div class="uk-width-medium-1-3">
                                                    <label for="invoice_id">Invoice</label> <br>
                                                        <select class="md-input select2-single-search-dropdown" title="Select Invoice" id="invoice_id" name="invoice_id">
                                                            <option value="">Select Invoice</option>
                                                            @foreach($invoices as $invoice)
                                                                <option value="{{ $invoice->id }}" {{ $bill_of_material->invoice_id == $invoice->id ? "selected" : "" }}>INV-{{ $invoice->invoice_number }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('invoice_id'))
                                                            <span class="error" style="color: red">
                                                                {{ $errors->first('invoice_id') }}
                                                            </span>                                                
                                                        @endif
                                                    </div>
            
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="invoice_date">Project Name<span style="color: red"> *</span></label>
                                                        <input class="md-input" type="text" id="project_name" name="project_name" value="{{$bill_of_material->project_name}}">
                                                    </div>
            
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="invoice_date">Date<span style="color: red"> *</span></label>
                                                        <input class="md-input" type="text" id="date" name="date" value="{{ $bill_of_material->date }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                                    </div>                                            

                                                </div>
                                                <h3 class="full_width_in_card heading_c">
                                                    Item Details
                                                </h3>
                                                <div class="uk-grid" data-uk-grid-margin style="margin-left: -20px; margin-right: 15px; padding-top: 20px; padding-bottom: 20px;">
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="product_id">Product</label><br>
                                                        <select class="md-input select2-single-search-dropdown" title="Select Product" id="product_id" name="product_id">
                                                            <option value="">Select Product</option>
                                                            @foreach($items as $item)
                                                                <option value="{{$item->id}}" {{ $bill_of_material->item_id == $item->id ? "selected" : "" }}>{{$item->item_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('product_id'))
                                                            <span class="error" style="color: red">
                                                                {{ $errors->first('product_id') }}
                                                            </span>                                                
                                                        @endif
                                                    </div>
            
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="invoice_date">Quantity</label>
                                                        <input class="md-input" type="number" id="quantity" name="quantity" value="{{$bill_of_material->quantity}}">
                                                    </div>
            
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="invoice_date">Model Name</label>
                                                        <input class="md-input" type="text" id="model_name" name="model_name" value="{{$bill_of_material->item->barcode_no}}">
                                                    </div>
                                                </div>
                                                <h3 class="full_width_in_card heading_c">
                                                    Product Size
                                                </h3>
                                                <div class="uk-grid" data-uk-grid-margin id="product_size_container" style="margin-left: -20px; margin-right: 15px; padding-top: 20px; padding-bottom: 20px;">
                                                
                                                    @if ($bill_of_material->product_size)
                                                        @foreach(json_decode($bill_of_material->product_size) as $key => $value)
                                                            <div class="uk-width-medium-1-3">
                                                                <div class="md-input-wrapper">
                                                                    <label for="invoice_date">{{$attributes->where('id', $key)->first()['name']}} Value</label>
                                                                    <input type="hidden" name="dimension_attribute[]" value="{{$key}}">
                                                                    <input class="md-input" type="number" id="height_quantity" name="dimension[]" value="{{$value}}">
                                                                    <span class="md-input-bar "></span>
                                                                </div>
                                                            </div>
                                                        @endforeach                                                        
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- <div class="md-card">
                                        <div class="user_heading">
                                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            </div>
                                            <div class="user_heading_content"style="padding-bottom: 6px; padding-top: 6px;">
                                                <h2 class="heading_b"><span class="uk-text-truncate">Item Details</span></h2>
                                            </div>
                                        </div>
                                        <div class="uk-grid" data-uk-grid-margin style="margin-left: -20px; margin-right: 15px; padding-top: 20px; padding-bottom: 20px;">
                                            <div class="uk-width-medium-1-3">
                                                <label for="product_id">Product</label><br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Product" id="product_id" name="product_id">
                                                    <option value="">Select Product</option>
                                                    @foreach($items as $item)
                                                        <option value="{{$item->id}}">{{$item->item_name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('product_id'))
                                                    <span class="error" style="color: red">
                                                        {{ $errors->first('product_id') }}
                                                    </span>                                                
                                                @endif
                                            </div>
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Quantity</label>
                                                <input class="md-input" type="number" id="quantity" name="quantity">
                                            </div>
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Model Name</label>
                                                <input class="md-input" type="text" id="model_name" name="model_name">
                                            </div>
                                        </div>
                                    </div> --}}


                                    {{-- <div class="md-card">
                                        <div class="user_heading">
                                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            </div>
                                            <div class="user_heading_content"style="padding-bottom: 6px; padding-top: 6px;">
                                                <h2 class="heading_b"><span class="uk-text-truncate">Product Size</span></h2>
                                            </div>
                                        </div>
                                        <div class="uk-grid" data-uk-grid-margin style="margin-left: -20px; margin-right: 15px; padding-top: 20px; padding-bottom: 20px;">
                                            <div class="uk-width-medium-1-2">
                                              <label for="height_attribute_id">Attribute</label> <br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Attribute" id="height_attribute_id" name="height_attribute_id">
                                                    <option value="">Height</option>
                                                </select>
                                                <strong>Height</strong>
                                            </div>
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Height Value</label>
                                                <input class="md-input" type="number" id="height_quantity" name="dimension[]">
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                              <label for="width_attribute_id">Attribute</label> <br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Attribute" id="width_attribute_id" name="width_attribute_id">
                                                    <option value="">Width</option>
                                                </select>
                                                <strong>Width</strong>
                                            </div>
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Width Value</label>
                                                <input class="md-input" type="number" id="width_quantity" name="dimension[]">
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                              <label for="length_attribute_id">Attribute</label> <br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Attribute" id="length_attribute_id" name="length_attribute_id">
                                                    <option value="">Length</option>
                                                </select>
                                                <strong>Length</strong>
                                            </div>
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Length Value</label>
                                                <input class="md-input" type="number" id="length_quantity" name="dimension[]">
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <table>
                                        <tr>
                                            <th rowspan="2" style="width: 2%" class="uk-text-center">SL</th>
                                            <th rowspan="2" style="width: 20%" class="uk-text-center">Items</th>
                                            <th colspan="3" style="width: 15%" class="uk-text-center">Specification / Size</th>
                                            <th rowspan="2" style="width: 10%" class="uk-text-center">Quantity</th>
                                            <th rowspan="2" style="width: 5%" class="uk-text-center">Wastage</th>
                                            <th rowspan="2" style="width: 2%" class="uk-text-center">Unit</th>
                                            <th rowspan="2" style="width: 10%" class="uk-text-center">Price</th>
                                            <th rowspan="2" style="width: 10%" class="uk-text-center">Total</th>
                                            <th rowspan="2" style="width: 5%" class="uk-text-center">Action</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 5%" class="uk-text-center">T</th>
                                            <th style="width: 5%" class="uk-text-center">L</th>
                                            <th style="width: 5%" class="uk-text-center">W</th>
                                        </tr>
                                        <tr class="mehogony_1">
                                            <td class="uk-text-center">1</td>
                                            <td>
                                                <select class="md-input select2-single-search-dropdown" name="mehogony_item" id="mehogony_item">
                                                    <option value="">Select Item</option>
                                                    <option value="">Leg Size</option>
                                                    <option value="">Glass Fitting SS Disk</option>
                                                    <option value="">Glass Fitting Glue</option>
                                                </select>
                                            </td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td><input class="md-input" type="number" name="mehogony_qty" id="mehogony_qty"></td>
                                            <td><input class="md-input" type="number" name="mehogony_wastage" id="mehogony_wastage"></td>
                                            <td class="uk-text-center">
                                                <select name="mehogony_unit" id="mehogony_unit">
                                                    <option value="">Pcs</option>
                                                    <option value="">CFT</option>
                                                    <option value="">LS</option>
                                                </select>
                                            </td>
                                            <td><input class="md-input" type="number" name="mehogony_price" id="mehogony_price" value="0"></td>
                                            <td>1000</td>
                                            <td class="uk-text-center">
                                                <a href="#" class="add_field_button"><i class="material-icons md-36"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="mehogony_1_total">
                                            <td colspan="9">Total: </td>
                                            <td colspan="1">1000</td>
                                            <td></td>
                                        </tr>
                                    </table> --}}


                                    <div class="md-card">
                                        <div class="user_heading">
                                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            </div>
                                            <div class="user_heading_content"style="padding-bottom: 6px; padding-top: 6px;">
                                                <h2 class="heading_b"><span class="uk-text-truncate">Material Details</span></h2>
                                            </div>
                                        </div>
                                        <div class="uk-grid" data-uk-grid-margin style="margin-left: -20px; margin-right: 15px; padding-top: 20px; padding-bottom: 20px;">
                                            <div class="uk-width-medium-1-3">
                                                <label for="material_id">Subcategory</label> <br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Subcategory" id="material_id" name="material_id[]" multiple>
                                                    <option id="material_0_0" value="">Select Subcategory</option>
                                                    @foreach($subcategories as $subcategory)
                                                        <option value="material_0_{{ $subcategory->id }}"
                                                            @foreach($bill_of_material_entries->groupBy('sub_category_id') as $key => $value)
                                                                {{$subcategory->id == $key ? "selected" : ""}}
                                                            @endforeach >

                                                            {{ $subcategory->item_sub_category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('material_id'))
                                                    <span class="error" style="color: red">
                                                        {{ $errors->first('material_id') }}
                                                    </span>                                                
                                                @endif
                                            </div>                                            
                                        </div>

                                        <div class="uk-grid" style="margin-left: 10px; margin-right: 15px; padding-bottom: 20px;" id="cost_details">
                                            @php $section = -1; @endphp

                                            @foreach($bill_of_material_entries->groupBy('sub_category_id') as $key => $bill_of_material_entry)
                                                @php $section++;  @endphp

                                                <div class="md-card subcategory-section" style="padding-left: 0px; left: 5px; width: 100%" data-sub-cat-section="{{$section}}" data-sub-id="{{$key}}">
                                                    <input type="hidden" name="sub_category_id[{{$section}}]" value="{{$key}}">
                                                    <div class="user_heading" style="padding-bottom: 5px; padding-top: 5px; padding-left: 10px;">
                                                        <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                        </div>
                                                        <div class="user_heading_content"style="padding-bottom: 0px; padding-top: 0px;">
                                                            <h2 class="heading_b"><span class="uk-text-truncate">{{$bill_of_material_entry[0]->subcategory->item_sub_category_name}}</span></h2>
                                                        </div>
                                                    </div>
                                                    {{-- @php $colspan_no = count($item_attributes->where('item_id', $bill_of_material_entry[0]["item_id"])) @endphp --}}
                                                    
                                    
                                                    @php
                                                        $subcategory_id = $bill_of_material_entry[0]->subcategory->id;
                                                        $subcategory = App\Models\Inventory\ItemSubCategory::find($subcategory_id);
                                                        $items = App\Models\Inventory\Item::where('item_sub_category_id', $subcategory_id)->with('ItemAttributeValues')->get();
                                                        $measurable_attributes = App\Models\Attributes\Attributes::whereHas('AttributeValues', function($query) use($items){
                                                                                    return $query->whereHas('ItemAttributeValues', function($qr) use($items){
                                                                                        return $qr->whereIn('item_id', $items->pluck('id')->toArray())->where('item_attribute_values.measurable', 1);
                                                                                    });
                                                                                })
                                                                                ->with('attributeValues')
                                                                                ->get();
                                                                                // dd($measurable_attributes);
                                                    @endphp
                                                    
                                                    <table data-item-sub-id="{{$key}}" class="table subcategory_table">
                                                        <tr>
                                                            <th rowspan="2" style="width: 2%" class="uk-text-center">SL</th>
                                                            <th rowspan="2" style="width: 20%" class="uk-text-center">Items</th>
                                                            @if(count($measurable_attributes) > 0)
                                                                <th colspan="{{count($measurable_attributes)}}" style="width: 15%" class="uk-text-center">Specification / Size</th>
                                                            @endif
                                                            <th rowspan="2" style="width: 10%" class="uk-text-center">Quantity</th>
                                                            <th rowspan="2" style="width: 10%" class="uk-text-center">Wastage (%)</th>
                                                            <th rowspan="2" style="width: 2%" class="uk-text-center">Unit</th>
                                                            <th rowspan="2" style="width: 10%" class="uk-text-center">Price</th>
                                                            <th rowspan="2" style="width: 10%" class="uk-text-center">Total</th>
                                                            <th rowspan="2" style="width: 5%" class="uk-text-center">Action</th>
                                                        </tr>
                                                        <tr>
                                                            {{-- @php $attr_ids = []; @endphp
                                                            @foreach($item_attributes->where('item_id', $bill_of_material_entry[0]["item_id"]) as $attribute)
                                                                <th>{{$attribute->attributeValues->attribute->name}}</th>    
                                                                @php $attr_ids[] = $attribute->attributeValues->attribute->id; @endphp
                                                            @endforeach --}}
                                                            

                                                            @foreach ($measurable_attributes as $measurable_attribute)
                                                                <th>{{ $measurable_attribute->name }}</th>
                                                            @endforeach
                                                        </tr>

                                                        @foreach ($bill_of_material_entry as $entry)

                                                            @php $attribute_multiplier = 1; $row_no = $loop->index; @endphp

                                                            <tr id="tr_{{$section}}_{{$loop->index}}" class="tdata_{{$section}} data_rows">
                                                                
                                                                <td class="uk-text-center">{{$loop->iteration}}</td>

                                                                <td style="padding-top: 20px">
                                                                    <select class="md-input select2-single-search-dropdown" name="item[{{$section}}][]" id="item_{{$section}}_{{$loop->index}}" onchange="ItemSelected(this)">
                                                                        @foreach ($products->where('item_sub_category_id', $key) as $product)
                                                                            <option value="{{$product->id}}" {{$entry->item_id == $product->id ? "selected" : ""}}>
                                                                                {{$product->item_name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>     

                                                                @php $attr_row_flag = 0; @endphp
                                                                @foreach ($measurable_attributes as $measurable_attribute)
                                                                    @php $attr_flag = 0; @endphp
                                                                    @foreach ($entry->item->ItemAttributeValues->where('measurable', 1) as $key_attr => $attributes)
                                                                        {{-- <td class="item_measurable_attr_{{$section}}_{{$row_no}} calculate_attr" id="item_measurable_attr_{{$section}}_{{$row_no}}_{{$attributes->attributeValues->attribute->id}}" data-attr-name="{{$attributes->attributeValues->attribute->name}}">{{$attributes->attributeValues->value}}</td>  --}}
                                                                        @if ($attributes->attributeValues->attribute->id == $measurable_attribute->id)
                                                                            <td class="item_measurable_attr_{{$section}}_{{$row_no}} calculate_attr" id="item_measurable_attr_{{$section}}_{{$row_no}}_{{$measurable_attribute->id}}" data-attr-name="{{!empty($measurable_attribute->attributeValues->where('attribute_id', $measurable_attribute->id)->first()) ? $attributes->attributeValues->attribute->name : ''}}">{{ !empty($measurable_attribute->attributeValues->where('attribute_id', $measurable_attribute->id)->first()) ? $attributes->attributeValues->value : 0 }}</td>
                                                                            @php
                                                                                $attribute_multiplier *= $attributes->attributeValues->value;
                                                                                $attr_flag = 1;
                                                                                $attr_row_flag++;
                                                                            @endphp
                                                                        @endif
                                                                        @if ($loop->last && $attr_flag == 0)
                                                                            <td class="item_measurable_attr_{{$section}}_{{$row_no}} calculate_attr" id="item_measurable_attr_{{$section}}_{{$row_no}}_{{$measurable_attribute->id}}">0</td>
                                                                            @php $attr_row_flag++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                    @if($attr_row_flag == 0)
                                                                        <td class="item_measurable_attr_{{$section}}_{{$row_no}} calculate_attr" id="item_measurable_attr_{{$section}}_{{$row_no}}_{{$measurable_attribute->id}}">0</td>
                                                                    @endif
                                                                @endforeach
                                                                @php
                                                                    $attribute_multiplier = $attribute_multiplier * $entry->quantity;
                                                                    empty($entry->item->Unit->basic_unit_conversion) ? $attribute_multiplier_by_unit = $attribute_multiplier :  $attribute_multiplier_by_unit = $attribute_multiplier/$entry->item->Unit->basic_unit_conversion ;
                                                                    // dd($attribute_multiplier_by_unit);
                                                                @endphp
                                                                {{-- @for($i = 0; $i < $colspan_no; $i++)
                                                                    <td>{{$entry->item->ItemAttributeValues->where('measurable', 1)}}</td>        
                                                                @endfor --}}
                                                                <td><input class="md-input {{$section}}_qty calculate_amount calculate_amount_qty" type="number" name="qty[{{$section}}][]" value="{{$entry->quantity}}" id="qty_{{$section}}_{{$loop->index}}"></td>
                                                                <td><input class="md-input calculate_amount calculate_wastage" type="number" name="wastage[{{$section}}][]" value="{{$entry->wastage_percent}}" id="wastage_{{$section}}_{{$loop->index}}"></td>
                                                                <td class="uk-text-center" style="padding-top: 20px">
                                                                    {{-- {{$entry->item->Unit}} --}}
                                                                    <select class="select2-single-search-dropdown calculate_unit" name="unit[{{$section}}][]" id="unit_{{$section}}_{{$loop->index}}">
                                                                        
                                                                        <option value="{{$entry->item->unit_id}}" data-unit-conversion="{{!empty($entry->item->Unit) ? $entry->item->Unit->basic_unit_conversion : 1 }}">{{!empty($entry->item->Unit) ? $entry->item->Unit->name : "pcs"}}</option>
                                                                        {{-- @foreach ($units as $unit)
                                                                        <option value="{{$unit->id}}" {{empty($entry->item->unit_id) ? ($unit->name == "pcs" ? "selected" : "") : ($unit->id == $entry->item->unit_id ? "selected" : "")}} data-unit-conversion="{{$unit->basic_unit_conversion}}" >{{$unit->name}}</option>
                                                                        @endforeach --}}
                                                                    </select>
                                                                </td>
                                                                <td><input class="md-input calculate_amount calculate_amount_price" type="number" name="price[{{$section}}][]" id="price_{{$section}}_{{$loop->index}}" value="{{$entry->unit_price}}"></td>
                                                                <td class="uk-text-right {{$section}}_price calculate_amount_total" id="price_show_{{$section}}_{{$loop->index}}">{{$attribute_multiplier_by_unit * $entry->unit_price}}</td>
                                                                <td class="uk-text-center">
                                                                    @if($loop->count == $loop->index+1)
                                                                        <a class="add_field_button" id="add_{{$section}}_{{$loop->index}}" data-add-sub-cat-id={{$key}}><i class="material-icons md-36"></i></a>
                                                                    @else
                                                                        <a class="delete_field_button" id="delete_field_button_{{$section}}_{{$loop->index}}" data-add-sub-cat-id={{$key}}><i class="material-icons md-36">delete</i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr class="total_{{$section}}">
                                                            <th class="uk-text-right" colspan="{{count($measurable_attributes) + 6}}">Total:</th>
                                                            <th class="uk-text-right grand_total" id="total_{{$section}}_show">0.00</th>
                                                            <th class="uk-text-center">
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            @endforeach                                    
                                        </div>


                                        <div class="uk-grid" data-uk-grid-margin style="margin-left: 10px; margin-right: 15px; padding-bottom: 20px;">
                                            <div class="uk-width-medium-2-3"></div>
                                            <div class="uk-width-medium-1-3">
                                                <div class="md-card" style="padding-left: 0px; left: 5px; width: 100%">
                                                    <div class="user_heading" style="padding-bottom: 5px; padding-top: 5px; padding-left: 10px;">
                                                        <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                        </div>
                                                        <div class="user_heading_content"style="padding-bottom: 0px; padding-top: 0px;">
                                                            <h2 class="heading_b"><span class="uk-text-truncate">Total</span></h2>
                                                        </div>
                                                    </div>
                                                    <table class="table">
                                                        <tr style="background-color:#e0e0e0">
                                                            <th colspan="2">Subtotal <input type='hidden' id='subtotal_inp' name='subtotal_inp' value='0.00'></th>
                                                            <th class="uk-text-right production_cost_show" id="subtotal_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 200px">COH (%)</th>
                                                            <th style="width: 160px"><input type="number" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="cho_percent" id="cho_inp" value="{{$bill_of_material->cho_percent}}" oninput="calculate_total()"></th>
                                                            <th style="width: 100px" class="uk-text-right production_cost_show" id="cho_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 200px">FOH (%)</th>
                                                            <th style="width: 160px"><input type="number" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="foh_percent" id="foh_inp" value="{{$bill_of_material->foh_percent}}" oninput="calculate_total()"></th>
                                                            <th style="width: 100px" class="uk-text-right production_cost_show" id="foh_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Profit (%)</th>
                                                            <th><input type="number" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="profit_percent" id="profit_inp"  value="{{$bill_of_material->profit_percent}}"oninput="calculate_total()"></th>
                                                            <th class="uk-text-right production_cost_show" id="profit_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Design (%)</th>
                                                            <th><input type="number" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="design_percent" id="design_inp" value="{{$bill_of_material->design_percent}}" oninput="calculate_total()"></th>
                                                            <th class="uk-text-right production_cost_show" id="design_show">0.00</th>
                                                        </tr>
                                                        <tr style="background-color:#e0e0e0">
                                                            <th colspan="2">Production Cost</th>
                                                            <th class="uk-text-right" id="production_cost_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th>MRP (%)</th>
                                                            <th><input type="number" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="mrp" id="mrp_inp" value="{{$bill_of_material->mrp_percent}}" oninput="calculate_total()"></th>
                                                            <th class="uk-text-right" id="mrp_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th>VAT (%)</th>
                                                            <th><input type="number" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="vat" id="vat_inp" value="{{$bill_of_material->vat_percent}}" oninput="calculate_total()"></th>
                                                            <th class="uk-text-right" id="vat_show">0.00</th>
                                                        </tr>
                                                        <tr style="background-color:#c7c7c7">
                                                            <th>Trade Price</th>
                                                            <th><input type="number" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="trade" id="trade_inp" value="{{$bill_of_material->trade_total}}" step="0.01"></th>
                                                            <th class="uk-text-right" id="trade_price_show">0.00</th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="uk-grid uk-text-right" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="button" class="uk-margin-small-top md-btn md-btn-flat uk-modal-close">Close</button>
                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="submit" name="submit" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        altair_forms.parsley_validation_config();
        $('#sidebar_bom').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        });

        var items = {!! $items !!};

        function ItemSelected(e){
            var section = $(e).attr('id').match(/(\d+)/g)[0];
            var row = $(e).attr('id').match(/(\d+)/g)[1];
            var item_id = $(e).val();
            $.each($(`.item_measurable_attr_${section}_${row}`), function (indexInArray, valueOfElement) { 
                $(valueOfElement).html('0');
            });
            $.ajax({
                type: "get",
                url: "{{ route('item_rate', ['id' => '']) }}/"+item_id,
                success: function (response) {
                    $('#unit_'+section+'_'+row).empty();
                    $('#unit_'+section+'_'+row).append(`<option value="${response.unit.id}" data-unit-conversion="${response.unit.basic_unit_conversion}">${response.unit.name}</option>`);
                    
                    $.each(response.item_attribute_values, function (indexInArray, valueOfElement) { 
                        $('#item_measurable_attr_'+section+'_'+row+'_'+valueOfElement.attribute_values.attribute.id).html(valueOfElement.attribute_values.value);
                    });

                    qty = $("#qty_"+section+'_'+row).val(0)
                    price = $("#price_"+section+'_'+row).val(0)
                    wastage = $("#wastage_"+section+'_'+row).val(0)
                    total = $("#price_show_"+section+'_'+row).html()
                    total_1 = $("#price_show_"+section+'_'+row).html(0)

                    var subtotal = parseFloat($("#subtotal_show").html());
                    subtotal_1 = $("#subtotal_show").html(subtotal - total)

                    var total_subcategory = parseFloat($("#total_"+section+"_show").html());
                    total_subcategory_1 = $("#total_"+section+"_show").html(total_subcategory - total)

                    calculate_total()
                }
            });
        }
    </script>

    <script type="text/javascript">

        function calculate_total(){
            var subtotal = parseFloat($("#subtotal_show").html());

            if($("#cho_inp").val() == "")
                { var cho = 0; }
            else
                { var cho = parseFloat($("#cho_inp").val()).toFixed(2);}
            $("#cho_show").html((subtotal * cho / 100).toFixed(2));


            if($("#foh_inp").val() == "")
                { var foh = 0; }
            else
                { var foh = parseFloat($("#foh_inp").val()).toFixed(2);}
            $("#foh_show").html((subtotal * foh / 100).toFixed(2));
            
            
            if($("#profit_inp").val() == "")
                { var profit = 0; }
            else
                { var profit = parseFloat($("#profit_inp").val()).toFixed(2);}
            $("#profit_show").html((subtotal * profit / 100).toFixed(2));
            
            if($("#design_inp").val() == "")
                { var design = 0; }
            else
                { var design = parseFloat($("#design_inp").val()).toFixed(2);}
            $("#design_show").html((subtotal * design / 100).toFixed(2));

            production_cost_total = parseFloat(subtotal) + parseFloat(subtotal * cho / 100) + parseFloat(subtotal * foh / 100) + parseFloat(subtotal * profit / 100) + parseFloat(subtotal * design / 100);
            $("#production_cost_show").html(production_cost_total.toFixed(2));

            
            if($("#mrp_inp").val() == "")
                { var mrp = 0; }
            else
                { var mrp = parseFloat($("#mrp_inp").val()).toFixed(2);}
            mrp = (production_cost_total * mrp / 100) + production_cost_total;
            $("#mrp_show").html(mrp.toFixed(2));

            
            if($("#vat_inp").val() == "")
                { var vat = 0; }
            else
                { var vat = parseFloat($("#vat_inp").val()).toFixed(2);}
                var vat_amount = (mrp * vat / 100).toFixed(2);
            $("#vat_show").html(vat_amount);
            
            $("#trade_inp").val((parseFloat(mrp) + parseFloat(vat_amount)).toFixed(2));
            
            if($("#trade_inp").val() == "")
                { var trade = 0; }
            else
                { var trade = parseFloat($("#trade_inp").val()).toFixed(2);}
            $("#trade_price_show").html(trade);
        }

        $(document).on('keyup', '.calculate_amount', function (e) {
            e.preventDefault();

            price = $(this).closest('tr').find('.calculate_amount_price:first').val()
            qty = $(this).closest('tr').find('.calculate_amount_qty:first').val()
            wastage = $(this).closest('tr').find('.calculate_wastage').val();
            wastage = 1 + (wastage / 100);
            unit_name = $(this).closest('tr').find('.calculate_unit option:selected').html();
            unit_converesion = $(this).closest('tr').find('.calculate_unit option:selected').attr('data-unit-conversion');
            unit_id = $(this).closest('tr').find('.calculate_unit option:selected').val();
            // console.log(unit);
            // attribute_values = $(this).closest('tr').find('.attribute_values').html()
            // console.log(attribute_values);
            

            var attr_mul = 1;
            // $(each_row).find('.calculate_attr'), function (indexInArray, valueOfElement) { 
            $.each($(this).closest('tr').find('.calculate_attr'), function (indexInCalculateAttr, CalculateAttr) {
                
                attr_id = CalculateAttr.id.match(/(\d+)/g)[2];
                var attr_val = $("#"+CalculateAttr.id).html() == 0 ? 1 : $("#"+CalculateAttr.id).html();
                if(unit_id == 3)
                {
                    var attr_name = $(CalculateAttr).attr('data-attr-name');
                    console.log(attr_name);
                    if(attr_name == "L" || attr_name == "W"){
                        attr_mul *= ($("#"+CalculateAttr.id).html() == 0) ? 1 : $("#"+CalculateAttr.id).html();
                    }
                    // var attributes = {!! $attributes !!};
                    // $.each(attributes, function (indexInCalculateAttr, attribute) { 
                    //     if(attribute.id == attr_id && (attribute.name == "L" || attribute.name == "W"))
                    //     {
                    //         attr_mul *= attr_val;
                    //     }                         
                    // });
                }
                else{
                    attr_mul *= attr_val;
                }
                
                // if(unit_name == "Sft")
                // {
                //     var attr_name = $(CalculateAttr).attr('data-attr-name');
                //     console.log(attr_name);
                //     if(attr_name == "L" || attr_name == "W"){
                //         attr_mul *= ($("#"+CalculateAttr.id).html() == 0) ? 1 : $("#"+CalculateAttr.id).html();
                //     }
                // }
                // else
                // {
                //     attr_mul *= ($("#"+CalculateAttr.id).html() == 0) ? 1 : $("#"+CalculateAttr.id).html();
                // }
            });

            if(attr_mul == 0)
            {
                total = price * qty * wastage
            }
            else{
                total = price * qty * wastage * attr_mul / unit_converesion
            }

            // console.log(price, qty)

            $(this).closest('tr').find('.calculate_amount_total:first').text(total.toFixed(2))

            all_total_tags = $(this).closest('table').find('.calculate_amount_total')
            grand_total = 0
            all_total_tags.each(function(index, total_tag){
                grand_total += parseFloat($(total_tag).text())
            })
            $(this).closest('table').find('.grand_total').text(grand_total)

            all_grand_totals = $(document).find('.grand_total')
            subtotal = 0
            all_grand_totals.each(function(index, grand_total_tag){
                subtotal += parseFloat($(grand_total_tag).text())
            })

            $('#subtotal_show').text(subtotal);
            $('#subtotal_inp').val(subtotal);

            calculate_total();


        })

        $(document).on('click', '.delete_field_button', function (e) {

            $(this).closest('tr').remove()

            tables = $(document).find(".subcategory_table")

            subtotal = 0

            tables.each(function(index, each_table){
                grand_total = 0
                rows = $(each_table).find("tr.data_rows")
                rows.each(function(index2, each_row){
                    qty = $(each_row).find('.calculate_amount_qty').val()
                    price = $(each_row).find('.calculate_amount_price').val()
                    wastage = $(each_row).find('.calculate_wastage').val();
                    wastage = 1 + (wastage / 100);
                    unit_name = $(each_row).find('.calculate_unit option:selected').html();
                    unit_converesion = $(each_row).find('.calculate_unit option:selected').attr('data-unit-conversion');
                    // console.log(unit);
                    // attribute_values = $(each_row).find('.attribute_values').html()
                    // console.log(attribute_values);
                    

                    var attr_mul = 1;
                    $.each($(each_row).find('.calculate_attr'), function (indexInCalculateAttr, CalculateAttr) {
                        if(unit_name == "Sft")
                        {
                            var attr_name = $(CalculateAttr).attr('data-attr-name');
                            if(attr_name == "L" || attr_name == "W"){
                                attr_mul *= ($("#"+CalculateAttr.id).html() == 0) ? 1 : $("#"+CalculateAttr.id).html();
                            }
                        }
                        else
                        {
                            attr_mul *= ($("#"+CalculateAttr.id).html() == 0) ? 1 : $("#"+CalculateAttr.id).html();
                        }
                    });

                    if(attr_mul == 0)
                    {
                        total = price * qty * wastage
                    }
                    else{
                        total = price * qty * wastage * attr_mul / unit_converesion
                    }

                    $(each_row).find('.calculate_amount_total:first').text(total.toFixed(2))

                    grand_total += total
                })
                $(each_table).find(".grand_total").text(grand_total)
                subtotal += grand_total
            })

            $('#subtotal_show').text(subtotal);
            $('#subtotal_inp').val(subtotal);

            calculate_total();
        })

        $(document).on('click', '.select2-selection__choice', function (e) {
            tables = $(document).find(".subcategory_table")

            subtotal = 0

            tables.each(function(index, each_table){
                grand_total = 0
                rows = $(each_table).find("tr.data_rows")
                rows.each(function(index2, each_row){
                    qty = $(each_row).find('.calculate_amount_qty').val()
                    price = $(each_row).find('.calculate_amount_price').val()
                    wastage = $(each_row).find('.calculate_wastage').val()                       

                    $(each_row).find('.calculate_attr'), function (indexInArray, valueOfElement) { 
                        attr_id = valueOfElement.id.match(/(\d+)/g)[2];
                        var attr_val = $("#"+valueOfElement.id).html() == 0 ? 1 : $("#"+valueOfElement.id).html();
                        if(unit_id == 3)
                        {
                            var attributes = {!! $attributes !!};
                            $.each(attributes, function (indexInArray, attribute) { 
                                if(attribute.id == attr_id && (attribute.name == "L" || attribute.name == "W"))
                                {
                                    attr *= attr_val;
                                }                         
                            });
                        }
                        else{
                            attr *= attr_val;
                        }
                    };


                    total_material = (price * attr / base_unit);

                    total_with_wastage = (total_material * wastage / 100)+ total_material;

                    total_material_cost = qty * total_with_wastage;

                    $(each_row).find('.calculate_amount_total:first').text(total_material_cost)   

                    grand_total += total_material_cost
                })
                $(each_table).find(".grand_total").text(grand_total)
                subtotal += grand_total
            })

            $('#subtotal_show').text(subtotal);
            $('#subtotal_inp').val(subtotal);

            calculate_total();
        });

        $(document).on('click', '.add_field_button', function (e) {
            e.preventDefault();
            var button = this;
            var section = $(this).attr('id').match(/(\d+)/g)[0];
            var row_number = parseInt($(this).attr('id').match(/(\d+)/g)[1]) + 1;
            var subcategory_id = $(this).attr('data-add-sub-cat-id');

            $.ajax({
                url: '/api/invoice/get-item-by-subcategory/'+subcategory_id,
                type: 'GET',
                success: function(response) {

                    var option_html = '<option value="">Select Item From '+response['subcategory'].item_sub_category_name+'</option>';
                    $.each(response['items'], function(i, data) {
                        option_html += '<option value="'+data.id+'">'+data.item_name+'</option>';
                    });

                    var attr_columns = ``;

                    $.each(response['measurable_attributes'], function (indexInArray, valueOfElement) {                        
                        attr_columns += `<td id="item_measurable_attr_${section}_${row_number}_${valueOfElement.id}" class="calculate_attr item_measurable_attr_${section}_${row_number}">0</td>`;
                    });
                    var units = {!! $units !!}
                    var unit_option = "";
                    $.each(units, function (index, unit) { 
                        if(unit.id != 1) {unit_option += `<option value="${unit.id}" data-unit-conversion="${unit.basic_unit_conversion}">${unit.name}</option>`}
                    });

                    var append_row = `
                        <tr id="tr_${section}_${row_number}" class="tdata_${section} data_rows">
                            <td class="uk-text-center">${row_number + 1}</td>
                            <td style="padding-top: 20px">
                                <select class="md-input select2-single-search-dropdown" name="item[${section}][]" id="item_${section}_${row_number}" onchange="ItemSelected(this)">
                                    ${option_html}
                                </select>
                            </td>
                            ${attr_columns}
                            <td><input class="md-input ${section}_qty calculate_amount calculate_amount_qty" type="number" name="qty[${section}][]" value="0" id="qty_${section}_${row_number}"></td>
                            <td><input class="md-input calculate_amount calculate_wastage" type="number" name="wastage[${section}][]" value="0" id="wastage_${section}_${row_number}"></td>
                            <td class="uk-text-center" style="padding-top: 20px" id="unit_td_${section}_${row_number}">
                                <select class="select2-single-search-dropdown calculate_unit" name="unit[${section}][]" id="unit_${section}_${row_number}">
                                    ${unit_option}
                                </select>
                            </td>
                            <td><input class="md-input calculate_amount calculate_amount_price" type="number" name="price[${section}][]" id="price_${section}_${row_number}" value="0"></td>
                            <td class="uk-text-right ${section}_price calculate_amount_total" id="price_show_${section}_${row_number}">0.00</td>
                            <td class="uk-text-center">
                                <a class="add_field_button" id="add_${section}_${row_number}" data-add-sub-cat-id=${subcategory_id}><i class="material-icons md-36"></i></a>
                            </td>
                        </tr>
                    `;            
                    $('.tdata_'+section).last().after(append_row);
                    $('.select2-single-search-dropdown').select2();
                    $(button).attr('id', `delete_field_button_${section}_${parseInt(row_number)-1}`).removeClass('add_field_button').addClass('delete_field_button').removeAttr('data-add-sub-cat-id').html('<i class="material-icons md-36">delete</i>');
                }
            });

        });

        $(document).ready(function() {
            tables = $(document).find(".subcategory_table")
            subtotal = 0

            tables.each(function(index, each_table){
                grand_total = 0
                rows = $(each_table).find("tr.data_rows")
                rows.each(function(index2, each_row){
                    qty = $(each_row).find('.calculate_amount_qty').val();
                    price = $(each_row).find('.calculate_amount_price').val();
                    wastage = $(each_row).find('.calculate_wastage').val();
                    wastage = 1 + (wastage / 100);
                    unit_name = $(each_row).find('.calculate_unit option:selected').html();
                    unit_converesion = $(each_row).find('.calculate_unit option:selected').attr('data-unit-conversion');
                    // console.log(unit);
                    // attribute_values = $(each_row).find('.attribute_values').html()
                    // console.log(attribute_values);
                    

                    var attr_mul = 1;
                    $.each($(each_row).find('.calculate_attr'), function (indexInCalculateAttr, CalculateAttr) {
                        if(unit_name == "Sft")
                        {
                            var attr_name = $(CalculateAttr).attr('data-attr-name');
                            if(attr_name == "L" || attr_name == "W"){
                                attr_mul *= ($("#"+CalculateAttr.id).html() == 0) ? 1 : $("#"+CalculateAttr.id).html();
                            }
                        }
                        else
                        {
                            attr_mul *= ($("#"+CalculateAttr.id).html() == 0) ? 1 : $("#"+CalculateAttr.id).html();
                        }
                    });

                    if(attr_mul == 0)
                    {
                        total = price * qty * wastage
                    }
                    else{
                        total = price * qty * wastage * attr_mul / unit_converesion
                    }
                    console.log(" price: "+price +", qty: "+qty +", wastage: "+wastage +", attr_mul: "+attr_mul +", unit_converesion: "+unit_converesion);
                    $(each_row).find('.calculate_amount_total:first').text(total.toFixed(2))

                    grand_total += total
                })
                $(each_table).find(".grand_total").text(grand_total.toFixed(2))
                subtotal += grand_total
            })

            $('#subtotal_show').text(subtotal.toFixed(2));
            $('#subtotal_inp').val(subtotal.toFixed(2));

            calculate_total();


            $(document).on('change', '#product_id', function(){
                var item = items.filter(obj => {
                    return obj.id == $(this).val();
                })[0];
                var item_measurable_attributes = (item.item_attribute_values).filter(obj => {
                    return obj.measurable == 1;
                });
                $('#product_size_container').empty();
                $.each(item_measurable_attributes, function (indexInArray, valueOfElement) { 
                    $('#product_size_container').append(
                        `<div class="uk-width-medium-1-3">
                            <div class="md-input-wrapper">
                                <label for="invoice_date">${valueOfElement.attribute_values.attribute.name} Value</label>
                                <input type="hidden" name="dimension_attribute[]" value="${valueOfElement.attribute_values.attribute_id}">
                                <input class="md-input" type="number" id="height_quantity" name="dimension[]">
                                <span class="md-input-bar "></span>
                            </div>
                        </div>`
                    );
                });
            });

            var map = $("#material_id").change(function(e) {
                var comp = $("#material_id option:selected").map(function() {
                        return this.value;
                    }).get(),
                    set1 = map.filter(function(i) {
                        return comp.indexOf(i) < 0;
                    }),
                    set2 = comp.filter(function(i) {
                        return map.indexOf(i) < 0;
                    }),
                    last = (set1.length ? set1 : set2)[0];
                    last = last.match(/(\d+)/g)[1];

                map = comp;

                if (set1.length == 1) {
                    $("[data-sub-id='" + last + "']").remove();
                    $.each($('.summary tr'), function(indexInArray, valueOfElement) {
                        if ($(`[data-item-ids="${$(valueOfElement).attr('data-summary-item-id')}"]`)
                            .length == 0) {
                            $(valueOfElement).remove();
                        }
                    });
                    // calculateTotalAdditional();
                }

                if (set2.length == 1) {

                    var section = $(".subcategory-section").length > 0 ? parseInt($(".subcategory-section").last().attr('data-sub-cat-section')) + 1 : 0;

                    $.ajax({
                        url: '/api/invoice/get-item-by-subcategory/'+last,
                        type: 'GET',
                        success: function(response) {
                            var option_html = '<option value="">Select Item From '+response['subcategory'].item_sub_category_name+'</option>';
                            $.each(response['items'], function(i, data) {
                                option_html += '<option value="'+data.id+'">'+data.item_name+'</option>';
                            });

                            // var unit_option = '<option value="">Select Item From '+response['subcategory'].item_sub_category_name+'</option>';
                            // $.each({! units !}, function (indexUnit, valueOfUnit) { 
                            //     unit_option += '<option value="'+valueOfUnit.id+'">'+valueOfUnit.name+'</option>';
                            // });

                            var measurable_attr = ``;
                            var attr_columns = ``;
                            var units = {!! $units !!}
                            var unit_option = "";
                            $.each(units, function (index, unit) { 
                                if(unit.id != 1) {unit_option += `<option value="${unit.id}" data-unit-conversion="${unit.basic_unit_conversion}">${unit.name}</option>`}
                            });

                            $.each(response['measurable_attributes'], function (indexInArray, valueOfElement) {
                                measurable_attr += `<th style="width: 5%" class="uk-text-center">${valueOfElement.name}</th>`
                                attr_columns += `<td class="item_measurable_attr_${section}_0 calculate_attr" id="item_measurable_attr_${section}_0_${valueOfElement.id}">0</td>`;
                            });

                            var table_content = `
                            <div class="md-card subcategory-section" style="padding-left: 0px; left: 5px; width: 100%" data-sub-cat-section="${section}" data-sub-id="${last}">
                                <input type="hidden" name="sub_category_id[${section}]" value="${last}">
                                <div class="user_heading" style="padding-bottom: 5px; padding-top: 5px; padding-left: 10px;">
                                    <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    </div>
                                    <div class="user_heading_content"style="padding-bottom: 0px; padding-top: 0px;">
                                        <h2 class="heading_b"><span class="uk-text-truncate">${response['subcategory'].item_sub_category_name}</span></h2>
                                    </div>
                                </div>
                                <table data-item-sub-id="${last}" class="table subcategory_table">
                                    <tr>
                                        <th rowspan="2" style="width: 2%" class="uk-text-center">SL</th>
                                        <th rowspan="2" style="width: 20%" class="uk-text-center">Items</th>`+
                                        (response['measurable_attributes'].length > 0 ? `<th colspan="${response['measurable_attributes'].length}" style="width: 15%" class="uk-text-center">Specification / Size</th>` : ``)+
                                        `<th rowspan="2" style="width: 10%" class="uk-text-center">Quantity</th>
                                        <th rowspan="2" style="width: 10%" class="uk-text-center">Wastage (%)</th>
                                        <th rowspan="2" style="width: 2%" class="uk-text-center">Unit</th>
                                        <th rowspan="2" style="width: 10%" class="uk-text-center">Price</th>
                                        <th rowspan="2" style="width: 10%" class="uk-text-center">Total</th>
                                        <th rowspan="2" style="width: 5%" class="uk-text-center">Action</th>
                                    </tr>
                                    <tr>
                                        ${measurable_attr}
                                    </tr>
                                    <tr id="tr_${section}_0" class="tdata_${section} data_rows">
                                        <td class="uk-text-center">1</td>
                                        <td style="padding-top: 20px">
                                            <select class="md-input select2-single-search-dropdown" name="item[${section}][]" id="item_${section}_0" onchange="ItemSelected(this)">
                                                ${option_html}
                                            </select>
                                        </td>
                                        ${attr_columns}
                                        <td><input class="md-input ${section}_qty calculate_amount calculate_amount_price" type="number" name="qty[${section}][]" value="0" id="qty_${section}_0"></td>
                                        <td><input class="md-input calculate_amount calculate_wastage" type="number" name="wastage[${section}][]" value="0" id="wastage_${section}_0"></td>
                                        <td class="uk-text-center" style="padding-top: 20px">
                                            <select class="select2-single-search-dropdown calculate_unit" name="unit[${section}][]" id="unit_${section}_0">
                                                ${unit_option}
                                            </select>
                                        </td>
                                        <td><input class="md-input calculate_amount calculate_amount_qty" type="number" name="price[${section}][]" id="price_${section}_0" value="0"></td>
                                        <td class="uk-text-right ${section}_price calculate_amount_total" id="price_show_${section}_0">0.00</td>
                                        <td class="uk-text-center">
                                            <a class="add_field_button" id="add_${section}_0" data-add-sub-cat-id=${last}><i class="material-icons md-36"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="total_${section}">
                                        <th class="uk-text-right" colspan="${6 + response['measurable_attributes'].length}">Total:</th>
                                        <th class="uk-text-right grand_total" id="total_${section}_show">0.00</th>
                                        <th class="uk-text-center">
                                        </th>
                                    </tr>
                                </table>
                            </div>`;
                            $('#cost_details').append(table_content);
                            $('.select2-single-search-dropdown').select2();
                        }
                    });
                }

            }).find('option:selected').map(function() {
                return this.value
            }).get();
        });



    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection