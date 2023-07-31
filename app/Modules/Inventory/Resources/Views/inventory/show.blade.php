@extends('layouts.main')

@section('title', 'Inventory')

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
    <?php $helper = new \App\Lib\Helpers ?>
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>

                <div class="uk-width-xLarge-10-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                @lang('trans.general_info')
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-2">

                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.item_name')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle">
                                                @if(Session::get('locale') == 'bn')
                                                {{ $item->item_name }}
                                                @else
                                                {{ $item->item_name }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.barcode_no'):</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->barcode }}
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.reorder_point'):</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            @if(Session::get('locale') == 'bn')
                                                {{$helper->bn2enNumber($item->reorder_point)}}
                                            @else
                                                {{ $item->reorder_point }}
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.category')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            @if(Session::get('locale') == 'bn')
                                                {{ $item->item_category_name }}
                                            @else
                                                {{ $item->item_category_name }}
                                            @endif
                                        </div>
                                    </div>

                                    @if(isset($item_sub_categories->item_sub_category_name))
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.sub_category')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            @if(Session::get('locale') == 'bn')
                                                {{ $item->item_sub_category_name }}
                                            @else
                                                {{ $item->item_sub_category_name }}
                                            @endif

                                        </div>
                                    </div>
                                    @endif

                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.unit_type')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->unit_type }}
                                        </div>
                                    </div>

                                </div>
                                <div class="uk-width-large-1-2">
                                    <p>
                                        <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">@lang('trans.about_item')</span>
                                        @if(Session::get('locale') == 'bn')
                                            {{ $item->item_about }}
                                        @else
                                            {{ $item->item_about }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                @lang('trans.purchase_info')
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-2">

                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.purchase_rate')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle">
                                                @if(Session::get('locale') == 'bn')
                                                {{$helper->bn2enNumber($item->item_purchase_rate)}}
                                                @else
                                                    {{ $item->item_purchase_rate }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.total_purchase'):</span>
                                        </div>
                                        <div class="uk-width-large-2-3">

                                            {{$helper->bn2enNumber($item->total_purchases)}}

                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-large-1-2">
                                    <p>
                                        <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">@lang('trans.purchase_description')</span>

                                        @if(Session::get('locale') == 'bn')
                                            {{ $item->item_purchase_description }}
                                        @else
                                            {{ $item->item_purchase_description }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                @lang('trans.sales_info')
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-2">

                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.sale_rate')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle">
                                                 @if(Session::get('locale') == 'bn')
                                                    {{$helper->bn2enNumber($item->item_sales_rate)}}
                                                @else
                                                    {{ $item->item_sales_rate }}
                                                @endif
                                             </span>
                                        </div>
                                    </div>

                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.total_sales'):</span>
                                        </div>
                                        <div class="uk-width-large-2-3">

                                            @if(Session::get('locale') == 'bn')
                                                {{$helper->bn2enNumber($item->total_sales)}}
                                            @else
                                                {{ $item->total_sales }}
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.sales_tax'):</span>
                                        </div>
                                        <div class="uk-width-large-2-3">

                                            @if(Session::get('locale') == 'bn')
                                                {{$helper->bn2enNumber($item->item_sales_tax)}}
                                            @else
                                                {{ $item->item_sales_tax }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-large-1-2">
                                    <p>
                                        <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">@lang('trans.sales_description')</span>

                                        @if(Session::get('locale') == 'bn')
                                            {{ $item->item_sales_description }}
                                        @else
                                            {{ $item->item_sales_description }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                @lang('trans.other_info')
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-2">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.created_by')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->createdBy->name }}
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.created_at')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->created_at }}
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-large-1-2">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.updated_by')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->updatedBy->name }}
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">@lang('trans.updated_at')</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            {{ $item->updated_at }}
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
