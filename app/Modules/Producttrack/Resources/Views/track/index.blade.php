@extends('layouts.main')

@section('title', 'Manufacture')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
<style>
    span.select2-container {
        z-index: 1500 !important;
    }
</style>
@endsection

@section('content')
    <?php $helper = new \App\Lib\Helpers(); ?>
                        
    <div class="user_heading">
        <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview fileinput-exists thumbnail"></div>
        </div>
        <div class="user_heading_content">
            <h2 class="heading_b"><span class="uk-text-truncate">Manufacture</span></h2>
        </div>
    </div>
    <div class="md-card">
        <div class="md-card-toolbar" style="position: absolute; right: 10px; border-bottom: 0">
            <div class="md-card-toolbar-actions">

                <!--end  -->
                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="true"> <a href="#" data-uk-modal="{target:'#coustom_setting_modal'}"><i class="material-icons">&#xE8B8;</i><span>Custom Setting</span></a>

                </div>
                <!--coustorm setting modal start -->
                <div class="uk-modal" id="coustom_setting_modal">
                    <div class="uk-modal-dialog">
                        {{-- {!! Form::open(['url' => 'invoice', 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'user_profile']) !!} --}}
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Select Date Range {{ session('branch_id')==1?"and Branch":'' }}   <i class="material-icons" data-uk-tooltip="{pos:'top'}" title="headline tooltip">&#xE8FD;</i></h3>
                        </div>

                        <div class="uk-width-large-2-2 uk-width-2-2">
                            @if(session('branch_id')==1)
                                <div class="uk-width-medium-2-2">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-building"></i></span>

                                        <select style="width: 90%" class="select2-single-search-dropdown"  id="report_account_id" name="branch_id" >

                                            @if(isset($branch_id))
                                                @foreach($branches as $branch)
                                                    <option {{ ($branch_id==$branch->id)?"selected":'' }} value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                @endforeach
                                            @else
                                                @foreach($branches as $branch)
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
                            <br>
                            <div class="uk-width-large-2-2 uk-width-2-2">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                    <label for="uk_dp_1">To</label>
                                    <input value="{{ isset($to_date)?$to_date:date('Y-m-d') }}" required class="md-input" type="text"  name="to_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                </div>
                            </div>
                            <div class="uk-width-large-2-2 uk-width-2-2 uk-margin-small">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-file"></i></span>
                                    <label for="quotation">Quotation Number</label>
                                    <input value="{{ isset($quotation_number) ? $quotation_number : '' }}" class="md-input" type="text" id="quotation_number_id" name="quotation_number">
                                </div>
                            </div>
                            <div class="uk-width-large-2-2 uk-width-2-2">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                    <label for="uk_dp_1">Due Date</label>
                                    <input value="{{ isset($due_date)?$due_date:date('Y-m-d') }}" required class="md-input" type="text"  name="due_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                </div>
                            </div>
                            <div class="uk-width-large-2-2 uk-width-2-2 uk-margin-small-top">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-user"></i></span>
                                    {{-- <label for="uk_dp_1">Customers</label> --}}
                                    <select data-uk-tooltip="{pos:'top'}" class="md-input select2-single-search-dropdown"
                                        name="Status">
                                        <option value="0">Incomplete</option>
                                        <option value="1">Complete</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="uk-modal-footer uk-text-right">
                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                            <button type="submit" name="submit" class="md-btn md-btn-flat md-btn-flat-primary">Search</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!--end  -->
            </div>

            <h3 class="md-card-toolbar-heading-text large" id="invoice_name"></h3>
        </div>
        <div class="md-card-content">
            <div class="uk-overflow-container uk-margin-bottom">
                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                <table class="uk-table" cellspacing="0" width="100%" id="data_table">
                    <thead>
                        <tr>
                            <th style="width: 80px">#</th>
                            <th>@lang('trans.production_id')</th>
                            <th>Bill of Material</th>
                            <th>@lang('trans.start_end_date')</th>
                            <th>@lang('trans.phase')</th>
                            <th class="uk-text-center">@lang('trans.action')</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th style="width: 80px">#</th>
                            <th>@lang('trans.production_id')</th>
                            <th>Bill of Material</th>
                            <th>@lang('trans.start_end_date')</th>
                            <th>@lang('trans.phase')</th>
                            <th class="uk-text-center">@lang('trans.action')</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php $count = 1;
                      
                         ?>


                     @foreach ($manufactures as $manufacture)
                        <tr>
                            <td style="width: 80px">
                                @if (Session::get('locale') == 'bn')
                                    {{ $helper->bn2enNumber($count++) }}
                                @else
                                    {{ $count++ }}
                                @endif
                            </td>
                            
                            <td>
                               PROD-{{ str_pad($manufacture->id, 6, "0", STR_PAD_LEFT) }}
                            </td>
                            <td>
                                {{ isset($manufacture->billOfMaterial) ? $manufacture->billOfMaterial->project_name : ''}}
                               
                            </td>

                            <td>
                                  {{ date('jS M, Y' ,strtotime($manufacture->start_date)).' - '.  date('jS M, Y' ,strtotime($manufacture->end_date)) }}

                            </td>
                            <td>
                                @foreach ($manufacture->manufacturePhases as $manufacture_phases)
                                   
                                    @if ($manufacture_phases->status == 'incomplete')
                                    <div style="text-align:center; padding: 5px 8px; border-radius: 5px; margin: 2px 0; color: white; background-color:red;">
                                        {{ $manufacture_phases->phase_name }}
                                    </div>
                                
                                    @else
                                
                                    <div style="text-align:center; padding: 5px 8px; border-radius: 5px; margin: 2px 0; color: white; background-color:green;">
                                        {{ $manufacture_phases->phase_name }}
                                    </div>
                                    @endif                              
                                @endforeach                              
                            </td>                          
                            <td class="uk-text-center">
                                <a href="{{ route('track_show', $manufacture->id) }}"><i
                                    data-uk-tooltip="{pos:'top'}" title="@lang('trans.view')"
                                    class="md-icon material-icons">&#xE8F4;</i></a>
                                @if(!in_array("complete",$manufacture->manufacturePhases->pluck('status')->toArray()))
                                    <a href="{{ route('track_edit',$manufacture->id) }}"><i
                                        data-uk-tooltip="{pos:'top'}" title="@lang('trans.edit')"
                                        class="md-icon material-icons">&#xE254;</i></a>
                                    <a class="manufacture_delete_btn"><i
                                            data-uk-tooltip="{pos:'top'}" title="@lang('trans.delete')"
                                            class="md-icon material-icons">&#xE872;</i></a>
                                    <input type="hidden" class="manufacture_id" value="{{ $manufacture->id }}">
                                @endif

                                {{-- <a {{ $product->item_add == 1 ? 'href="#" style="opacity:0.5"' : `href='{{ route("product_item_list", "id" => $product->id]) }}'`}}><i
                                    data-uk-tooltip="{pos:'top'}" title="@lang('trans.view')"
                                    class="md-icon material-icons">&#xE8F4;</i></a>
                                <a  href="{{ route('track_edit', ['id' => $manufacture->id]) }}"}}><i
                                    data-uk-tooltip="{pos:'top'}" title="@lang('trans.edit')"
                                    class="md-icon material-icons">&#xE254;</i></a>
                                <a href="{{ route('product_item_add', ['id' => $manufacture->id]) }}" }}><i
                                    data-uk-tooltip="{pos:'top'}" title="@lang('trans.add_item')"
                                    class="md-icon material-icons">&#xE147;</i>
                                </a>
                                <a {{ $product->item_add == 1 ? 'style="opacity:0.5"' : `class="agent_delete_btn"` }}><i
                                        data-uk-tooltip="{pos:'top'}" title="@lang('trans.delete')"
                                        class="md-icon material-icons">&#xE872;</i></a>
                                <input class="product_id" type="hidden" value="{{ $product->id }}"> --}}
                            </td>
                        </tr>
                    @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent" href="{{ route('track_create') }}">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>
@endsection
@section('scripts')

    <script>
        $('.manufacture_delete_btn').click(function() {
            var id = $(this).next('.manufacture_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                window.location.href = "/product-track/delete/" + id;
            })
        })
    </script>

    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_track').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection
