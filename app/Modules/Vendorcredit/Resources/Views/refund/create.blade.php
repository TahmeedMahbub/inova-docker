@extends('layouts.main')

@section('title', 'Refund Vendor Credit')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Refund Vendor Credit</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            {!! Form::open(['url' => route('vendor_credit_refund_store'), 'method' => 'POST', 'id' => 'my_profile']) !!}
                                <div class="uk-margin-top">

                                    <input type="hidden" name="vendor_credit_id" value="{{ $vendor_credit_id }}">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                          <label  for="date">Vendor Credit Note Date</label>
                                            <input class="md-input" type="text" id="date" name="date"  value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD.MM.YYYY'}" required>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label class="" for="amount">Amount</label>
                                            <?php $total_payment = 0; ?>
                                            <?php $refund        = 0; ?>

                                            @foreach($vendor_credit->vendorCreditPayments as $payment)
                                               <?php $total_payment = $total_payment + (float)$payment->amount; ?>
                                            @endforeach
                                            @foreach($vendor_credit->vendorCreditRefunds as $refunds)
                                                <?php $refund = $refund + (float)$refunds->amount ?>
                                            @endforeach
                                            

                                            <input class="md-input" type="text" id="amount" name="amount" value="{{ $vendor_credit->total - $total_payment - $refund }}" required/>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label for="reference">Enter Reference Number</label>
                                            <input class="md-input" type="text" id="reference" name="reference" required/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                          <label  for="payment_mode">Payment Mode</label> <br>
                                            <select title="Select Payment Mode" id="payment_mode" name="payment_mode_id" class="md-input select2-single-search-dropdown" required>
                                                @foreach($payment_modes as $payment_mode)
                                                    <option value="{{ $payment_mode->id }}">{{ $payment_mode->mode_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="uk-width-medium-1-2">
                                          <label class="uk-vertical-align-middle" for="account">Account</label> <br>
                                            <select  title="Select Account" id="account" name="account_id" class="md-input select2-single-search-dropdown" required>
                                                <optgroup label="Cash">
                                                    @foreach($accounts as $account)
                                                        <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
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
        $('#sidebar_main_account').addClass('current_section');
        $('#vendor_credit_index').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });
    </script>

    <script>
        var app = angular.module('app', []);
    </script>

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
