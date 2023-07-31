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
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">@lang('trans.create_category')</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    {!! Form::open(['url' => route('inventory_category_store'), 'method' => 'POST']) !!}
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="item_category_name"> Product/Service  Category Name</label>
                                                <input class="md-input" type="text" id="item_category_name" name="item_category_name" required/>
                                                @if($errors->first('item_category_name'))
                                                    <div class="uk-text-danger">Category name is required.</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="uk-grid">
                                            <div class="uk-width-medium-4-4">
                                                <label for="item_category_description">Product/Service  Category Discription</label>
                                                <textarea class="md-input" name="item_category_description" id="item_category_description" cols="30" rows="4"></textarea>
                                                @if($errors->first('item_category_description'))
                                                    <div class="uk-text-danger">Category description is required.</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="uk-grid">
                                            <div class="uk-width-1-1 uk-float-right">
                                                <button type="submit" class="md-btn md-btn-primary" >@lang('trans.submit')</button>
                                                <button type="button" class="md-btn md-btn-flat uk-modal-close">@lang('trans.close')</button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
@endsection
