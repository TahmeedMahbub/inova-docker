@extends('layouts.invoice')

@section('title', 'Invoice')

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
        .boxFont{
            font-size: 13px;
        }

        table#info{
            font-size: 12px !important;
            line-height: 4px;
            margin-left:-8px;
        }
        table#info tr{
            padding: 0px;
        }
        table#info tr td{
            border-bottom: 0px;
        }

        table#table_center tr td{
            border:none;
            font-size:12px !important;
        }
        
        table.bill-summary{
            line-height:10px;
        }
        
        .uk-table thead th {
             border-bottom: 0px;
        }
        
        .uk-table-thead {
             border-bottom: 0px;
        }
        
        .tbl_heading{
            border-bottom: 1px solid #000;
            padding: 3px 0;
        }

        table.main-table thead tr{
            border-top:1px solid #ddd;
            border-bottom:1px solid #ddd;
        }
        
        .uk-table-thead{
            border-top:1px solid #ddd;
            border-bottom:1px solid #ddd;
        }
        
        .footer_info{
            line-height: 3px;
        }
        
        .customer_info{
            line-height:4px;
        }
        
        table.bill-summary{
            margin-top:0px !important;
        }
        .large-line-height{
            line-height: 14px;
        }

        @media print {

            .md-card .md-card-content {
                padding: 0px;
            }
    
            body {
                margin-top: -100px;
            }
            
            .boxFont{
                font-size: 13px;
            }
            
            .customer_info{
                line-height:10px;
                font-size:11px;
            }
            
            .footer_info{
                line-height: 3px;
                font-size:12px;
            }
            
            table.main-table, table.main-table tr th, table.main-table tr td{
                margin:0;
                padding:0;
                font-size:12px;
            }
            
            p.organization_info, p.customer_name{
                font-size:12px;
            }
            
            table.bill-summary{
                margin-top:0px !important;
            }
            
            table#info tr td:first-child{
                width:40%;
            }
            
            .large-line-height{
                line-height: 25px;
            }
            
            /*.list_table_lefts {*/
            /*    margin-left: 50px;*/
            /*}*/
            
            /*.list_table_rights {*/
            /*    margin-right: 50px;*/
            /*}*/
        }
    </style>
@endsection

@section('content')

    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">
                        
                        <li class="uk-text-center">
                            <a class="md-btn md-btn-danger md-btn-medium md-btn-wave-light waves-effect waves-button waves-light uk-margin-top uk-margin-bottom" 
                                href="{{ route('invoice_create') }}">ADD NEW SALES</a>
                        </li>

                        @foreach($invoices as $invoices_tmp)
                            <li>
                                <a href="{{ route('invoice_show',$invoices_tmp->id) }}" class="md-list-content">
                                    <span class="md-list-heading uk-text-truncate">{{ $invoices_tmp->customer['display_name'] }} 
                                    <span class="uk-text-small uk-text-muted">{{ date('d-m-Y', strtotime($invoices_tmp['invoice_date'])) }}</span></span>
                                    <span class="uk-text-small uk-text-muted">SINV-{{ $invoices_tmp['invoice_number'] }}</span>
                                </a>
                            </li>
                        @endforeach
                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" 
                                href="{{ route('invoice') }}">See All</a>
                        </li>
                    </ul>
                </div>
            </div>

            <?php 
                $helper = new \App\Lib\Helpers;
                
                if($invoice->tailoring_order_number > 0){
                    $print_times    = 1;
                    $tailor_invoice = 1;
                }
                else{
                    $print_times    = 1;
                    $tailor_invoice = 0;
                }
            ?>
            
            @inject('theader', '\App\Lib\TemplateHeader')

            <div class="uk-width-large-8-10">
                @include('inc.alert')
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions hidden-print">
                                
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown" aria-hidden="true">
                                        <ul id="nav_in_without_href" class="uk-nav" style="display: {{ $invoice['save']==1?'block':'none' }}">

                                           <li>
                                               <a href="{{ url('/invoice/show'.'/'.$invoice->id) }}">Invoice</a>
                                           </li>

                                           <li>
                                               <a href="{{ url('/invoice/edit'.'/'.$invoice->id) }}">Edit</a>
                                           </li>
                                        </ul>

                                        <ul id="nav_in_with_href" class="uk-nav" style="display: {{ $invoice->save==1?'none':'block' }}" >

                                            <li>
                                                <a href="{{ url('/invoice/show'.'/'.$invoice->id) }}">Invoice</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/invoice/edit'.'/'.$invoice->id) }}">Edit</a>
                                            </li>
                                            <li>
                                                <a data-uk-modal="{target:'#modal_header_footer'}" href="#">Use Credits</a>
                                            </li>

                                            <li>
                                                <a data-uk-modal="{target:'#modal_header_footer1'}" href="#">Use Excess Payment</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">Sales : {{ "INV-".$invoice->invoice_number }}</h3>
                        </div>
                        
                        @for($tmp_print_times = 1; $tmp_print_times <= $print_times; $tmp_print_times++)
                            <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                                
                                @if($tailor_invoice == 1)
                                    <div class="uk-grid" data-uk-grid-margin="">
                                        <div class="uk-width-small-2-5 uk-text-left" style="margin-top: 35px; margin-bottom: 10px;">
                                            <img src="{{ asset('/uploads//op-logo/'.$OrganizationProfile->logo) }}" width="14%" alt="{{ $OrganizationProfile->display_name }}">
                                            <p style="line-height: 17px;margin-bottom:10px; margin-top: 8px; display: inline-block; vertical-align: middle; margin-left: 5px;" 
                                                class="organization_info"><b>
                                                {{ $OrganizationProfile->display_name }}</b>
                                                <br>Address: {{ $OrganizationProfile->street }}, {{ $OrganizationProfile->city }}, {{ $OrganizationProfile->state }}-{{ $OrganizationProfile->zip_code }}
                                                <br>Hotline: {{ $OrganizationProfile->contact_number }}
        
                                                @if($OrganizationProfile->vat_number)
                                                    <br>BIN Number: {{ $OrganizationProfile->vat_number }}
                                                @endif
                                            </p>
                                        </div>
                                        
                                        <input type="hidden" name="invoice_id">
                                        
                                        <div class="uk-width-small-3-5 uk-text-left" style="margin-top: 35px;">
                                            <table id="info" class="uk-table inv_top_right_table">
                                                @php
                                                    $time   = $invoice->created_at->format('d-m-Y').'<br><br><br><br><br>'. $invoice->created_at->format('g:i a');
                                                @endphp
                                                
                                                <tr class="uk-table-middle">
                                                    <td colspan="5" class="uk-text-left no-border-bottom boxFont"><b>
                                                    {{ str_pad("INV-".$invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}, TO-{{ $invoice->tailoring_order_number }}</b>,
                                                    {!! $time !!}
                                                </td>
                                                </tr>
                                                <tr class="uk-table-middle" style="border-bottom: 1px dashed #ddd;">
                                                    <td colspan="5" class="uk-text-left no-border-bottom boxFont large-line-height" style="line-height: 15px;">
                                                        Sold By: {{ $invoice->createdBy->name }}, 
                                                        @if(isset($invoice->tailoring_customer_delivery)) Delivery Date: {{ date('d-m-Y', strtotime($invoice->tailoring_customer_delivery)) }} @endif
                                                    </td>
                                                </tr>
                                                <tr class="uk-table-middle">
                                                    <td colspan="5" class="uk-text-left no-border-bottom boxFont">
                                                        Contact: {{ $invoice->customer['phone_number_1'] }}, 
                                                        Name: {{ $invoice->customer['display_name']  }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="uk-grid" data-uk-grid-margin="">
                                        <div class="uk-width-small-5-5 uk-text-center" style="margin-top: 35px;">
                                            <img src="{{ asset('/uploads//op-logo/'.$OrganizationProfile->logo) }}" width="32%" alt="{{ $OrganizationProfile->display_name }}">
                                            <p style="line-height: 17px;margin-bottom:10px; margin-top: 8px;" class="organization_info"><b>
                                                {{ $OrganizationProfile->display_name }}</b>
                                                <br>Address: {{ $OrganizationProfile->street }}, {{ $OrganizationProfile->city }}, {{ $OrganizationProfile->state }}-{{ $OrganizationProfile->zip_code }}
                                                <br>Hotline: {{ $OrganizationProfile->contact_number }}
        
                                                @if($OrganizationProfile->vat_number)
                                                    <br>BIN Number: {{ $OrganizationProfile->vat_number }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
        
                                    <input type="hidden" name="invoice_id">
                                    
                                    <div class="uk-grid list_table_lefts">
                                        <div class="uk-width-small-5-5 uk-row-first ftable">
                                            <table id="info" class="uk-table inv_top_right_table">
                                                
                                                @php
                                                    $time   = $invoice->created_at->format('d-m-Y') .',<br><br><br><br><br>'. $invoice->created_at->format('g:i a');
                                                    // dd($time);
                                                @endphp
                                                
                                                <tr class="uk-table-middle">
                                                    <td colspan="5" class="uk-text-left no-border-bottom boxFont"><b>
                                                    {{ str_pad("INV-".$invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</b>,
                                                    {!! $time !!}
                                                </td>
                                                </tr>
                                                <tr class="uk-table-middle" style="border-bottom: 1px dashed #ddd;">
                                                    <td colspan="5" class="uk-text-left no-border-bottom boxFont large-line-height" style="line-height: 15px;">
                                                        Sold By: {{ $invoice->createdBy->name }} 
                                                        @if(isset($invoice->tailoring_customer_delivery)), <br>Delivery Date: {{ date('d-m-Y', strtotime($invoice->tailoring_customer_delivery)) }} @endif
                                                    </td>
                                                </tr>
                                                <tr class="uk-table-middle">
                                                    <td colspan="5" class="uk-text-left no-border-bottom boxFont">
                                                    Contact: {{ $invoice->customer['phone_number_1'] }}</td>
                                                </tr>
                                                <tr class="uk-table-middle">
                                                    <td colspan="5" class="uk-text-left no-border-bottom boxFont large-line-height" style="padding-bottom: 2px;">
                                                    Name: {{ $invoice->customer['display_name']  }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                {{-- <img class="bg_watermark" src="{{ url('uploads/op-logo/logo.png') }}"/> --}}
                                    
                                <div class="uk-grid" style="margin-top:0px !important">

                                    <!--- <div class="uk-width-1-4">
                                        <div>
                                            <span style="text-align: center;">Sample</span>
                                        </div>
                                    </div> -->
                                    
                                    <div class="uk-width-1-1">
                                        
                                        <table id="table_center" class="uk-table main-table">
                                            
                                            <tbody>
                                                
                                                <tr class="uk-table-thead">
                                                    
                                                    @if($tailor_invoice == 1)
                                                        <th class="uk-text-center">Sample</th>
                                                    @endif
                                                    
                                                    <th>SL.</th>
                                                    <th>Item</th>
                                                    <th class="uk-text-right">Rate</th>
                                                    @if($invoice->discount > 0)
                                                        <th class="uk-text-right">Disc.</th>
                                                    @endif
                                                    <th class="uk-text-right">Qty</th>
                                                    <th class="uk-text-right">Total</th>
                                                </tr>
                                                
                                                <?php $i=1; $sub_total = 0; $show_extra_design_charge = false;?>
                                                
                                                @foreach($invoice_entries as $invoice_entry)
                                                    @php if ($invoice_entry->item['item_category_id'] == 3) $show_extra_design_charge = true; @endphp
                                                    <tr class="uk-table-middle">
                                                        
                                                        @if($tailor_invoice == 1)
                                                            <td></td>
                                                        @endif
                                                        
                                                        <td>{{ $i }}</td>
                                                        <td colspan = "1">{{ str_limit($invoice_entry->item['item_name'], 10) }}</td>
                                                        <td class="uk-text-right">
                                                            {{ number_format($invoice_entry->rate, 2, '.', ',') }}, 
                                                            @if($invoice_entry->discount_type == 0 && $invoice_entry->discount > 0)
                                                                {{ $invoice_entry->discount }}% Disc.
                                                            @elseif($invoice_entry->discount_type == 1 && $invoice_entry->discount > 0)
                                                                {{ $invoice_entry->discount }} BDT Disc.
                                                            @endif
                                                        </td>
                                                        
                                                        <td class="uk-text-right">{{ $invoice_entry->quantity . ' ' . $invoice_entry->item['unit_type'] }}</td>
                                                        
                                                        <td class="uk-text-right">{{ number_format($invoice_entry->amount, 2, '.', ',') }}</td>
                                                    </tr>
                                                    <?php $i++; $sub_total += $invoice_entry->amount; ?>
                                                    
                                                @endforeach

                                                @php
                                                    if($invoice->discount_type == 1) {
                                                        $discount = "(".($invoice->discount / $invoice->total * 100)."%".")";
                                                    }else {
                                                        $discount = "(".$invoice->discount." TK".")";
                                                    }
        
                                                    if($invoice->delivery_charge_type == 1) {
                                                        $delivery_charge = "(".($invoice->delivery_charge / $invoice->total * 100)."%".")";
                                                    }else {
                                                        $delivery_charge = "(".$invoice->delivery_charge." TK".")";
                                                    }
                                                @endphp
                                            </tbody>

                                            <div class="uk-table-thead">
                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="4"><b><u>Invoice Summary</u></b></td>
                                                        <td class="uk-text-right no-border-bottom">&nbsp;</td>
                                                    </tr>
                                                @if($tailor_invoice == 1)
                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="5"><b>Sub Total</b></td>
                                                        <td class="uk-text-right no-border-bottom"><b>{{ number_format($sub_total, 2, '.', ',') }}</b></td>
                                                    </tr>

                                                    @if ($show_extra_design_charge)
                                                        <tr class="uk-table-middle">
                                                            <td class="no-border-bottom uk-text-right" colspan="5"><b>Extra Design Charge</b></td>
                                                            <td class="uk-text-right no-border-bottom"><b>{{ number_format($invoice->extra_design_charge, 2, '.', ',') }}</b></td>
                                                        </tr>
                                                    @endif

                                                    @if($invoice->adjustment != 0)

                                                    <?php
                                                        $adjustment_amt_tmp = number_format(abs(($invoice->adjustment * 100) / $sub_total), '2');
                                                        $adjustment_type_tmp = $invoice->adjustment_type == 0 ? '%' : ' BDT';
                                                    ?>

                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="5"><b>Adjustment ({{ $adjustment_amt_tmp . $adjustment_type_tmp }})</b></td>
                                                        <td class="uk-text-right no-border-bottom"><b>{{ number_format($invoice->adjustment, 2, '.', ',') }}</b></td>
                                                    </tr>
                                                    @endif

                                                    @if($invoice->tax_total > 0)

                                                    <?php $tax  = round( $sub_total == 0 ? 0 : (($invoice->tax_total) *100)/($sub_total + $invoice->adjustment)); ?>

                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="5"><b>Vat ({{ number_format($tax, 2, '.', ',') }}%)</b></td>
                                                        <td class="uk-text-right no-border-bottom"><b>{{ number_format($invoice->tax_total, 2, '.', ',') }}</b></td>
                                                    </tr>
                                                    @endif

                                                    @if($invoice->shipping_charge > 0)
                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="5"><b>Shipping Charge</b></td>
                                                        <td class="uk-text-right no-border-bottom"><b>{{ number_format($invoice->shipping_charge, 2, '.', ',') }}</b></td>
                                                    </tr>
                                                    @endif

                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="5"><b>Net Total</b></td>
                                                        <td class="uk-text-right no-border-bottom"><b>{{ number_format($invoice->total_amount, 2, '.', ',') }}</b></td>
                                                    </tr>

                                                    @php $tmp_cash = 0; @endphp

                                                    @foreach($payment_receive_entries as $payment_receive_entries_tmp)
                                                        @if($payment_receive_entries_tmp->paymentReceive->account->id == 3 && $tmp_cash == 0)
                                                            <tr class="uk-table-middle">
                                                                <td class="no-border-bottom uk-text-right" colspan="5"><b>Paid ({{ $payment_receive_entries_tmp->paymentReceive->account->account_name }})</b></td>
                                                                <td class="uk-text-right no-border-bottom"><b>{{ number_format($payment_receive_entries_tmp->amount + $invoice->return_amount, 2, '.', ',') }}</b></td>
                                                            </tr>
                                                            @php $tmp_cash = 1; @endphp
                                                        @else
                                                            <tr class="uk-table-middle">
                                                                <td class="no-border-bottom uk-text-right" colspan="5"><b>Paid ({{ $payment_receive_entries_tmp->paymentReceive->account->account_name }})</b></td>
                                                                <td class="uk-text-right no-border-bottom"><b>{{ number_format($payment_receive_entries_tmp->amount, 2, '.', ',') }}</b></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="5"><b>Return</b></td>
                                                        <td class="uk-text-right no-border-bottom"><b>{{ number_format($invoice->return_amount, 2, '.', ',') }}</b></td>
                                                    </tr>

                                                    <tr class="uk-table-middle" style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                        <td class="no-border-bottom uk-text-right"><b>Fabrics Due&nbsp;&nbsp;&nbsp;</b></td>
                                                        <td class="no-border-bottom"><b>{{ number_format($invoice->fabrics_due, 2, '.', ',') }}</b></td>
                                                        <td class="no-border-bottom uk-text-right" colspan="3"><b>Net Payable</b></td>
                                                        <td class="uk-text-right no-border-bottom"><b>{{ number_format(($invoice->due_amount), 2, '.', ',') }}</b></td>
                                                    </tr>
                                                @else
                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="4"><b>Sub Total</b></td>
                                                        <td class="uk-text-right no-border-bottom" colspan="3"><b>{{ number_format($sub_total, 2, '.', ',') }}</b></td>
                                                    </tr>

                                                    @if ($show_extra_design_charge)
                                                        <tr class="uk-table-middle">
                                                            <td class="no-border-bottom uk-text-right" colspan="5"><b>Extra Design Charge</b></td>
                                                            <td class="uk-text-right no-border-bottom"><b>{{ number_format($invoice->extra_design_charge, 2, '.', ',') }}</b></td>
                                                        </tr>
                                                    @endif
                                                    
                                                    @if($invoice->adjustment != 0)
        
                                                        <?php
                                                            $adjustment_amt_tmp = number_format(abs(($invoice->adjustment * 100) / $sub_total), '2');
                                                            $adjustment_type_tmp = $invoice->adjustment_type == 0 ? '%' : ' BDT';
                                                        ?>
        
                                                        <tr class="uk-table-middle">
                                                            <td class="no-border-bottom uk-text-right" colspan="4"><b>Adjustment ({{ $adjustment_amt_tmp . $adjustment_type_tmp }})</b></td>
                                                            <td class="uk-text-right no-border-bottom" colspan="3"><b>{{ number_format($invoice->adjustment, 2, '.', ',') }}</b></td>
                                                        </tr>
                                                    @endif
                                                    
                                                    @if($invoice->tax_total > 0)
                                                        <?php $tax  = round( $sub_total == 0 ? 0 : (($invoice->tax_total) *100)/($sub_total + $invoice->adjustment)); ?>
        
                                                        <tr class="uk-table-middle">
                                                            <td class="no-border-bottom uk-text-right" colspan="4"><b>Vat ({{ number_format($tax, 2, '.', ',') }}%)</b></td>
                                                            <td class="uk-text-right no-border-bottom" colspan="3"><b>{{ number_format($invoice->tax_total, 2, '.', ',') }}</b></td>
                                                        </tr>
                                                    @endif
                                                    
                                                    @if($invoice->shipping_charge > 0)
                                                        <tr class="uk-table-middle" style="border-bottom: 1px solid #ddd;">
                                                            <td class="no-border-bottom uk-text-right" colspan="4"><b>Shipping Charge</b></td>
                                                            <td class="uk-text-right no-border-bottom" colspan="3"><b>{{ number_format($invoice->shipping_charge, 2, '.', ',') }}</b></td>
                                                        </tr>
                                                    @endif
                                                    
                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="4"><b>Net Total</b></td>
                                                        <td class="uk-text-right no-border-bottom" colspan="3"><b>{{ number_format($invoice->total_amount, 2, '.', ',') }}</b></td>
                                                    </tr>
        
                                                    @php $tmp_cash = 0; @endphp
        
                                                    @foreach($payment_receive_entries as $payment_receive_entries_tmp)
                                                        @if($payment_receive_entries_tmp->paymentReceive->account->id == 3 && $tmp_cash == 0)
                                                            <tr class="uk-table-middle">
                                                                <td class="no-border-bottom uk-text-right" colspan="4"><b>Paid ({{ $payment_receive_entries_tmp->paymentReceive->account->account_name }})</b></td>
                                                                <td class="uk-text-right no-border-bottom" colspan="3"><b>{{ number_format($payment_receive_entries_tmp->amount + $invoice->return_amount, 2, '.', ',') }}</b></td>
                                                            </tr>
        
                                                            @php $tmp_cash = 1; @endphp
                                                        @else
                                                            <tr class="uk-table-middle">
                                                                <td class="no-border-bottom uk-text-right" colspan="4"><b>Paid ({{ $payment_receive_entries_tmp->paymentReceive->account->account_name }})</b></td>
                                                                <td class="uk-text-right no-border-bottom" colspan="3"><b>{{ number_format($payment_receive_entries_tmp->amount, 2, '.', ',') }}</b></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
        
                                                    <tr class="uk-table-middle">
                                                        <td class="no-border-bottom uk-text-right" colspan="4"><b>Return</b></td>
                                                        <td class="uk-text-right no-border-bottom" colspan="3"><b>{{ number_format($invoice->return_amount, 2, '.', ',') }}</b></td>
                                                    </tr>
        
                                                    <tr class="uk-table-middle" style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                        <td class="no-border-bottom uk-text-right" colspan="4"><b>Net Payable</b></td>
                                                        <td class="uk-text-right no-border-bottom" colspan="3"><b>{{ number_format(($invoice->due_amount), 2, '.', ',') }}</b></td>
                                                    </tr>
                                                @endif
    
                                                <tr>
                                                    <td colspan="6" class="uk-text-center">
                                                        <p class="footer_info large-line-height" style="line-height: 15px;">You can only exchange sold goods within 07 days of invoice date</p>
                                                        <p class="footer_info">Thank you for shopping with us</p>
                                                    </td>
                                                </tr>
                                            </div>

                                        </table>
    
                                    </div>
                                </div>
                                
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="hidden-print">
                    <div class="uk-margin-large-top">
                        <h2 class="heading_b">Payments Received</h2>
                    </div>

                    <div class="ük-grid uk-margin-top" data-uk-grid-margin>
                        <div class="md-card md-card-single main-print">
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table report_table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th class="uk-text-right">Payment#</th>
                                            <th class="uk-text-right">Reference#</th>
                                            <th class="uk-text-right">Deposit To</th>
                                            <th class="uk-text-right">Amount</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;?>
                                        @foreach($payment_receive_entries as $payment_receive_entry)
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-center">{{ $i++ }}</td>
                                            <td>{{ date('d-m-Y', strtotime($payment_receive_entry->paymentReceive->payment_date)) }}</td>
                                            <td class="uk-text-right">{{ $payment_receive_entry->paymentReceive['account_id'] == 3 ? 'CR' : 'BR' }}-{{ str_pad($payment_receive_entry->paymentReceive['pr_number'],'6','0',STR_PAD_LEFT) }}</td>
                                            <td class="uk-text-right">{{ $payment_receive_entry->paymentReceive->reference }}</td>
                                            <td class="uk-text-right">{{ $payment_receive_entry->paymentReceive->account->account_name }}</td>
                                            <td class="uk-text-right">BDT {{ $payment_receive_entry->amount }}</td>
                                            <td class="uk-text-center">
                                                <a href="{{ url('/payment-received/edit'.'/'.$payment_receive_entry->payment_receives_id) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                <a class="payment_receive_delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="payment_receive_entry_id" value="{{ $payment_receive_entry->id }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-margin-top">
                        <h2 class="heading_b">Credits Applied</h2>
                    </div>

                    <div class="ük-grid uk-margin-top" data-uk-grid-margin>
                        <div class="md-card md-card-single main-print">
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Credit Note</th>
                                            <th class="uk-text-right">Credits Applied</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;?>
                                        @foreach($credit_receive_entries as $credit_receive_entry)
                                        <tr class="uk-table-middle">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $credit_receive_entry->created_at->format('Y-m-d') }}</td>
                                            <td>CN-{{ $credit_receive_entry->creditnote->credit_note_number }}</td>
                                            <td class="uk-text-right">BDT {{ $credit_receive_entry->amount }}</td>
                                            <td class="uk-text-center">
                                                {{--<a href="{{ url('/invoice/delete-credit'.'/'.$credit_receive_entry->id) }}" class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>--}}
                                                <a class="credit_receive_entry_delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="credit_receive_entry_id" value="{{ $credit_receive_entry->id }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

    <!-- Create Item Modal -->
    <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 50px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Stock Unavailable</h4>
                </div>
                <form action="{!! route('adding_stock',$invoice->id) !!}" method="post">
                    {!! csrf_field() !!}
                <div class="modal-body">
                    <h3 style="list-style: none;color: green;margin-top: 10px;text-decoration: underline">Item</h3>
                    <table class="table table-bordered">
                        <thead style="margin-top: 30px;background-color: #5CB85C;color: white;text-transform: uppercase;">
                        <tr>
                            <th>Pen</th>
                            <th>Available</th>
                            <th>Your Quantity</th>
                        </tr>
                        </thead>
                        <tbody id="stockEntry">

                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Stock & Create</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- show Item Modal -->
    <div class="modal fade" id="message-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 50px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mark As Open</h4>
                </div>
                <form action="{!! route('adding_stock',$invoice->id) !!}" method="post">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <h3 style="list-style: none;color: green;margin-top: 10px;">Invoice was marked as open</h3>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('sweet_alert')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
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


        $("#popup").click(function(e){
            e.preventDefault();
            axios.post(this.href)
                .then(function (response) {
                    var row=document.getElementById('stockEntry');
                    row.innerHTML=response.data;


                })
                .catch(function (error) {
                    console.log(error);
                });

            axios.get(this.href)
                .then(function (response) {

                    if(response.data.status){


                        $("#create-item").modal("show");
                        $("#popup").hide();
                        setTimeout(function () {
                            location.reload();
                        }, 15000)


                    }else{

                        $("#message-item").modal("show");
                        $("#popup").hide();
                        $("#draft").hide();
                        $("#nav_in_without_href").hide();
                        $("#nav_in_with_href").show();


                    }

                })
                .catch(function (error) {
                    console.log(error);
                });


        });

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_invoice').addClass('act_item');

        @if(isset($auto_print) && $auto_print != 0)
            $(document).ready( function(){

                window.onafterprint = function(e){
                    closePrintView();
                };
                
                setTimeout(function() {
                     window.print();
                }, 1000);
                
                
                function closePrintView() {
                    
                    @if($tailor_invoice == 1)
                        window.location.href = '{{ route("invoice_add_measurements") }}';
                    @else
                        window.location.href = '{{ route("invoice_create") }}';
                    @endif
                }
            });
        @endif

        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })


        function _(el) {
            return document.getElementById(el);
        }

        function uploadFile(){
            _("progressBar").style.display = "block";
            var file = _("file1").files[0];
            var size= file.size/1024/1024;
            if(size>10){
                _("status").innerHTML = "file size not allowed";
                _("status").style.color = "red";
                return false;
            }
            _("status").style.color = "black";

            // alert(file.name+" | "+file.size+" | "+file.type);
            var formdata = new FormData();
            formdata.append("file1", file);
            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", completeHandler, false);
            ajax.addEventListener("error", errorHandler, false);
            ajax.addEventListener("abort", abortHandler, false);
            ajax.open("POST", window.location.href);
            ajax.send(formdata);
        }

        function progressHandler(event) {
            _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
            var percent = (event.loaded / event.total) * 100;
            _("progressBar").value = Math.round(percent);
                _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
        }

        function completeHandler(event) {
            // _("status").innerHTML = event.target.responseText;

            //   UIkit.modal.alert(event.target.responseText)
            _("progressBar").value = 100;
            _("progressBar").style.color = "blue";
            _("status").innerHTML = event.target.responseText;
        }

        function errorHandler(event) {
            //  _("status").innerHTML = "Upload Failed";
            alert("Upload Failed");
            _("progressBar").style.display = "none";
        }

        function abortHandler(event) {
            // _("status").innerHTML = "Upload Aborted";
            alert("Upload Aborted");
            _("progressBar").style.display = "none";
        }
    </script>
@endsection
