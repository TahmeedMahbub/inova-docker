@extends('layouts.admin')

@section('title', 'Item Details Report '.date("Y-m-d h-i-sa"))

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
            content: "" !important;

        }

        a {
            text-decoration: none;
        }


        .uk-table tr td {

            padding: 1px 2px;
            border: none !important;
            width: 100%;
            font-size: 11px !important;
        }

        .uk-table tr th:last-child,
        .uk-table tr td:last-child {}

        .uk-table tr th:first-child,
        .uk-table tr td:first-child {
            white-space: nowrap;
        }

        .uk-table tr th {

            padding: 1px 2px;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width: 100%;
            font-size: 11px !important;
        }

        body {
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
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-large-10-10">

            <div class="md-card md-card-single hidden-print">
                <div id="invoice_preview hidden-print">
                    <div class="md-card-content invoice_content print_bg" style="height: 100%;">
                        {!! Form::open(['url' => route('report_account_item_filter'), 'method' => 'get', 'class' =>
                        'user_edit_form', 'id' => 'my_profile', 'novalidate']) !!}
                        <div class="uk-grid hidden-print" data-uk-grid-margin="">
                            <div class="uk-width-medium-1-5">
                                <div class="md-input-wrapper md-input-filled">
                                    <label for="branch_id">Branch</label>
                                    <select name="branch_id" id="branch_id" class="md-input selectable">
                                        <option selected disabled value="">Select Branch</option>
                                        @foreach($branches as $key => $value)
                                        <option value="{{ $value->id }}" @if(isset($branch) && $branch->id ==
                                            $value->id) selected @endif>{{ $value->branch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <label for="start">From</label>
                                <input class="md-input" type="text" id="start" name="start"
                                    value="{{ date('d-m-Y', strtotime($start)) }}"
                                    data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <label for="end">To</label>
                                <input class="md-input" type="text" id="end" name="end"
                                    value="{{ date('d-m-Y', strtotime($end)) }}"
                                    data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <div class="md-input-wrapper md-input-filled">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="md-input selectable">
                                        <option selected value="0">All</option>
                                        @foreach($categories as $key => $value)
                                        <option value="{{ $value->id }}" @if(isset($category) && $category->id ==
                                            $value->id) selected @endif>{{ $value->item_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <div class="md-input-wrapper md-input-filled">
                                    <label for="item_id">Product</label>
                                    <select name="item_id" id="item_id"
                                        class="md-input selectable select2-single-search-dropdown">
                                        <option selected value="0">All</option>
                                        @foreach($items as $key => $value)
                                        <option value="{{ $value->id }}" @if(isset($item) && $item->id == $value->id)
                                            selected @endif>{{ $value->barcode_no . ', ' .
                                            $value->item_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-5">
                                <button type="submit" class="md-btn md-btn-primary">Filter</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                </div>
            </div>

            @if (isset($item))

            <div class="md-card md-card-single main-print" style="padding: 15px">
                <div class="md-card-toolbar-actions hidden-print" style="width: 100%">
                    <i class="md-icon material-icons" id="invoice_print"></i>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-small-5-5 uk-text-center">
                        <img style="margin-bottom: -20px;" class="logo_regular"
                            src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71" />
                        <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{
                            $OrganizationProfile->company_name }}</p>
                        <p style="line-height: 5px;" class="heading_b">{{$item->item_name}} Report</p>
                        <p style="line-height: 5px;" class="uk-text-small">Code: {{ $item->barcode_no }}</p>
                        <p style="line-height: 5px;" class="uk-text-small">From {{ date('d-m-Y', strtotime($start)) }}
                            To {{ date('d-m-Y', strtotime($end)) }}</p>
                    </div>
                </div>
                <div class="uk-grid ">

                    <div class="uk-width-1-2">
                        <table class="uk-table">

                            <thead>
                                <tr class="uk-text-upper">
                                    <th class="uk-text-center" colspan="6"><b>Purchase</b></th>
                                </tr>
                                <tr class="uk-text-upper">
                                    <th>Date</th>
                                    <th class="uk-text-left">Transaction</th>
                                    <th class="uk-text-left">Name</th>
                                    <th class="uk-text-right">Rate</th>
                                    <th class="uk-text-right">Quantity</th>
                                    <th class="uk-text-right">Purchase Amount</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $total_qty = 0; $total_amount = 0; ?>

                                @foreach($bills as $bill_tmp)

                                <tr class="uk-table-middle">
                                    <td>{{ date('d-m-Y', strtotime($bill_tmp->date)) }}</td>
                                    <td class="uk-text-left">BILL-{{ $bill_tmp->transaction }}</td>
                                    <td class="uk-text-left">{{ $bill_tmp->customer->display_name }}</td>
                                    <td class="uk-text-right">{{ $bill_tmp->amount/$bill_tmp->quantity }}</td>
                                    <td class="uk-text-right">{{ $bill_tmp->quantity }}</td>
                                    <td class="uk-text-right">{{ $bill_tmp->amount }}</td>
                                </tr>

                                <?php $total_qty += $bill_tmp->quantity; $total_amount += $bill_tmp->amount; ?>

                                @endforeach

                                <tr class="uk-table-middle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="uk-text-right">Total</td>
                                    <td class="uk-text-right">{{ $total_qty }}</td>
                                    <td class="uk-text-right">{{ $total_amount }}</td>
                                </tr>

                            </tbody>

                        </table>
                    </div>

                    <div class="uk-width-1-2">
                        <table class="uk-table">

                            <thead>
                                <tr class="uk-text-upper">
                                    <th class="uk-text-center" colspan="6"><b>Sales</b></th>
                                </tr>
                                <tr class="uk-text-upper">
                                    <th>Date</th>
                                    <th class="uk-text-left">Transaction</th>
                                    <th class="uk-text-left">Name</th>
                                    <th class="uk-text-right">Rate</th>
                                    <th class="uk-text-right">Quantity</th>
                                    <th class="uk-text-right">Sales Amount</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $total_qty = 0; $total_amount = 0; ?>

                                @foreach($invoices as $invoice_tmp)

                                <tr class="uk-table-middle">
                                    <td>{{ date('d-m-Y', strtotime($invoice_tmp->date)) }}</td>
                                    <td class="uk-text-left">INV-{{ $invoice_tmp->transaction }}</td>
                                    <td class="uk-text-left">{{ $invoice_tmp->customer->display_name }}</td>
                                    <td class="uk-text-right">{{ $invoice_tmp->amount/$invoice_tmp->quantity }}</td>
                                    <td class="uk-text-right">{{ $invoice_tmp->quantity }}</td>
                                    <td class="uk-text-right">{{ $invoice_tmp->amount }}</td>
                                </tr>

                                <?php $total_qty += $invoice_tmp->quantity; $total_amount += $invoice_tmp->amount; ?>

                                @endforeach

                                <tr class="uk-table-middle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="uk-text-right">Total</td>
                                    <td class="uk-text-right">{{ $total_qty }}</td>
                                    <td class="uk-text-right">{{ $total_amount }}</td>
                                </tr>

                            </tbody>

                        </table>
                    </div>

                    <div class="uk-width-1-2">
                        <table class="uk-table">

                            <thead>
                                <tr class="uk-text-upper">
                                    <th class="uk-text-center" colspan="6"><b>Purchase Return</b></th>
                                </tr>
                                <tr class="uk-text-upper">
                                    <th>Date</th>
                                    <th class="uk-text-left">Transaction</th>
                                    <th class="uk-text-left">Name</th>
                                    <th class="uk-text-right">Rate</th>
                                    <th class="uk-text-right">Quantity</th>
                                    <th class="uk-text-right">Return Amount</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $total_qty = 0; $total_amount = 0; ?>

                                @foreach($vendor_credits as $vendor_tmp)

                                <tr class="uk-table-middle">
                                    <td>{{ date('d-m-Y', strtotime($vendor_tmp->date)) }}</td>
                                    <td class="uk-text-left">VCRDT-{{ $vendor_tmp->transaction }}</td>
                                    <td class="uk-text-left">{{ $vendor_tmp->vendor->display_name }}</td>
                                    <td class="uk-text-right">{{ $vendor_tmp->amount/$vendor_tmp->quantity }}</td>
                                    <td class="uk-text-right">{{ $vendor_tmp->quantity }}</td>
                                    <td class="uk-text-right">{{ $vendor_tmp->amount }}</td>
                                </tr>

                                <?php $total_qty += $vendor_tmp->quantity; $total_amount += $vendor_tmp->amount; ?>

                                @endforeach

                                <tr class="uk-table-middle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="uk-text-right">Total</td>
                                    <td class="uk-text-right">{{ $total_qty }}</td>
                                    <td class="uk-text-right">{{ $total_amount }}</td>
                                </tr>

                            </tbody>

                        </table>
                    </div>

                    <div class="uk-width-1-2">
                        <table class="uk-table">

                            <thead>
                                <tr class="uk-text-upper">
                                    <th class="uk-text-center" colspan="6"><b>Sales Return</b></th>
                                </tr>
                                <tr class="uk-text-upper">
                                    <th>Date</th>
                                    <th class="uk-text-left">Transaction</th>
                                    <th class="uk-text-left">Name</th>
                                    <th class="uk-text-right">Rate</th>
                                    <th class="uk-text-right">Quantity</th>
                                    <th class="uk-text-right">Return Amount</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $total_qty = 0; $total_amount = 0; ?>

                                @foreach($credit_notes as $credit_tmp)

                                <tr class="uk-table-middle">
                                    <td>{{ date('d-m-Y', strtotime($credit_tmp->date)) }}</td>
                                    <td class="uk-text-left">CN-{{ $credit_tmp->transaction }}</td>
                                    <td class="uk-text-left">{{ $credit_tmp->customer->display_name }}</td>
                                    <td class="uk-text-right">{{ $credit_tmp->amount/$credit_tmp->quantity }}</td>
                                    <td class="uk-text-right">{{ $credit_tmp->quantity }}</td>
                                    <td class="uk-text-right">{{ $credit_tmp->amount }}</td>
                                </tr>

                                <?php $total_qty += $credit_tmp->quantity; $total_amount += $credit_tmp->amount; ?>

                                @endforeach

                                <tr class="uk-table-middle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="uk-text-right">Total</td>
                                    <td class="uk-text-right">{{ $total_qty }}</td>
                                    <td class="uk-text-right">{{ $total_amount }}</td>
                                </tr>

                            </tbody>

                        </table>
                    </div>

                    <div class="uk-width-1-2" style="padding-top: 15px">
                        <table class="uk-table">

                            <thead>
                                <tr class="uk-text-upper">
                                    <th class="uk-text-center" colspan="6"><b>Stock Transferred To</b></th>
                                </tr>
                                <tr class="uk-text-upper">
                                    <th>Date</th>
                                    <th class="uk-text-right">From</th>
                                    <th class="uk-text-right">To</th>
                                    <th class="uk-text-right">Quantity</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $total_st = 0; ?>

                                @foreach($stock_transferred_to as $value)

                                <tr class="uk-table-middle">
                                    <td>{{ date('d-m-Y', strtotime($credit_tmp->date)) }}</td>
                                    <td class="uk-text-right">{{ $value->transferFrom->branch_name }}</td>
                                    <td class="uk-text-right">{{ $value->transferTo->branch_name }}</td>
                                    <td class="uk-text-right">{{ $value->quantity }}</td>
                                </tr>

                                <?php $total_st += $value->quantity; ?>

                                @endforeach

                                <tr class="uk-table-middle">
                                    <td></td>
                                    <td></td>
                                    <td class="uk-text-right">Total</td>
                                    <td class="uk-text-right">{{ $total_st }}</td>
                                </tr>

                            </tbody>

                        </table>
                    </div>

                    <div class="uk-width-1-2" style="padding-top: 15px">
                        <table class="uk-table">
                    
                            <thead>
                                <tr class="uk-text-upper">
                                    <th class="uk-text-center" colspan="6"><b>Stock Transferred From</b></th>
                                </tr>
                                <tr class="uk-text-upper">
                                    <th>Date</th>
                                    <th class="uk-text-right">From</th>
                                    <th class="uk-text-right">To</th>
                                    <th class="uk-text-right">Quantity</th>
                                </tr>
                            </thead>
                    
                            <tbody>
                    
                                <?php $total_st = 0; ?>
                    
                                @foreach($stock_transferred_from as $value)
                    
                                <tr class="uk-table-middle">
                                    <td>{{ date('d-m-Y', strtotime($credit_tmp->date)) }}</td>
                                    <td class="uk-text-right">{{ $value->transferFrom->branch_name }}</td>
                                    <td class="uk-text-right">{{ $value->transferTo->branch_name }}</td>
                                    <td class="uk-text-right">{{ $value->quantity }}</td>
                                </tr>
                    
                                <?php $total_st += $value->quantity; ?>
                    
                                @endforeach
                    
                                <tr class="uk-table-middle">
                                    <td></td>
                                    <td></td>
                                    <td class="uk-text-right">Total</td>
                                    <td class="uk-text-right">{{ $total_st }}</td>
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

            @endif

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

    $('#category_id').on('change', function() {
        var category_id = $(this).val();
        @foreach($categories as $category)
        if (category_id == {{ $category->id }}) {
            @php $cat_items = $items->where('item_category_id', $category->id); @endphp
            $('#item_id').empty();
            $('#item_id').append('<option selected value="0">All</option>');
            @foreach($cat_items as $key => $value)
            $('#item_id').append('<option value="{{ $value->id }}" @if(isset($item) && $item->id == $value->id) selected @endif>{{ str_pad($value->id, 6, "0", STR_PAD_LEFT) . ', ' . $value->item_name }}</option>');
            @endforeach
        }
        @endforeach
    });
</script>
@endsection