@extends('layouts.main')

@section('title', 'Add Invoice Measurement')

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

        .uk-table td,
        .uk-table th {
            padding: 7px 4px;
        }

        select.md-input,
        textarea.md-input,
        input:not([type]).md-input,
        input[type="text"].md-input,
        input[type="password"].md-input,
        input[type="datetime"].md-input,
        input[type="datetime-local"].md-input,
        input[type="date"].md-input,
        input[type="month"].md-input,
        input[type="time"].md-input,
        input[type="week"].md-input,
        input[type="number"].md-input,
        input[type="email"].md-input,
        input[type="url"].md-input,
        input[type="search"].md-input,
        input[type="tel"].md-input,
        input[type="color"].md-input {
            padding: 9px 4px;
        }

        .fixed-height-div {
            display: block;
            height: 320px;
            overflow-y: scroll;
        }

        .md-input-wrapper {
            padding-top: 0px;
        }

        .low-height-input {
            padding: 4px 4px !important;
            margin-top: 0px;
        }

        .md-36 {
            font-size: 26px !important;
        }

        .uk-table thead th,
        .uk-table tfoot td,
        .uk-table tfoot th {
            font-size: 12px;
            line-height: 1px;
        }

        #page_content_inner {
            padding: 10px 10px 100px;
        }

        .uk-grid+.uk-grid,
        .uk-grid-margin,
        .uk-grid>*>.uk-panel+.uk-panel {
            margin-top: 0px;
        }

        .md-input-filled>label,
        .md-input-focus>label {
            top: -15px;
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open([
                'url' => route('invoice_store_measurements'),
                'method' => 'POST',
                'class' => 'user_edit_form',
                'id' => 'my_profile',
                'files' => 'true',
                'enctype' => 'multipart/form-data',
            ]) !!}

            <div class="uk-grid uk-grid-medium">
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card" style="z-index: 1;">
                        <img class="bg_watermark" src="{{ url('uploads/op-logo/logo.png') }}" style="z-index: -1000;" />
                        <div class="user_content" style="padding: 7px 10px;">
                            <div class="">
                                <div class="uk-grid">
                                    <div class="uk-width-medium-2-4">
                                        <label for="customer_name">Name &nbsp <span class="uk-badge"><a
                                                    data-toggle="uk-modal" data-uk-modal="{target:'#addContact'}"
                                                    id="contact-modal" type="submit" class="sm-btn sm-btn-primary"
                                                    onclick="openContactModal(this)">Create Contact</a></span> </label> <br>
                                        <select class="md-input select2-single-search-dropdown" title="Select Customer"
                                            id="customer_id" name="customer_id" required>
                                            <option value="">Select Name or Mobile Number</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->phone_number_1 . ', ' . $customer->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <input type="hidden" name="temp_order_number" value="{{ $order_number }}">
                                        <label for="order_number">Order Number</label>
                                        <input class="md-input" type="text" id="order_number" name="order_number"
                                            value="{{ $order_number }}" required>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label for="delivery_date">Delivery Date</label>
                                        <input class="md-input" type="text" id="delivery_date" name="delivery_date"
                                            value="{{ date('d-m-Y', strtotime('+7 day')) }}"
                                            data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>
                                </div>

                                <table class="input_fields_wrap uk-table">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap" width="15%">Product Name</th>
                                            <th class="uk-text-nowrap" width="15%">Qty</th>
                                            <th class="uk-text-nowrap" width="15%">Send to Master Date</th>
                                            <th class="uk-text-nowrap" width="15%">Receive from Master Date</th>
                                            <th class="uk-text-nowrap" width="15%">Master Name</th>
                                            <th class="uk-text-nowrap" width="20%">Additional Note</th>
                                            <th class="uk-text-nowrap" width="5%"></th>
                                        </tr>
                                    </thead>

                                    <tbody class="getMultipleRow" id="products_table">
                                        <tr>
                                            <td serial="0">
                                                <select name="product[0]"
                                                    class="md-input select2-single-search-dropdown product" required>
                                                    <option value="">SELECT PRODUCT</option>
                                                    @foreach ($items as $product)
                                                        <option value="{{ $product->id }}">{{ $product->item_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[0]" value="1" class="md-input"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="text" name="send_to_master_date[0]" class="md-input"
                                                    data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                            </td>
                                            <td>
                                                <input type="text" name="receive_from_master_date[0]" class="md-input"
                                                    data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                            </td>
                                            <td>
                                                <select name="master[]" class="md-input select2-single-search-dropdown">
                                                    <option value="">SELECT MASTER</option>
                                                    @foreach ($masters as $master)
                                                        <option value="{{ $master->id }}">{{ $master->display_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="additional_note[0]" class="md-input">
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="uk-text-center">
                                                <a href="#" id="add_field_button" class="md-btn md-bg-teal"
                                                    style="color: white;">Add</a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <hr>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
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

    @foreach ($items as $key1 => $product)
        <div class="uk-modal uk-modal-card-fullscreen" id="updateMeasurements-{{ $product->id }}" role="dialog">
            <div class="uk-modal-dialog uk-modal-dialog-blank" style="background-color: #fff">

                {!! Form::open([
                    'url' => route('invoice_add_temp_measurements'),
                    'method' => 'POST',
                    'class' => 'invoice_add_temp_measurements',
                ]) !!}

                <input type="hidden" name="serial" id="updateMeasurementsSerial-{{ $product->id }}" value="">
                <input type="hidden" name="order_number" value="{{ $order_number }}">

                <div class="md-card uk-modal-body uk-height-viewport">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true"
                                aria-expanded="false">
                                <button type="button"
                                    class="md-btn md-btn-flat uk-margin-remove uk-modal-close cancel">Cancel</button>
                                <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Confirm</button>
                            </div>
                        </div>
                        <span class="md-icon material-icons uk-modal-close"></span>
                        <h3 class="md-card-toolbar-heading-text"
                            style="text-align: center !important; float: none;/*! margin: 0 auto; */">
                            {{ $product->name }}
                        </h3>
                    </div>
                    <div class="md-card-content">
                        <div class="uk-overflow-container">
                            <div class="uk-grid" data-uk-grid-margin>

                                @php $color = '#b30008'; @endphp

                                @for ($row = 1; $row <= $product->inventoryBodyMeasurements->max('row'); $row++)
                                    @php $body_measurements = $product->inventoryBodyMeasurements->where('row', $row)->sortBy('serial') @endphp

                                    @foreach ($body_measurements as $key => $bm)
                                        @php
                                            $body_measurement = $bm->BodyMeasurements;
                                            if ($color == '#b30008') {
                                                $color = '#868203';
                                            } else {
                                                $color = '#b30008';
                                            }
                                            $data_array = explode(',', $body_measurement->bm_values ?? '');
                                        @endphp

                                        @if ($body_measurement != null)
                                            <div style="margin-bottom: 10px; width: 7%">
                                                <input type="checkbox"
                                                    id="measurement_checkbox_{{ $product->id }}_{{ $body_measurement->id }}"
                                                    name="measurement_checkbox[{{ $body_measurement->id }}]"
                                                    data-md-icheck value="1" style="display: inline;"
                                                    @if (strlen($body_measurement->value) > 0) checked @else checked @endif>
                                                <span style="font-size: 11px; color: {{ $color }}; display: inline"
                                                    class="uk-text-bold">
                                                    {{ $body_measurement->en_title }}
                                                </span>

                                                <input class="md-input uk-margin-top"
                                                    list="measurement_{{ $body_measurement->id }}"
                                                    name="measurement[{{ $body_measurement->id }}]"
                                                    id="measurement0_{{ $product->id }}_{{ $body_measurement->id }}"
                                                    value="{{ $body_measurement->value }}"
                                                    style="width: 100%; border: 1px solid #000; border-radius: 5px">
                                                <datalist id="measurement_{{ $body_measurement->id }}">
                                                    @foreach ($data_array as $data_array_tmp)
                                                        <option value="{{ $data_array_tmp }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        @endif
                                    @endforeach

                            </div>
                            <div class="uk-grid uk-margin-top" data-uk-grid-margin>
    @endfor

    </div>
    </div>
    </div>
    </div>

    {!! Form::close() !!}

    </div>
    </div>
    @endforeach

    @foreach ($items as $key2 => $product)
        <div class="uk-modal uk-modal-card-fullscreen" id="oldMeasurements-{{ $product->id }}" role="dialog">
            <div class="uk-modal-dialog uk-modal-dialog-blank" style="background-color: #fff">
                <div class="md-card uk-modal-body uk-height-viewport">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true"
                                aria-expanded="false">
                                <button type="button"
                                    class="md-btn md-btn-flat uk-margin-remove uk-modal-close cancel">Cancel</button>
                                <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Confirm</button>
                            </div>
                        </div>
                        <span class="md-icon material-icons uk-modal-close"></span>
                        <h3 class="md-card-toolbar-heading-text"
                            style="text-align: center !important; float: none;/*! margin: 0 auto; */">
                            {{ $product->name }} - Old Measurements
                        </h3>
                    </div>

                    <div class="md-card-content">
                        <div class="uk-overflow-container">
                            <table class="uk-table">
                                <thead>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    <table style="display: none;">
        <tbody id="template">
            <tr>
                <td serial="#key#">
                    <select name="product[#key#]" id="product-#key#" class="md-input product" required>
                        <option value="">SELECT PRODUCT</option>
                        @foreach ($items as $product)
                            <option value="{{ $product->id }}">{{ $product->item_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="quantity[#key#]" class="md-input" value="1" required>
                </td>
                <td>
                    <input type="text" name="send_to_master_date[#key#]" class="md-input"
                        data-uk-datepicker="{format:'DD-MM-YYYY'}">
                </td>
                <td>
                    <input type="text" name="receive_from_master_date[#key#]" class="md-input"
                        data-uk-datepicker="{format:'DD-MM-YYYY'}">
                </td>
                <td>
                    <select name="master[#key#]" id="master-#key#" class="md-input">
                        <option value="">SELECT MASTER</option>
                        @foreach ($masters as $master)
                            <option value="{{ $master->id }}">{{ $master->display_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" name="additional_note[#key#]" class="md-input">
                </td>
                <td>
                    <a href="#" class="delete_field_button">
                        <i class="material-icons md-36">delete</i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection

@section('scripts')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        altair_forms.parsley_validation_config();
    </script>

    <script type="text/javascript">
        $('#sidebar_invoice_measurements').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');

        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        })
    </script>

    <script type="text/javascript">
        var rows = 0;
        var template = $('#template').html();
        $('#template').remove();

        $('#add_field_button').on('click', function() {
            $('#products_table').append(template.replaceAll('#key#', ++rows));
            $('#product-' + rows).addClass('select2-single-search-dropdown');
            $('#product-' + rows).select2();
            $('#master-' + rows).addClass('select2-single-search-dropdown');
            $('#master-' + rows).select2();
        })

        $(document).on('click', '.delete_field_button', function() {
            $(this).closest('tr').remove();
        })

        $(document).on('change', '.product', function() {
            $(this).closest('td').find('br').remove();
            $(this).closest('td').find('.uk-badge').remove();

            if ($(this).val() > 0) {
                $(this).closest('td').append('<br>' +
                    '<span class="uk-badge update" product="' + $(this).val() + '">' +
                    '<a data-toggle="uk-modal" data-uk-modal="{target:\'#updateMeasurements-' + $(this).val() +
                    '\'}" id="measurement-modal-' + $(this).val() +
                    '" type="button" class="sm-btn sm-btn-primary">Update Measurements</a>' +
                    '</span>' +
                    '<span class="uk-badge uk-margin-small-left" product="' + $(this).val() + '">' +
                    '<a data-toggle="uk-modal" data-uk-modal="{target:\'#oldMeasurements-' + $(this).val() +
                    '\'}" id="old-measurement-modal-' + $(this).val() +
                    '" type="button" class="sm-btn sm-btn-primary">Old Measurements</a>' +
                    '</span>');
            }


        })

        $(document).on('click', '.update', function() {
            var serial = $(this).closest('td').attr('serial');
            var product = $(this).attr('product');
            $('#updateMeasurementsSerial-' + product).val(serial);
        })

        $(document).ready(function() {
            $('#customer_id').on('change', function() {
                var user_id = $(this).val();

                $.post('{{ route('invoice_get_measurement_value') }}', {
                    'user_id': user_id
                }, function(data) {
                    $.each(data, function(index, item) {
                        $.each(item.body_measurements, function(index2, item2) {
                            $('#measurement0_' + item.id + '_' + item2.id).val(item2
                                .value);
                            if (item2.value.length > 0)
                                $('#measurement_checkbox_' + item.id + '_' + item2
                                    .id).prop('checked', true);
                            else $('#measurement_checkbox_' + item.id + '_' + item2
                                .id).prop('checked', false);
                        })

                        thead = '<tr>';
                        $.each(item.body_measurements, function(index4, item4) {
                            thead += '<th>' + item4.en_title + '</th>';
                        })
                        thead += '<th>#</th>';
                        thead += '</tr>';
                        $('#oldMeasurements-' + item.id + ' table thead').html(thead)

                        var html = '';
                        $.each(item.invoice_entries, function(index3, item3) {
                            console.log(item3);
                            // if (item3.measurements.length > 0) {
                            html += '<tr>';
                            var measurements = []
                            var values = []
                            $.each(item.body_measurements, function(index4, item4) {
                                measurements.push(item4.id)
                                if (item3.measurements[item4.id] != null) {
                                    values.push(item3.measurements[item4.id]
                                        .value)
                                    html += '<td>' + item3.measurements[
                                        item4.id].value + '</td>';
                                } else {
                                    values.push('')
                                    html += '<td></td>';
                                }
                            })
                            html +=
                                '<td><button type="button" class="md-btn md-btn-primary" onclick="select_old_measurement(' +
                                item.id + ', ' + JSON.stringify(measurements) +
                                ', ' + JSON.stringify(values).replaceAll('"', "'") +
                                ')">Select</button></td>';
                            html += '</tr>';
                            // }
                        })
                        $('#oldMeasurements-' + item.id + ' table tbody').html(html)
                    })
                })
            })
        });

        function select_old_measurement(item_id, measurements, values) {
            $.each(measurements, function(index, measurement) {
                $('#measurement0_' + item_id + '_' + measurement).val(values[index]);
            });
            UIkit.modal('#oldMeasurements-' + item_id).hide();
        }
    </script>

    <script type="text/javascript">
        $(document).on('submit', '.invoice_add_temp_measurements', function(event) {
            event.preventDefault();
            var post_url = $(this).attr("action");
            var form_data = $(this).serialize();

            $.post(post_url, form_data, function(response) {
                $('.cancel').click();
            });
        });
    </script>

@endsection
