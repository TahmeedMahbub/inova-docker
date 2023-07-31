@extends('layouts.main')

@section('title', 'Payment Receive')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style type="text/css">
        input{
            margin-top: 10px;
        }
    </style>
@endsection

@section('angular')
    <script src="{{url('app/moneyin/invoice/paymentReceive.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" ng-controller="PaymentReceiveController">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Receive New Payment</span></h2>
                            </div>
                        </div>

                        <div class="md-card">
                            <form  method="POST" action="{{ route('payment_received_store') }}" accept-charset="UTF-8" name="myform" onsubmit="return formsubmit()" class="payment_form_class_uniq" id="my_profile" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             <input id="actionUrl" type="hidden" value="{{ route('payment_received_store') }}">
                            <div class="user_content" >
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="customer_name">Customer Name</label><br>
                                            <select
                                                    id="customer_id"
                                                    class="md-input select2-single-search-dropdown customer_id"
                                                    name="customer_id"
                                                    ng-model="customer_id"
                                                    ng-change="getCustomerInvoice()"
                                                    required>
                                            </select>
                                            <div ng-style="{opacity : ((currentPage == 0) && '0.2') || '1'}">
                                                @{{ customer.billing_street? customer.billing_street+',':'' }}
                                                @{{ customer.billing_city?customer.billing_city+',':''}}
                                                @{{ customer.billing_state?customer.billing_state+',':''}}
                                                @{{ customer.billing_zip_code?customer.billing_zip_code+',':''}}
                                                @{{ customer.billing_country?customer.billing_country:''}}
                                            </div>
                                        </div>

                                        <div ng-style="{opacity : ((currentPage == 0) && '0.2') || '1'}" class="uk-width-medium-1-3">
                                            <label for="amount">Amount</label>
                                            <input class="md-input" type="text" id="amount" ng-model="amount" name="amount" onkeypress="numbervalidate()" ng-readonly="truefalse" ng-keyup="amountReceived()" />
                                                @if($errors->first('amount'))
                                                    <div class="uk-text-danger">Amount is required.</div>
                                                @endif
                                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light hidden" ng-init="vat_dropdown=0" ng-click="vat_dropdown?vat_dropdown=0:vat_dropdown=1">+ Advanced</a>

                                            <div class="md-card uk-margin-top uk-margin-bottom" data-uk-grid-margin style="margin: 5px auto;" ng-show="vat_dropdown">
                                                <div class="uk-margin-top" style="padding-bottom: 20px;">

                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-4-10 uk-vertical-align uk-text-center">
                                                                <label class="uk-vertical-align-middle" for="vat_adjust">Vat Adjustment</label>
                                                            </div>
                                                            <div class="uk-width-medium-5-10">
                                                                <input class="md-input" type="text" id="vat_adjust" ng-model="vat_adjust" onkeypress="numbervalidate()"  name="vat_adjust" ng-init="vat_adjust=0" ng-readonly="truefalse" ng-keyup="vat()" />
                                                                @if($errors->first('vat_adjust'))
                                                                    <div class="uk-text-danger">Amount is required.</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-4-10 uk-vertical-align uk-text-center">
                                                                <label class="uk-vertical-align-middle" for="tax_adjust">Tax Adjustment</label>
                                                            </div>
                                                            <div class="uk-width-medium-5-10">
                                                                <input class="md-input" type="text" id="tax_adjust" ng-model="tax_adjust" name="tax_adjust" onkeypress="numbervalidate()"  ng-init="tax_adjust=0" ng-readonly="truefalse" ng-keyup="tax()" />
                                                                @if($errors->first('tax_adjust'))
                                                                    <div class="uk-text-danger">Amount is required.</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-4-10 uk-vertical-align uk-text-center">
                                                                <label class="uk-vertical-align-middle" for="other_adjust">Others Adjustment</label>
                                                            </div>
                                                            <div class="uk-width-medium-5-10">
                                                                <input class="md-input" type="text" id="other_adjust" ng-model="other_adjust" name="other_adjust" onkeypress="numbervalidate()" ng-init="other_adjust=0" ng-readonly="truefalse" ng-keyup="other()" />
                                                                @if($errors->first('other_adjust'))
                                                                    <div class="uk-text-danger">Amount is required.</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                </div>

                                            </div>
                                        </div>

                                        <div ng-style="{opacity : ((currentPage == 0) && '0.2') || '1'}" class="uk-width-medium-1-3">
                                            <label for="payment_date">Payment Date</label>
                                            <input class="md-input" type="text" id="payment_date" name="payment_date" value="{{ date('d-m-Y') }}"  data-uk-datepicker="{format:'DD-MM-YYYY'}" />

                                            @if($errors->first('payment_date'))
                                                <div class="uk-text-danger">Date is required.</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div ng-style="{opacity : ((currentPage == 0) && '0.2') || '1'}" class="uk-grid disabled" data-uk-grid-margin id="disabled">
                                        <div class="uk-width-medium-2-4">
                                            <label for="deposite_to">Deposit To</label><br>
                                            <select class="md-input select2-single-search-dropdown" id="account_id" name="account_id" required>
                                                @foreach($paid_receives as $paid_receives)
                                                    <option value="{{ $paid_receives->id }}">{{ $paid_receives->account_name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->first('account_id'))
                                                <div class="uk-text-danger">Deposit is required.</div>
                                            @endif
                                        </div>

                                        <div class="uk-width-medium-2-4">
                                            <label for="reference">Reference Number</label>
                                            <input class="md-input" type="text" id="reference" name="reference" autocomplete="off" oninput="autosuggest()" list="sub_refs"/>
                                            <datalist id="sub_refs" class="sub_ref"></datalist>
                                        </div>
                                    </div>

                                    <div ng-style="{opacity : ((currentPage == 0) && '0.2') || '1'}" class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <label for="customer_note">Customer note</label>
                                            <textarea rows="1" class="md-input" id="customer_note" name="note" ng-model="customer_note" ng-readonly="truefalse"></textarea>
                                        </div>
                                    </div>

                                    <div ng-style="{opacity : ((currentPage == 0) && '0.2') || '1'}" class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div style="color:sandybrown">
                                                <div ng-show="vatadjustbool">
                                                  <li> <span style="color:black;">&#9830;</span> @{{ vatadjustmentmsg }}</li>
                                                </div>
                                                <div ng-show="taxadjustbool">
                                                <li> <span style="color:black;">&#9830;</span> @{{ taxadjustmentmsg }}</li>
                                                </div>
                                                <div ng-show="otheradjustbool">
                                                <li> <span style="color:black;">&#9830;</span> @{{ otheradjustmentmsg }}</li>
                                                </div>
                                        </div>

                                        <div class="uk-width-medium-1-1 table-responsive">
                                            <table class="uk-table table">
                                                <thead>
                                                <tr>
                                                    <th class="uk-text-nowrap">Date</th>
                                                    <th class="uk-text-nowrap">Invoice Number</th>
                                                    <th class="uk-text-nowrap">Invoice Amount</th>
                                                    <th class="uk-text-nowrap">Due Amount</th>
                                                    <th class="uk-text-nowrap hidden">Vat Adjustment</th>
                                                    <th class="uk-text-nowrap hidden">Tax Adjustment</th>
                                                    <th class="uk-text-nowrap hidden">Others Adjustment</th>
                                                    <th class="uk-text-nowrap">Payment</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat="invoice in invoices track by $index" class="form_section" >
                                                    <td>@{{ invoice.invoice_date }}</td>
                                                    <td>INV-@{{ invoice.invoice_number }}</td>
                                                    <td>@{{ invoice.total_amount}}</td>
                                                    <td >@{{ invoice.due_amount-vat_adjust_des[$index]-tax_adjust_des[$index]-other_adjust_des[$index] }}</td>
                                                    <td class="hidden">
                                                        <input type="text" id="vat_adjust_des_@{{ $index }}" name="vat_adjust_des[]" ng-model="vat_adjust_des[$index]" ng-keyup="calculateAdjustment($index)" class="md-input payment_vat_adjust_des" />
                                                    </td>
                                                    <td class="hidden">
                                                        <input type="text" id="tax_adjust_des_@{{ $index }}" name="tax_adjust_des[]" ng-model="tax_adjust_des[$index]" ng-keyup="calculateAdjustmentTax($index)"  class="md-input payment_tax_adjust_des" />
                                                    </td>
                                                    <td class="hidden">
                                                        <input type="text" id="other_adjust_des_@{{ $index }}" name="other_adjust_des[]" ng-model="other_adjust_des[$index]" ng-keyup="calculateAdjustmentOther($index)"  class="md-input payment_other_adjust_des" />
                                                    </td>
                                                    <td>
                                                        <input type="text" id="invoice_amount_@{{ $index }}" name="invoice_amount[]" value="0" ng-model="invoice_amount[$index]" ng-keyup="calculateAdjustmentPayment($index)" class="md-input payment_original_adjust_des"/>
                                                    </td>
                                                    <input type="hidden" id="invoice_id_@{{ $index }}" name="invoice_id[]" ng-model="invoice_id[$index]" value="@{{ invoice.id }}">
                                                </tr>
                                                </tbody>
                                                 <tfoot>
                                                    <th class="uk-text-nowrap uk-text-bold uk-text-right"
                                                        colspan="3"><b>Total Due Amount: @{{ total_due_amount }}</b></th>  
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div ng-style="{opacity : ((currentPage == 0) && '0.2') || '1'}" class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3 uk-width-small-1-1 col-xs-12 uk-margin-medium-top">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="user_edit_uname_control">Attach Files: </label>
                                                </div>
                                                <div class="uk-width-medium-1-1 uk-margin-top">
                                                    <div class="uk-form-file uk-text-primary"
                                                         style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                                        <p style="margin: 4px;">Upload File</p>
                                                        <input onchange="uploadLavel()"  id="file_name" name="file1" type="file">
                                                    </div>.
                                                </div>
                                                <p id="upload_name"></p>
                                            </div>
                                        </div>

                                        <div style="line-height: 5px;" class="uk-width-medium-2-3 uk-width-small-1-1 col-xs-6">
                                            <div class="uk-grid uk-padding-medium" data-uk-grid-margin>
                                                <div class="uk-width-medium-4-5 uk-width-small-1-2 col-xs-6">
                                                    <label class="uk-float-right">Amount Received: </label>
                                                </div>
                                                <div class="uk-width-medium-1-5 uk-width-small-1-2 col-xs-6">
                                                    <label class="uk-float-right">@{{ amount_received }}</label>
                                                </div>
                                            </div>

                                            <div class="uk-grid uk-padding-medium" data-uk-grid-margin>
                                                <div class="uk-width-medium-4-5 uk-width-small-1-2 col-xs-6">
                                                    <label class="uk-float-right">Used Amount: </label>
                                                </div>
                                                <div class="uk-width-medium-1-5 uk-width-small-1-2 col-xs-6">
                                                    <label class="uk-float-right">@{{ used_amount }}</label>
                                                </div>
                                            </div>

                                            <div class="uk-grid uk-padding-medium" data-uk-grid-margin>
                                                <div class="uk-width-medium-4-5 uk-width-small-1-2 col-xs-6">
                                                    <label class="uk-float-right">Excess Amount: </label>
                                                </div>
                                                <div class="uk-width-medium-1-5 uk-width-small-1-2 col-xs-6">
                                                    <label class="uk-float-right">@{{ excess_amount }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div ng-style="{opacity : ((currentPage == 0) && '0.2') || '1'}" class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                          </form>
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

    </script>

    <script>
        function formsubmit()
        {

           // if($(".ng-hide").length>=3)
           // {
           //     document.myform.submit();
           // }
           // return false;

           return true;
        }

        function uploadLavel()
        {
            var fullPath = document.getElementById('file_name').value;
            var upload_file_name_ = document.getElementById('upload_name');
            if (fullPath) {
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }

                upload_file_name_.innerHTML  = filename;

            }
        }

        function autosuggest()
        {

            $.get("{{ route('paxid_autosuggest') }}" , function(data){

                    $('.sub_ref').empty();
                    $.each(data , function(index , value){

                        $('.sub_ref').append("<option value='" + value.paxid + "'>");

                    });

                });
        }

    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
