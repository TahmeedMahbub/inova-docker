@extends('layouts.main')

@section('title', 'Cheque Book')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        .uk-form-select {
            color: rgba(0, 0, 0, 0.8) !important;
        }

        .styled-select select {
            background: transparent;
            border: none;
            font-size: 18px;
            height: 29px;
            padding: 5px;
            /* If you add too much padding here, the options won't show in IE */
            width: 90%;
        }

        .styled-select.slate {
            height: 34px;
            width: 240px;
            z-index: 10;
        }

        .styled-select.slate select {
            border-bottom: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 268px;
        }

        .styled-select.slate option {
            font-size: 16pt;
        }

        .slate {
            background-color: #ddd;
        }

        .slate select {
            color: #000;
        }

        span.select2-container--open {
            z-index: 5000 !important;
        }
    </style>
@endsection
@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="md-card-toolbar" style="">
                            <div class="md-card-toolbar-actions hidden-print">
                                <!--end  -->
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true"
                                    aria-expanded="true"> <a href="#"
                                        data-uk-modal="{target:'#coustom_setting_modal'}"><i
                                            class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open([
                                            'url' => route('deposit_search'),
                                            'method' => 'POST',
                                            'class' => 'user_edit_form',
                                            'id' => 'user_profile',
                                        ]) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range
                                                {{ session('branch_id') == 1 ? 'and Branch' : '' }} <i
                                                    class="material-icons" data-uk-tooltip="{pos:'top'}"
                                                    title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            @if (session('branch_id') == 1)
                                                <div class="uk-width-medium-2-2">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon"><i
                                                                class="uk-input-group-icon uk-icon-building"></i></span>

                                                        <select name="branch_id" id="report_account_id"
                                                            class="select2-single-search-dropdown">
                                                            @if (isset($branch_id))
                                                                @foreach ($branches as $branch)
                                                                    <option
                                                                        {{ $branch_id == $branch->id ? 'selected' : '' }}
                                                                        value="{{ $branch->id }}">
                                                                        {{ $branch->branch_name }}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach ($branches as $branch)
                                                                    <option value="{{ $branch->id }}">
                                                                        {{ $branch->branch_name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        {{-- <select style="width: 90%" class="styled-select slate"
                                                            id="report_account_id" name="branch_id">
                                                        </select> --}}
                                                    </div>
                                                    <br />
                                                </div>
                                            @endif
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                            class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">From</label>
                                                    <input value="{{ isset($from_date) ? $from_date : date('Y-m-d') }}"
                                                        required class="md-input" type="text" name="from_date"
                                                        data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2 uk-margin-small-top">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i
                                                            class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input value="{{ isset($to_date) ? $to_date : date('Y-m-d') }}" required
                                                        class="md-input" type="text" name="to_date"
                                                        data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                            <button type="submit" name="submit"
                                                class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <!--end  -->
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                        </div>
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Cheque Book List</span></h2>
                            </div>

                        </div>

                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Bank Name</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Bank Name</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @foreach ($cheque_books as $key => $cheque_book)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ date('d-m-Y', strtotime($cheque_book->book_collection_date)) }}</td>
                                                <td>{{ $cheque_book->bank->account_name }}</td>
                                                <td class="uk-text-center">
                                                    <a href="{{ route('cheque_book_edit', ['id' => $cheque_book->id]) }}"><i
                                                            data-uk-tooltip="{pos:'top'}" title="Edit"
                                                            class="md-icon material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete"
                                                            class="md-icon material-icons">&#xE872;</i></a>
                                                    <input type="hidden" class="cheque_book_id"
                                                        value="{{ $cheque_book->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('cheque_book_create') }}"
                                    class="md-fab md-fab-accent branch-create">
                                    <i class="material-icons">&#xE145;</i>
                                </a>
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
        $('.delete_btn').click(function() {
            var id = $(this).next('.cheque_book_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                window.location.href = "/cheque-book/delete/" + id;
            })
        })
    </script>
    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_cheque_book').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        })
    </script>

@endsection
