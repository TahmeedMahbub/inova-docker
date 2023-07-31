@extends('layouts.admin')

@section('title', 'Profit Report')

@section('header')
    @include('inc.header')
@endsection

@section('styles')
    <style>
        span.select2-container{
            z-index: 5000 !important;
        }
        #list_table_right tr td:nth-child(1) {

            white-space: nowrap;
        }

        #list_table_left, #list_table_right {
            width: 100%;
            padding: 10px;

        }

        #list_table_left tr td, #list_table_right tr td {
            text-align: center;
            padding-left: 3px;
            padding-right: 3px;
        }

        #list_table_left tr th, #list_table_right tr th {
            border-bottom: 1px solid black;
            border-top: 1px solid black;
            font-size: 10px;
        }

        #list_table_left tr td:nth-child(1), #list_table_left tr td:last-child, #list_table_left tr th:last-child, #list_table_right tr td:last-child {

            white-space: nowrap;
        }
        .profit-text{
            line-height: 0px;
            margin-left: 11px;
        }
        span.select2-container {
            z-index:10050;
            width: 100% !important;
        }
        @media print {
            #list_table_left tr td, #list_table_right tr td {
                border: 1px solid black;
                padding-left: 3px;
                padding-right: 3px;

            }

            #list_table_right_parent tr th, #list_table_left_parent tr th {
                border: 1px solid black;
            }

            #list_table_right_parent, #list_table_left_parent, #list_table_left, #list_table_right {

                font-size: 11px !important;
                border-spacing: 0px;
                border-collapse: collapse;

            }

            #list_table_right {
                margin-left: 10px;
            }

            body {
                margin-top: -40px;
            }

            #total, #table_close, #table_open, #list_table_left, #list_table_right {
                font-size: 11px !important;
            }

            .md-card-toolbar {
                display: none;
            }
        }
    </style>
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content_header')
    <div id="top_bar" class="hidden-print">
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
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview hidden-print">
                        <div class="md-card-toolbar hidden-print">
                            <div class="md-card-toolbar-actions hidden-print" style="float: left;">
                                <i class="md-icon material-icons" id="invoice_print"></i>

                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}"
                                     aria-haspopup="true" aria-expanded="true"><a href="#"
                                                                                  data-uk-modal="{target:'#coustom_setting_modal'}"><i
                                                class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => 'report/account/profite/ledger', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range and Transaction Type <i
                                                        class="material-icons" data-uk-tooltip="{pos:'top'}"
                                                        title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            @if(Auth::user()->branch_id == 1)
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i style="padding-top: 10px" class="material-icons">view_module</i></span>
                                                    <select style="padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray" id="branch_id" class="md-input select2-single-search-dropdown" name="branch_id" onchange="branchChange()">

                                                    @foreach($branch as $branch_data)
                                                        <option @if($branch_id == $branch_data->id) selected @endif value="{{$branch_data->id}}">{{$branch_data->branch_name}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            @else
                                            <div style="display: none" class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <label for="branch_id" style="margin-left: 10px;">Branch</label>
                                                    <select style="padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray"  id="branch_id" name="branch_id" onchange="branchChange()">

                                                    @foreach($branch as $branch_data)
                                                        <option @if($branch_id == $branch_data->id) selected @endif style="z-index: 10002" value="{{$branch_data->id}}">{{$branch_data->branch_name}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group" style="margin-top: 19px;">
                                                    <span class="uk-input-group-addon"><i
                                                                class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">From</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="from_date"
                                                           data-uk-datepicker="{format:'DD.MM.YYYY'}" value="{{ date('d-m-Y',strtotime($start)) }}">
                                                </div>
                                            </div>

                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group" style="margin-top: 19px;">
                                                    <span class="uk-input-group-addon"><i
                                                                class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="to_date"
                                                           data-uk-datepicker="{format:'DD.MM.YYYY'}" value="{{ date('d-m-Y',strtotime($end)) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close
                                            </button>
                                            <button type="submit" name="submit"
                                                    class="md-btn md-btn-flat md-btn-flat-primary">Search
                                            </button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <!--end  -->
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 100%;">

                            <div class="uk-grid" data-uk-grid-margin="">

                                <div class="uk-width-small-5-5 uk-text-center">
                                    <img style="margin-bottom: -20px;" class="logo_regular"
                                         src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                    <p style="line-height: 0px; margin-top: 35px;"
                                       class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 5px;" class="heading_b">Profit Report</p>
                                    <p style="line-height: 5px;" class="uk-text-large"> {{ $branch_name->branch_name }}</p>
                                    <p style="line-height: 5px;" class="uk-text-small">From {{ date('d-m-Y',strtotime($start)) }} To {{ date('d-m-Y',strtotime($end)) }} </p>

                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-2">
                                </div>
                                <div class="uk-width-1-2">
                                </div>

                                <!-- Debit Calculation-->
                                <div id="list_table_left_parent" class="uk-width-1-2" style="font-size: 12px;">
                                    <p class="profit-text">Received/Receivable</p>
                                    <table id="list_table_left">

                                        <thead>
                                            <tr class="uk-text-upper">
                                                <th class="uk-text-left"  style="font-size: 10px">DATE</th>
                                                <th class="uk-text-left"  style="font-size: 10px">TRANSACTION NUMBER</th>
                                                <th class="uk-text-left"  style="font-size: 10px">CUSTOMER NAME</th>
                                                <th class="uk-text-right" style="font-size: 10px">Receivable</th>
                                                <th class="uk-text-right" style="font-size: 10px">Received</th>
                                                <th class="uk-text-right" style="font-size: 10px">Dues</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_receive      = 0;
                                                $total_due          = 0;
                                                $total_receivable   = 0;
                                            @endphp

                                            @foreach($invoices as $item)
                                            <tr>
                                                <td class="uk-text-left">{{ $item->invoice_date }}</td>
                                                <td class="uk-text-left">INV-{{ $item->invoice_number }}</td>
                                                <td class="uk-text-left">{{ $item->customer->display_name }}</td>
                                                <td class="uk-text-right">{{ $item->total_amount }}</td>
                                                <td class="uk-text-right">{{ $receivable = $item->total_amount-$item->due_amount }}</td>
                                                <td class="uk-text-right">{{ $item->due_amount }}</td>
                                            </tr>
                                            @php
                                                $total_receive          += $item->total_amount;
                                                $total_due              += $item->due_amount;
                                                $total_receivable        = $total_receive-$total_due;
                                            @endphp
                                            @endforeach

                                            <tr class="uk-table-middle">
                                                <td class="uk-text-right" colspan="3">
                                                    <strong>Total</strong>
                                                </td>
                                                <td class="uk-text-right">
                                                    <strong> {{ $total_receive }} </strong>
                                                </td>
                                                <td class="uk-text-right">
                                                    <strong> {{ $total_receivable }} </strong>
                                                </td>
                                                <td class="uk-text-right">
                                                    <strong> {{ $total_due }} </strong>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                                <!-- Credit Calculation-->
                                <div id="list_table_right_parent" class="uk-width-1-2" style="font-size:12px;">
                                    <p class="profit-text">Paid/Payable</p>
                                    <table id="list_table_right">

                                        <thead>
                                            <tr class="uk-text-upper">
                                                <th style="font-size: 10px" class="uk-text-left">DATE</th>
                                                <th style="font-size: 10px" class="uk-text-left">TRANSACTION NUMBER</th>
                                                <th style="font-size: 10px" class="uk-text-left">Vendor Name</th>
                                                <th style="font-size: 10px" class="uk-text-right">Payable</th>
                                                <th style="font-size: 10px" class="uk-text-right">Paid</th>
                                                <th style="font-size: 10px" class="uk-text-right">Dues</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $bill_amount     = 0;
                                            $due_amount      = 0;
                                            $total_payable   = 0;
                                        @endphp
                                        <tbody>
                                            @foreach($bills as $item)
                                            <tr class="uk-table-middle">

                                                <td class="uk-text-left">{{ date('d-m-Y',strtotime($item->bill_date)) }}</td>
                                                <td class="uk-text-left">{{ $item->bill_number}}</td>
                                                <td class="uk-text-left">{{ $item->customer->display_name }}</td>
                                                <td class="uk-text-right">{{ $item->amount }}</td>
                                                <td class="uk-text-right">{{ $payable = $item->amount-$item->due_amount }}</td>
                                                <td class="uk-text-right">{{ $item->due_amount }}</td>
                                            </tr>
                                            @php
                                                $bill_amount    += $item->amount;
                                                $due_amount     += $item->due_amount;
                                                $total_payable   = $bill_amount-$due_amount;
                                            @endphp
                                            @endforeach
                                            <tr class="uk-table-middle">
                                                <td class="uk-text-right" colspan="3">
                                                    <strong> Total </strong>
                                                </td>
                                                <td class="uk-text-right">
                                                    <strong> {{ $bill_amount }} </strong>
                                                </td>
                                                <td class="uk-text-right">
                                                    <strong>  {{ $total_payable }} </strong>
                                                </td>
                                                <td class="uk-text-right">
                                                    <strong>  {{ $due_amount }}</strong>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>

                            </div>

                            <div class="uk-grid">
                                    <p>Net Profit/Loss: <strong>{{ $total_receivable - $total_payable }} <br>  </strong></p><p> Current Profit/Loss: <strong> {{ $total_receive - $bill_amount }}</strong></p>
                            </div>
                            <div class="uk-grid">

                                <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
                                <p class="uk-text-small"></p>

                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-1-2" style="text-align: left">
                                    <p class="uk-text-small uk-margin-bottom">Accounts Signature</p>
                                </div>
                                <div class="uk-width-1-2" style="text-align: right">
                                    <p class="uk-text-small uk-margin-bottom">Authorized Signature</p>
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

        $("#invoice_print").click(function () {
            $("#list_table_right").removeClass('uk_table');
            $("#list_table_left").removeClass('uk_table');
        });

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_reports').addClass('act_item');
    </script>
@endsection
