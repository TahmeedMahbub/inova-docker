@extends('layouts.invoice')

@section('title', 'Recurring Show')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
   
@endsection

@section('styles')
    <style>
        #table_center th,td{
            border-bottom-color: black !important;
        }
        table#info{
            font-size: 12px !important;
            line-height: 2px;
            border: 1px solid black !important;
            min-width: 200px;
            float:right;
        }
        table#info tr td{
            border: 1px solid black !important;
        }
        table#info tr{
            padding: 0px;
            border: 1px solid black !important;
        }
        .invoice-margin-top{
            margin-top: -10px !important;
        }
        @media print {
            body {

              margin-top: -100px;
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
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Recurring Invoices</li>

                        @foreach($recurring_invoices as $invoice_data)
                        <li>
                            <a href="{{ url('/invoice/show'.'/'.$invoice_data->id) }}" class="md-list-content">
                                <span class="md-list-heading uk-text-truncate">{{ $invoice_data->customer->display_name }} <span class="uk-text-small uk-text-muted">({{ isset($invoice_data->created_at) ? $invoice_data->created_at->format('d M Y') : '' }})</span></span>
                                <span class="uk-text-small uk-text-muted">INV-{{ str_pad($invoice_data->recurring_invoice_number, 6, '0', STR_PAD_LEFT) }}</span>
                            </a>
                        </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ url('/invoice') }}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>

            <?php
            $helper = new \App\Lib\Helpers;

            ?>
            @inject('theader', '\App\Lib\TemplateHeader')
            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">

                        <div class="md-card-toolbar" style="border-bottom: 0px solid rgba(0,0,0,.12);">

                            <div class="md-card-toolbar-actions hidden-print">

                            

                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <div class="uk-dropdown" aria-hidden="true">
                                        


                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="margin-top: 0px;">

                           @if($theader->getBanner()->headerType)
                                <div class="" style="text-align: center;">

                                <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center; margin-top:50px;">
                                    <h1 style="width: 100%; text-align: center;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="{{ $OrganizationProfile->company_name }}" height="15" width="71"/> <br> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="" style="text-align: center;">
                                    <p>@php echo nl2br($recurring_invoice->customer->billing_address); @endphp</p>
                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }}, {{ $OrganizationProfile->website }} ,{{ $OrganizationProfile->contact_number }}  </p>
                                </div>
                           @endif
                            <br>
                            <input type="hidden" ng-init="invoice_id='asdfg'" value="{{$recurring_invoice->id}}" name="invoice_id" ng-model="invoice_id">

                            <div class="uk-grid" style="font-size: 12px;">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">
                                        <span ><b>Invoice To:</b></span>
                                        <address>
                                            <p><strong>{{ $recurring_invoice->customer->display_name }}</strong></p>
                                            <p>@php echo nl2br($recurring_invoice->customer->billing_address); @endphp</p>
                                            <p>{{ $recurring_invoice->customer->phone_number_1 }}</p>

                                        </address>
                                    </div>
                                </div>
                                <br>
                                <div class="uk-width-small-1-2">
                                   
                                    <table id="info" class="uk-table inv_top_right_table">
                                     
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">Date </td>
                                            <td class="uk-text-center ">{{ date('d-m-Y',strtotime($recurring_invoice->invoice_date)) }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left ">Invoice Number</td>
                                            <td class="uk-text-center ">{{ str_pad($recurring_invoice->recurring_invoice_number, 6, '0', STR_PAD_LEFT) }}</td>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="uk-grid invoice-margin-top" style="font-size: 12px;">
                                <div class="uk-width-1-1">
                                    <table id="table_center" border="1" class="uk-table"  >
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>Sl.No</th>
                                            <th class="uk-text-center">Particulars</th>
                                            <th class="uk-text-center">RATE</th>
                                            @if($invoice_discount_count>0)
                                            <th class="uk-text-center">Discount</th>
                                            @endif
                                            <th  class="uk-text-center">Amount (in BDT)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($recurring_invoices_entries as $invoice_entry)
                                        <tr class="uk-table-middle">
                                            <td>{{ $i++ }}</td>
                                            <td class="uk-text-center">{{ $invoice_entry->item->item_name }} @if($invoice_entry['description']) ({!! nl2br($invoice_entry['description']) !!} ) @endif</td>
                                            <td class="uk-text-center">{{ $invoice_entry->rate }}</td>
                                            @if($invoice_discount_count>0)<td class="uk-text-center" >{{ $invoice_entry->discount }}@if($invoice_entry->discount_type==0) % @else BDT @endif</td>@endif
                                            <td class="uk-text-center">{{ $invoice_entry->amount }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="uk-table-middle">
                                            <td ></td>
                                            <td></td>
                                            @if($invoice_discount_count>0)<td></td>@endif
                                            <td class="uk-text-center">Sub Total</td>
                                            <td class="uk-text-center">{{ $sub_total }}</td>
                                        </tr>

                                        @if($recurring_invoice->tax_total>0)
                                        <tr class="uk-table-middle hidden">
                                            <td ></td>
                                            <td ></td>
                                            @if($recurring_invoice>0)<td ></td>@endif
                                            <td class="uk-text-center ">Tax</td>
                                            <td class="uk-text-center ">{{ $recurring_invoice->tax_total }}</td>
                                        </tr>
                                        @endif

                                        <tr class="uk-table-middle">
                                            @if($recurring_invoice->shipping_charge>0)
                                            <td ></td>
                                            <td ></td>
                                            @if($invoice_discount_count>0)
                                                <td ></td>
                                            @endif
                                            <td class="uk-text-center ">
                                                Vat @if($recurring_invoice->shipping_charge>0 && $recurring_invoice->adjustment)
                                            ({{number_format(($recurring_invoice->total_amount - $sub_total -$recurring_invoice->shipping_charge-$recurring_invoice->adjustment)*100/$sub_total,2)}}%)

                                            @elseif($recurring_invoice->shipping_charge>0)
                                            ({{number_format(($recurring_invoice->total_amount - $sub_total -$recurring_invoice->shipping_charge)*100/$sub_total,2)}}%)

                                            @elseif($recurring_invoice->adjustment)
                                            ({{number_format(($recurring_invoice->total_amount - $recurring_invoice->adjustment - $sub_total)*100/$sub_total,2)}}%)

                                            @else
                                            ({{number_format(($recurring_invoice->total_amount - $sub_total)*100/$sub_total,2)}}%)
                                            @endif
                                            </td>
                                            <td class="uk-text-center ">@if(($recurring_invoice->shipping_charge>0) && ($recurring_invoice->adjustment))
                                            {{number_format($recurring_invoice->total_amount - $sub_total -$recurring_invoice->shipping_charge-$recurring_invoice->adjustment,2)}}

                                            @elseif($recurring_invoice->shipping_charge>0)
                                            {{number_format($recurring_invoice->total_amount - $sub_total -$recurring_invoice->shipping_charge,2)}}

                                            @elseif($recurring_invoice->adjustment)
                                            {{number_format($recurring_invoice->total_amount - $recurring_invoice->adjustment - $sub_total,2)}}


                                            @else
                                            {{number_format($recurring_invoice->total_amount - $sub_total,2)}}
                                            @endif
                                            </td>
                                            @endif
                                        </tr>

                                        @if($recurring_invoice->shipping_charge>0)
                                            <tr class="uk-table-middle">
                                                <td class=""></td>
                                                <td class=""></td>
                                                @if($invoice_discount_count>0)<td class=""></td>@endif
                                                <td class="uk-text-center ">Shipping Charge</td>
                                                <td class="uk-text-center ">{{ $recurring_invoice->shipping_charge }}</td>
                                            </tr>
                                        @endif

                                        @if($recurring_invoice->adjustment > 0 || $recurring_invoice->adjustment < 0)
                                            <tr class="uk-table-middle">
                                                <td class="">

                                                </td>
                                                <td class=""></td>
                                                @if($invoice_discount_count>0)<td class=""></td>@endif
                                                <td class="uk-text-center ">Adjustment</td>
                                                <td class="uk-text-center ">{{ $recurring_invoice->adjustment }}</td>
                                            </tr>
                                        @endif

                                        <tr class="uk-table-middle">
                                            <td class=""></td>
                                            <td class="uk-text-center" ><b>(Total {{ucfirst($numberTransformer->toWords($recurring_invoice->total_amount))}} BDT Only)</b></td>
                                            @if($invoice_discount_count>0)<td class=""></td>@endif
                                            <td class="uk-text-center ">Total</td>
                                            <td class="uk-text-center ">{{ $recurring_invoice->total_amount }}</td>
                                        </tr>
                                        @if($recurring_invoice->vat_adjustment)
                                        <tr class="uk-table-middle">
                                            <td class=""></td>
                                            <td class=""></td>
                                            @if($invoice_discount_count>0)<td class=""></td>@endif
                                            <td class="uk-text-center ">Vat Adjustment</td>
                                            <td class="uk-text-center ">{{ $recurring_invoice->vat_adjustment }}</td>
                                        </tr>
                                        @endif
                                        @if($recurring_invoice->tax_adjustment)
                                        <tr class="uk-table-middle">
                                            <td class=""></td>
                                            <td class=""></td>
                                            @if($invoice_discount_count>0)<td class=""></td>@endif
                                            <td class="uk-text-center ">Tax Adjustment</td>
                                            <td class="uk-text-center ">{{ $recurring_invoice->tax_adjustment }}</td>
                                        </tr>
                                        @endif
                                        @if($recurring_invoice->others_adjustment)
                                        <tr class="uk-table-middle">
                                            <td class=""></td>
                                            <td class=""></td>
                                            @if($invoice_discount_count>0)<td class=""></td>@endif
                                            <td class="uk-text-center ">Other Adjustments</td>
                                            <td class="uk-text-center ">{{ $recurring_invoice->others_adjustment }}</td>
                                        </tr>
                                        @endif

                                        <tr class="uk-table-middle">
                                            <td class=""></td>
                                            <td class=""></td>
                                            @if($invoice_discount_count>0)<td class=""></td>@endif
                                            <td class="uk-text-center " style="background: #efefef">Total Paid</td>
                                            <td class="uk-text-center " style="background: #efefef">{{ ($recurring_invoice->total_amount - ($recurring_invoice->vat_adjustment + $recurring_invoice->tax_adjustment + $recurring_invoice->others_adjustment + $recurring_invoice->due_amount)) }}</td>
                                        </tr>

                                        <tr class="uk-table-middle">
                                            <td class=""></td>
                                            <td class=""></td>
                                            @if($invoice_discount_count>0)<td class=""></td>@endif
                                            <td class="uk-text-center " style="background: #efefef">Balance Due</td>
                                            <td class="uk-text-center " style="background: #efefef">{{ $recurring_invoice->due_amount }}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">

                                    <span class="uk-text-muted uk-text-small uk-text-italic">Notes: <span class="uk-text-small"><?php echo nl2br($recurring_invoice->customer_note); ?></span></span>

                                </div>
                            </div>

                            <div class="uk-grid">

                                <div class="uk-width-1-2" style="text-align: left">
                                    <p  class="uk-text-small uk-margin-bottom">Authorised Signature and Date</p>
                                </div>
                                <div class="uk-width-1-2" style="text-align: right">
                                    <p class="uk-text-small uk-margin-bottom">Payee Signature and Date</p>
                                </div>
                            </div>
                             <div class="uk-grid">
                                <div class="uk-width-1-2">
                                    <p class="uk-text-small uk-margin-bottom"></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>

        </div>
    <!-- Create Item Modal -->
        <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 50px">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Stock Unavailable</h4>
                    </div>
                    <form action="{!! route('adding_stock',$recurring_invoice->id) !!}" method="post">
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
                    <form action="{!! route('adding_stock',$recurring_invoice->id) !!}" method="post">
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
                $('#recurring_invoices_index').addClass('act_item');

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
