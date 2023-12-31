@extends('layouts.main')

@section('title', 'Income')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{ url('app/moneyin/invoice/income.controller.js') }}"></script>
@endsection

@section('styles')
    <style type="text/css">
        input {
            margin-top: 10px;
        }

        span.select2-container {
            z-index: 30 !important;
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid" ng-controller="IncomeController">
        <div class="uk-width-large-10-10">
            {!! Form::open([
                'url' => route('income_store'),
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Income</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="income_date">Income Date<sup><i
                                                    style="color:red; font: 14px; "
                                                    class="material-icons">stars</i></sup></label>
                                        <!-- <label for="income_date">Select date</label> -->
                                        <input class="md-input" type="text" id="income_date" name="income_date"
                                            value="{{ Carbon\Carbon::now()->format('d-m-Y') }}"
                                            data-uk-datepicker="{format:'DD.MM.YYYY'}" required>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="customer_name">Income Account<sup><i
                                                    style="color:red; font: 14px; "
                                                    class="material-icons">stars</i></sup></label> <br>
                                        <select title="Select Customer" id="account_id"
                                            class="md-input select2-single-search-dropdown" name="account_id" required>
                                            <option value="">Select Account</option>
                                            @foreach ($accounts as $accounts)
                                                <option value="{{ $accounts->id }}">{{ $accounts->account_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="amount">Amount<sup><i
                                                    style="color:red; font: 14px; "
                                                    class="material-icons">stars</i></sup></label>
                                        <!-- <label for="amount">Enter Amount</label> -->
                                        <input class="md-input" type="text" id="amount" ng-model="amount"
                                            name="amount" ng-keyup="calculateTax()" />
                                        @if ($errors->first('amount'))
                                            <div class="uk-text-danger">Amount is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label class="uk-vertical-align-middle" for="customer_name">Select Tax</label> <br>
                                        <select id="tax_id" class="tax_id md-input select2-single-search-dropdown"
                                            name="tax_id" ng-model="tax_id" ng-change="calculateTax()" required>

                                        </select>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-6">
                                        <label class="uk-vertical-align-middle" for="customer_name">Amount Is</label><br>
                                        <select id="amount_is" class="amount_is md-input select2-single-search-dropdown"
                                            name="amount_is" ng-model="amount_is" ng-change="calculateTax()" required>

                                        </select>
                                    </div>

                                    <div class="uk-width-medium-2-6">
                                        <label class="uk-vertical-align-middle" for="deposite_to">Received
                                            Through</label><br>
                                        <select id="receive_through_id"
                                            class="receive_through_id md-input select2-single-search-dropdown"
                                            name="receive_through_id" ng-model="receive_through_id"
                                            ng-change="getAccountType()" required>
                                        </select>
                                    </div>

                                    @if ($errors->first('payment_mode_id'))
                                        <div class="uk-text-danger">Deposite is required.</div>
                                    @endif

                                    <div ng-if="account_type!=3" class="uk-width-medium-2-6" id="show">
                                        <label for="reference">Optional(Cash) Requeired(Undeposited Fund)</label>
                                        <input class="md-input" type="text" id="reference" name="bank_info" />
                                        @if ($errors->first('bank_info'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>

                                    <div ng-if="account_type!=3" class="uk-width-medium-1-6" id="show">
                                        <input type="checkbox" checked id="invoice_show" name="invoice_show" />
                                        <label for="switch_demo_1" class="inline-label" id="show_invoice">Show In
                                            Invoice</label>
                                        @if ($errors->first('invoice_show'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2">
                                        <label class="uk-vertical-align-middle" for="customer_name">Customer Name<sup><i
                                                    style="color:red; font: 14px; "
                                                    class="material-icons">stars</i></sup></label> &nbsp <span
                                            class="uk-badge"><a style="color: white" data-toggle="uk-modal"
                                                data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit"
                                                class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create
                                                Contact</a></span><br>
                                        <select data-uk-tooltip="{pos:'top'}"
                                            class="md-input select2-single-search-dropdown" title="Select Customer"
                                            id="customer_id" name="customer_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-2">
                                        <label for="reference">Enter Reference</label>
                                        <input class="md-input" type="text" id="reference" name="reference" />
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-5-5">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note">Customer note</label>
                                                <textarea class="md-input" id="customer_note" name="customer_note"></textarea>
                                            </div>
                                        </div>
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
                                        <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
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
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_income').addClass('act_item');

        $(window).load(function() {
            $("#tiktok_account").trigger('click');

        })
        altair_forms.parsley_validation_config();

        $('.select2-single-search-dropdown').select2();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
