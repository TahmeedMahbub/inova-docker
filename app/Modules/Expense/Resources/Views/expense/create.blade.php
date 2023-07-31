@extends('layouts.main')

@section('title', 'Expense')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style media="screen">
        span.select2-container {
            z-index: 30 !important;
        }

        input {
            margin-top: 8px;
        }
    </style>
@endsection
@section('angular')
    <script src="{{ url('app/moneyout/bill/bill.module.js') }}"></script>
    <script src="{{ url('app/moneyout/bill/expense.controller.js') }}"></script>
@endsection

@section('content')
    <div class="uk-grid" ng-controller="ExpenseController">
        <div class="uk-width-large-10-10">
            {!! Form::open([
                'url' => route('expense_store'),
                'method' => 'POST',
                'class' => 'user_edit_form',
                'id' => 'my_profile',
                'files' => 'true',
                'enctype' => 'multipart/form-data',
                'novalidate',
            ]) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Expense</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="expense_date">Expense Date</label>
                                        <input class="md-input" type="text" id="expense_date" name="expense_date"
                                            value="{{ Carbon\Carbon::now()->format('d-m-Y') }}"
                                            data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="customer_name">Expense Account</label>
                                        <br>
                                        <select title="Select Customer" id="account_id" name="account_id"
                                            class="select2-single-search-dropdown" required>
                                            <option value="">Select Account</option>
                                            @foreach ($accounts as $accounts)
                                                <option value="{{ $accounts->id }}">{{ $accounts->account_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="amount">Amount</label>
                                        <input class="md-input" type="text" id="amount" ng-model="amount"
                                            name="amount" ng-keyup="calculateTax()"  oninput="createNote()"/>
                                        @if ($errors->first('amount'))
                                            <div class="uk-text-danger">Amount is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="customer_name">Select Tax</label> <br>
                                        <select id="tax_id" class="tax_id select2-single-search-dropdown" name="tax_id"
                                            ng-model="tax_id" ng-change="calculateTax()" required>

                                        </select>
                                        <!-- Tax Amount = @{{ total_tax | number: 2 }} BDT -->
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="customer_name">Amount Is</label> <br>
                                        <select id="amount_is" class="amount_is md-input select2-single-search-dropdown"
                                            name="amount_is" ng-model="amount_is" ng-change="calculateTax()" required>

                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="deposite_to">Paid Through</label> <br>
                                        <select id="paid_through_id"
                                            class="paid_through_id md-input select2-single-search-dropdown"
                                            name="paid_through_id" ng-model="paid_through_id" ng-change="getAccountType()"  onchange="paymentTypeChanged(); createNote();"
                                            required>
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-4" id="cheque_number_container" style="display:none;">
                                        <label for="cheque_number">Cheque Number</label> <br>
                                        <select name="cheque_number" id="cheque_number" class="md-input select2-single-search-dropdown"  onchange="createNote()">
                                            <option value="">Select a bank first!</option>
                                        </select>
                                        @if ($errors->has('cheque_number'))
                                            <span class="uk-text-danger">{{ $errors->first('cheque_number') }}</span>
                                        @endif
                                    </div>

                                    <div class="uk-width-medium-1-4" id="issue_date_container" style="display:none;">
                                        <label for="issue_date">Issue Date</label>
                                        <input class="md-input" type="text" id="issue_date"
                                            name="issue_date" value="{{ old("issue_date") }}" onchange="createNote()" data-uk-datepicker="{format:'DD-MM-YYYY'}"/>
                                        @if ($errors->has('issue_date'))
                                            <span class="uk-text-danger">{{ $errors->first('issue_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>

                                    @if ($errors->first('payment_mode_id'))
                                        <div class="uk-text-danger">Deposite is required.</div>
                                    @endif
                                    <div ng-if="account_type!=3" class="uk-width-medium-4-5" id="show">
                                        <label for="reference">Optional(Cash) Requeired(Undeposited Fund)</label>
                                        <input class="md-input" type="text" id="reference" name="bank_info" />
                                        @if ($errors->first('bank_info'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>
                                    <div style="margin-top: 30px" ng-if="account_type!=3" class="uk-width-medium-1-5"
                                        id="show">
                                        <input type="checkbox" checked id="invoice_show" name="invoice_show" />
                                        <label for="switch_demo_1" class="inline-label" id="show_invoice">Show In
                                            Invoice</label>
                                        @if ($errors->first('invoice_show'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-2-5">
                                        <label class="uk-vertical-align-middle" for="customer_name">Paid To</label><span><i
                                                style="color:red; font: 14px; " class="material-icons">stars</i></span>&nbsp
                                        <span class="uk-badge"><a style="color: white" data-toggle="uk-modal"
                                                data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit"
                                                class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create
                                                Contact</a></span><br>
                                        <select
                                            class="md-input select2-single-search-dropdown"data-uk-tooltip="{pos:'top'}"
                                            class="md-input select2-single-search-dropdown" title="Select Customer"
                                            id="customer_id" name="customer_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-3-5">
                                        <label for="reference">Enter Reference Number</label>
                                        <input class="md-input" type="text" id="reference" name="reference" />
                                    </div>
                                </div>
                                <div class="uk-grid hidden" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <label for="user_edit_uname_control">Attach Files: </label>
                                    </div>
                                    <div class="uk-width-medium-1-1">
                                        <div class="uk-form-file uk-text-primary"
                                            style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                            <p style="margin: 4px;">Uplaod File</p>
                                            <input onchange="uploadLavel()" id="form-file" type="file"
                                                name="file1">
                                        </div>
                                    </div>
                                    <p id="upload_name"></p>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <label for="customer_note">Customer note</label>
                                        <textarea class="md-input" id="customer_note" name="customer_note">Amount: 0 TK, Via Cash</textarea>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <div class="md-card">
                                            <div class="md-card-content">
                                                <h3 class="heading_a uk-margin-small-bottom">
                                                    Upload File
                                                </h3>
                                                <input class="dropify" type="file" name="file1"
                                                    id="input-file-a" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button type="submit"
                                            class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"
                                            name="submit">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        function createNote(){
            var issue_date      = $("#issue_date").val() || "";
            var amount          = $("#amount").val() || 0;
            var paid_through_id = $("#paid_through_id").val() || 3;
            var cheque_number   = $("#cheque_number").val();
            var acc_name = "";
            $.ajax({
                type: "GET",
                url: "../api/manual-journal/account-by-id/"+paid_through_id,
                success: function (response1) {
                    acc_name = response1.account_name;
                    
                    if(paid_through_id == 3)
                    {
                        var note            = "Amount: "+amount+" TK, Via Cash";
                    }
                    else if(cheque_number === undefined || cheque_number == null)
                    {
                        var note            = "Amount: "+amount+" TK "+ (issue_date != "" ? " on "+issue_date : "" )+ ", Via "+acc_name;
                    }
                    else
                    {
                        var note            = "Amount: "+amount+" TK, using Cheque Number: "+cheque_number + (issue_date != "" ? "  on "+issue_date : "" )+ ", from "+acc_name;
                    }
                    
                    $("#customer_note").empty();
                    $("#customer_note").append(note);
                }
            });
        }
        function paymentTypeChanged(){
            if($('#paid_through_id option:selected').val() != 3){
                var url = "{{ route('available_cheque_number', ['id' => ':id']) }}";
                url = url.replace(':id', $('#paid_through_id option:selected').val());
                $.ajax({
                    type: "get",
                    url: url,
                    success: function (response) {
                        $("#cheque_number").empty();
                        option_html = "";
                        $.each(response.data, function (index, chequePage) {
                            option_html += '<option value="'+chequePage+'">'+chequePage+'</option>';
                        });
                        $("#cheque_number").append(option_html);

                        
                        var amount          = $("#amount").val() || 0;
                        var paid_through_id = $("#paid_through_id").val() || 3;
                        var issue_date      = $("#issue_date").val() || "";
                        var acc_name = "";
                        $.ajax({
                            type: "GET",
                            url: "../api/manual-journal/account-by-id/"+paid_through_id,
                            success: function (response1) {
                                acc_name = response1.account_name;
                                if(paid_through_id == 3)
                                {
                                    var note            = "Amount: "+amount+" TK, Via Cash";
                                }
                                else if(Object.values(response.data)[0] === undefined || Object.values(response.data)[0] == null)
                                {
                                    var note            = "Amount: "+amount+" TK, "+ (issue_date != "" ? " on "+issue_date : "" )+ " Via "+acc_name;
                                }
                                else
                                {
                                    var note            = "Amount: "+amount+" TK, "+ (issue_date != "" ? " on "+issue_date : "" )+ " using Cheque Number: "+Object.values(response.data)[0]+", from "+acc_name;
                                }
                                
                                $("#customer_note").empty();
                                $("#customer_note").append(note);
                            }
                        });
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

        function uploadLavel() {
            var fullPath = document.getElementById('form-file').value;
            var upload_file_name_ = document.getElementById('upload_name');
            if (fullPath) {
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }

                upload_file_name_.innerHTML = filename;

            }
        }
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_expense').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        });

        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
