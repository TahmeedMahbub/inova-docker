@extends('layouts.main')

@section('title', 'Depo Sales')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style media="screen">
        span.select2-container {
            z-index: 30 !important;
        }

        input {
            /* max-resolution: 100% !important; */
            margin-top: 10px;
        }

        .getMultipleRow input,
        .discount_type {
            /* max-width: ; */
            margin-top: -10px;
        }

        .discount_type {
            /* max-resolution: ; */
            margin-top: -10px;
        }
    </style>
@endsection

@section('content')

    <div class="uk-grid">

        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        {!! Form::open([
                            'url' => route('depo_sales_update', ['id' => $invoice->id]),
                            'method' => 'POST',
                            'class' => 'user_edit_form',
                            'id' => 'my_profile',
                            'files' => 'true',
                            'enctype' => 'multipart/form-data',
                            'novalidate',
                        ]) !!}
                        <input type="hidden" ng-init="invoice_id='asdfg'" value="{{ $invoice->id }}" name="invoice_id"
                            ng-model="invoice_id">
                        @php
                            $row_index = null;
                        @endphp
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Primary Sales</span></h2>
                            </div>
                        </div>

                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <label for="invoice_number">Invoice Number</label>
                                        <input type="text" class="md-input" id="invoice_number" name="invoice_number"
                                            value="{{ str_pad($invoice->sales_number, 6, '0', STR_PAD_LEFT) }}" readonly />
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="depo_id">Depo</label> <br>
                                        <select class="md-input select2-single-search-dropdown" title="Select Depo"
                                            id="depo_id" name="depo_id">
                                            <option value="">Select Depo</option>
                                            @foreach ($depos as $depo)
                                                <option value="{{ $depo->id }}"
                                                    {{ $depo->id == $invoice->seller_id ? 'selected' : '' }}>
                                                    {{ $depo->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="customer_name">Distributor</label> <br>
                                        <select class="md-input select2-single-search-dropdown" title="Select Distributor"
                                            id="customer_id" name="customer_id">
                                            <option value="">Select Disributor</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>
                                                    {{ $customer->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2">
                                        <label for="invoice_date">Select Invoice date</label>
                                        <input class="md-input" type="text" id="invoice_date" name="invoice_date"
                                            value="{{ date('d-m-Y', strtotime($invoice->sales_date)) }}"
                                            data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        <label for="invoice_date">Reference</label>
                                        <input class="md-input" type="text" id="reference" name="reference"
                                            value="{{ $invoice->reference }}">
                                    </div>
                                    <div class="uk-width-medium-1-2 hidden">
                                        <label for="invoice_date">Add New Item By Serial</label>
                                        <input class="md-input" type="text" id="new_item_serial" onfocusout="newserial()"
                                            name="new_item_serial">
                                        <p id="serial_message" style="color: red; font-weight: bold; display: none;"></p>
                                    </div>
                                </div>

                                <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="input_fields_wrap uk-table">
                                            <thead>
                                                <tr>
                                                    <th class="uk-text-nowrap">#</th>
                                                    <th class="uk-text-nowrap"width="20%">Product/Service <span
                                                            style="color: red;" class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap hidden">Serial</th>
                                                    <th class="uk-text-nowrap">Description</th>
                                                    <th class="uk-text-nowrap">Quantity(ctn)<span style="color: red;"
                                                            class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap">Quantity(pcs)<span style="color: red;"
                                                            class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="getMultipleRow">
                                                @foreach ($invoice->depoSaleEntries as $key => $invoice_entry_value)
                                                    @php
                                                        $row_index[$invoice_entry_value->id] = $key;
                                                    @endphp
                                                    <tr class="tr_{{ $key }}" id="data_clone">
                                                        <td>
                                                            <p style="padding-top: 10px">{{ $key + 1 }}</p>
                                                        </td>

                                                        <td style="width: 200px">
                                                            <select id="item_id_{{ $key }}"
                                                                class="md-input itemId select2-single-search-dropdown item_select"
                                                                name="item_id[]"
                                                                onchange="calculatePcsToCtn(this); itemChanged(this, `sales`)"
                                                                required>
                                                                <option value="{{ $invoice_entry_value->item_id }}"
                                                                    selected>
                                                                    {{ $invoice_entry_value->item->barcode_no . ', ' . $invoice_entry_value->item->item_name }}
                                                                </option>
                                                            </select>
                                                            <a data-toggle="uk-modal"
                                                                onclick="chooseVariationBtnClicked(this, `sales`)"
                                                                data-uk-modal="{target:'#chooseVariation'}"
                                                                id="choose_variation_modal_{{ $key }}"
                                                                type="submit"
                                                                class="sm-btn sm-btn-primary variation-button">
                                                                <span class="uk-badge uk-align-center uk-margin-small-top">
                                                                    Choose Variation
                                                                </span>
                                                            </a>
                                                            <input id="selected_variation_{{ $key }}"
                                                                name="selected_variation[]" type="number"
                                                                style="display: none"
                                                                value="{{ isset($invoice_entry_value->variation->id) ? $invoice_entry_value->variation->id : '' }}">
                                                            @if ($invoice_entry_value->variation_id)
                                                                <div class="uk-text-center"
                                                                    id="variation_badge_container_{{ $key }}">
                                                                    <span class="uk-badge uk-text-nowrap"
                                                                        id="variation_badge_{{ $key }}">Selected
                                                                        Variation:
                                                                        {{ $invoice_entry_value->variation->variation_name }}</span>
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <input type="text" id="description_{{ $key }}"
                                                                class="md-input description" name="description[]"
                                                                value="{{ $invoice_entry_value->description }}">
                                                        </td>

                                                        <td>
                                                            <input type="text" id="quantity_ctn_{{ $key }}"
                                                                name="quantity_ctn[]" class="md-input"
                                                                value="{{ isset($invoice_entry_value->variation) && $invoice_entry_value->variation->carton_size != 0 ? $invoice_entry_value->quantity / $invoice_entry_value->variation->carton_size : ($invoice_entry_value->item->carton_size == 0 ? 0 : $invoice_entry_value->quantity / $invoice_entry_value->item->carton_size) }}"
                                                                oninput="calculateCtnToPcs(this); checkOffer(0)" />
                                                        </td>

                                                        <td>
                                                            <input type="text" id="quantity_pcs_{{ $key }}"
                                                                name="quantity_pcs[]" class="md-input quantity"
                                                                value="{{$invoice_entry_value->unit_id?$invoice_entry_value->quantity/$invoice_entry_value->basic_unit_conversion:$invoice_entry_value->quantity }}"
                                                                oninput="calculatePcsToCtn(this); checkOffer({{ $key }})" />
                                                        </td>
                                                        <td>
                                                           
                                                            <select  id="unit_id_{{ $key }}"  name="unit_id[]" class="select2-single-search-dropdown"
                                                                required >
                                                                <option value="">Select Unit</option>
                                                                @foreach($units as $unit)
                                                                <option value="{{ $unit->id }}" {{ $unit->id==$invoice_entry_value->unit_id?'selected':'' }}>
                                                                    {{ $unit->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                           
                                                        @if ($errors->has('unit_id.*'))
                                                                <span class="error" style="color: red">
                                                                    Unit  is required
                                                                </span>                                                                
                                                            @endif
                                                        </td>

                                                        <td style="text-align: center">
                                                            @if ($key == 0)
                                                                <a href="#" class="add_field_button">
                                                                    <i style="padding-top: 10px"
                                                                        class="material-icons md-36">&#xE146;</i>
                                                                </a>
                                                            @else
                                                                <a href="#" class="remove_field"
                                                                    onclick="rowRemoved({{ $key }})">
                                                                    <i style="padding-top: 10px"
                                                                        class="material-icons md-36">delete</i>
                                                                </a>
                                                            @endif
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table style="display: none;float:right;margin-top:-20px !important "
                                            class="add_table">
                                            <tr>

                                                <td style="text-align: center">
                                                    <a href="#" class="add_field_button">
                                                        <i style="padding-top: 10px"
                                                            class="material-icons md-36">&#xE146;</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="uk-grid"
                                    style="{{ count($invoice->depoSaleFreeEntries) < 1 ? 'display: none' : '' }}"
                                    id="free_entry_header">
                                    <div class="uk-width-1-1">
                                        <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2 ">
                                            Offers & Free Products
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid"
                                    style="{{ count($invoice->depoSaleFreeEntries) < 1 ? 'display: none' : '' }}"
                                    id="free_entry_details">
                                    <div class="uk-width-1-1">
                                        <div class="uk-grid uk-margin-large-bottom" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <table class="uk-table">
                                                    <thead>
                                                        <tr>
                                                            <th class="uk-text-nowrap">SL</th>
                                                            <th class="uk-text-nowrap">Offer Details</th>
                                                            <th class="uk-text-nowrap">Base Product</th>
                                                            <th class="uk-text-nowrap">Free Product</th>
                                                            <th class="uk-text-nowrap">Free Quantity</th>
                                                            <th class="uk-text-nowrap">Offer Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="getFreeEntryRow">
                                                        @foreach ($invoice->depoSaleFreeEntries as $key => $invoice_free_entry)
                                                            <tr
                                                                class="free_entry_tr_{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}">
                                                                <td style="padding-top: 25px">
                                                                    <span>{{ $key + 1 }}</span>
                                                                </td>
                                                                <td style="padding-top: 25px">
                                                                    <select
                                                                        name="offer_details_id[{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}]"
                                                                        class="form-control select2-single-search-dropdown"
                                                                        id="offer_details_id_{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}"
                                                                        onchange="offerSelected(this)">
                                                                        @foreach ($invoice_free_entry->offer->item->itemOffers as $key1 => $offer)
                                                                            <option value="{{ $offer->id }}"
                                                                                id="offer_option_{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}_{{ $key1 }}"
                                                                                {{ $offer->id == $invoice_free_entry->offer_id ? 'selected' : '' }}>
                                                                                {{ $offer->item->item_name }}({{ $offer->item->barcode_no }})
                                                                                - {{ $offer->start_date }} -
                                                                                {{ $offer->end_date }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td style="padding-top: 25px">
                                                                    <select
                                                                        name="base_item_id[{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}]"
                                                                        class="form-control select2-single-search-dropdown"
                                                                        id="base_item_id_{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}">
                                                                        <option
                                                                            value="{{ $invoice_free_entry->offer->item_id }}">
                                                                            {{ $invoice_free_entry->offer->item->item_name }}
                                                                        </option>
                                                                    </select>
                                                                </td>
                                                                <td style="padding-top: 25px">
                                                                    <select
                                                                        name="free_item_id[{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}]"
                                                                        class="form-control select2-single-search-dropdown"
                                                                        id="free_item_id_{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}">
                                                                        @if ($invoice_free_entry->free_item_id != null)
                                                                            <option
                                                                                value="{{ $invoice_free_entry->free_item_id }}">
                                                                                {{ $invoice_free_entry->freeItem->item_name }}
                                                                            </option>
                                                                        @else
                                                                            <option value="">Select Free Item
                                                                            </option>
                                                                        @endif
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="md-input"
                                                                        name="free_item_quantity[{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}]"
                                                                        oninput="calculateFreeEntry('{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}')"
                                                                        id="free_item_quantity_id_'{{ $row_index[$invoice_free_entry->depoSaleEntry->id] }}"
                                                                        value="{{ $invoice_free_entry->free_item_quantity == null ? 0 : $invoice_free_entry->free_item_quantity }}">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-2-4">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note">Note</label>
                                                <textarea class="md-input" id="customer_note" name="personal_note">{{ $invoice->personal_note }}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="uk-width-medium-1-2 uk-margin-medium-top">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                @if ($invoice->file_name)
                                                    <a
                                                        href="{{ url('invoice/invoice-download' . '/' . $invoice->file_name) }}">
                                                        <p class="uk-text-medium uk-margin-bottom">Download Attachment</p>
                                                    </a>
                                                @endif
                                                <label for="user_edit_uname_control">Attach Files: </label>
                                            </div>
                                            <div class="uk-width-medium-1-1">

                                                <div class="uk-form-file uk-text-primary"
                                                    style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                                    <p style="margin: 4px;">Upload File </p>
                                                    <input onchange="uploadLavel()" id="form-file" type="file"
                                                        name="file">
                                                </div>
                                                <p id="upload_name"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-grid uk-text-right" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        @if ($invoice->save == 1)
                                            <input type="submit" class="md-btn md-btn-success" value="save"
                                                name="submit" />
                                        @else
                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary"
                                                value="submit" name="submit" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script type="text/javascript">
        var ajax_data = [];
        var invoice_entries = <?php echo $invoice->depoSaleEntries; ?>;
        var items_chosen = [];
        $.each(invoice_entries, function(indexInArray, invoice_entry) {
            items_chosen[indexInArray] = invoice_entry.item;
            items_chosen[indexInArray]['variation_id'] = invoice_entry.variation_id;
            items_chosen[indexInArray]['variations'] = [];
        });

        $('#document').ready(function() {

            var list2 = '';
            var list4 = '';
            var selected_tmp = 0;

            var total_val = 0;
            var total_inv_amount = 0;

            $.ajax({
                type: "get",
                url: "{{ route('item_list') }}",
                success: function(response) {
                    $.each(response, function(indexInArray, item) {
                        ajax_data[item.id] = item;
                    });
                }
            });

            $('.item_select').select2({
                width: '100%',
                placeholder: 'Select an Item',
                ajax: {
                    delay: 250,
                    cache: true,
                    url: "{{ route('item_list') }}/?invoice_entry_id=1",
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1
                        }

                        return query;
                    }
                }
            });

            $.each(items_chosen, function(indexInArray, item_chosen) {
                $.get("/api/inventory/check-variation/" + item_chosen.id, function(data) {
                    $.each(data.variations, function(indexInArrayOfVariation, variation) {
                        items_chosen[indexInArray]['variations'][variation.id] = variation;
                    });
                });
            });
        });
    </script>

    <script type="text/javascript">
        var max_fields = 50; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        //For apending another rows start
        var x = 0;
        $(add_button).click(function(e) {
            e.preventDefault();

            var x = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);

            if (x < max_fields) {
                x++;

                var serial = x + 1;

                var y = $("#item_sub_category_id").val();

                $.get("{{ route('item_list') }}/", function(data) {

                    var list5 = '';
                    var list7 = '';

                    $.each(data, function(i, data) {
                        list5 += '<option value = "' + data.id + '">' + data.barcode_no + ', ' +
                            data.item_name + '</option>';

                    });

                    list7 += '<option value = "">' + 'Select Product/Service  ' + '</option>';

                    $("#item_id_" + x).empty();
                    $("#item_id_" + x).append(list7);
                    $("#item_id_" + x).append(list5);
                });

                $('.getMultipleRow').append(' ' + '<tr class="tr_' + x + '">' +
                    '<td>\n' + '<p style="padding-top: 10px">' + serial + '</p>' + '</td>\n' +
                    '<td style="width: 200px">\n' +
                    '<div class="md-input-wrapper md-input-filled md-input-wrapper-success">\n' +
                    '<select id="item_id_' + x +
                    '" class="md-input itemId single_select2" name="item_id[]" onchange="itemChanged(this, `sales`); calculatePcsToCtn(this)" required>\n' +
                    '</select>\n' +
                    '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `sales`)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_' +
                    x + '" type="submit"' +
                    'class="sm-btn sm-btn-primary variation-button"><span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span></a>' +
                    '<input id="selected_variation_' + x +
                    '" name="selected_variation[]" type="number" style="display: none" value=""></div>\n' +
                    '</td>\n' +
                    ' <td class="hidden">' +
                    '<input  type="text" id="serial_' + x +
                    '" name="serial[]"  value="" class="md-input serial" />' +
                    '</td>' +
                    '<td>\n' + '<input type="text" id="description' + x +
                    '" class="md-input description" name="description[]"/>\n' + '</td>\n' +
                    '<td>\n' + '<input type="text" id="quantity_ctn_' + x +
                    '" class="md-input" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer(' +
                    x + ')"/>\n' + '</td>\n' +
                    '<td>\n' + '<input type="text" id="quantity_pcs_' + x +
                    '" class="md-input quantity" name="quantity_pcs[]" value="1"  oninput="calculatePcsToCtn(this); checkOffer(' +
                    x + ')"/>\n' + '</td>\n' +
                    '<td>\n'+'<select name="unit_id[]" id="unit_id_'+x+'" class="md-input  single_select2"  required>\n'+ '<option value="">Select Unit</option>\n'+ ' @foreach($units as $unit) <option  value="{{ $unit->id }}">{{ $unit->name }}</option> @endforeach</select>\n'+'</td>\n'+

                    '<td style="text-align: center">\n' + '<a href="#" data-val="' + x +
                    '" class="remove_field" onclick="rowRemoved(' + x + ')">\n' +
                    '<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n' + '</a>\n' +
                    '</td>\n' +
                    '</tr>\n');
                $('.single_select2').select2();
            }
            if (serial > 1) {
                $('.add_table').css('display', 'inline');
            }
        });
        //For apending another rows end

        $(wrapper).on("click", ".remove_field", function(e) {
            e.preventDefault();
            //removing input array when delete tr 
            var serial_no_of_tr = $(this).data('val');
            var serial_input_value = $("#serial_" + serial_no_of_tr).val();

            if (serial_input_value == 'undefined') {
                var serial_input_value = serial_input_value.split(",");

                for (var j = 0; j < serial_input_value.length; j++) {
                    for (var i = 0; i < serial_arr.length; i++) {

                        if (serial_arr[i] == serial_input_value[j]) {
                            serial_arr.splice(i, 1);
                            i--;
                        }
                    }
                }
            }

            $(this).parent().parent().remove();
            x--;
        });

        $(document).ready(function() {
            var x = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);
            x++;

            if (x > 1) {
                $('.add_table').css('display', 'inline');
            }
        });
    </script>

    <script type="text/javascript">
        var total_val = $("#totalAmount").val();
        var index_no = "<?php echo isset($i) ? $i : 0; ?>";

        $('.field_button').on('click', function(e) {
            e.preventDefault();

            //  var index_no = parseInt($('.add_row tr:last').attr('class').match(/(\d+)/g)[0]);

            index_no++;

            $('.add_row').append(
                '<tr class="app_tr_' + index_no + '">' +
                '<td>' +
                `<input class="md-input" type="text" id="due_date_` + index_no +
                `" name="due_date[]" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" >` +
                '</td>' +
                '<td>' +
                '<input class="md-input amount_value" id="due_ammount_' + index_no +
                '" name="amount_val[]" onchange="valcheck(' + index_no + ')" type="text">' +
                '</td>' +
                '<td>' +
                '<a  class="remove_date_amount">\n' +
                '<i style="padding-top: 5px"  class="material-icons md-36">delete</i>\n' + '</a>\n' +
                '</td>\n' +
                '</td>' +
                '</tr>'
            )

            var nn = parseFloat(index_no) - 2;
            $('#due_ammount_' + nn).attr('readonly', 'readonly');
        });

        $('#add_row').on('click', '.remove_date_amount', function() {
            $(this).parent().parent().remove();
            valcheck();
        });

        function valcheck(z) {
            var check_due_amount = $('#due_ammount_' + z).val();
            var total_payable = $('#totalAmount').val();

            var total_amount_val = 0;
            $('.amount_value').each(function(index, value) {
                total_amount_val += parseFloat($(this).val());
            });

            var balance_due = parseFloat(total_payable) - parseFloat(total_amount_val);

            if (isNaN(parseFloat(balance_due))) {
                var balance_due = 0;
            }

            if (total_amount_val <= total_payable) {
                $('#due_ammount_' + z).val(check_due_amount);
            } else {
                if (balance_due < 0) {
                    var bl = parseFloat(check_due_amount) + parseFloat(balance_due);

                    $('#due_ammount_' + z).val(bl);
                } else {
                    $('#due_ammount_' + z).val(balance_due);
                }
            }
        }
    </script>

    <script type="text/javascript">
        function uploadLavel() {
            var fullPath = document.getElementById('form-file').value;
            var upload_file_name_ = document.getElementById('upload_name');

            if (fullPath) {
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);

                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }

                upload_file_name_.innerHTML = filename;
            }
        }

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_depo_sales').addClass('act_item');

        $(window).load(function() {
            $("#tiktok_account").trigger('click');

        })

        function newserial() {
            var x = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);

            var new_serial = $('#new_item_serial').val();
            var tmp = 0;
            var stop_op = 0;

            $('#serial_message').text('');

            $("#serial_message").hide();

            //check if serial already used in previous rows
            for (tmp = 0; tmp <= x; tmp++) {

                var used_serial = $('#serial_' + tmp).val();
                if (used_serial == new_serial && new_serial != "") {

                    stop_op = 1;

                    $('#serial_message').text('You have already used the serial in this invoice..!!');

                    $("#serial_message").show();

                }
            }

            //if not used proceed with ajax call
            if (stop_op != 1) {
                $.get('/invoice/check/serial/' + new_serial, function(data) {

                    var item_id = data.item_id;
                    var item_serial = data.item_serial;
                    var item_sales_rate = data.item_sales_rate;
                    var item_exist_before = 0;

                    //if any item found append new row
                    if (item_id > 0) {

                        //check if item_id already exists in previous rows
                        for (tmp = 0; tmp <= x; tmp++) {

                            var used_item = $('#item_id_' + tmp).val();

                            if (used_item == item_id && item_id > 0) {

                                x = tmp;

                                item_exist_before = 1;

                            }
                        }

                        $('#serial_message').text('');
                        $("#serial_message").hide();

                        var item_0_val = $("#item_id_" + 0).val();

                        //when no row was appended yet; we are at the very first row and item was not found before
                        if (item_exist_before != 1) {

                            if (x == 0 && item_0_val == "") {

                                $.get("{{ route('item_list_stock_serial') }}", function(data2) {

                                    var list5 = '';
                                    var list7 = '';

                                    $.each(data2, function(i, data2) {
                                        if (data2.id == item_id) {
                                            list5 += '<option value = "' + data2.id +
                                                '" selected>' + data2.item_name + '</option>';
                                        } else {
                                            list5 += '<option value = "' + data2.id + '">' + data2
                                                .item_name + '</option>';
                                        }

                                    });

                                    list7 += '<option value = "">' + 'Select Item ' + '</option>';

                                    $("#item_id_" + 0).empty();
                                    $("#item_id_" + 0).append(list7);
                                    $("#item_id_" + 0).append(list5);
                                });

                                $('#serial_0').val(item_serial);
                                $('#rate_0').val(item_sales_rate);
                                $('#amount_0').val(item_sales_rate);

                                calculateActualAmount(0);

                                $('#new_item_serial').val('');

                            } else {

                                x++;

                                var serial = x + 1;

                                $.get("{{ route('item_list_stock_serial') }}", function(data2) {

                                    var list5 = '';
                                    var list7 = '';

                                    $.each(data2, function(i, data2) {
                                        if (data2.id == item_id) {
                                            list5 += '<option value = "' + data2.id +
                                                '" selected>' + data2.item_name + '</option>';
                                        } else {
                                            list5 += '<option value = "' + data2.id + '">' + data2
                                                .item_name + '</option>';
                                        }

                                    });

                                    list7 += '<option value = "">' + 'Select Item ' + '</option>';

                                    $("#item_id_" + x).empty();
                                    $("#item_id_" + x).append(list7);
                                    $("#item_id_" + x).append(list5);
                                });


                                $('.getMultipleRow').append(' ' + '<tr class="tr_' + x + '">' +
                                    '<td>\n' + '<p style="padding-top: 10px">' + serial + '</p>' + '</td>\n' +
                                    '<td style="width: 200px">\n' + '<select id="item_id_' + x +
                                    '" class="md-input itemId single_select2" name="item_id[]" onchange="getItemPrice(' +
                                    x + ')">\n' + '</select>\n' + '<div class="row">' +
                                    '<label style="padding-top: 10px;padding-right: 0px;" class="col-md-6">' +
                                    '' + '</label>' +
                                    '<input  style="padding-top: 10px;border: none;padding-left: 0px;font-weight: white;color:white" class="col-md-6" type="text" id="stock_' +
                                    x + '" class="" name="stock[]"/>' + '</div>' +
                                    '</td>\n' +
                                    ' <td class="hidden">' +
                                    '<input  type="text" id="serial_' + x + '" name="serial[]"  value="' +
                                    item_serial + '" class="md-input serial" />' +
                                    '</td>' +
                                    '<td>\n' + '<input type="text" id="description' + x +
                                    '" class="md-input description" name="description[]" oninput="calculateActualAmount(' +
                                    x + ')"/>\n' + '</td>\n' +
                                    '<td>\n' + '<input type="text" id="quantity_ctn_' + x +
                                    '" class="md-input" name="quantity_ctn[]" value="1" oninput="calculateActualAmount(' +
                                    x + ')"/ >\n' + '</td>\n' +
                                    '<td>\n' + '<input type="text" id="quantity_pcs_' + x +
                                    '" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculateActualAmount(' +
                                    x + ')"/ >\n' + '</td>\n' +
                                    '<td>\n'+'<select name="unit_id[]" id="unit_id_'+x+'" class="md-input  single_select2"  required>\n'+ '<option value="">Select Unit</option>\n'+ ' @foreach($units as $unit) <option  value="{{ $unit->id }}">{{ $unit->name }}</option> @endforeach</select>\n'+'</td>\n'+

                                    '<td style="text-align: center">\n' + '<a href="#" data-val="' + x +
                                    '" class="remove_field" onclick="rowRemoved(' + x + ')">\n' +
                                    '<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n' +
                                    '</a>\n' + '</td>\n' +
                                    '</tr>\n');
                                $('.single_select2').select2();

                                $('.single_select2').select2();

                                calculateActualAmount(x);

                                $('#new_item_serial').val('');

                            }

                        } else {

                            var total_amount = 0;
                            var cur_rate = $('#rate_' + x).val();
                            var cur_qty = parseInt($('#quantity_pcs_' + x).val());

                            $('#quantity_pcs_' + x).val(cur_qty + 1);

                            cur_qty = $('#quantity_pcs_' + x).val();

                            total_amount = parseFloat(cur_qty * cur_rate);

                            $('#amount_' + x).val(total_amount);

                            var cur_serial = $('#serial_' + x).val();

                            cur_serial = cur_serial + ", " + item_serial;

                            $('#serial_' + x).val(cur_serial);

                            calculateActualAmount(x);

                            $('#new_item_serial').val('');

                        }

                    } else {
                        $('#serial_message').text(data.message);
                        $("#serial_message").show();
                    }
                });
            }
        }
    </script>

    <script type="text/javascript">
        var date_formate = function(date_find) {
            var today_date = new Date(date_find);
            var year_find = today_date.getFullYear().toString();
            var month_find = (today_date.getMonth() + 1).toString();
            var date_find = today_date.getDate().toString();
            var next_date_form = (date_find[1] ? date_find : "0" + date_find[0]) + "-" + (month_find[1] ? month_find :
                "0" + month_find[0]) + "-" + year_find;

            return next_date_form;
        }
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
