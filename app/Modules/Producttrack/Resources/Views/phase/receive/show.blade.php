@extends('layouts.main')

@section('title', 'Receive From Factory')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">{{ $manufacture_phase->phase_name }} Receive from {{ $manufacture_phase->factory->display_name }}</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-float-left">
                                <a href="{{ route('track_show', ['id' => $manufacture_phase->manufacture->id]) }}" class="md-btn md-btn-success">Go Back</a>
                            </div>
                            @if (count($manufacture_phase->manufacturePhaseReceivesFromFactory) > 0)
                                <div class="uk-grid uk-float-right">
                                    <a href="{{ route('phase_receive_edit', ['id'  => $manufacture_phase->id]) }}" class="md-btn md-btn-primary {{ $manufacture_phase->manufacture->status == 'complete' ? 'disabled' : '' }}">Edit</a>
                                </div>
                            @endif
                            <div class="uk-grid uk-margin-large-top">
                                <div class="uk-width-1-1">
                                    <div class="md-card uk-margin-medium-bottom uk-margin-top">
                                        <div class="md-card-content">
                                            <div class="uk-overflow-container">
                                                <table class="uk-table uk-table-striped uk-table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Receive Materials</th>
                                                            <th>Updated By</th>
                                                            <th>Receive Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($manufacture_phase->manufacturePhaseReceivesFromFactory) == 0)
                                                            <tr class="uk-text-center">
                                                                <td colspan="5">No data found</td>
                                                            </tr>
                                                        @else
                                                            @foreach ($manufacture_phase->manufacturePhaseReceivesFromFactory as $key => $receive)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ $receive->variation->variation_name }}</td>
                                                                    <td>{{ $receive->updatedBy->name }}</td>
                                                                    <td>{{ date('jS M, Y', strtotime($receive->date)) }}</td>
                                                                    <td>
                                                                        @if ($manufacture_phase->manufacture->status != 'complete')
                                                                            <a class="delete_btn"><i
                                                                                    data-uk-tooltip="{pos:'top'}" title="@lang('trans.delete')"
                                                                                    class="md-icon material-icons disabled">&#xE872;</i></a>
                                                                            <input type="hidden" class="receive_id" value="{{ $receive->id }}">                                                                        
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($manufacture_phase->manufacture->status != 'complete')
        <div class="md-fab-wrapper">
            <a class="md-fab md-fab-accent disabled" href="{{ route('phase_receive_create', ['id' => $id]) }}">
                <i class="material-icons">&#xE145;</i>
            </a>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_track').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        });        
        $('.delete_btn').click(function () {
            var id = $(this).next('.receive_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/product-track/phase/receive/delete/"+id;
            })
        })
    </script>
@endsection
