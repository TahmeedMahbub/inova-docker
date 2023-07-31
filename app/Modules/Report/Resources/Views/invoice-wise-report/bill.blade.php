@extends('layouts.admin')

@section('title', 'Bill-Wise Payment')

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

                                {!! Form::open(['url' => url('/report/paiment-receive-break-down/bill/'.$start.'/'.$end.'/'.$id), 'method' => 'GET', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}

                               

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
                                
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">From</label>
                                                <input required class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ date('Y-m-d', strtotime($start)) }}">
                                            </div>
                                            <br>
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">To</label>
                                                <input required class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ date('Y-m-d', strtotime($end)) }}">
                                            </div>
                                        </div>

                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                            <button id="submit" type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
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
                                    @if($branch_name->logo != null)
                                        <img style="margin-bottom: 0px;" class="logo_regular" src="{{ asset($branch_name->logo) }}" alt="" height="15" width="71"/>
                                    @endif
                                    @if($branch_name->logo == null)
                                         <img style="margin-bottom: 0px;" class="logo_regular" src="{{ asset('uploads/op-logo/'.$OrganizationProfile->logo) }}" alt="" height="15" width="71"/>
                                    @endif
                                    <p style="line-height: 5px; margin-top: 10px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 5px;" class="heading_b">{{ $customer['display_name'] }} Report Details</p>
                                    <p style="line-height: 5px;">{{ $current_branch['branch_name'] }}</p>
                                      <p style="line-height: 5px; font-sixe:15px"> Bill Wise Report</p>
                                    <p style="line-height: 10px;"> {{ $start." ". " to " ." $end" }} </p>
                                </div>
                        </div>
                            <div class="uk-grid uk-margin-large-bottom">
                                <h3></h3>
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                            <tr class="uk-text-upper">
                                                <th  class="uk-text-left">Date</th>
                                                <th  class="uk-text-left">Transaction No</th>
                                                <th class="uk-text-left">Particulars</th>
                                                <th class="uk-text-right">Unit</th>
                                                <th class="uk-text-right">Rate</th>
                                                <th class="uk-text-right">Debit</th>
                                                <th style="width: 100px" class="uk-text-right">Credit</th>
                                                <th style="width: 100px" class="uk-text-right">Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $total_balance = 0;
                                                $tmp = 0;
                                            ?>
                                            
                                            @foreach($bill_pr as $data)
                                            
                                                <?php $balance = $data->amount; ?>
                                                
                                                <tr class="uk-text-upper">

                                                    <td class="uk-text-left">{{date('d-m-Y', strtotime($data->bill_date))}}</td>
                                                    <td class="uk-text-left">BILL-{{$data->bill_number}}</td>
                                                    <td class="uk-text-left"><?php 
                                                        echo str_replace(',',',<br />',$data->item_name);
                                                       
                                                    ?></td>
                                                    <td class="uk-text-right"><?php 
                                                        echo str_replace(',',',<br />',$data->item_qty);
                                                       
                                                    ?></td>
                                                    <td class="uk-text-right"><?php 
                                                        echo str_replace(',',',<br />',$data->item_rate);
                                                       
                                                    ?></td>
                                                    <td class="uk-text-right">{{$data->amount}}</td>
                                                    <td class="uk-text-right"></td>
                                                    <td class="uk-text-right"></td>
                                                    
                                                </tr>
                                                <?php
                                                    $from = date('d-m-Y', strtotime($start));
                                                    $to = date('d-m-Y', strtotime($end));
                                                    $credit= 0; $all_pr = $data->paymentReceivesMadeDetails;
                                                ?>
                                            
                                                @if(isset($all_pr))
                                                    @foreach($all_pr as $value)
                                                  
                                                        
                                                        @if($from <= $value->payment_date && $value->payment_date <= $to)
            
                                                            <tr class="uk-text-upper">
                
                                                                <td class="uk-text-left">{{date('d-m-Y', strtotime($value->payment_date))}}</td>
                                                                <td class="uk-text-left">{{ $value->account_id == 3 ? 'CP' : 'BP' }}-{{ \Carbon\Carbon::createFromFormat('Y-m-d', $value->payment_date)->year }}/{{$value->pm_number}}</td>
                                                                <td class="uk-text-left">{{$value->reference}}</td>
                                                                <td class="uk-text-right"></td>
                                                                <td class="uk-text-right"></td>
                                                                <td class="uk-text-right"></td>
                                                                <td class="uk-text-right">{{$value->amount}}</td>
                                                                <td class="uk-text-right"></td>
                                                                  
                                                                <?php $credit = $credit + $value->amount ?>
                                                                
                                                            </tr>
                                                            
                                                        @endif
                                                        
                                                    @endforeach
                                                    
                                                @endif
                                                
                                                <tr class="uk-text-upper">
                                                    <td colspan="6"></td>
                                                    <td> <b>Balance</b> </td>
                                                    <td class="uk-text-right"><b>{{$total_balance2=$balance-$credit}}</b></td>
                                                </tr>
                                                
                                                <?php 
                                                    $tmp++;
                                                    $total_balance =  $total_balance + $total_balance2;

                                                 ?>
                                                
                                            @endforeach
                                        @if($total_balance != 0)
                                              <tr class="uk-text-upper">
                                                    <td colspan="5"></td>
                                                    <td> <b> Total Balance</b> </td>
                                                    <td colspan="2" class="uk-text-right"><b>{{ $total_balance }}</b></td>
                                                </tr>
                                        @endif
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
