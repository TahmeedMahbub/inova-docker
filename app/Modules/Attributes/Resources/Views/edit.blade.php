@extends('layouts.main')

@section('title', 'Edit Attribute')

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
                                {!! Form::open(['url' => route('attribute_update', ['$id' => $attribute->id]), 'method' => 'POST']) !!}
                                <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <label for="attribute_name">Attribute Name</label>
                                        <input class="md-input" type="text" id="attribute_name" name="attribute_name" value="{{ $attribute->name }}"/>
                                        @if ($errors->first('attribute_name'))
                                            <div class="uk-text-danger">{{ $errors->first() }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-1">
                                        <div id="attribute_values_container" class="uk-grid">
                                            @foreach ($attribute_values as $attribute_value)
                                                <div id="value_{{ $loop->index }}" class="uk-width-medium-1-4 uk-width-small-1-2 uk-width-1-1 uk-margin-medium-top">
                                                    <div class="uk-input-group">
                                                        <label for="attributes_value_{{ $loop->index }}">Value</label>
                                                        <input type="text" class="md-input" name="attributes_value[]"
                                                            id="attributes_value_{{ $loop->index }}" value="{{ $attribute_value->value }}">
                                                        <span class="uk-input-group-addon">
                                                            @if (!$loop->last)
                                                                <a href="#" class="btnSectionRemove" onclick="removeSection(this)"><i
                                                                    class="material-icons md-24">delete</i></a>
                                                            @else                                                                
                                                                <a href="#" onclick="addSection(this)" data-section-clone="#value_{{ $loop->index }}"><i
                                                                    class="material-icons md-24">&#xE146;</i></a>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($errors->first('attributes_value.*'))
                                            <div class="uk-text-danger">{{ $errors->first() }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="submit" class="md-btn md-btn-primary">@lang('trans.submit')</button>
                                        <button type="button"
                                            class="md-btn md-btn-flat uk-modal-close">@lang('trans.close')</button>
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
        var add_button = $('.btnSectionClone');
        var x = 0;
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_attributes').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        });

        function addSection(e) {
            $(e).addClass('btnSectionRemove').removeClass('btnSectionClone').attr('onclick', 'removeSection(this)').find('i').text('delete');
            var x = $('#attribute_values_container>div:last-child').attr('id').match(/(\d+)/g)[0];
            x++;
            var content = ` <div id="value_${x}" class="uk-width-medium-1-4 uk-width-small-1-2 uk-width-1-1 uk-margin-medium-top">
                                <div class="uk-input-group">
                                    <div class="md-input-wrapper">
                                        <label for="attributes_value_${x}">Value</label>
                                        <input type="text" class="md-input"
                                            name="attributes_value[]"
                                            id="attributes_value_${x}">
                                    </div>
                                    <span class="uk-input-group-addon">
                                        <a href="#" class="btnSectionClone" onClick="addSection(this)"><i
                                                class="material-icons md-24">&#xE146;</i></a>
                                    </span>
                                </div>
                            </div>`;
            $('#attribute_values_container').append(content);
        }
    </script>
@endsection
