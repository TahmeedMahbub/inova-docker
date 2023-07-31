@extends('layouts.main')

@section('title', 'Create Sales Return')

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
            height: 320px;
            overflow-y: scroll;
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
    </style>
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('sales_return_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 
                'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}

                <div class="uk-grid">
                    <div class="uk-width-medium-1-3">
                         <select  class="md-input select2-single-search-dropdown" title="Select Customer" id="customer_id" name="customer_id" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{  $customer->phone_number_1 . ', ' . $customer->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <br>

                <div class="uk-grid">
                    <div class="uk-width-medium-1-3">
                         <select  class="md-input select2-single-search-dropdown" title="Select Invoice" id="invoice_id" name="invoice_id" required>
                            <option value="">Select Invoice</option>
                        </select>
                    </div>
                </div>

                <br>

                <div class="uk-grid">
                    <div class="uk-width-medium-1-3">
                         <select  class="md-input select2-single-search-dropdown" title="Select Product" id="product_id" name="product_id" required>
                            <option value="">Select Product</option>
                        </select>
                    </div>
                </div>

                <br>

                <div class="uk-grid">
                    <div class="uk-width-medium-1-3">
                        <label for="quantity">Quantity (<span style="color: red;">Available Quantity: <span id="max-quantity-text">0</span></span>)</label>
                        <input class="md-input" type="number" name="quantity" max="0" min="0" id="quantity">
                    </div>

                    <input type="hidden" id="max-quantity" name="max_quantity" value="0">
                </div>

                <br>

                <div class="uk-grid">
                    <div class="uk-width-medium-1-3">
                        <input class="md-input" type="submit" value="Sales Return" name="submit"> or,
                        <input class="md-input" type="submit" value="Return and Refund in Cash" name="submit">
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
        $('#sidebar_credit_note').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })

        $('#customer_id').on('select2:select', function() {
            $('#invoice_id').empty();
            $('#invoice_id').append('<option value="">Select Invoice</option>');

            customer_id = $('#customer_id').val();
            $.get('/sales-return/ajax/invoices/' + customer_id, function( data ) {
                invoices = JSON.parse(data);
                invoices.forEach(function(invoice, index) {
                    $('#invoice_id').append('<option value="' + invoice.id + '">' + invoice.invoice_date + ' ' + invoice.invoice_number + '</option>');
                });
                $('#invoice_id').select2();
            });
        });

        $('#invoice_id').on('select2:select', function() {
            $('#product_id').empty();
            $('#product_id').append('<option value="">Select Product</option>');

            invoice_id = $('#invoice_id').val();
            $.get('/sales-return/ajax/products/' + invoice_id, function( data ) {
                products = JSON.parse(data);
                products.forEach(function(product, index) {
                    $('#product_id').append('<option value="' + product.id + '">' + product.barcode_no + ', ' + product.item_name + '</option>');
                });
                $('#product_id').select2();
            });
        });

        $('#product_id').on('select2:select', function() {
            $('#quantity').attr('max', 0);

            invoice_id = $('#invoice_id').val();
            product_id = $('#product_id').val();
            $.get('/sales-return/ajax/quantity/' + invoice_id + '/' + product_id, function( data ) {
                $('#max-quantity-text').html(data);
                $('#max-quantity').val(data);
                $('#quantity').attr('max', data);
            });
        });
    </script>
@endsection