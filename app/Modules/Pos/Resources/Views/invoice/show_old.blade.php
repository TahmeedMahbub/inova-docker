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
        
        .uk-table td, .uk-table th {
            padding: 6px 6px;
        }
        
        #table_center th,td,tr{
            border-bottom-color: black !important;
            border: 1px solid black !important;
            padding: 3px 3px;
        }
        
        #table_center>tbody>tr:last-child{ border:0px !important; }
        #table_center>tbody>tr:last-child td{ border:0px !important; }
        
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
              /*margin-top: 130px;*/
              margin-top: -100px;
            }

            #print{
                display: none;
            }
            
            /*.print_header{*/
            /*    position: fixed;*/
            /*    top: 0px;*/
            /*    left: 0px;*/
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

                        <li class="heading_list">Recent Invoices</li>

                        @foreach($invoices as $invoice_data)
                        <li>
                            <a href="{{ url('/invoice/show'.'/'.$invoice_data->id) }}" class="md-list-content">
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
            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar" style="border-bottom: 0px solid rgba(0,0,0,.12);">
                             <div  style="float: left;margin-right: 15px; height: 14px;" class="uk-form-file md-btn md-btn-wave-light">
                                  <a href="{{route('invoice_create')}}">Invoice Create</a>
                                </div>
                            <div class="md-card-toolbar-actions hidden-print">

                                <span  style="display: none;" id="loaded_n_total"></span>
                                <span  id="status"></span>   <progress id="progressBar" value="0" max="100" style="float: left;margin-right: 15px; margin-top: 10px; height: 20px;width:300px; display: none;"></progress>
                                <div  style="float: left;margin-right: 15px; height: 14px;" class="uk-form-file md-btn md-btn-wave-light">
                                    Upload file
                                    <input name="file1" id="file1" type="file" onchange="uploadFile()">
                                </div>
                                
                               @if($invoice['save']==1)
                                  <a  href="{!! route('invoice_update_save',$invoice->id) !!}" id="popup" style="float: left;margin-right: 15px" class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light">Mark as Open</a>
                                @endif
                                @if($invoice['save']==1)

                                <p id="draft" style="margin: 0;padding: 0;padding-top: 7px;float: left;margin-right: 10px;text-transform: uppercase">Draft</p>

                                @endif

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
                                           @if($invoice->file_url)
                                            <li>
                                                <a  href="{{ url($invoice->file_url) }}" downlaod class="uk-nav-header">Attach File</a>
                                            </li>
                                           @endif
                                           
                                           <li>
                                               <a class="uk-nav-header">Challan</a>
                                           </li>
                                        </ul>

                                        <ul id="nav_in_with_href" class="uk-nav" style="display: {{ $invoice->save==1?'none':'block' }}" >

                                            <li>
                                                <a href="{{ url('/invoice/show'.'/'.$invoice->id) }}">Invoice</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/invoice/edit'.'/'.$invoice->id) }}">Edit</a>
                                            </li>
                                             @if($invoice->file_url)
                                                <li>
                                                    <a  href="{{ url($invoice->file_url) }}" download>Attach File</a>
                                                </li>
                                             @endif

                                            <li>
                                                <a data-uk-modal="{target:'#modal_header_footer'}" href="#">Use Credits</a>
                                            </li>

                                            <li>
                                                <a data-uk-modal="{target:'#modal_header_footer1'}" href="#">Use Excess Payment</a>
                                            </li>

                                            <li>
                                                <a href="{{ url('invoice/challan'.'/'.$invoice->id) }}">Challan</a>
                                            </li>  
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="margin-top: 0px;">
                            
                           @if($theader->getBanner()->headerType)
                                <div class="print_header" style="text-align: center;">
                                    <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center; margin-top:50px;">
                                    <h1 style="width: 100%; text-align: center;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="" style="text-align: center;">
                                    <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>
    
                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                                </div>
                           @endif
    
                            <div class="uk-grid" data-uk-grid-margin>
                                
                                <div class="uk-width-5-5" style="font-size: 15px;">
                                    <div class="uk-grid">
                                        <h2 style="text-align: center; width: 90%;" class="">
                                            <u>
                                            @if($helper->getPaymentStatus($invoice->id) == "Draft")
                                              DRAFT INVOICE
                                            @else
                                              INVOICE
                                            @endif
                                            </u>
                                        </h2>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <input type="hidden" ng-init="invoice_id='asdfg'" value="{{$invoice->id}}" name="invoice_id" ng-model="invoice_id">
    
                            <div class="uk-grid" style="font-size: 15px;">
                                <div class="uk-width-1-2">
                                    <div>
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
                                                    {{ $invoice->customer->billing_zip_code }}
                                                @endif
                                                    {{ $invoice->customer->billing_country }}
                                            </p>
                                            @if(isset($invoice->customer->phone_number_1) && $invoice->customer->phone_number_1 != "")
                                                <b>Phone:</b> {{ $invoice->customer->phone_number_1 }}
                                            @endif
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
                                    </div>
                                </div>
                                <div class="uk-width-1-2">
                                    <div class="uk-width-small-1-1">
                                        
                                    </div>
                                    <table id="info" class="uk-table inv_top_right_table" style="line-height: 4px;">

                                        <tr class="uk-table-middle">
                                            <td style="font-weight: bold" class="uk-text-right">Date : </td>
                                            <td class="uk-text-right ">{{ date('d-m-Y',strtotime($invoice->invoice_date)) }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td style="font-weight: bold" class="uk-text-right">Invoice No : </td>
                                            <td class="uk-text-right ">   INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</td>
                                        </tr>

                                       @if(!empty($OrganizationProfile->etin))
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-right ">ETIN No. </td>
                                            <td class="uk-text-right ">{{ $OrganizationProfile->etin }}</td>
                                        </tr>
                                       @endif
                                     @if(!empty($OrganizationProfile->vat_number))
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-right ">VAT Reg.</td>
                                            <td class="uk-text-right ">{{ $OrganizationProfile->vat_number }}</td>
                                        </tr>
    
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-right ">VAT Challan No. </td>
                                            <td class="uk-text-right "></td>
                                        </tr>
                                     @endif                                              
                                       
                                    </table>
                                </div>
                            </div>
                            
                            @if($invoice->reference)
                                <div class="uk-grid" style="margin-top: 5px; word-wrap: break-word;">
                                    <div class = "uk-width-1-1">
                                        <p>{{ $invoice->reference }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;margin-top: 5px;">
                                <div class="uk-width-1-1">
                                    <table id="table_center" border="0" class="uk-table">
                                        
                                        <thead>
                                            <tr class="uk-text-upper">
                                                <th class="uk-text-center" style="width: 5%">SL.</th>
                                                <th class="uk-text-center" >Description</th>
                                                <th class="uk-text-center" >Qty</th>
                                                <th class="uk-text-center" >Unit Price</th>
                                                @if($invoice_discount_count>0)
                                                <th class="uk-text-center" >Discount</th>
                                                @endif
                                                <th  class="uk-text-center" >Amount</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            
                                            <?php $i = 1; ?>
                                            
                                            @foreach($invoice_entries as $invoice_entry)
                                                <tr class="uk-table-middle">
                                                    <td class="uk-text-center">{{ $i++ }}</td>
                                                    <td class="uk-text-left" style="width: 300px;">{{ $invoice_entry->item->item_name }} @if($invoice_entry->description) {!! nl2br($invoice_entry['description']) !!}@endif</td>
                                                    <td class="uk-text-center">{{ $invoice_entry->quantity.' '.$invoice_entry->item['unit_type'] }}</td>
                                                    <td class="uk-text-right">{{ number_format($invoice_entry->rate, 2, '.', '') }}</td>
                                                    @if($invoice_discount_count>0)<td class="uk-text-center" >{{ $invoice_entry->discount }}@if($invoice_entry->discount_type==0) % @else BDT @endif</td>@endif
                                                    <td class="uk-text-right">{{ number_format($invoice_entry->amount, 2, '.', '') }}</td>
                                                </tr>
                                            @endforeach
                                            
                                            @if($invoice->shipping_charge>0 || $invoice->tax_total>0 || $invoice->adjustment || $invoice->tax_type)
                                                <tr class="uk-table-middle">
                                                    <td ></td>
                                                    <td >{{ $invoice->tax_type }}</td>
                                                    <td></td>
                                                    @if($invoice_discount_count>0)<td></td>@endif
                                                    <td class="uk-text-right">Sub Total</td>
                                                    <td class="uk-text-right">{{ number_format($sub_total, 2, '.', '') }}</td>
                                                </tr>
                                            @endif
                                            
                                            @if($invoice->adjustment > 0 || $invoice->adjustment < 0)
                                                <tr class="uk-table-middle">
                                                    <td class="">
    
                                                    </td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    @if($invoice_discount_count>0)<td class=""></td>@endif
                                                    <td class="uk-text-right ">Less</td>
                                                    <td class="uk-text-right ">{{ number_format($invoice->adjustment, 2, '.', '') }}</td>
                                                </tr>
                                            @endif
    
                                            @if($invoice->tax_total>0)
                                                <tr class="uk-table-middle">
                                                    <td ></td>
                                                    <td ></td>
                                                    <td ></td>
                                                    @if($invoice_discount_count>0)<td ></td>@endif
                                                    <td class="uk-text-right ">
                                                        Vat/Tax {{ ($invoice->tax_type) ? $invoice->tax_type : "" }}
                                                    @if($invoice->shipping_charge>0 && $invoice->adjustment)
                                                    ({{ $sub_total == 0 ? 0 : number_format(($invoice->total_amount - $sub_total -$invoice->shipping_charge-$invoice->adjustment)*100/($sub_total+$invoice->adjustment),2, '.', '')}}%)
        
                                                    @elseif($invoice->shipping_charge>0)
                                                    ({{ $sub_total == 0 ? 0 : number_format(($invoice->total_amount - $sub_total -$invoice->shipping_charge)*100/$sub_total,2, '.', '')}}%)
        
                                                    @elseif($invoice->adjustment)
                                                    ({{ $sub_total == 0 ? 0 : number_format(($invoice->total_amount - $invoice->adjustment - $sub_total)*100/($sub_total+$invoice->adjustment),2, '.', '')}}%)
        
                                                    
        
                                                    @else
                                                    ({{number_format(($invoice->total_amount - $sub_total)*100/$sub_total,2, '.', '')}}%)
                                                    @endif
                                                    </td>
                                                    <td class="uk-text-right ">{{ number_format($invoice->tax_total, 2, '.', '') }}</td>
                                                </tr>
                                            @endif
    
                                            @if($invoice->shipping_charge>0)
                                                <tr class="uk-table-middle">
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                    @if($invoice_discount_count>0)<td class=""></td>@endif
                                                    <td class="uk-text-right ">Shipping Charge</td>
                                                    <td class="uk-text-right ">{{ number_format($invoice->shipping_charge, 2, '.', '') }}</td>
                                                </tr>
                                            @endif
    
                                            <tr class="uk-table-middle">
                                                <td class="uk-text-left" colspan="2">(In words: {{ucfirst($numberTransformer->toWords($invoice->total_amount))}} BDT Only)</td>
                                                @if($invoice_discount_count>0)<td style="border: none !important;"></td>@endif
                                                <td class="uk-text-right" colspan="2">Grand Total (in BDT) =</td>
                                                <td class="uk-text-right " >{{ number_format($invoice->total_amount, 2, '.', '') }}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <?php $i = 1; $total_due = 0;?>
                                    
                                    @foreach($invoices as $invoice_data)
                                        @if($invoice_data->customer_id ==$invoice->customer_id )
                                            <?php $total_due = $total_due+$helper->getDueBalance($invoice_data->id); ?>
                                        @endif
                                    @endforeach
    
                                </div>
                            </div>
                            <div class="uk-grid" style="margin-top:-46px;">
                                <div class="uk-width-1-1">
    
                                    <p><span class="uk-text-small"><b>Notes:</b></span>
                                    <span class="uk-text-small uk-margin-bottom">{{$invoice->customer_note}}</span></p>
    
                                </div>
                            </div>
    
                            <div class="uk-grid" style="margin-top:20px;">
                                <div class="uk-width-1-2" style="text-align: left">
                                    <br>
                                    <p class="uk-text-small uk-margin-bottom">Customer Signature</p>
                                </div>
                                <div class="uk-width-1-2" style="text-align: right">
                                    <br>
                                    <p  class="uk-text-small uk-margin-bottom">Company Representative</p>
                                </div>
                            </div>
                        </div>
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
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $payment_receive_entry->paymentReceive->payment_date }}</td>
                                            <td class="uk-text-right">PR-{{ str_pad($payment_receive_entry->paymentReceive['pr_number'],'6','0',STR_PAD_LEFT) }}</td>
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
