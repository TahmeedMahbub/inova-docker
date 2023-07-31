@extends('layouts.admin')

@section('title', 'Trial Balance')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        .md-card .md-card-toolbar {
            height: 51px;
            padding: 0px 89px;
            border-bottom: 1px solid rgba(0,0,0,.12);
            background: #fff;
        }

        .print_date{
            position: absolute;
            right: 10px;
            top: 5px;
        }

        @media print
        {
            a[href]:after {
                content:"" !important;

            }
            a{
                text-decoration: none;
            }
            .md-card-toolbar{
                display: none;
            }

            table#profit tr td,table#profit tr th{
                font-size: 11px !important;
            }

            .uk-table tr td{
                padding: 5px 5px;
                border: 1px solid black !important;
                /*width: 100%;*/
                font-size: 11px !important;
            }
            .uk-table tr th{
                padding: 5px 5px;
                border: 1px solid black;
                /*border-bottom: 1px solid black;*/
                /*width: 100%;*/
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

                        <div style="height: 65px !important" class="md-card-toolbar">
                            <div style="padding-left: 0px; padding-right: 0px;" class="md-card-toolbar-actions hidden-print">

                                {!! Form::open(['url' => route('trail_balance_report'), 'method' => 'GET', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}

                                <div style="padding: 0px" class="uk-grid hidden-print" data-uk-grid-margin="">

                                    <div  class="uk-width-medium-2-6">
                                        <label for="invoice_date">Filter From</label>
                                        <input class="md-input" type="text" id="form_date" name="start" value="{{ date('d-m-Y', strtotime($start)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>

                                    <div  class="uk-width-medium-2-6">
                                        <label for="invoice_date">Filter To</label>
                                        <input class="md-input" type="text" id="to_date" name="end" value="{{ date('d-m-Y', strtotime($end)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>

                                    <div  class="uk-width-medium-2-6">
                                        <button type="submit" class="md-btn md-btn-primary">Filter</button>
                                        <i class="md-icon material-icons hidden-print" id="invoice_print">print</i>
                                    </div>

                                </div>

                                {!! Form::close() !!}

                            </div>
                        </div>

                        <div class="md-card-content invoice_content print_bg" style="height: 100%;">

                            <div class="uk-grid pull-right" data-uk-grid-margin="">

                                <div class="uk-width-small-5-5 uk-text-center">
                                    <p style="line-height: 5px; margin-top: 5px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 5px;" class="heading_b">Trial Balance</p>
                                    <p style="line-height: 10px; font-size:15px !important;" class="uk-text-small">From {{ date('d-m-Y',strtotime($start)) }}  To {{ date("d-m-Y",strtotime($end."-0 days"))}}</p>
                                </div>

                                <div class="print_date">
                                    <p style="text-align: right">Print Date : {{ date('d-m-Y') }}</p>
                                </div>

                            </div>

                            <div style="margin-bottom: 0px !important" class="uk-grid">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">

                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th class="uk-text-left">Account Name</th>
                                            <th class="uk-text-right">debit</th>
                                            <th class="uk-text-right">credit</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                          @php
                                            $debit   = 0;
                                            $credit  = 0;
                                          @endphp
                                        @foreach($dabit_credit as $parent_account=>$value)
                                            <tr>
                                                <td colspan="3" class=""><b style="color:red">{{$parent_account}}</b></td>

                                            </tr>
                                            @php
                                              $debit_sub   = 0;
                                              $credit_sub  = 0;
                                            @endphp
                                            @foreach($value as $data)
                                              <tr>
                                                  <td class="uk-text">{{$data->account_name}}</td>
                                                  <td class="uk-text-right">
                                                    @if($parent_account == 'Assets' || $parent_account == 'Expense')
                                                      {{ number_format($data->debit_amount -$data->credit_amount, 2, '.', ',')  }}
                                                     @endif
                                                  </td>
                                                  <td class="uk-text-right">
                                                    @if($parent_account == 'income' || $parent_account == 'Liability' || $parent_account == 'Equity')
                                                     {{ number_format($data->credit_amount -$data->debit_amount, 2, '.', ',')   }}
                                                    @endif</b></td>
                                              </tr>
                                              @php
                                                if($parent_account == 'Assets' || $parent_account == 'Expense')
                                                $debit_sub  += $data->debit_amount - $data->credit_amount;

                                              if($parent_account == 'income' || $parent_account == 'Liability' || $parent_account == 'Equity')
                                                  $credit_sub += $data->credit_amount - $data->debit_amount;

                                              @endphp
                                            @endforeach
                                            <!-- <tr>
                                                <td class="uk-text">Total</td>
                                                <td class="uk-text-right">
                                                  @if($parent_account == 'Assets' || $parent_account == 'Expense')
                                                   {{ $debit_sub }}
                                                  @endif
                                                 </td>
                                                <td class="uk-text-right">
                                                  @if($parent_account == 'income' || $parent_account == 'Liability' || $parent_account == 'Equity')
                                                   {{ $credit_sub }}
                                                  @endif
                                                 </td>
                                            </tr> -->
                                            @php
                                              $debit  += $debit_sub;
                                              $credit += $credit_sub;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td class="uk-text">Total</td>
                                            <td class="uk-text-right">{{  number_format($debit, 2, '.', ',')  }}</td>
                                            <td class="uk-text-right"> {{  number_format($credit, 2, '.', ',') }}</td>
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

                            <br>
                            <br>

                            <div class="uk-grid">
                                <div class="uk-width-1-2" style="text-align: left">
                                    <p class="uk-text-small uk-margin-bottom">Accounts Signature</p>
                                </div>
                                <div class="uk-width-1-2" style="text-align: right">
                                    <p  class="uk-text-small uk-margin-bottom">Authorised Signature</p>
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
