@extends('layouts.main')

@section('title', 'Dashboard')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style type="text/css">

        .md-card .md-card-toolbar {
            height: 61px;
        }
        .md-card .md-card-toolbar-heading-text {
            height: 61px;
        }
        .md-card .md-card-toolbar {
            border-bottom: none;
        }
        .left-title {
            font-size: 16px;
        }
        .sales-product {
            font-size: 12px;
        }

        .uk-progress-mini {
            height:10px;
        }

        .product-sale thead tr th {
            padding: 3px;
            font-size: 12px;
        }

        .product-sale tbody tr td {
            padding: 3px;
            font-size: 12px;
        }
        .income-expense-view p {
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .income-border {
            padding-left:0px;
            border-right: 1px solid #ccc;
        }
        .income-border:last-child {
            padding-left:0px;
            border-right: none;
        }
        @media (max-width:425px) {
            .income-border{
              border-right: none;
            }
        }

        @media (min-width: 992px){
            .das-uk-center {
                text-align: center;
            }
        }

        @media (min-width: 992px){
            .uk-left-border {
                border-right: 2px solid #757575;
                padding-right: 25px;
            }
            .baseline-force {
                position: absolute;
                bottom: 25px;
            }
        }
        .uk-text-middle h2 {
            font-size: 20px;
        }
        .baseline-force .uk-grid {
            margin-top: 5px;
        }
    </style>

    <style type="text/css">
        .progress_bar_13 .progress-bar-description{
            display: block;
            line-height: 14px;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 13px;
        }
        .progress_bar_13 .progress-bar-description span{
            float: right;
        }
        .progress_bar_13 .pro-bar{
            background-color: hsl(196, 16%, 81%);
            display: block;
            height: 25px;
            margin-bottom: 15px;
            position: relative;
        }

        .progress_bar_13 .pro-bar .progress-bar-outer{
            background: url("../images/pattern.png") repeat scroll left top;
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
        }

        .progress_bar_13 .pro-bar .progress-bar-inner{
            display: block;
            height: 100%;
            left: 0;
            overflow: hidden;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1;
        }

        .card-name-text {
            font-size: 17px;
            margin-top: 0px;
            font-variant: all-petite-caps;
        }

        .income-expense-h2 {
            font-size: 1.2rem; 
            line-height: 16px;
        }

        .income-bottom-back {
            background: #eee;
        }

        .dash-link-custom {
            width: 100%;
        }

        .dash-link-custom a {
            color: #444;
            padding-bottom: 6px;
            text-decoration: none;
        }

        .dash-link-custom a.active {
            border-bottom: 2px solid #1e88e5;
        }

        .custom-from-left-top {
            margin: auto;
        }

        @media (min-width: 767px){

            .dash-link-custom a {
                margin-right: 5px;
                font-size: 12px;
            }
            
            .income-bottom-back {
                padding: 20px 4px 7px 17px;
            }

            .card-name-text {
                font-size: 13px;
                margin-top: 0px;
                font-variant: all-petite-caps;
            }

            .income-button-design {
                padding-left: 4px;
                padding-right: 4px; 
                margin-bottom: 10px;
            }

            .dash-link-custom {
                text-align: right;
            }

            .custom-from {
                position: relative;
            }

            .custom-from label{
                position: absolute;
                bottom: 0px; 
                right: 0px;
                font-size: 12px;
            }
            .custom-from-left-zero {
                padding-left: 0px;
            }
            .padding-left-side {
                padding-left: 20px;
            }
            .padding-left-side:first-child {
                padding-left: 35px;
            }

            .income-left-padding {
                padding-left: 30px;
            }

           
        }

        @media screen and (min-device-width: 481px) and (max-device-width: 768px) { 
            .income-expense-h2 {
                font-size: .7rem; 
            }
        }

        @media (max-width: 425px) {
            .income-bottom-back {
                padding: 10px 4px 7px 17px;
            }

            .dash-link-custom a {
                margin-right: 4px;
                margin-bottom: 5px;
                display: inline-block;
                font-size: 12px;
            }
            
            .dash-link-custom {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .padding-left-side:first-child {
                margin-top:10px;
            }

            .padding-left-side {
                margin-top:15px;
            }

            .grid-mobile-margin {
                margin-top:20px;
            }
        }

        #top_account li a {
            font-size: 11px;
        }

        #summary_account li a {
            font-size: 11px;
        }

        .link-design-all a {
            display: block; 
            text-align: center;
            border-bottom: 2px solid #2196f3;
            font-size: 11px;
            color:#000;
            margin: 0px 15px 2px;
        }

        .sales-summary  tbody { 
            display: block; 
        }

        .sales-summary thead tr th{ 
            width: 33%;
        }

        .table-account-summary tr {
            width: 100%;
        }
        
        .table-account-summary tr td {
            width: 33%;
            display: inline-block;
        }

        .product-sale .table-account-summary {
            height: 100px;      
            overflow-y: auto;
            width: 100%;  
        }

        .table-fixed thead {
          width: 97%;
          margin-top:6px;
        }

        .table-fixed tbody {
          height: 160px;
          overflow-y: auto;
          width: 100%;
        }

        .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
          display: block;
        }

        .table-fixed thead tr th {
            font-weight: normal;
        }

        .table-fixed tbody td, .table-fixed thead > tr> th {
          float: left;
          border-bottom-width: 0;
        }

        #account_summary h3 {
            font-size: 14px;
        }

        .uk-grid .rev-exp-design {
            margin-top:0px;
        }

        .uk-grid .rev-exp-design p{
            font-size: 11px; 
            font-weight: normal;
            vertical-align: bottom;
            margin-top: 4px; 
            margin-bottom: 0px;
        }

        .uk-grid .rev-exp-design p:first-child {
            color:#000000;
        }

        .rev-exp-progress {
            margin-top: 10px;
        }

        .dash-margin-top {
            margin-top: 0px !important;
        }

        .dash-margin-top-rec {
            margin-top:5px !important;
        }
        .dash-graph-height {
            height: 250px;
        }

        #top_account_content h3 {
            font-size: 14px;
        }
        .uk-tab {
            width: 100%;
        }
    </style>

    <!-- flag icons -->
    <link rel="stylesheet" href="{{asset('admin/assets/icons/flags/flags.min.css')}}" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/style_switcher.min.css')}}" media="all">
@endsection

@section('content')

    {{-- Income and Expense Start --}}
        <div class="uk-grid">
            <div class="uk-width-medium-6-6">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-width-medium-6-6">
                                <div class="uk-grid" style="">
                                    <div class="uk-width-small-6-6 uk-width-medium-2-6">
                                        <h3 class="" style="font-weight: 400; font-size: 16px; display: block;width: 100%;margin-bottom:0px;">Income and Expense</h3>
                                        <p style="font-size: 11px; font-weight: 500;vertical-align: bottom;margin-top: 2px; margin-bottom: 0px;color: #000;" class="hidden income-expense-remove">
                                            <span class="income_expense_start_date "></span> To 
                                            <span class="income_expense_end_date" ></span>
                                        </p>
                                        <p style="font-size: 11px; font-weight: 500;vertical-align: bottom;margin-top: 2px; margin-bottom: 0px;" class="uk-text-muted hidden income-expense-remove">
                                            <span class="income_expense_start_date_pre "></span> To 
                                            <span class="income_expense_end_date_pre" ></span> (prev)
                                        </p>
                                    </div>

                                    <div class="uk-width-small-6-6 uk-width-medium-4-6">
                                        <div class="uk-float-right dash-link-custom income-active" style="">
                                            <a href="javascript:void(0)" id="income_one" class="active income-button-design" onclick="incomeExpense(1)" >This Month </a>

                                            <a href="javascript:void(0)" id="income_two" class=" income-button-design" onclick="incomeExpense(2)">03 Months</a>

                                            <a href="javascript:void(0)" id="income_three" class=" income-button-design" onclick="incomeExpense(3)">06 Months</a>

                                            <a href="javascript:void(0)" id="income_four" class=" income-button-design" onclick="incomeExpense(4)">This Year</a>

                                            <a href="javascript:void(0)" id="income_five" class=" income-button-design" onclick="incomeExpense(5)">Custom</a>
                                        </div>

                                        <div class="uk-grid hidden income-expense-form">
                                            <div class="uk-width-medium-2-6 "></div>
                                            <div class="uk-width-small-3-6 uk-width-medium-2-6">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-5 custom-from">
                                                        <label class="uk-text-muted">From</label>
                                                    </div>
                                                    <div class="uk-width-medium-4-5 custom-from-left-zero">
                                                        <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="expense-form-date" onchange="incomeExpense(5)">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="uk-width-small-3-6 uk-width-medium-2-6" style="">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-5 custom-from">
                                                        <label class="uk-text-muted">To</label>
                                                    </div>
                                                    <div class="uk-width-medium-4-5 custom-from-left-zero">
                                                        <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="expense-to-date" onchange="incomeExpense(5)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid" style="margin-top: 0px;">
                                    <div class="uk-width-medium-6-6">
                                       <div class="uk-overflow-container" id="incomeExpense" style="height: 300px;"></div>
                                        
                                    </div>
                                </div>

                                <div class="uk-grid" style="">
                                    <div class="uk-width-medium-6-6">
                                        <div class="uk-grid">
                                            <div class="uk-width-medium-1-6">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-1 padding-left-side">
                                                        <div class="income-bottom-back">
                                                            <h2 class="uk-margin-remove income-expense-h2" id="IncomeReceivable"></h2>
                                                            <span class="uk-text-muted">
                                                                <span class="" style="font-size: 11px;" id="PersentReceivable"></span>
                                                            </span>

                                                            <span><i class="material-icons color-for-persent-receivable" style="font-size: 32px; vertical-align: -12px;margin-left: -6px; line-height: 42px;"></i></span>
                                                            <p style="margin:0px;line-height: 5px;"><span class="uk-text-muted" style="font-size: 11px;;line-height: 15px;" id="IncomeReceivableP"></span></p>
                                                            <p class="uk-text-muted card-name-text"><b>Receivable</b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="uk-width-medium-5-6 custom-from-left-zero">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-6">
                                                        <div class="income-bottom-back">
                                                            <h2 class="uk-margin-remove income-expense-h2" id="IncomePayable"></h2>
                                                            <span class="uk-text-muted">
                                                                    <span class="" style="font-size: 11px;" id="PersentPayable"></span>
                                                            </span>

                                                            <span><i class="material-icons color-for-persent-payable" style="color:#ff0000; font-size: 32px; vertical-align: -12px;margin-left: -6px; line-height: 42px;"></i></span>
                                                            <p style="margin:0px;line-height: 5px;"><span class="uk-text-muted"  style="font-size: 11px;;line-height: 15px;" id="IncomePayableP"></span></p>
                                                            <p class="uk-text-muted card-name-text"><b>Payable</b></p>
                                                        </div>
                                                    </div>

                                                    <div class="uk-width-small-2-6 uk-width-medium-1-6 padding-left-side">
                                                        <div class="income-bottom-back">
                                                            <h2 class="uk-margin-remove income-expense-h2" id="TotalIncome"></h2>
                                                            <span class="uk-text-muted">
                                                                <span class="" style="font-size: 11px;" id="PersentIncome"></span>
                                                            </span>

                                                            <span><i class="material-icons color-for-persent-income" style=" font-size: 32px; vertical-align: -12px;margin-left: -6px; line-height: 42px;"></i></span>
                                                            <p style="margin:0px;line-height: 5px;"><span class="uk-text-muted"  style="font-size: 11px;;line-height: 15px;" id="PTotalIncome">vs </span></p>
                                                            <p class="uk-text-muted card-name-text"><b>Income</b></p>
                                                        </div>
                                                    </div>

                                                    <div class="uk-width-small-2-6 uk-width-medium-1-6 custom-from-left-zero">
                                                        <div class="income-bottom-back income-left-padding">
                                                            <h2 class="uk-margin-remove income-expense-h2" id="TotalExpense"></h2>
                                                            <span class="uk-text-muted">
                                                                <span class="" style="font-size: 11px;" id="PersentExpense"></span>
                                                            </span>

                                                            <span><i class="material-icons color-for-persent-expense" style="font-size: 32px; vertical-align: -12px;margin-left: -6px; line-height: 42px;"></i></span>
                                                            <p style="margin:0px;line-height: 5px;"><span class="uk-text-muted"  style="font-size: 11px;;line-height: 15px;" id="PTotalExpense"></span></p>
                                                            <p class="uk-text-muted card-name-text"><b>Expense</b></p>
                                                        </div>
                                                    </div>

                                                    <div class="uk-width-small-2-6  uk-width-medium-1-6 custom-from-left-zero">
                                                        <div class="income-bottom-back income-left-padding">
                                                            <h2 class="uk-margin-remove income-expense-h2" id="NetProfit"></h2>
                                                            <span class="uk-text-muted">
                                                                <span class="" style="font-size: 11px;" id="PersentNetProfit"></span>
                                                            </span>

                                                            <span><i class="material-icons color-for-persent-net-profits"  style="color:green; font-size: 32px; vertical-align: -12px;margin-left: -6px; line-height: 42px;"></i></span>
                                                            <p style="margin:0px;line-height: 5px;"><span class="uk-text-muted"  style="font-size: 11px;;line-height: 15px;" id="PNetProfit"></span></p>
                                                            <p class="uk-text-muted card-name-text"><b>Net Profit</b></p>
                                                        </div>
                                                    </div>

                                                    <div class="uk-width-medium-1-6 padding-left-side">
                                                        <div class="income-bottom-back">
                                                            <h2 class="uk-margin-remove income-expense-h2" id="IncomeCashInHand"></h2>
                                                            <span class="uk-text-muted">
                                                                    <span class="" style="font-size: 11px;" id="PersentCashInHand"></span>
                                                            </span>

                                                            <span><i class="material-icons color-for-persent-cash-hand" style="color:green; font-size: 32px; vertical-align: -12px;margin-left: -6px; line-height: 42px;"></i></span>
                                                            <p style="margin:0px;line-height: 5px;"><span class="uk-text-muted"  style="font-size: 11px;;line-height: 15px;" id="IncomeCashInHandP"></span></p>
                                                            <p class="uk-text-muted card-name-text"><b>Cash In Hand</b></p>
                                                        </div>
                                                    </div>

                                                    <div class="uk-width-medium-1-6 custom-from-left-zero">
                                                        <div class="income-bottom-back income-left-padding">
                                                            <h2 class="uk-margin-remove income-expense-h2" id="IncomeCashInBank"></h2>
                                                            <span class="uk-text-muted">
                                                                    <span class="" style="font-size: 11px;" id="PersentCashInBank"></span>
                                                            </span>

                                                            <span><i class="material-icons color-for-persent-cash-bank" style="color:green; font-size: 32px; vertical-align: -12px;margin-left: -6px; line-height: 42px;"></i></span>
                                                            <p style="margin:0px;line-height: 5px;"><span class="uk-text-muted"  style="font-size: 11px;;line-height: 15px;" id="IncomeCashInBankP"></span></p>
                                                            <p class="uk-text-muted card-name-text"><b>Cash In Bank</b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Income and Expense End --}}

    {{-- Ap/Ar and Summary Start--}}
        <div class="uk-grid">
            <div class="uk-width-medium-3-6">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                             <h3 class="left-title" style="display: block;width: 100%;">AP vs AR</h3>
                        </div>

                        <div class="uk-grid" style="margin-top:;">
                            <div class="uk-width-medium-6-6">
                               <div class="uk-overflow-container" id="AccountPayableReceivable" style="height: 250px; margin-top: -34px;"></div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="uk-width-medium-3-6 grid-mobile-margin">
                <div class="md-card">
                    <div class="md-card-content" style="padding-bottom: 0px;">
                        <div class="uk-grid custom-from-left-top">
                            <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#account_summary'}" id="summary_account">
                                <li class="uk-active"><a href="#">Sales</a></li>
                                <li class=""><a href="#">Bill</a></li>
                                <li class=""><a href="#">Revenue</a></li>
                                <li class=""><a href="#">Expense</a></li>
                            </ul>
                            <ul id="account_summary" class="uk-switcher uk-margin" style="width: 100%; margin-bottom: 0px; margin-top: 0px;">
                                <li >
                                    <div class="uk-grid" style="margin-top: 15px;">
                                        <div class="uk-width-2-3">
                                            <h3 class="left-title" style="display: block;width: 100%;">Sales Summary <span style="font-weight: normal;font-size: 11px;" id="salesTotalUp"></span> </h3>
                                        </div>
                                        <div class="uk-width-1-3 link-design-all">
                                            <a href="#" class="left-title" style="">View Sales Report</a>
                                        </div>
                                    </div>

                                    <table class="table table-fixed product-sale">
                                      <thead>
                                        <tr>
                                            <th class="col-xs-4" style="">Name</th>
                                            <th class="col-xs-4" style="text-align: right">Amount</th>
                                            <th class="col-xs-4" style="text-align: right">Invoice</th>
                                        </tr>
                                      </thead>

                                      <tbody id="salesSummary">

                                      </tbody>
                                    </table>
                                </li>

                                <li>
                                    <div class="uk-grid" style="margin-top: 15px;">
                                        <div class="uk-width-2-3">
                                            <h3 class="left-title" style="display: block;width: 100%;">Bill Summary <span style="font-weight: normal;font-size: 11px;" id="billTotalUp"></span></h3>
                                        </div>
                                        <div class="uk-width-1-3 link-design-all">
                                            <a href="#" class="left-title" style="">View Bill Report</a>
                                        </div>
                                    </div>

                                    <table class="table table-fixed product-sale">
                                      <thead>
                                        <tr>
                                            <th class="col-xs-4">Name</th>
                                            <th class="col-xs-4" style="text-align: right">Amount</th>
                                            <th class="col-xs-4" style="text-align: right">Bill</th>
                                        </tr>
                                      </thead>

                                      <tbody id="billSummary">

                                      </tbody>
                                    </table>
                                </li>

                                <li>
                                    <div class="uk-grid" style="margin-top: 15px;">
                                        <div class="uk-width-2-3">
                                            <h3 class="left-title" style="display: block;width: 100%;">Revenue Summary <span style="font-weight: normal;font-size: 11px;" id="revenueTotalUp"></span></h3>
                                        </div>
                                        <div class="uk-width-1-3 link-design-all">
                                            <a href="#" class="left-title" style="">View Revenue Report</a>
                                        </div>
                                    </div>

                                    <table class="table table-fixed product-sale">
                                      <thead>
                                        <tr>
                                            <th class="col-xs-4">Name</th>
                                            <th class="col-xs-4" style="text-align: right">Amount</th>
                                            <th class="col-xs-4" style="text-align: right">Transaction Number</th>
                                        </tr>
                                      </thead>

                                      <tbody id="revenueSummary">
                                        
                                      </tbody>
                                    </table>
                                </li>

                                <li>
                                    <div class="uk-grid" style="margin-top: 15px;">
                                        <div class="uk-width-2-3">
                                            <h3 class="left-title" style="display: block;width: 100%;" >Expense Summary <span style="font-weight: normal;font-size: 11px;" id="ExpenseSummaryUp"></span></h3>
                                        </div>
                                        <div class="uk-width-1-3 link-design-all">
                                            <a href="#" class="left-title" style="">View Expense Report</a>
                                        </div>
                                    </div>

                                    <table class="table table-fixed product-sale">
                                      <thead>
                                        <tr>
                                            <th class="col-xs-4">Name</th>
                                            <th class="col-xs-4" style="text-align: right">Amount</th>
                                            <th class="col-xs-4" style="text-align: right">EXP</th>
                                        </tr>
                                      </thead>

                                      <tbody id="ExpenseSummary">
                                        
                                      </tbody>
                                    </table>
                                </li>
                            </ul>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    {{-- Ap/Ar and Summary End--}}

    {{-- Revenue and Expense Start --}}
        <div class="uk-grid">
            <div class="uk-width-medium-3-6">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <h3 class="left-title" style="display: block;width: 100%;">Revenue</h3>
                        </div>
                        <div class="uk-grid rev-exp-design">
                            <div class="uk-width-medium-1-2">
                                <p class="hidden revenue-remove"><span class="revenue_start_date "> </span> To <span class="revenue_end_date" ></span></p>

                                 <p  class="hidden preview-revenue-remove"><span class="preview_revenue_start_date "> </span> To <span class="preview_revenue_end_date" ></span>(previous)</p>

                                <div class="uk-grid hidden revenue-form">
                                    <div class="uk-width-small-6-6 uk-width-medium-6-6 ">
                                        <label for="date">Form </label>
                                        <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="revenue-form-date" onchange="revenue()">
                                    </div> 
                                    <span class="uk-width-small-6-6 uk-width-medium-6-6" style="margin-top: 12px;">
                                        <label for="date">To </label>
                                        <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="revenue-to-date" onchange="revenue()">
                                    </span>
                                </div>
                            </div>

                            <div class="uk-width-medium-3-6">
                                <div class="uk-float-right" style="width: 100%;">
                                    <select id="SelectTimeDurationRevenue" class="select2-single-search-dropdown"  onchange="revenue()" >
                                        <option value="1">One Month</option>
                                        <option value="2">Three Month</option>
                                        <option value="3">Six Month</option>
                                        <option value="4">One Year</option>
                                        <option value="5">Custom</option>
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-6-6 rev-exp-progress">
                                <div class="progress_bar_13">
                                    <div class="progress-bar-description">
                                        Current
                                        <span style="" id="revenue-current"></span>
                                    </div>
                                    <div class="pro-bar">
                                        <span class="progress-bar-outer already-animated" id="revenueCurrent" style="background-color: #E67E22;" >
                                            <span class="progress-bar-inner"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress_bar_13">
                                    <div class="progress-bar-description">
                                        Previous
                                        <span style="" id="revenue-previous"></span>
                                    </div>
                                    <div class="pro-bar">
                                        <span class="progress-bar-outer already-animated" id="revenuePrevious" style="background-color: #E67E22; " >
                                            <span class="progress-bar-inner"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-width-medium-3-6 grid-mobile-margin">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <h3 class="left-title" style="display: block;width: 100%;">Expense</h3>
                        </div>

                        <div class="uk-grid rev-exp-design">
                            <div class="uk-width-medium-1-2">
                                <p  class="hidden expense-remove"><span class="expense_start_date "> </span> To <span class="expense_end_date" ></span></p>

                                <p class="hidden preview-expense-remove"><span class="preview_expense_start_date "> </span> To <span class="preview_expense_end_date" ></span>(previous)</p>

                                <div class="uk-grid hidden expense-form">
                                    <div class="uk-width-small-6-6 uk-width-medium-6-6 ">
                                        <label for="date">Form </label>
                                        <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="expense-form" onchange="expense()">
                                    </div> 
                                    <span class="uk-width-small-6-6 uk-width-medium-6-6" style="margin-top: 12px;">
                                        <label for="date">To </label>
                                        <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="expense-to" onchange="expense()">
                                    </span>
                                </div>
                                
                            </div>
                            <div class="uk-width-medium-3-6">
                                <div class="uk-float-right" style="width: 100%;">
                                    <select id="SelectTimeDurationExpense" class="select2-single-search-dropdown"  onchange="expense()" >
                                        <option value="1">One Month</option>
                                        <option value="2">Three Month</option>
                                        <option value="3">Six Month</option>
                                        <option value="4">One Year</option>
                                        <option value="5">Custom</option>
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-6-6 rev-exp-progress">
                                <div class="progress_bar_13">
                                    <div class="progress-bar-description">
                                        Current
                                        <span style="" id="expense-current"></span>
                                    </div>
                                    <div class="pro-bar">
                                        <span class="progress-bar-outer already-animated" id="expenseCurrent" style="background-color: #FEC840; width: 100%;" >
                                            <span class="progress-bar-inner"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="progress_bar_13">
                                    <div class="progress-bar-description">
                                        Previous
                                        <span style="left:75%;" id="expense-previous"></span>
                                    </div>
                                    <div class="pro-bar">
                                        <span class="progress-bar-outer already-animated" id="expensePrevious" style="background-color: #ED687C; width: 75%;" data-width="75">
                                            <span class="progress-bar-inner"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Revenue and Expense --}}

    {{-- Cash Flow and Sales Graph Start --}}
        <div class="uk-grid cash-flow">
            <div class="uk-width-medium-3-6">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <h3 class="left-title" style="display: block;width: 100%;">Cash Flow</h3>
                        </div>

                        <div class="uk-grid dash-margin-top">
                            <div class="uk-width-medium-6-6">
                               <div class="uk-overflow-container dash-graph-height" id="cashFlow"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-width-medium-3-6 grid-mobile-margin">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <h3 class="left-title" style="display: block;width: 100%;">Sales</h3>
                        </div>

                        <div class="uk-grid dash-margin-top">
                            <div class="uk-width-medium-6-6">
                               <div class="uk-overflow-container" id="salesBar" style="height: 250px;"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Cash Flow and Sales Graph End --}}

    {{--Top All and  Due Alert Start--}}
        <div class="uk-grid">
            {{-- Top All Start--}}
            <div class="uk-width-medium-3-6">
                <div class="md-card">
                    <div class="md-card-content" style="padding-bottom: 0px;">
                        <div class="uk-grid custom-from-left-top">
                            <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#top_account_content'}" id="top_account">
                                <li class="uk-active"><a href="#">Customer Sales</a></li>
                                <li class=""><a href="#">Expense Account</a></li>
                                <li class=""><a href="#">Vendor Expense</a></li>
                                <li class=""><a href="#">Sales By Product</a></li>
                            </ul>

                            <ul id="top_account_content" class="uk-switcher uk-margin" style="width: 100%; margin-bottom: 0px; margin-top: 1px;">
                                <li>
                                    {{-- Top Customer Account Start --}}
                                        <div class="uk-grid">
                                            <div class="uk-width-medium-6-6">
                                                <div class="md-card">
                                                    <div class="md-card-content">
                                                        <div class="uk-grid">
                                                            <h3 class="left-title" style="display: block;width: 100%;">Top Customer Sales</h3>
                                                        </div>

                                                        <div class="uk-grid dash-margin-top rev-exp-design">
                                                            <div class="uk-width-medium-3-6">
                                                                <p class="hidden top-customer-remove"><span class="top_customer_start_date "></span> To <span class="top_customer_end_date" > </span></p>

                                                                <div class="uk-grid hidden topCustomer-form">
                                                                    <div class="uk-width-small-6-6 uk-width-medium-6-6 ">
                                                                        <label for="date">Form </label>
                                                                        <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="top-customer-form-date" onchange="topCustomerSales()">
                                                                    </div> 
                                                                    <span class="uk-width-small-6-6 uk-width-medium-6-6" style="margin-top: 12px;">
                                                                        <label for="date">To </label>
                                                                        <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="top-customer-to-date" onchange="topCustomerSales()">
                                                                    </span>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="uk-width-medium-3-6">
                                                                <div class="uk-float-right" style="width: 100%;">
                                                                    <select id="SelectTimeCustomerSales" class="select2-single-search-dropdown"  onchange="topCustomerSales()" >
                                                                        <option value="1">One Month</option>
                                                                        <option value="2">Three Month</option>
                                                                        <option value="3">Six Month</option>
                                                                        <option value="4">One Year</option>
                                                                        <option value="5">Custom</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <table class="uk-table product-sale">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Account</th>
                                                                        <th style="text-align: right;">Amount</th>
                                                                        <th style="text-align: right;">% Expense</th>
                                                                        <th style="width: 25%"></th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody class="tableCustomerSales">
                                                                    
                                                                </tbody>
                                                        </table> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- Top Customer Account End --}}
                                </li>

                                <li>
                                    {{-- Top Expense Account Start--}}
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-6-6">
                                            <div class="md-card">
                                                <div class="md-card-content">
                                                    <div class="uk-grid">
                                                        <h3 class="left-title" style="display: block;width: 100%;">Top Expense Account</h3>
                                                    </div>

                                                    <div class="uk-grid dash-margin-top rev-exp-design">
                                                        <div class="uk-width-medium-3-6">
                                                            <p class="hidden top-expense-remove"><span class="top_expense_start_date "></span> To <span class="top_expense_end_date" > </span></p>

                                                            <div class="uk-grid hidden topExpense-form">
                                                                <div class="uk-width-small-6-6 uk-width-medium-6-6 ">
                                                                    <label for="date">Form </label>
                                                                    <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="top-expense-form-date" onchange="topExpenseAccount()">
                                                                </div> 
                                                                <span class="uk-width-small-6-6 uk-width-medium-6-6" style="margin-top: 12px;">
                                                                    <label for="date">To </label>
                                                                    <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="top-expense-to-date" onchange="topExpenseAccount()">
                                                                </span>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="uk-width-medium-3-6">
                                                            <div class="uk-float-right" style="width: 100%;">
                                                                <select id="SelectTimeDurationTopExpense" class="select2-single-search-dropdown"  onchange="topExpenseAccount()" >
                                                                    <option value="1">One Month</option>
                                                                    <option value="2">Three Month</option>
                                                                    <option value="3">Six Month</option>
                                                                    <option value="4">One Year</option>
                                                                    <option value="5">Custom</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <table class="uk-table product-sale">
                                                            <thead>
                                                                <tr>
                                                                    <th>Account</th>
                                                                    <th style="text-align: right;">Amount</th>
                                                                    <th style="text-align: right;">% Expense</th>
                                                                    <th style="width: 25%"></th>
                                                                </tr>
                                                            </thead>

                                                            <tbody class="tableTopExpense">
                                                                
                                                            </tbody>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Top Expense Account End--}}
                                </li>

                                <li>
                                    {{-- Top Vendor Expense Start --}}
                                   <div class="uk-width-medium-6-6">
                                        <div class="md-card">
                                            <div class="md-card-content">
                                                <div class="uk-grid">
                                                    <h3 class="left-title" style="display: block;width: 100%;">Top Vendor Expense</h3>
                                                </div>

                                                <div class="uk-grid dash-margin-top rev-exp-design">
                                                    <div class="uk-width-medium-1-2">
                                                        <p class="hidden topVendor-remove"><span class="top_vendor_start_date "> </span> To <span class="top_vendor_end_date" ></span></p>

                                                        <div class="uk-grid hidden top-vendor-form">
                                                            <div class="uk-width-small-6-6 uk-width-medium-6-6 ">
                                                                <label for="top-vendor-expense-form-date">Form </label>
                                                                <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="top-vendor-expense-form-date" onchange="topVendorExpense()">
                                                            </div> 
                                                            <span class="uk-width-small-6-6 uk-width-medium-6-6" style="margin-top: 12px;">
                                                                <label for="top-vendor-expense-to-date">To </label>
                                                                <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="top-vendor-expense-to-date" onchange="topVendorExpense()">
                                                            </span>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="uk-width-medium-3-6">
                                                        <div class="uk-float-right" style="width: 100%;">
                                                            <select id="TimeDurationTopVendorExpense" class="select2-single-search-dropdown"  onchange="topVendorExpense()" >
                                                                <option value="1">One Month</option>
                                                                <option value="2">Three Month</option>
                                                                <option value="3">Six Month</option>
                                                                <option value="4">One Year</option>
                                                                <option value="5">Custom</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table class="uk-table product-sale">
                                                    <thead>
                                                       <tr>
                                                            <th>Vendor</th>
                                                            <th style="text-align: right;">Amount</th>
                                                            <th style="text-align: right;">% Expense</th>
                                                            <th style="width: 25%"></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="tableTopVendorExpense">
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Top Vendor Expense End --}}
                                </li>

                                <li>
                                    {{-- Sales by Product Start --}}
                                    <div class="uk-width-medium-6-6">
                                        <div class="md-card">
                                            <div class="md-card-content">
                                                <div class="uk-grid">
                                                    <h3 class="left-title" style="display: block;width: 100%;">Sales by Product</h3>
                                                </div>

                                                <div class="uk-grid dash-margin-top rev-exp-design">
                                                    <div class="uk-width-medium-1-2">
                                                        <p class="hidden sales-remove"><span class="start_date "></span> To <span class="end_date" ></span></p>

                                                        <div class="uk-grid hidden sales-form">
                                                            <div class="uk-width-small-6-6 uk-width-medium-6-6 ">
                                                                <label for="date">Form </label>
                                                                <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="form-date" onchange="salesProduct()">
                                                            </div> 
                                                            <span class="uk-width-small-6-6 uk-width-medium-6-6" style="margin-top: 12px;">
                                                                <label for="date">To </label>
                                                                <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="to-date" onchange="salesProduct()">
                                                            </span>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="uk-width-medium-3-6">
                                                        <div class="uk-float-right" style="width: 100%;">
                                                            <select id="SelectTimeDuration" class="select2-single-search-dropdown"  onchange="salesProduct()" >
                                                                <option value="1">One Month</option>
                                                                <option value="2">Three Month</option>
                                                                <option value="3">Six Month</option>
                                                                <option value="4">One Year</option>
                                                                <option value="5">Custom</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table class="uk-table product-sale">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th style="text-align: right;">Amount</th>
                                                                <th style="text-align: right;">% Sold</th>
                                                                <th style="width: 25%"></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="tableProduct">
                                                            
                                                        </tbody>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Sales by Product End --}} 
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Top All End--}}
        {{-- Due Alert Start --}} 
            <div class="uk-width-medium-3-6 grid-mobile-margin">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <h3 class="left-title" style="display: block;width: 100%;">Due Alert</h3>
                        </div>

                        <div class="uk-grid dash-margin-top rev-exp-design">
                            <div class="uk-width-medium-1-2">
                                <p class="hidden sales-remove"><span class="start_date "> </span> To <span class="end_date" ></span></p>

                                <div class="uk-grid hidden sales-form">
                                    <div class="uk-width-small-6-6 uk-width-medium-6-6 ">
                                        <label for="date">Form </label>
                                        <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="form-date" onchange="">
                                    </div> 
                                    <span class="uk-width-small-6-6 uk-width-medium-6-6" style="margin-top: 12px;">
                                        <label for="date">To </label>
                                        <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="to-date" onchange="">
                                    </span>
                                </div>
                                
                            </div>
                            <div class="uk-width-medium-3-6">
                                <div class="uk-float-right" style="width: 100%;">
                                    <select id="SelectTimeDurationDue" class="select2-single-search-dropdown"  onchange="" >
                                        <option value="1">One Month</option>
                                        <option value="2">Three Month</option>
                                        <option value="3">Six Month</option>
                                        <option value="4">One Year</option>
                                        <option value="5">Custom</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <table class="uk-table product-sale">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th style="">Due Date</th>
                                        <th>Days Overdue</th>
                                        <th style="text-align: right;">Amount Due</th>
                                    </tr>
                                </thead>

                                <tbody class="tableDue">
                                    <tr>
                                        <td></td>
                                        <td style=""></td>
                                        <td style="color:#DD535D;"></td>
                                        <td style="text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: none;" colspan="3"><b>Total: </b></td>
                                        <td style="text-align: right;border-bottom: none;"><b></b></td>
                                        
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{-- Due Alert End --}} 
        </div>
    {{--Top All and  Due Alert Start--}}

    {{-- Receivable vs Received and Payable vs Paid Start--}}
        <div class="uk-grid">
            <div class="uk-width-medium-3-6">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <h3 class="left-title" style="display: block;width: 100%;">Receivable vs Received </h3>
                        </div>
                        <div class="uk-grid  dash-margin-top rev-exp-design">
                            <div class="uk-width-medium-3-6">
                                <p class="hidden receivable-remove"><span class="receivable_start_date "> </span> To <span class="receivable_end_date" ></span></p>

                                <div class="uk-grid hidden receivable-form">
                                    <div class="uk-width-small-6-6 uk-width-medium-6-6 ">
                                        <label for="date">Form </label>
                                        <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="receivable-form-date" onchange="receivableRecived()">
                                    </div> 
                                    <span class="uk-width-small-6-6 uk-width-medium-6-6" style="margin-top: 12px;">
                                        <label for="date">To </label>
                                        <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="receivable-to-date" onchange="receivableRecived()">
                                    </span>
                                </div>
                            </div>

                            <div class="uk-width-medium-3-6">
                                <div class="uk-float-right" style="width: 100%;">
                                    <select id="SelectReceivablePayable" class="select2-single-search-dropdown"  onchange="receivableRecived()">
                                        <option value="1">One Month</option>
                                        <option value="2">Three Month</option>
                                        <option value="3">Six Month</option>
                                        <option value="4">One Year</option>
                                        <option value="5">Custom</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="uk-grid dash-margin-top-rec">
                            <div class="uk-width-medium-4-4">
                               <div id="receivableRecived" class="dash-graph-height"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-width-medium-3-6 grid-mobile-margin">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <h3 class="left-title" style="display: block;width: 100%;">Payable vs Paid</h3>
                        </div>
                        <div class="uk-grid dash-margin-top rev-exp-design">
                            <div class="uk-width-medium-3-6">
                                <p class="hidden payable-remove"><span class="payable_start_date "> </span> To <span class="payable_end_date" ></span></p>

                                <div class="uk-grid hidden payable-form">
                                    <div class="uk-width-small-6-6 uk-width-medium-6-6 ">
                                        <label for="date">Form </label>
                                        <input class="md-input label-fixed" type="text" data-uk-datepicker="{format:'DD-MM-YYYY'}" id="payable-form-date" onchange="payablePaid()">
                                    </div> 
                                    <span class="uk-width-small-6-6 uk-width-medium-6-6" style="margin-top: 12px;">
                                        <label for="date">To </label>
                                        <input class="md-input label-fixed" type="text"  data-uk-datepicker="{format:'DD-MM-YYYY'}" id="payable-to-date" onchange="payablePaid()">
                                    </span>
                                </div>
                            </div>

                            <div class="uk-width-medium-3-6">
                                <div class="uk-float-right" style="width: 100%;">
                                    <select id="PayablePaidSelect" class="select2-single-search-dropdown"  onchange="payablePaid()" >
                                        <option value="1">One Month</option>
                                        <option value="2">Three Month</option>
                                        <option value="3">Six Month</option>
                                        <option value="4">One Year</option>
                                        <option value="5">Custom</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="uk-grid dash-margin-top-rec " style="">
                            <div class="uk-width-medium-4-4">
                               <div id="payablePaid" class="dash-graph-height"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Receivable vs Received and Payable vs Paid End--}}

    {{-- AI Part Start --}}
        {{-- <div class="uk-grid">
            <div class="uk-width-medium-6-6">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <h3 class="left-title" style="display: block;width: 100%;">AI Part</h3>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- AI Part End --}}

    {{-- Reminder Start --}}
        {{-- <div id="">
            <h3 class="heading_b uk-margin-bottom">
                 <a style="margin: 10px;" class="md-btn md-btn-warning md-bg-deep-orange-700 md-btn-large md-btn-wave-light md-btn-icon" data-uk-modal="{target:'#modal_default'}" href="javascript:void(0)">
                     <i class="material-icons">note_add</i>
                     Add Reminder
                 </a>
            </h3>
            <div class="uk-grid" data-uk-grid-margin>
                 <div class="uk-width-1-2">
                     <div class="md-card">
                         <div class="md-card-content">
                             <h3 class="heading_a uk-margin-bottom">Reminders From Tomorrow</h3>
                             <div class="scrollbar-inner">
                                    <div class="timeline timeline_small uk-margin-bottom" id="reminder-1">
                                         @foreach($nextreminder as $value)
                                             <div class="timeline_item" v-for="item in items">
                                                 <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                                                 <div class="timeline_date">

                                                     @if(explode(' ',$value->reminddatetime)[0]=="0000-00-00")
                                                         {{  explode(' ',$value->created_at)[0]  }} <span>At {{ explode(' ',$value->created_at)[1] }}</span>
                                                     @else
                                                         {{ explode(' ',$value->reminddatetime)[0] }} <span>At {{ explode(' ',$value->reminddatetime)[1] }}</span>
                                                     @endif

                                                     <a class="re_delete_btn" onclick="removereminder(this); return false;"  href="{{ route('dashboard_reminder_destroy',$value->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                     <input type="hidden" class="rem_id" value="{{ $value->id }}">

                                                 </div>
                                                 <div class="timeline_content">
                                                     {{ $value->note }}
                                                 </div>
                                             </div>
                                         @endforeach
                                    </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="uk-width-1-2">
                     <div class="md-card">
                         <div class="md-card-content">
                             <h3 class="heading_a uk-margin-bottom">Today</h3>
                             <div class="scrollbar-inner">
                                 <div class="timeline timeline_small uk-margin-bottom" id="reminder-1">
                                     @foreach($todayreminder as $value)
                                         <div class="timeline_item" v-for="item in items">
                                             <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                                             <div class="timeline_date">
                                                     {{  explode(' ',$value->reminddatetime)[0]  }} <span>At {{ explode(' ',$value->reminddatetime)[1] }}</span>
                                                 <a class="re_delete_btn" onclick="removereminder(this); return false;"  href="{{ route('dashboard_reminder_destroy',$value->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                 <input type="hidden" class="rem_id" value="{{ $value->id }}">
                                             </div>
                                             <div class="timeline_content">
                                                 {{ $value->note }}
                                             </div>
                                         </div>
                                     @endforeach
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
            </div>
        </div> --}}
    {{-- Reminder End --}}
@endsection

@section('scripts')
   
    <script src="{!! asset('admin/assets/js/custom/datatables/dataTables.scroller.min.js') !!}"></script>

    <script type="text/javascript">
        var overdue             = "{{ route("dashboard_overDueReceivable_api") }}";
        var invoice_route       = "{{ route('dashboard_overDueReceivable_invoice_show_api',["id"=>'']) }}";
        var reorder             = "{{ route("dashboard_reorder_list_api") }}";
        var inventory_route     = "{{ route('inventory_show',["id"=>'']) }}";
        var overdue_pay         = "{{ route("dashboard_overduePayable_list_api") }}";
        var overdue_pay_bill    = "{{ route('bill_show',["id"=>'']) }}";

        window.onload = function () {
            $.get(overdue,function (datalist) {
                  var data = [];
                    $.each(datalist, function(k, v) {
                      data.push([v.id, v.due_amount, v.payment_date ] );
                  });


                  $('#data_table_1').DataTable({
                      "pageLength": 50,
                      data:           data,
                      deferRender:    false,
                      scrollY:        200,
                      scrollCollapse: true,
                      scroller:       true,
                      "columnDefs": [
                          {
                              "targets": 0,
                              "render": function ( link, type, row ) {
                                      return "<a target='_blank' href="+invoice_route+"/"+link+">"+"INV-"+padLeft(link,6)+"</a>";
                                  return link;
                              }
                          }
                      ]
                  });
            });

            // overdue payable
            $.get(overdue_pay,function (overduelist) {
                  var overduedata = [];
                  $.each(overduelist, function(k, v) {

                      overduedata.push([v.id, v.due_amount, v.due_date,v.bill_number ] );
                  });
                  $('#data_table_2').DataTable({
                      "pageLength": 50,
                      data:           overduedata,
                      deferRender:    false,
                      scrollY:        200,
                      scrollCollapse: true,
                      scroller:       true,
                      "columnDefs": [
                          {
                              "targets": [ 3 ],
                              "visible": false
                          },
                          {
                              "targets": 0,

                              "render": function ( link, type, row ) {

                                  return "<a target='_blank' href="+overdue_pay_bill+"/"+link+">"+"BILL-"+padLeft(link,6)+"</a>";
                                  return link;
                              }
                          }
                      ]
                  });
            });

            //reorder
            $.get(reorder,function (reorderlist) {
                  var reorderdata = [];
                    $.each(reorderlist, function(k, v) {

                      reorderdata.push([v[1], v[0],k ] );
                  });
                  $('#data_table_5').DataTable({
                      "pageLength": 30,
                      data:reorderdata,

                      "columnDefs": [
                          {
                              "targets": [ 2 ],
                              "visible": false
                          },
                          {
                              "targets": 0,
                              "render": function ( link, type, row ) {

                                return "<a target='_blank' href="+inventory_route+"/"+row[2]+">"+row[0]+"</a>";

                              }
                          }
                      ]
                  });
            });
        }

        var accordion = UIkit.accordion(document.getElementById('accor'), {
            showfirst:false
        });

        $('#data_table_3').DataTable({
            "pageLength": 50
        });
        $('#data_table_4').DataTable({
            "pageLength": 50
        });

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_dashboard').addClass('act_item');

        function padLeft(nr, n, str){
            return Array(n-String(nr).length+1).join(str||'0')+nr;
        }
    </script>

    <script>
        window.onload = function () {
            var chart5 = new CanvasJS.Chart("chartContainer5", {
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                exportEnabled: false,
                animationEnabled: true,
                title: {
                  text: "Top 5 Income Account"
                },
                data: [{
                  type: "pie",
                  startAngle: 25,
                  toolTipContent: "<b>{label}</b>: {y}%",
                  showInLegend: "true",
                  legendText: "{}",
                  indexLabelFontSize: 14,
                  indexLabel: "{label} - {y}%",
                  dataPoints: [
                    {!! $expense_pie !!}
                  ]
                }]
            });

            var chart3 = new CanvasJS.Chart("chartContainer3", {
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                exportEnabled: false,
                animationEnabled: true,
                title: {
                  text: "Top 5 Expense Account"
                },
                data: [{
                  type: "doughnut",
                  startAngle: 25,
                  toolTipContent: "<b>{label}</b>: {y}%",
                  showInLegend: "true",
                  legendText: "{}",
                  indexLabelFontSize: 14,
                  indexLabel: "{label} - {y}%",
                  dataPoints: [
                    {!! $expense_pie2 !!}
                  ]
                }]
            });

            var chart4 = new CanvasJS.Chart("chartContainer4", {
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                exportEnabled: false,
                animationEnabled: true,
                title: {
                  text: "Income and Expense"
                },
                data: [{
                  type: "doughnut",
                  startAngle: 25,
                  toolTipContent: "<b>{label}</b>: {y}",
                  showInLegend: "true",
                  legendText: "{}", //label
                  indexLabelFontSize: 14,
                  indexLabel: "{label} - {y}",
                  dataPoints: [
                    {!! $net_income_pie !!},
                    {!! $net_expnese_pie !!}
                  ]
                }]
            });

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title:{
                    text: "Receivable vs Received ({{ $current_month }} Only)"
                },
                axisY: {
                    title: "Receivable Amount in BDT",
                    titleFontColor: "#4F81BC",
                    lineColor: "#4F81BC",
                    labelFontColor: "#4F81BC",
                    tickColor: "#4F81BC"
                },
                axisY2: {
                    title: "Received Amount in BDT",
                    titleFontColor: "#C0504E",
                    lineColor: "#C0504E",
                    labelFontColor: "#C0504E",
                    tickColor: "#C0504E"
                },
                toolTip: {
                    shared: true
                },
                legend: {
                    cursor:"pointer",
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "column",
                    name: "Receivable Amount in BDT",
                    legendText: "Receivable Amount in BDT",
                    showInLegend: true,
                    dataPoints:[
                        {!!  $daily_receivable_string !!}
                    ]
                },
                {
                    type: "column",
                    name: "Received Amount in BDT",
                    legendText: "Received Amount in BDT",
                    axisYType: "secondary",
                    showInLegend: true,
                    dataPoints:[
                        {!!  $daily_received_string !!}
                    ]
                }]
            });

            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                title:{
                    text: "Payable vs Paid ({{ $current_month }} Only)"
                },
                axisY: {
                    title: "Payable Amount in BDT",
                    titleFontColor: "#4F81BC",
                    lineColor: "#4F81BC",
                    labelFontColor: "#4F81BC",
                    tickColor: "#4F81BC"
                },
                axisY2: {
                    title: "Paid Amount in BDT",
                    titleFontColor: "#C0504E",
                    lineColor: "#C0504E",
                    labelFontColor: "#C0504E",
                    tickColor: "#C0504E"
                },
                toolTip: {
                    shared: true
                },
                legend: {
                    cursor:"pointer",
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "column",
                    name: "Payable Amount in BDT",
                    legendText: "Payable Amount in BDT",
                    showInLegend: true,
                    dataPoints:[
                        {!!  $daily_payable_string !!}
                    ]
                },
                {
                    type: "column",
                    name: "Paid Amount in BDT",
                    legendText: "Paid Amount in BDT",
                    axisYType: "secondary",
                    showInLegend: true,
                    dataPoints:[
                        {!!  $daily_paid_string !!}
                    ]
                }]
            });

            chart.render();
            chart2.render();
            chart3.render();
            chart4.render();
            chart5.render();

            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                }
                else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }
        }
    </script>
    
    {{-- Income and Expense Start--}}
        <script type="text/javascript">
            $('#income_one').on('click',function () {
                $('#income_one').addClass('active');
                $('#income_three').removeClass('active'); 
                $('#income_four').removeClass('active'); 
                $('#income_five').removeClass('active');
                $('#income_five').removeClass('active');  
            });

            $('#income_two').on('click',function () {
                $('#income_one').removeClass('active'); 
                $('#income_two').addClass('active'); 
                $('#income_three').removeClass('active'); 
                $('#income_four').removeClass('active'); 
                $('#income_five').removeClass('active'); 
            });

            $('#income_three').on('click',function () {
                $('#income_one').removeClass('active'); 
                $('#income_two').removeClass('active'); 
                $('#income_three').addClass('active'); 
                $('#income_four').removeClass('active'); 
                $('#income_five').removeClass('active'); 
            });

            $('#income_four').on('click',function () {
                $('#income_one').removeClass('active'); 
                $('#income_two').removeClass('active'); 
                $('#income_three').removeClass('active'); 
                $('#income_four').addClass('active'); 
                $('#income_five').removeClass('active'); 
            });

            $('#income_five').on('click',function () {
                $('#income_one').removeClass('active'); 
                $('#income_two').removeClass('active'); 
                $('#income_three').removeClass('active'); 
                $('#income_four').removeClass('active'); 
                $('#income_five').addClass('active'); 
            });

            function incomeExpense(id) {

                // var value_id   = $('.income-button-design').val();

                // $(".income-button-design a").addClass('active');

                // $(id).addClass('active');
                // $(id).parent().addClass('active');

                function persentage(data_1, data_2) {

                    if(Math.sign(data_1) === -1 && Math.sign(data_2) === -1)
                    {
                        if(data_1 > data_2)
                        {
                            var persent =  Math.abs(((data_1 * 100) / (data_2 != 0 ? data_2 : 1))).toFixed(0);
                            return  Math.abs(persent - 100)+'%';
                        }
                        else if (data_1 == data_2) 
                        {
                        }
                        else
                        {
                            var persent =  Math.abs(((data_2 * 100) / (data_1 != 0 ? data_1 : 1))).toFixed(0);
                            return   Math.abs(persent - 100)+'%';
                        }
                    }
                    else if(Math.sign(data_1) === -1 && Math.sign(data_2) === 1)
                    {
                        var persent =  Math.abs(((data_1 * 100) / (data_2 != 0 ? data_2 : 1))).toFixed(0);
                        return  Math.abs(persent - 100)+'%';
                    }
                    else if(Math.sign(data_1) === 1 && Math.sign(data_2) === -1)
                    {
                        var persent =  Math.abs(((data_1 * 100) / (data_2 != 0 ? data_2 : 1))).toFixed(0);
                        return  Math.abs(persent - 100)+'%';  
                    }
                    else
                    {
                        if(data_1 > data_2)
                        {
                            var persent =  Math.abs(((data_1 * 100) / (data_2 != 0 ? data_2 : 1))).toFixed(0);
                            return  Math.abs(persent - 100)+'%';
                        }
                        else if (data_1 == data_2) 
                        {
                        }
                        else
                        {
                            var persent =  Math.abs(((data_2 * 100) / (data_1 != 0 ? data_1 : 1))).toFixed(0);
                            return   Math.abs(persent - 100)+'%';
                        }
                    }
                        

                }

                var form_date   = $("#expense-form-date").val();
                var to_date     = $("#expense-to-date").val();

                if (form_date == '')
                {
                    var form_date   = 0;
                }

                if (to_date == '')
                {
                    var to_date   = 0;
                }

                if(id == 5 && form_date == '' && to_date == '')
                {
                    $(".income-expense-remove").addClass('hidden');

                    $(".income-expense-form").removeClass('hidden');
                }
                else if(id != 5 )
                {
                    $("#expense-form-date").val('');

                    $("#expense-to-date").val('');

                    $(".income-expense-remove").removeClass('hidden');

                    $(".income-expense-form").addClass('hidden');

                    $.get('{{route('income_and_expense',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {

                        var chart_date              = [];
                        var cost_of_goods_sold      = [];
                        var income_value            = [];
                        var expense_value           = [];
                        var net_profit_value        = [];

                        var start_date              = data.start_date;
                        var end_time                = data.end_time;
                        var start_mounth            = data.start_mounth;
                        var end_mounth              = data.end_mounth;

                        $('.income_expense_start_date').empty();
                        $('.income_expense_start_date').append(start_date);

                        $('.income_expense_end_date').empty();
                        $('.income_expense_end_date').append(end_time);

                        $('.income_expense_start_date_pre').empty();
                        $('.income_expense_start_date_pre').append(start_mounth);

                        $('.income_expense_end_date_pre').empty();
                        $('.income_expense_end_date_pre').append(end_mounth);

                        var income_total        = data.income_total;
                        $('#TotalIncome').empty();
                        $('#TotalIncome').append('&#2547;'+income_total);

                        var pincome_total       = data.pincome_total;
                        $('#PTotalIncome').empty();
                        $('#PTotalIncome').append('vs '+'&#2547;'+pincome_total);

                        if(income_total > pincome_total)
                        {
                            $(".color-for-persent-income").empty();
                            $(".color-for-persent-income").css("color", "green");
                            $(".color-for-persent-income").append('arrow_drop_up');
                        }
                        else if(income_total == pincome_total)
                        {
                            $(".color-for-persent-income").empty();
                        }
                        else
                        {
                            $(".color-for-persent-income").empty();
                            $(".color-for-persent-income").css("color", "red");
                            $(".color-for-persent-income").append('arrow_drop_down');
                        }

                        var persent_income      = persentage(income_total,pincome_total);
                        $('#PersentIncome').empty();
                        $('#PersentIncome').append(persent_income);

                        // var cost_goods          = data.cost_of_goods_sold;
                        // $('#TotalCostOfGoodsSold').empty();
                        // $('#TotalCostOfGoodsSold').append(cost_goods+' BDT');

                        var expense_total       = data.expense_total;
                        $('#TotalExpense').empty();
                        $('#TotalExpense').append('&#2547;'+expense_total);

                        var pexpense_total       = data.pexpense_total;
                        $('#PTotalExpense').empty();
                        $('#PTotalExpense').append('vs '+'&#2547;'+pexpense_total);

                        if(expense_total > pexpense_total)
                        {
                            $(".color-for-persent-expense").empty();
                            $(".color-for-persent-expense").css("color", "green");
                            $(".color-for-persent-expense").append('arrow_drop_up');
                        }
                        else if(expense_total == pexpense_total)
                        {
                            $(".color-for-persent-expense").empty();
                        }
                        else
                        {
                            $(".color-for-persent-expense").empty();
                            $(".color-for-persent-expense").css("color", "red");
                            $(".color-for-persent-expense").append('arrow_drop_down');
                        }

                        var persent_expense      = persentage(expense_total,pexpense_total);;
                        $('#PersentExpense').empty();
                        $('#PersentExpense').append(persent_expense);

                        var net_profit       = data.net_profit;
                        $('#NetProfit').empty();
                        $('#NetProfit').append('&#2547;'+net_profit);

                        var pnet_profit       = data.pnet_profit;
                        $('#PNetProfit').empty();
                        $('#PNetProfit').append('vs '+'&#2547;'+pnet_profit);

                        if(net_profit > pnet_profit)
                        {
                            $(".color-for-persent-net-profits").empty();
                            $(".color-for-persent-net-profits").css("color", "green");
                            $(".color-for-persent-net-profits").append('arrow_drop_up');
                        }
                        else if(net_profit == pnet_profit)
                        {
                            $(".color-for-persent-net-profits").empty();
                        }
                        else
                        {
                            $(".color-for-persent-net-profits").empty();
                            $(".color-for-persent-net-profits").css("color", "red");
                            $(".color-for-persent-net-profits").append('arrow_drop_down');
                        }

                        var persent_netprofit      = persentage(net_profit,pnet_profit);
                        $('#PersentNetProfit').empty();
                        $('#PersentNetProfit').append(persent_netprofit);

                        //receivable start
                        var receivable       = data.receivable;
                        $('#IncomeReceivable').empty();
                        $('#IncomeReceivable').append('&#2547;'+receivable);

                        var preceivable       = data.preceivable;
                        $('#IncomeReceivableP').empty();
                        $('#IncomeReceivableP').append('vs '+'&#2547;'+preceivable);

                        if(receivable > preceivable)
                        {
                            $(".color-for-persent-receivable").empty();
                            $(".color-for-persent-receivable").css("color", "green");
                            $(".color-for-persent-receivable").append('arrow_drop_up');
                        }
                        else if(receivable == preceivable)
                        {
                            $(".color-for-persent-receivable").empty();
                        }
                        else
                        {
                            $(".color-for-persent-receivable").empty();
                            $(".color-for-persent-receivable").css("color", "red");
                            $(".color-for-persent-receivable").append('arrow_drop_down');
                        }

                        var persent_receivable     = persentage(receivable,preceivable);
                        $('#PersentReceivable').empty();
                        $('#PersentReceivable').append(persent_receivable);
                        // receable end

                        // payable start
                        var payable       = data.payable;
                        $('#IncomePayable').empty();
                        $('#IncomePayable').append('&#2547;'+payable);

                        var ppayable       = data.ppayable;
                        $('#IncomePayableP').empty();
                        $('#IncomePayableP').append('vs '+'&#2547;'+ppayable);

                        if(payable > ppayable)
                        {
                            $(".color-for-persent-payable").empty();
                            $(".color-for-persent-payable").css("color", "green");
                            $(".color-for-persent-payable").append('arrow_drop_up');
                        }
                        else if(payable == ppayable)
                        {
                            $(".color-for-persent-payable").empty();
                        }
                        else
                        {
                            $(".color-for-persent-payable").empty();
                            $(".color-for-persent-payable").css("color", "red");
                            $(".color-for-persent-payable").append('arrow_drop_down');
                        }

                        var persent_payable     = persentage(payable,ppayable);
                        $('#PersentPayable').empty();
                        $('#PersentPayable').append(persent_payable);

                        //payable end

                        // cash in hand start
                        var cash_in_hand        = data.current_cash_in_hand;
                        $('#IncomeCashInHand').empty();
                        $('#IncomeCashInHand').append('&#2547;'+cash_in_hand);

                        var pcash_in_hand       = data.previous_cash_inhand;
                        $('#IncomeCashInHandP').empty();
                        $('#IncomeCashInHandP').append('vs '+'&#2547;'+pcash_in_hand);

                        if(cash_in_hand > pcash_in_hand)
                        {
                            $(".color-for-persent-cash-hand").empty();
                            $(".color-for-persent-cash-hand").css("color", "green");
                            $(".color-for-persent-cash-hand").append('arrow_drop_up');
                        }
                        else if(cash_in_hand == pcash_in_hand)
                        {
                            $(".color-for-persent-cash-hand").empty();
                        }
                        else
                        {
                            $(".color-for-persent-cash-hand").empty();
                            $(".color-for-persent-cash-hand").css("color", "red");
                            $(".color-for-persent-cash-hand").append('arrow_drop_down');
                        }

                        var persent_pcash_in_hand     = persentage(cash_in_hand,pcash_in_hand);
                        $('#PersentCashInHand').empty();
                        $('#PersentCashInHand').append(persent_pcash_in_hand);

                        //cash in hand end

                        // cash in Bank start
                        var cash_in_bank        = data.total_bank;
                        $('#IncomeCashInBank').empty();
                        $('#IncomeCashInBank').append('&#2547;'+cash_in_bank);

                        var pcash_in_bank       = data.ptotal_bank;
                        $('#IncomeCashInBankP').empty();
                        $('#IncomeCashInBankP').append('vs '+'&#2547;'+pcash_in_bank);

                        if(cash_in_bank > pcash_in_bank)
                        {
                            $(".color-for-persent-cash-bank").empty();
                            $(".color-for-persent-cash-bank").css("color", "green");
                            $(".color-for-persent-cash-bank").append('arrow_drop_up');
                        }
                        else if(cash_in_bank == pcash_in_bank)
                        {
                            $(".color-for-persent-cash-bank").empty();
                        }
                        else
                        {
                            $(".color-for-persent-cash-bank").empty();
                            $(".color-for-persent-cash-bank").css("color", "red");
                            $(".color-for-persent-cash-bank").append('arrow_drop_down');
                        }

                        var persent_pcash_in_bank     = persentage(cash_in_bank,pcash_in_bank);
                        $('#PersentCashInBank').empty();
                        $('#PersentCashInBank').append(persent_pcash_in_bank);

                        //cash in Bank end

                        $.each(data.time_slat_income_value,function (s, value) {
                            income_value.push(value);
                            chart_date.push(s);
                        });

                        $.each(data.time_slat_value,function (s, value) {
                            cost_of_goods_sold.push(value);
                        });

                        $.each(data.time_slat_expense_value,function (s, value) {
                            expense_value.push(value);
                        });

                        $.each(data.net_profite_time_slat,function (s, value) {
                            net_profit_value.push(value);
                        });

                        //view chart start
                        var myChart = echarts.init(document.getElementById('incomeExpense'));

                        var colors = ['#5793f3', '#d14a61', '#675bba','#003366'];

                        option = {
                            color: colors,
                           
                            tooltip: {
                                trigger: 'axis'
                            },
                            legend: {
                                data:['Income','Cost of goods sold','Expense','Net Profit'],
                                x:'right'
                            },
                            grid: {
                                left: '0%',
                                right: '1%',
                                bottom: '3%',
                                top:'15%',
                                containLabel: true
                            },
                            xAxis: {
                                type: 'category',
                                boundaryGap: false,
                                data: chart_date
                            },
                            yAxis: {
                                type: 'value'
                            },
                            series: [
                                {
                                    name:'Income',
                                    type:'line',
                                    smooth: true,
                                    data:income_value
                                },
                                {
                                    name:'Cost of goods sold',
                                    type:'line',
                                    smooth: true,
                                    data: cost_of_goods_sold
                                },
                                {
                                    name:'Expense',
                                    type:'line',
                                    smooth: true,
                                    data:expense_value
                                },
                                {
                                    name:'Net Profit',
                                    type:'line',
                                    smooth: true,
                                    data: net_profit_value
                                },
                            ]
                        };

                        var incomeExpense = option;
                        myChart.setOption(incomeExpense);
                        //view chart end
                    });  
                }
                else
                {
                    $.get('{{route('income_and_expense',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {
                       
                        var chart_date              = [];
                        var cost_of_goods_sold      = [];
                        var income_value            = [];
                        var expense_value           = [];
                        var net_profit_value        = [];

                        var start_date              = data.start_date;
                        var end_time                = data.end_time;
                        var start_mounth            = data.start_mounth;
                        var end_mounth              = data.end_mounth;

                        $('.income_expense_start_date').empty();
                        $('.income_expense_start_date').append(start_date);

                        $('.income_expense_end_date').empty();
                        $('.income_expense_end_date').append(end_time);

                        $('.income_expense_start_date_pre').empty();
                        $('.income_expense_start_date_pre').append(start_mounth);

                        $('.income_expense_end_date_pre').empty();
                        $('.income_expense_end_date_pre').append(end_mounth);

                        var income_total        = data.income_total;
                        $('#TotalIncome').empty();
                        $('#TotalIncome').append('&#2547;'+income_total);

                        var pincome_total       = data.pincome_total;
                        $('#PTotalIncome').empty();
                        $('#PTotalIncome').append('vs '+'&#2547;'+pincome_total);

                        if(income_total > pincome_total)
                        {
                            $(".color-for-persent-income").empty();
                            $(".color-for-persent-income").css("color", "green");
                            $(".color-for-persent-income").append('arrow_drop_up');
                        }
                        else if(income_total == pincome_total)
                        {
                            $(".color-for-persent-income").empty();
                        }
                        else
                        {
                            $(".color-for-persent-income").empty();
                            $(".color-for-persent-income").css("color", "red");
                            $(".color-for-persent-income").append('arrow_drop_down');
                        }

                        var persent_income      = persentage(income_total,pincome_total);
                        $('#PersentIncome').empty();
                        $('#PersentIncome').append(persent_income);

                        // var cost_goods          = data.cost_of_goods_sold;
                        // $('#TotalCostOfGoodsSold').empty();
                        // $('#TotalCostOfGoodsSold').append(cost_goods+' BDT');

                        var expense_total       = data.expense_total;
                        $('#TotalExpense').empty();
                        $('#TotalExpense').append('&#2547;'+expense_total);

                        var pexpense_total       = data.pexpense_total;
                        $('#PTotalExpense').empty();
                        $('#PTotalExpense').append('vs '+'&#2547;'+pexpense_total);

                        if(expense_total > pexpense_total)
                        {
                            $(".color-for-persent-expense").csempty();
                            $(".color-for-persent-expense").css("color", "green");
                            $(".color-for-persent-expense").append('arrow_drop_up');
                        }
                        else if(expense_total == pexpense_total)
                        {
                            $(".color-for-persent-expense").empty();
                        }
                        else
                        {
                            $(".color-for-persent-expense").empty();
                            $(".color-for-persent-expense").css("color", "red");
                            $(".color-for-persent-expense").append('arrow_drop_down');
                        }

                        var persent_expense      = persentage(expense_total,pexpense_total);;
                        $('#PersentExpense').empty();
                        $('#PersentExpense').append(persent_expense);

                        var net_profit       = data.net_profit;
                        $('#NetProfit').empty();
                        $('#NetProfit').append('&#2547;'+net_profit);

                        var pnet_profit       = data.pnet_profit;
                        $('#PNetProfit').empty();
                        $('#PNetProfit').append('vs '+'&#2547;'+pnet_profit);

                        if(net_profit > pnet_profit)
                        {
                            $(".color-for-persent-net-profits").empty();
                            $(".color-for-persent-net-profits").css("color", "green");
                            $(".color-for-persent-net-profits").append('arrow_drop_up');
                        }
                        else if(net_profit == pnet_profit)
                        {
                            $(".color-for-persent-net-profits").empty();
                        }
                        else
                        {
                            $(".color-for-persent-net-profits").empty();
                            $(".color-for-persent-net-profits").css("color", "red");
                            $(".color-for-persent-net-profits").append('arrow_drop_down');
                        }

                        var persent_netprofit      = persentage(net_profit,pnet_profit);
                        $('#PersentNetProfit').empty();
                        $('#PersentNetProfit').append(persent_netprofit);

                        //receivable start
                        var receivable       = data.receivable;
                        $('#IncomeReceivable').empty();
                        $('#IncomeReceivable').append('&#2547;'+receivable);

                        var preceivable       = data.preceivable;
                        $('#IncomeReceivableP').empty();
                        $('#IncomeReceivableP').append('vs '+'&#2547;'+preceivable);

                        if(receivable > preceivable)
                        {
                            $(".color-for-persent-receivable").empty();
                            $(".color-for-persent-receivable").css("color", "green");
                            $(".color-for-persent-receivable").append('arrow_drop_up');
                        }
                        else if(receivable == preceivable)
                        {
                            $(".color-for-persent-receivable").empty();
                        }
                        else
                        {
                            $(".color-for-persent-receivable").empty();
                            $(".color-for-persent-receivable").css("color", "red");
                            $(".color-for-persent-receivable").append('arrow_drop_down');
                        }

                        var persent_receivable     = persentage(receivable,preceivable);
                        $('#PersentReceivable').empty();
                        $('#PersentReceivable').append(persent_receivable);
                        // receable end

                        // payable start
                        var payable       = data.payable;
                        $('#IncomePayable').empty();
                        $('#IncomePayable').append('&#2547;'+payable);

                        var ppayable       = data.ppayable;
                        $('#IncomePayableP').empty();
                        $('#IncomePayableP').append('vs '+'&#2547;'+ppayable);

                        if(payable > ppayable)
                        {
                            $(".color-for-persent-payable").empty();
                            $(".color-for-persent-payable").css("color", "green");
                            $(".color-for-persent-payable").append('arrow_drop_up');
                        }
                        else if(payable == ppayable)
                        {
                            $(".color-for-persent-payable").empty();
                        }
                        else
                        {
                            $(".color-for-persent-payable").empty();
                            $(".color-for-persent-payable").css("color", "red");
                            $(".color-for-persent-payable").append('arrow_drop_down');
                        }

                        var persent_payable     = persentage(payable,ppayable);
                        $('#PersentPayable').empty();
                        $('#PersentPayable').append(persent_payable);

                        //payable end

                        // cash in hand start
                        var cash_in_hand        = data.current_cash_in_hand;
                        $('#IncomeCashInHand').empty();
                        $('#IncomeCashInHand').append('&#2547;'+cash_in_hand);

                        var pcash_in_hand       = data.previous_cash_inhand;
                        $('#IncomeCashInHandP').empty();
                        $('#IncomeCashInHandP').append('vs '+'&#2547;'+pcash_in_hand);

                        if(cash_in_hand > pcash_in_hand)
                        {
                            $(".color-for-persent-cash-hand").empty();
                            $(".color-for-persent-cash-hand").css("color", "green");
                            $(".color-for-persent-cash-hand").append('arrow_drop_up');
                        }
                        else if(cash_in_hand == pcash_in_hand)
                        {
                            $(".color-for-persent-cash-hand").empty();
                        }
                        else
                        {
                            $(".color-for-persent-cash-hand").empty();
                            $(".color-for-persent-cash-hand").css("color", "red");
                            $(".color-for-persent-cash-hand").append('arrow_drop_down');
                        }

                        var persent_pcash_in_hand     = persentage(cash_in_hand,pcash_in_hand);
                        $('#PersentCashInHand').empty();
                        $('#PersentCashInHand').append(persent_pcash_in_hand);

                        //cash in hand end

                        // cash in Bank start
                        var cash_in_bank        = data.total_bank;
                        $('#IncomeCashInBank').empty();
                        $('#IncomeCashInBank').append('&#2547;'+cash_in_bank);

                        var pcash_in_bank       = data.ptotal_bank;
                        $('#IncomeCashInBankP').empty();
                        $('#IncomeCashInBankP').append('vs '+'&#2547;'+pcash_in_bank);

                        if(cash_in_bank > pcash_in_bank)
                        {
                            $(".color-for-persent-cash-bank").empty();
                            $(".color-for-persent-cash-bank").css("color", "green");
                            $(".color-for-persent-cash-bank").append('arrow_drop_up');
                        }
                        else if(cash_in_bank == pcash_in_bank)
                        {
                            $(".color-for-persent-cash-bank").empty();
                        }
                        else
                        {
                            $(".color-for-persent-cash-bank").empty();
                            $(".color-for-persent-cash-bank").css("color", "red");
                            $(".color-for-persent-cash-bank").append('arrow_drop_down');
                        }

                        var persent_pcash_in_bank     = persentage(cash_in_bank,pcash_in_bank);
                        $('#PersentCashInBank').empty();
                        $('#PersentCashInBank').append(persent_pcash_in_bank);

                        //cash in Bank end

                        $.each(data.time_slat_income_value,function (s, value) {
                            income_value.push(value);
                            chart_date.push(s);
                        });

                        $.each(data.time_slat_value,function (s, value) {
                            cost_of_goods_sold.push(value);
                        });

                        $.each(data.time_slat_expense_value,function (s, value) {
                            expense_value.push(value);
                        });

                        $.each(data.net_profite_time_slat,function (s, value) {
                            net_profit_value.push(value);
                        });

                        //view chart start
                        var myChart = echarts.init(document.getElementById('incomeExpense'));

                        var colors = ['#5793f3', '#d14a61', '#675bba','#003366'];

                        option = {
                            color: colors,
                           
                            tooltip: {
                                trigger: 'axis'
                            },
                            legend: {
                                data:['Income','Cost of goods sold','Expense','Net Profit'],
                                x:'right'
                            },
                            grid: {
                                left: '0%',
                                right: '1%',
                                bottom: '3%',
                                top:'15%',
                                containLabel: true
                            },
                            xAxis: {
                                type: 'category',
                                boundaryGap: false,
                                data: chart_date
                            },
                            yAxis: {
                                type: 'value'
                            },
                            series: [
                                {
                                    name:'Income',
                                    type:'line',
                                    smooth: true,
                                    data:income_value
                                },
                                {
                                    name:'Cost of goods sold',
                                    type:'line',
                                    smooth: true,
                                    data: cost_of_goods_sold
                                },
                                {
                                    name:'Expense',
                                    type:'line',
                                    smooth: true,
                                    data:expense_value
                                },
                                {
                                    name:'Net Profit',
                                    type:'line',
                                    smooth: true,
                                    data: net_profit_value
                                },
                            ]
                        };

                        var incomeExpense = option;
                        myChart.setOption(incomeExpense);
                        //view chart end
                    });  
                }
            }

            setTimeout(incomeExpense(1),100);  
        </script>
    {{-- Income and Expense End--}}

    {{-- AP/AR Start --}}
        <script type="text/javascript">
            $.get('{{route('dashboard_ap_ar')}}',function (data) {

                var payable         = [];
                var receivable      = [];

                $.each(data.payable,function (i,value) {
                    payable.push(value);
                });

                $.each(data.receivable,function (i,value) {
                    receivable.push(value);
                });

                var myChart = echarts.init(document.getElementById('AccountPayableReceivable'));

                option = {
                        color: ['#5290E9', '#A9CCFF'],
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            data: ['Account Payable', 'Account Received']
                        },
                        label: {

                        },
                        grid: {
                            left: '0%',
                            right: '1%',
                            bottom: '3%',
                            top:'12%',
                            containLabel: true
                        },
                        calculable: true,
                        xAxis: [
                            {
                                type: 'category',
                                axisTick: {show: false},
                                data: ['0-30', '31-60', '61-90', '91+']
                            }
                        ],
                        yAxis: [
                            {
                                type: 'value'
                            }
                        ],
                        series: [
                            {
                                name: 'Account Payable',
                                type: 'bar',
                                barGap: 0,
                                data: payable
                            },
                            {
                                name: 'Account Received',
                                type: 'bar',
                                data: receivable
                            }
                        ]
                    };

                var cashflow = option;
                myChart.setOption(cashflow);
            });
        </script>
    {{-- AP/AR End  --}}

    {{-- Sales Summary Start --}}
        <script type="text/javascript">
            $.get('{{route('sales_summary')}}',function (data) {

                var invoices                = '';
                var invoices1               = '';
                var invoice_total_sum       = '';
                var invoice_total           = 0;

                var bills                   = '';
                var bills1                  = '';
                var bill_total_sum          = '';
                var bill_total              = 0;

                var revenue                 = '';
                var revenue1                = '';
                var revenue_total_sum       = '';
                var revenue_total           = 0;

                var expense                 = '';
                var expense1                = '';
                var expense_total_sum       = '';
                var expense_total           = 0;

                //invoice summary start
                $.each(data.invoices,function (i,value) {
                    invoices +='<tr>'+
                                '<td class="col-xs-4">'+value.display_name+'</td>'+
                                '<td class="col-xs-4" style="text-align: right">'+value.total_amount+'</td>'+
                                '<td class="col-xs-4" style="text-align: right">'+'INV-'+value.invoice_number+'</td>'+
                            '</tr>';  
                    invoice_total+=value.total_amount; 
                });

                invoices1 = '<tr>'+
                                '<td class="col-xs-4" style="text-align: right"><b>Total</b></td>'+
                                '<td class="col-xs-4" style="text-align: right"><b>'+invoice_total+'</b></td>'+
                                '<td class="col-xs-4"></td>'+
                            '</tr>';
                invoice_total_sum = ' &#2547;'+invoice_total;

                $('#salesSummary').empty(invoices);
                $('#salesSummary').empty(invoices1);
                $('#salesTotalUp').empty(invoice_total_sum);
                $('#salesSummary').append(invoices);
                $('#salesTotalUp').append(invoice_total_sum);
                $('#salesSummary').append(invoices1);
                //Invoice Summary End

                //Bill Summary Start
                $.each(data.bills,function (j,value) {
                    bills +='<tr>'+
                            '<td class="col-xs-4">'+value.display_name+'</td>'+
                            '<td class="col-xs-4" style="text-align: right">'+value.amount+'</td>'+
                            '<td class="col-xs-4" style="text-align: right">'+'BILL-'+value.bill_number+'</td>'+
                            '</tr>';

                    bill_total +=value.amount;    
                });

                bills1      = '<tr>'+
                                '<td class="col-xs-4" style="text-align: right"><b>Total</b></td>'+
                                '<td class="col-xs-4" style="text-align: right"><b>'+bill_total+'</b></td>'+
                                '<td class="col-xs-4"></td>'+
                            '</tr>';

                bill_total_sum = ' &#2547;'+bill_total;
                       
                $('#billSummary').empty(bills);
                $('#billSummary').empty(bills1);
                $('#billTotalUp').empty(bill_total_sum);
                $('#billSummary').append(bills);
                $('#billTotalUp').append(bill_total_sum);
                $('#billSummary').append(bills1);
                //Bill Summary End

                //Revenue Summary Start
                $.each(data.income_payment,function (j,value) {
                    revenue +='<tr>'+
                            '<td class="col-xs-4">'+value.display_name+'</td>'+
                            '<td class="col-xs-4" style="text-align: right">'+value.amount+'</td>'+
                            '<td class="col-xs-4" style="text-align: right">'+value.in_pr_number+'</td>'+
                            '</tr>';

                    revenue_total += value.amount;    
                });

                revenue1      = '<tr>'+
                                '<td class="col-xs-4" style="text-align: right"><b>Total</b></td>'+
                                '<td class="col-xs-4" style="text-align: right"><b>'+revenue_total+'</b></td>'+
                                '<td class="col-xs-4"></td>'+
                            '</tr>';

                revenue_total_sum = ' &#2547;'+revenue_total;
                       
                $('#revenueSummary').empty(revenue);
                $('#revenueSummary').empty(revenue1);
                $('#revenueTotalUp').empty(revenue_total_sum);
                $('#revenueSummary').append(revenue);
                $('#revenueTotalUp').append(revenue_total_sum);
                $('#revenueSummary').append(revenue1);
                //Revenue Summary End 

                //Expense Summary Start
                $.each(data.expense_payment,function (k,value) {
                    expense +='<tr>'+
                            '<td class="col-xs-4">'+value.display_name+'</td>'+
                            '<td class="col-xs-4" style="text-align: right">'+value.amount+'</td>'+
                            '<td class="col-xs-4" style="text-align: right">'+value.ex_pm_number+'</td>'+
                            '</tr>'; 

                    expense_total += value.amount;    
                });

                expense1    = '<tr>'+
                                '<td class="col-xs-4" style="text-align: right"><b>Total</b></td>'+
                                '<td class="col-xs-4" style="text-align: right"><b>'+expense_total+'</b></td>'+
                                '<td class="col-xs-4"></td>'+
                            '</tr>';

                expense_total_sum = ' &#2547;'+expense_total;
                       
                $('#ExpenseSummary').empty(expense);
                $('#ExpenseSummary').empty(expense1);
                $('#ExpenseSummaryUp').empty(expense_total_sum);
                $('#ExpenseSummary').append(expense);
                $('#ExpenseSummaryUp').append(expense_total_sum);
                $('#ExpenseSummary').append(expense1);
                //Expese Summary End

            });
        </script>    
    {{-- Sales Summary End --}}

    {{-- Cash Flow Start--}}
        <script type="text/javascript">
            $.get('{{route('cash_flow_dash')}}', function (data) {
              
                var income      = [];
                var expense     = [];
                var cashflow    = [];

                $.each(data.income, function (i, value) {
                    console.log(value);
                    income.push(value);
                });

                $.each(data.expense, function (j, value) {
                    expense.push(value);
                });

                $.each(data.cashflow, function (k, value) {
                    cashflow.push(value);
                });

                var myChart = echarts.init(document.getElementById('cashFlow'));
               
                option = {
                    color: ['#5290E9', '#e5323e','#7FB547'],
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'cross',
                            crossStyle: {
                                color: '#999'
                            }
                        }
                    },
                    legend: {
                        data:['Income','Expense','Cash Flow']
                    },
                    grid: {
                        left: '12%',
                        right: '1%',
                        bottom: '8%',
                        top:'10%',
                    },
                    xAxis: [
                        {
                            type: 'category',
                            data: ['Jan', 'Feb', 'Mar', 'App', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            axisPointer: {
                                type: 'shadow'
                            }
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                        }
                    ],
                    series: [
                        {
                            name:'Income',
                            type:'bar',
                            data:income
                        },
                        {
                            name:'Expense',
                            type:'bar',
                            data:expense
                        },
                        {
                            name:'Cash Flow',
                            type:'line',
                            smooth: true,
                            data:cashflow
                        }
                    ]
                };
                var cashflow = option;
                myChart.setOption(cashflow);
            });
        </script>
    {{-- Cash Flow End  --}}

    {{-- sales Graph Start --}}
        <script type="text/javascript">
            function salesGraph() {
                $.get('{{route('sales_dashboard')}}',function (data) {
                        var mounth               = [];
                        var amount               = [];

                        $.each(data,function (e, value) {
                            mounth.push(e);
                            amount.push(value.amount);
                        });
                        
                        var myChart = echarts.init(document.getElementById('salesBar'));

                        colors = ['#00C8C4'];
                        option = {
                            color:colors,
                            tooltip : {
                                trigger: 'axis',
                                
                            },
                            grid: {
                                left: '12%',
                                right: '1%',
                                bottom: '8%',
                                top:'10%',
                            },
                            xAxis : [
                                {
                                    type : 'category',
                                    data : mounth
                                }
                            ],
                            yAxis : [
                                {
                                    type : 'value',
                                }
                            ],
                            series : [
                                {
                                    name:'Sales',
                                    type:'bar',
                                    data:amount
                                }
                            ]
                        };

                        var salesY = option;
                        myChart.setOption(salesY);
                });
            }
            setTimeout(salesGraph,300);
        </script>
    {{-- sales Graph End --}}

    {{-- Receivable vs Recived Start  --}}
        <script type="text/javascript">
            function receivableRecived() {
                var id          = $('#SelectReceivablePayable').val();
                var form_date   = $("#receivable-form-date").val();
                var to_date     = $("#receivable-to-date").val();

                if (form_date == '')
                {
                    var form_date   = 0;
                }

                if (to_date == '')
                {
                    var to_date   = 0;
                }

                if(id == 5 && form_date == '' && to_date == '')
                {
                    $(".receivable-remove").addClass('hidden');

                    $(".receivable-form").removeClass('hidden');
                }
                else if(id != 5 )
                {
                    $("#receivable-form-date").val('');

                    $("#receivable-to-date").val('');

                    $(".receivable-remove").removeClass('hidden');

                    $(".receivable-form").addClass('hidden');

                    $.get('{{route('receivable_and_received',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {

                        var receivable              = [];
                        var received                = [];
                        var chart_time_range        = [];

                        var start_date              = data.start_date;
                        var end_date                = data.end_date;

                        $('.receivable_start_date').empty();
                        $('.receivable_start_date').append(start_date);

                        $('.receivable_end_date').empty();
                        $('.receivable_end_date').append(end_date);


                        $.each(data.receivable,function (e, value) {
                            receivable.push(value);
                        });

                        $.each(data.received,function (s, value) {
                            received.push(value);
                        });

                        $.each(data.time_slat,function (s, value) {
                            var months = ["Jan","Feb","Mar","April","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                            var now_one             = new Date(value[0]);
                            var now_two             = new Date(value[1]);
                            chart_time_range.push(months[now_one.getMonth()]+''+now_one.getDate()+'-'+months[now_two.getMonth()]+''+now_two.getDate());
                        });

                        var myChart = echarts.init(document.getElementById('receivableRecived'));

                        option = {
                            color: ['#4cabce', '#e5323e'],
                            tooltip: {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'shadow'
                                }
                            },
                            legend: {
                                data: ['Receivable', 'Received']
                            },
                            grid: {
                                left: '0%',
                                right: '1%',
                                bottom: '3%',
                                top:'10%',
                                containLabel: true
                            },
                            calculable: true,
                            xAxis: [
                                {
                                    type: 'category',
                                    axisTick: {show: false},
                                    data: chart_time_range
                                }
                            ],
                            yAxis: [
                                {
                                    type: 'value'
                                }
                            ],
                            series: [
                                {
                                    name: 'Receivable',
                                    type: 'bar',
                                    barGap: 0,
                                    data: receivable
                                },
                                {
                                    name: 'Received',
                                    type: 'bar',
                                    data: received
                                }
                            ]
                        };
                        var receivable = option;
                        myChart.setOption(receivable);
                    });
                }
                else
                {
                    $.get('{{route('receivable_and_received',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {

                        var receivable              = [];
                        var received                = [];
                        var chart_time_range        = [];

                        var start_date              = data.start_date;
                        var end_date                = data.end_date;

                        $('.receivable_start_date').empty();
                        $('.receivable_start_date').append(start_date);

                        $('.receivable_end_date').empty();
                        $('.receivable_end_date').append(end_date);


                        $.each(data.receivable,function (e, value) {
                            receivable.push(value);
                        });

                        $.each(data.received,function (s, value) {
                            received.push(value);
                        });

                        $.each(data.time_slat,function (s, value) {
                            var months = ["Jan","Feb","Mar","April","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                            var now_one             = new Date(value[0]);
                            var now_two             = new Date(value[1]);
                            chart_time_range.push(months[now_one.getMonth()]+''+now_one.getDate()+'-'+months[now_two.getMonth()]+''+now_two.getDate());
                        });

                        var myChart = echarts.init(document.getElementById('receivableRecived'));

                        option = {
                            color: ['#4cabce', '#e5323e'],
                            tooltip: {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'shadow'
                                }
                            },
                            legend: {
                                data: ['Receivable', 'Received']
                            },
                            grid: {
                                left: '0%',
                                right: '1%',
                                bottom: '3%',
                                top:'10%',
                                containLabel: true
                            },
                            calculable: true,
                            xAxis: [
                                {
                                    type: 'category',
                                    axisTick: {show: false},
                                    data: chart_time_range
                                }
                            ],
                            yAxis: [
                                {
                                    type: 'value'
                                }
                            ],
                            series: [
                                {
                                    name: 'Receivable',
                                    type: 'bar',
                                    barGap: 0,
                                    data: receivable
                                },
                                {
                                    name: 'Received',
                                    type: 'bar',
                                    data: received
                                }
                            ]
                        };
                        var receivable = option;
                        myChart.setOption(receivable);
                    });
                }
            }
            setTimeout(receivableRecived,300);
        </script>
    {{-- Receivable vs Recived End  --}}

    {{-- payable vs paid Start  --}}
        <script type="text/javascript">
            function payablePaid() {
                var id          = $('#PayablePaidSelect').val();
                var form_date   = $("#payable-form-date").val();
                var to_date     = $("#payable-to-date").val();

                if (form_date == '')
                {
                    var form_date   = 0;
                }

                if (to_date == '')
                {
                    var to_date   = 0;
                }

                if(id == 5 && form_date == '' && to_date == '')
                {
                    $(".payable-remove").addClass('hidden');

                    $(".payable-form").removeClass('hidden');
                }
                else if(id != 5 )
                {
                    $("#payable-form-date").val('');

                    $("#payable-to-date").val('');

                    $(".payable-remove").removeClass('hidden');

                    $(".payable-form").addClass('hidden');

                    $.get('{{route('payable_and_paid',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {

                        var payable                 = [];
                        var paid                    = [];
                        var chart_time_range        = [];

                        var start_date              = data.start_date;
                        var end_date                = data.end_date;

                        $('.payable_start_date').empty();
                        $('.payable_start_date').append(start_date);

                        $('.payable_end_date').empty();
                        $('.payable_end_date').append(end_date);


                        $.each(data.payable,function (e, value) {
                            payable.push(value);
                        });

                        $.each(data.paid,function (s, value) {
                            paid.push(value);
                        });

                        $.each(data.time_slat,function (s, value) {
                            var months = ["Jan","Feb","Mar","April","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                            var now_one             = new Date(value[0]);
                            var now_two             = new Date(value[1]);
                            chart_time_range.push(months[now_one.getMonth()]+''+now_one.getDate()+'-'+months[now_two.getMonth()]+''+now_two.getDate());
                        });

                        var myChart = echarts.init(document.getElementById('payablePaid'));

                        option = {
                            color: ['#558ED5', '#F26F56'],
                            tooltip: {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'shadow'
                                }
                            },
                            legend: {
                                data: ['Payable', 'Paid']
                            },
                            grid: {
                                left: '0%',
                                right: '1%',
                                bottom: '3%',
                                top:'10%',
                                containLabel: true
                            },
                            calculable: true,
                            xAxis: [
                                {
                                    type: 'category',
                                    axisTick: {show: false},
                                    data: chart_time_range
                                }
                            ],
                            yAxis: [
                                {
                                    type: 'value'
                                }
                            ],
                            series: [
                                {
                                    name: 'Payable',
                                    type: 'bar',
                                    barGap: 0,
                                    data: payable
                                },
                                {
                                    name: 'Paid',
                                    type: 'bar',
                                    data: paid
                                }
                            ]
                        };
                        var receivable = option;
                        myChart.setOption(receivable);
                    });
                }
                else
                {
                    $.get('{{route('payable_and_paid',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {

                        var payable                 = [];
                        var paid                    = [];
                        var chart_time_range        = [];

                        var start_date              = data.start_date;
                        var end_date                = data.end_date;

                        $('.payable_start_date').empty();
                        $('.payable_start_date').append(start_date);

                        $('.payable_end_date').empty();
                        $('.payable_end_date').append(end_date);


                        $.each(data.payable,function (e, value) {
                            payable.push(value);
                        });

                        $.each(data.paid,function (s, value) {
                            paid.push(value);
                        });

                        $.each(data.time_slat,function (s, value) {
                            var months = ["Jan","Feb","Mar","April","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                            var now_one             = new Date(value[0]);
                            var now_two             = new Date(value[1]);
                            chart_time_range.push(months[now_one.getMonth()]+''+now_one.getDate()+'-'+months[now_two.getMonth()]+''+now_two.getDate());
                        });

                        var myChart = echarts.init(document.getElementById('payablePaid'));

                        option = {
                            color: ['#558ED5', '#F26F56'],
                            tooltip: {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'shadow'
                                }
                            },
                            legend: {
                                data: ['Payable', 'Paid']
                            },
                            grid: {
                                left: '0%',
                                right: '1%',
                                bottom: '3%',
                                top:'10%',
                                containLabel: true
                            },
                            calculable: true,
                            xAxis: [
                                {
                                    type: 'category',
                                    axisTick: {show: false},
                                    data: chart_time_range
                                }
                            ],
                            yAxis: [
                                {
                                    type: 'value'
                                }
                            ],
                            series: [
                                {
                                    name: 'Payable',
                                    type: 'bar',
                                    barGap: 0,
                                    data: payable
                                },
                                {
                                    name: 'Paid',
                                    type: 'bar',
                                    data: paid
                                }
                            ]
                        };
                        var receivable = option;
                        myChart.setOption(receivable);
                    });
                }
            }
            setTimeout(payablePaid,350);
            
        </script>
    {{-- Receivable vs Recived End  --}}

    {{--  Revenue start --}}
        <script type="text/javascript">
            function revenue() {
              
                var form_date    =  $('#revenue-form-date').val();

                var to_date      =  $('#revenue-to-date').val();

                var id           =  $('#SelectTimeDurationRevenue').val();

         

                if (form_date == '')
                {
                    var form_date   = 0;
                }

                if (to_date == '')
                {
                    var to_date   = 0;
                }

                if(id == 5 && form_date == '' && to_date == '')
                {
                    $(".revenue-form").removeClass('hidden');

                    $(".revenue-remove").addClass('hidden');

                    $(".preview-revenue-remove").addClass('hidden');
                }
                else if(id != 5 )
                {
                    $("#revenue-form").val('');

                    $("#revenue-to").val('');

                    $(".revenue-form").addClass('hidden');

                    $(".revenue-remove").removeClass('hidden');

                    $(".preview-revenue-remove").removeClass('hidden');

                    $.get('{{route('revenue_dashboard',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {
                       
                        var start_date           = data.start_date;

                        var end_date             = data.end_date;

                        var start_mounth         = data.start_mounth;

                        var end_mounth           = data.end_mounth;

                        var expense_per          = 0;

                        var pexpense_per         = 0;

                        // var one_amount           = -50;

                        // var two_amount           = 150;

                        // var min_amount           = Math.min(one_amount,two_amount);
                        // var max_amount           = Math.max(one_amount,two_amount);

                        // var divi_amount          = ((min_amount*100)/max_amount);

                        // alert(divi_amount);

                        // if(data.revenue < 0 &&  data.prevenue < 0)
                        // {
                        //     var data_revenue  = (-1) * data.revenue;
                        //     var data_prevenue = (-1) * data.prevenue;
                        // }
                        // else if(data.revenue < 0 &&  data.prevenue >= 0 )
                        // {
                        //     var data_revenue  = (-1) * data.revenue;
                        //     var data_prevenue = data.prevenue;
                        // }
                        // else if(data.revenue >= 0 &&  data.prevenue < 0 )
                        // {
                        //     var data_revenue  = data.revenue;
                        //     var data_prevenue = (-1) * data.prevenue;
                        // }
                        // else
                        // {
                        //     var data_revenue  =  data.revenue;
                        //     var data_prevenue =  data.prevenue;
                        // }

                        var min_amount      = Math.min(data.revenue,data.prevenue );

                        if(data.revenue == 0 && data.prevenue == 0)
                        {
                            revenue_per         = 0;
                            prevenue_per        = 0;
                        }
                        else if(data.revenue >= min_amount)
                        {

                            revenue_per         = 100;

                            prevenue_per        = (((data.prevenue)*100) / (data.revenue)).toFixed(2);

                        }
                        else
                        {
                            prevenue_per    = 100;

                            revenue_per    = (((data.revenue) *100) / (data.prevenue)).toFixed(2);
                        }

                        $('.revenue_start_date').empty();
                        $('.preview_revenue_start_date').empty();

                        $('.revenue_start_date').append(start_date);
                        $('.preview_revenue_start_date').append(start_mounth);

                        $('.revenue_end_date').empty();
                        $('.preview_revenue_end_date').empty();

                        $('.revenue_end_date').append(end_date);
                        $('.preview_revenue_end_date').append(end_mounth);

                        $('#revenue-current').empty();
                        $('#revenue-previous').empty();

                        $('#revenue-current').append(data.revenue);
                        $('#revenue-previous').append(data.prevenue);

                        $('#revenueCurrent').empty();
                        $('#revenuePrevious').empty();

                        $('#revenueCurrent').css('width',revenue_per+'%');
                        $('#revenuePrevious').css('width',prevenue_per+'%');
                    });   
                }
                else 
                {
                    $.get('{{route('revenue_dashboard',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {
                       
                        var start_date           = data.start_date;

                        var end_date             = data.end_date;

                        var start_mounth         = data.start_mounth;

                        var end_mounth           = data.end_mounth;

                        var expense_per          = 0;

                        var pexpense_per         = 0;
                        
                        // if(data.revenue < 0 &&  data.prevenue < 0)
                        // {
                        //     var data_revenue  = (-1) * data.revenue;
                        //     var data_prevenue = (-1) * data.prevenue;
                        // }
                        // else if(data.revenue < 0 &&  data.prevenue >= 0 )
                        // {
                        //     var data_revenue  = (-1) * data.revenue;
                        //     var data_prevenue = data.prevenue;
                        // }
                        // else if(data.revenue >= 0 &&  data.prevenue < 0 )
                        // {
                        //     var data_revenue  = data.revenue;
                        //     var data_prevenue = (-1) * data.prevenue;
                        // }
                        // else
                        // {
                        //     var data_revenue  =  data.revenue;
                        //     var data_prevenue =  data.prevenue;
                        // }

                        // if(data_revenue >= data_prevenue)
                        // {
                        //     revenue_per     = 100;
                        //     prevenue_per    = (((data_prevenue)*100) / (data_revenue)).toFixed(2);
                        // }
                        // else
                        // {
                        //     prevenue_per    = 100;
                        //     revenue_per    = (((data_revenue) *100) / (data_prevenue)).toFixed(2);
                        // }

                        var min_amount      = Math.min(data.revenue,data.prevenue );
                        
                        if(data.revenue == 0 && data.prevenue == 0)
                        {
                            revenue_per         = 0;
                            prevenue_per        = 0;
                        }
                        else if(data.revenue >= min_amount)
                        {

                            revenue_per         = 100;

                            prevenue_per        = (((data.prevenue)*100) / (data.revenue)).toFixed(2);

                        }
                        else
                        {
                            prevenue_per    = 100;

                            revenue_per    = (((data.revenue) *100) / (data.prevenue)).toFixed(2);
                        }

                        $('.revenue_start_date').empty();
                        $('.preview_revenue_start_date').empty();

                        $('.revenue_start_date').append(start_date);
                        $('.preview_revenue_start_date').append(start_mounth);

                        $('.revenue_end_date').empty();
                        $('.preview_revenue_end_date').empty();

                        $('.revenue_end_date').append(end_date);
                        $('.preview_revenue_end_date').append(end_mounth);

                        $('#revenue-current').empty();
                        $('#revenue-previous').empty();

                        $('#revenue-current').append(data.revenue);
                        $('#revenue-previous').append(data.prevenue);

                        $('#revenueCurrent').empty();
                        $('#revenuePrevious').empty();

                        $('#revenueCurrent').css('width',revenue_per+'%');
                        $('#revenuePrevious').css('width',prevenue_per+'%');
                    });  
                }
            }
            setTimeout(revenue,100);   
        </script>
    {{--  Revenue end  --}}

    {{--  Expense start --}}
        <script type="text/javascript">
            function expense() {
              
                var form_date    =  $('#expense-form').val();

                var to_date      =  $('#expense-to').val();

                var id           =  $('#SelectTimeDurationExpense').val();

              
                if (form_date == '')
                {
                    var form_date   = 0;
                }

                if (to_date == '')
                {
                    var to_date   = 0;
                }

                if(id == 5 && form_date == '' && to_date == '')
                {
                    $(".expense-form").removeClass('hidden');

                    $(".expense-remove").addClass('hidden');

                    $(".preview-expense-remove").addClass('hidden');
                }
                else if(id != 5 )
                {
                    $("#expense-form").val('');

                    $("#expense-to").val('');

                    $(".expense-form").addClass('hidden');

                    $(".expense-remove").removeClass('hidden');

                    $(".preview-expense-remove").removeClass('hidden');

                    $.get('{{route('expense_dashboard',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {
                       
                        var start_date           = data.start_date;

                        var end_date             = data.end_date;

                        var start_mounth         = data.start_mounth;

                        var end_mounth           = data.end_mounth;

                        var list                 = '';

                        var expense_per          = 0;

                        var pexpense_per         = 0;

                        var len                  = data.length;

                        var top_expense_per      = 0;

                        var top_expense          = 0;
                        
                        if(data.expense_total == 0 && data.pexpense_total == 0)
                        {
                            expense_per     = 0;
                            pexpense_per    = 0;
                        }
                        else if(data.expense_total >= data.pexpense_total)
                        {
                            expense_per     = 100;
                            pexpense_per    = (( data.pexpense_total*100) / data.expense_total).toFixed(2);
                        }
                        else
                        {
                            pexpense_per    = 100;
                            expense_per    = ((data.expense_total *100) / data.pexpense_total).toFixed(2);
                        }

                        $('.expense_start_date').empty();
                        $('.preview_expense_start_date').empty();

                        $('.expense_start_date').append(start_date);
                        $('.preview_expense_start_date').append(start_mounth);

                        $('.expense_end_date').empty();
                        $('.preview_expense_end_date').empty();

                        $('.expense_end_date').append(end_date);
                        $('.preview_expense_end_date').append(end_mounth);

                        $('#expense-current').empty();
                        $('#expense-previous').empty();

                        $('#expense-current').append(data.expense_total);
                        $('#expense-previous').append(data.pexpense_total);

                        $('#expenseCurrent').empty();
                        $('#expensePrevious').empty();

                        $('#expenseCurrent').css('width',expense_per+'%');
                        $('#expensePrevious').css('width',pexpense_per+'%');
                    });   
                }
                else 
                {
                    $.get('{{route('expense_dashboard',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {
                       
                        var start_date           = data.start_date;

                        var end_date             = data.end_date;

                        var start_mounth         = data.start_mounth;

                        var end_mounth           = data.end_mounth;

                        var list                 = '';

                        var expense_per          = 0;

                        var pexpense_per         = 0;

                        var len                  = data.length;

                        var top_expense_per      = 0;

                        var top_expense          = 0;
                        
                        if(data.expense_total == 0 && data.pexpense_total == 0)
                        {
                            expense_per     = 0;
                            pexpense_per    = 0;
                        }
                        else if(data.expense_total >= data.pexpense_total)
                        {
                            expense_per     = 100;
                            pexpense_per    = (( data.pexpense_total*100) / data.expense_total).toFixed(2);
                        }
                        else
                        {
                            pexpense_per    = 100;
                            expense_per    = ((data.expense_total *100) / data.pexpense_total).toFixed(2);
                        }


                        $('.expense_start_date').empty();
                        $('.preview_expense_start_date').empty();

                        $('.expense_start_date').append(start_date);
                        $('.preview_expense_start_date').append(start_mounth);

                        $('.expense_end_date').empty();
                        $('.preview_expense_end_date').empty();

                        $('.expense_end_date').append(end_date);
                        $('.preview_expense_end_date').append(end_mounth);

                        $('#expense-current').empty();
                        $('#expense-previous').empty();

                        $('#expense-current').append(data.expense_total);
                        $('#expense-previous').append(data.pexpense_total);

                        $('#expenseCurrent').empty();
                        $('#expensePrevious').empty();

                        $('#expenseCurrent').css('width',expense_per+'%');
                        $('#expensePrevious').css('width',pexpense_per+'%');
                    }); 
                }
            }
            setTimeout(expense,100);   
        </script>
    {{--  Expense end  --}}

    {{-- Top Customer Account Start--}}
        <script type="text/javascript">
            function topCustomerSales() {
                var form_date    =  $('#top-customer-form-date').val();

                var to_date      =  $('#top-customer-to-date').val();

                var id           =  $('#SelectTimeCustomerSales').val();

                if (form_date == '')
                {
                    var form_date   = 0;
                }

                if (to_date == '')
                {
                    var to_date   = 0;
                }

                if(id == 5 && form_date == '' && to_date == '')
                {
                    $(".top-customer-remove").addClass('hidden');

                    $(".topCustomer-form").removeClass('hidden');
                }
                else if(id != 5 )
                {
                    $("#top-customer-form-date").val('');

                    $("#top-customer-to-date").val('');

                    $(".top-customer-remove").removeClass('hidden');

                    $(".topCustomer-form").addClass('hidden');

                    $.get('{{route('top_customer_sales_account',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {

                        console.log(data);

                       var start_date           = data.start_date;

                       var end_date             = data.end_date;

                       var list                 = '';

                       var amount_total         = 0;
                       var top_customer_per     = 0;
                       var top_customer         = 0;

                       $.each(data.customer_sales,function (e, value) {
                           amount_total+= parseFloat(value.amount);
                       });


                        $.each(data.customer_sales,function (e, value) {

                            top_customer            = value.amount;
                            top_customer_per        = ((top_customer * 100)/ amount_total).toFixed(2);

                            list    += '<tr>'+
                                            '<td>'+ value.display_name +'</td>'+
                                            '<td style="text-align: right;">'+ top_customer +'</td>'+
                                            '<td style="text-align: right;">'+ top_customer_per +' %'+'</td>'+
                                            '<td style="vertical-align: middle;"><div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove" style="5.5rem"><div class="uk-progress-bar" style="background:#3498db; width:'+ top_customer_per +'%;"></div></div></td>'+
                                        '</tr>';
                        });

                        list1= '<tr style="border:none;">'+
                                '<td class="text-right" style="border:none;"><b>Top Customer Total:</b></td>'+
                               '<td class="text-right" style="border:none;"><b>'+amount_total+'</b></td>'+
                               '</tr>';

                       $('.top_customer_start_date').empty();
                       $('.top_customer_start_date').append(start_date);
                       $('.top_customer_end_date').empty();
                       $('.top_customer_end_date').append(end_date);
                       $('.tableCustomerSales').empty(list);
                       $('.tableCustomerSales').empty(list1);
                       $('.tableCustomerSales').append(list);
                       $('.tableCustomerSales').append(list1);
                    });   
                }
                else 
                {
                     $.get('{{route('top_customer_sales_account',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {

                        console.log(data);

                       var start_date           = data.start_date;

                       var end_date             = data.end_date;

                       var list                 = '';

                       var amount_total         = 0;
                       var top_customer_per     = 0;
                       var top_customer         = 0;

                       $.each(data.customer_sales,function (e, value) {
                           amount_total+= parseFloat(value.amount);
                       });


                        $.each(data.customer_sales,function (e, value) {

                            top_customer            = value.amount;
                            top_customer_per        = ((top_customer * 100)/ amount_total).toFixed(2);

                            list    += '<tr>'+
                                            '<td>'+ value.display_name +'</td>'+
                                            '<td style="text-align: right;">'+ top_customer +'</td>'+
                                            '<td style="text-align: right;">'+ top_customer_per +' %'+'</td>'+
                                            '<td style="vertical-align: middle;"><div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove" style="5.5rem"><div class="uk-progress-bar" style="background:#3498db; width:'+ top_customer_per +'%;"></div></div></td>'+
                                        '</tr>';
                        });

                        list1= '<tr style="border:none;">'+
                                '<td class="text-right" style="border:none;"><b>Top Customer Total:</b></td>'+
                               '<td class="text-right" style="border:none;"><b>'+amount_total+'</b></td>'+
                               '</tr>';

                       $('.top_customer_start_date').empty();
                       $('.top_customer_start_date').append(start_date);
                       $('.top_customer_end_date').empty();
                       $('.top_customer_end_date').append(end_date);
                       $('.tableCustomerSales').empty(list);
                       $('.tableCustomerSales').empty(list1);
                       $('.tableCustomerSales').append(list);
                       $('.tableCustomerSales').append(list1);
                    });  
                }

            }
            setTimeout(topCustomerSales,100);
        </script>
    {{-- Top Customer Account End--}}

    {{--  Top Expense Account start --}}
        <script type="text/javascript">
            function topExpenseAccount() {
              
                var form_date    =  $('#top-expense-form-date').val();

                var to_date      =  $('#top-expense-to-date').val();

                var id           =  $('#SelectTimeDurationTopExpense').val();

                if (form_date == '')
                {
                    var form_date   = 0;
                }

                if (to_date == '')
                {
                    var to_date   = 0;
                }

                if(id == 5 && form_date == '' && to_date == '')
                {
                    $(".top-expense-remove").addClass('hidden');

                    $(".topExpense-form").removeClass('hidden');
                }
                else if(id != 5 )
                {
                    $("#top-expense-form-date").val('');

                    $("#top-expense-to-date").val('');

                    $(".top-expense-remove").removeClass('hidden');

                    $(".topExpense-form").addClass('hidden');

                    $.get('{{route('top_expense_account',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {
                    
                       var start_date           = data.start_date;

                       var end_date             = data.end_date;

                       var list                 = '';

                       var amount_total         = 0;
                       var len                  = data.length;
                       var top_expense_per      = 0;
                       var top_expense          = 0;

                       $.each(data.top_expense,function (e, value) {
                           amount_total+= parseFloat(value.debit_amount- value.credit_amount);
                       });


                        $.each(data.top_expense,function (e, value) {

                            top_expense             = value.debit_amount- value.credit_amount;
                            top_expense_per         = ((top_expense * 100)/ amount_total).toFixed(2);

                            list    += '<tr>'+
                                            '<td>'+ value.account_name +'</td>'+
                                            '<td style="text-align: right;">'+ top_expense +'</td>'+
                                            '<td style="text-align: right;">'+ top_expense_per +' %'+'</td>'+
                                            '<td style="vertical-align: middle;"><div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove" style="5.5rem"><div class="uk-progress-bar" style="background:#3498db; width:'+ top_expense_per +'%;"></div></div></td>'+
                                        '</tr>';
                        });

                        list1= '<tr style="border:none;">'+
                                '<td class="text-right" style="border:none;"><b>Top Expense Total:</b></td>'+
                               '<td class="text-right" style="border:none;"><b>'+amount_total+'</b></td>'+
                               '</tr>';

                       $('.top_expense_start_date').empty();
                       $('.top_expense_start_date').append(start_date);
                       $('.top_expense_end_date').empty();
                       $('.top_expense_end_date').append(end_date);
                       $('.tableTopExpense').empty(list);
                       $('.tableTopExpense').empty(list1);
                       $('.tableTopExpense').append(list);
                       $('.tableTopExpense').append(list1);
                    });   
                }
                else 
                {
                    $.get('{{route('top_expense_account',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {
                
                       var start_date           = data.start_date;

                       var end_date             = data.end_date;

                       var list                 = '';

                       var amount_total         = 0;
                       var len                  = data.length;
                       var top_expense_per      = 0;
                       var top_expense          = 0;

                       $.each(data.top_expense,function (e, value) {
                           amount_total+= parseFloat(value.debit_amount- value.credit_amount);
                       });


                        $.each(data.top_expense,function (e, value) {

                            top_expense             = value.debit_amount- value.credit_amount;
                            top_expense_per         = ((top_expense * 100)/ amount_total).toFixed(2);

                            list    += '<tr>'+
                                            '<td>'+ value.account_name +'</td>'+
                                            '<td style="text-align: right;">'+ top_expense +'</td>'+
                                            '<td style="text-align: right;">'+ top_expense_per +' %'+'</td>'+
                                            '<td style="vertical-align: middle;"><div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove" style="5.5rem"><div class="uk-progress-bar" style="background:#3498db; width:'+ top_expense_per +'%;"></div></div></td>'+
                                        '</tr>';
                            
                        });

                        list1= '<tr style="border:none;">'+
                                '<td class="text-right" style="border:none;"><b>Top Expense Total:</b></td>'+
                               '<td class="text-right" style="border:none;"><b>'+amount_total+'</b></td>'+
                               '</tr>';

                       $('.top_expense_start_date').empty();
                       $('.top_expense_start_date').append(start_date);
                       $('.top_expense_end_date').empty();
                       $('.top_expense_end_date').append(end_date);
                       $('.tableTopExpense').empty(list);
                       $('.tableTopExpense').empty(list1);
                       $('.tableTopExpense').append(list);
                       $('.tableTopExpense').append(list1);
                    });  
                }
            }
            setTimeout(topExpenseAccount,100);   
        </script>
    {{--  Top Expense Account end  --}}

    {{--  Top Vendor Expense start --}}
        <script type="text/javascript">
            function topVendorExpense() {
              
                var form_date    =  $('#top-vendor-expense-form-date').val();

                var to_date      =  $('#top-vendor-expense-to-date').val();

                var id           =  $('#TimeDurationTopVendorExpense').val();

                if (form_date == '')
                {
                    var form_date   = 0;
                }

                if (to_date == '')
                {
                    var to_date   = 0;
                }

                if(id == 5 && form_date == '' && to_date == '')
                {
                    $(".top-vendor-form").removeClass('hidden');

                    $(".topVendor-remove").addClass('hidden');
                }
                else if(id != 5 )
                {
                    
                    $("#top-vendor-expense-form-date").val('');

                    $("#top-vendor-expense-to-date").val('');

                    $(".top-vendor-form").addClass('hidden');

                    $(".topVendor-remove").removeClass('hidden');

                    $.get('{{route('top_vendor_expense',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {
                        
                        var start_date           = data.start_date;

                        var end_date             = data.end_date;

                        var list                 = '';

                        var amount_total         = 0;
                        var len                  = data.length;
                        var top_vendor_per       = 0;
                        var top_vendor           = 0;

                        $.each(data.vendor_expense,function (e, value) {
                            amount_total+= parseFloat(value.debit_amount- value.credit_amount);
                        });


                        $.each(data.vendor_expense,function (e, value) {

                            top_vendor              = value.debit_amount- value.credit_amount;
                            top_vendor_per          = ((top_vendor * 100)/ amount_total).toFixed(2);
                           
                            list    += '<tr>'+
                                            '<td>'+ value.display_name +'</td>'+
                                            '<td style="text-align: right;">'+ top_vendor +'</td>'+
                                            '<td style="text-align: right;">'+ top_vendor_per +' %'+'</td>'+
                                            '<td style="vertical-align: middle;"><div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove" style="5.5rem"><div class="uk-progress-bar" style="background:#18BC9C; width:'+ top_vendor_per +'%;"></div></div></td>'+
                                        '</tr>';
                            
                        });

                        list1 = '<tr style="border:none;">'+
                                    '<td class="text-right" style="border:none;"><b>Top Expense Total:</b></td>'+
                                    '<td class="text-right" style="border:none;"><b>'+amount_total+'</b></td>'+
                                '</tr>';

                       $('.top_vendor_start_date').empty();
                       $('.top_vendor_start_date').append(start_date);
                       $('.top_vendor_end_date').empty();
                       $('.top_vendor_end_date').append(end_date);
                       $('.tableTopVendorExpense').empty(list);
                       $('.tableTopVendorExpense').empty(list1);
                       $('.tableTopVendorExpense').append(list);
                       $('.tableTopVendorExpense').append(list1);
                    });   
                }
                else 
                {
                    $.get('{{route('top_vendor_expense',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {
                       
                        var start_date           = data.start_date;

                        var end_date             = data.end_date;

                        var list                 = '';

                        var amount_total         = 0;
                        var len                  = data.length;
                        var top_vendor_per       = 0;
                        var top_vendor           = 0;

                        $.each(data.vendor_expense,function (e, value) {
                            amount_total+= parseFloat(value.debit_amount- value.credit_amount);
                        });


                        $.each(data.vendor_expense,function (e, value) {

                            top_vendor              = value.debit_amount- value.credit_amount;
                            top_vendor_per          = ((top_vendor * 100)/ amount_total).toFixed(2);

                            list    += '<tr>'+
                                            '<td>'+ value.display_name +'</td>'+
                                            '<td style="text-align: right;">'+ top_vendor +'</td>'+
                                            '<td style="text-align: right;">'+ top_vendor_per +' %'+'</td>'+
                                            '<td style="vertical-align: middle;"><div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove" style="5.5rem"><div class="uk-progress-bar" style="background:#18BC9C; width:'+ top_vendor_per +'%;"></div></div></td>'+
                                        '</tr>';
                            
                        });

                        list1 = '<tr style="border:none;">'+
                                    '<td class="text-right" style="border:none;"><b>Top Expense Total:</b></td>'+
                                    '<td class="text-right" style="border:none;"><b>'+amount_total+'</b></td>'+
                                '</tr>';

                       $('.top_vendor_start_date').empty();
                       $('.top_vendor_start_date').append(start_date);
                       $('.top_vendor_end_date').empty();
                       $('.top_vendor_end_date').append(end_date);
                       $('.tableTopVendorExpense').empty(list);
                       $('.tableTopVendorExpense').empty(list1);
                       $('.tableTopVendorExpense').append(list);
                       $('.tableTopVendorExpense').append(list1);
                    }); 
                }
            }
            setTimeout(topVendorExpense,100);   
        </script>
    {{--  Top Vendor Expense end  --}}

    {{--  Sales by Product start --}}
        <script type="text/javascript">
            function salesProduct() {

                var form_date    =  $('#form-date').val();

                var to_date      =  $('#to-date').val();

                var id           =  $('#SelectTimeDuration').val();

                if (form_date == '')
                {
                    var form_date   = 0;
                }

                if (to_date == '')
                {
                    var to_date   = 0;
                }

                if(id == 5 && form_date == '' && to_date == '')
                {
                    $(".sales-remove").addClass('hidden');

                    $(".sales-form").removeClass('hidden');
                }
                else if(id != 5 )
                {
                    $("#form-date").val('');

                    $("#to-date").val('');

                    $(".sales-remove").removeClass('hidden');

                    $(".sales-form").addClass('hidden');

                    $.get('{{route('sales_by_product',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {

                       var start_date   = data.start_date;

                       var end_date     = data.end_date;

                       var list         = '';

                       var amount_total = 0;
                       var len          = data.length;
                       var sale_per     = 0;
                       
                       var seriesList = [];

                       $.each(data.product_sales,function (e, value) {
                           amount_total+= parseFloat(value.amount);
                           
                       });

                       var chart_value = [];
                       var chart_name  = [];

                        $.each(data.product_sales,function (e, value) {

                            sale_per = ((value.amount * 100)/ amount_total).toFixed(2);

                            chart_value.push(sale_per);
                            chart_name.push(value.item_name);

                            list    += '<tr>'+
                                            '<td>'+ value.item_name +'</td>'+
                                            '<td style="text-align: right;">'+ value.amount +'</td>'+
                                            '<td style="text-align: right;">'+ sale_per +' %'+'</td>'+
                                            '<td style="vertical-align: middle;"><div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove" style="5.5rem"><div class="uk-progress-bar" style=" width:'+ sale_per +'%;"></div></div></td>'+
                                        '</tr>';
                            
                        });
                            
                        chart_value.reverse();

                        chart_name.reverse();
                     
                        list1= '<tr style="border:none;">'+
                                '<td class="text-right" style="border:none;"><b>All Item Sold:</b></td>'+
                               '<td class="text-right" style="border:none;"><b>'+amount_total+'</b></td>'+
                               '</tr>';

                       $('.start_date').empty();
                       $('.start_date').append(start_date);
                       $('.end_date').empty();
                       $('.end_date').append(end_date);
                       $('.tableProduct').empty(list);
                       $('.tableProduct').empty(list1);
                       $('.tableProduct').append(list);
                       $('.tableProduct').append(list1);
                    });   
                }

                else 
                {
                    $.get('{{route('sales_by_product',['id'=>'','form_date'=>'','to_date'=>''])}}/'+id+'/'+form_date+'/'+to_date,function (data) {

                       var start_date   = data.start_date;

                       var end_date     = data.end_date;

                       var list         = '';

                       var amount_total = 0;
                       var len          = data.length;
                       var sale_per     = 0;
                       
                       var seriesList = [];

                       $.each(data.product_sales,function (e, value) {
                           amount_total+= parseFloat(value.amount);
                           
                       });
                       var chart_value = [];
                       var chart_name  = [];

                        $.each(data.product_sales,function (e, value) {

                            sale_per = ((value.amount * 100)/ amount_total).toFixed(2);

                            chart_value.push(sale_per);
                            chart_name.push(value.item_name);

                            list    += '<tr>'+
                                            '<td>'+ value.item_name +'</td>'+
                                            '<td style="text-align: right;">'+ value.amount +'</td>'+
                                            '<td style="text-align: right;">'+ sale_per +'%'+'</td>'+
                                            '<td style="vertical-align: middle;"><div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove"><div class="uk-progress-bar" style="height:6px;width:'+ sale_per +'%;"></div></div></td>'+
                                        '</tr>';
                            
                        });
                            
                        chart_value.reverse();

                        chart_name.reverse();
                     
                        list1= '<tr style="border:none;">'+
                                '<td class="text-right" style="border:none;">All Item Sold:</td>'+
                               '<td style="border:none;">'+amount_total+'</td>'+
                               '</tr>';

                       $('.start_date').empty();
                       $('.start_date').append(start_date);
                       $('.end_date').empty();
                       $('.end_date').append(end_date);
                       $('.tableProduct').empty(list);
                       $('.tableProduct').empty(list1);
                       $('.tableProduct').append(list);
                       $('.tableProduct').append(list1);
                       
                    });
                }
            }
            setTimeout(salesProduct,100);   
        </script>
    {{--  Sales by Product end  --}}

    <script src="{!! asset('admin/assets/js/canvasjs.min.js') !!}"></script> 
@endsection
