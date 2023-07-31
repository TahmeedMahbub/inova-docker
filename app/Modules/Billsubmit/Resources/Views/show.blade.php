@extends('layouts.invoice')

@section('title', 'Bill Submit')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
    <script src="{{url('app/moneyout/bill/bill.module.js')}}"></script>
    <script src="{{url('app/moneyout/bill/bill.excessPayment.js')}}"></script>
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
        .bill-margin-top {
            margin-top: -10px !important;
        }
        address p{
            font-size: 12px !important;
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

                        <li class="heading_list">Recent Bills</li>

                        @foreach($bills as $bill_data)
                        <li>
                            <a href="{{ route('bill_show', ['id' => $bill_data->id]) }}" class="md-list-content">
                                <span class="md-list-heading uk-text-truncate">{{ isset($bill_data->customer->display_name) ? $bill_data->customer->display_name : '' }} <span class="uk-text-small uk-text-muted">{{ date('d-m-Y',strtotime($bill_data->date)) }}</span></span>
                            </a>
                        </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ route('bill_search_submit') }}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>

            <?php
            $helper = new \App\Lib\Helpers;
            ?>

            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions hidden-print">
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                </div>
                            </div>

                            <!-- <h3 class="md-card-toolbar-heading-text large" id="invoice_name">BILL-{{ $bill->bill_number }}</h3> -->
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                            @include('inc.alert')
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

                                  <p>@php echo nl2br($bill->customer->billing_address); @endphp</p>
                                  <p style="margin-top: -17px;">{{ $OrganizationProfile->email }}, {{ $OrganizationProfile->website }} ,{{ $OrganizationProfile->contact_number }}  </p>
                                </div>
                            @endif
                            <div class="uk-grid" data-uk-grid-margin>

                                <br>

                                <div class="uk-width-5-5" style="font-size: 12px;">
                                    <div class="uk-grid">
                                        <!-- <h2 style="text-align: center; width: 90%;" class="">BILL</h2> -->
                                        <!-- <p style="text-align: center; width: 90%;" class="uk-text-small uk-text-muted uk-margin-top-remove"># BILL-{{ str_pad($bill->bill_number, 6, '0', STR_PAD_LEFT) }} <br/> <b>{{ $bill->save?"Draft":'' }}</b></p> -->
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" name="invoice_id">

                            <div class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Bill From:</span>
                                        <address>
                                            <p><strong>{{ $bill->customer->display_name }}</strong></p>
                                            <p>@php echo nl2br($bill->customer->billing_address); @endphp</p>
                                            <p>{{ $bill->customer->phone_number_1 }}</p>

                                        </address>
                                    </div>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <table id="info" class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left no-border-bottom"> Date </td>
                                            <td class="uk-text-center no-border-bottom">{{ date('d-m-Y', strtotime($bill->date)) }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-left no-border-bottom">Due Date </td>
                                            <td class="uk-text-center no-border-bottom">{{ $due_date['due_date']  }}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                              <br>
                            <div class="uk-grid bill-margin-top">
                                <div class="uk-width-1-1">
                                    <table id="table_center" border="1" class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>SL.</th>
                                            <th>Particulars</th>
                                            <th class="uk-text-right">Qty</th>
                                            <th class="uk-text-right">Rate</th>
                                            <th class="uk-text-right">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @php
                                            $i = 1;
                                        @endphp

                                        @foreach($bill_entries as $bill_entry)
                                        <tr class="uk-table-middle">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $bill_entry->item->subject_name }} @if($bill_entry['description']) ({{ $bill_entry['description'] }}) @endif </td>
                                            <td class="uk-text-right">{{ $bill_entry->quantity.' '.$bill_entry->item['unit_type'] }}</td>
                                            <td class="uk-text-right">{{ $bill_entry->rate }}</td>
                                            <td class="uk-text-right">{{ $bill_entry->amount }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Sub Total</td>
                                            <td class="uk-text-right no-border-bottom">{{ $sub_total }}</td>
                                        </tr>
                                        @if($bill->total_tax>0)
                                        <tr class="uk-table-middle hidden">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Tax</td>
                                            <td class="uk-text-right no-border-bottom">{{ $bill->total_tax }}</td>
                                        </tr>
                                        @endif
                                        <tr class="uk-table-middle">
                                            @if($bill->shipping_charge)
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right">
                                            Vat
                                            @if($bill->shipping_charge>0)
                                            ({{number_format(($bill->amount - $sub_total -$bill->shipping_charge)*100/$sub_total,2)}}%)
                                            @else
                                            ( {{number_format(($bill->amount - $sub_total)*100/$sub_total,2)}}% )
                                            @endif

                                            </td>
                                            <td class="uk-text-right">
                                            @if($bill->shipping_charge>0)
                                            {{ number_format($bill->amount - $sub_total -$bill->shipping_charge,2) }}
                                            @else
                                            {{ number_format($bill->amount - $sub_total,2) }}
                                            @endif
                                            </td>
                                            @endif
                                        </tr>

                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Total</td>
                                            <td class="uk-text-right no-border-bottom">{{ $bill->amount }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">Balance Due</td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">{{ $bill->due_amount }} BDT</td>
                                        </tr>
                                        <tr class="uk-table-middle">

                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">Total Paid</td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">{{ ($bill->amount - $bill->due_amount) }} BDT</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">

                                    <span class="uk-text-muted uk-text-small uk-text-italic">Notes: <span class="uk-text-small"><?php echo nl2br($bill->note); ?></span></span>

                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-1-2" style="text-align: left">
                                    <p class="uk-text-small uk-margin-bottom">Authorised Signature with Date</p>
                                </div>
                                <div class="uk-width-1-2" style="text-align: right">
                                    <p class="uk-text-small uk-margin-bottom">Vendor Signature with Date</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>
@endsection

@section('sweet_alert')
    <script>
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
             _("status").innerHTML = event.target.responseText;

           // UIkit.modal.alert(event.target.responseText)
            _("progressBar").value = 100;
            _("progressBar").style.display = "block";
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
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_bill_submit').addClass('act_item');
        $(window).load(function(){
          $("#tiktok_account").trigger('click');
        });

        $('.delete_btn').click(function () {
            var id = $(this).next('.payment_made_entry_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/payment-made/delete-payment-made-entry/"+id;
            })
        })

    </script>
@endsection
