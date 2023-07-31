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
    @inject('Report', 'App\Lib\Report')
    <div class="uk-width-medium-10-10 uk-container-center reset-print hidden-print">
      <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
          <div class="uk-width-large-10-10">
              <div class="md-card md-card-single main-print">
                {!! Form::open(['url' => route('project_index'), 'method' => 'GET', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                    <div class="user_content">
                        <div class="uk-margin-top">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-2-6">
                                  <label for=""> Choose Project</label> </br>
                                    <select  title="Select Project"  class="md-input select2-single-search-dropdown" id="" name="project_id">
                                      <option value="0"> All </option>
                                    @foreach($projects as $value)
                                      <option @if($value['id'] == $project_id) selected @endif value="{{ $value['id']}}">PID-{{ str_pad($value['id'],6, '0', STR_PAD_LEFT)}} {{$value['item_name']}} {{date("d-m-Y",strtotime($value['created_at']))}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="uk-width-medium-2-6">
                                  <label for=""> Choose Final Project</label><br>
                                    <select  title="Select Final Project"  class="md-input select2-single-search-dropdown" id="" name="final_project_id">
                                        <option value="0"> All </option>
                                      @foreach($products as $value)
                                        <option @if($value['id'] == $final_project_id) selected @endif value="{{ $value['id'] }}">{{ $value['item_name'] }} </option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="uk-width-medium-2-6">
                                  <label for=""> Choose Issued Raw Material</label><br>
                                    <select  title="Select Raw Material"  class="md-input select2-single-search-dropdown" id="" name="raw_material_id">
                                            <option value="0"> All </option>
                                            @foreach($issue_raw_material as $value)
                                            <option @if($value['id'] == $raw_material_id) selected @endif value="{{ $value['id'] }}">{{ $value['item_name'] }} </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <!-- <div style="margin-top:25px" class="uk-width-medium-2-6">
                                  <label class="container">View Raw Materials Product Wise
                                      <input type="checkbox" value="1" name="view_product_wise">
                                      <span class="checkmark"></span>
                                   </label>
                                </div> -->

                                <div class="uk-width-medium-2-6">
                                  <label for=""> Form</label>
                                     <input class="md-input" type="text" id="uk_dp_1" name="from" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ date('Y-m-d', strtotime($start)) }}"> 
                                </div>

                                <div class="uk-width-medium-2-6">
                                  <label for="">To</label>
                                     <input class="md-input" type="text" id="uk_dp_1" name="to" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ date('Y-m-d', strtotime($end)) }}">
                                </div>

                                <div class="uk-width-medium-2-6">
                                    <input type="submit" class="md-btn md-btn-primary" value="submit" />
                                </div>
                            </div>
                            <!-- <div class="uk-grid uk-ma" data-uk-grid-margin>
                                <div class="uk-width-1-1 uk-float-left">
                                    <input type="submit" class="md-btn md-btn-primary" value="submit" />
                                </div>
                            </div> -->

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
                                            <th class="uk-text-left">SL</th>
                                            <th class="uk-text-left">Date</th>
                                            <th class="uk-text-left">RMI</th>
                                            <th class="uk-text-left">Raw Product</th>
                                            <th class="uk-text-right">Quantity</th>
                                            <th class="uk-text-right">Proudct Rate</th>
                                            <th class="uk-text-right">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                                $i      = 1;
                                                // $total  = 0; 
                                          ?>

                                          @if(!empty($data) && count($data) > 0)
                                          @foreach($data as $key => $product_wise_value)
                                          <tr>
                                              <td style="color: black;font-weight: bold;width: 20px" class="uk-text-left">{{ $i }}</td>
                                              <td style="color: black;font-weight: bold" class="uk-text-left" colspan="6">{{ $product_wise_value['product_name'] }}</td>
                                          </tr>

                                          <?php 
                                                $i++;
                                                $total  = 0; 
                                          ?>

                                          @foreach($product_wise_value['product_phase'] as $key1 => $product_phase_value)

                                              <!-- <?php $phase_wise_date_rmi   = $Report->PhaseWiseDateRmi($product_phase_value['id'], $product_wise_value['product_id_date']); ?> -->

                                              <tr>
                                                  <td style="color: red" class="uk-text-left" colspan="7"><b>{{ $product_phase_value['product_phase_name'] }}</b></td>
                                              </tr>

                                              <?php 
                                                    $raw_id             = isset($_GET['raw_material_id']) ? $_GET['raw_material_id'] : 0;
                                                    $phase_wise_items   = $Report->PhaseWiseItem($product_phase_value['id'], $raw_id);
                                                    $j                  = 1;
                                                    $sub_total          = 0;
                                                    $total              = $total + $sub_total; 
                                              ?>

                                              @foreach($phase_wise_items as $key2 => $raw_product_value)
                                              <tr>
                                                  <td class="uk-text-left">{{ $j }}</td>
                                                  <td class="uk-text-left">{{ $raw_product_value['date'] }}</td>
                                                  <td class="uk-text-left">{{ 'RMI - '.$raw_product_value['rmi'] }}</td>
                                                  <td class="uk-text-left">{{ $raw_product_value['item_name'] }}</td>
                                                  <td class="uk-text-right">{{ $raw_product_value['total'] }}</td>
                                                  <td class="uk-text-right">{{ number_format($raw_product_value['item_purchase_rate'], 2, '.', ',') }}</td>
                                                  <td class="uk-text-right">{{ number_format($raw_product_value['total'] * $raw_product_value['item_purchase_rate'], 2, '.', ',') }}</td>
                                              </tr>

                                              <?php 
                                                    $j++; 
                                                    $sub_total = $sub_total + ($raw_product_value['total'] * $raw_product_value['item_purchase_rate']); 
                                              ?>

                                              @endforeach

                                              <tr>
                                                  <td class="uk-text-left"></td>
                                                  <td class="uk-text-left"></td>
                                                  <td class="uk-text-left"></td>
                                                  <td class="uk-text-left"></td>
                                                  <td class="uk-text-left"></td>
                                                  <td style="color: black;font-weight: bold" class="uk-text-right">Sub Total</td>
                                                  <td style="color: black;font-weight: bold" class="uk-text-right">{{ number_format($sub_total, 2, '.', ',') }}</td>
                                              </tr>

                                              <!-- <?php $total = $total + $sub_total; ?> -->

                                          @endforeach

                                              <tr>
                                                  <td class="uk-text-left"></td>
                                                  <td class="uk-text-left"></td>
                                                  <td class="uk-text-left"></td>
                                                  <td class="uk-text-left"></td>
                                                  <td class="uk-text-left"></td>
                                                  <td style="color: black;font-weight: bold" class="uk-text-right">Total</td>
                                                  <td style="color: black;font-weight: bold" class="uk-text-right">{{ number_format($total, 2, '.', ',') }}</td>
                                              </tr>

                                          @endforeach
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
@endsection