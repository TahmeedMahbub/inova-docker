@extends('layouts.main')

@section('title', 'Inventory')

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
            {!! Form::open(['url' => route('inventory_barcode_generate', $item->id), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Generate Barcode</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                            <label for="barcode_name">Item Name:&nbsp&nbsp</label>
                                            <input type="text" name="barcode_name" id="barcode_name" value="{{ $item->item_name }}" readonly>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label for="barcode_code">Code:&nbsp&nbsp</label>
                                            <input type="text" name="barcode_code" id="barcode_code" value="{{ $item->barcode_no }}" readonly>
                                        </div>
                                        <div class="uk-width-medium-2-4">
                                          <label class="" for="barcode_amount">Number of Barcodes<span style="color: red;" class="asterisc">*:&nbsp&nbsp</span></label>
                                            <input type="text" id="barcode_amount" name="barcode_amount" required>
                                        </div>
                                    </div>
                                    
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-right">
                                            <input type="submit" name="submit" class="md-btn md-btn-primary" value="@lang('trans.submit')">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            @if(session()->has('barcodes'))
                            <div>
                                <span class="md-btn md-btn-primary" onclick="print()">Print</span>
                            </div>
                            @endif

                            <div id="print_barcode"> 
                            @if(session()->has('barcodes'))
                                {!! session()->get('barcodes') !!}
                            @endif
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
        function print() {
            w = window.open();
            w.document.write($('#print_barcode').html());
            w.document.close();
            w.print();
        }

        function nameUpdate(){

            var class_name      = $('#item_category').find(":selected").text();
            var batch_name      = $('#item_sub_category').find(":selected").text();
            var subject_name    = $('#subject_name').val();

            class_name          = $.trim(class_name);
            batch_name          = $.trim(batch_name);
            subject_name        = $.trim(subject_name);

            // $("#item_name").val(class_name + "-" + batch_name + "-" + subject_name);

        }

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })

    </script>

@endsection
