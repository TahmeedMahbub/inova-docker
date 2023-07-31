@extends('layouts.invoice')

@section('title', 'Show Vendor Credit')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        #table_center th,td{
            border-color: black !important;

        }
        table#info{
            font-size: 12px !important;
            line-height: 2px;
            border: 1px solid black !important;

            float:right;
        }
        table#info tr td{
            border: 1px solid black !important;
        }
        table#info tr{
            padding: 0px;
            border: 1px solid black !important;
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

                        <li class="heading_list">Recent Vendor Credit</li>

                        @foreach($vendor_credits as $vendor_credit_data)
                        <li>
                            <a href="{{ route('vendor_credit_show', ['id' => $vendor_credit_data->id]) }}" class="md-list-content">
                                <span class="md-list-heading uk-text-truncate">
                                   VC-
                                    <span class="uk-text-small uk-text-muted">({{ date('d-m-Y',strtotime($vendor_credit_data->vendor_credit_date )) }})</span>
                                </span>
                            </a>
                        </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ route('vendor_credit_index') }}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>
            
            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions hidden-print">

                                <span  style="display: none;" id="loaded_n_total"></span>
                                <span id="status"></span> <progress id="progressBar" value="0" max="100" style="float: left;margin-right: 15px; margin-top: 10px; height: 20px;width:300px; display: none;"></progress>
                                <div  style="float: left;margin-right: 15px; height: 14px;" class="uk-form-file md-btn md-btn-wave-light">
                                    Upload file
                                    <input name="file1" id="file1" type="file" onchange="uploadFile()">
                                </div>
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown" aria-hidden="true">
                                        <ul class="uk-nav">
                                            <li>
                                                <a href="#">Edit</a>
                                            </li>
                                            @if($vendor_credit->file_url)
                                                <li>
                                                    <a download href="{{ url($vendor_credit->file_url) }}">Attach File</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('vendor_credit_refund_create', ['id' => $vendor_credit->id]) }}">Refund</a>
                                            </li>
                                            <li>
                                                <a class="uk-text-danger" href="#">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">#VC-{{ $vendor_credit->vendor_credit_number }}</h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                            @inject('theader', '\App\Lib\TemplateHeader')
                            @if($theader->getBanner()->headerType)
                                <div class="" style="text-align: center;">

                                    <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                            <div class="uk-grid" data-uk-grid-margin style="text-align: center; margin-top:50px;">
                                <h1 style="width: 100%; text-align: center;"><img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> <br>
                                   {{ $OrganizationProfile->company_name }}</h1>
                            </div>
                            <div class="" style="text-align: center;">

                              <p>@php echo nl2br(isset($vendor_credit->vendor->billing_address) ? $vendor_credit->vendor->billing_address : '' ); @endphp</p>
                              <p style="margin-top: -17px;">{{ $OrganizationProfile->email }}, {{ $OrganizationProfile->website }} ,{{ $OrganizationProfile->contact_number }}  </p>
                            </div>
                            @endif
                            <div class="uk-grid" data-uk-grid-margin>

                                <div class="uk-width-5-5" style="font-size: 12px;">
                                    <div class="uk-grid">
                                        <h2 style="text-align: center; width: 90%;" class="">Vendor Credit</h2>
                                        <p style="text-align: center; width: 90%;" class="uk-text-small uk-text-muted uk-margin-top-remove"># VC-{{ str_pad($vendor_credit->vendor_credit_no, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">

                                    <div class="uk-margin-bottom">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Bill To:</span>
                                        <address>
                                          <address>
                                             
                                              <p>{{isset($vendor_credit->vendor->billing_address) ? $vendor_credit->vendor->billing_address : '' }}</p>
                                              <p>{{isset($vendor_credit->vendor->phone_number_1) ? $vendor_credit->vendor->phone_number_1 : ''   }}</p>

                                          </address>
                                        </address>
                                    </div>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <table class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom">Vendor Credit Date :</td>
                                            <td class="uk-text-right no-border-bottom">{{ $vendor_credit->created_at->format('d M, Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table border="1" class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>#</th>
                                            <th>Product/Service </th>
                                            <th>Desc</th>
                                            <th class="uk-text-right">Qty</th>
                                            <th class="uk-text-right">Rate</th>
                                            <th class="uk-text-right">Discount(%)</th>
                                            <th class="uk-text-right">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($vendor_credit_entries as $vendor_credit_entry)
                                            <tr class="uk-table-middle">
                                                <td>{{ $i++ }}</td>

                                                <td>{{ $vendor_credit_entry->item->item_name }} @if($vendor_credit_entry->description)<br>{{$vendor_credit_entry->description}}@endif</td>
                                                <td>{{ $vendor_credit_entry['description'] }}</td>
                                                <td class="uk-text-right">{{ $vendor_credit_entry->quantity.' '.$vendor_credit_entry->item['unit_type'] }}</td>
                                                <td class="uk-text-right">{{ $vendor_credit_entry->rate }}</td>
                                                <td class="uk-text-right">{{ $vendor_credit_entry->discount }}%</td>
                                                <td class="uk-text-right">{{ $vendor_credit_entry->amount }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Sub Total</td>
                                            <td class="uk-text-right no-border-bottom">{{ $sub_total }}</td>
                                        </tr>

                                        @if($vendor_credit->tax_total>0)
                                            <tr class="uk-table-middle hidden">
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="uk-text-right no-border-bottom">Tax</td>
                                                <td class="uk-text-right no-border-bottom">{{ $vendor_credit->tax_total }}</td>
                                            </tr>
                                        @endif

                                        <tr class="uk-table-middle">
                                            @if($vendor_credit->shiping_charge>0)
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right ">Vat @if($vendor_credit->shiping_charge>0 && $vendor_credit->adjustment>0)
                                            ({{number_format(($vendor_credit->total_vendor_credit - $sub_total -$vendor_credit->shiping_charge-$vendor_credit->adjustment)*100/$sub_total,2)}}%)

                                            @elseif($vendor_credit->shiping_charge>0)
                                            ({{number_format(($vendor_credit->total_vendor_credit - $sub_total -$vendor_credit->shiping_charge)*100/$sub_total,2)}}%)

                                            @else
                                            ({{number_format(($vendor_credit->total_vendor_credit - $sub_total)*100/$sub_total,2)}}%)
                                            @endif
                                            </td>
                                            <td class="uk-text-right ">@if($vendor_credit->shiping_charge>0 && $vendor_credit->adjustment>0)
                                            {{number_format($vendor_credit->total_vendor_credit - $sub_total -$vendor_credit->shiping_charge-$vendor_credit->adjustment,2)}}
                                            @elseif($vendor_credit->shiping_charge>0)
                                            {{number_format($vendor_credit->total_vendor_credit - $sub_total -$vendor_credit->shiping_charge,2)}}


                                            @else
                                            {{number_format($vendor_credit->total_vendor_credit - $sub_total,2)}}
                                            @endif
                                            </td>
                                            @endif
                                        </tr>

                                        @if($vendor_credit->shiping_charge>0)
                                            <tr class="uk-table-middle">
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="uk-text-right no-border-bottom">Shipping Charge</td>
                                                <td class="uk-text-right no-border-bottom">{{ $vendor_credit->shiping_charge }}</td>
                                            </tr>
                                        @endif

                                        @if($vendor_credit->adjustment > 0 || $vendor_credit->adjustment < 0)
                                            <tr class="uk-table-middle">
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="uk-text-right no-border-bottom">Adjustment</td>
                                                <td class="uk-text-right no-border-bottom">{{ $vendor_credit->adjustment }}</td>
                                            </tr>
                                        @endif

                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Total</td>
                                            <td class="uk-text-right no-border-bottom">{{ $vendor_credit->total_vendor_credit }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">Balance Due</td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">BDT  {{ $vendor_credit->available_credit }}</td>
                                        </tr>
                                        </tbody>
                                        @if(!empty($vendor_credit->customer_note))
                                        <caption align="bottom"> Note: {{ $vendor_credit->customer_note }}</caption>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid">
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

                <div class="hidden-print">
                    <div class="uk-margin-large-top">
                        <h2 class="heading_b">Refund History</h2>
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
                                            <th>Payment Mode</th>
                                            <th class="uk-text-right">Amount Refunded</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 1;?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-margin-top">
                        <h2 class="heading_b">Applied Invoices</h2>
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
                                            <th>Invoice#</th>
                                            <th class="uk-text-right">Amount creditd</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 1;?>

                                        </tbody>
                                    </table>
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
    <script>

        $('#vendor_credit_index').addClass('act_item');

        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })

        $('.refund_delete_btn').click(function () {
            var id = $(this).next('.refund_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/credit-note/refund/delete/"+id;
            })
        });

        $('.payment_delete_btn').click(function () {
            var id = $(this).next('.payment_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/credit-note/delete/"+id;
            })
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
                _("progressBar").value = 0;
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
             _("status").innerHTML = event.target.responseText;

           // UIkit.modal.alert(event.target.responseText)
            _("progressBar").value = 100;
            _("progressBar").style.display = "block";
        }

        function errorHandler(event) {
             _("status").innerHTML = "Upload Failed";
            alert("Upload Failed");
            _("progressBar").style.display = "none";
        }

        function abortHandler(event) {
             _("status").innerHTML = "Upload Aborted";
            alert("Upload Aborted");
            _("progressBar").style.display = "none";
        }
    </script>
@endsection
