@extends('layouts.admin')

@section('title', 'Product Status Report')

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
                  {!! Form::open(['url' => '/report/product/status', 'method' => 'get', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                      <div class="user_content">
                          <div class="uk-margin-top">
                              <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-4">
                                    <label for=""> Choose Zone</label> </br>
                                    <select  title="Select Zone"  class="md-input select2-single-search-dropdown" id="" name="zone_id">
                                          <option value="0"> All </option>
                                      @foreach($zones as $zone)
                                          <option value="{{ $zone->id }}" @if($zone->id == $zone_id) selected @endif> {{ $zone->name }} </option>
                                      @endforeach
                                    </select>
                                </div>
                                
                                <div class="uk-width-medium-1-4">
                                  <label for=""> Choose SR</label><br>
                                    <select  title="Select SR"  class="md-input select2-single-search-dropdown" id="" name="sr_id">
                                        <option value="0"> All </option>
                                          @foreach($srs as $sr)
                                              <option value="{{ $sr->id }}" @if($sr->id == $sr_id) selected @endif> {{ $sr->name }} </option>
                                          @endforeach
                                    </select>
                                </div>
                                
                                <div class="uk-width-medium-1-4">
                                  <label for=""> Choose Product</label><br>
                                    <select  title="Select Product"  class="md-input select2-single-search-dropdown" id="" name="product_id">
                                      <option value="0"> All </option>
                                      @foreach($items as $item)
                                          <option value="{{ $item->id }}" @if($item->id == $item_id) selected @endif> {{ $item->item_name }} </option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="uk-width-medium-1-4">
                                  <label for=""> Status</label><br>
                                    <select  title="Select status_id"  class="md-input select2-single-search-dropdown" id="" name="status_id">
                                      <option value="0"> All </option>
                                      @foreach($status as $status_value)
                                          <option value="{{ $status_value->id }}" @if($status_value->id == $status_id) selected @endif> {{ $status_value->status_name }} </option>
                                      @endforeach
                                    </select>
                                </div>
                              </div>

                              <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-4">
                                  <label for=""> IMIE Number</label>
                                     <input class="md-input" type="text" id="uk_dp_1" name="imei_number"  value="{{ $imei_number ? $imei_number : ''}}">
                                  </div>
                                 <div class="uk-width-medium-1-4">
                                  <label for="">To</label>
                                     <input class="md-input" type="text" id="uk_dp_1" name="from" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{ date('Y-m-d', strtotime($start)) }}">
                                </div>
                                 <div class="uk-width-medium-1-4">
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
                                      
                                    </p>

                                    <p style="line-height: 0px; margin-top: 15px;"
                                       class="uk-text-large">
                                      Product Status Report
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
                                              <th class="uk-text-left">Customer</th>
                                              <th class="uk-text-right">Amount</th>
                                          </tr>
                                        </thead>
                                        <tbody>

                                            @if(!empty($data) && (count($data) > 0))
                                            <?php
                                              $grand_total_receivable   = 0; 
                                              $grand_total_received     = 0; 
                                            ?>
                                            @foreach($data as $key => $value)
                                            @if(!empty($value['status_id']))
                                              <tr class="uk-text-upper">
                                                <td style="color: red;font-weight: bold" class="uk-text-left" colspan="5">{{ $data[$key]['sr_name'] }}</td>
                                              </tr>

                                                  <?php
                                                    $total_receivable   = 0;
                                                  ?>

                                                  @foreach($status as $key1 => $status_value)
                                                      <?php 
                                                        $m                      = 0;
                                                        $sub_total_receivable   = 0;
                                                      ?>

                                                      @foreach($value['status_id'] as $key2 => $val_1)
                                                        @if($val_1[0]['status'] == $status_value->id)

                                                          @if($m == 0)
                                                          <tr class="uk-text-upper">
                                                            <td style="color: blue;font-weight: bold" class="uk-text-left" colspan="5">   {{ $status_value->status_name }}
                                                            </td>
                                                          </tr>
                                                          @endif

                                                          <tr class="uk-text-upper">
                                                            <td class="uk-text-left">{{ $m + 1 }}</td>
                                                            <td class="uk-text-left">{{ $val_1[0]['product_name'] }}</td>
                                                            <td class="uk-text-left">{{ $val_1[0]['product_serial'] }}</td>
                                                            <td class="uk-text-left">
                                                              <?php echo $Report->customerName($val_1[0]['invoice_id'], $val_1[0]['product_serial']); ?>
                                                            </td>
                                                            <td class="uk-text-right">
                                                              <?php echo $Report->totalReceivable($val_1[0]['invoice_id'], $val_1[0]['product_serial']); ?>
                                                            </td>
                                                          </tr>

                                                          <?php 
                                                            $m++;
                                                            $sub_total_receivable  = $sub_total_receivable + $Report->totalReceivable($val_1[0]['invoice_id'], $val_1[0]['product_serial']);
                                                          ?>

                                                        @endif
                                                      @endforeach

                                                      <!-- @if($m > 0)
                                                      <tr class="uk-text-upper">
                                                        <td style="color: black;font-weight: bold" class="uk-text-right" colspan="3">Sub Total</td>
                                                        <td style="color: black;font-weight: bold" class="uk-text-right">{{ $sub_total_receivable }}</td>
                                                      </tr>
                                                      @endif -->

                                                      <?php $total_receivable   = $total_receivable + $sub_total_receivable; ?>
                                                  
                                                  @endforeach
                                                  
                                                <?php $coll_total = $Report->totalCollection($data[$key]['sr_id'], $start, $end); ?>

                                                @if(!empty($coll_total))
                                                <tr>
                                                  <td style="color: green;font-weight: bold;font-size: 18px" class="uk-text-left" colspan="5">Collection</td>
                                                </tr>

                                                <tr>
                                                  <th class="uk-text-left">SL</th>
                                                  <th class="uk-text-left">Retailer</th>
                                                  <th class="uk-text-right">Sold</th>
                                                  <th class="uk-text-right">Collection</th>
                                                  <th class="uk-text-right">Outstanding</th>
                                                </tr>
                                                <?php
                                                  $i            = 1;
                                                  $total_sell   = 0;
                                                  $total_col    = 0;
                                                  $total_sell1  = 0;
                                                  $total_col1   = 0;
                                                  $total_out    = 0;
                                                ?>
                                                @foreach($coll_total as $key12 => $val)

                                                @if(isset($val['total_sold']))
                                                  <?php $sell = $val['total_sold']; ?> 
                                                @else  
                                                  <?php $sell = 0; ?> 
                                                @endif

                                                @if(isset($val['total_collection']))
                                                  <?php $col = $val['total_collection']; ?> 
                                                @else  
                                                  <?php $col = 0; ?> 
                                                @endif

                                                <?php 
                                                  $total_sell = $total_sell + $sell;
                                                  $total_col  = $total_col + $col;
                                                  $total_sell1= $total_sell1 + $sell;
                                                  $total_col1 = $total_col1 + $col;
                                                  $total_out  = $total_out + ($total_sell - $total_col);
                                                ?>

                                                <tr>
                                                  <td class="uk-text-left">{{ $i }}</td>
                                                  <td class="uk-text-left">
                                                    <?php echo $Report->CustomerNameShow($val['customer_id']); ?>
                                                  </td>
                                                  <td class="uk-text-right">{{ $total_sell }}</td>
                                                  <td class="uk-text-right">{{ $total_col }}</td>
                                                  <td class="uk-text-right">{{ $total_sell - $total_col }}</td>
                                                </tr>

                                                <?php
                                                  $i++;
                                                  $total_sell = 0;
                                                  $total_col  = 0; 
                                                ?>
                                                @endforeach
                                              @endif

                                              <tr class="uk-text-upper">
                                                <td style="color: black;font-weight: bold" class="uk-text-right" colspan="2">Total</td>
                                                <td style="color: black;font-weight: bold" class="uk-text-right">{{ $total_sell1 }}</td>
                                                <td style="color: black;font-weight: bold" class="uk-text-right">{{ $total_col1 }}</td>
                                                <td style="color: black;font-weight: bold" class="uk-text-right">{{ $total_out }}</td>
                                              </tr>
                                            @endif
                                            @endforeach
                                            @endif
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
