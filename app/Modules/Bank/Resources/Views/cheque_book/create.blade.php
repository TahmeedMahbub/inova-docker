@extends('layouts.main')

@section('title', 'Cheque Book Create')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')
    <div class="uk-width-large-10-10">
        {!! Form::open([
            'url' => route('cheque_book_store'),
            'method' => 'POST',
            'class' => 'user_edit_form',
            'files' => 'true',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                <div class="md-card">
                    <div class="user_heading">
                        <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        </div>
                        <div class="user_heading_content">
                            <h2 class="heading_b"><span class="uk-text-truncate">Add Cheque Book</span></h2>
                        </div>
                    </div>
                    <div class="user_content">
                        <div class="uk-margin-top">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-3 uk-margin-small-top">
                                    <label class="uk-vertical-align-middle" for="collection_date">Cheque Book Collected
                                        On<sup><i style="font-size: 12px; color:red; "
                                                class="material-icons">stars</i></sup>
                                    </label>
                                    <input class="md-input" type="text" id="collection_date" name="collection_date"
                                        value="{{ Carbon\Carbon::now()->format('d-m-Y') }}"
                                        data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    @if ($errors->first('collection_date'))
                                        <div class="uk-text-danger">
                                            {{ $errors->first('collection_date') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="uk-width-medium-1-3">
                                    <label class="" for="branch_id">Branch<sup><i style="font-size: 12px; color:red; "
                                                class="material-icons">stars</i></sup>
                                    </label> <br>
                                    <select title="Select Customer" id="branch_id" name="branch_id"
                                        class="md-input select2-single-search-dropdown" required>
                                        <option value="">Select Branch</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('branch_id'))
                                        <div class="uk-text-danger">
                                            {{ $errors->first('branch_id') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="uk-width-medium-1-3">
                                    <label class="" for="bank_id">Bank<sup><i style="font-size: 12px; color:red; "
                                                class="material-icons">stars</i></sup>
                                    </label> <br>
                                    <select title="Select Customer" id="bank_id" name="bank_id"
                                        class="md-input select2-single-search-dropdown" required>
                                        <option value="">Select Bank</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->account_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('bank_id'))
                                        <div class="uk-text-danger">
                                            {{ $errors->first('bank_id') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-3">
                                    <label class="" for="start_page_no">Start Page Number<sup><i
                                                style="font-size: 12px; color:red" class="material-icons">stars</i></sup>
                                    </label>
                                    <input class="md-input" type="number" id="start_page_no" name="start_page_no"
                                        required />
                                    @if ($errors->first('start_page_no'))
                                        <div class="uk-text-danger">
                                            {{ $errors->first('start_page_no') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="uk-width-medium-1-3">
                                    <label class="" for="number_of_pages">Total Number of Pages<sup><i
                                                style="font-size: 12px; color:red" class="material-icons">stars</i></sup>
                                    </label>
                                    <input class="md-input" type="number" id="number_of_pages" name="number_of_pages"
                                        required />
                                    @if ($errors->first('number_of_pages'))
                                        <div class="uk-text-danger">
                                            {{ $errors->first('number_of_pages') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-1-1 uk-text-right">
                                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_cheque_book').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        })
    </script>

@endsection
