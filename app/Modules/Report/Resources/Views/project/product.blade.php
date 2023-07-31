@extends('layouts.admin')

@section('title', 'Project')

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
                padding: 1px 2px;
                border: 1px solid black !important;
                width:1%;
                font-size: 11px !important;
            }
            .uk-table tr th:last-child, .uk-table tr td:last-child{

            }
            .uk-table tr th:first-child, .uk-table tr td:first-child{
                white-space: nowrap;
                text-align: left !important;


            }
            .uk-table tr th{
                white-space: nowrap;
                padding: 1px 2px;
                border: 1px solid black;

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
              {!! Form::open(['url' => route('project_product_wise_view'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                  <div class="user_content">
                      <div class="uk-margin-top">
                          <div class="uk-grid" data-uk-grid-margin>
                              <div class="uk-width-medium-3-6">
                                <label for=""> Chose Project</label> </br>
                                  <select  title="Select Agent"  class="md-input select2-single-search-dropdown" id="" name="pid_no">
                                    <option value=""> Select Final Project </option>
                                  @foreach( $all_products as $value)

                                    <option value="{{ $value->id}}">PID-{{ str_pad($value->id,6, '0', STR_PAD_LEFT)}} {{$value->item_name}} {{date("d-m-Y",strtotime($value->created_at))}}</option>
                                  @endforeach
                                  </select>
                              </div>
                              <div class="uk-width-medium-1-6">
                                <label class="container">View Product Wise
                                    <input type="checkbox" value="1" name="view_product_wise">
                                    <span class="checkmark"></span>
                                 </label>
                              </div>
                              <div class="uk-width-medium-2-6">
                                <label for=""> Chooose Final Project</label><br>
                                  <select  title="Select Agent"  class="md-input select2-single-search-dropdown" id="" name="final_project">
                                      <option value=""> Select Final Project </option>
                                    @foreach($all_products as $value)
                                      <option value="{{ $value->id}}"> {{ $value->item_name }} </option>
                                    @endforeach
                                  </select>
                              </div>

                          </div>
                          <div class="uk-grid" data-uk-grid-margin>
                              <div class="uk-width-medium-2-6">
                                <label for=""> Chooose Issued Raw Material</label><br>
                                  <select  title="Select Agent"  class="md-input select2-single-search-dropdown" id="" name="issue_number">
                                    <option value=""> Select Issued Raw Material </option>
                                      @foreach($issue_raw_material as $value)
                                      <option value="{{ $value->id}}"> RMI-{{ $value->issued_number }} </option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="uk-width-medium-2-6">
                                <label for=""> Form</label>
                                   <input class="md-input" type="text" id="uk_dp_1" name="form" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                              </div>
                              <div class="uk-width-medium-2-6">
                                <label for="">To</label>
                                   <input class="md-input" type="text" id="uk_dp_1" name="to" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                              </div>
                          </div>
                          <div class="uk-grid uk-ma" data-uk-grid-margin>
                              <div class="uk-width-1-1 uk-float-left">
                                  <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="submit" name="submit" />
                                  <!-- <input type="submit" class="md-btn md-btn-success" value="save" name="save" /> -->

                                  <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
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
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-10-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar hidden-print">
                            <div class="md-card-toolbar-actions ">
                                <i class="md-icon material-icons" id="invoice_print"></i>



                                <!--end  -->
                              
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['route' => 'project_product_wise_view', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range  <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>
                                          <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div style="margin-left:50px !important;" class="uk-width-large-2-2 uk-width-2-2">
                                              <label class="container">View Product Wise
                                                  <input type="checkbox" value="1" name="view_product_wise">
                                                  <span class="checkmark"></span>
                                               </label>
                                            </div>
                                            <div style="margin-left:50px !important;" class="uk-width-large-2-2 uk-width-2-2">
                                                    <select style="width: 93%"class="md-input select2-single-search-dropdown cls" title="Select Customer" id="customer_id" name="customer_id" required>
                                                        <option value="">Select Name</option>
                                                        <option value="">Select Name</option>
                                                        <option value="">Select Name</option>
                                                    </select>

                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">From</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
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
                                    <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->display_name }}</p>
                                    <p style="line-height: 5px;" class="heading_b">Product </p>
                                    <p style="line-height: 5px;" class="uk-text-small">From {{$start}} To {{$end}}</p>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th class="uk-text-center">SL</th>
                                            <th class="uk-text-center">Date</th>
                                            <th class="uk-text-center">Phase</th>
                                            <th class="uk-text-center">RMI</th>
                                            <th class="uk-text-center">Raw Product</th>
                                            <th class="uk-text-right">Quantity</th>
                                            <th class="uk-text-right">Proudct Rate</th>
                                            <th class="uk-text-right">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                           $i=0;
                                           $qty     = 0;
                                           $rate    = 0;
                                           $amount  = 0;
                                          @endphp



                                            @foreach($ass_arr as $key=>$value)
                                            @php

                                             $sub_qty     = 0;
                                             $sub_rate    = 0;
                                             $sub_amount  = 0;
                                            @endphp
                                            <tr>
                                              <td></td>
                                              <td></td>
                                              <td style="color:red" colspan="6">
                                               @php
                                                $phase  = explode('@1262587',$key);
                                                 echo $phase[0];
                                               @endphp
                                               </td>

                                            </tr>
                                             @foreach($value as $key2=>$data)

                                                <tr>
                                                  <td class="uk-text-center">{{ $key2+1}}</td>
                                                  <td class="uk-text-center">{{ date("d-m-Y", strtotime($data->phase_item_date))}}</td>
                                                  <td class="uk-text-center"></td>
                                                  <td class="uk-text-center">RMI-{{ $data->RMI }}</td>
                                                  <td class="uk-text-center">{{ $data->raw_prodect }} </td>
                                                  <td class="uk-text-right">{{ $data->QTY }}</td>
                                                  <td class="uk-text-right">{{number_format($data->rate, 2) }}</td>
                                                  <td class="uk-text-right">{{ number_format($data->rate*$data->QTY, 2) }}</td>
                                                </tr>
                                                @php
                                                   $sub_qty     += $data->rate;
                                                   $sub_rate    += $data->QTY;
                                                   $sub_amount  += $data->rate*$data->QTY;
                                                @endphp
                                              @endforeach
                                              <tr>
                                                <td class="uk-text-center"></td>
                                                <td class="uk-text-center"></td>
                                                <td class="uk-text-center"></td>
                                                <td class="uk-text-center"></td>
                                                <td class="uk-text-center"> Total</td>
                                                <td class="uk-text-right">{{ number_format( $sub_rate, 2) }}</td>
                                                <td class="uk-text-right">{{number_format($sub_qty, 2) }}</td>
                                                <td class="uk-text-right">{{ number_format($sub_amount, 2) }}</td>
                                              </tr>

                                              @php
                                                 $qty     += $sub_qty;
                                                 $rate    += $sub_rate;
                                                 $amount  += $sub_amount;
                                              @endphp

                                          @endforeach
                                          <tr>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center"></td>
                                            <td class="uk-text-center">Grand Total</td>
                                            <td class="uk-text-right"><b>{{ number_format( $rate, 2) }}</b></td>
                                            <td class="uk-text-right"><b>{{number_format($qty, 2) }}</b></td>
                                            <td class="uk-text-right"><b>{{ number_format($amount, 2) }}</b></td>
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

    <script>

        window.onload = function () {
            var sum = 0;
            var recievesum = 0;
            var salessum = 0;
            var psum = 0;
            var table = document.getElementById('single_agent');
            var balance = 0;

            for (var r = 0, n = table.rows.length; r < n; r++) {

                sales = parseFloat(table.rows[r].cells[2].innerText) >= 0? parseFloat(table.rows[r].cells[2].innerText) : 0.00;
                receive = parseFloat(table.rows[r].cells[3].innerText) >= 0? parseFloat(table.rows[r].cells[3].innerText) : 0.00;
                payable = parseFloat(table.rows[r].cells[4].innerText) >= 0? parseFloat(table.rows[r].cells[4].innerText) : 0.00;
                paid = parseFloat(table.rows[r].cells[5].innerText) >= 0? parseFloat(table.rows[r].cells[5].innerText) : 0.00;

                salessum = salessum + sales;
                recievesum = recievesum + receive;
                sum = sum + payable;
                psum = psum + paid;

                   if(r == 0){
                       balance = sum - psum;

                       table.rows[r].cells[6].innerText = balance.toFixed(2);
                   }else{
                       balance = balance + payable - paid;

                       table.rows[r].cells[6].innerText = balance.toFixed(2);
                   }


            }



            document.getElementById('totalrecieve').innerText = recievesum.toFixed(2);
            document.getElementById('salesamount').innerText = salessum.toFixed(2);
            document.getElementById('total_payable').innerText = sum.toFixed(2);
            document.getElementById('paid').innerText = psum.toFixed(2);
            document.getElementById('balance').innerText = balance.toFixed(2);

        }

    </script>

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
on
