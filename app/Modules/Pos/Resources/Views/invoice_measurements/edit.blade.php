@extends('layouts.main')

@section('title', 'Update Invoice Measurements')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style media="screen">
        span.select2-container{
            z-index: 30 !important;
        }
        .uk-badge a{
            color:white
        }
        input{
            margin-top: 10px;
        }
        .getMultipleRow input,discount_type{
            margin-top:-10px;
        }
        .discount_type{
            margin-top:-10px;
        }
        .uk-table td, .uk-table th {
            padding: 7px 4px;
        }

        select.md-input, textarea.md-input, input:not([type]).md-input, input[type="text"].md-input, input[type="password"].md-input, 
        input[type="datetime"].md-input, input[type="datetime-local"].md-input, input[type="date"].md-input, input[type="month"].md-input, 
        input[type="time"].md-input, input[type="week"].md-input, input[type="number"].md-input, input[type="email"].md-input, 
        input[type="url"].md-input, input[type="search"].md-input, input[type="tel"].md-input, input[type="color"].md-input{
            padding: 9px 4px;
        }
        .fixed-height-div{
            display: block;
            /* max-height: 420px;
            overflow-y: scroll; */
        }
        .md-input-wrapper {
            padding-top: 0px;
        }
        .low-height-input{
            padding: 4px 4px !important;
            margin-top: 0px;
        }
        .md-36{
            font-size: 26px !important;
        }
        .uk-table thead th, .uk-table tfoot td, .uk-table tfoot th{
            font-size: 12px;
            line-height: 1px;
        }
        #page_content_inner {
            padding: 10px 10px 100px;
        }
        .uk-grid + .uk-grid, .uk-grid-margin, .uk-grid > * > .uk-panel + .uk-panel{
            margin-top: 0px;
        }
        .md-input-filled > label, .md-input-focus > label {
            top: -15px;
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('pos_invoice_update_measurements', ['id' => $invoice->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <input name="invoice_id" type="hidden" value="{{ $invoice->id }}">
                <input name="return_to_invoice" type="hidden" value="{{ $return_to_invoice }}">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_content">
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-3">
                                        <p style="margin-bottom: 5px;"><b>INV-{{ $invoice->invoice_number }}</b>, <b>TO-{{ $invoice->tailoring_order_number }}</b></p>
                                        <p style="margin-bottom: 5px; margin-top: 5px;">Date: {{ date('d-m-Y', strtotime($invoice->invoice_date)) }}</p>
                                    </div>
                                    
                                    <div class="uk-width-medium-1-3">
                                        <p style="margin-bottom: 5px;"><b>Customer Name</b></p>
                                        <p style="margin-bottom: 5px; margin-top: 5px;">{{ $invoice->customer->display_name }}</p>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="cusotmer_delivery">Delivery Date</label>
                                        <input class="md-input" type="text" id="cusotmer_delivery" name="cusotmer_delivery" 
                                                value="{{ isset($invoice->tailoring_customer_delivery) ? date('d-m-Y', strtotime($invoice->tailoring_customer_delivery)) 
                                                : Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>
                                </div>

                                <hr>
                                
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
                                        @foreach($invoice_entries as $entry)
                                            <tr>
                                                <td serial="0">
                                                    <input type="hidden" name="product_id[{{ $entry->id }}]" value="{{ $entry->item_id }}">
                                                    {{ $entry->item_name }}
                                                    <br>
                                                    <span class="uk-badge update" entry="{{ $entry->id }}">
                                                        <a data-toggle="uk-modal" data-uk-modal="{target:'#updateMeasurements-{{ $entry->id }}'}" id="measurement-modal-{{ $entry->id }}" type="button" class="sm-btn sm-btn-primary">Update Measurements</a>
                                                    </span>
                                                </td>
                                                <td>{{ $entry->quantity }}</td>
                                                <td>
                                                    <input type="text" name="send_to_master_date[{{ $entry->id }}]" class="md-input" value="{{ date('d-m-Y', strtotime($entry->send_master_date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                                </td>
                                                <td>
                                                    <input type="text" name="receive_from_master_date[{{ $entry->id }}]" value="{{ date('d-m-Y', strtotime($entry->receive_master_date)) }}" class="md-input" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                                </td>
                                                <td>
                                                    <select name="master[{{ $entry->id }}]" class="md-input select2-single-search-dropdown">
                                                        <option value="">SELECT MASTER</option>
                                                        @foreach($contacts as $master)
                                                            <option value="{{ $master->id }}" @if ($master->id == $entry->master_id) selected @endif>{{ $master->display_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="additional_notes[{{ $entry->id }}]" class="md-input" value="{{ $entry->additional_note }}">
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="submit" name="submit" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    @foreach($invoice_entries as $key => $product)
        <div class="uk-modal uk-modal-card-fullscreen" id="updateMeasurements-{{ $product->id }}" role="dialog">
            <div class="uk-modal-dialog uk-modal-dialog-blank" style="background-color: #fff">

                {!! Form::open(['url' => route('pos_invoice_update_temp_measurements'), 'method' => 'POST', 'class' => 'invoice_update_temp_measurements']) !!}
                
                    <input type="hidden" name="serial" value="{{ $key }}">
                    <input type="hidden" name="invoice_entries_id" value="{{ $product->id }}">

                    <div class="md-card uk-modal-body uk-height-viewport">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions">
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <button type="button" class="md-btn md-btn-flat uk-margin-remove uk-modal-close cancel">Cancel</button>
                                    <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Confirm</button>
                                </div>
                            </div>
                            <span class="md-icon material-icons uk-modal-close"></span>
                            <h3 class="md-card-toolbar-heading-text" style="text-align: center !important; float: none;/*! margin: 0 auto; */">
                                {{ $product->item_name }}
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <div class="uk-grid" data-uk-grid-margin>

                                    @php $color = '#b30008'; @endphp

                                    {{-- @for ($row = 1; $row <= $product->item->inventoryBodyMeasurements->max('row') ; $row++)

                                        @php $body_measurements = $product->item->inventoryBodyMeasurements->where('row', $row)->sortBy('serial') @endphp

                                        @foreach($body_measurements as $key => $bm)

                                            @php
                                                $body_measurement = $bm->BodyMeasurements;
                                                $body_measurement->value = $product->measurementValue($bm->body_measurements_id);
                                                if ($color == '#b30008') $color = '#868203';
                                                else $color = '#b30008';
                                                $data_array = explode(",", $body_measurement->bm_values ?? '');
                                            @endphp

                                            @if ($body_measurement != null)
                                                <div style="margin-bottom: 10px; width: 7%">
                                                    <input type="checkbox" id="measurement_checkbox_{{ $product->id }}_{{ $body_measurement->id }}" name="measurement_checkbox[{{ $body_measurement->id }}]" data-md-icheck value="1" style="display: inline;" @if(strlen($body_measurement->value) > 0) checked @else checked @endif>
                                                    <label for="measurement_checkbox[{{ $body_measurement->id }}]" style="font-size: 11px; color: {{ $color }}; display: inline">
                                                        {{ $body_measurement->en_title }}
                                                    </label>
                                                        
                                                    <input class="md-input uk-margin-top" list="measurement_{{ $body_measurement->id }}" name="measurement[{{ $body_measurement->id }}]" id="measurement0_{{ $product->id }}_{{ $body_measurement->id }}"
                                                        value="{{ $body_measurement->value }}" style="width: 100%; border: 1px solid #000; border-radius: 5px">
                                                    <datalist id="measurement_{{ $body_measurement->id }}">
                                                        @foreach($data_array as $data_array_tmp)
                                                            <option value="{{ $data_array_tmp }}">
                                                        @endforeach
                                                    </datalist>
                                                </div>
                                            @endif

                                        @endforeach
                                        
                                    </div>
                                <div class="uk-grid uk-margin-top" data-uk-grid-margin>

                                    @endfor --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="uk-modal-footer uk-text-right">
                        <button type="button" class="md-btn md-btn-flat uk-modal-close cancel">Cancel</button>
                        <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Confirm</button>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        altair_forms.parsley_validation_config();
    </script>

    <script type="text/javascript">
        $(document).on('submit', '.invoice_update_temp_measurements', function (event){
            event.preventDefault();
            var post_url = $(this).attr("action");
            var form_data = $(this).serialize();
            
            $.post(post_url, form_data, function(response) {
                $('.cancel').click();
            });
        });
    </script>

    <script type="text/javascript">
        $('#sidebar_invoice_measurements').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
