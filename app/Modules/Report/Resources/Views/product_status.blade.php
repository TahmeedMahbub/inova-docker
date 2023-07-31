@extends('layouts.admin')

@section('title', 'Product Report')

@section('header')
    @include('inc.header')
@endsection

@section('styles')
    <style>
        span.select2-container{
            z-index: 30 !important;
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
    @inject('Report', 'App\Lib\Report')
    
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-10-10">
                <div class="md-card md-card-single hidden-print">
                  {!! Form::open(['url' => '/report/product', 'method' => 'get', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                      <div class="user_content">
                          <div class="uk-margin-top">
                              <div class="uk-grid" data-uk-grid-margin>
                                  <div class="uk-width-medium-1-6">
                                    <label for=""> Choose Zone</label> </br>
                                      <select  title="Select Zone"  class="md-input select2-single-search-dropdown" id="" name="zone_id">
                                        <option value="0"> All </option>
                                        @foreach($zones as $zone)
                                            <option value="{{ $zone->id }}" @if($zone->id == $zone_id) selected @endif> {{ $zone->name }} </option>
                                        @endforeach
                                      </select>
                                  </div>
                                  
                                  <div class="uk-width-medium-1-6">
                                    <label for=""> Choose SR</label><br>
                                      <select  title="Select SR"  class="md-input select2-single-search-dropdown" id="" name="sr_id">
                                          <option value="0"> All </option>
                                            @foreach($srs as $sr)
                                                <option value="{{ $sr->id }}" @if($sr->id == $sr_id) selected @endif> {{ $sr->name }} </option>
                                            @endforeach
                                      </select>
                                  </div>
    
                                  <div class="uk-width-medium-1-6">
                                    <label for=""> Choose Customer</label><br>
                                      <select  title="Select Customer"  class="md-input select2-single-search-dropdown" id="" name="customer_id">
                                            <option value="0"> All </option>
                                            @foreach($contacts as $contact)
                                                <option value="{{ $contact->id }}" @if($contact->id == $customer_id) selected @endif> {{ $contact->display_name }} </option>
                                            @endforeach
                                      </select>
                                  </div>
                                  
                                  <div class="uk-width-medium-1-6">
                                    <label for=""> Choose Product</label><br>
                                      <select  title="Select Product"  class="md-input select2-single-search-dropdown" id="" name="product_id">
                                        <option value="0"> All </option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}" @if($item->id == $item_id) selected @endif> {{ $item->item_name }} </option>
                                        @endforeach
                                      </select>
                                  </div>
                                  
                                  <div class="uk-width-medium-1-6">
                                    <label for=""> Form</label>
                                       <input class="md-input" type="text" id="uk_dp_1" name="from" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ date('Y-m-d', strtotime($start)) }}">
                                  </div>
                                  
                                  <div class="uk-width-medium-1-6">
                                    <label for="">To</label>
                                       <input class="md-input" type="text" id="uk_dp_1" name="to" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ date('Y-m-d', strtotime($end)) }}">
                                  </div>
                              
                                  <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="Filter" name="submit" />
                                        </div>
                                  </div>
    
                          </div>
                      </div>
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    
    <br>
    
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse">
            <div class="uk-width-large-10-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview hidden-print">
                        <div class="md-card-toolbar hidden-print">
                            <div class="md-card-toolbar-actions hidden-print" style="float: right;">
                                <i class="md-icon material-icons" id="invoice_print"></i>
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
                                    <p style="line-height: 5px;" class="uk-text-small">From {{ date('d-m-Y',strtotime($start)) }} To {{ date('d-m-Y',strtotime($end)) }} </p>
                                    <p style="line-height: 0px; margin-top: 15px;"
                                       class="uk-text-large">
                                      @if($customer_id != 0) {{ 'Customer Name : '.$customer_name['display_name']}},@endif @if($sr_id != 0){{ 'SR Name : '.$sr_name['name'] }},@endif @if($zone_id != 0){{ 'Zone : '.$zone_name['name'] }}@endif
                                    </p>
                                </div>
                            </div>
                            <div class="uk-grid">


                                <!-- Debit Calculation-->
                                <div  class="uk-width-1-1">

                                    <table class="uk-table">
                                        <thead>
                                          <tr class="uk-text-upper">
                                              <th class="uk-text-left">SL</th>
                                              <th class="uk-text-left">Product Name</th>
                                              <th class="uk-text-left">IMEI</th>
                                              <th class="uk-text-right">Rate</th>
                                              <th class="uk-text-center">Quantity</th>
                                              <th class="uk-text-right">Amount</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total_amount_sum = 0; ?>
                                            
                                            @if(isset($data) && ($data != ''))
                                            @foreach($data as $key => $value)
                                            
                                            <?php $total_amount_sum = $total_amount_sum + $value['total_amount']; ?>
                                            
                                            <tr>
                                                <td style="color: red;font-weight: bold" class="uk-text-left" colspan="6">{{ 'Invoice Date : '.date('d-m-Y', strtotime($value['invoice_date'])) }}, {{ 'INV - '.$value['invoice_number'] }}, @if($customer_id == 0) {{ 'Customer Name : '.$value['customer_name'] }},@endif @if($sr_id == 0){{ 'SR Name : '.$value['sr_name'] }},@endif @if($zone_id == 0){{ 'Zone : '.$Report->zone($value['zone_id']) }}@endif</td>
                                            </tr>
                                            <?php $qnt = array_sum($value['quantity']); ?>
                                            
                                            @foreach($value['item_name'] as $key1 => $value1)
                                            <tr>
                                                <td class="uk-text-left">{{ $key1 + 1 }}</td>
                                                <td class="uk-text-left">{{ $value1 }}</td>
                                                <td class="uk-text-left">{{ $Report->IMEI($value['item_id'][$key1]) }}</td>
                                                <td class="uk-text-right">{{ $value['total_amount']/$qnt }}</td>
                                                <td class="uk-text-center">{{ $value['quantity'][$key1] }}</td>
                                                <td class="uk-text-right">{{ number_format($value['quantity'][$key1]*($value['total_amount']/$qnt), 2, '.', ',') }}</td>
                                            </tr>
                                            @endforeach
                                            
                                            <tr>
                                                <td style="color: black" class="uk-text-right" colspan="5"><b>Sub Total</b></td>
                                                <td class="uk-text-right" colspan="5"><b>{{ number_format($value['total_amount'], 2, '.', ',') }}</b></td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                            <tr>
                                                <td style="color: black" class="uk-text-right" colspan="5"><b>Total</b></td>
                                                <td class="uk-text-right" colspan="5"><b>{{ number_format($total_amount_sum, 2, '.', ',') }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
