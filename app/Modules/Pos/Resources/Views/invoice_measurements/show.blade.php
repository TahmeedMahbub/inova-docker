@extends('layouts.invoice')

@section('title', 'Measurement View')

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

@php
    $helpers = new App\Lib\Helpers;
@endphp

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
        
        /* #table_center>tbody>tr:last-child{ border:0px !important; } */
        /* #table_center>tbody>tr:last-child td{ border:0px !important; } */
        
        table#info{
            font-size: 12px !important;
            line-height: 2px;
            border: none !important;
            min-width: 200px;
            width: 230px;
            float:right;
        }
        table#info tr td{
             border: none !important;
        }
        table#info tr{
            padding: 0px;
            border: none !important;
        }
        .main-measurements p{
            display: inline-block;
            margin-top: 0px;
            margin-bottom: 4px;
            margin-right: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        
        @media print {
            body {
              /*margin-top: 130px;*/
              /*margin-top: -100px;*/
            }

            #print{
                display: none;
            }
            
        }
    </style>
@endsection

@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>

            <?php $helper = new \App\Lib\Helpers; ?>
            
            @inject('theader', '\App\Lib\TemplateHeader')

            <div class="uk-width-large-10-10">
                @include('inc.alert')
                        
                <div class="md-card md-card-single main-print">
                    <div class="invoice_preview">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions hidden-print">
                                
                                <i class="md-icon material-icons" id="invoice_single_print"></i>
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
                                           <li>
                                               <a href="{{ url('/invoice/edit/measurements'.'/'.$invoice->id) }}">Edit Measurements</a>
                                            </li>
                                            <li>
                                               <a href="{{ url('/invoice/show/measurements'.'/'.$invoice->id) }}">View Measurements</a>
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
                                               <a href="{{ url('/invoice-measurements/edit/measurements'.'/'.$invoice->id) }}">Edit Measurements</a>
                                            </li>
                                            <li>
                                               <a href="{{ url('/invoice-measurements/show/measurements'.'/'.$invoice->id) }}">View Measurements</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">Sales : {{ "INV-".$invoice->invoice_number }}, TO-{{ $invoice->tailoring_order_number }} Measurements</h3>
                        </div>
                        <div class="print_bg">
                            @foreach($tailoring_products as $key => $tailoring_product)
                                <div class="md-card-content invoice_content" style="margin-top: 10px; min-height: 540px; @if($key) page-break-before: always; @endif">

                                    <div class="uk-grid uk-margin-bottom" style="font-size: 15px; border-bottom: 1px dashed darkgrey; padding-bottom: 15px">
                                        <div class="uk-width-1-2">
                                            <div>
                                                <img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" 
                                                    alt="" height="15" width="71"/>
                                                <p style="display: inline-block; margin: 2px 0px; vertical-align: middle;">
                                                    <b>Order Date : </b> {{ date('d-M-Y',strtotime($invoice->invoice_date)) }}<br>
                                                    <b>Delivery Date : </b> {{ isset($invoice->tailoring_customer_delivery) ? date('d-M-Y',strtotime('-4 days', strtotime($invoice->tailoring_customer_delivery))) : '' }}<br>
                                                    <b>Master Name : </b> {{ $tailoring_product->invoice_master->first_name ?? '' }} {{ $tailoring_product->invoice_master->last_name ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="uk-width-1-2">
                                            <table id="info" class="uk-table inv_top_right_table" style="line-height: 4px;">
                                                <tr class="uk-table-middle">
                                                    <td style="font-weight: bold; font-size: 16px" class="uk-text-right">Order No : </td>
                                                    <td class="uk-text-right "><strong style="font-size: 16px">TO-{{ $invoice->tailoring_order_number }}</strong></td>
                                                </tr>
                                                <tr class="uk-table-middle">
                                                    <td style="font-weight: bold" class="uk-text-right">Item : </td>
                                                    <td class="uk-text-right ">{{ $tailoring_product->item_name }}</td>
                                                </tr>
                                                <tr class="uk-table-middle">
                                                    <td style="font-weight: bold" class="uk-text-right">Quantity : </td>
                                                    <td class="uk-text-right ">{{ $tailoring_product->quantity }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- <img class="bg_watermark" src="{{ url('uploads/op-logo/logo.png') }}"/> --}}
                                    
                                    <div class="uk-grid" style="font-size: 15px;">
                                        <div class="uk-width-1-2">
                                            <div>
                                                <img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" 
                                                    alt="" height="15" width="71"/>
                                                <p style="display: inline-block; margin: 2px 0px; vertical-align: middle;">
                                                    <b>Customer Name:  </b> {{ isset($invoice->customer) ? $invoice->customer->display_name : '' }}<br>
                                                    <b>Contact No.: </b> {{ $invoice->customer->phone_number_1 }}<br>
                                                    <b>Master Name : </b> {{ $tailoring_product->invoice_master->first_name ?? '' }} {{ $tailoring_product->invoice_master->last_name ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="uk-width-1-2">
                                            <table id="info" class="uk-table inv_top_right_table" style="line-height: 4px;">
                                                <tr class="uk-table-middle">
                                                    <td style="font-weight: bold; font-size: 16px" class="uk-text-right">Order No : </td>
                                                    <td class="uk-text-right "><strong style="font-size: 16px">TO-{{ $invoice->tailoring_order_number }}</strong></td>
                                                </tr>
                                                <tr class="uk-table-middle">
                                                    <td style="font-weight: bold" class="uk-text-right">Date : </td>
                                                    <td class="uk-text-right ">{{ date('d-M-Y',strtotime($invoice->invoice_date)) }}</td>
                                                </tr>
                                                <tr class="uk-table-middle">
                                                    <td style="font-weight: bold" class="uk-text-right">Delivery Date : </td>
                                                    <td class="uk-text-right ">{{ isset($invoice->tailoring_customer_delivery) ? date('d-M-Y',strtotime('-4 days', strtotime($invoice->tailoring_customer_delivery))) : '' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                
                                    <div class="uk-grid uk-margin-large-bottom" style="font-size: 12px;">
                                        <div class="uk-width-1-1">
                                            <table id="table_center" border="0" class="uk-table" style="margin-top: 0px !important;">
                                                <thead>
                                                    <tr class="uk-text-upper">
                                                        <th class="uk-text-center" style="width: 8%">Image</th>
                                                        <th class="uk-text-center" style="width: 8%">Product</th>
                                                        <th class="uk-text-center" style="width: 4%">Qty</th>
                                                        <th class="uk-text-center" style="width: 50%">Measurements</th>
                                                        <th class="uk-text-center" style="width: 30%">Design</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <tr class="uk-table-middle">
                                                        <td class="uk-text-center"><img width="70%" src="{{ isset($tailoring_product->item_image_url) ? asset($tailoring_product->item_image_url) : '' }}"></td>
                                                        <td class="uk-text-center">{{ $tailoring_product->item_name }}</td>
                                                        <td class="uk-text-center">{{ $tailoring_product->quantity }}</td>
                                                        
                                                        <td class="uk-text-left main-measurements">
                                                            @for ($i = 1 ; $i <= $tailoring_product->measurement_fields->max('show_row') ; $i++)
                                                                @php $mfs = $tailoring_product->measurement_fields->where('show_row', $i)->sortBy('show_serial'); @endphp
                                                                @foreach ($mfs as $key => $mf)
                                                                    @for ($j = 0 ; $j < $mf->show_spaces ; $j++)
                                                                        <p style="width: 8%; margin: 0px; font-size: 15px;visibility: hidden;"></p>
                                                                    @endfor
                                                                    
                                                                    @if (isset($tailoring_product->measurement_value[$key]) && $tailoring_product->measurement_value[$key] != 0 || $tailoring_product->measurement_value[$key] != '')
                                                                        <p style="width: 8%; margin: 0px; font-size: 15px;">
                                                                        {!!  $helpers->measurementValueString($tailoring_product->measurement_value[$key]) !!}
                                                                        </p>
                                                                    @else
                                                                        <p style="width: 8%; margin: 0px; font-size: 15px;"></p>
                                                                    @endif
                                                                @endforeach
                                                                <br><br>
                                                            @endfor
                                                        </td>

                                                        <td class="uk-text-left">

                                                            @foreach($tailoring_product->measurement_design_fields as $key => $value)
                                                                @if($tailoring_product->measurement_design_value[$key] != '')
                                                                    @if(strlen($tailoring_product->measurement_design_value[$key]) > 0)
                                                                        <ul>
                                                                            @if($tailoring_product->measurement_design_value[$key] == 'checked')
                                                                                <li>{{ $tailoring_product->measurement_design_field[$key]->BodyMeasurements->en_title }}</li>
                                                                            @else
                                                                                <li>{{ $tailoring_product->measurement_design_field[$key]->BodyMeasurements->en_title 
                                                                                    . ': ' . $tailoring_product->measurement_design_value[$key] }}</li>
                                                                            @endif
                                                                        </ul>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            <br><b style="padding-left: 1rem">Note:</b>
                                                            {{-- {!! nl2br($tailoring_product->extra_note) !!} --}}

                                                            <ul>
                                                                @php
                                                                    $additional_notes = explode('/', $tailoring_product->additional_note)
                                                                @endphp
                                                                @foreach ($additional_notes as $additional_note)
                                                                    <li style="font-size: 15px">{{ $additional_note }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>                                            
                                                </tbody>
                                            </table>   
                                        </div>
                                        
                                        @php
                                            $has_spec = 0;
                                            
                                            foreach($measurements as $measurement){
                                                if($measurement->item->id != $measurement->rawMaterial->id && $measurement->item->id == $tailoring_product->id ){
                                                    $has_spec = 1;
                                                }
                                            }
                                        @endphp

                                        @if($has_spec == 1)
                                            <div class="uk-width-1-1" style="margin-top: 15px;">
                                            <table id="table_center" border="0" class="uk-table">
                                                <thead>
                                                    <tr class="uk-text-upper">
                                                        <th class="uk-text-center" style="width: 5%">SL.</th>
                                                        <th class="uk-text-center">Raw Material</th>
                                                        <th class="uk-text-center" width="50%">Note</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    
                                                    @foreach($measurements as $measurement)
                                                        @if($measurement->item->id != $measurement->rawMaterial->id && $measurement->item->id == $tailoring_product->id )
                                                            <tr class="uk-table-middle">
                                                                <td class="uk-text-center">{{ $i++ }}</td>
                                                                <td class="uk-text-left">{{ str_pad($measurement->rawMaterial->id, '6', '0', STR_PAD_LEFT) . ', ' . $measurement->rawMaterial->item_name }}</td>
                                                                <td class="uk-text-left">{{ $measurement->note }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach                                            
                                                </tbody>
                                            </table>   
                                        </div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" style="margin-top:-46px;">
                                        <div class="uk-width-1-1">
                                            <p><span class="uk-text-small"><b>Additional Note:</b></span>
                                            <span class="uk-text-small uk-margin-bottom">{!! nl2br($invoice->tailoring_note) !!}</span></p>
            
                                        </div>
                                    </div>

                                    <div class="uk-grid" style="margin-top:10px;">
                                        <div class="uk-width-1-2" style="text-align: left">
                                            <br>
                                            <p class="uk-text-small uk-margin-bottom">Tailor Master Signature</p>
                                        </div>
                                        <div class="uk-width-1-2" style="text-align: right">
                                            <br>
                                            <p class="uk-text-small uk-margin-bottom">Tailor Manager Signature</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('sweet_alert')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script>
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_invoice_measurements').addClass('act_item');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })

        $('body').on('click','#invoice_single_print',function(e) {
            var selector = $(this).closest('.invoice_preview').find('.print_bg').html();
            e.preventDefault();
            UIkit.modal.confirm('Do you want to print?', function () {
                setTimeout(function () {
                    var html = $('body').html();
                    $('body').html(selector);
                    $('body').removeClass();
                    window.print();
                    $('body').html(html);
                }, 300)
            }, {
                labels: {
                    'Ok': 'print'
                }
            });
        })
    </script>
@endsection