@extends('layouts.main')

@section('title', 'Payment Report')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        span.select2-container{
            z-index: 5000 !important;
        }
        @media print
        {
            .md-card-toolbar{
                display: none;
            }

            table#profit tr td,table#profit tr th{
                font-size: 11px !important;
            }
            .uk-table tr td{
                padding: 5px 5px;
                border: 1px solid black !important;
                font-size: 11px !important;
            }
            .uk-table tr th{
                padding: 5px 5px;
                border: 1px solid black;
                font-size: 11px !important;
            }

            .uk-table>tbody>tr:last-child td{
                border: none !important;
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
                        <div class="md-card-toolbar">
                            <div style="width: 100%" class="md-card-toolbar-actions hidden-print">

                                {!! Form::open(['url' => 'report/account/payment/ledger', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}

                                <input style="display: none"  type="text"  name="from_date_select" value="{{ $start }}">
                                <input style="display: none" type="text" name="to_date_select"  value="{{ $end }}">

                                <i class="md-icon material-icons" id="invoice_print"></i>

                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">

                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range and Transaction Type <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            @if(Auth::user()->branch_id == 1)
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i style="padding-top: 10px" class="material-icons">view_module</i></span>
                                                    <select style="padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray" id="branch_id" class="md-input select2-single-search-dropdown" name="branch_id" onchange="branchChange()">

                                                    @foreach($branch as $branch_data)
                                                        <option @if($branch_id == $branch_data->id) selected @endif style="z-index: 10002" value="{{$branch_data->id}}">{{$branch_data->branch_name}}</option>
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
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                            <button id="submit" type="submit" name="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <!--end  -->
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg">

                            <div class="uk-grid" data-uk-grid-margin="">

                                <div class="uk-width-small-5-5 uk-text-center">
                                    <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                    <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 5px;" class="heading_b uk-text-black">Account Payment Report</p>

                                    @if(isset($branch_id))<p>@foreach($branch as $branchs) @if($branchs->id==$branch_id) {{$branchs->branch_name}} @endif @endforeach</p>@endif
                                    <p style="line-height: 5px;" class="uk-text-small">From {{ date('d-m-Y',strtotime($start)) }}  To {{ date("d-m-Y",strtotime($end))}}</p>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <Strong>Total Payment : {{ (count($payment_mades)) }}</strong>
                                </div>
                            </div>

                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th class="uk-text-left">DATE</th>
                                            <th class="uk-text-left">Transaction Number</th>
                                            <th class="uk-text-left">Reference</th>
                                            <th class="uk-text-left">Vendor Name</th>
                                            <th class="uk-text-right">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $total_amount       = 0;
                                        @endphp

                                        @foreach($payment_mades as $payment_made)
                                            <tr class="uk-text-middle">
                                                <td class="uk-text-left">{{ date('d-m-Y', strtotime($payment_made['payment_date'])) }}</td>
                                                <td class="uk-text-left">{{ $payment_made['account_id'] == 3 ? 'CP' : 'BP' }}-{{ \Carbon\Carbon::createFromFormat('Y-m-d', $payment_made['payment_date'])->year }}/{{ $payment_made['pm_number'] }}</td>
                                                <td class="uk-text-left">{{ $payment_made['reference'] }}</td>
                                                <td class="uk-text-left">{{ $payment_made['customer']->display_name }}</td>
                                                <td class="uk-text-right">{{ $payment_made['amount'] }}</td>
                                            </tr>

                                            @php
                                                $total_amount       = $total_amount + $payment_made['amount'];
                                            @endphp

                                        @endforeach


                                        <tr>
                                            <td class="uk-text-right" colspan = "4"><strong>Total</strong></td>
                                            <td class="uk-text-right">
                                                <strong>
                                                    {{ $total_amount }}
                                                </strong>
                                            </td>
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
    $('#sidebar_main_account').addClass('current_section');
    $('#sidebar_reports').addClass('act_item');
</script>
@endsection
