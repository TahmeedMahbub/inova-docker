@extends('layouts.main')

@section('title', 'Refund Credit Notes')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Refund Credit Note</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            {!! Form::open(['url' => route('credit_note_refund_store'), 'method' => 'POST', 'id' => 'my_profile']) !!}
                                <div class="uk-margin-top">

                                    <input type="hidden" name="credit_note_id" value="{{ $credit_note_id }}">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                          <label  for="date">Credit Note Date</label>
                                            <input class="md-input" type="text" id="date" name="date"  value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label class="" for="amount">Amount</label>
                                            <?php $total_payment = 0; ?>
                                            <?php $refund = 0; ?>
                                            @foreach($credit_note->creditNotePayments as $payment)
                                               <?php $total_payment = $total_payment + (float)$payment->amount; ?>
                                            @endforeach
                                            @foreach($credit_note->creditNoteRefunds as $refunds)
                                                <?php $refund = $refund + (float)$refunds->amount ?>
                                            @endforeach
                                            <input class="md-input" type="text" id="amount" name="amount" value="{{ $credit_note->total_credit_note - $total_payment - $refund }}" required/>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label for="reference">Enter Reference Number</label>
                                            <input class="md-input" type="text" id="reference" name="reference" required/>
                                        </div>
                                        <div class="uk-width-medium-1-4">
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
    <script type="text/javascript">
        $('#sidebar_credit_note').addClass('act_item');

        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
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
