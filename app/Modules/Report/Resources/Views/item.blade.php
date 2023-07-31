@extends('layouts.admin')

@section('title', 'Item Report '.date("Y-m-d h-i-sa"))

@section('header')
@include('inc.header')
@endsection

@section('sidebar')
@include('inc.sidebar')
@endsection

@section('styles')
<style>
    @media print {
        a[href]:after {
            content: "" !important;

        }

        a {
            text-decoration: none;
        }

        .uk-table tr td {
            white-space: nowrap;
            padding: 1px 0px;
            border: none !important;
            width: 100%;
            font-size: 11px !important;
        }

        .uk-table tr td:first-child,
        .uk-table tr th:first-child {
            text-align: left !important;
        }

        .uk-table tr th,
        .uk-table:last-child tr td {

            white-space: nowrap;
            padding: 1px 5px;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width: 100%;
            font-size: 11px !important;
        }

        body {
            margin-top: -40px;
        }
    }
</style>
@endsection

@section('content_header')
<div id="top_bar">
    <div class="md-top-bar">
        <ul id="menu_top" class="uk-clearfix">
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Reports</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li>Business Overview</li>
                        <li><a href="{{route('report_account_profit_loss')}}">Profit and Loss</a></li>
                        <li><a href="{{route('report_account_cash_flow_statement')}}">Cash Flow Statement</a></li>
                        <li><a href="{{route('report_account_balance_sheet')}}">Balance Sheet</a></li>
                        <li>Accountant</li>
                        <li><a href="{{route('report_account_transactions')}}">Account Transactions</a></li>
                        <li><a href="{{route('report_account_general_ledger_search')}}">General Ledger</a></li>
                        <li><a href="{{route('report_account_journal_search')}}">Journal Report</a></li>
                        <li><a href="{{route('report_account_trial_balance_search')}}">Trial Balance</a></li>
                        <li>Sales</li>
                        <li><a href="{{route('report_account_customer')}}">Sales by Customer</a></li>
                        <li><a href="">Sales by Item</a></li>
                        <li><a href="{{route('report_account_item')}}">Product Report</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="uk-width-medium-10-10 uk-container-center reset-print">
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-large-10-10">

            <div class="md-card md-card-single hidden-print">
                <div id="invoice_preview">
                    <div class="md-card-content invoice_content print_bg" style="height: 100%;">
                        {!! Form::open(['url' => route('report_account_item_filter'), 'method' => 'get', 'class' =>
                        'user_edit_form', 'id' => 'my_profile', 'novalidate']) !!}
                        <div class="uk-grid hidden-print" data-uk-grid-margin="">
                            <div class="uk-width-medium-1-5">
                                <div class="md-input-wrapper md-input-filled">
                                    <label for="branch_id">Branch</label>
                                    <select name="branch_id" id="branch_id" class="md-input selectable">
                                        <option selected disabled value="">Select Branch</option>
                                        @foreach($branches as $key => $value)
                                        <option value="{{ $value->id }}" @if(isset($branch) && $branch->id ==
                                            $value->id) selected @endif>{{ $value->branch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <label for="start">From</label>
                                <input class="md-input" type="text" id="start" name="start"
                                    value="{{ date('d-m-Y', strtotime($start)) }}"
                                    data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <label for="end">To</label>
                                <input class="md-input" type="text" id="end" name="end"
                                    value="{{ date('d-m-Y', strtotime($end)) }}"
                                    data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <div class="md-input-wrapper md-input-filled">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="md-input selectable">
                                        <option selected value="0">All</option>
                                        @foreach($categories as $key => $value)
                                        <option value="{{ $value->id }}" @if(isset($category) && $category->id ==
                                            $value->id) selected @endif>{{ $value->item_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <div class="md-input-wrapper md-input-filled">
                                    <label for="item_id">Product</label>
                                    <select name="item_id" id="item_id"
                                        class="md-input selectable select2-single-search-dropdown"
                                        style="margin-top: 10px;">
                                        <option selected value="0">All</option>
                                        @foreach($items as $key => $value)
                                        <option value="{{ $value->id }}" @if(isset($item) && $item->id == $value->id)
                                            selected @endif>{{ $value->barcode_no . ', ' .
                                            $value->item_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-1">
                                <input type="checkbox" name="hide_0" {{ isset($_GET['hide_0']) ? 'checked' : '' }}>
                                <label>Don't Show Items if Total Purchase & Total Sales are 0</label>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <button type="submit" class="md-btn md-btn-primary">Filter</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                </div>
            </div>

            @if (isset($data))

            <div class="md-card md-card-single main-print">
                <div class="md-card-toolbar-actions hidden-print" style="width: 100%">
                    <i class="md-icon material-icons" id="invoice_print"></i>
                </div>
                <div class="md-card-content invoice_content print_bg" style="height: 100%;">
                    <div class="uk-grid">
                        <div class="uk-width-small-5-5 uk-text-center">
                            <img style="margin-bottom: -20px;" class="logo_regular"
                                src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71" />
                            <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{
                                $OrganizationProfile->company_name }}</p>
                            <p style="line-height: 5px;" class="heading_b">Item Report</p>
                            <p style="line-height: 5px;" class="uk-text-small">{{ $branch->branch_name }}</p>
                            <p style="line-height: 5px;" class="uk-text-small">From {{ date('d-m-Y', strtotime($start))
                                }} To {{ date('d-m-Y', strtotime($end))}}</p>
                        </div>
                    </div>
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <table class="uk-table">

                                <thead>
                                    <tr class="uk-text-upper">
                                        <th class="uk-text-left">Item Name</th>
                                        <th class="uk-text-right">Opening Stock</th>
                                        <th class="uk-text-right">Total Purchase</th>
                                        <th class="uk-text-right">Transferred Stock</th>
                                        <th class="uk-text-right">Total Sales</th>
                                        <th class="uk-text-right">Stock In Hand</th>
                                        <th class="uk-text-right">Purchase Amount</th>
                                        <th class="uk-text-right">Sales Amount</th>
                                        <th class="uk-text-right">Equivalent Purchase</th>
                                        <th class="uk-text-right">Profit</th>
                                        <th class="uk-text-right">Stock Value</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $opening_sum            = 0;
                                        $purchases_sum          = 0;
                                        $transferred_stock_sum  = 0;
                                        $sales_sum              = 0;
                                        $purchases_amount_sum   = 0;
                                        $sales_amount_sum       = 0;
                                        $stock_sum              = 0;
                                        $profit_amount_sum      = 0;
                                        $stock_value_sum        = 0;
                                        $equivalent_amount_sum  = 0;
                                    ?>

                                    @foreach($data as $key => $value)

                                    @php
                                    $total_stock = $value['opening_stock'] + $value['total_purchases'] -
                                    $value['total_sales'] + $value['transferred_stock'];
                                    $stock_value = $value['item_purchase_rate'] * $total_stock;

                                    $value['equivalent_purchase']= ($value['item_purchase_rate'] *
                                    $value['opening_stock']) + $value['purchase_amount'] - $stock_value;
                                    $profit = $value['sales_amount'] - $value['equivalent_purchase'];
                                    @endphp

                                    <tr class="uk-table-middle">
                                        <td style="display: none;">{{ $value['sub_cat_id'] }}</td>
                                        <td style="display: none;">{{ $value['cat_id'] }}</td>
                                        <td class="uk-text-left">
                                            <a title="{{ $value['item_name'] }}"
                                                href="{{ route('report_account_item_details', [$value['item_id'], $branch->id, $start, $end])}}">
                                                {{ $value['barcode_no'] . ', ' .
                                                $value['item_name'] }}
                                            </a>
                                        </td>
                                        <td class="uk-text-right">{{ $value['opening_stock'] }}</td>
                                        <td class="uk-text-right">{{ $value['total_purchases'] }}</td>
                                        <td class="uk-text-right">{{ $value['transferred_stock'] }}</td>
                                        <td class="uk-text-right">{{ $value['total_sales'] }}</td>
                                        <td class="uk-text-right">{{ $total_stock }}</td>
                                        <td class="uk-text-right">{{ $value['purchase_amount'] }}</td>
                                        <td class="uk-text-right">{{ $value['sales_amount'] }}</td>
                                        <td class="uk-text-right">{{ $value['equivalent_purchase'] }}</td>
                                        <td class="uk-text-right">{{ $profit }}</td>
                                        <td class="uk-text-right">{{ $stock_value }}</td>
                                    </tr>

                                    <?php
                                        $equivalent_amount_sum  = $equivalent_amount_sum + $value['equivalent_purchase'];
                                        $opening_sum            = $opening_sum + $value['opening_stock'];
                                        $purchases_sum          = $purchases_sum + $value['total_purchases'];
                                        $sales_sum              = $sales_sum + $value['total_sales'];
                                        $purchases_amount_sum   = $purchases_amount_sum + $value['purchase_amount'];
                                        $sales_amount_sum       = $sales_amount_sum + $value['sales_amount'];
                                        $stock_sum              = $stock_sum + $total_stock;
                                        $profit_amount_sum      = $profit_amount_sum + $profit;
                                        $stock_value_sum        = $stock_value_sum + $stock_value;
                                        $transferred_stock_sum += $value['transferred_stock'];
                                    ?>

                                    @endforeach

                                    <tr id="itemTotalValue">
                                        <td style="font-weight: bold;color: black" class="uk-text-right">Total</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalOpeningStock">{{ $opening_sum }}</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalPurchaseQty">{{ $purchases_sum }}</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalPurchaseQty">{{ $transferred_stock_sum }}</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalSalesQty">{{ $sales_sum }}</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalStockQty">{{ $stock_sum }}</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalPurchaseAmount">{{ $purchases_amount_sum }}</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalSalesAmount">{{ $sales_amount_sum }}</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalEquivalentAmount">{{ $equivalent_amount_sum }}</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalProfitAmount">{{ $profit_amount_sum }}</td>
                                        <td style="font-weight: bold;color: black" class="uk-text-right"
                                            id="totalStockValueAmount">{{ $stock_value_sum }}</td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
                        </div>
                    </div>
                </div>
            </div>

            @endif

        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- handlebars.js -->
<script src="{{ url('admin/bower_components/handlebars/handlebars.min.js')}}"></script>
<script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js')}}"></script>

<!--  invoices functions -->
<script src="{{ url('admin/assets/js/pages/page_invoices.min.js')}}"></script>
<script type="text/javascript">
    $('#category_id').on('change', function() {
            var category_id = $(this).val();
            @foreach($categories as $category)
            if (category_id == {{ $category->id }}) {
                @php $cat_items = $items->where('item_category_id', $category->id); @endphp
                $('#item_id').empty();
                $('#item_id').append('<option selected value="0">All</option>');
                @foreach($cat_items as $key => $value)
                $('#item_id').append('<option value="{{ $value->id }}" @if(isset($item) && $item->id == $value->id) selected @endif>{{ str_pad($value->id, 6, "0", STR_PAD_LEFT) . ', ' . $value->item_name }}</option>');
                @endforeach
            }
            @endforeach
        });

        //Dropdown Item Name Search by Category
        $("#item_category").on('change',function () {

            var sub_cat_id = $(this).val();


            $("#totalPurchaseQty").empty();
            $("#totalSalesQty").empty();
            $("#totalStockQty").empty();
            $("#totalPurchaseAmount").empty();
            $("#totalSalesAmount").empty();
            $("#totalProfitAmount").empty();
            $("#totalStockValueAmount").empty();
            $("#totalOpeningStock").empty();
            $("#totalEquivalentAmount").empty();

            // Declare variables
            var  filter, table, tr, td, i, item_total, total_purchase_qty, purchase_qty, total_sales_qty, sales_qty, total_stock_in_hand, stock_in_hand_qty, total_purchase_amount, purchase_amount, total_sales_amount, sales_amount, total_profit, profit, total_stock_value, stock_value, total_opening_stock,
                total_equivalent_amount, opening_stock, equivalent_amount;

            total_purchase_qty      = 0;
            purchase_qty            = 0;
            total_sales_qty         = 0;
            sales_qty               = 0;
            total_stock_in_hand     = 0;
            stock_in_hand_qty       = 0;
            total_purchase_amount   = 0;
            purchase_amount         = 0;
            total_sales_amount      = 0;
            sales_amount            = 0;
            total_profit            = 0;
            profit                  = 0;
            total_stock_value       = 0;
            stock_value             = 0;

            opening_stock           = 0;
            equivalent_amount       = 0;
            total_opening_stock     = 0;
            total_equivalent_amount = 0;

            filter      = sub_cat_id;
            table       = document.getElementById("showItemFilterTable");
            item_total  = document.getElementById("itemTotalValue");

            tr = table.getElementsByTagName("tr");

            if(filter == 'all')
            {
                for (i = 0; i < tr.length; i++) {

                    td                          = tr[i].getElementsByTagName("td")[0];
                    purchase_qty                = tr[i].getElementsByTagName("td")[3];
                    sales_qty                   = tr[i].getElementsByTagName("td")[4];
                    stock_in_hand_qty           = tr[i].getElementsByTagName("td")[5];
                    purchase_amount             = tr[i].getElementsByTagName("td")[6];
                    sales_amount                = tr[i].getElementsByTagName("td")[7];
                    profit                      = tr[i].getElementsByTagName("td")[9];
                    stock_value                 = tr[i].getElementsByTagName("td")[10];

                    opening_stock               = tr[i].getElementsByTagName("td")[2];
                    equivalent_amount           = tr[i].getElementsByTagName("td")[8];

                    if (td) {

                        tr[i].style.display     = "";

                        total_purchase_qty      += parseFloat(purchase_qty.innerHTML);
                        total_sales_qty         += parseFloat(sales_qty.innerHTML);
                        total_stock_in_hand     += parseFloat(stock_in_hand_qty.innerHTML);
                        total_purchase_amount   += parseFloat(purchase_amount.innerHTML);
                        total_sales_amount      += parseFloat(sales_amount.innerHTML);
                        total_profit            += parseFloat(profit.innerHTML);
                        total_stock_value       += parseFloat(stock_value.innerHTML);

                        total_opening_stock     += parseFloat(opening_stock.innerHTML);
                        total_equivalent_amount += parseFloat(equivalent_amount.innerHTML);
                    }
                }

                $("#totalPurchaseQty").html(total_purchase_qty);
                $("#totalSalesQty").html(total_sales_qty);
                $("#totalStockQty").html(total_stock_in_hand);
                $("#totalPurchaseAmount").html(total_purchase_amount);
                $("#totalSalesAmount").html(total_sales_amount);
                $("#totalProfitAmount").html(total_profit);
                $("#totalStockValueAmount").html(total_stock_value);

                $("#totalOpeningStock").html(total_opening_stock);
                $("#totalEquivalentAmount").html(total_equivalent_amount);

                return false;
            }
            else
            {
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {

                    td                          = tr[i].getElementsByTagName("td")[0];
                    purchase_qty                = tr[i].getElementsByTagName("td")[2];
                    sales_qty                   = tr[i].getElementsByTagName("td")[3];
                    stock_in_hand_qty           = tr[i].getElementsByTagName("td")[4];
                    purchase_amount             = tr[i].getElementsByTagName("td")[5];
                    sales_amount                = tr[i].getElementsByTagName("td")[6];
                    profit                      = tr[i].getElementsByTagName("td")[7];
                    stock_value                 = tr[i].getElementsByTagName("td")[8];

                    if (td) {

                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display     = "";
                            tr[i].style.display     = "";
                            total_purchase_qty      += parseFloat(purchase_qty.innerHTML);
                            total_sales_qty         += parseFloat(sales_qty.innerHTML);
                            total_stock_in_hand     += parseFloat(stock_in_hand_qty.innerHTML);
                            total_purchase_amount   += parseFloat(purchase_amount.innerHTML);
                            total_sales_amount      += parseFloat(sales_amount.innerHTML);
                            total_profit            += parseFloat(profit.innerHTML);
                            total_stock_value       += parseFloat(stock_value.innerHTML);
                        } else {
                            tr[i].style.display         = "none";
                            item_total.style.display    = "";
                        }
                    }
                }

                $("#totalPurchaseQty").html(total_purchase_qty);
                $("#totalSalesQty").html(total_sales_qty);
                $("#totalStockQty").html(total_stock_in_hand);
                $("#totalPurchaseAmount").html(total_purchase_amount);
                $("#totalSalesAmount").html(total_sales_amount);
                $("#totalProfitAmount").html(total_profit);
                $("#totalStockValueAmount").html(total_stock_value);
            }

        });
        
        //Dropdown Item Name Search by Sub Category
        $("#item_sub_category").on('change',function () {

            var sub_cat_id = $(this).val();


            $("#totalPurchaseQty").empty();
            $("#totalSalesQty").empty();
            $("#totalStockQty").empty();
            $("#totalPurchaseAmount").empty();
            $("#totalSalesAmount").empty();
            $("#totalProfitAmount").empty();
            $("#totalStockValueAmount").empty();
            $("#totalOpeningStock").empty();
            $("#totalEquivalentAmount").empty();

            // Declare variables
            var  filter, table, tr, td, i, item_total, total_purchase_qty, purchase_qty, total_sales_qty, sales_qty, total_stock_in_hand, stock_in_hand_qty, total_purchase_amount, purchase_amount, total_sales_amount, sales_amount, total_profit, profit, total_stock_value, stock_value, total_opening_stock,
                total_equivalent_amount, opening_stock, equivalent_amount;

            total_purchase_qty      = 0;
            purchase_qty            = 0;
            total_sales_qty         = 0;
            sales_qty               = 0;
            total_stock_in_hand     = 0;
            stock_in_hand_qty       = 0;
            total_purchase_amount   = 0;
            purchase_amount         = 0;
            total_sales_amount      = 0;
            sales_amount            = 0;
            total_profit            = 0;
            profit                  = 0;
            total_stock_value       = 0;
            stock_value             = 0;

            opening_stock           = 0;
            equivalent_amount       = 0;
            total_opening_stock     = 0;
            total_equivalent_amount = 0;

            filter      = sub_cat_id;
            table       = document.getElementById("showItemFilterTable");
            item_total  = document.getElementById("itemTotalValue");

            tr = table.getElementsByTagName("tr");

            if(filter == 'all')
            {
                for (i = 0; i < tr.length; i++) {

                    td                          = tr[i].getElementsByTagName("td")[0];
                    purchase_qty                = tr[i].getElementsByTagName("td")[3];
                    sales_qty                   = tr[i].getElementsByTagName("td")[4];
                    stock_in_hand_qty           = tr[i].getElementsByTagName("td")[5];
                    purchase_amount             = tr[i].getElementsByTagName("td")[6];
                    sales_amount                = tr[i].getElementsByTagName("td")[7];
                    profit                      = tr[i].getElementsByTagName("td")[9];
                    stock_value                 = tr[i].getElementsByTagName("td")[10];

                    opening_stock               = tr[i].getElementsByTagName("td")[2];
                    equivalent_amount           = tr[i].getElementsByTagName("td")[8];

                    if (td) {

                        tr[i].style.display     = "";

                        total_purchase_qty      += parseFloat(purchase_qty.innerHTML);
                        total_sales_qty         += parseFloat(sales_qty.innerHTML);
                        total_stock_in_hand     += parseFloat(stock_in_hand_qty.innerHTML);
                        total_purchase_amount   += parseFloat(purchase_amount.innerHTML);
                        total_sales_amount      += parseFloat(sales_amount.innerHTML);
                        total_profit            += parseFloat(profit.innerHTML);
                        total_stock_value       += parseFloat(stock_value.innerHTML);

                        total_opening_stock     += parseFloat(opening_stock.innerHTML);
                        total_equivalent_amount += parseFloat(equivalent_amount.innerHTML);
                    }
                }

                $("#totalPurchaseQty").html(total_purchase_qty);
                $("#totalSalesQty").html(total_sales_qty);
                $("#totalStockQty").html(total_stock_in_hand);
                $("#totalPurchaseAmount").html(total_purchase_amount);
                $("#totalSalesAmount").html(total_sales_amount);
                $("#totalProfitAmount").html(total_profit);
                $("#totalStockValueAmount").html(total_stock_value);

                $("#totalOpeningStock").html(total_opening_stock);
                $("#totalEquivalentAmount").html(total_equivalent_amount);

                return false;
            }
            else
            {
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {

                    td                          = tr[i].getElementsByTagName("td")[0];
                    purchase_qty                = tr[i].getElementsByTagName("td")[2];
                    sales_qty                   = tr[i].getElementsByTagName("td")[3];
                    stock_in_hand_qty           = tr[i].getElementsByTagName("td")[4];
                    purchase_amount             = tr[i].getElementsByTagName("td")[5];
                    sales_amount                = tr[i].getElementsByTagName("td")[6];
                    profit                      = tr[i].getElementsByTagName("td")[7];
                    stock_value                 = tr[i].getElementsByTagName("td")[8];

                    if (td) {

                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display     = "";
                            tr[i].style.display     = "";
                            total_purchase_qty      += parseFloat(purchase_qty.innerHTML);
                            total_sales_qty         += parseFloat(sales_qty.innerHTML);
                            total_stock_in_hand     += parseFloat(stock_in_hand_qty.innerHTML);
                            total_purchase_amount   += parseFloat(purchase_amount.innerHTML);
                            total_sales_amount      += parseFloat(sales_amount.innerHTML);
                            total_profit            += parseFloat(profit.innerHTML);
                            total_stock_value       += parseFloat(stock_value.innerHTML);
                        } else {
                            tr[i].style.display         = "none";
                            item_total.style.display    = "";
                        }
                    }
                }

                $("#totalPurchaseQty").html(total_purchase_qty);
                $("#totalSalesQty").html(total_sales_qty);
                $("#totalStockQty").html(total_stock_in_hand);
                $("#totalPurchaseAmount").html(total_purchase_amount);
                $("#totalSalesAmount").html(total_sales_amount);
                $("#totalProfitAmount").html(total_profit);
                $("#totalStockValueAmount").html(total_stock_value);
            }

        });

        //search Item Name
        $("#search_item").on("input",function () {
            var item_id = $(this).val().toUpperCase();
            
            // Declare variables
            var  filter, table, tr, td, i;

            filter  = item_id
            table   = document.getElementById("showItemFilterTable");
            tr = table.getElementsByTagName("tr");
            if(filter=='all')
            {
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {

                        tr[i].style.display = "";

                    }
                }
                return false;
            }
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {

                td = tr[i].getElementsByTagName("td")[1];

                if (td) {

                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";

                    } else {
                        tr[i].style.display = "none";
                    }

                }

            }
        })

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_reports').addClass('act_item');
</script>
@endsection