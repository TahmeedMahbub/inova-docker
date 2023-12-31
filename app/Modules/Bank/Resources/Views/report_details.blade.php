@extends('layouts.admin')

@section('title', 'Bank Report Details '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('content_header')
@section('styles')
    <style>
        @media print
        {
            .md-card-toolbar{
                display: none;
            }

            .uk-table{
                width: 100%;
                text-align: left;
            }
            .uk-table tr td{

                padding: 2px;
                border: 1px solid black !important;
                font-size: 11px !important;
            }
            .uk-table tr th{
                text-align: left;
                padding: 2px;
                border: 1px solid black;
                font-size: 11px !important;
            }
            .uk-table tr td:last-child, .uk-table tr th:last-child{
                text-align: right;

            }


            body{
                margin-top: -40px;
            }
        }
    </style>
@endsection
@endsection
@section('content')
<div class="uk-width-medium-10-10 uk-container-center reset-print">
    <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
        <div class="uk-width-large-10-10">
            <div class="md-card md-card-single main-print">
                <div id="invoice_preview ">
                    <div class="md-card-toolbar hidden-print">
                        <div class="md-card-toolbar-actions hidden-print">
                            <i class="md-icon material-icons" id="invoice_print"></i>


                           
                            <!--end  -->
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>
                                
                            </div>
                            <!--coustorm setting modal start -->
                            <div class="uk-modal" id="coustom_setting_modal">
                                <div class="uk-modal-dialog">
                                {!! Form::open(['route' => ['bank_report_form',$id, $branch_id], 'method' => 'POST']) !!}
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
                                        <button type="submit" name="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
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
                                <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
                                <p style="line-height: 5px; font-size: 1em;" class="heading_b">Bank Report</p>
                                <p style="line-height: 5px; font-color: black;" class="">{{ $branch_name->branch_name }}</p>
                                <p style="line-height: 5px; margin-top:20px; " class="heading_b">{{ isset($bank_name->display_name)?$bank_name->display_name:'' }} Report</p>
                                <p style="line-height: 5px;" class="uk-text-small">From {{$start}}  To {{$end}}</p>
                            </div>
                        </div>
                        <div class="uk-grid ">
                            <div class="uk-width-1-1">
                                <table class="uk-table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Particulars</th>
                                        <th style="text-align: right;">Deposit</th>
                                        <th style="text-align: right;">Withdrawal</th>
                                        <th style="text-align: right;">Balance</th>
                                    </tr>
                                    </thead>
                                    @inject('openingbank', 'App\Lib\BankReport')
                                     <?php
                                    $balance =0;

                                   $openingbank->setDate($start, $end, $branch_id);
                                   $opening_deposite = $openingbank->deposit_openning_balance($id);
                                   $opening_withdraw = $openingbank->withdraw_openning_balance($id);
                                   $opening_balance = $opening_deposite - $opening_withdraw;
                                   $balance = $opening_balance;
                                    ?>
                                  <tr>
                                      <td>{{ date("d-m-Y",strtotime($start)) }}</td>
                                      <td>Opening Balance</td>
                                      <td style="text-align: right;">{{ $opening_deposite }}</td>
                                      <td style="text-align: right;">{{  $opening_withdraw }}</td>
                                      <td style="text-align: right;">{{ $opening_balance  }}</td>
                                  </tr>
                                    @foreach($bank as $bank_report_data)

                                    <?php $deposite=0; $withdrawal=0;?>
                                    <tr>
                                        <td>{{ date('d-m-Y',strtotime($bank_report_data->assign_date)) }}</td>
                                        <td>
                                            @if(!is_null($bank_report_data->bank_id))
                                                {{$bank_report_data->bank->particulars}}
                                                (Bank-{{ str_pad($bank_report_data->bank_id,'6',0,STR_PAD_LEFT) }}
                                                Cheque Number: {{ $bank_report_data->bank->cheque_number }})
                                            @elseif(!is_null($bank_report_data->income_id))
                                                {{$bank_report_data->income->customer->display_name}}
                                                (INC-{{ str_pad($bank_report_data->income->income_number,'6',0,STR_PAD_LEFT) }} 
                                                Cheque Number: {{ $bank_report_data->income->bank_info }})
                                            @elseif(!is_null($bank_report_data->payment_receives_id))
                                                {{$bank_report_data->paymentReceive->paymentContact->display_name}}
                                                (PR-{{ str_pad($bank_report_data->paymentReceive->pr_number,'6',0,STR_PAD_LEFT) }} 
                                                Cheque Number: {{ $bank_report_data->paymentReceive->bank_info }})
                                            @elseif(!is_null($bank_report_data->credit_note_refunds_id))
                                                {{$bank_report_data->creditNoteRefund->creditNote->customer->display_name}}
                                                (CN-{{ str_pad($bank_report_data->creditNoteRefund->id,'6',0,STR_PAD_LEFT) }})
                                            @elseif(!is_null($bank_report_data->expense))
                                                {{$bank_report_data->expense->customer->display_name}}
                                                (Exp-{{ str_pad($bank_report_data->expense->expense_number,'6',0,STR_PAD_LEFT) }}
                                                Cheque Number: {{ $bank_report_data->expense->bank_info }})
                                            @elseif(!is_null($bank_report_data->payment_made_id))
                                                {{$bank_report_data->paymentMade->customer->display_name}}
                                                ({{ $bank_report_data->payment_made->account_id == 3 ? 'CP' : 'BP' }}-{{ \Carbon\Carbon::createFromFormat('Y-m-d', $bank_report_data->payment_made->payment_date)->year }}/{{ str_pad($bank_report_data->paymentMade->pm_number,'6',0,STR_PAD_LEFT) }} 
                                                Cheque Number: {{ $bank_report_data->paymentMade->bank_info }})
                                            @elseif(!is_null($bank_report_data->salesComission_id))
                                                {{$bank_report_data->Agent->display_name}}
                                                (SC-{{ str_pad($bank_report_data->SalesCommission->scNumber,'6',0,STR_PAD_LEFT) }} 
                                                Cheque Number: {{ $bank_report_data->SalesCommission->bank_info }})
                                            @elseif(!is_null($bank_report_data->journal_id))
                                                MJ-{{ str_pad($bank_report_data->journal->id,'6',0,STR_PAD_LEFT) }}

                                            @endif
                                        </td>
                                        <td style="text-align: right;">
                                            @if($bank_report_data->debit_credit==1)
                                              {{ $deposite=$bank_report_data->amount }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td style="text-align: right;">
                                             @if($bank_report_data->debit_credit==0)
                                                 {{ $withdrawal=$bank_report_data->amount }}
                                             @else
                                                0
                                             @endif
                                        </td>
                                        <td style="text-align: right;">
                                            <?php $balance = $balance + $deposite - $withdrawal; ?>
                                                {{$balance}}
                                        </td>
                                    </tr>

                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>

                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-2" style="text-align: left">
                                <p class="uk-text-small uk-margin-bottom">Accounts Signature and Date</p>
                            </div>
                            <div class="uk-width-1-2" style="text-align: right">
                                <p  class="uk-text-small uk-margin-bottom">Authorised Signature and Date</p>
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

    $('#sidebar_bank_report').addClass('act_item');
    $('#sidebar_main_account').addClass('current_section');
    $(window).load(function(){
        $("#tiktok_account").trigger('click');
    })
</script>
@endsection
