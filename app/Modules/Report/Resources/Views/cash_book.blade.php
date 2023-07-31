@extends('layouts.admin')

@section('title', 'Cash Book ' . date('Y-m-d h-i-sa'))

@section('header')
    @include('inc.header')
@endsection

@section('styles')
    <style>
        #list_table_right tr td:nth-child(1) {

            white-space: nowrap;
        }

        #list_table_left,
        #list_table_right {
            width: 100%;
            padding-top: 0px;

        }

        #list_table_left tr td,
        #list_table_right tr td {
            text-align: center;
            padding-left: 3px;
            padding-right: 3px;
        }

        #list_table_left tr th,
        #list_table_right tr th {
            border-bottom: 1px solid black;
            border-top: 1px solid black;
            font-size: 10px;
        }

        #list_table_left tr td:nth-child(1),
        #list_table_left tr td:last-child,
        #list_table_left tr th:last-child,
        #list_table_right tr td:last-child {

            white-space: nowrap;
        }
            
        .black-hr{
            margin-top: 3px;
            margin-bottom: 3px;
            border-top: 1px solid #000;
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
                            <li><a href="{{ route('report_account_profit_loss') }}">Profit and Loss</a></li>
                            <li><a href="{{ route('report_account_cash_flow_statement') }}">Cash Flow Statement</a></li>
                            <li><a href="{{ route('report_account_balance_sheet') }}">Balance Sheet</a></li>
                            <li>Accountant</li>
                            <li><a href="{{ route('report_account_transactions') }}">Account Transactions</a></li>
                            <li><a href="{{ route('report_account_general_ledger_search') }}">General Ledger</a></li>
                            <li><a href="{{ route('report_account_journal_search') }}">Journal Report</a></li>
                            <li><a href="{{ route('report_account_trial_balance_search') }}">Trial Balance</a></li>
                            <li>Sales</li>
                            <li><a href="{{ route('report_account_customer') }}">Sales by Customer</a></li>
                            <li><a href="">Sales by Item</a></li>
                            <li><a href="{{ route('report_account_item') }}">Product Report</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse">
            <div class="uk-width-large-10-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview hidden-print">
                        <div class="md-card-toolbar hidden-print">
                            <div class="md-card-toolbar-actions hidden-print">
                                <i class="md-icon material-icons" id="invoice_print"></i>


                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true"
                                    aria-expanded="true"><a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i
                                            class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => 'report/cashbook', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range and Transaction Type <i
                                                    class="material-icons" data-uk-tooltip="{pos:'top'}"
                                                    title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">

                                            @if (Auth::user()->branch_id == 1)
                                                <div class="uk-width-large-2-2 uk-width-2-2">
                                                    <div class="uk-input-group">
                                                        <label for="branch_id" style="margin-left: 10px;">Branch</label>
                                                        <select
                                                            style="padding: 5px; border-top:none; border-left:none; border-right:none; border-bottom:1px solid lightgray"
                                                            id="branch_id" name="branch_id">
                                                            <!-- <option value="">Account</option> -->
                                                            @foreach ($branch as $branch_data)
                                                                <option style="z-index: 10002"
                                                                    value="{{ $branch_data->id }}">
                                                                    {{ $branch_data->branch_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                            class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">From</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="from_date" value="{{date("d.m.Y", strtotime($from_date))}}"
                                                        data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                            class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input class="md-input" type="text" id="uk_dp_1" name="to_date" value="{{date("d.m.Y", strtotime($to_date))}}"
                                                        data-uk-datepicker="{format:'DD.MM.YYYY'}">
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
                                <!--end  -->
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 100%;">

                            <div class="uk-grid" data-uk-grid-margin="">

                                <div class="uk-width-small-5-5 uk-text-center">
                                    <img style="margin-bottom: -20px;" class="logo_regular"
                                        src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71" />
                                    <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">
                                        {{ $OrganizationProfile->company_name }}</p>
                                    <p style="line-height: 5px;" class="heading_b">Cash Book</p>
                                    <p style="line-height: 5px;" class="uk-text-large"> {{ $branch_name->branch_name }}
                                    </p>
                                    <p style="line-height: 5px;" class="uk-text-small">From {{date("d-m-Y", strtotime($from_date))}} To
                                        {{date("d-m-Y", strtotime($to_date))}}</p>
                                </div>
                            </div>


                            <div class="uk-grid">

                                <div class="uk-width-1-1"> 
                                    <br>
                                        <strong> &emsp; Opening Balance  </strong>
                                </div>

                                <div class="uk-width-1-1"> 
                                    <table id="list_table_left">                    
                                        <thead>
                                            <tr>
                                                <th style="font-size: 12px; width: 80%;" class="uk-text-left"><u>Account Name</u></th>
                                                <th style="font-size: 12px; width: 10%;" class="uk-text-right"><u>Cash</u></th>
                                                <th style="font-size: 12px; width: 10%;" class="uk-text-right"><u>Bank</u></th>
                                            </tr>
                                        <thead>
                                        <tbody>
                                            @php
                                                $cash_total = 0;
                                                $bank_total = 0;
                                                $cash_receipt_total = 0;
                                                $bank_receipt_total = 0;
                                                $cash_payment_total = 0;
                                                $bank_payment_total = 0;
                                            @endphp
                                            @foreach ($opening_balances as $opening_balance)
                                                <tr>
                                                    <td class="uk-text-left">{{ $opening_balance->account_name }}</td>
                                                    <td class="uk-text-right">{{ $opening_balance->account_name_id == 3 ? number_format($opening_balance->balance, 2, '.', ',') : "0.00" }}</td>
                                                    <td class="uk-text-right">{{ $opening_balance->account_name_id != 3 ? number_format($opening_balance->balance, 2, '.', ',') : "0.00" }}</td>
                                                </tr>
                                                @php
                                                    $cash_total += $opening_balance->account_name_id == 3 ? $opening_balance->balance : 0;
                                                    $bank_total += $opening_balance->account_name_id != 3 ? $opening_balance->balance : 0;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="font-size: 15px" class="uk-text-left"><strong>Total:</strong></th>
                                                <th style="font-size: 15px" class="uk-text-right"><strong>{{number_format($cash_total, 2, '.', ',')}}</strong></th>
                                                <th style="font-size: 15px" class="uk-text-right"><strong>{{number_format($bank_total, 2, '.', ',')}}</strong></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                

                                <div class="uk-width-1-1"> 
                                    <br>
                                        <strong> &emsp; Receipts  </strong>
                                        <hr class="black-hr">
                                </div>
                                
                                <div class="uk-width-1-1"> 
                                    <table id="list_table_left">
                                        @foreach ($receipt_logs as $receipt_log)
                                            <tr>
                                                <td style="width: 15%; vertical-align: top;" class="uk-text-left">
                                                    {{ date("d-m-Y", strtotime($receipt_log->assign_date)) }}
                                                </td>

                                                <td style="width: 35%" class="uk-text-left">
                                                    @php
                                                        if($receipt_log->income_id)
                                                        {
                                                            if($receipt_log->account_name_id == 3)
                                                            {
                                                                echo "CR-".date("Y", strtotime($receipt_log->assign_date))."/".str_pad($receipt_log->income_id, 6, 0, STR_PAD_LEFT);
                                                            }
                                                            else 
                                                            {
                                                                echo "BR-".date("Y", strtotime($receipt_log->assign_date))."/".str_pad($receipt_log->income_id, 6, 0, STR_PAD_LEFT);
                                                            }
                                                        }
                                                        else if($receipt_log->payment_receives_id)
                                                        {
                                                            if($receipt_log->account_name_id == 3)
                                                            {
                                                                echo "CR-".date("Y", strtotime($receipt_log->assign_date))."/". $receipt_log->paymentReceive->pr_number;
                                                            }
                                                            else 
                                                            {
                                                                echo "BR-".date("Y", strtotime($receipt_log->assign_date))."/". $receipt_log->paymentReceive->pr_number;
                                                            }
                                                            
                                                        }
                                                        else if($receipt_log->vendor_credit_refunds_id)
                                                        {
                                                            if($receipt_log->account_name_id == 3)
                                                            {
                                                                echo "CR-".date("Y", strtotime($receipt_log->assign_date))."/".str_pad($receipt_log->vendor_credit_refunds_id, 6, 0, STR_PAD_LEFT);
                                                            }
                                                            else 
                                                            {
                                                                echo "BR-".date("Y", strtotime($receipt_log->assign_date))."/".str_pad($receipt_log->vendor_credit_refunds_id, 6, 0, STR_PAD_LEFT);
                                                            }
                                                            
                                                        }
                                                        else if($receipt_log->bank_id)
                                                        {
                                                            echo "CN-".date("Y", strtotime($receipt_log->assign_date))."/".str_pad($receipt_log->bank_id, 6, 0, STR_PAD_LEFT);
                                                        }
                                                        else {
                                                            echo "Not Given!";
                                                        }
                                                    @endphp
                                                    <br>&emsp;&emsp;{{ $receipt_log->contact->display_name }}
                                                    <br>&emsp;&emsp;{{ $receipt_log->updatedBy->branch->branch_name }}
                                                </td>

                                                <td style="width: 30%" class="uk-text-left">
                                                    @php
                                                        if($receipt_log->income_id)
                                                        {
                                                            if($receipt_log->income)
                                                            echo $receipt_log->income->account->account_name;
                                                        }
                                                        else if($receipt_log->payment_receives_id)
                                                        {
                                                            echo !empty($receipt_log->paymentReceive->paymentMode) ? $receipt_log->paymentReceive->paymentMode->mode_name : "N/A";
                                                        }
                                                        else if($receipt_log->vendor_credit_refunds_id)
                                                        {
                                                            echo !empty($receipt_log->vendorCreditRefund->paymentMode) ? $receipt_log->vendorCreditRefund->paymentMode->mode_name : "N/A";
                                                        }
                                                        else if($receipt_log->bank_id)
                                                        {
                                                            // echo "CN-".date("Y", strtotime($receipt_log->assign_date))."/".str_pad($receipt_log->bank_id, 6, 0, STR_PAD_LEFT);
                                                            echo "Cash A/C";
                                                        }
                                                        else {
                                                            echo "N/A";
                                                        }
                                                    @endphp
                                                </td>

                                                <td class="uk-text-right" style="width: 10%">{{ $receipt_log->account_name_id == 3 ? number_format($receipt_log->amount, 2, '.', ',') : "0.00" }}</td>
                                                <td class="uk-text-right" style="width: 10%">{{ $receipt_log->account_name_id != 3 ? number_format($receipt_log->amount, 2, '.', ',') : "0.00" }}</td>
                                                
                                                @php
                                                    $cash_receipt_total += $receipt_log->account_name_id == 3 ? $receipt_log->amount : 0;
                                                    $bank_receipt_total += $receipt_log->account_name_id != 3 ? $receipt_log->amount : 0;
                                                @endphp
                                            </tr>
                                            <tr>
                                                <td class="uk-text-left" colspan="3">&emsp;&emsp;&emsp;
                                                    @php
                                                        if($receipt_log->income_id)
                                                        {
                                                            if($receipt_log->income->reference)
                                                            {
                                                                echo $receipt_log->income->reference;
                                                            }
                                                            else if($receipt_log->income->note)
                                                            {
                                                                echo $receipt_log->income->note;
                                                            }
                                                            else {
                                                                echo "N/A";
                                                            }
                                                        }
                                                        else if($receipt_log->payment_receives_id)
                                                        {
                                                            if($receipt_log->paymentReceive->reference)
                                                            {
                                                                echo $receipt_log->paymentReceive->reference;
                                                            }
                                                            else if($receipt_log->paymentReceive->note)
                                                            {
                                                                echo $receipt_log->paymentReceive->note;
                                                            }
                                                            else {
                                                                echo "N/A";
                                                            }
                                                        }
                                                        else if($receipt_log->vendor_credit_refunds_id)
                                                        {
                                                            if($receipt_log->vendorCreditRefund->reference)
                                                            {
                                                                echo $receipt_log->vendorCreditRefund->reference;
                                                            }
                                                            else {
                                                                echo "N/A";
                                                            }
                                                        }                                                        
                                                        else if($receipt_log->bank_id)
                                                        {
                                                            echo $receipt_log->bank->notes;
                                                        }
                                                        else {
                                                            echo "N/A";
                                                        }
                                                    @endphp
                                                    @php echo $loop->iteration != $loop->count ? '<hr class="black-hr">' : '' @endphp
                                                </td>
                                                <td colspan="2">
                                                </td>
                                            </tr>                                            
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th style="font-size: 15px" class="uk-text-left" colspan="3"><strong>Total:</strong></th>
                                                <th style="font-size: 15px" class="uk-text-right"><strong>{{number_format($cash_receipt_total, 2, '.', ',')}}</strong></th>
                                                <th style="font-size: 15px" class="uk-text-right"><strong>{{number_format($bank_receipt_total, 2, '.', ',')}}</strong></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                

                                <div class="uk-width-1-1"> 
                                    <br>
                                        <strong> &emsp; Payment  </strong>
                                        <hr class="black-hr">
                                </div>
                                
                                <div class="uk-width-1-1"> 
                                    <table id="list_table_left">@foreach ($payment_logs as $payment_log)
                                        <tr>
                                            <td style="width: 15%; vertical-align: top;" class="uk-text-left">
                                                {{ date("d-m-Y", strtotime($payment_log->assign_date)) }}
                                            </td>

                                            <td style="width: 35%" class="uk-text-left">
                                                @php
                                                    if($payment_log->expense_id)
                                                    {
                                                        if($payment_log->account_name_id == 3)
                                                        {
                                                            echo "CP-".date("Y", strtotime($payment_log->assign_date))."/".str_pad($payment_log->expense_id, 6, 0, STR_PAD_LEFT);                                                            
                                                        }
                                                        else 
                                                        {
                                                            echo "BP-".date("Y", strtotime($payment_log->assign_date))."/".str_pad($payment_log->expense_id, 6, 0, STR_PAD_LEFT);                                                            
                                                        }
                                                    }
                                                    else if($payment_log->payment_made_id)
                                                    {
                                                        if($payment_log->account_name_id == 3)
                                                        {
                                                            echo "CP-".date("Y", strtotime($payment_log->assign_date))."/". $payment_log->paymentMade->pm_number;                                                            
                                                        }
                                                        else 
                                                        {
                                                            echo "BP-".date("Y", strtotime($payment_log->assign_date))."/". $payment_log->paymentMade->pm_number;                                                            
                                                        }
                                                    }
                                                    else if($payment_log->credit_note_refunds_id)
                                                    {
                                                        if($payment_log->account_name_id == 3)
                                                        {
                                                            echo "CP-".date("Y", strtotime($payment_log->assign_date))."/".str_pad($payment_log->credit_note_refunds_id, 6, 0, STR_PAD_LEFT);                                                            
                                                        }
                                                        else 
                                                        {
                                                            echo "BP-".date("Y", strtotime($payment_log->assign_date))."/".str_pad($payment_log->credit_note_refunds_id, 6, 0, STR_PAD_LEFT);                                                            
                                                        }
                                                    }
                                                    else if($payment_log->bank_id)
                                                    {
                                                        echo "CN-".date("Y", strtotime($payment_log->assign_date))."/".str_pad($payment_log->bank_id, 6, 0, STR_PAD_LEFT);
                                                    }
                                                    else {
                                                        echo "Not Given!";
                                                    }
                                                @endphp
                                                <br>&emsp;&emsp;{{ $payment_log->contact->display_name }}
                                                <br>&emsp;&emsp;{{ $payment_log->updatedBy->branch->branch_name }}
                                            </td>

                                            <td style="width: 30%" class="uk-text-left">
                                                @php
                                                    if($payment_log->expense_id)
                                                    {
                                                        if($payment_log->expense)
                                                        echo $payment_log->expense->account->account_name;
                                                    }
                                                    else if($payment_log->payment_made_id)
                                                    {
                                                        echo !empty($payment_log->paymentMade->paymentMode) ? $payment_log->paymentMade->paymentMode->mode_name : "N/A";
                                                    }
                                                    else if($payment_log->credit_note_refunds_id)
                                                    {
                                                        echo !empty($payment_log->creditNoteRefund->paymentMode) ? $payment_log->creditNoteRefund->paymentMode->mode_name : "N/A";
                                                    }
                                                    else if($payment_log->bank_id)
                                                    {
                                                        // echo "CN-".date("Y", strtotime($receipt_log->assign_date))."/".str_pad($receipt_log->bank_id, 6, 0, STR_PAD_LEFT);
                                                        echo "Bank A/C";
                                                    }
                                                    else {
                                                        echo "N/A";
                                                    }
                                                @endphp
                                            </td>

                                            <td class="uk-text-right" style="width: 10%">{{ $payment_log->account_name_id == 3 ? number_format($payment_log->amount, 2, '.', ',') : "0.00" }}</td>
                                            <td class="uk-text-right" style="width: 10%">{{ $payment_log->account_name_id != 3 ? number_format($payment_log->amount, 2, '.', ',') : "0.00" }}</td>
                                            
                                            @php
                                                $cash_payment_total += $payment_log->account_name_id == 3 ? $payment_log->amount : 0;
                                                $bank_payment_total += $payment_log->account_name_id != 3 ? $payment_log->amount : 0;
                                            @endphp
                                        </tr>
                                        <tr>
                                            <td class="uk-text-left" colspan="3">&emsp;&emsp;&emsp;
                                                @php
                                                    if($payment_log->expense_id)
                                                    {
                                                        if($payment_log->expense->reference)
                                                        {
                                                            echo $payment_log->expense->reference;
                                                        }
                                                        else if($payment_log->expense->note)
                                                        {
                                                            echo $payment_log->expense->note;
                                                        }
                                                        else {
                                                            echo "N/A";
                                                        }
                                                    }
                                                    else if($payment_log->payment_made_id)
                                                    {
                                                        if($payment_log->paymentMade->reference)
                                                        {
                                                            echo $payment_log->paymentMade->reference;
                                                        }
                                                        else if($payment_log->paymentMade->note)
                                                        {
                                                            echo $payment_log->paymentMade->note;
                                                        }
                                                        else {
                                                            echo "N/A";
                                                        }
                                                    }
                                                    else if($payment_log->credit_note_refunds_id)
                                                    {
                                                        if($payment_log->creditNoteRefund->reference)
                                                        {
                                                            echo $payment_log->creditNoteRefund->reference;
                                                        }
                                                        else if($payment_log->creditNoteRefund->note)
                                                        {
                                                            echo $payment_log->creditNoteRefund->note;
                                                        }
                                                        else {
                                                            echo "N/A";
                                                        }
                                                    }
                                                    else if($payment_log->bank_id)
                                                    {
                                                        echo $payment_log->bank->notes;
                                                    }
                                                    else {
                                                        echo "N/A";
                                                    }
                                                @endphp
                                                @php echo $loop->iteration != $loop->count ? '<hr class="black-hr">' : '' @endphp
                                            </td>
                                            
                                            <td colspan="2">
                                            </td>
                                        </tr>                                            
                                    @endforeach
                                        <tfoot>
                                            <tr>
                                                <th style="font-size: 15px" class="uk-text-left" colspan="3"><strong>Total:</strong></th>
                                                <th style="font-size: 15px" class="uk-text-right"><strong>{{number_format($cash_payment_total, 2, '.', ',')}}</strong></th>
                                                <th style="font-size: 15px" class="uk-text-right"><strong>{{number_format($bank_payment_total, 2, '.', ',')}}</strong></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                

                                <div class="uk-width-1-1"> 
                                    <br>
                                        <strong> &emsp; Closing Balance  </strong>
                                </div>

                                <div class="uk-width-1-1"> 
                                    <table id="list_table_left">                    
                                        <thead>
                                            <tr>
                                                <th style="font-size: 12px; width: 80%;" class="uk-text-left"><u>Account Name</u></th>
                                                <th style="font-size: 12px; width: 10%;" class="uk-text-right"><u>Cash</u></th>
                                                <th style="font-size: 12px; width: 10%;" class="uk-text-right"><u>Bank</u></th>
                                            </tr>
                                        <thead>
                                        <tbody>
                                            @php
                                                $cash_total = 0;
                                                $bank_total = 0;
                                                $cash_receipt_total = 0;
                                                $bank_receipt_total = 0;
                                                $cash_payment_total = 0;
                                                $bank_payment_total = 0;
                                            @endphp
                                            @foreach ($closing_balances as $closing_balance)
                                                <tr>
                                                    <td class="uk-text-left">{{ $closing_balance->account_name }}</td>
                                                    <td class="uk-text-right">{{ $closing_balance->account_name_id == 3 ? number_format($closing_balance->balance, 2, '.', ',') : "0.00" }}</td>
                                                    <td class="uk-text-right">{{ $closing_balance->account_name_id != 3 ? number_format($closing_balance->balance, 2, '.', ',') : "0.00" }}</td>
                                                </tr>
                                                @php
                                                    $cash_total += $closing_balance->account_name_id == 3 ? $closing_balance->balance : 0;
                                                    $bank_total += $closing_balance->account_name_id != 3 ? $closing_balance->balance : 0;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="font-size: 15px" class="uk-text-left"><strong>Total:</strong></th>
                                                <th style="font-size: 15px" class="uk-text-right"><strong>{{number_format($cash_total, 2, '.', ',')}}</strong></th>
                                                <th style="font-size: 15px" class="uk-text-right"><strong>{{number_format($bank_total, 2, '.', ',')}}</strong></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>


                            </div>


                            <br><br><br><br>
                            <div class="uk-grid">
                                <div class="uk-width-1-4" style="text-align: center">
                                    <hr class="black-hr">
                                    <p class="uk-text-small uk-margin-bottom">Accounts Signature</p>
                                </div>
                                <div class="uk-width-1-4" style="text-align: center">
                                    <hr class="black-hr">
                                    <p class="uk-text-small uk-margin-bottom">Accounts Signature</p>
                                </div>
                                <div class="uk-width-1-4" style="text-align: center">
                                    <hr class="black-hr">
                                    <p class="uk-text-small uk-margin-bottom">Accounts Signature</p>
                                </div>
                                <div class="uk-width-1-4" style="text-align: center">
                                    <hr class="black-hr">
                                    <p class="uk-text-small uk-margin-bottom">Authorized Signature</p>
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
    <script src="{{ url('admin/bower_components/handlebars/handlebars.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js') }}"></script>

    <!--  invoices functions -->
    <script src="{{ url('admin/assets/js/pages/page_invoices.min.js') }}"></script>
    <script type="text/javascript">
        $("#invoice_print").click(function() {
            $("#list_table_right").removeClass('uk_table');
            $("#list_table_left").removeClass('uk_table');
        });

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_reports').addClass('act_item');
    </script>
@endsection
