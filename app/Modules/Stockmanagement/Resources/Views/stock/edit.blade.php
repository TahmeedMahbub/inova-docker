@extends('layouts.main')

@section('title', 'Stock Management')

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
                <a href="#"><i class="material-icons">&#xE02E;</i><span>@lang('trans.inventory')</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{route('inventory_create')}}">@lang('trans.create_inventory')</a></li>
                        <li><a href="{{route('inventory')}}">@lang('trans.all_inventory')</a></li>
                    </ul>
                </div>
            </li>

            <li class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>@lang('trans.category')</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{route('inventory_category_create')}}">@lang('trans.create_category')</a></li>
                        <li><a href="{{route('inventory_category')}}">@lang('trans.all_category')</a></li>
                    </ul>
                </div>
            </li>
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="{{route('stock_create')}}"><i class="material-icons">&#xE02E;</i><span>@lang('trans.add_stock')</span></a>
            </li>
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
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">@lang('trans.edit_stock')</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            {!! Form::open(['url' => route('stock_update', ['id' => $stock->id]), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="item_category_id" class="uk-vertical-align-middle">@lang('trans.edit_stock')</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select id="item_category_id" name="item_category_id" data-md-selectize required>
                                                <option value="">Select Category</option>
                                                @foreach($item_categories as $item_category)
                                                    @if($item_category->id == $stock->item_category_id)
                                                        @if(Session::get('locale') == 'bn')
                                                            <option value="{{ $item_category->id }}" selected>{{ $item_category->item_category_name }}</option>
                                                        @else
                                                            <option value="{{ $item_category->id }}" selected>{{ $item_category->item_category_name }}</option>
                                                        @endif
                                                    @else
                                                        @if(Session::get('locale') == 'bn')
                                                            <option value="{{ $item_category->id }}">{{ $item_category->item_category_name }}</option>
                                                        @else
                                                            <option value="{{ $item_category->id }}">{{ $item_category->item_category_name }}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->first('item_category_id'))
                                                <div class="uk-text-danger uk-margin-top">Item category is required.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="item_category_id" class="uk-vertical-align-middle">@lang('trans.item')</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select id="item_id" name="item_id" data-md-selectize required>
                                                <option value="">Select Item</option>
                                                @foreach($items as $item)
                                                    @if($item->id == $stock->item_id)
                                                        @if(Session::get('locale') == 'bn')
                                                            <option value="{{ $item->id }}" selected>{{ $item->item_name }}</option>
                                                        @else
                                                            <option value="{{ $item->id }}" selected>{{ $item->item_name }}</option>
                                                        @endif
                                                    @else
                                                        @if(Session::get('locale') == 'bn')
                                                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                                        @else
                                                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->first('item_id'))
                                                <div class="uk-text-danger uk-margin-top">Item is required.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">@lang('trans.date')</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">@lang('trans.date')</label>
                                            <input class="md-input" type="text" id="date" value="{{$stock->date}}" name="date" data-uk-datepicker="{format:'DD.MM.YYYY'}" required/>
                                        </div>
                                        @if($errors->first('date'))
                                            <div class="uk-text-danger uk-margin-top">Date is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="total">@lang('trans.total')</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="total">@lang('trans.total')</label>
                                            <input class="md-input" type="text" id="total" value="{{$stock->total}}" name="total" required/>
                                        </div>
                                        @if($errors->first('total'))
                                            <div class="uk-text-danger uk-margin-top">Invalid Input.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button type="submit" class="md-btn md-btn-primary" >@lang('trans.submit')</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">@lang('trans.close')</button>
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
        $('#sidebar_inventory').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
    </script>
@endsection