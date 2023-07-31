@extends('layouts.main')

@section('title', 'Edit Asset')

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
            {!! Form::open(['url' => route('asset_update', $item->id), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Update Item</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <h3 class="full_width_in_card heading_c">
                                        @lang('trans.general_info')
                                    </h3>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                          <label class="" for="subject_name">Item Name<span style="color: red;" class="asterisc">*</span></label>
                                            <input class="md-input input-cls" type="text" id="item_name" name="item_name" oninput="nameUpdate()" value="{{ $item->item_name }}" required/>
                                            @if($errors->has('item_name'))
                                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('item_name') }}</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                          <label class="" for="barcode_no">Barcode</label>
                                            <input class="md-input input-cls" type="text" id="barcode_no" name="barcode_no" value="{{ $item->barcode_no }}"/>
                                            @if($errors->has('barcode_no'))
                                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('barcode_no') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-2-5">
                                          <label class="" for="item_name">@lang('trans.name')<span style="color: red;" class="asterisc">*</span></label>
                                            <input class="md-input" type="text" id="item_name" name="item_name" value="{{ $item->item_name }}" required/>
                                            @if($errors->has('item_name'))
                                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('item_name') }}</div>
                                            @endif
                                        </div>
                                          <div class="uk-width-medium-1-5">
                                            <label class="" for="item_name">Previous Name</label>
                                            <input class="md-input" type="text" id=""  value="{{ $item->item_name }}" disabled/>
                                          </div>
                                    </div> -->
                                    <div class="uk-grid" data-uk-grid-margin>
                                      <div class="uk-width-medium-1-3">
                                          <label for="item_sales_rate">Sales Rate</label>
                                          <input class="md-input" type="number" id="item_sales_rate" name="item_sales_rate" value="{{ $item->item_sales_rate }}" />
                                      </div>

                                      <div class="uk-width-medium-1-3">
                                          <label for="item_purchase_rate"> Buy Rate</label>
                                          <input class="md-input" type="number" id="item_purchase_rate" name="item_purchase_rate" value="{{ $item->item_purchase_rate }}"/>
                                      </div>

                                      <div class="uk-width-medium-1-3">
                                          <label for="unit_type">Unit Type</label>
                                          <input class="md-input" type="text" id="unit_type" name="unit_type" value="{{$item->unit_type}}"/>
                                      </div>
                                  </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                          <label class="" for="item_about">@lang('trans.about')</label>
                                            <textarea class="md-input" name="item_about" id="item_about" cols="30" rows="4">{{ $item->item_about }}</textarea>
                                            @if($errors->first('item_about'))
                                                <div class="uk-text-danger uk-margin-top">About is required.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button class="md-btn md-btn-primary submit-form-btn" >@lang('trans.submit')</button>
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

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_asset').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })

    </script>
    
    <script>
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
