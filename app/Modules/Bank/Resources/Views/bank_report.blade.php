@extends('layouts.admin')

@section('title', 'Bank Report '.date("Y-m-d h-i-sa"))

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('content_header')
    
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
                text-align: center;
                padding: 1px 0px;
                border: 1px solid black;
                font-size: 11px !important;
            }
            .uk-table tr td:last-child{
                text-align: right;
            }

            body{
                margin-top: -40px;
            }
        }
        table.uk-table tr td{
            border: 2px solid #ddd;
        }
    </style>
@endsection
@section('content')
    @if($errors->first('from_date') || $errors->first('to_date'))
        <div class="uk-alert uk-alert-warning" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
           Date Range is Required
        </div>
    @endif

<div class="uk-width-medium-10-10 uk-container-center reset-print">
    <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
        <div class="uk-width-large-10-10">
            <div class="md-card md-card-single main-print">
                <div id="invoice_preview">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions hidden-print">
                            <i class="md-icon material-icons" id="invoice_print"></i>
                           
                            <!--end  -->
                            <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>
                                
                            </div>
                            <!--coustorm setting modal start -->
                            <div class="uk-modal" id="coustom_setting_modal">
                                <div class="uk-modal-dialog">
                                {!! Form::open(['url' => 'bank/report', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
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
                                                <input class="md-input" type="text" id="uk_dp_1" name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" required>
                                            </div>
                                        </div>
                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <label for="uk_dp_1">To</label>
                                                <input class="md-input" type="text" id="uk_dp_1" name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        <button type="submit"  class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
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
                                <p style="line-height: 5px; font-color: black;" class="heading_b">Bank Report</p>
                                <p style="line-height: 5px; font-color: black;" class="">{{ $branch_name->branch_name }}</p>
                                <p style="line-height: 5px;" class="uk-text-small">From {{ date("d-m-Y", strtotime($start)) }}  To {{ date("d-m-Y", strtotime($end)) }}</p>
                                
                            </div>
                        </div>
                        <div class="uk-grid uk-margin-large-bottom">
                            <div class="uk-width-1-1">
                                <table class="uk-table">
                                    <thead>
                                    <tr class="uk-text-upper">
                                        <th>Bank Name</th>
                                        <th>Openning Balance</th>
                                        <th>Total Deposit</th>
                                        <th>Total Withdrawal</th>
                                        <th>Total Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @inject('Bankreport', 'App\Lib\BankReport')
                                    @php
                                        $Bankreport->setDate($start, $end, $branch_id);
                                        $sum_opening_balance = 0;
                                        $sum_deposit         = 0;
                                        $sum_withdrawal      = 0;
                                        $sum_balance         = 0;
                                    @endphp
                                    @foreach($bank as $key => $bank_names_data)

                                    <tr class="uk-table-middle">
                                        <td class="uk-text-left"><a href="{{route('bank_report_details',[$key,$branch_id,$start,$end])}}">{{ $Bankreport->contact($key) }}</a></td>
                                        <td class="uk-text-right" title="{{ $key }}">
                                            {{ $Bankreport->deposit_openning_balance($key)-$Bankreport->withdraw_openning_balance($key) }}
                                        </td>
                                        <td class="uk-text-right" title="{{ $key }}">
                                          {{ $Bankreport->deposit($key) }}
                                        </td>
                                        <td class="uk-text-right">
                                            {{ $Bankreport->withdraw($key) }}
                                        </td>
                                        <td class="uk-text-right">{{ $Bankreport->deposit($key) - $Bankreport->withdraw($key) }}</td>
                                    </tr>
                                    @php
                                        $sum_opening_balance = $sum_opening_balance + $Bankreport->deposit_openning_balance($key)-$Bankreport->withdraw_openning_balance($key);
                                        $sum_deposit         = $sum_deposit + $Bankreport->deposit($key);
                                        $sum_withdrawal      = $sum_withdrawal + $Bankreport->withdraw($key);
                                        $sum_balance         = $sum_balance + ($Bankreport->deposit($key)- $Bankreport->withdraw($key));
                                    @endphp
                                    @endforeach
                                    
                                    @if($sum_balance > 0)
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-right">Total</td>
                                            <td class="uk-text-right">
                                                {{ $sum_opening_balance }}
                                            </td>
                                            <td class="uk-text-right">
                                                {{ $sum_deposit }}
                                            </td>
                                            <td class="uk-text-right">
                                                {{ $sum_withdrawal }}
                                            </td>
                                            <td class="uk-text-right">
                                                {{ $sum_balance }}
                                            </td>
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
    $('#sidebar_main_account').addClass('current_section');
    $('#sidebar_bank_report').addClass('act_item');
    $(window).load(function(){
        $("#tiktok_account").trigger('click');
    })
</script>
@endsection
