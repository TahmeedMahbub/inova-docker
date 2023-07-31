@extends('layouts.invoice')

@section('title')
    {{ ($bank->type == 'Withdrawal')? 'Withdrawal' : 'Deposit' }}
@endsection

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @inject('theader', '\App\Lib\TemplateHeader')
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

        table#lasttable {
            font-size: 12px !important;
            border: 1px solid black !important;
            float:right;
        }
        table#lasttable tr td {
            border: 1px solid black !important;
            padding: 2px !important;
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


            <div class="uk-width-large-10-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">

                        <div class="md-card-toolbar hidden-print">
                            <div class="md-card-toolbar-actions hidden-print">

                                <span  style="display: none;" id="loaded_n_total"></span>
                                <span id="status"></span> <progress id="progressBar" value="0" max="100" style="float: left;margin-right: 15px; margin-top: 10px; height: 20px;width:300px; display: none;"></progress>
                                <i class="md-icon material-icons" id="invoice_print"></i>
                            </div>
                        </div>

                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                            @inject('theader', '\App\Lib\TemplateHeader')

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
                                        <h2 id="payemnt_rec" style=" border: 1px solid black; border-radius: 25px; padding-right: 35px" class="uk-align-center">{{ ($bank->type == 'Withdrawal')? 'WITHDRAWAL' : 'DEPOSIT' }}</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-2-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Date:</span><span>  {{date('d-m-Y', strtotime($bank->date))}}</span>
                                </div>
                                <div id="recieve" class="uk-width-small-1-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Voucher: </span><span>{{ "CN-".date("Y", strtotime($bank->date))."/".str_pad($bank->id, 6, 0, STR_PAD_LEFT) }}</span>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-2-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">{{ ($bank->type == 'Withdrawal')? 'Withdrawal' : 'Deposit' }} Amount:</span><span> <?php echo number_format((float)$bank->total_amount, 2, '.', '');?>  BDT  </span>
                                </div>
                                <div id="recieve" class="uk-width-small-1-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">{{ ($bank->type == 'Withdrawal')? 'Withdrawal' : 'Deposite' }} Mode:</span><span>{{ ' '.$payment_mode->account_name }}</span>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-2-3 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">Bank Name:</span><span> {{ $bank->contact->display_name }} </span>
                                </div>
                                <div id="recieve" class="uk-width-small-1-3 uk-row-first">
                                    @if($bank->cheque_number)
                                        <span style="font-size: 16px; font-weight: bold">Cheque: </span><span>{{ $bank->cheque_number }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div id="recieve" class="uk-width-small-6-6 uk-row-first">

                                    <?php $amount = '';?>
                                    <?php $totalAmount = 0;?>

                                    <table id="info" class="uk-text-center uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom" style="font-weight: bold">Particulars</td>
                                            <td class="no-border-bottom" style="font-weight: bold">Amount In(BDT)</td>
                                        </tr>

                                            <tr class="uk-table-middle">
                                                <td>
                                                    {{ $accounts->account_name }}
                                                    <br><br>
                                                    <br><br>
                                                    <br><br>
                                                    <br><br>
                                                    {{'('.$bank->particulars.')' }}
                                                </td>
                                                <td class="uk-text-right">{{ $bank->total_amount }}</td>
                                            </tr>

                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom uk-text-right" style="font-weight: bold">Total {{ ($bank->type == 'Withdrawal')? 'Withdrawal' : 'Deposite' }} </td>
                                            <td class="no-border-bottom uk-text-right" style="font-weight: bold">{{ $bank->total_amount }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-small-2-2 uk-row-first">
                                    <span style="font-size: 16px; font-weight: bold">In Words:</span><span>{{' '.ucfirst($numberTransformer->toWords($bank->total_amount))}} BDT Only</span>
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
            // _("status").innerHTML = "Upload Aborted";
            alert("Upload Aborted");
            _("progressBar").style.display = "none";
        }

        $('#sidebar_money_out').addClass('current_section');
        $('#sidebar_bank_bank').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection
