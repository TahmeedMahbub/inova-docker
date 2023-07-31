@extends('layouts.main')

@section('title', 'Stock Details Report '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        @media print {
            .user_heading{
                display: none !important;
            }
            .uk-table tr td{
                padding: 1px 0px;
                border: none !important;
                width: 100%;
                font-size: 11px !important;
            }
            .uk-table tr th{
                    padding: 1px 2px;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;
                    width: 100%;
                    font-size: 11px !important;
                }
            .uk-table tr th:last-child,.uk-table tr th:nth-child(3){
               white-space: nowrap;

            }
            .uk-table tr td:last-child{
                text-align: right;
            }
            .uk-table tr td:first-child{
                text-align: left;
            }

            body{
                margin-top: -40px;
                text-align: center;
            }

        }
    </style>
@endsection

@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <h3 style="float: left; color: white;">Stock Report</h3>
                            <i style="color: whitesmoke; float: right;" class="md-icon material-icons" onclick="print()" id="invoice_print">ювн</i>
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" style="float: right; margin-right: 10px; margin-top: 7px; color: #fff;" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                            </div>
                            <!--coustorm setting modal start -->
                            <div class="uk-modal" id="coustom_setting_modal">
                                <div class="uk-modal-dialog">
                                    {!! Form::open([ 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}


                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Select Date Range and Transaction Type <i
                                                    class="material-icons" data-uk-tooltip="{pos:'top'}"
                                                    title="headline tooltip">&#xE8FD;</i></h3>
                                    </div>

                                    <div class="uk-width-large-2-2 uk-width-2-2">
                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                                class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">Form</label>
                                                <input style="color: #000;" class="md-input" type="text" id="uk_dp_1" name="from_date"
                                                       data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                            </div>
                                        </div>
                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                                class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">To</label>
                                                <input  style="color: #000;" class="md-input" type="text" id="uk_dp_1" name="to_date"
                                                       data-uk-datepicker="{format:'YYYY-MM-DD'}">
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
                        </div>
                        <div>
                            <div class="uk-grid" data-uk-grid-margin style="margin-top: 20px;">

                                <div class="uk-width-small-5-5 uk-text-center">
                                    <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                    <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 15px;" class="heading_b">{{ $stock->item_name }} Stock Report</p>
                                    <p style="line-height: 30px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                                </div>
                            </div>

                        </div>
                        <div class="user_content">
                            <div class="uk-overflow-container ">
                                <h4><span style="padding-right: 20px; float: left">Total Stock In : <span id="stockin"></span></span>  <span style="padding-right: 20px;">Total Stock Out : <span id="stockout"></span></span> <span style="padding-right: 20px; float: right">Stock In Hand : <span id="stockhand"></span></span></h4>

                                <div class="uk-grid">
                                    <div class="uk-width-1-2">
                                        <table class="uk-table" cellspacing="0" width="100%"  >
                                            <thead>
                                            <tr>
                                                <th id="sortby" class="uk-text-left">Date</th>
                                                <th class="uk-text-left">Transaction</th>
                                                <th class="uk-text-right">Stock In</th>
                                                <th class="uk-text-right">Total Stock In</th>
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th class="uk-text-left">Date</th>
                                                <th class="uk-text-left">Transaction</th>
                                                <th class="uk-text-right">Stock In</th>
                                                <th class="uk-text-right">Total Stock In</th>
                                            </tr>
                                            </tfoot>

                                            <tbody id="in">
                                            @php
                                                $stocktotal = 0;
                                            @endphp
                                            @foreach($stock->stocks as $value)
                                                @php

                                                    $stocktotal =$stocktotal+$value->total;
                                                @endphp
                                                <tr>
                                                    <td class="uk-text-left">{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                    <td class="uk-text-left">
                                                        @if( $value->bill)
                                                            BILL-{{ $value->bill->bill_number }}
                                                        @elseif($value->creditNote)
                                                            CN-{{ $value->creditNote->credit_note_number }}
                                                        @endif
                                                    </td>
                                                    <td class="uk-text-right">{{ $value->total }}</td>

                                                    <td class="uk-text-right"> {{ $stocktotal }}</td>



                                                </tr>
                                            @endforeach


                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="uk-width-1-2">

                                        <table class="uk-table" cellspacing="0" width="100%"  >
                                            <thead>
                                            <tr>
                                                <th id="sortby" class="uk-text-left">Date</th>
                                                <th class="uk-text-left">Transaction</th>

                                                <th class="uk-text-right">Stock Out</th>

                                                <th class="uk-text-right">Total Stock Out</th>

                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th class="uk-text-left">Date</th>
                                                <th class="uk-text-left">Transaction</th>

                                                <th class="uk-text-right">Stock Out</th>

                                                <th class="uk-text-right">Total Stock Out</th>


                                            </tr>
                                            </tfoot>

                                            <tbody id="out">
                                            @php
                                                $stocktotal =0;
                                            @endphp

                                            @foreach($stock->invoiceEntries as $value)
                                                @if($value->invoice->save==null)
                                                    <tr>
                                                        <td class="uk-text-left"> {{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                        <td class="uk-text-left">
                                                            @if( $value->invoice_id)
                                                                INV-{{ $value->invoice->invoice_number }}

                                                            @endif
                                                        </td>

                                                        <td class="uk-text-right">{{ $value->quantity }}</td>

                                                        <td class="uk-text-right">{{ $stocktotal=$stocktotal+$value->quantity }}</td>



                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                            <!-- Add branch plus sign -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_reports').addClass('act_item');

        window.onload = function () {

           var stockin = $('#in tr:last-child td:last-child').text();
           var stockout = $('#out tr:last-child td:last-child').text();

           var totalstock = parseInt(stockin) - parseInt(stockout);
            $('#stockin').text(stockin);
            $('#stockout').text(stockout);
            $('#stockhand').text(totalstock||'');

        }
    </script>

@endsection