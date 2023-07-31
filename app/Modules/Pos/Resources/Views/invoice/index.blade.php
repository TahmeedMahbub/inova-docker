@extends('layouts.main')

@section('title', 'Invoice')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        .uk-form-select{
            color:rgba(0, 0, 0, 0.8) !important;
        }
        .styled-select select {
            background: transparent;
            border: none;
            font-size: 18px;
            height: 29px;
            padding: 5px; /* If you add too much padding here, the options won't show in IE */
            width: 90%;

        }

        .styled-select.slate {
            {{--background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;--}}
            height: 34px;
            width: 240px;
            z-index: 10;
        }

        .styled-select.slate select {

            border-bottom: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 268px;
        }
        .styled-select.slate option{
            font-size: 16pt;

        }
        .slate   { background-color: #ddd; }
        .slate select   { color: #000; }
        @media screen and (-webkit-min-device-pixel-ratio:0)
        {
            .styled-select.slate {
                background: url('{{ asset('admin/assets/icons/arrow_down.jpg') }}') no-repeat right center;

            }
        }
    </style>
@endsection

@section('content')

    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('receive_invoice_payment'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_content" style="padding: 7px 10px;">
                                <div class="">
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-3-6">
                                            <select class="md-input select2-single-search-dropdown" onchange="invoiceSelected()" 
                                                    title="Select Due Invoice" id="due_invoice_id" name="due_invoice_id" required>
                                                <option value="">Select Due Invoice</option>
                                                @if(isset($due_invoices))
                                                    @foreach($due_invoices as $due_invoice)
                                                        <option value="{{ $due_invoice->id }}">{{ $due_invoice->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="uk-width-medium-1-6">
                                            <label for="total_invoice_amount">Total Invoice Amount</label>
                                            <input class="md-input" type="text" id="total_invoice_amount" name="total_invoice_amount" value="0" readonly>
                                        </div>
                                        <div class="uk-width-medium-1-6">
                                            <label for="due_amount">Due Amount</label>
                                            <input class="md-input" type="text" id="due_amount" name="due_amount" value="0" readonly>
                                        </div>
                                        <div class="uk-width-medium-1-6">
                                            <label for="customer_credit">Customer Credit</label>
                                            <input class="md-input" type="text" id="customer_credit" name="customer_credit" value="0" readonly>
                                        </div>

                                        <div class="uk-width-medium-1-6">
                                            <label for="payable_amount">Payable Amount</label>
                                            <input class="md-input" type="text" id="payable_amount" name="payable_amount"value="0"  readonly>
                                        </div>
                                        <div class="uk-width-medium-1-6">
                                            <label for="paid_amount" style="color: red;">Paid</label>
                                            <input class="md-input" type="text" id="paid_amount" name="paid_amount" oninput="checkPaidamount()" required>
                                        </div>
                                        <div class="uk-width-medium-1-6">
                                            <label for="return_amount">Return</label>
                                            <input class="md-input" type="text" id="return_amount" name="return_amount" value="0" readonly>
                                        </div>
                                        <div class="uk-width-medium-2-6" style="margin-top: 7px;">
                                            <select id="account_id_0" class="md-input accountId select2-single-search-dropdown" name="account_id" required>
                                                <option value="" selected>Select Account</option>
                                                @if(!empty($accounts) && (count($accounts) > 0))
                                                    @foreach($accounts as $account_value)
                                                        <option value="{{ $account_value->id }}" {{$account_value->id==3 ? 'selected':''}}>
                                                            {{ $account_value->account_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="uk-width-medium-1-6 uk-float-left" style="margin-top: 7px;">
                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="Submit" name="submit" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>



    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="md-card-toolbar" style="">
                            <div class="md-card-toolbar-actions hidden-print">

                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> 
                                    <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}">
                                        <i class="material-icons">&#xE8B8;</i><span>Custom Setting</span>
                                    </a>
                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => 'get-pos', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range {{ session('branch_id')==1?"and Branch":'' }}   <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            @if(session('branch_id')==1)
                                                <div class="uk-width-medium-2-2">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-building"></i></span>

                                                        <select style="width: 90%" class="styled-select slate"  id="report_account_id" name="branch_id" >
                                                            @if(isset($branch_id))
                                                                @foreach($branchs as $branch)
                                                                    <option {{ ($branch_id==$branch->id)?"selected":'' }} value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach($branchs as $branch)
                                                                    <option  value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                    </div>
                                                    <br/>
                                                </div>
                                            @endif
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">From</label>
                                                    <input value="{{ isset($from_date)?$from_date:date('Y-m-d') }}" required class="md-input" type="text"  name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input value="{{ isset($to_date)?$to_date:date('Y-m-d') }}" required class="md-input" type="text"  name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
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
                        
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Invoice List</span>
                                    <div style="float: right;margin-top:-29px;padding:0px" >
                                        <form action="" method="get">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div  class="uk-width-medium-1-4">
                                                  <input  value="" class="form-control" type="text" placeholder="Invoice No."  name="invoice_no" >
                                                </div>
                                                <div  class="uk-width-medium-1-4">
                                                  <input  value="" class="form-control" type="text" placeholder="Customer Name"  name="customer_name" >
                                                </div>
                                                <div  class="uk-width-medium-1-4">
                                                  <input  value="" class="form-control" type="text" placeholder="Customer Phone"  name="customer_phone" >
                                                </div>
                                                <div  class="uk-width-medium-1-4">
                                                  <button type="submit" class="md-btn md-btn-success md-btn-flat-default" style="margin-left: -20px;"> Submit </button>
                                                </div>
                                            </div>

                                        </form>
                                     </div>
                                 </h2>
                            </div>
                        </div>

                        <?php $helper = new \App\Lib\Helpers; ?>

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th width="7%">SL</th>
                                        <th>Date</th>
                                        <th>Invoice#</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Balance Due</th>
                                        @if(Auth::user()->type == 0)
                                        <th>Created By</th>
                                        @endif
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th width="7%">SL</th>
                                        <th>Date</th>
                                        <th>Invoice#</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Balance Due</th>
                                        @if(Auth::user()->type == 0)
                                        <th>Created By</th>
                                        @endif
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $i = 1;?>
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td width="7%">{{ $i++ }}</td>
                                            <td>{{date('d-m-Y', strtotime($invoice->invoice_date)) }}</td>
                                            <td>INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}
                                                {{ $invoice->tailoring_order_number > 0 ? ', TO-' . $invoice->tailoring_order_number : '' }}
                                            </td>

                                            <td>{{  $invoice->customer['phone_number_1'] . ', ' . $invoice->customer['display_name'] }} </td>
                                            <td

                                                @if($helper->getPaymentStatus($invoice->id) == "Paid")
                                                    style="color:green;"
                                                @endif
                                                @if($helper->getPaymentStatus($invoice->id) == "Partially Paid")
                                                    style="color:blue;"
                                                @endif
                                                @if($helper->getPaymentStatus($invoice->id) == "Full Due")
                                                    style="color:red;"
                                                @endif
                                                @if($helper->getPaymentStatus($invoice->id) == "Draft")
                                                style="color:green;"
                                                @endif

                                            >
                                                {{ $helper->getPaymentStatus($invoice->id) }}
                                            </td>

                                            <td>{{ $invoice->total_amount }} </td>
                                            <td>{{ $invoice->due_amount }} </td>
                                            @if(Auth::user()->type == 0)
                                            <td>{{ $invoice->createdBy->name }}</td>
                                            @endif
                                            <td class="uk-text-center" style="white-space:nowrap !important;">
                                                <a href="{{ route('pos_invoice_show', ['id' => $invoice->id]) }}?auto_print=0"><i data-uk-tooltip="{pos:'top'}" title="View" class="material-icons">visibility</i></a>
                                                {{-- <a href="{{ route('pos_invoice_show_measurements', ['id' => $invoice->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View Measurements" class="material-icons">picture_as_pdf</i></a>
                                                <a href="{{ route('pos_invoice_edit_measurements', ['id' => $invoice->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit Measurements" class="material-icons">straighten</i></a> --}}
                                                <a href="{{ route('pos_invoice_edit', ['id' => $invoice->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="material-icons">&#xE254;</i></a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="invoice_id" value="{{ $invoice->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('pos_invoice_create') }}" class="md-fab md-fab-accent branch-create">
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
        function invoiceSelected(){
            var invoice_id = $('#due_invoice_id option:selected').val();

            $.get('/invoice/receive/payment/details/'+ invoice_id, function(data){
                $("#total_invoice_amount").val(data.total_invoice_amount);
                $("#due_amount").val(data.due_amount);
                $("#customer_credit").val(data.customer_credit);
                $("#payable_amount").val(data.payable_amount);
                $("#return_amount").val(0);
                $('#paid_amount').focus();
            });
        }

        function checkPaidamount(){
            var total_amount = parseFloat($('#payable_amount').val());
            var paid_amount  = parseFloat($('#paid_amount').val());
            
            if(paid_amount > total_amount){
                $('#return_amount').val(paid_amount - total_amount);
            }else{
                $('#return_amount').val(0);
            }
        }

        $('#sidebar_pos').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
        $('.delete_btn').click(function () {
            var id = $(this).next('.invoice_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/invoice/delete/"+id;
            })
        })
    </script>
@endsection
