@extends('layouts.main')

@section('title', 'Bill of Material Create')

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
            {!! Form::open(['url' => route('bomStore'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
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
                                        <div class="uk-grid" data-uk-grid-margin style="margin-left: -20px; margin-right: 15px; padding-top: 20px; padding-bottom: 20px;">
                                            <div class="uk-width-medium-1-3">
                                              <label for="invoice_id">Invoice</label> <br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Invoice" id="invoice_id" name="invoice_id">
                                                    <option value="">Select Invoice</option>
                                                </select>
                                                @if ($errors->has('invoice_id'))
                                                    <span class="error" style="color: red">
                                                        {{ $errors->first('invoice_id') }}
                                                    </span>                                                
                                                @endif
                                            </div>
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Project Name</label>
                                                <input class="md-input" type="text" id="project_name" name="project_name">
                                            </div>
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Date</label>
                                                <input class="md-input" type="text" id="date" name="date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="md-card">
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
                                    </div>


                                    <div class="md-card">
                                        <div class="user_heading">
                                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            </div>
                                            <div class="user_heading_content"style="padding-bottom: 6px; padding-top: 6px;">
                                                <h2 class="heading_b"><span class="uk-text-truncate">Product Size</span></h2>
                                            </div>
                                        </div>
                                        <div class="uk-grid" data-uk-grid-margin style="margin-left: -20px; margin-right: 15px; padding-top: 20px; padding-bottom: 20px;">
                                            {{-- <div class="uk-width-medium-1-2">
                                              <label for="height_attribute_id">Attribute</label> <br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Attribute" id="height_attribute_id" name="height_attribute_id">
                                                    <option value="">Height</option>
                                                </select>
                                                <strong>Height</strong>
                                            </div> --}}
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Height Value</label>
                                                <input class="md-input" type="number" id="height_quantity" name="dimension[]">
                                            </div>
                                            {{-- <div class="uk-width-medium-1-2">
                                              <label for="width_attribute_id">Attribute</label> <br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Attribute" id="width_attribute_id" name="width_attribute_id">
                                                    <option value="">Width</option>
                                                </select>
                                                <strong>Width</strong>
                                            </div> --}}
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Width Value</label>
                                                <input class="md-input" type="number" id="width_quantity" name="dimension[]">
                                            </div>
                                            {{-- <div class="uk-width-medium-1-2">
                                              <label for="length_attribute_id">Attribute</label> <br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Attribute" id="length_attribute_id" name="length_attribute_id">
                                                    <option value="">Length</option>
                                                </select>
                                                <strong>Length</strong>
                                            </div> --}}
    
                                            <div class="uk-width-medium-1-3">
                                                <label for="invoice_date">Length Value</label>
                                                <input class="md-input" type="number" id="length_quantity" name="dimension[]">
                                            </div>
                                        </div>
                                    </div>

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
                                                <label for="material_id">Product</label> <br>
                                                <select class="md-input select2-single-search-dropdown" title="Select Product" id="material_id" name="material_id[]" multiple>
                                                    <option id="material_0_0" value="">Select Product</option>
                                                    <option id="material_0_1" value="mehogony">Mehogony</option>
                                                    <option id="material_0_2" value="glass">Clear Glass</option>
                                                </select>
                                                @if ($errors->has('material_id'))
                                                    <span class="error" style="color: red">
                                                        {{ $errors->first('material_id') }}
                                                    </span>                                                
                                                @endif
                                            </div>                                            
                                        </div>

                                        <div class="uk-grid" style="margin-left: 10px; margin-right: 15px; padding-bottom: 20px;" id="cost_details"></div>


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
                                                            <th colspan="2">Subtotal</th>
                                                            <th class="uk-text-right production_cost_show" id="subtotal_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 200px">CHO (%)</th>
                                                            <th style="width: 160px"><input type="number" value="0" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="" id="cho_inp" oninput="calculate_total()"></th>
                                                            <th style="width: 100px" class="uk-text-right production_cost_show" id="cho_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Profit (%)</th>
                                                            <th><input type="number" value="0" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="" id="profit_inp" oninput="calculate_total()"></th>
                                                            <th class="uk-text-right production_cost_show" id="profit_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Design (%)</th>
                                                            <th><input type="number" value="0" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="" id="design_inp" oninput="calculate_total()"></th>
                                                            <th class="uk-text-right production_cost_show" id="design_show">0.00</th>
                                                        </tr>
                                                        <tr style="background-color:#e0e0e0">
                                                            <th colspan="2">Production Cost</th>
                                                            <th class="uk-text-right" id="production_cost_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th>MRP (%)</th>
                                                            <th><input type="number" value="0" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="mrp" id="mrp_inp" oninput="calculate_total()"></th>
                                                            <th class="uk-text-right" id="mrp_show">0.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th>VAT (%)</th>
                                                            <th><input type="number" value="0" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="vat" id="vat_inp" oninput="calculate_total()"></th>
                                                            <th class="uk-text-right" id="vat_show">0.00</th>
                                                        </tr>
                                                        <tr style="background-color:#c7c7c7">
                                                            <th>Trade Price</th>
                                                            <th><input type="number" value="0" class="md-input" style="margin-top: 0px; padding-top: 0px; width:160px;" name="trade" id="trade_inp" oninput="calculate_total()"></th>
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
    </script>

    <script type="text/javascript">

        function calculate_total(){
            var subtotal = parseFloat($("#subtotal_show").html());

            if($("#cho_inp").val() == "")
                { var cho = 0; }
            else
                { var cho = parseFloat($("#cho_inp").val()).toFixed(2);}
            $("#cho_show").html((subtotal * cho / 100).toFixed(2));
            
            
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

            production_cost_total = parseFloat(subtotal) + parseFloat(subtotal * cho / 100) + parseFloat(subtotal * profit / 100) + parseFloat(subtotal * design / 100);
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
            $("#vat_show").html((mrp * vat / 100).toFixed(2));

            $("#trade_inp").val((parseFloat(mrp) + parseFloat(vat)).toFixed(2));
            
            if($("#trade_inp").val() == "")
                { var trade = 0; }
            else
                { var trade = parseFloat($("#trade_inp").val()).toFixed(2);}
            $("#trade_price_show").html(trade);
        }
    
        function mehogony_calculate_amount(row_number){

            if(row_number != "delete")
            {
                var price = $("#mehogony_price_"+row_number).val();
                var qty = $("#mehogony_qty_"+row_number).val();

                if(price == ""){
                    var price = 0;
                }
                if(qty == ""){
                    var qty = 0;
                }
            }

            $('#mehogony_price_show_'+row_number).html((parseFloat(price)*parseFloat(qty)).toFixed(2));
            
            var mehogony_total = 0;
            $('.mehogony_price').each(function()
            {
                if($(this).html() == ""){
                    var price_for_total = 0.00;
                }
                else
                {
                    var price_for_total = parseFloat($(this).html());
                }
                mehogony_total     += price_for_total;
            });
            $('#total_mehogony_show').html((parseFloat(mehogony_total)).toFixed(2));

            $('#subtotal_show').html((parseFloat(mehogony_total)).toFixed(2));

            calculate_total();
        }

        function mehogony_delete(row_number){
            $("#mehogony_"+row_number).remove();
            mehogony_calculate_amount("delete");
        }





        $(document).on('click', '.add_field_button', function (e) { 
            e.preventDefault();

            var id = $(this).attr('id');

            var row_number = parseInt($('.tdata_'+id).last().attr('data-'+id+'-row-number')) + 1;
            
            var append_row = `<tr id="${id}_${row_number}" class="tdata_${id}" data-${id}-row-number="${row_number}">
                                <td class="uk-text-center">${row_number}</td>
                                <td>
                                    <select class="md-input select2-single-search-dropdown" name="${id}_item" id="${id}_item">
                                        <option value="">Select Item</option>
                                        <option value="">Leg Size</option>
                                        <option value="">Glass Fitting SS Disk</option>
                                        <option value="">Glass Fitting Glue</option>
                                    </select>
                                </td>
                                <td>2</td>
                                <td>4</td>
                                <td>5</td>
                                <td><input class="md-input ${id}_qty" type="number" name="${id}_qty[]" value="0" id="${id}_qty_${row_number}" oninput="${id}_calculate_amount(${row_number})"></td>
                                <td><input class="md-input" type="number" name="${id}_wastage[]" value="0" id="${id}_wastage_${row_number}"></td>
                                <td class="uk-text-center">
                                    <select name="${id}_unit" id="${id}_unit">
                                        <option value="">Pcs</option>
                                        <option value="">CFT</option>
                                        <option value="">LS</option>
                                    </select>
                                </td>
                                <td><input class="md-input" type="number" name="${id}_price[]" id="${id}_price_${row_number}" value="0" oninput="${id}_calculate_amount(${row_number})"></td>
                                <td class="uk-text-right ${id}_price" id="${id}_price_show_${row_number}">0.00</td>
                                <td class="uk-text-center">
                                    <a id="delete_field_button_${id}_${row_number}"  onclick="${id}_delete(${row_number})"><i class="material-icons md-36">delete</i></a>
                                </td>
                            </tr>`;            
            $('.tdata_'+id).last().after(append_row);

        });

        $(document).ready(function() {

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

                // console.log(comp);
                // console.log(set1);
                // console.log(set2);
                // console.log(last);

                map = comp;

                if (set1.length == 1) {
                    $("[data-sub-id='" + last + "']").remove();
                    $.each($('.summary tr'), function(indexInArray, valueOfElement) {
                        if ($(`[data-item-ids="${$(valueOfElement).attr('data-summary-item-id')}"]`)
                            .length == 0) {
                            $(valueOfElement).remove();
                        }
                    });
                    calculateTotalAdditional();
                }

                if (set2.length == 1) {
                    var table_content = `
                    <div class="md-card" style="padding-left: 0px; left: 5px; width: 100%" data-sub-id="${last}">
                        <div class="user_heading" style="padding-bottom: 5px; padding-top: 5px; padding-left: 10px;">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content"style="padding-bottom: 0px; padding-top: 0px;">
                                <h2 class="heading_b"><span class="uk-text-truncate">${last}</span></h2>
                            </div>
                        </div>
                        <table data-item-sub-id="${last}" class="table">
                            <tr>
                                <th rowspan="2" style="width: 2%" class="uk-text-center">SL</th>
                                <th rowspan="2" style="width: 20%" class="uk-text-center">Items</th>
                                <th colspan="3" style="width: 15%" class="uk-text-center">Specification / Size</th>
                                <th rowspan="2" style="width: 10%" class="uk-text-center">Quantity</th>
                                <th rowspan="2" style="width: 10%" class="uk-text-center">Wastage (%)</th>
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
                            <tr id="${last}_1" class="tdata_${last}" data-${last}-row-number="1">
                                <td class="uk-text-center">1</td>
                                <td>
                                    <select class="md-input select2-single-search-dropdown" name="${last}_item" id="${last}_item">
                                        <option value="">Select Item</option>
                                        <option value="">Leg Size</option>
                                        <option value="">Glass Fitting SS Disk</option>
                                        <option value="">Glass Fitting Glue</option>
                                    </select>
                                </td>
                                <td>2</td>
                                <td>4</td>
                                <td>5</td>
                                <td><input class="md-input ${last}_qty" type="number" name="${last}_qty[]" value="0" id="${last}_qty_1" oninput="${last}_calculate_amount(1)"></td>
                                <td><input class="md-input" type="number" name="${last}_wastage" value="0" id="${last}_wastage"></td>
                                <td class="uk-text-center">
                                    <select name="${last}_unit" id="${last}_unit">
                                        <option value="">Pcs</option>
                                        <option value="">CFT</option>
                                        <option value="">LS</option>
                                    </select>
                                </td>
                                <td><input class="md-input" type="number" name="${last}_price[]" id="${last}_price_1" value="0" oninput="${last}_calculate_amount(1)"></td>
                                <td class="uk-text-right ${last}_price" id="${last}_price_show_1">0.00</td>
                                <td class="uk-text-center">
                                    <a class="add_field_button" id="${last}"><i class="material-icons md-36"></i></a>
                                </td>
                            </tr>
                            <tr class="total_${last}">
                                <th class="uk-text-right" colspan="9">Total:</th>
                                <th class="uk-text-right" id="total_${last}_show">0.00</th>
                                <th class="uk-text-center">
                                </th>
                            </tr>
                        </table>
                    </div>`;
                    $('#cost_details').append(table_content);
                    $('.itemId').select2();
                }

            }).find('option:selected').map(function() {
                console.log(this.value);
                return this.value
            }).get();
        });








        var ajax_data        = [];
        var items_chosen     = [];
        var max_fields       = 50;                           //maximum input boxes allowed
        var wrapper          = $(".input_fields_wrap");      //Fields wrapper
        var add_button       = $(".add_field_button");       //Add button ID
        var index_no         = 1;

        //For apending another rows start
        var x = 0;
        $(add_button).click(function(e)
        {
            e.preventDefault();

            var x = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);

            if(x < max_fields)
            {
                x++;

                var serial = x + 1;

                var y = $("#item_sub_category_id").val();

                $.get("{{route('item_list')}}/", function(data){

                    var list5 = '';
                    var list7 = '';

                    $.each(data, function(i, data)
                    {
                        list5 += '<option value = "' +  data.id + '">' + data.item_name +'</option>';

                    });

                    list7 += '<option value = "">' + 'Select Product/Service  ' +'</option>';

                    $("#item_id_"+x).empty();
                    $("#item_id_"+x).append(list7);
                    $("#item_id_"+x).append(list5);
                });


                $('.getMultipleRow').append( ' ' +'<tr class="tr_'+x+'">'+
                    '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+
                    '<td style="width: 200px">\n'+
                        '<div class="md-input-wrapper md-input-filled md-input-wrapper-success">\n'+
                            '<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="itemChanged(this, `sales`); getItemPrice('+x+'); calculatePcsToCtn(this)" required>\n'+ '</select>\n'+
                            '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `sales`)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_'+x+'" type="submit"'+
                            'class="sm-btn sm-btn-primary variation-button"><span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span></a>'+
                        '<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value=""></div>\n'+
                    '</td>\n'+
                    '<td class="hidden">'+
                    '<input  type="text" id="serial_'+x+'" name="serial[]"  value="" class="md-input serial" />'+
                    '</td>'+
                    '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" />\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_ctn_'+x+'" class="md-input" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer('+x+')"/ >\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_pcs_'+x+'" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculateActualAmount('+x+'); calculatePcsToCtn(this); checkOffer('+x+')"/ >\n'+'</td>\n'+
                    '<td>\n'+'<select name="unit_id[]" id="unit_id_'+x+'" class="md-input  single_select2"  required>\n'+ '<option value="">Select Unit</option>\n'+ ' @foreach($units as $unit) <option  value="{{ $unit->id }}">{{ $unit->name }}</option> @endforeach</select>\n'+'</td>\n'+

                    '<td>\n'+
                    '<div style="position: relative">\n<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')" required/>\n'+
                    '<select name="rate_type[]" id="rate_type_'+x+'" style="position: absolute; right: -5px; top: 12px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount('+x+')">\n'+
                    '<option value="0">pcs</option><option value="1">ctn</option></select></div>'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($account as $account_all) <option {{$account_all->id==16 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
                    '<td style="text-align: center">\n'+'<a href="#" data-val="'+x+'" class="remove_field" onclick="rowRemoved('+x+')">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                    '</tr>\n');
                $('.single_select2').select2();
            }
            if(serial>1)
            {
              $('.add_table').css('display','inline');
            }
        });
        //For apending another rows end

        $(wrapper).on("click",".remove_field", function(e)
        {
            e.preventDefault();
            //removing input array when delete tr 
            var serial_no_of_tr      = $(this).data('val');
            var serial_input_value   = $("#serial_"+serial_no_of_tr).val();

            if(serial_input_value != 'undefined')
            {
                var serial_input_value   = serial_input_value.split(",");
    
                for(var j = 0; j < serial_input_value.length; j++)
                {
                    for( var i = 0; i < serial_arr.length; i++)
                    {
                        if ( serial_arr[i] == serial_input_value[j])
                        {
                            serial_arr.splice(i, 1);
                            i--;
                        }
                    }
                }  
            }

            $(this).parent().parent().remove(); x--;
            
            calculateActualAmount();
        });

        function getItemPrice(x)
        {
            //For getting item commission information from items table start
            var item_id  = $("#item_id_"+x).val();     
            if(item_id){
                var url = "{{ route('check-variation', ':id') }}";
                url = url.replace(':id', item_id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function (data) {
                        $("#rate_"+x).val(0.00);
                        $("#amount_"+x).val(0.00);
                        calculateActualAmount(x);
                        UIkit.notify({
                            message: 'Please select a Variation',
                            status: 'warning',
                            timeout: 2000,
                            pos: 'top-right'
                        });
                    },
                    error: function(data){                    

                        $("#rate_"+x).val(ajax_data[item_id]['item_sales_rate'] == null || ajax_data[item_id]['item_sales_rate'] == '' ? 0.00 : ajax_data[item_id]['item_sales_rate']);
                        $("#amount_"+x).val(ajax_data[item_id]['item_sales_rate'] == null || ajax_data[item_id]['item_sales_rate'] == '' ? 0.00 : ajax_data[item_id]['item_sales_rate']);
                        calculateActualAmount(x);
                    }
                });
            }
            //For getting item commission information from items table end
        }

        function calculateActualAmount(x)
        {
            var rate                    = $("#rate_"+x).val();
            var quantity                = $("#quantity_pcs_"+x).val();
            var quantity_cartoon        = $("#quantity_cartoon_"+x).val();
            var discount                = $("#discount_"+x).val();
            var discountType            = $("#discount_type_"+x).val();
            var subTotal                = $("#subTotal").val();
            var adjustment              = $("#adjustment").val();
            var vat                     = $("#vat").val();
            var shippingCharge          = $("#shippingCharge").val();

            if (rate == '')
            {
                var rateCal             = 0.00;
            }else{
                var rateCal             = $("#rate_"+x).val();
            }

            if (quantity == '')
            {
                var quantityCal         = 1;
            }else{
                var quantityCal         = $("#quantity_pcs_"+x).val();
            }

            if (quantity_cartoon == '' || quantity_cartoon == 0)
            {
                var quantityCtnCal         = 1;
            }else{
                var quantityCtnCal         = $("#quantity_ctn_"+x).val();
            }

            if (discount == '')
            {
                var discountCal         = 0;

            }else{
                var discountCal         = $("#discount_"+x).val();
            }
            
            if (discountType == 0)
            {
                var discountTypeCal     = (parseFloat(discountCal)*parseFloat(rateCal)*parseFloat(quantityCal))/100;
            }else{
                var discountTypeCal     = $("#discount_"+x).val()=='' ? 0 : $("#discount_"+x).val() ;
            }


            var amount = ($('#rate_type_'+x).val() == 0 ? ((parseFloat(rateCal)*parseFloat(quantityCal)) - (parseFloat(discountTypeCal))) : (parseFloat(rateCal)*parseFloat(quantityCtnCal)) - (parseFloat(discountTypeCal))).toFixed(2);
            

            $("#amount_"+x).val(amount);

            var subTotal       = 0;

            $('.amount').each(function()
            {
                subTotal     += parseFloat($(this).val());
            });

            //Calculating Subtotal Amount end
            $("#subTotalShow").html(subTotal);
            $("#subTotal").val(subTotal);

            if (adjustment == '0.00' || adjustment == '' )
            {
                var adjustment_value    = 0;
                var adjustment_show     = 0;
            }else{
                var adjustment_value    = $('#adjustment_type').val() == 0 ? subTotal * adjustment / 100 : adjustment;
                var adjustment_show     = parseFloat(subTotal) - parseFloat(adjustment_value);
            }

            var payment_amount = $('#check_payment').is(':checked') && $('#payment_amount').val() != '' ? $('#payment_amount').val() : 0;
            var payment_advance = $('#check_payment_advance').is(':checked') && $('#payment_amount_advance').val() != '' ? $('#payment_amount_advance').val() : 0;
            var payment_vendor_credit = $('#check_payment_vendor_credit').is(':checked') && $('#credit_amount_advance').val() != '' ? $('#credit_amount_advance').val() : 0;

            $('#adjusted_amount').html(parseFloat(payment_advance) + parseFloat(payment_vendor_credit));
            $('#totalPaidAmount').html((parseFloat(payment_amount) + parseFloat(payment_advance) + parseFloat(payment_vendor_credit)).toFixed(2));
            $('#paidAmount').val((parseFloat(payment_amount) + parseFloat(payment_advance) + parseFloat(payment_vendor_credit)).toFixed(2));

            if(vat =='' || vat ==0.00)
            {
                var vat_val     = 0;
                var vat_show    = 0;
                var vat_cal     = 0;
            }
            else {
                var vat_val     =  vat;
                var vat_cal     =  ((parseFloat(subTotal) - parseFloat(adjustment_value)) * parseFloat(vat_val))/100;
                var vat_show    = parseFloat(vat_cal) + parseFloat(subTotal);
            }
            if(shippingCharge =='' || shippingCharge ==0.00)
            {
                var shippingCharge_val  = 0;
                var shippingCharge_show = 0;
            }
            else {
                var shippingCharge_val  =  shippingCharge;
                var shippingCharge_show = parseFloat(shippingCharge_val)+parseFloat(vat_cal)+parseFloat(subTotal)-parseFloat(adjustment_value);
            }

            var total_amount     = parseFloat(shippingCharge_val)+parseFloat(vat_cal)+parseFloat(subTotal)-parseFloat(adjustment_value);

            $("#adjustmentShow").html(-adjustment_value);
            $("#vatShow").html(vat_cal);
            $("#vat_total").val(vat_cal);
            $("#shippingChargeShow").html(shippingCharge_val);
            $("#totalAmountShow").html(total_amount.toFixed(2));
            $("#totalAmount").val(total_amount.toFixed(2));            
            $('#totalDueAmount').html((parseFloat(total_amount) - parseFloat(payment_amount) - parseFloat(payment_advance) - parseFloat(payment_vendor_credit)).toFixed(2));
            $('#dueAmount').val((parseFloat(total_amount) - parseFloat(payment_amount) - parseFloat(payment_advance) - parseFloat(payment_vendor_credit)).toFixed(2));

            total_val =  total_amount ;

            if(total_val > 0)
            {
                $("#due_date_amount").show(2000);
                var total_payable    = $('#totalAmount').val();
            }
            else
            {
                $("#due_date_amount").hide(2000);
            }

            // commissionAmount();
            // installment();
        }

        // function commissionAmount()
        // {
        //     var commission_amount = $('#commission').val();
        //     var commission_type   = $('#commission_type').val();

        //     var sub_total       = $('#subTotal').val();
        //     var adjustment      = $('#adjustment').val();

        //     if(adjustment == 0|| adjustment =='')
        //     {
        //         adjustment = 0;
        //     }

        //     sub_total = parseFloat(adjustment) + parseFloat(sub_total);

        //     if(commission_type == 1){
        //         var com = commission_amount;
        //     }
        //     else{
        //         if(commission_amount >= 100)
        //             var com = sub_total;
        //         else
        //             var com = (parseFloat(sub_total) * parseFloat(commission_amount))/100;
        //     }

        //     if(isNaN(com)){
        //         $('#agentcommissionAmount').val(0);
        //     }
        //     else
        //     {
        //         $('#agentcommissionAmount').val(Number(com).toFixed(2));
        //     }
        // }

        function uploadLavel(){
           var fullPath             = document.getElementById('form-file').value;
           var upload_file_name_    = document.getElementById('upload_name');

           if (fullPath) {
               var startIndex   = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
               var filename     = fullPath.substring(startIndex);
               if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                   filename     = filename.substring(1);
               }

               upload_file_name_.innerHTML  = filename;
           }
        }

        $('#sidebar_invoice').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
        $( document ).ready(function() {
            $.get("{{route('item_list')}}/", function(data){
                
                var list2 = '';
                var list4 = '';
                $.each(data, function(i, data)
                {
                    ajax_data[data.id] = data;
                    list4 += '<option value = "' +  data.id + '">' + data.item_name +'</option>';
                });
    
                list2 += '<option value = "">' + 'Select Product/Service  ' +'</option>';
    
                $("#item_id_0").empty();
                $("#item_id_0").append(list2);
                $("#item_id_0").append(list4);
            });
        });

        var total_val =   $("#totalAmount").val();
        var index_no  =   0;

        $('.field_button').on('click',function(e){
            e.preventDefault();
            index_no++;
            $('.add_row').append(
                '<tr class="app_tr_'+index_no+'">'+
                    '<td>'+
                        `<input class="md-input" type="text" id="due_date_`+ index_no +`" name="due_date[]" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" />` +
                    '</td>' +
                    '<td>'+
                        '<input class="md-input amount_value" id="due_ammount_'+index_no+'"  name="amount_val[]" onchange="valcheck('+ index_no +')" type="text"/>'+
                    '</td>'+
                    '<td>'+
                        '<a  class="remove_date_amount">\n'+'<i style="padding-top: 5px" value="'+ index_no +'"  class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                    '</td>'
                +'</tr>'
            )

            var nn = parseFloat(index_no) - 1;

            $('#due_ammount_'+nn).attr('readonly', 'readonly');
        });

        $('.add_row').on('click', '.remove_date_amount',function(){
            $(this).parent().parent().remove();
            valcheck();
        });

        function valcheck(z)
        {
            var check_due_amount = $('#due_ammount_'+z).val();
            var total_payable    = $('#totalAmount').val();

            var total_amount_val = 0;
            $('.amount_value').each(function(index ,value)
            {
                total_amount_val += parseFloat($(this).val());
            });

            var balance_due       = parseFloat(total_payable) - parseFloat(total_amount_val);

            if(isNaN(parseFloat(balance_due)))
            {
                var balance_due      =  0;
            }

            if(total_amount_val <= total_payable)
            {
                $('#due_ammount_'+z).val(check_due_amount);
            }
            else
            {
                if(balance_due < 0)
                {
                    var bl  = parseFloat(check_due_amount) +  parseFloat(balance_due);

                    $('#due_ammount_'+z).val(bl);
                }
                else
                {
                    $('#due_ammount_'+z).val(balance_due);
                }
            }
        }

        var serial_arr      = [];

        function newserial()
        {
            var x               = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);
            var new_serial      = $('#new_item_serial').val();
            var tmp             = 0;
            var stop_op         = 0;

            $('#serial_message').text('');

            $("#serial_message").hide();

            //check if serial already used in previous rows
            for(tmp = 0; tmp <= x; tmp++){

                var used_serial = $('#serial_'+tmp).val();
                if(used_serial == new_serial && new_serial != ""){

                    stop_op = 1;

                    $('#serial_message').text('You have already used the serial in this invoice..!!');

                    $("#serial_message").show();

                }
            }

            //if not used proceed with ajax call
            if(stop_op != 1){
                $.get('/invoice/check/serial/'+ new_serial, function(data){
                    var item_id             = data.item_id;
                    var item_serial         = data.item_serial;
                    var item_sales_rate     = data.item_sales_rate;
                    var item_exist_before   = 0;
                    var value               = data.value;
                    //array push using serial entry
                    serial_arr.push(item_serial);
                    //if any item found append new row
                    if(item_id > 0){

                        //check if item_id already exists in previous rows
                        for(tmp = 0; tmp <= x; tmp++){

                            var used_item = $('#item_id_'+tmp).val();

                            if(used_item == item_id && item_id > 0){

                                x = tmp;

                                item_exist_before = 1;

                            }
                    }

                    function checkDuplicateSerial(checkId) {
                      return checkId >= item_serial;
                    }

                    if(value == 1 )
                    {
                        var new_serial_arr = find_duplicate_in_array(serial_arr);
                        var index_no = new_serial_arr.find(checkDuplicateSerial)

                        if(index_no >0)
                        {
                           $('#serial_message').text('You have already used the serial in this invoice..!!');
                           $("#serial_message").show();
                           return false;
                        }
                    }

                    $('#serial_message').text('');
                    $("#serial_message").hide();

                    var item_0_val = $("#item_id_"+0).val();

                    //when no row was appended yet; we are at the very first row and item was not found before
                    if(item_exist_before != 1){

                        if(x == 0 && item_0_val == null){

                            $.get("{{ route('item_list_stock_serial') }}", function(data2){

                                var list5 = '';
                                var list7 = '';

                                $.each(data2, function(i, data2)
                                {
                                    if(data2.id == item_id){
                                        list5 += '<option value = "' +  data2.id + '" selected>' + data2.item_name +'</option>';
                                    }else{
                                        list5 += '<option value = "' +  data2.id + '">' + data2.item_name +'</option>';
                                    }

                                });

                                list7 += '<option value = "">' + 'Select Item ' +'</option>';

                                $("#item_id_"+0).empty();
                                $("#item_id_"+0).append(list7);
                                $("#item_id_"+0).append(list5);
                            });

                            $('#serial_0').val(item_serial);
                            $('#rate_0').val(item_sales_rate);
                            $('#amount_0').val(item_sales_rate);

                            calculateActualAmount(0);

                            $('#new_item_serial').val('');

                        }else{

                            x++;

                            var serial = x + 1;

                            $.get("{{ route('item_list_stock_serial') }}", function(data2){

                                var list5 = '';
                                var list7 = '';

                                $.each(data2, function(i, data2)
                                {
                                    if(data2.id == item_id){
                                        list5 += '<option value = "' +  data2.id + '" selected>' + data2.item_name +'</option>';
                                    }else{
                                        list5 += '<option value = "' +  data2.id + '">' + data2.item_name +'</option>';
                                    }
                                });

                                list7 += '<option value = "">' + 'Select Item ' +'</option>';

                                $("#item_id_"+x).empty();
                                $("#item_id_"+x).append(list7);
                                $("#item_id_"+x).append(list5);
                            });


                            $('.getMultipleRow').append( ' ' +'<tr class="tr_'+x+'">'+
                                '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+                                
                                '<td style="width: 200px">\n'+
                                    '<div class="md-input-wrapper md-input-filled md-input-wrapper-success">\n'+
                                        '<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="getItemPrice('+x+'); calculatePcsToCtn(this); itemChanged(this, `sales`)">\n'+ '</select>\n'+
                                        '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `sales`)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_'+x+'" type="submit"'+
                                        'class="sm-btn sm-btn-primary variation-button"><span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span></a>'+
                                    '<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value=""></div>\n'+
                                '</td>\n'+
                                '<td class="hidden">'+'<input  type="text" id="serial_'+x+'" value="'+item_serial+'" name="serial[]" class="md-input serial"  />'+'</td>'+
                                '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="quantity_ctn_'+x+'" class="md-input" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer('+x+')"/ >\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="quantity_pcs_'+x+'" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculateActualAmount('+x+'); calculatePcsToCtn(this); checkOffer(0)"/ >\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($account as $account_all) <option {{$account_all->id==16 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
                                '<td style="text-align: center">\n'+'<a href="#" data-val="'+x+'" class="remove_field" onclick="rowRemoved('+x+')">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                            '</tr>\n');

                                $('.single_select2').select2();

                                calculateActualAmount(x);

                                $('#new_item_serial').val('');

                            }

                        }else{
                            var total_amount    = 0;
                            var cur_rate        = $('#rate_'+x).val();
                            var cur_qty         = parseInt($('#quantity_pcs_'+x).val());

                            $('#quantity_pcs_'+x).val(cur_qty + 1);

                            cur_qty             = $('#quantity_pcs_'+x).val();

                            total_amount        = parseFloat(cur_qty * cur_rate);

                            $('#amount_'+x).val(total_amount);

                            var cur_serial      = $('#serial_'+x).val();

                            cur_serial          = cur_serial + ", " + item_serial;

                            $('#serial_'+x).val(cur_serial);

                            calculateActualAmount(x);

                            $('#new_item_serial').val('');

                        }

                    }else{

                        $('#serial_message').text(data.message);

                        $("#serial_message").show();

                  }

              });
            }
        }

        function find_duplicate_in_array(arra1) 
        {
            var object = {};
            var result = [];

            arra1.forEach(function (item) {
                if(!object[item])
                    object[item] = 0;
                    object[item] += 1;
            })

            for (var prop in object) {
                if(object[prop] >= 2) {
                   result.push(prop);
                }
            }

            return result;
        }
    </script>

    <script type="text/javascript">
        var date_formate  = function (date_find)
        {
            var today_date       = new Date(date_find);
            var year_find        = today_date.getFullYear().toString();
            var month_find       = (today_date.getMonth() + 1).toString();
            var date_find        = today_date.getDate().toString();
            var next_date_form   = (date_find[1] ? date_find:"0" + date_find[0]) + "-" + (month_find[1] ? month_find:"0" + month_find[0]) + "-" + year_find;

            return next_date_form;
        }

        $('#customer_id').change(function (e) { 
            e.preventDefault();
            var customer_credit_note_amount = $('#' + $(this).attr('id') + ' option:selected').attr('data-customer-credit-note');
            var customer_excess_payment_amount = $('#' + $(this).attr('id') + ' option:selected').attr('data-customer-excess-payment');
            $("#credit_available_amount_advance").val(customer_credit_note_amount);
            $('#credit_amount_advance').attr('max', customer_credit_note_amount);
            $("#payment_available_amount_advance").val(customer_excess_payment_amount);
            $('#payment_amount_advance').attr('max', customer_excess_payment_amount);
            var total_available_amount = parseFloat(customer_excess_payment_amount) + parseFloat(customer_credit_note_amount);
            $('#total_available_balance').html(total_available_amount);
        });
        
        function paymentTypeChanged(){
            if($('#payment_account option:selected').data('account-type') == 5){
                $('#cheque_number_container, #issue_date_container').show(800);
                $('#cheque_number_container, #issue_date_container').attr('required', true);
            }else{
                $('#cheque_number_container, #issue_date_container').hide(800);
                $('#cheque_number_container, #issue_date_container').attr('required', false);
                $('#cheque_number_container input, #issue_date_container input').val('');
            }
        }

        // function installment()
        // {
        //     $('#install_due_date').empty();
        //     var time_int             = 0;
        //     var no_of_installment    = $('#no_of_installment').val();
        //     var time_interval        = $('#time_interval').val();
        //     var start_date           = $('#start_date').val().split("-");
        //     var new_date             = new Date(start_date[2], start_date[1] - 1, start_date[0]);
        //     var mili_date            = new_date.getTime();
        //     var amount               = $("#totalAmount").val()/no_of_installment;

        //     if($('#no_of_installment').val() >0 && $('#time_interval').val()>0)
        //     {
        //       for(var i = 0; i< no_of_installment;i++)
        //       {
        //         if(i == 0)
        //         {
        //         var start_date =date_formate(mili_date)
        //         }
        //         else
        //         {
        //             time_int           = time_int+(86400000*(time_interval));
        //             var start_date     = date_formate(mili_date+time_int);
        //         }
        //          $('#install_due_date').append
        //          (
        //            '<tr>'+
        //              '<td>'+
        //                 `<input class="md-input" type="text" id="due_date" name="due_date[]" value="`+start_date+`" data-uk-datepicker="{format:'DD-MM-YYYY'}" >`+
        //              '</td>' +
        //              '<td>'+
        //                '<input class="md-input amount_value" type="text" id="due_ammount_0" onchange="valcheck(0)" value="'+Number(amount).toFixed(2)+'" name="amount_val[]" />'+
        //              '</td>'
        //            +'</tr>'
        //          );
        //       }
        //        $('#installment').show(1000);
        //        $("#due_date_amount").hide(1000);
        //     }
        //     else  {
        //       $('#installment').hide(1000);
        //       $("#due_date_amount").show(100);
        //     }
        // }
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
