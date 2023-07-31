@extends('layouts.main')

@section('title', 'Distributor Sales')

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
                            'url' => route('distributor_sales_update', ['id' => $invoice->id]),
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Distributor Sales</span></h2>
                            </div>
                        </div>

                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <label for="invoice_number">Invoice Number</label>
                                        <input type="text" class="md-input" id="invoice_number" name="invoice_number"
                                            value="{{ str_pad($invoice->sales_number, 6, '0', STR_PAD_LEFT) }}"
                                            readonly />
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="distributor_id">Distributor</label> <br>
                                        <select class="md-input select2-single-search-dropdown" title="Select distributor"
                                            id="distributor_id" name="distributor_id">
                                            <option value="">Select Distributor</option>
                                            @foreach ($distributors as $distributor)
                                                <option value="{{ $distributor->id }}"
                                                    {{ $distributor->id == $invoice->seller_id ? 'selected' : '' }}>
                                                    {{ $distributor->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="customer_id">Retailer</label> <br>
                                        <select class="md-input select2-single-search-dropdown" title="Select Distributor"
                                            id="customer_id" name="customer_id">
                                            <option value="">Select Retailer</option>
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
                                </div>

                                <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="input_fields_wrap uk-table">
                                            <thead>
                                                <tr>
                                                    <th class="uk-text-nowrap">#</th>
                                                    <th class="uk-text-nowrap">Description</th>
                                                    <th class="uk-text-nowrap">Amount<span style="color: red;"
                                                            class="asterisc">*</span></th>
                                                </tr>
                                            </thead>

                                            <tbody class="getMultipleRow">
                                                <tr class="tr_0" id="data_clone">
                                                    <td>
                                                        <p style="padding-top: 10px">1</p>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="description_0"
                                                            class="md-input description" name="description"
                                                            value="{{ $invoice->description }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="amount_0" name="amount"
                                                            class="md-input amount" value="{{ $invoice->amount }}"
                                                            oninput="calculateActualAmount(0)" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2 uk-margin-small-top uk-margin-medium-bottom">
                                    </div>

                                    <div class="uk-width-medium-1-2 uk-overflow-container">
                                        <table class="uk-table">
                                            <tbody>
                                                <tr>
                                                    <td style="border-color: white" colspan="3"></td>
                                                    <td>Sub Total</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="text-align: right">
                                                        <a style="border: none;text-decoration: none;color: black"
                                                            id="subTotalShow">0.00</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-color: white" colspan="3"></td>
                                                    <td>Discount</td>
                                                    <td style="width: 10%;">
                                                        <div class="md-input-wrapper md-input-filled"><select
                                                                style="padding-top: 19px;" class="md-input adjustment_type"
                                                                id="adjustment_type" name="adjustment_type"
                                                                onchange="calculateActualAmount(0)">
                                                                <option value="0" {{ $invoice->adjustment_type == 0 ? 'selected' : '' }}>BDT</option>
                                                                <option value="1" {{ $invoice->adjustment_type == 1 ? 'selected' : '' }}>%</option>
                                                            </select><span class="md-input-bar "></span></div>
                                                    </td>
                                                    <td colspan="3">
                                                        <div class="md-input-wrapper md-input-filled"><input
                                                                type="text" id="adjustment" name="adjustment"
                                                                class="md-input md-input-width-medium" value="{{ $invoice->adjustment }}"
                                                                oninput="calculateActualAmount(0)"><span
                                                                class="md-input-bar "></span></div>
                                                    </td>
                                                    <td style="text-align: right">
                                                        <a style="border: none;text-decoration: none;color: black"
                                                            id="adjustmentShow">0.00</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-color: white" colspan="3"></td>
                                                    <td> Vat/Tax (%)</td>
                                                    <td colspan="4">
                                                        <input type="text" id="vat"
                                                            class="md-input md-input-width-medium" value="{{ ($invoice->amount - ($invoice->adjustment_type == 0 ? $invoice->adjustment : $invoice->amount * $invoice->adjustment / 100)) / $invoice->tax_total }}"
                                                            oninput="calculateActualAmount(0)" />
                                                    </td>
                                                    <td style="text-align: right">
                                                        <a style="border: none;text-decoration: none;color: black"
                                                            id="vatShow">0.00</a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="border-color: white" colspan="3"></td>
                                                    <td>Shipping Charges</td>
                                                    <td colspan="4">
                                                        <input type="text" id="shippingCharge" name="shipping_charge"
                                                            class="md-input md-input-width-medium" value="{{  $invoice->shipping_charge }}"
                                                            oninput="calculateActualAmount(0)" />
                                                    </td>
                                                    <td style="text-align: right">
                                                        <a style="border: none;text-decoration: none;color: black"
                                                            id="shippingChargeShow">0.00</a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="border-color: white" colspan="3"></td>
                                                    <th colspan="5">Total(BDT)</th>
                                                    <th style="text-align: right">
                                                        <a style="border: none;text-decoration: none;color: black"
                                                            id="totalAmountShow">0.00</a>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" id="subTotal" name="sub_total">
                                        <input type="hidden" id="totalAmount" name="total_amount">
                                        <input type="hidden" id="vat_total" name="tax_total">
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

        $('#document').ready(function() {
            calculateActualAmount(0);
        });

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_distributor_sales').addClass('act_item');

        $(window).load(function() {
            $("#tiktok_account").trigger('click');

        });       

        function calculateActualAmount(x) {
            var subTotal = $("#subTotal").val();
            var adjustment = $("#adjustment").val();
            var vat = $("#vat").val();
            var shippingCharge = $("#shippingCharge").val();

            var subTotal = 0;

            $('.amount').each(function() {
                subTotal += parseFloat($(this).val());
            });

            //Calculating Subtotal Amount end
            $("#subTotalShow").html(subTotal);
            $("#subTotal").val(subTotal);

            console.log(adjustment);

            if (adjustment == '0.00' || adjustment == '') {
                var adjustment_value = 0;
                var adjustment_show = 0;
            } else {
                var adjustment_value = $('#adjustment_type').val() == 1 ? subTotal * adjustment / 100 : adjustment;
                var adjustment_show = parseFloat(subTotal) - parseFloat(adjustment_value);
            }

            if (vat == '' || vat == 0.00) {
                var vat_val = 0;
                var vat_show = 0;
                var vat_cal = 0;
            } else {
                var vat_val = vat;
                var vat_cal = ((parseFloat(subTotal) - parseFloat(adjustment_value)) * parseFloat(vat_val)) / 100;
                var vat_show = parseFloat(vat_cal) + parseFloat(subTotal);
            }
            if (shippingCharge == '' || shippingCharge == 0.00) {
                var shippingCharge_val = 0;
                var shippingCharge_show = 0;
            } else {
                var shippingCharge_val = shippingCharge;
                var shippingCharge_show = parseFloat(shippingCharge_val) + parseFloat(vat_cal) + parseFloat(subTotal) -
                    parseFloat(adjustment_value);
            }

            var total_amount = parseFloat(shippingCharge_val) + parseFloat(vat_cal) + parseFloat(subTotal)- parseFloat(adjustment_value);

            $("#adjustmentShow").html(-adjustment_value);
            $("#vatShow").html(vat_cal);
            $("#vat_total").val(vat_cal);
            $("#shippingChargeShow").html(shippingCharge_val);
            $("#totalAmountShow").html(total_amount.toFixed(2));
            $("#totalAmount").val(total_amount.toFixed(2));
        }

    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
