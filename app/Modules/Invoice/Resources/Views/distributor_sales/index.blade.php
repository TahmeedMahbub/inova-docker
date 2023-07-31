@extends('layouts.main')

@section('title', 'Distributor Sales')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        .uk-form-select {
            color: rgba(0, 0, 0, 0.8) !important;


        }

        .styled-select select {
            background: transparent;
            border: none;
            font-size: 18px;
            height: 29px;
            padding: 5px;
            /* If you add too much padding here, the options won't show in IE */
            width: 90%;
        }

        .styled-select.slate {
            {{-- background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center; --}} height: 34px;
            width: 240px;
            z-index: 10;
        }

        .styled-select.slate select {

            border-bottom: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 268px;
        }

        .styled-select.slate option {
            font-size: 16pt;

        }

        .slate {
            background-color: #ddd;
        }

        .slate select {
            color: #000;
        }

        span.select2-container {
            z-index: 1500 !important;
        }

        @media screen and (-webkit-min-device-pixel-ratio:0) {
            .styled-select.slate {
                background: url({{ asset('admin/assets/icons/arrow_down.jpg') }});

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
                        <div class="md-card-toolbar" style="">
                            <div class="md-card-toolbar-actions hidden-print">

                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true"
                                    aria-expanded="true"> <a href="#"
                                        data-uk-modal="{target:'#coustom_setting_modal'}"><i
                                            class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open([
                                            'url' => route('distributor_sales_search'),
                                            'method' => 'post',
                                            'class' => 'user_edit_form',
                                            'id' => 'user_profile',
                                        ]) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range
                                                {{ session('branch_id') == 1 ? 'and Branch' : '' }} <i
                                                    class="material-icons" data-uk-tooltip="{pos:'top'}"
                                                    title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            @if (session('branch_id') == 1)
                                                <div class="uk-width-medium-2-2">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon"><i
                                                                class="uk-input-group-icon uk-icon-building"></i></span>

                                                        <select style="width: 90%" class="styled-select slate"
                                                            id="report_account_id" name="branch_id">

                                                            @if (isset($branch_id))
                                                                @foreach ($branches as $branch)
                                                                    <option
                                                                        {{ $branch_id == $branch->id ? 'selected' : '' }}
                                                                        value="{{ $branch->id }}">
                                                                        {{ $branch->branch_name }}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach ($branches as $branch)
                                                                    <option value="{{ $branch->id }}">
                                                                        {{ $branch->branch_name }}</option>
                                                                @endforeach

                                                            @endif
                                                        </select>

                                                    </div>
                                                    <br />
                                                </div>
                                            @endif
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                            class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">From</label>
                                                    <input value="{{ isset($from_date) ? $from_date : date('Y-m-d') }}"
                                                        required class="md-input" type="text" name="from_date"
                                                        data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                            class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input value="{{ isset($to_date) ? $to_date : date('Y-m-d') }}" required
                                                        class="md-input" type="text" name="to_date"
                                                        data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2 uk-margin-small-top">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                            class="uk-input-group-icon uk-icon-tag"></i></span>
                                                    <div class="uk-grid">
                                                        <div class="uk-width-1-2">
                                                            <label for="sales_amount">Sales Amount from</label>
                                                            <input
                                                                value="{{ isset($sales_amount_from) ? $sales_amount_from : '' }}"
                                                                class="md-input" type="text" id="sales_amount"
                                                                name="sales_amount_from">
                                                        </div>
                                                        <div class="uk-width-1-2">
                                                            <label for="sales_amount_to">Sales Amount To</label>
                                                            <input
                                                                value="{{ isset($sales_amount_to) ? $sales_amount_to : '' }}"
                                                                class="md-input" type="text" id="sales_amount_to"
                                                                name="sales_amount_to">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2 uk-margin-small-top">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                            class="uk-input-group-icon uk-icon-user"></i></span>
                                                    <select data-uk-tooltip="{pos:'top'}"
                                                        class="md-input select2-single-search-dropdown" name="customer_id">
                                                        <option value="">Select Distributor</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}"
                                                                {{ isset($selected_customer_id) && $customer->id == $selected_customer_id ? 'selected' : '' }}>
                                                                {{ $customer->display_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="uk-width-large-2-2 uk-width-2-2 uk-margin-small-top">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                            class="uk-input-group-icon uk-icon-list"></i></span>
                                                    <select data-uk-tooltip="{pos:'top'}"
                                                        class="md-input select2-single-search-dropdown" name="item_id">
                                                        <option value="">Select Items</option>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ isset($selected_item_id) && $item->id == $selected_item_id ? 'selected' : '' }}>
                                                                {{ $item->item_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}

                                        </div>
                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                            <button type="submit" name="submit"
                                                class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <!--end  -->
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                        </div>

                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Distributor Sale List</span>
                                    <div style="float: right;margin-top:-29px;padding:0px">
                                        <form action="{{ route('distributor_sales') }}" method="get">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <input value="" required class="form-control" type="text"
                                                        placeholder="Invoice No." name="invoice_no">
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <button type="submit"
                                                        class="md-btn md-btn-success md-btn-flat-default"
                                                        style="margin-left: -20px;"> Submit </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </h2>
                            </div>
                        </div>

                        <?php
                        $helper = new \App\Lib\Helpers();
                        ?>

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table">
                                    <thead>
                                        <tr>
                                            <th width="7%">SL</th>
                                            <th>Date</th>
                                            <th>Invoice#</th>
                                            <th>Distributor Name</th>
                                            <th>Retailer Name</th>
                                            @if (Auth::user()->branch_id == 1)
                                                <th>Branch Name</th>
                                            @endif
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th width="7%">SL</th>
                                            <th>Date</th>
                                            <th>Invoice#</th>
                                            <th>Distributor Name</th>
                                            <th>Retailer Name</th>
                                            @if (Auth::user()->branch_id == 1)
                                                <th>Branch Name</th>
                                            @endif
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td width="7%">{{ $i++ }}</td>
                                                <td>{{ date('d-m-Y', strtotime($invoice->sales_date)) }}</td>
                                                <td>INV-{{ str_pad($invoice->sales_number, 6, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $invoice->seller['display_name'] }} </td>
                                                <td>{{ $invoice->customer['display_name'] }} </td>
                                                @if (Auth::user()->branch_id == 1)
                                                    <td>{{ $invoice->createdBy->branch->branch_name }}</td>
                                                @endif
                                                <td class="uk-text-center" style="white-space:nowrap !important;">
                                                    <a href="{{ route('invoice_show', ['id' => $invoice->id]) }}"><i
                                                            data-uk-tooltip="{pos:'top'}" title="View"
                                                            class="material-icons">visibility</i></a>
                                                    <a
                                                        href="{{ route('distributor_sales_edit', ['id' => $invoice->id]) }}"><i
                                                            data-uk-tooltip="{pos:'top'}" title="Edit"
                                                            class="material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete"
                                                            class="material-icons">&#xE872;</i></a>
                                                    <input type="hidden" class="invoice_id"
                                                        value="{{ $invoice->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('distributor_sales_create') }}"
                                    class="md-fab md-fab-accent branch-create">
                                    <i class="material-icons">&#xE145;</i>
                                </a>
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
        $('#sidebar_distributor_sales').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');

        })
        $('.delete_btn').click(function() {
            var id = $(this).next('.invoice_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                window.location.href = "/invoice/distributor-sales/delete/" + id;
            })
        })
    </script>
@endsection
