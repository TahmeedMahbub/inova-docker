@extends('layouts.invoice')

@section('title', 'Payment Received')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>

        #second_duplicate_page{
            display: none;
        }
        #table_center th,td{
            border-color: black !important;
            padding: 2px 2px !important;
            text-align: center !important;
        }
        table#info{
            margin-top: 10px;
            font-size: 12px !important;
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

        table#lasttable {
            font-size: 12px !important;
            border: 1px solid black !important;
            float:right;
        }
        table#lasttable tr td {
            border: 1px solid black !important;
        }
        table#lasttable tr {
            padding: 0px;
            border: 1px solid black !important;
        }

        .uk-grid+.uk-grid, .uk-grid-margin, .uk-grid>*>.uk-panel+.uk-panel {
            margin-top: 5px !important;
        }

        @media print {
            h1,p,h2 {
            }
            #second_duplicate_page{
                display: block;
                page-break-before: always;
            }
            #company_h{
                margin-top: 20px;
            }

            #table_center th,td{
                font-size: 13px;
            }

            #payemnt_rec{

            }
            #payemnt_code{
                position: relative;
            }

            #address_info{
                position: relative;
                top:-60px;

            }
            #recieve{
                position: relative;

            }
            #amount{
                font-size: 00px;
            }
            table#info{
                margin-top: 10px;
                font-size: 12px !important;
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

            table#lasttable {
                font-size: 12px !important;
                border: 1px solid black !important;
                float:right;
            }
            table#lasttable tr td {
                border: 1px solid black !important;
            }
            table#lasttable tr {
                padding: 0px;
                border: 1px solid black !important;
            }

            #excess_payment{
                position: relative;
                top:-100px;

            }
            #table_center{
                position: relative;
                top:-140px;

            }
            #look{
                position: relative;

            }
            body{
                margin-top: -50px;
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

                        <li class="heading_list">Recent Payments</li>
                        @foreach($paymentreceives as $data)
                            @if($data->id == $paymentreceive->id)
                                <?php $active_class = 'md-list-item-active'?>
                            @else
                                <?php $active_class = ''?>
                            @endif
                            <li class="{{$active_class}}">
                                <a href="{{ route('payment_received_show', ['id' => $data->id]) }}" class="md-list-content" type="button">
                                <span class="md-list-heading uk-text-truncate">{{$data->paymentContact->display_name}}</br>
                                    <span class="uk-text-small uk-text-muted">{{ date('d-m-Y', strtotime($data->payment_date)) }}, {{ $data->account_id == 3 ? 'CR' : 'BR' }}-{{ $data->pr_number }}</span>
                                </span>
                                </a>
                            </li>

                        @endforeach
                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{route('payment_received')}}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>


            <div class="uk-width-large-8-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">

                        <div class="md-card-toolbar hidden-print">
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
                                                <a href="{{ route('payment_received_edit', ['id' => $paymentreceive->id]) }}">Edit</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                            @inject('theader', '\App\Lib\TemplateHeader')
                            @inject('helper', '\App\Lib\Helpers')

                            {{--Here goes to banner--}}
                            @if($theader->getBanner()->headerType != null)
                                <div class="" style="text-align: center;">
                                    <img src="{{ asset($theader->getBanner()->file_url) }}">
                                </div>
                            @else
                                <div class="uk-grid" data-uk-grid-margin style="text-align: center;">
                                    <h1 id="company_h" style="width: 100%; text-align: center;"><img id="company" style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/> {{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="" style="text-align: center;">

                                    <p>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</p>

                                    <p style="margin-top: -17px;">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</p>
                                </div>
                            @endif


                            <div  class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-5-5" style="font-size: 12px;">
                                    <div class="uk-grid" style="text-align: center;">
                                        <h2 id="payemnt_rec" style=" border: 1px solid black; border-radius: 25px; padding-right: 35px" class="uk-align-center">MONEY RECEIPT</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-2-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Date:</span><span>  {{date('d-m-Y', strtotime($paymentreceive->payment_date))}}</span>
                                </div>
                                <div id="recieve" class="uk-width-small-1-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Transaction Number:</span><span>  {{ $paymentreceive->account_id == 3 ? 'CR' : 'BR' }}-{{ str_pad($paymentreceive->pr_number, 6, '0', STR_PAD_LEFT) }} </span>
                                </div>
                            </div>


                            <div class="uk-grid">
                                <div class="uk-width-small-5-5 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Recevied From: </span><span>{{ $paymentreceive->paymentContact->display_name }}</span>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div id="recieve" class="uk-width-small-1-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Deposit To:</span><span>{{ ' '.$paymentreceive->account->account_name }}</span>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-2-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Reference:</span><span> {{ $paymentreceive->reference }} </span>
                                </div>

                                @if($paymentreceive->payment_mode_id == 2)
                                    <div id="recieve" class="uk-width-small-1-3 uk-row-first">
                                        <span style="font-size: 16px; font-weight: bold">Cheque:</span><span>{{ ' '.$paymentreceive->bank_info}}</span>
                                    </div>
                                @endif

                            </div>

                            <div class="uk-grid">
                                <div id="recieve" class="uk-width-small-6-6 uk-row-first">

                                    <?php $amount = $paymentreceive->amount;?>
                                    <?php $totalAmount = 0;?>

                                    <table id="info" class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom" style="font-weight: bold">Invoices</td>
                                            <td class="no-border-bottom" style="font-weight: bold">Amount (In BDT)</td>
                                        </tr>

                                        <?php $paymentRcvEntryData = $paymentreceive->PaymentReceiveEntryData; ?>

                                        @foreach($paymentRcvEntryData as $entryData)
                                            <tr class="uk-table-middle">
                                                <td>
                                                    INV-{{ $entryData->invoice->invoice_number }}
                                                </td>
                                                <td class="uk-text-right">{{ number_format($entryData->amount, 2, '.', ',') }}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="uk-table-middle">
                                            <td class=" no-border-bottom uk-text-right" style="font-weight: bold;">Total Received</td>
                                            <td class="no-border-bottom uk-text-right" style="font-weight: bold">{{ number_format($paymentreceive->amount, 2, '.', ',') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-2-2 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">In Words:</span><span>{{' '.ucfirst($numberTransformer->toWords($paymentreceive->amount))}} BDT Only</span>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-2-2 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Note:</span><span>{{$paymentreceive->note}}</span>
                                </div>
                            </div>

                            <br>
                            <br>

                            <div class="uk-grid">
                                <div class="uk-width-small-1-5 uk-row-first">
                                    <hr>
                                    <div class="uk-text-center">
                                        {{ 'Prepared by' }}
                                    </div>
                                </div>
                                <div class="uk-width-small-1-5 uk-row-first">
                                    <hr>
                                    <div class="uk-text-center">
                                        {{ 'Received by' }}
                                    </div>
                                </div>
                                <div class="uk-width-small-1-5 uk-row-first">
                                    <hr>
                                    <div class="uk-text-center">
                                        {{ 'Checked by' }}
                                    </div>
                                </div>
                                <div class="uk-width-small-1-5 uk-row-first">
                                    <hr>
                                    <div class="uk-text-center">
                                        {{ 'Approved by' }}
                                    </div>
                                </div>
                                <div class="uk-width-small-1-5 uk-row-first">
                                    <hr>
                                    <div class="uk-text-center">
                                        {{ 'Posted by' }}
                                    </div>
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
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
        $('#sidebar_payment_recieve').addClass('act_item');

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
    </script>
@endsection
