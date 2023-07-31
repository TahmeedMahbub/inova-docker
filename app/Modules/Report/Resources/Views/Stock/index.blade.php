@extends('layouts.admin')

@section('title', 'Stock Report '.date("Y-m-d h-i-sa"))

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
                content:"" !important;

            }
            a{
                text-decoration: none;
            }
            .uk-table tr td{
                white-space: nowrap;
                padding: 1px 0px;
                border: none !important;
                width: 100%;
                font-size: 11px !important;
            }
            .uk-table tr td:first-child,.uk-table tr th:first-child{
                text-align: left !important;
            }
            .uk-table tr th ,.uk-table:last-child tr td{

                white-space: nowrap;
                padding: 1px 5px;
                border-top: 1px solid black;
                border-bottom: 1px solid black;
                width: 100%;
                font-size: 11px !important;
            }

            body{
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
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-10-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar hidden-print">
                            <div class="md-card-toolbar-actions hidden-print" style="width: 100%">
                                <div data-uk-button-radio="{target:'.md-btn'}" style="float: right; ">
                                    <select data-md-selectize="" data-md-selectize-bottom="" data-uk-tooltip="{pos:'top'}" id="item_sub_category" title="Select Sub category">
                                        <option style="text-align: left;" value="">Select Sub Category...</option>
                                        <option value="all">All</option>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"> {{ $subcategory->item_sub_category_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="float: right">
                                    <input class="md-input" id="search_item" placeholder="Search Item Name " style="position: relative; top:-10px; width: 300px;" type="text">
                                    </input>
                                </div>
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <!--end  -->
                                <div aria-expanded="true" aria-haspopup="true" class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}">
                                    <a data-uk-modal="{target:'#coustom_setting_modal'}" href="#">
                                        <i class="material-icons">
                                            &#xE8B8;
                                        </i>
                                        <span>
                                        Custom Setting
                                    </span>
                                    </a>
                                </div>

                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => route('report_stock_index_item'), 'method' => 'get', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range and Transaction Type <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">From</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" @if(isset($_GET['from_date'])) value="{{ date('Y-m-d', strtotime($_GET['from_date'])) }}" @endif>
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" @if(isset($_GET['to_date'])) value="{{ date('Y-m-d', strtotime($_GET['to_date'])) }}" @endif>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                            <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <!--end  -->
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 100%;">
                            <div class="uk-grid" >
                                <div class="uk-width-small-5-5 uk-text-center">
                                    <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                    <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 5px;" class="heading_b">Stock Report</p>
                                    <p style="line-height: 5px;" class="uk-text-small">From {{$start}} To {{$end}}</p>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <table class="uk-table" id="showItemFilterTable">
                                        
                                        <thead>
                                            <tr class="uk-text-upper">
                                                <th class="uk-text-left">Item Name</th>
                                                <th class="uk-text-right">Total Purchases</th>
                                                <th class="uk-text-right">Total Sales</th>
                                                <th class="uk-text-right">Stock In Hand</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                $purchases_sum          = 0;
                                                $sales_sum              = 0;
                                                $purchases_amount_sum   = 0;
                                                $sales_amount_sum       = 0;
                                                $stock_sum              = 0;
                                            ?>

                                            @if(!empty($data))
                                            @foreach($data as $key => $item)
                                                <tr class="uk-table-middle">
                                                    <td style="display: none;">{{ $item['sub_cat_id'] }}</td>
                                                    <td class="uk-text-left">
                                                        <a href="{{ route('report_stock_details_item', [$item['item_id'], $start, $end])}}">
                                                            {{ $item['item_name'] }}
                                                        </a>
                                                    </td>
                                                    <td class="uk-text-right">{{ $item['total_purchases'] }}</td>
                                                    <td class="uk-text-right">{{ $item['total_sales'] }}</td>
                                                    <td class="uk-text-right">{{ $item['total_purchases'] - $item['total_sales'] }}</td>
                                                </tr>

                                                <?php
                                                    $purchases_sum          = $purchases_sum + $item['total_purchases'];
                                                    $sales_sum              = $sales_sum + $item['total_sales'];
                                                    $purchases_amount_sum   = $purchases_amount_sum + $item['purchase_amount'];
                                                    $sales_amount_sum       = $sales_amount_sum + $item['sales_amount'];
                                                    $stock_sum              = $stock_sum + ($item['total_purchases'] - $item['total_sales']);
                                                ?>

                                            @endforeach
                                            @endif
                                                

                                            <tr id="itemTotalValue">
                                                <td style="font-weight: bold;color: black" class="uk-text-right">Total</td>
                                                <td style="font-weight: bold;color: black" class="uk-text-right" id="totalPurchaseQty">{{ $purchases_sum }}</td>
                                                <td style="font-weight: bold;color: black" class="uk-text-right" id="totalSalesQty">{{ $sales_sum }}</td>
                                                <td style="font-weight: bold;color: black" class="uk-text-right" id="totalStockQty">{{ $stock_sum }}</td>
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
                </div>
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

            // Declare variables
            var  filter, table, tr, td, i, item_total, total_purchase_qty, purchase_qty, total_sales_qty, sales_qty, total_stock_in_hand, stock_in_hand_qty;

            total_purchase_qty      = 0;
            purchase_qty            = 0;
            total_sales_qty         = 0;
            sales_qty               = 0;
            total_stock_in_hand     = 0;
            stock_in_hand_qty       = 0;

            filter      = sub_cat_id;
            table       = document.getElementById("showItemFilterTable");
            item_total  = document.getElementById("itemTotalValue");

            tr = table.getElementsByTagName("tr");

            if(filter == 'all')
            {
                for (i = 0; i < tr.length; i++) {

                    td                          = tr[i].getElementsByTagName("td")[0];
                    purchase_qty                = tr[i].getElementsByTagName("td")[2];
                    sales_qty                   = tr[i].getElementsByTagName("td")[3];
                    stock_in_hand_qty           = tr[i].getElementsByTagName("td")[4];

                    if (td) {
                        tr[i].style.display     = "";
                        total_purchase_qty      += parseFloat(purchase_qty.innerHTML);
                        total_sales_qty         += parseFloat(sales_qty.innerHTML);
                        total_stock_in_hand     += parseFloat(stock_in_hand_qty.innerHTML);
                    }
                }

                $("#totalPurchaseQty").html(total_purchase_qty);
                $("#totalSalesQty").html(total_sales_qty);
                $("#totalStockQty").html(total_stock_in_hand);

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

                    if (td) {

                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display     = "";
                            tr[i].style.display     = "";
                            total_purchase_qty      += parseFloat(purchase_qty.innerHTML);
                            total_sales_qty         += parseFloat(sales_qty.innerHTML);
                            total_stock_in_hand     += parseFloat(stock_in_hand_qty.innerHTML);
                        } else {
                            tr[i].style.display         = "none";
                            item_total.style.display    = "";
                        }
                    }
                }

                $("#totalPurchaseQty").html(total_purchase_qty);
                $("#totalSalesQty").html(total_sales_qty);
                $("#totalStockQty").html(total_stock_in_hand);
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
