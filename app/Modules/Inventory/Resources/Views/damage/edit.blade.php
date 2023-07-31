@extends('layouts.main')

@section('title', 'Edit Damage')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
<style media="screen">
  .input-cls
  {
    margin-top : 12px
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
            {!! Form::open(['url' => route('damage_update', $damage->id), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Edit Damage</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <h3 class="full_width_in_card heading_c">
                                        @lang('trans.general_info')
                                    </h3>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                            <label for="item_id_0" class="">Damaged Item<span style="color: red;"
                                                    class="asterisc">*</span></label>
                                            <div id="item_variation_container">
                                                <select id="item_id_0" name="item_id" title="Select Item"
                                                    class="select2-single-search-dropdown" onchange="itemChanged(this,``);" required>
                                                    <option value="">Select Item</option>
                                                    @foreach($items as $item)
                                                    <option value="{{ $item->id }}" {{ $damage->item_id == $item->id ? 'selected' : '' }}>
                                                        {{ str_pad($item->id, 6, '0', STR_PAD_LEFT) }}, {{ $item->item_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, ``)"
                                                data-uk-modal="{target:'#chooseVariation'}" id="choose_variation_modal_0" type="submit"
                                                class="sm-btn sm-btn-primary variation-button">
                                                    <span
                                                    class="uk-badge uk-align-center uk-margin-small-top">
                                                        Choose Variation
                                                    </span>
                                                </a>
                                                <input id="selected_variation_0" name="selected_variation" type="number" style="display: none" value="{{ isset($damage->variation_id) ? $damage->variation_id : '' }}">                                                
                                            </div>
                                            @if ($damage->variation_id)
                                                <div class="uk-text-center" id="variation_badge_container_0">
                                                    <span class="uk-badge uk-text-nowrap" id="variation_badge_0">Selected Variation: {{ $damage->variation->variation_name }}</span>
                                                </div>
                                            @endif
                                            @if($errors->first('item_id'))
                                            <div class="uk-text-danger uk-margin-top">{{ $errors->first('item_id') }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label for="quantity_ctn_0">Quantity(ctn)<span style="color: red;"
                                                class="asterisc">*</span></label>
                                            <input class="md-input input-cls" type="text" id="quantity_ctn_0" name="quantity_ctn" value="{{ isset($damage->variation_id) && $damage->variation->carton_size != 0 ? ($damage->quantity/$damage->variation->carton_size) : ($damage->item->carton_size != 0 ? ($damage->quantity / $damage->item->carton_size) : 0) }}" oninput="calculateCtnToPcs(this)" required/>
                                            @if($errors->has('quantity_ctn'))
                                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('quantity_ctn') }}</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label for="quantity_pcs_0">Quantity(pcs)<span style="color: red;"
                                                class="asterisc">*</span></label>
                                            <input class="md-input input-cls"  type="text" id="quantity_pcs_0" name="quantity_pcs" value="{{ $damage->unit_id?($damage->quantity/$damage->basic_unit_conversion):$damage->quantity}}" oninput="calculatePcsToCtn(this)" required/>
                                            @if($errors->has('quantity_pcs'))
                                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('quantity_pcs') }}</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-4" style="padding-top: 10px;">
                                            <label for="item_category_id" class="">Unit <span style="color: red;"
                                                    class="asterisc">*</span></label>
                                            <select  name="unit_id" class="select2-single-search-dropdown"
                                                required >
                                                <option value="">Select Unit</option>
                                                @foreach($units as $unit)
                                                <option value="{{ $unit->id }}" {{ $damage->unit_id==$unit->id?'selected':'' }}>
                                                    {{ $unit->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            {{-- @if($errors->first('unit'))
                                            <div class="uk-text-danger uk-margin-top">{{ $errors->first('unit') }}
                                            </div>
                                            @endif --}}
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2" style="padding-top: 5px">
                                            <label for="date" class="">Date<span style="color: red;"
                                                    class="asterisc">*</span></label>
                                            <input class="md-input" type="text" id="date" name="date"
                                                value="{{ date('d-m-Y', strtotime($damage->date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}"
                                                required><span class="md-input-bar "></span>
                                            @if($errors->first('date'))
                                            <div class="uk-text-danger uk-margin-top">{{ $errors->first('date') }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="vendor_id" class="">Vendor<span style="color: red;"
                                                    class="asterisc">*</span></label><br>
                                            <select class="select2-single-search-dropdown" title="Select Vendor" id="vendor_id" name="vendor_id" required>
                                                <option value="">Select Vendor</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}" {{ $damage->vendor_id == $vendor->id ? 'selected' : '' }}>
                                                        {{ $vendor->display_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <label class="" for="note">@lang('trans.personal_note')</label>
                                            <textarea class="md-input" name="note" id="note" cols="30" rows="4">{{ $damage->note }}</textarea>
                                            @if($errors->first('note'))
                                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('note') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <br>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button type="submit" class="md-btn md-btn-primary submit-form-btn" >@lang('trans.submit')</button>
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
        var ajax_data = [] ;
        $.each(<?php echo $items; ?>, function (indexInArray, items) { 
            ajax_data[items.id] = items;
        });
        var items_chosen = [];
        items_chosen[0] = <?php echo $damage->item ?>;
        items_chosen[0]['variations'] = [];
        $.each(<?php echo $damage->item->itemVariations ?>, function (indexInArray, valueOfElement) { 
            items_chosen[0]['variations'][valueOfElement.id] = valueOfElement;
        });
        items_chosen[0]['variation_id'] = {!! json_encode(!isset($damage->variation_id)) !!} ? '' : {!! json_encode($damage->variation_id) !!};

        //show sub category by on change of select option

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_damage').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

    </script>
    
    <script>
        $('form[id="user_edit_form"]').validate({
            errorPlacement: function(label, element) {
                label.css('color', 'red');
                label.insertAfter(element);
            },
            wrapper: 'span'
        });
        $(document).ready(function() {
            $(window).keydown(function(e){
                if(e.keyCode == 13) {
                  e.preventDefault();
                  return false;
                }
            });
        });
        
        $(".submit-form-btn").click(function(e){
            $("#user_edit_form").submit();
        });
    </script>
@endsection
