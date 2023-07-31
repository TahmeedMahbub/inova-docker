@extends('layouts.main')

@section('title', 'Sales Measurements')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        .uk-form-select{
            color:rgba(0, 0, 0, 0.8) !important;
        }
        .styled-select select {
            background: transparent;
            border: none;
            font-size: 18px;
            height: 29px;
            padding: 5px; /* If you add too much padding here, the options won't show in IE */
            width: 90%;

        }

        .styled-select.slate {
            /* background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center; */
            height: 34px;
            width: 240px;
            z-index: 10;
        }

        .styled-select.slate select {

            border-bottom: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 268px;
        }
        .styled-select.slate option{
            font-size: 16pt;

        }
        .slate { background-color: #ddd; }
        .slate select { color: #000; }

        tfoot tr th div.md-input-wrapper input.md-input {
            border: 1px solid rgba(0,0,0,.12);
            padding: 10px 8px;
        }

        tfoot tr th div.md-input-wrapper {
            width: 95%;
        }

        @media screen and (-webkit-min-device-pixel-ratio:0)
        {
            .styled-select.slate {
                background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;

            }
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">

                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Sales Measurements</span>
                                </h2>
                            </div>
                            <div class="uk-width-medium-1-1" style="text-align: right; right: 10px; position: absolute; top:10px;">
                                <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-deep-orange-400 finddata" href="{{ route('report_account_measurement_ledger') }}">Measurements Report</a>
                            </div>
                        </div>

                        <?php
                            $helper = new \App\Lib\Helpers;
                        ?>

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div class="filter_table"></div>
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                        <tr>
                                            <th width="7%">SL</th>
                                            <th>Date</th>
                                            <th>Order</th>
                                            <th>Customer Name</th>
                                            <th>Delivery</th>
                                            <th>Item - Quantity</th>
                                            <th>Status</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th width="7%">SL</th>
                                            <th>Date</th>
                                            <th>Order</th>
                                            <th>Customer Name</th>
                                            <th>Delivery</th>
                                            <th>Item - Quantity</th>
                                            <th>Status</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php $i = 1;?>
                                        @foreach($data as $invoice)
                                            @php
                                                $item_names = explode(',', $invoice->item_names);
                                                $item_quantities = explode(',', $invoice->item_quantities);
                                                $items = [];
                                                foreach ($item_names as $key => $item_name) {
                                                    $items[$key]['name'] = $item_name;
                                                    $items[$key]['quantity'] = $item_quantities[$key];
                                                }
                                            @endphp
                                            <tr>
                                                <td width="7%">{{ $i++ }}</td>
                                                <td>{{date('d-m-Y', strtotime($invoice->invoice_date)) }}</td>
                                                <td>{{ $invoice->tailoring_order_number > 0 ? 'TO-' . $invoice->tailoring_order_number . ', ' : '' }} 
                                                    INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}
                                                </td>
                                                <td>{{ $invoice->phone_number_1 . ', ' . $invoice->customer }} </td>
                                                <td>{{ isset($invoice->tailoring_customer_delivery) ? date('d-m-Y', strtotime($invoice->tailoring_customer_delivery)) : '' }}</td>
                                                <td>
                                                    @foreach ($items as $item)
                                                        {{ $item['name'] }} - {{ $item['quantity'] }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <select class="sales_measurement_status md-input" style="color: #fff" data-invoice="{{ $invoice->id }}">
                                                        <option selected="" disabled="">Select...</option>
                                                        <option value="2" {{ $invoice->status == 2 ? 'selected' : '' }} class="uk-text-bold" style="color: #e53935">Incomplete</option>
                                                        <option value="1" {{ $invoice->status == 1 ? 'selected' : '' }} class="uk-text-bold" style="color: #ffa000">Completed</option>
                                                        <option value="3" {{ $invoice->status == 3 ? 'selected' : '' }} class="uk-text-bold" style="color: #7cb342">Delivered</option>
                                                    </select>
                                                </td>

                                                <td class="uk-text-center" style="white-space:nowrap !important;">
                                                    <a href="{{ route('invoice_send_message', ['id' => $invoice->id]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Send Message to Customer" class="material-icons md-icon">textsms</i>
                                                    </a>
                                                    <!-- <a data-uk-tooltip="{pos:'top'}" title="Send Message to Customer" class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light md-bg-light-blue-400 finddata" href="{{ route('invoice_send_message', $invoice->id) }}">Send Message</a> -->
                                                    <a href="{{ route('invoice_show_measurements', ['id' => $invoice->id]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="View Measurements" class="material-icons md-icon">picture_as_pdf</i>
                                                    </a>
                                                    <a href="{{ route('invoice_edit_measurements', ['id' => $invoice->id]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Edit Measurements" class="material-icons md-icon">straighten</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('invoice_add_measurements') }}" class="md-fab md-fab-accent branch-create">
                                    <i class="material-icons">&#xE145;</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#sidebar_invoice_measurements').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $('#tiktok_account').trigger('click');
        })

        $(document).ready(function() {
            $('.dt-uikit-footer').append($('.dt_colVis_buttons'));
            $('.filter_table').append($('tfoot'));

            var sm_status = $('.sales_measurement_status');
            for (var i = 0 ; i < sm_status.length ; i++) {
                if ($(sm_status[i]).val() == 1) {
                    $(sm_status[i]).css('color', '#ffa000');
                }
                else if($(sm_status[i]).val() == 2) {
                    $(sm_status[i]).css('color', '#e53935');
                }
                else if($(sm_status[i]).val() == 3) {
                    $(sm_status[i]).css('color', '#7cb342');
                }
                else {
                    $(sm_status[i]).css('color', 'unset');
                }
            }
        });

        $(document).on('change', '.sales_measurement_status', function() {
            var id = $(this).data('invoice');
            var sm_status = $('.sales_measurement_status');
            sm_status.css('opacity', '.1');
            sm_status.prop('disabled');
            console.log(sm_status);
            $.ajax({
                url: '{{ url('invoice-measurements/change-status') }}/'+id,
                type: 'GET',
                data: {
                    status: $(this).val()
                }
            })
            .done(function(success) {
                if (sm_status.val() == 1) {
                    sm_status.css('color', '#ffa000');
                }
                else if(sm_status.val() == 2) {
                    sm_status.css('color', '#e53935');
                }
                else {
                    sm_status.css('color', '#7cb342');
                }
                sm_status.css('opacity', '1');
            })
            .fail(function() {
                console.log("error");
            });
            
        });

    </script>
@endsection
