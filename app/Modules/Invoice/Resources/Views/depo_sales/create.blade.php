@extends('layouts.main')

@section('title', 'Depo Sale')

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

        .uk-badge a {
            color: white
        }

        input {
            margin-top: 10px;
        }

        .getMultipleRow input,
        discount_type {
            margin-top: -10px;
        }

        .discount_type {
            margin-top: -10px;
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open([
                'url' => route('depo_sales_store'),
                'method' => 'POST',
                'class' => 'user_edit_form',
                'id' => 'my_profile',
                'files' => 'true',
                'enctype' => 'multipart/form-data',
                'novalidate',
            ]) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create Primary Sale</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-4">
                                        <label for="depo_id">Depo</label> <br>
                                        <select class="md-input select2-single-search-dropdown" title="Select Depo"
                                            id="depo_id" name="depo_id" required>
                                            <option value="">Select Depo</option>
                                            @foreach ($depos as $depo)
                                                <option value="{{ $depo->id }}">
                                                    {{ $depo->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label for="customer_name">Distributor</label> <br>
                                        <select class="md-input select2-single-search-dropdown" title="Select Distributor"
                                            id="customer_id" name="customer_id" required>
                                            <option value="">Select Distributor</option>
                                            <option value="1">1</option>
                                            {{-- @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->display_name }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label for="invoice_date">Select Invoice date</label>
                                        <input class="md-input" type="text" id="invoice_date" name="invoice_date"
                                            value="{{ Carbon\Carbon::now()->format('d-m-Y') }}"
                                            data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label for="invoice_date">Reference</label>
                                        <input class="md-input" type="text" id="reference" name="reference">
                                    </div>

                                    <div class="uk-width-medium-1-4 hidden">
                                        <label for="invoice_date">Add New Item By Serial</label>
                                        <input class="md-input" type="text" id="new_item_serial" onfocusout="newserial()"
                                            name="new_item_serial">
                                        <p id="serial_message" style="color: red; font-weight: bold; display: none;"></p>
                                    </div>
                                </div>
                                <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1 uk-overflow-container">
                                        <table class="input_fields_wrap uk-table">
                                            <thead>
                                                <tr>
                                                    <th class="uk-text-nowrap">#</th>
                                                    <th class="uk-text-nowrap"width="20%">Product/Service <span
                                                            style="color: red;" class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap hidden">Serial No</th>
                                                    <th class="uk-text-nowrap">Description</th>
                                                    <th class="uk-text-nowrap">Quantity(ctn)<span style="color: red;"
                                                            class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap">Quantity(pcs)<span style="color: red;"
                                                            class="asterisc">*</span></th>
                                                     <th class="uk-text-nowrap">Unit<span style="color: red;"
                                                                class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="getMultipleRow">
                                                <tr class="tr_0" id="data_clone">
                                                    <td>
                                                        <p style="padding-top: 10px">1</p>
                                                    </td>

                                                    <td style="width: 200px">
                                                        <select id="item_id_0"
                                                            class="md-input itemId select2-single-search-dropdown"
                                                            name="item_id[]"
                                                            onchange="itemChanged(this, `sales`); calculatePcsToCtn(this)"
                                                            required>

                                                        </select>
                                                        <a data-toggle="uk-modal"
                                                            onclick="chooseVariationBtnClicked(this, `sales`)"
                                                            data-uk-modal="{target:'#chooseVariation'}"
                                                            id="choose_variation_modal_0" type="submit"
                                                            class="sm-btn sm-btn-primary variation-button">
                                                            <span class="uk-badge uk-align-center uk-margin-small-top">
                                                                Choose Variation
                                                            </span>
                                                        </a>
                                                        <input id="selected_variation_0" name="selected_variation[]"
                                                            type="number" style="display: none" value="">
                                                    </td>
                                                    <td class="hidden">
                                                        <input type="text" id="serial_0" name="serial[]"
                                                            class="md-input serial" value="" />
                                                    </td>
                                                    <td>
                                                        <input type="text" id="description_0"
                                                            class="md-input description" name="description[]">
                                                    </td>

                                                    <td>
                                                        <input type="text" id="quantity_ctn_0" name="quantity_ctn[]"
                                                            class="md-input" value="1"
                                                            oninput="calculateCtnToPcs(this); checkOffer(0)" required />
                                                    </td>

                                                    <td>
                                                        <input type="text" id="quantity_pcs_0" name="quantity_pcs[]"
                                                            class="md-input quantity" value="1"
                                                            oninput="calculatePcsToCtn(this); checkOffer(0)" required />
                                                    </td>
                                                    <td>
                                                           
                                                        <select  id="unit_id_0"  name="unit_id[]" class="select2-single-search-dropdown"
                                                            required >
                                                            <option value="">Select Unit</option>
                                                            @foreach($units as $unit)
                                                            <option value="{{ $unit->id }}">
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
                                                        <a href="#" class="add_field_button">
                                                            <i style="padding-top: 10px"
                                                                class="material-icons md-36">&#xE146;</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="display:none;float:right;margin-top:-20px !important "
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

                                <div class="uk-grid" style="display: none" id="free_entry_header">
                                    <div class="uk-width-1-1">
                                        <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2 ">
                                            Offers & Free Products
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid" style="display: none" id="free_entry_details">
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

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note">Note</label>
                                                <textarea class="md-input" id="customer_note" name="personal_note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-2 uk-margin-medium-top">
                                        <div class="uk-width-medium-1-1">
                                            <label for="user_edit_uname_control">Attach Files: </label>
                                        </div>
                                        <div class="uk-width-medium-1-1">
                                            <div class="uk-form-file uk-text-primary"
                                                style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                                <p style="margin: 4px;">Upload File</p>
                                                <input onchange="uploadLavel()" id="form-file" type="file"
                                                    name="file">
                                            </div>
                                        </div>
                                        <p id="upload_name"></p>
                                    </div>
                                </div>
                                <div class="uk-grid uk-text-right" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button type="button"
                                            class="uk-margin-small-top md-btn md-btn-flat uk-modal-close">Close</button>
                                        <input type="submit" id="submitStock" class="md-btn md-btn-primary"
                                            value="submit" name="submit" />

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
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        altair_forms.parsley_validation_config();
    </script>

    <script type="text/javascript">
        var max_fields = 50; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var index_no = 1;

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
                        list5 += '<option value = "' + data.id + '">' + data.item_name +
                        '</option>';

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
                    '<td class="hidden">' +
                    '<input  type="text" id="serial_' + x +
                    '" name="serial[]"  value="" class="md-input serial" />' +
                    '</td>' +
                    '<td>\n' + '<input type="text" id="description' + x +
                    '" class="md-input description" name="description[]" />\n' + '</td>\n' +
                    '<td>\n' + '<input type="text" id="quantity_ctn_' + x +
                    '" class="md-input" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer(' +
                    x + ')"/ >\n' + '</td>\n' +
                    '<td>\n' + '<input type="text" id="quantity_pcs_' + x +
                    '" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculatePcsToCtn(this); checkOffer(' +
                    x + ')"/ >\n' + '</td>\n' +
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

            if (serial_input_value != 'undefined') {
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

        $('#sidebar_depo_sales').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');

        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        })

        var ajax_data = [];
        var items_chosen = [];
        $(document).ready(function() {
            $.get("{{ route('item_list') }}/", function(data) {

                var list2 = '';
                var list4 = '';
                $.each(data, function(i, data) {
                    ajax_data[data.id] = data;
                    list4 += '<option value = "' + data.id + '">' + data.item_name + '</option>';
                });

                list2 += '<option value = "">' + 'Select Product/Service  ' + '</option>';

                $("#item_id_0").empty();
                $("#item_id_0").append(list2);
                $("#item_id_0").append(list4);
            });
        });

        var index_no = 0;

        $('.field_button').on('click', function(e) {
            e.preventDefault();
            index_no++;
            $('.add_row').append(
                '<tr class="app_tr_' + index_no + '">' +
                '<td>' +
                `<input class="md-input" type="text" id="due_date_` + index_no +
                `" name="due_date[]" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" />` +
                '</td>' +
                '<td>' +
                '<input class="md-input amount_value" id="due_ammount_' + index_no +
                '"  name="amount_val[]" onchange="valcheck(' + index_no + ')" type="text"/>' +
                '</td>' +
                '<td>' +
                '<a  class="remove_date_amount">\n' + '<i style="padding-top: 5px" value="' + index_no +
                '"  class="material-icons md-36">delete</i>\n' + '</a>\n' + '</td>\n' +
                '</td>' +
                '</tr>'
            )

            var nn = parseFloat(index_no) - 1;

            $('#due_ammount_' + nn).attr('readonly', 'readonly');
        });

        $('.add_row').on('click', '.remove_date_amount', function() {
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

        var serial_arr = [];

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
                    var value = data.value;
                    //array push using serial entry
                    serial_arr.push(item_serial);
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

                        function checkDuplicateSerial(checkId) {
                            return checkId >= item_serial;
                        }

                        if (value == 1) {
                            var new_serial_arr = find_duplicate_in_array(serial_arr);
                            var index_no = new_serial_arr.find(checkDuplicateSerial)

                            if (index_no > 0) {
                                $('#serial_message').text('You have already used the serial in this invoice..!!');
                                $("#serial_message").show();
                                return false;
                            }
                        }

                        $('#serial_message').text('');
                        $("#serial_message").hide();

                        var item_0_val = $("#item_id_" + 0).val();

                        //when no row was appended yet; we are at the very first row and item was not found before
                        if (item_exist_before != 1) {

                            if (x == 0 && item_0_val == null) {

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
                                    '<td style="width: 200px">\n' +
                                    '<div class="md-input-wrapper md-input-filled md-input-wrapper-success">\n' +
                                    '<select id="item_id_' + x +
                                    '" class="md-input itemId single_select2" name="item_id[]" onchange="getItemPrice(' +
                                    x + '); calculatePcsToCtn(this); itemChanged(this, `sales`)">\n' +
                                    '</select>\n' +
                                    '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `sales`)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_' +
                                    x + '" type="submit"' +
                                    'class="sm-btn sm-btn-primary variation-button"><span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span></a>' +
                                    '<input id="selected_variation_' + x +
                                    '" name="selected_variation[]" type="number" style="display: none" value=""></div>\n' +
                                    '</td>\n' +
                                    '<td class="hidden">' + '<input  type="text" id="serial_' + x +
                                    '" value="' + item_serial +
                                    '" name="serial[]" class="md-input serial"  />' + '</td>' +
                                    '<td>\n' + '<input type="text" id="description' + x +
                                    '" class="md-input description" name="description[]"/>\n' + '</td>\n' +
                                    '<td>\n' + '<input type="text" id="quantity_ctn_' + x +
                                    '" class="md-input" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer(' +
                                    x + ')"/ >\n' + '</td>\n' +
                                    '<td>\n' + '<input type="text" id="quantity_pcs_' + x +
                                    '" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculatePcsToCtn(this); checkOffer(0)"/ >\n' +
                                    '</td>\n' +
                                    '<td style="text-align: center">\n' + '<a href="#" data-val="' + x +
                                    '" class="remove_field" onclick="rowRemoved(' + x + ')">\n' +
                                    '<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n' +
                                    '</a>\n' + '</td>\n' +
                                    '</tr>\n');

                                $('.single_select2').select2();
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
                            $('#new_item_serial').val('');

                        }

                    } else {

                        $('#serial_message').text(data.message);

                        $("#serial_message").show();

                    }

                });
            }
        }

        function find_duplicate_in_array(arra1) {
            var object = {};
            var result = [];

            arra1.forEach(function(item) {
                if (!object[item])
                    object[item] = 0;
                object[item] += 1;
            })

            for (var prop in object) {
                if (object[prop] >= 2) {
                    result.push(prop);
                }
            }

            return result;
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

        $('#customer_id').change(function(e) {
            e.preventDefault();
            var customer_credit_note_amount = $('#' + $(this).attr('id') + ' option:selected').attr(
                'data-customer-credit-note');
            var customer_excess_payment_amount = $('#' + $(this).attr('id') + ' option:selected').attr(
                'data-customer-excess-payment');
            $("#credit_available_amount_advance").val(customer_credit_note_amount);
            $('#credit_amount_advance').attr('max', customer_credit_note_amount);
            $("#payment_available_amount_advance").val(customer_excess_payment_amount);
            $('#payment_amount_advance').attr('max', customer_excess_payment_amount);
            var total_available_amount = parseFloat(customer_excess_payment_amount) + parseFloat(
                customer_credit_note_amount);
            $('#total_available_balance').html(total_available_amount);
        });
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
