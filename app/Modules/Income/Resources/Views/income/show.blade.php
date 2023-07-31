@extends('layouts.invoice')

@section('title', 'Income')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
    <script>
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_income').addClass('act_item');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
    </script>
@endsection

@section('styles')
    <style>

        #tiktok_table tr td{
            padding: 5px !important;
        }
        #tiktok_table tr td:nth-child(even){
            text-align: right;
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

                        <li class="heading_list">Recent Incomes</li>

                        @foreach($incomes as $income_val)
                        <li>
                            <a href="{{ url('/income/show'.'/'.$income_val->id) }}" class="md-list-content">
                                <span class="md-list-heading uk-text-truncate">{{ $income_val->customer->display_name }} <span class="uk-text-small uk-text-muted">({{ $income_val->created_at->format('d M Y') }})</span></span>
                                <span class="uk-text-small uk-text-muted">INC-{{ str_pad($income_val->income_number, 6, '0', STR_PAD_LEFT) }}</span>
                            </a>
                        </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ url('/income') }}">See All</a>
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
                                <span  id="status"></span>  <progress id="progressBar" value="0" max="100" style="float: left;margin-right: 15px; margin-top: 10px; height: 20px;width:300px; display: none;"></progress>
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
                                                <a href="{{ route('income_edit', ['id' => $income->id]) }}">Edit</a>
                                            </li>
                                            @if($income->file_url)
                                                <li>
                                                    <a id="print" download href="{{ url('income'.'/'.$income->file_url) }}">Attach File</a>
                                                </li>
                                            @endif

                                            <li>
                                                <a class="uk-text-danger" href="{{ route('income_delete', ['id' => $income->id]) }}">Delete</a>
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
                                        <h2 id="payemnt_rec" style=" border: 1px solid black; border-radius: 25px; padding-right: 35px" class="uk-align-center">INCOME RECEIPT</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-2-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Date:</span>
                                    <span>{{date('d-m-Y', strtotime($income->date))}}</span>
                                </div>

                                <div id="recieve" class="uk-width-small-1-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Code : </span>
                                    <span> #INC-{{ str_pad($income->income_number,6,'0',STR_PAD_LEFT) }}</span>
                                </div>

                                <div class="uk-width-small-5-5 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Received From : </span>
                                    <span> {{ $income->customer->display_name }}</span>
                                </div>

                                <div id="recieve" class="uk-width-small-1-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Received Through : </span>
                                    <span> {{ ' '.$income->accountReceiveThrough->account_name }}</span>
                                </div>

                                @if($income->receive_through_id != 3)
                                    <div class="uk-width-small-2-3 uk-row-first">
                                        <span style="font-size: 16px; font-weight: bold">Income Account : </span>
                                        <span> {{ $income->account->account_name }} </span>
                                    </div>

                                    <div id="recieve" class="uk-width-small-1-3 uk-row-first">
                                        <span style="font-size: 16px; font-weight: bold">Cheque : </span>
                                        <span> {{ ' '.$income->bank_info}}</span>
                                    </div>
                                @endif
                            </div>

                            <div style="margin-top: 0px" class="uk-grid">
                                <div id="recieve" class="uk-width-small-6-6 uk-row-first">

                                    <table id="info" class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle uk-text-center">
                                            <td class="no-border-bottom" style="font-weight: bold">Particulars</td>
                                            <td class="no-border-bottom" style="font-weight: bold">Amount (In BDT)</td>
                                        </tr>

                                        <tr class="uk-table-middle">
                                            <td class="uk-text-center">{{ $income->reference }}</td>
                                            <td class="uk-text-right">{{ $income->amount }}</td>
                                        </tr>

                                        <tr class="uk-table-middle">
                                            <td class=" no-border-bottom uk-text-right" style="font-weight: bold;">Total Received</td>
                                            <td class="no-border-bottom uk-text-right" style="font-weight: bold">{{ $income->amount }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div style="margin-top: 10px" class="uk-grid">
                                <div class="uk-width-small-2-2 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">In Words:</span><span>{{' '.ucfirst($numberTransformer->toWords($income->amount))}} BDT Only</span>
                                </div>
                            </div>

                            <br>

                            <div class="uk-grid">
                                <div class="uk-width-small-1-3 uk-row-first">
                                    <hr>
                                    <div class="uk-text-center">
                                        {{ 'Customer Signature' }}
                                    </div>
                                </div>
                                <div class="uk-width-small-1-3 uk-row-first">
                                    
                                    <div class="uk-text-center">
                                    </div>
                                </div>
                                <div class="uk-width-small-1-3 uk-row-first">
                                    <hr>
                                    <div class="uk-text-center">
                                        {{ 'Company Representative' }}
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
             _("status").innerHTML = Math.round(percent) + "% uploaded";
        }

        function completeHandler(event) {
             _("status").innerHTML = event.target.responseText;

            UIkit.modal.alert(event.target.responseText)
            _("progressBar").value = 100;
           // _("progressBar").style.display = "none";
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