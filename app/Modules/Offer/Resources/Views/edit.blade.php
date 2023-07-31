@extends('layouts.main')

@section('title', 'Edit Offer')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style media="screen">
        input {
            margin-top: 10px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

    </style>
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
            {!! Form::open([
                'url' => route('offers_update', ['id' => $offer->id]),
                'method' => 'POST',
                'class' => 'uk-form-stacked',
                'id' => 'user_edit_form',
            ]) !!}
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">@lang('trans.edit_offers')</span>
                                </h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-1-4">
                                        <label for="start_date">Start Date<span
                                            style="color: red;" class="asterisc">*</span></label>
                                        <input class="md-input" type="text" id="start_date"
                                        name="start_date" value="{{ Carbon\Carbon::parse($offer->start_date)->format('d-m-Y') }}"
                                        data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label for="end_date">End Date<span
                                            style="color: red;" class="asterisc">*</span></label>
                                        <input class="md-input" type="text" id="end_date"
                                        name="end_date" value="{{ Carbon\Carbon::parse($offer->end_date)->format('d-m-Y') }}"
                                        data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>

                                    <div class="uk-width-large-1-4">
                                        <label for="item_id_0" class="uk-vertical-align-middle">@lang('trans.select_item')<span
                                                style="color: red;" class="asterisc">*</span></label><br />
                                        <div id="item_variation_container">
                                            <select id="item_id_0" class="item_id md-input select2-single-search-dropdown"
                                            name="item_id" onchange="itemChanged(this, ``)" required>
                                            </select>
                                            <a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, ``)"
                                            data-uk-modal="{target:'#chooseVariation'}" id="choose_variation_modal_0" type="submit"
                                            class="sm-btn sm-btn-primary variation-button">
                                                <span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span>
                                            </a>
                                            <input id="selected_variation_0" name="item_selected_variation" type="number" style="display: none" value="{{ isset($offer->item_variation_id) ? $offer->item_variation_id : '' }}">
                                        </div>
                                        @if ($offer->item_variation_id)
                                            <div class="uk-text-center" id="variation_badge_container_0">
                                                <span class="uk-badge uk-text-nowrap" id="variation_badge_0">Selected Variation: {{ $offer->itemVariation->variation_name }}</span>
                                            </div>
                                        @endif
                                        <p style="color:red;">{{ $errors->first('item_id') }}</p>
                                    </div>

                                    <div class="uk-width-large-1-4">
                                        <label for="base_quantity">@lang('trans.base_quantity')(pcs)<span
                                            style="color: red;" class="asterisc">*</span></label>
                                        <input class="md-input" type="number" id="base_quantity" name="base_quantity"
                                            value="{{ $offer->unit_id?$offer->base_quantity/$offer->basic_unit_conversion:'' }}" required/>
                                        <p style="color:red;">{{ $errors->first('base_quantity') }}</p>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <label for="base_quantity">Unit<span
                                            style="color: red;" class="asterisc">*</span></label>
                                            <select    name="unit_id" class="select2-single-search-dropdown"
                                            required >
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ $unit->id==$offer->unit_id?'selected':'' }}>
                                                {{ $unit->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                       
                                    
                                        
                                        <p style="color:red;">{{ $errors->first('base_quantity') }}</p>
                                    </div>
                                    

                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-1-2">
                                        <h3 class="full_width_in_card heading_c">
                                            @lang('trans.free_product')
                                        </h3>
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-2">
                                                <label for="item_id_1" class="uk-vertical-align-middle">@lang('trans.select_item')</label><br/>
                                                <div id="free_item_variation_container">
                                                    <select id="item_id_1" class="free_item_id md-input select2-single-search-dropdown"
                                                        name="free_item_id" onchange="itemChanged(this, ``)">
                                                    </select>
                                                    <a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, ``)"
                                                    data-uk-modal="{target:'#chooseVariation'}" id="choose_variation_modal_1" type="submit"
                                                    class="sm-btn sm-btn-primary variation-button">
                                                        <span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span>
                                                    </a>
                                                    <input id="selected_variation_1" name="free_item_selected_variation" type="number" style="display: none" value="{{ isset($offer->free_item_variation_id) ? $offer->free_item_variation_id : '' }}">
                                                </div>
                                                @if ($offer->free_item_variation_id)
                                                    <div class="uk-text-center" id="variation_badge_container_1">
                                                        <span class="uk-badge uk-text-nowrap" id="variation_badge_1">Selected Variation: {{ $offer->freeItemVariation->variation_name }}</span>
                                                    </div>
                                                @endif
                                                <p style="color:red;">{{ $errors->first('free_item_id') }}</p>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <label for="free_item_quantity">@lang('trans.free_item_quantity')(pcs)</label>
                                                <input class="md-input" type="number" id="free_item_quantity" name="free_item_quantity"
                                                    value="{{ $offer->free_quantity }}" />
                                                <p style="color:red;">{{ $errors->first('free_item_quantity') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2">
                                        <h3 class="full_width_in_card heading_c">
                                            @lang('trans.offers')
                                        </h3>
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-2">
                                                <label for="cashback_amount">@lang('trans.cashback_amount')</label>
                                                <input class="md-input" type="number" id="cashback_amount" name="cashback_amount"
                                                    value="{{ $offer->cashback_amount }}" />
                                                <p style="color:red;">{{ $errors->first('cashback_amount') }}</p>
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <label for="cashback_type" class="uk-vertical-align-middle">@lang('trans.cashback_type')</label><br/>
                                                <select id="cashback_type" class="cashback_type md-input select2-single-search-dropdown"
                                                    name="cashback_type">
                                                    <option value="" {{ isset($offer->cashback_type) ? 'selected' : '' }}>Select Cashback Type</option>
                                                    <option value="0" {{ $offer->cashback_type == '0' ? 'selected' : '' }}>Flat</option>
                                                    <option value="1" {{ $offer->cashback_type == '1' ? 'selected' : '' }}>Percentage</option>   
                                                </select>
                                                <p style="color:red;">{{ $errors->first('cashback_type') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-grid uk-text-right" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close"><a
                                                href="{{ route('offers') }}">@lang('trans.close') </a></button>
                                        <button id="submit" type="submit"
                                            class="md-btn md-btn-primary">@lang('trans.submit')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        var ajax_data = [];
        $.get("{{ route('item_list') }}",
            function (data) {
                $.each(data, function (indexInArray, valueOfElement) { 
                     ajax_data[valueOfElement.id] = valueOfElement;
                });    
            }
        );
        var items_chosen = [];
        items_chosen[0] = {!! json_encode($offer->item) !!};
        items_chosen[0]['variation_id'] = {!! json_encode(empty($offer->item_variation_id) ? '' : $offer->item_variation_id ) !!};
        items_chosen[0]['variations'] = [];
        $.each({!! json_encode($offer->item->itemVariations) !!}, function (indexInArray, valueOfElement) { 
            items_chosen[0]['variations'][valueOfElement.id] = valueOfElement;
        });
        {!! json_encode(!empty($offer->free_item_variation_id)) !!} ? items_chosen[1] = {!! json_encode($offer->freeItem) !!} : items_chosen[1] = [];
        {!! json_encode(!empty($offer->free_item_variation_id)) !!} ? items_chosen[1]['variation_id'] = {!! json_encode($offer->free_item_variation_id) !!} : items_chosen[1]['variation_id'] = '';
        if({!! json_encode(!empty($offer->free_item_variation_id)) !!}){
            var url = "{{ route('check-variation', ':id') }}";
            url = url.replace(':id', {!! json_encode($offer->free_item_id) !!});
        }
        {{ json_encode(!empty($offer->free_item_variation_id)) }} ? $.get(url,
            function (data) {
                items_chosen[1]['variations'] = data.variations;
            },
        ) : items_chosen[1]['variations'] = [];
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_offers').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var offer_item_id = {!! json_encode($offer->item_id) !!};
            var offer_free_item_id = {!! json_encode($offer->free_item_id) !!};

            var start_date = {!! json_encode($offer->start_date) !!};
            var end_date = {!! json_encode($offer->end_date) !!};

            $.ajax({
                type: "get",
                url: "{{ route('item_list') }}",
                success: function(response) {
                    $('#item_id_0 ,#item_id_1').append('<option value="">Select an Item</option>');
                    $.each(response, function(indexInArray, valueOfElement) {
                        ajax_data[valueOfElement.id] = valueOfElement;
                        $('#item_id_0').append('<option value="' + valueOfElement.id + '"'+ (offer_item_id == valueOfElement.id ? 'selected' : '') +'>(' +
                            valueOfElement.barcode_no + ') ' + valueOfElement.item_name +
                            '</option>');
                        $('#item_id_1').append('<option value="' + valueOfElement.id + '"'+ (offer_free_item_id == valueOfElement.id ? 'selected' : '') +'>(' +
                            valueOfElement.barcode_no + ') ' + valueOfElement.item_name +
                            '</option>');
                    });
                }
            });
            $(".startdate").kendoDateTimePicker({
                value: start_date,
                dateInput: true,
                format: "dd-MM-yyyy HH:mm:ss",
            });
            $(".enddate").kendoDateTimePicker({
                value: end_date,
                dateInput: true,
                format: "dd-MM-yyyy HH:mm:ss",
            });
        });
    </script>
@endsection
