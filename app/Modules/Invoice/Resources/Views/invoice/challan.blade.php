@extends('layouts.invoice')

@section('title', 'Challan')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
    <script src="{{url('app/moneyin/invoice/invoice.module.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.useCredit.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.excessPayment.js')}}"></script>
@endsection

@section('styles')
    <style>
        #table_center th,td{
            border-bottom-color: black !important;
        }
        table#info{
            font-size: 12px !important;
            line-height: 2px;
            border: none !important;
            min-width: 200px;
            width: 200px;
            float:right;
        }
        table#info tr td{
            border: none !important;
        }
        table#info tr{
            padding: 0px;
            border: none !important;
        }
        @media print {
            body {

                margin-top: -100px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Challans</li>

                        @foreach($invoices as $invoice_data)
                            <li>
                                <a href="{{ url('/invoice/challan'.'/'.$invoice_data->id) }}" class="md-list-content">
                                    <span class="md-list-heading uk-text-truncate">{{ $invoice_data->customer->display_name }} <span class="uk-text-small uk-text-muted">({{ $invoice_data->created_at->format('d M Y') }})</span></span>
                                    <span class="uk-text-small uk-text-muted">INV-{{ str_pad($invoice_data->invoice_number, 6, '0', STR_PAD_LEFT) }}</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ url('/invoice') }}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>

            <?php $helper = new \App\Lib\Helpers; ?>
            @inject('theader', '\App\Lib\TemplateHeader')

            <div class="uk-width-large-6-10">
                <div class="md-card md-card-single main-print">
                     <div  style="float: left;margin-right: 15px; height: 14px;" class="uk-form-file md-btn md-btn-wave-light">
                                  <a href="{{route('invoice_create')}}">Invoice Create</a>
                    </div>
                    <div id="invoice_preview">
                        <div class="md-card-toolbar" style="border-bottom: 0px solid rgba(0,0,0,.12);">
                            <div class="md-card-toolbar-actions hidden-print">
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown" aria-hidden="true">
                                        <ul class="uk-nav">
                                             <li>
                                                <a href="{{ url('/invoice/show'.'/'.$invoice->id) }}">Invoice</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="">
                           
                            @if($theader->getBanner()->headerType)
                                <div class="" style="text-align: center;">

                                <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else

                            <div class="uk-grid" data-uk-grid-margin style="text-align: center;">
                                <h1 style="width: 100%; text-align: center;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                            </div>

                            <div class="" style="text-align: center;">
                                <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>
                               
                                <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                            </div>
                           @endif
                            
                            <div class="uk-grid" data-uk-grid-margin>
                                
                                <div class="uk-width-5-5">
                                    <div class="uk-grid">
                                        <h2 style="text-align: center; width: 90%;" class="">
                                            <u>
                                            @if($helper->getPaymentStatus($invoice->id) == "Draft")
                                            DRAFT CHALLAN
                                            @else
                                            CHALLAN
                                            @endif
                                            </u>
                                        </h2>
                                    </div>
                                </div>    
                            </div>

                            <input type="hidden" ng-init="invoice_id='asdfg'" value="{{$invoice->id}}" name="invoice_id" ng-model="invoice_id">

                            <div class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">
                                        <span style="font-size:17px;"><b>To:</b></span>
                                        <address>
                                            @if($invoice->customer->first_name || $invoice->customer->last_name)
                                                <p><strong>{{ $invoice->customer->first_name }}</strong></p>
                                                <p><strong>{{ $invoice->customer->last_name }}</strong></p>
                                            @else
                                                <p><strong>{{ $invoice->customer->display_name }}</strong></p>
                                            @endif
                                            <p><strong>{{ $invoice->customer->company_name }}</strong></p>

                                            <p>

                                                @if(!empty($invoice->customer->billing_street))
                                                {{ $invoice->customer->billing_street }},
                                                @endif
                                                @if(!empty($invoice->customer->billing_city))
                                                {{ $invoice->customer->billing_city }},
                                                @endif
                                                @if(!empty($invoice->customer->billing_state))
                                                {{ $invoice->customer->billing_state }},
                                                @endif
                                                @if(!empty($invoice->customer->billing_zip_code))
                                                {{ $invoice->customer->billing_zip_code }},
                                                @endif
                                                {{ $invoice->customer->billing_country }}
                                            </p>
                                            <b>Phone:</b> {{ $invoice->customer->phone_number_1 }}
                                            <!--<p> <b>Delivery address- </b>-->
                                            <!--    @if($invoice->customer->shipping_street)-->
                                            <!--    {{ $invoice->customer->shipping_street }},-->
                                            <!--    @endif-->
                                            <!--    @if($invoice->customer->shipping_city)-->
                                            <!--    {{ $invoice->customer->shipping_city }},-->
                                            <!--    @endif-->
                                            <!--    @if($invoice->customer->shipping_state)-->
                                            <!--    {{ $invoice->customer->shipping_state }},-->
                                            <!--    @endif-->
                                            <!--    @if($invoice->customer->shipping_zip_code)-->
                                            <!--    {{ $invoice->customer->shipping_zip_code }},-->
                                            <!--    @endif-->
                                            <!--    {{ $invoice->customer->shipping_country }}-->
                                            <!--</p>-->
                                        </address>
                                        @if($invoice->reference)
                                            <p>{{ $invoice->reference }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <table id="info" class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td style="font-weight: bold" class="uk-text-right no-border-bottom">Date : </td>
                                            <td class="uk-text-right no-border-bottom"> {{ date('d-m-Y', strtotime($invoice->invoice_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold" class="uk-text-right">Challan No : </td>
                                            <td class="uk-text-right no-border-bottom"> {{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div style="margin-top: 0px" class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
                                <div class="uk-width-1-1">
                                    <table border="1" id="table_center" class="uk-table" style="font-size: 12px;" report_table >
                                        <thead>
                                            <tr class="uk-text-upper">
                                                <th style="uk-text-center border-bottom: none;">SL.</th>
                                                <th style="width: 535px; uk-text-center border-bottom: none; text-align: center;">Item Name</th>
                                                <th style="uk-text-center border-bottom: none;">Quantity</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; $total_quantity = 0; $total_ctn = 0; ?>

                                            @foreach($invoice_entries as $invoice_entry)

                                                @if($invoice_entry->item->item_category_id != 2)
                                                    <tr class="uk-table-middle">
                                                        <td style="uk-text-center">{{ $i++ }}</td>
                                                        <td style="uk-text-left">{{ $invoice_entry->item->item_name }} @if($invoice_entry->description) {!! nl2br($invoice_entry->description) !!} @endif</td>
                                                        
                                                        <?php 
                                                            $total_quantity = $total_quantity+$invoice_entry->quantity;
                                                            $total_ctn += $invoice_entry->carton;
                                                        ?>
                                                        <td class="uk-text-center">{{ $invoice_entry->quantity .' '. $invoice_entry->item['unit_type'] }}</td>
                                                        
                                                    </tr>
                                                @endif

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid" style="margin-top:-30px;">
                                <div class="uk-width-1-2">

                                    <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>

                                </div>
                            </div>
                            <div class="uk-grid" style="margin-top:20px;">
                                <div class="uk-width-1-2" style="text-align: left">
                                    <p class="uk-text-small uk-margin-bottom">Customer Signature</p>
                                </div>
                                <div class="uk-width-1-2" style="text-align: right">
                                    <p class="uk-text-small uk-margin-bottom">Company Representative</p>
                                </div>
                            </div>
                            <div class="uk-grid">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        {{--model--}}
        @include('invoice::invoice.use_credit')
        @include('invoice::invoice.use_excess_payments')

    </div>
@endsection

@section('sweet_alert')
    <script>
        $('.payment_receive_delete_btn').click(function () {
            var id = $(this).next('.payment_receive_entry_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/payment-received/delete-payment-receive-entry/"+id;
            })
        })

        $('.credit_receive_entry_delete_btn').click(function () {
            var id = $(this).next('.credit_receive_entry_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/invoice/delete-credit/"+id;
            })
        })
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_invoice').addClass('act_item');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
    </script>
@endsection
