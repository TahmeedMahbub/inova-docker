@extends('layouts.main')

@section('title', 'Attributes')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('top_bar')
    <div id="top_bar">
        <div class="md-top-bar">
            <ul id="menu_top" class="uk-clearfix">
                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Product/Service </span></a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('inventory_create') }}">Create Product/Service </a></li>
                            <li><a href="{{ route('inventory') }}">All Product/Service </a></li>
                        </ul>
                    </div>
                </li>

                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Categories</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('inventory_category_create') }}">Create Category</a></li>
                            <li><a href="{{ route('inventory_category') }}">All Category</a></li>
                        </ul>
                    </div>
                </li>
                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Sub Category</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('inventory_sub_category') }}">All Sub Category</a></li>
                            <li><a href="{{ route('inventory_sub_category_add') }}">Create Sub Category</a></li>
                        </ul>
                    </div>
                </li>

                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Attributes</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('attributes') }}">@lang('trans.all_attributes')</a></li>
                            <li><a href="{{ route('attribute_create') }}">@lang('trans.create_attributes')</a></li>
                        </ul>
                    </div>
                </li>

                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Offers</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('offers') }}">@lang('trans.all_offers')</a></li>
                            <li><a href="{{ route('offers_create') }}">@lang('trans.create_offers')</a></li>
                        </ul>
                    </div>
                </li>

                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>Damage</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('damage') }}">@lang('trans.all_damage')</a></li>
                            <li><a href="{{ route('damage_create') }}">@lang('trans.create_damage')</a></li>
                        </ul>
                    </div>
                </li>
                
            </ul>
        </div>
    </div>
@endsection
@section('content')
    <?php $helper = new \App\Lib\Helpers(); ?>
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">@lang('trans.attributes_list')</span></h2>
                            </div>

                        </div>
                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table">
                                    <thead>
                                        <tr>
                                            <th>@lang('trans.serial')</th>
                                            <th class="uk-text-center">@lang('trans.name')</th>
                                            <th class="uk-text-center">@lang('trans.values')</th>
                                            <th class="uk-text-center">@lang('trans.status')</th>
                                            <th class="uk-text-center">@lang('trans.action')</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>@lang('trans.serial')</th>
                                            <th class="uk-text-center">@lang('trans.name')</th>
                                            <th class="uk-text-center">@lang('trans.values')</th>
                                            <th class="uk-text-center">@lang('trans.status')</th>
                                            <th class="uk-text-center">@lang('trans.action')</th>
                                        </tr>
                                    </tfoot>
                                    <?php $i = 1; ?>
                                    <tbody>
                                        @foreach ($attributes as $attribute)
                                            <tr>
                                                <td>
                                                    @if (Session::get('locale') == 'bn')
                                                        {{ $helper->bn2enNumber($i) }}
                                                    @else
                                                        {{ $i }}
                                                    @endif
                                                </td>
                                                <td class="uk-text-center">
                                                    {{ $attribute['name'] }}
                                                </td>
                                                <td class="uk-text-center">
                                                    @foreach ($attribute->attributeValues as $value)
                                                        {{ $value['value'] }}{{ $loop->last ? '' : ', ' }}
                                                    @endforeach
                                                </td>
                                                <td class="uk-text-center">
                                                    <input type="checkbox" id="attribute_status_{{ $attribute->id }}"
                                                        data-switchery {{ $attribute['status'] == 1 ? 'checked' : '' }}
                                                        onchange="statusChange(this)" />
                                                </td>
                                                <td class="uk-text-center" style="white-space:nowrap !important;">
                                                    <a href="{{ route('attribute_edit', ['id' => $attribute->id]) }}"><i
                                                            data-uk-tooltip="{pos:'top'}" title="@lang('trans.edit')"
                                                            class=" material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}"
                                                            title="@lang('trans.delete')"
                                                            class="material-icons">&#xE872;</i></a>
                                                    <input class="attribute_id" type="hidden"
                                                        value="{{ $attribute->id }}">
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('attribute_create') }}"
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
            var url = $(this).next('.attribute_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                window.location.href = window.location.origin + '/attributes/delete/' + url;
            })
        })
    </script>

    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_attributes').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        });

        function statusChange(e) {
            var status = 0;
            var attribute_id = $(e).attr('id').match(/(\d+)/g)[0];
            $(e).is(':checked') ? status = 1 : status = 0;
            $.post("{{ route('update_attribute_status') }}", {
                'attribute_id': attribute_id,
                'status': status,
            }).success(function(data) {
                UIkit.notify({
                    message: 'Attribute status updated successfully',
                    status: 'success',
                    timeout: 2000,
                    pos: 'top-right'
                });
            }).error(function(data) {
                UIkit.notify({
                    message: 'Something went wrong',
                    status: 'danger',
                    timeout: 2000,
                    pos: 'top-right'
                });
            });
        }
    </script>
@endsection
