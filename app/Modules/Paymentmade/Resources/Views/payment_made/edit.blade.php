@extends('layouts.main')

@section('title', 'Payment Made')

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
    <script src="{{url('app/moneyout/bill/paymentMadeEdit.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" ng-controller="PaymentMadeEditController">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">

                        <input type="hidden" ng-init="payment_made_id='asdfg'" value="{{$payment_made->id}}" name="payment_made_id" ng-model="payment_made_id">

                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Payment Made</span></h2>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('payment_made_update', ['id' => $payment_made->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data"]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="vendor_name">Vendor Name</label><br>
                                            <select readonly
                                                    id="vendor_id"
                                                    class="select2-single-search-dropdown vendor_id"
                                                    name="vendor_id"
                                                    ng-model="vendor_id"
                                                    required>
                                            </select>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label for="amount">Amount</label>
                                            <input class="md-input" type="text" id="amount" name="amount" ng-model="amount" value="{{$payment_made->amount}}" ng-keyup="amountReceived()" />
                                            @if($errors->first('amount'))
                                                <div class="uk-text-danger">Amount is required.</div>
                                            @endif
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label for="payment_date">Payment Date</label>
                                            <input class="md-input" type="text" id="payment_date" name="payment_date" value="{{date("d-m-Y",strtotime($payment_made->payment_date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" />

                                            @if($errors->first('payment_date'))
                                                <div class="uk-text-danger">Date is required.</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <label class="uk-vertical-align-middle" for="deposite_to">Paid Through</label><br>
                                            <select name="account_id" id="account_id1"
                                            class="md-input select2-single-search-dropdown"
                                            data-uk-tooltip="{pos:'top'}" title="Select Account" onchange="paymentTypeChanged()">
                                            <option value="" disabled selected hidden>Select...</option>
                                            @foreach($paid_throughs as $paid_through)
                                                <option data-account-type="{{ $paid_through->account_type_id }}" value="{{ $paid_through->id }}" {{ $paid_through->id == $payment_made->account_id ? 'selected' : '' }}>
                                                    {{ $paid_through->account_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>

                                        <div class="uk-width-medium-1-2">
                                            <label for="reference">Reference Number</label>
                                            <input class="md-input" type="text" id="reference" name="reference" value="{{ $payment_made->reference }}" />
                                        </div>
                                                        
                                        <div class="uk-width-medium-1-2 uk-margin-medium-top" id="cheque_number_container" style="{{ $payment_made->account->account_type_id == 5 ? '' : 'display:none' }}">
                                            <label for="cheque_number">Cheque Number</label>
                                            <input class="md-input" type="number" id="cheque_number"
                                                name="cheque_number" value="{{ $payment_made->cheque_number }}" readonly/>
                                        </div>

                                        <div class="uk-width-medium-1-2 uk-margin-medium-top" id="issue_date_container" style="{{ $payment_made->account->account_type_id == 5 ? '' : 'display:none' }}">
                                            <label for="issue_date">Issue Date</label>
                                            <input class="md-input" type="text" id="issue_date"
                                                name="issue_date" value="{{ !empty($payment_made->cheque_issue_date) ? date('d-m-Y', strtotime($payment_made->cheque_issue_date)) : "" }}" data-uk-datepicker="{format:'DD-MM-YYYY'}"/>
                                            @if ($errors->has('issue_date'))
                                                <span class="uk-text-danger">{{ $errors->first('issue_date') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div ng-style="{opacity : ((currentPage == 0) && '0.2') || '1'}" class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <label for="customer_note">Customer Note</label>
                                            <textarea rows="1" class="md-input" id="customer_note" name="note">{{ $payment_made->customer_note }}</textarea>
                                        </div>
                                    </div>


                                    <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div style="overflow:auto" class="uk-width-medium-1-1">
                                            <table class="uk-table" cellspacing="0" style="overflow:auto" width="100%">
                                                <thead>
                                                <tr>
                                                    <th class="uk-text-nowrap">Date</th>
                                                    <th class="uk-text-nowrap">Bill Number</th>
                                                    <th class="uk-text-nowrap">Bill Amount</th>
                                                    <th class="uk-text-nowrap">Due Amount</th>
                                                    <th class="uk-text-nowrap">Payment</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat="bill in bills track by $index" class="form_section" >
                                                    <td>@{{ bill.bill_date }}</td>
                                                    <td>@{{ bill.bill_number }}</td>
                                                    <td>@{{ bill.amount }}</td>
                                                    <td>@{{ bill.due_amount + bill.payment }}</td>
                                                    <td>
                                                        <input type="text" id="bill_amount_@{{ $index }}" name="bill_amount[]" ng-model="bill_amount[$index]" ng-keyup="calculateExcessPayment($index)" class="md-input"/>
                                                    </td>
                                                    <input type="hidden" id="bill_id_@{{ $index }}" name="bill_id[]" ng-model="bill_id[$index]" value="@{{ bill.id }}">
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3 uk-margin-medium-top">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="user_edit_uname_control">Attach Files: </label>
                                                    @if($payment_made->file_url)
                                                        <a download href="{{ url($payment_made->file_url) }}">download attachment </a>

                                                    @endif
                                                </div>
                                                <div class="uk-width-medium-1-1 uk-margin-top">
                                                    <div class="uk-form-file uk-text-primary"
                                                         style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                                        <p style="margin: 4px;">Upload File</p>
                                                        <input onchange="uploadLavel()" id="form-file" name="file1" type="file">
                                                    </div>
                                                </div>
                                                <p id="upload_name"></p>
                                            </div>
                                        </div>
                                        <div style="line-height: 5px" class="uk-width-medium-2-3">

                                            <div class="uk-grid uk-padding-medium" data-uk-grid-margin>
                                                <div class="uk-width-medium-4-5">
                                                    <label class="uk-float-right">Amount Paid: </label>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                    <label class="uk-float-right">@{{ amount_received }}</label>
                                                </div>
                                            </div>

                                            <div class="uk-grid uk-padding-medium" data-uk-grid-margin>
                                                <div class="uk-width-medium-4-5">
                                                    <label class="uk-float-right">Used Amount: </label>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                    <label class="uk-float-right">@{{ used_amount }}</label>
                                                </div>
                                            </div>

                                            <div class="uk-grid uk-padding-medium" data-uk-grid-margin>
                                                <div class="uk-width-medium-4-5">
                                                    <label class="uk-float-right">Excess Amount: </label>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                    <label class="uk-float-right">@{{ excess_amount }}</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <hr>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        function paymentTypeChanged()
        {
            if($('#account_id1 option:selected').data('account-type') == 5){
                var url = "{{ route('get_cheque_number', ['id' => ':id']) }}";
                url = url.replace(':id', $('#account_id1 option:selected').val());
                $.ajax({
                    type: "get",
                    url: url,
                    success: function (response) {
                        $('#cheque_number').val(response.data);
                    }
                });
                $('#cheque_number_container, #issue_date_container').show(800);
                $('#cheque_number_container, #issue_date_container').attr('required', true);
            }else{
                $('#cheque_number_container, #issue_date_container').hide(800);
                $('#cheque_number_container, #issue_date_container').attr('required', false);
                $('#cheque_number_container input, #issue_date_container input').val('');
            }
        }

        function uploadLavel()
        {
            var fullPath = document.getElementById('form-file').value;
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
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_payment_made').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
