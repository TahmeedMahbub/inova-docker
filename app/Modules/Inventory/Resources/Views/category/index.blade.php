@extends('layouts.main')

@section('title', 'Category')

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
                        <li><a href="{{route('inventory_create')}}">Create Product/Service </a></li>
                        <li><a href="{{route('inventory')}}">All Product/Service </a></li>
                    </ul>
                </div>
            </li>

            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Categories</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{route('inventory_category_create')}}">Create Category</a></li>
                        <li><a href="{{route('inventory_category')}}">All Category</a></li>
                    </ul>
                </div>
            </li>
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Sub Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('inventory_sub_category') }}">All Sub Category</a></li>
                        <li><a href="{{route('inventory_sub_category_add')}}">Create Sub Category</a></li>
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
            {{-- <li data-uk-dropdown class="uk-hidden-small">
               <a href="#"><i class="material-icons">&#xE02E;</i><span>Search By Category</span></a>
               <div class="uk-dropdown uk-dropdown-scrollable">
                   <ul class="uk-nav uk-nav-dropdown">
                   <li><a href="{{ route('inventory') }}">All Service</a></li>
                   @foreach($item_categories as $item_categories_data)
                       <li><a href="{{ route('inventory_search', ['id' => $item_categories_data->id]) }}">{{ $item_categories_data->item_category_name }}</a></li>
                    @endforeach
                   </ul>
               </div>
           </li> --}}
        </ul>
    </div>
</div>
@endsection
@section('content')
    <?php $helper = new \App\Lib\Helpers ?>
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
                                <h2 class="heading_b"><span class="uk-text-truncate">Product/Service  Category List</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('trans.title')</th>
                                        <th>@lang('trans.description')</th>
                                        <th>Updated By</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('trans.title')</th>
                                        <th>@lang('trans.description')</th>
                                        <th>Updated By</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($item_categories as $category)

                                        <tr>
                                            <td>
                                                @if(Session::get('locale') == 'bn')
                                                    {{ $helper->bn2enNumber($count++) }}
                                                @else
                                                    {{$count++ }}
                                                @endif

                                            </td>
                                            <td>
                                                @if(Session::get('locale') == 'bn')
                                                    {{ $category->item_category_name }}
                                                @else
                                                    {{ $category->item_category_name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(Session::get('locale') == 'bn')
                                                    {{ substr($category->item_category_description, 0, 50) }}
                                                @else
                                                    {{ substr($category->item_category_description, 0, 50) }}
                                                @endif
                                            </td>
                                            <td>{{ $category->updatedBy->name }}</td>

                                            <td class="uk-text-center">
                                                <a href="{{ route('inventory_category_edit',['id' => $category->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                <input class="category_id" type="hidden" value="{{ $category->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('inventory_category_create') }}" class="md-fab md-fab-accent branch-create">
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
        $('.delete_btn').click(function () {
            var id = $(this).next('.category_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/inventory/category/delete/"+id;
            })
        })
    </script>
     <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection
