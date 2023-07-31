@extends('layouts.main')

@section('title', 'Estimate Report')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>

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
                width: 100%;
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

                                {!! Form::open(['url' => 'report/estimate/report', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}

                                <div  style="float: right;" data-uk-button-radio="{target:'.md-btn'}">

                                    <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="serach_select" name="contact_category_seaarch">
                                        <option value="">Search...</option>
                                        <option value="0">All</option>
                                         @foreach($category as $item)
                                            <option @if($contact_category == $item->id) selected @endif value="{{ $item['id'] }}">{{ $item['display_name'] }}</option>
                                         @endforeach
                                    </select>

                                </div>

                                <input style="display: none"  type="text"  name="from_date_select" value="{{ $start }}">
                                <input style="display: none" type="text" name="to_date_select"  value="{{ $end_time }}">


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
                                            @if(Auth::user()->branch_id==1)
                                                <div class="uk-width-large-2-2 uk-width-2-2">
                                                    <div class="uk-input-group">
                                                        <label for="branch_id" style="margin-left: 10px;">Branch</label>
                                                        <select style="padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray"  id="branch_id" name="branch_id">
                                                            <!-- <option value="">Account</option> -->
                                                            @foreach($branch as $branch_data)
                                                                <option style="z-index: 10002" value="{{$branch_data->id}}">{{$branch_data->branch_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">Form</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'DD.MM.YYYY'}">
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
                                    <p style="line-height: 5px;" class="heading_b uk-text-black">Estimate Report</p>

                                    @if(isset($branch_id))<p>@foreach($branch as $branchs) @if($branchs->id==$branch_id) {{$branchs->branch_name}} @endif @endforeach</p>@endif
                                    <p style="line-height: 5px;" class="uk-text-small">From {{ date('d-m-Y',strtotime($start)) }}  To {{ date("d-m-Y",strtotime($end_time))}}</p>
                                    <p style="line-height: 5px;" class="heading_b uk-text-black">
                                        @if(isset($contact_category_name->display_name))
                                            {{ $contact_category_name->display_name }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin="">
                                <div class="uk-width-small-5-5">

                                    <p style="line-height: 5px;font-size: 14px">
                                        Total Estimates :&nbsp; {{ $total_estimates }} &nbsp;&nbsp;&nbsp;&nbsp;
                                        Total Invoices :&nbsp; {{ $total_invoices }}
                                    </p>

                                </div>
                            </div>

                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">

                                        <thead>

                                            <tr class="uk-text-upper">
                                                <th style="width: 100px" class="uk-text-left">DATE</th>
                                                <th class="uk-text-left">Estimate Number</th>
                                                <th class="uk-text-left">Invoice Number</th>
                                                <th class="uk-text-left">Customer Name</th>
                                                @if($hide_show == 0 || $contact_category == 0)
                                                    <th class="uk-text-left">Employee Name</th>
                                                @endif
                                                <th style="width: 100px" class="uk-text-left">Items</th>
                                                <th class="uk-text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                                $total_amount       = 0;
                                                $due_amount         = 0;
                                                $received_amount    = 0;
                                            @endphp

                                            @foreach($estimates as $estimate)
                                           
                                                <tr class="uk-text-middle">
                                                    <td style="width: 100px" class="uk-text-left">{{ date('d-m-Y', strtotime($estimate['date'])) }}</td>
                                                    <td class="uk-text-left">{{ $estimate['estimate_number'] }}</td>
                                                    <td class="uk-text-left">
                                                        @if(isset($estimate->invoiceNumber->invoice_number))
                                                            INV-{{ str_pad($estimate->invoiceNumber->invoice_number, 6, '0', STR_PAD_LEFT) }}
                                                        @endif
                                                    </td>
                                                    <td class="uk-text-left">{{ $estimate['customer']->display_name }}</td>
                                                    @if($hide_show == 0 || $contact_category == 0)
                                                        <td class="uk-text-left">{{ $estimate['estimattedBy']->name }}</td>
                                                    @endif
                                                    <td style="width: 100px" class="uk-text-left">{{ $estimate['item_name'] }}</td>
                                                    <td class="uk-text-right">{{ $estimate['total_amount'] }}</td>

                                                </tr>

                                                @php
                                                    $total_amount       = $total_amount + $estimate['total_amount'];
                                                    $due_amount         = $due_amount + $estimate['due_amount'];
                                                    $received_amount    = $received_amount + ($estimate['total_amount'] - $estimate['due_amount']);
                                                @endphp

                                            @endforeach

                                            <tr>
                                                @if($hide_show == 0 || $contact_category == 0)
                                                    <td class="uk-text-left"></td>
                                                @endif
                                                <td class="uk-text-right" colspan = "5"><strong>Total</strong></td>
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

<script>
    $("#serach_select").on('change', function(){
        $('#submit').click();
    });
</script>
@endsection
