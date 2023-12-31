@extends('layouts.main')

@section('title', 'Quotation Request')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        .uk-form-select{
            color:rgba(0, 0, 0, 0.8) !important;


        }
        .styled-select select {
            background: transparent;
            border: none;
            font-size: 18px;
            height: 29px;
            padding: 5px; /* If you add too much padding here, the options won't show in IE */
            width: 90%;

        }

        .styled-select.slate {
            {{--background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;--}}
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
        .styled-select.slate option{
            font-size: 16pt;

        }
        .slate   { background-color: #ddd; }
        .slate select   { color: #000; }
        @media screen and (-webkit-min-device-pixel-ratio:0)
        {
            .styled-select.slate {
                /* background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center; */

            }
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
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                                </div>
                                <!--coustorm setting modal start -->
                                {{-- <div class="uk-modal" id="coustom_setting_modal">
                                    <div class="uk-modal-dialog">
                                        {!! Form::open(['url' => 'estimate', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!}
                                        <div class="uk-modal-header">
                                            <h3 class="uk-modal-title">Select Date Range {{ session('branch_id')==1?"and Branch":'' }}   <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                                        </div>

                                        <div class="uk-width-large-2-2 uk-width-2-2">
                                            @if(session('branch_id')==1)
                                                <div class="uk-width-medium-2-2">
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-building"></i></span>

                                                        <select style="width: 90%" class="styled-select slate"  id="report_account_id" name="branch_id" >

                                                            @if(isset($branch_id))
                                                                @foreach($branchs as $branch)
                                                                    <option {{ ($branch_id==$branch->id)?"selected":'' }} value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach($branchs as $branch)
                                                                    <option  value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                                @endforeach

                                                            @endif
                                                        </select>

                                                    </div>
                                                    <br/>
                                                </div>
                                            @endif
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">From</label>
                                                    <input value="{{ isset($from_date)?$from_date:date('Y-m-d') }}" required class="md-input" type="text"  name="from_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>
                                            <div class="uk-width-large-2-2 uk-width-2-2">
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                    <label for="uk_dp_1">To</label>
                                                    <input value="{{ isset($to_date)?$to_date:date('Y-m-d') }}" required class="md-input" type="text" name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                            <button type="submit" name="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div> --}}
                                <!--end  -->
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
                        </div>
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate"> Extimate Request </span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Code</th>
                                        <th>Request Date</th>
                                        <th>Contact</th>
                                        <th>Deadline</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Order Code</th>
                                            <th>Request Date</th>
                                            <th>Contact</th>
                                            <th>Deadline</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @foreach($estimateRequest as $request)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $request->order_code }}</td>
                                                <td>{{ date('d-M-Y', strtotime($request->request_date)) }}</td>
                                                <td>{{ $request->contact->display_name }}</td>
                                                <td>{{ date('d-M-Y', strtotime($request->deadline_date)) }}</td>
                                                <td style="white-space:nowrap !important;" class="text-center">
                                                    <a href="{{ route('estimate.request.show', ['id' => $request->id]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="View" class="material-icons">&#xe8f4;</i>
                                                    </a>
                                                    <a href="{{ route('estimate.request.edit', ['id' => $request->id]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Edit" class="material-icons">&#xE254;</i>
                                                    </a>
                                                    
                                                    <a class="delete_btn" data-id="{{ $request->id }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    <?php //$count = 1; ?>
                                    {{-- @foreach($estimate as $value)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{date('d-m-Y', strtotime($value->date)) }}</td>
                                            <td>{{ $value->customer->display_name }}</td>
                                            <td>{{ str_pad($value->estimate_number,6,"0",STR_PAD_LEFT) }}</td>
                                            @if (Auth::user()->role_id == 1)
                                                <td>{{ $value->ref }}</td>                                            
                                                <td>{{ $value->attn }}</td>
                                            @endif

                                            <td style="white-space:nowrap !important;" class="text-center">
                                                @if (Auth::user()->role_id == 1)
                                                    <a href="{{ route('estimateentry_invoice', ['id' => $value->id]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Convert To Invoice"  class="material-icons" >swap_horiz</i>
                                                    </a>
                                                    
                                                    <a href="{{ route('estimate_print', ['id' => $value->id]) }}" target="_blank">
                                                        <i data-uk-tooltip="{pos:'top'}" title="View"  class="material-icons">print</i>
                                                    </a>
                                                @endif
                                                @if (Auth::user()->role_id == 1 || (Auth::user()->role_id != 1 && $value->status == 0))
                                                    <a href="{{ route('estimate.request.edit', ['id' => $value->id]) }}">
                                                        <i data-uk-tooltip="{pos:'top'}" title="Edit" class="material-icons">&#xE254;</i>
                                                    </a>
                                                @endif
                                                
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="estimate_id" value="{{ route('estimate_destroy',$value->id)  }}">
                                                @if (Auth::user()->role_id == 1)                                                    
                                                    <a href="{!! route('estimate_mail_send_view',$value->id) !!}"><i class="material-icons">&#xE0BE;</i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            @if (Auth::user()->role_id != 1)
                                <div class="md-fab-wrapper branch-create">
                                    <a id="add_branch_button" href="{{ route('estimate.request.create') }}" class="md-fab md-fab-accent branch-create">
                                        <i class="material-icons">&#xE145;</i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.delete_btn').click(function (e) {
            e.preventDefault();
            let button = $(this);
            let id = $(this).data('id');            
            // var url = $(this).next('.estimate_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if(result === true){
                    $.ajax({
                        url: "{{ route('estimate.request.delete') }}",
                        type: "POST",
                        data: {
                            id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "JSON",
                        success: function(data){
                            if(data.status == true){
                                button.parent().parent().remove();
                                UIkit.notify({
                                    message: data.message,
                                    status: 'success',
                                    timeout: 2000,
                                    pos: 'top-right'
                                });
                            }else{
                                UIkit.notify({
                                    message: data.message,
                                    status: 'danger',
                                    timeout: 2000,
                                    pos: 'top-right'
                                });
                            }
                        }
                    });
                }
            })
        })
    </script>
    <script type="text/javascript">

        $('#sidebar_estimate_request').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>

@endsection