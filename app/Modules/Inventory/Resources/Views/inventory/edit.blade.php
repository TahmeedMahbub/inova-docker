@extends('layouts.main')

@section('title', 'Inventory')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
   <link rel="stylesheet" href="{{ asset('admin/assets/css/image-uploader.min.css') }}">
    <style media="screen">
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input {
            margin-top: 0;
        }

        .input-cls {
            margin-top: 12px
        }

        .uk-badge a {
            color: white
        }

        td>.select2-container {
            margin-bottom: 17px;
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
                'url' => route('inventory_update', $item->id),
                'method' => 'post',
                'class' => 'uk-form-stacked',
                'id' => 'user_edit_form',
                'files' => 'true',
                'enctype' => 'multipart/form-data',
            ]) !!}
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Update Product/Service </span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <h3 class="full_width_in_card heading_c">
                                    @lang('trans.general_info')
                                </h3>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-4">
                                        <label for="item_category_id" class="">Category <span style="color: red;"
                                                class="asterisc">*</span></label>
                                        <select id="item_category" name="item_category_id" onchange="categoryChange()"
                                            class="select2-single-search-dropdown" required>
                                            <option value="">Select Category</option>
                                            @foreach ($item_categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $item->itemCategory->id ? 'selected' : '' }}>
                                                    {{ $category->item_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->first('item_category_id'))
                                            <div class="uk-text-danger uk-margin-top">Category is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label for="item_sub_category_id" class="uk-vertical-align-middle"> Sub
                                            Category</label>
                                        <select id="item_sub_category" name="item_sub_category_id" onchange="nameUpdate()"
                                            class="select2-single-search-dropdown" >
                                            <option value="0">Select Sub Category</option>
                                            @foreach ($item_sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}"
                                                    {{ isset($item->itemSubcategory->id) && $sub_category->id == $item->itemSubCategory->id ? 'selected' : '' }}>
                                                    {{ $sub_category->item_sub_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label for="subject_name">Product/Service Name<span style="color: red;"
                                                class="asterisc">*</span></label>
                                        <input class="md-input input-cls" type="text" id="item_name" name="item_name"
                                            oninput="nameUpdate()" value="{{ $item->item_name }}" required />
                                        @if ($errors->has('item_name'))
                                            <div class="uk-text-danger uk-margin-top">{{ $errors->first('item_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label for="barcode_no">Barcode</label>
                                        <input class="md-input input-cls" type="text" id="barcode_no" name="barcode_no"
                                            value="{{ $item->barcode_no }}" />
                                        @if ($errors->has('barcode_no'))
                                            <div class="uk-text-danger uk-margin-top">{{ $errors->first('barcode_no') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-4">
                                        <label for="item_sales_rate">@lang('trans.unit_type')</label>
                                        <select name="unit_id" id="unit_id" class="select2-single-search-dropdown">
                                            @foreach ($units as $unit)
                                                <option value="{{$unit->id}}" {{$unit->id == $item->unit_id ? 'selected' : ''}}>{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label for="item_purchase_rate">Pcs Per Carton</label>
                                        <input class="md-input" type="number" id="carton_unit" name="carton_unit"
                                            value="{{ $item->carton_size }}" />
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label for="sop_file">SOP Files</label><br>
                                            <div class="sop_files_edit"></div>
                                            <div>

                                               @foreach( $item_multiple_files->where('sop_file','!=',null)  as $file)
                                                @php
                                                 $ext = File::extension($file->sop_file);
                                                
                                                @endphp
                                                 @if( $ext == 'jpg'||  $ext == 'jpeg'||  $ext == 'png' || $ext == 'JPG'||  $ext == 'JPEG'||  $ext == 'PNG')
                                                 <div class="uk-grid">
                                                 <div class="uk-width-medium-1-1">
                                                     <img src="{{ asset($file->sop_file) }}" alt="description of myimage" height="200" width="200">
                                                     <a href="{{route('item_multi_file_delete',['id' => $file->id])}}"><i class="material-icons">&#xE872;</i></a>
                                                     
                                                 </div>
                                                </div>
                                                @elseif( $ext == 'xlsx'|| $ext == 'xls' )
                                                <div class="uk-grid">
                                                 <div class="uk-width-medium-1-1">
                                                     @php
                                                     $file_name=trim($file->sop_file,"uploads/sopFiles/");
                                                     @endphp
                                                    
                                                     <a href="{{route('track_excel_file_download',['id' => $file->id])}}"> {{$file_name}}</a> 
                                                     <a href="{{route('item_multi_file_delete',['id' => $file->id])}}"><i class="material-icons">&#xE872;</i></a>                                       
                                                 </div>
                                                </div>
                                                @elseif( $ext == 'pdf' )
                                                <div class="uk-grid">
                                                 <div class="uk-width-medium-1-1">
                                                     @php
                                                     $file_name=trim($file->sop_file,"uploads/sopFiles/");
                                                     @endphp
                                                  
                                                     <a href="{{route('track_excel_file_download',['id' => $file->id])}}"> {{$file_name}}</a>  
                                                     <a href="{{route('item_multi_file_delete',['id' => $file->id])}}"><i class="material-icons">&#xE872;</i></a>                                      
                                                 </div>
                                                </div>
                                                @elseif( $ext == 'pptx' ||$ext == 'ppt' )
                                                <div class="uk-grid">
                                                 <div class="uk-width-medium-1-1">
                                                     @php
                                                     $file_name=trim($file->sop_file,"uploads/sopFiles/");
                                                     @endphp
                                                  
                                                     <a href="{{route('track_excel_file_download',['id' => $file->id])}}"> {{$file_name}}</a> 
                                                     <a href="{{route('item_multi_file_delete',['id' => $file->id])}}"><i class="material-icons">&#xE872;</i></a>                                       
                                                 </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                
                                            </div>
                                    </div>

                                    <div class="uk-width-medium-1-4">
                                        <label for="design_file">DESIGN Files</label><br>
                                        <div class="design_files_edit"></div>


                                            <div>

                                                @foreach( $item_multiple_files->where('design_file','!=',null)  as $file)
                                                 @php
                                                  $ext = File::extension($file->design_file);
                                                 
                                                 @endphp
                                                  @if( $ext == 'jpg'||  $ext == 'jpeg'||  $ext == 'png' ||  $ext == 'PNG')
                                                  <div class="uk-grid">
                                                  <div class="uk-width-medium-1-1">
                                                      <img src="{{ asset($file->design_file) }}" alt="description of myimage" height="200" width="200">
                                                      <a href="{{route('item_multi_file_delete',['id' => $file->id])}}"><i class="material-icons">&#xE872;</i></a>
                                                      
                                                  </div>
                                                 </div>
                                                 @elseif( $ext == 'xlsx'|| $ext == 'xls' )
                                                 <div class="uk-grid">
                                                  <div class="uk-width-medium-1-1">
                                                      @php
                                                      $file_name=trim($file->design_file,"uploads/designFiles/");
                                                      @endphp
                                                     
                                                      <a href="{{route('track_excel_file_download',['id' => $file->id])}}"> {{$file_name}}</a> 
                                                      <a href="{{route('item_multi_file_delete',['id' => $file->id])}}"><i class="material-icons">&#xE872;</i></a>                                       
                                                  </div>
                                                 </div>
                                                 @elseif( $ext == 'pdf' )
                                                 <div class="uk-grid">
                                                  <div class="uk-width-medium-1-1">
                                                      @php
                                                      $file_name=trim($file->design_file,"uploads/designFiles/");
                                                      @endphp
                                                   
                                                      <a href="{{route('track_excel_file_download',['id' => $file->id])}}"> {{$file_name}}</a>  
                                                      <a href="{{route('item_multi_file_delete',['id' => $file->id])}}"><i class="material-icons">&#xE872;</i></a>                                      
                                                  </div>
                                                 </div>
                                                 @elseif( $ext == 'pptx' ||$ext == 'ppt' )
                                                 <div class="uk-grid">
                                                  <div class="uk-width-medium-1-1">
                                                      @php
                                                      $file_name=trim($file->design_file,"uploads/designFiles/");
                                                      @endphp
                                                   
                                                      <a href="{{route('track_excel_file_download',['id' => $file->id])}}"> {{$file_name}}</a> 
                                                      <a href="{{route('item_multi_file_delete',['id' => $file->id])}}"><i class="material-icons">&#xE872;</i></a>                                       
                                                  </div>
                                                 </div>
                                                 @endif
                                                 @endforeach
                                                 
                                             </div>
                                    </div>


                                </div>

                                <div class="uk-grid item-attr-container" data-uk-grid-margin>
                                    @if(count($item_attribute_values) < 1)
                                        <div class="uk-width-medium-1-4" id="item-attr-section-0" style="display: flex">
                                            <div class="md-input-wrapper">
                                                <a data-toggle="uk-modal" data-uk-modal="{target:'#addAttribute'}"
                                                    id="item-attribute-modal-0" type="submit"
                                                    class="sm-btn sm-btn-primary modal-action"
                                                    data-modal_id="item-attribute-modal-0" onclick="attrBtn(this)"
                                                    style="width: 90%;">
                                                    <span class="uk-badge uk-align-center uk-margin-small-top">
                                                        Create New
                                                        Attribute
                                                    </span>
                                                </a>
                                                <select id="item_attribute_id_0_0"
                                                    class="select2-single-search-dropdown" name="item_attribute[]"
                                                    onchange="populateValues(this)">
                                                    <option value="">Select Attribute</option>
                                                    @foreach ($attributes as $attribute)
                                                        <option value="{{ $attribute->id }}">
                                                            {{ $attribute->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('item_attribute.*.*'))
                                                    <div class="uk-text-danger uk-text-center ">Attributes must be
                                                        selected for all fields.
                                                    </div>
                                                @endif
                                                <select id="item_attributes_value_0_0"
                                                    class="select2-single-search-dropdown value-select2"
                                                    name="item_attributes_value[]" onchange="">
                                                    <option value="">Select Value</option>
                                                </select>
                                                @if ($errors->has('item_attributes_value.*.*'))
                                                    <div class="uk-text-danger uk-text-center ">Values must be
                                                        selected for all fields.
                                                    </div>
                                                @endif
                                            </div>
                                            <div style="padding-top: 10px; text-align: center">
                                                <label for="measureable_attr_0">Measurable</label>
                                                <input type="hidden" name="measurable_attr[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                                <span class="uk-input-group-addon" id="item_add_section_btn_0_0">
                                                    <a href="javascript:void(0)" class="itemBtnSectionClone"
                                                        onclick="addItemAttributeSection(this)"><i
                                                            class="material-icons md-24">&#xE146;</i></a>
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($item_attribute_values as $key => $item_attribute_value)
                                            <div class="uk-width-medium-1-4" id="item-attr-section-{{$key}}" style="display: flex">
                                                <div class="md-input-wrapper">
                                                    <a data-toggle="uk-modal" data-uk-modal="{target:'#addAttribute'}"
                                                        id="item-attribute-modal-{{$key}}" type="submit"
                                                        class="sm-btn sm-btn-primary modal-action"
                                                        data-modal_id="item-attribute-modal-{{$key}}" onclick="attrBtn(this)"
                                                        style="width: 90%;">
                                                        <span class="uk-badge uk-align-center uk-margin-small-top">
                                                            Create New
                                                            Attribute
                                                        </span>
                                                    </a>
                                                    <select id="item_attribute_id_0_{{$key}}"
                                                        class="select2-single-search-dropdown" name="item_attribute[]"
                                                        onchange="populateValues(this)">
                                                        <option value="">Select Attribute</option>
                                                        @foreach ($attributes as $attribute)
                                                            <option value="{{ $attribute->id }}" {{$item_attribute_value->attributeValues->attribute_id == $attribute->id ? "selected" : ""}}>
                                                                {{ $attribute->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('item_attribute.*.*'))
                                                        <div class="uk-text-danger uk-text-center ">Attributes must be
                                                            selected for all fields.
                                                        </div>
                                                    @endif
                                                    <select id="item_attributes_value_0_{{$key}}"
                                                        class="select2-single-search-dropdown value-select2"
                                                        name="item_attributes_value[]" onchange="">
                                                        <option value="">Select Value</option>
                                                        @foreach ($attribute_values->where('attribute_id', $item_attribute_value->attributeValues->attribute_id) as $attribute_value)
                                                            <option value="{{ $attribute_value->id }}" {{ $attribute_value->value == $item_attribute_value->attributeValues->value ? "selected" : "" }}>{{ $attribute_value->value }}</option>                                                        
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('item_attributes_value.*.*'))
                                                        <div class="uk-text-danger uk-text-center ">Values must be
                                                            selected for all fields.
                                                        </div>
                                                    @endif
                                                </div>
                                                <div style="padding-top: 10px; text-align: center">
                                                    <label for="measureable_attr_{{$key}}">Measurable</label>
                                                    <input type="hidden" name="measurable_attr[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ $item_attribute_value->measurable == 1 ? "checked" : "" }}>
                                                    <span class="uk-input-group-addon" id="item_add_section_btn_0_{{$key}}">
                                                        @if($loop->last == 1)
                                                        <a href="javascript:void({{$key}})" class="itemBtnSectionClone" onclick="addItemAttributeSection(this)">
                                                            <i class="material-icons md-24">&#xE146;</i>
                                                        </a>
                                                        @else
                                                            <a href="javascript:void(0)" class="itemBtnSectionRemove" onclick="removeItemAttributeSection(this)"><i class="material-icons md-24">delete</i></a>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>                               
                                        @endforeach
                                    @endif
                                </div>
                                    

{{-- <span class="uk-input-group-addon" id="item_add_section_btn_0_0">
    <a href="javascript:void(0)" class="itemBtnSectionClone" onclick="addItemAttributeSection(this)"><i class="material-icons md-24"></i></a>
</span>
<span class="uk-input-group-addon" id="item_add_section_btn_0_0">
    <a href="javascript:void(0)" class="itemBtnSectionRemove" onclick="removeItemAttributeSection(this)"><i class="material-icons md-24">delete</i></a>
</span> --}}
                                        

                                <h3 class="full_width_in_card heading_c hidden">
                                    @lang('trans.product_variations')
                                </h3>

                                <div class="uk-grid uk-margin-large-top hidden" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1 uk-overflow-container">
                                        <table class="input_fields_wrap uk-table">
                                            <thead>
                                                <tr>
                                                    <th class="hidden"></th>
                                                    <th class="uk-text-nowrap">#</th>
                                                    <th class="uk-text-nowrap" width="10%">Attribute<span
                                                            style="color: red;" class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap" width="10%">Value<span
                                                            style="color: red;" class="asterisc">*</span></th>
                                                    <th></th>
                                                    <th class="uk-text-nowrap">Name<span style="color: red;"
                                                            class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap">Pcs Per Carton</th>
                                                    <th class="uk-text-nowrap">SKU</th>
                                                    <th class="uk-text-nowrap">Sale Price(pcs)</th>
                                                    <th class="uk-text-nowrap">Purchase Price(pcs)</th>
                                                    <th class="uk-text-nowrap">Note</th>
                                                    <th class="uk-text-nowrap">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="getMultipleRow">
                                                @if (count($item_variations) > 0)
                                                    @foreach ($item_variations as $row => $variation)
                                                        <tr class="tr_{{ $row }}" id="data_clone">
                                                            <td>
                                                                <p style="padding-top: 20px">{{ $row + 1 }}</p>
                                                            </td>

                                                            <td id="tr_{{ $row }}_attribute"
                                                                style="padding-top: 25px; position: relative;" width="10%">
                                                                <a data-toggle="uk-modal"
                                                                    data-uk-modal="{target:'#addAttribute'}"
                                                                    id="attribute-modal-{{ $row }}" type="submit"
                                                                    class="sm-btn sm-btn-primary modal-action"
                                                                    data-modal_id="attribute-modal-{{ $row }}"
                                                                    onclick="attrBtn(this)"
                                                                    style="width: 90%; position: absolute; top: 0">
                                                                    <span class="uk-badge uk-align-center uk-margin-small-top">
                                                                        Create New
                                                                        Attribute
                                                                    </span>
                                                                </a>
                                                                @foreach ($variation->itemVariationAttributeValues as $column => $itemAttribute)
                                                                    <select
                                                                        id="attribute_id_{{ $row }}_{{ $column }}"
                                                                        class="select2-single-search-dropdown"
                                                                        name="attributes[{{ $row }}][]"
                                                                        onchange="populateValues(this)">
                                                                        <option value="">Select Attribute</option>
                                                                        @foreach ($attributes as $attribute)
                                                                            <option value="{{ $attribute->id }}"
                                                                                {{ $attribute->id == $itemAttribute->attributeValues->attribute->id ? 'selected' : '' }}>
                                                                                {{ $attribute->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('attributes.'.$row.'.'.$column))
                                                                        <div class="uk-text-danger uk-text-center ">Attribute
                                                                            must be
                                                                            selected
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td id="tr_{{ $row }}_value" width="15%"
                                                                style="padding-top: 25px">
                                                                @foreach ($variation->itemVariationAttributeValues as $column => $itemValue)
                                                                    <select
                                                                        id="attributes_value_{{ $row }}_{{ $column }}"
                                                                        class="select2-single-search-dropdown value-select2"
                                                                        name="attributes_value[{{ $row }}][]"
                                                                        onchange="" >
                                                                        <option value="">Select Value</option>
                                                                        @foreach ($itemValue->attributeValues->attribute->attributeValues as $attributeValue)
                                                                            <option value="{{ $attributeValue->id }}"
                                                                                {{ $attributeValue->id == $itemValue->attribute_values_id ? 'selected' : '' }}>
                                                                                {{ $itemValue->attributeValues->value }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('attributes_value.'.$row.'.'.$column))
                                                                        <div class="uk-text-danger uk-text-center ">Value must
                                                                            be
                                                                            selected
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td id="tr_{{ $row }}_add_section">
                                                                @foreach ($variation->itemVariationAttributeValues as $column=>$index)
                                                                <div style="padding-top: 20px">
                                                                    @if ($column == 0)
                                                                        <span class="uk-input-group-addon"
                                                                            id="add_section_btn_{{ $row }}_{{ $column }}">
                                                                            <a href="javascript:void(0)"
                                                                                class="btnSectionClone"
                                                                                onclick="addAttributeSection(this)"><i
                                                                                    class="material-icons md-24">&#xE146;</i></a>
                                                                        </span>
                                                                    @else
                                                                        <span class="uk-input-group-addon"
                                                                            id="add_section_btn_{{ $row }}_{{ $column }}">
                                                                            <a href="javascript:void(0)"
                                                                                class="btnSectionRemove"
                                                                                onclick="removeAttributeSection(this)"><i
                                                                                    class="material-icons md-24">delete</i></a>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                    id="variation_name_id_{{ $row }}"
                                                                    name="variation_name_id[]" class="md-input"
                                                                    value="{{ $variation->variation_name }}" />
                                                                @if ($errors->first('variation_name_id.' . $row))
                                                                    <div class="uk-text-danger uk-margin-top">Variation name is
                                                                        required.</div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input type="number" id="carton_size_{{ $row }}"
                                                                    name="carton_size[]" class="md-input"
                                                                    value="{{ $variation->carton_size }}" oninput="" />
                                                                @if ($errors->first('carton_size.' . $row))
                                                                    <div class="uk-text-danger uk-margin-top">
                                                                        {{ $errors->first('carton_size.' . $row) }}
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input type="text" id="sku_id_{{ $row }}"
                                                                    name="sku[]" class="md-input"
                                                                    value="{{ $variation->sku }}" oninput="" />
                                                                @if ($errors->first('sku.' . $row))
                                                                    <div class="uk-text-danger uk-margin-top">
                                                                        {{ $errors->first('sku.' . $row) }}
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input id="item_sales_rate_id_{{ $row }}"
                                                                    type="number" class="md-input" name="item_sales_rate[]"
                                                                    value="{{ $variation->variation_sales_rate }}"
                                                                    oninput="">
                                                                @if ($errors->first('item_sales_rate.' . $row))
                                                                    <div class="uk-text-danger uk-margin-top">Sale rate is
                                                                        required.</div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input id="item_purchase_rate_id_{{ $row }}"
                                                                    type="number" class="md-input"
                                                                    name="item_purchase_rate[]"
                                                                    value="{{ $variation->variation_purchase_rate }}"
                                                                    oninput="">
                                                                @if ($errors->first('item_purchase_rate.' . $row))
                                                                    <div class="uk-text-danger uk-margin-top">Purchase rate is
                                                                        required.</div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <textarea name="item_about[]" id="item_about_id_{{ $row }}" rows="2">{{ $variation->variation_about }}</textarea>
                                                                @if ($errors->first('item_about.' . $row))
                                                                    <div class="uk-text-danger uk-margin-top">About is
                                                                        required.
                                                                    </div>
                                                                @endif

                                                            </td>
                                                            <td style="text-align: center">
                                                                @if ($row == 0)
                                                                    <a href="#" class="add_field_button">
                                                                        <i style="padding-top: 10px"
                                                                            class="material-icons md-36">&#xE146;</i>
                                                                    </a>
                                                                @else
                                                                    <a href="#" class="remove_field">
                                                                        <i style="padding-top: 10px"
                                                                            class="material-icons md-36">delete</i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="tr_0" id="data_clone">
                                                        <td>
                                                            <p style="padding-top: 20px">1</p>
                                                        </td>

                                                        <td id="tr_0_attribute" style="padding-top: 25px; position: relative;"
                                                            width="10%">
                                                            <a data-toggle="uk-modal" data-uk-modal="{target:'#addAttribute'}"
                                                                id="attribute-modal-0" type="submit"
                                                                class="sm-btn sm-btn-primary modal-action"
                                                                data-modal_id="attribute-modal-0" onclick="attrBtn(this)"
                                                                style="width: 90%; position: absolute; top: 0">
                                                                <span class="uk-badge uk-align-center uk-margin-small-top">
                                                                    Create New
                                                                    Attribute
                                                                </span>
                                                            </a>
                                                            <select id="attribute_id_0_0"
                                                                class="select2-single-search-dropdown" name="attributes[0][]"
                                                                onchange="populateValues(this)" >
                                                                <option value="">Select Attribute</option>
                                                                @foreach ($attributes as $attribute)
                                                                    <option value="{{ $attribute->id }}">
                                                                        {{ $attribute->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('attribute.*.*'))
                                                                <div class="uk-text-danger uk-text-center ">Attributes must be
                                                                    selected for all fields.
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td id="tr_0_value" width="15%" style="padding-top: 25px">
                                                            <select id="attributes_value_0_0"
                                                                class="select2-single-search-dropdown value-select2"
                                                                name="attributes_value[0][]" onchange="">
                                                                <option value="">Select Value</option>
                                                            </select>
                                                            @if ($errors->has('attributes_value.*.*'))
                                                                <div class="uk-text-danger uk-text-center ">Values must be
                                                                    selected for all fields.
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td id="tr_0_add_section">
                                                            <div style="padding-top: 20px">
                                                                <span class="uk-input-group-addon" id="add_section_btn_0_0">
                                                                    <a href="javascript:void(0)" class="btnSectionClone"
                                                                        onclick="addAttributeSection(this)"><i
                                                                            class="material-icons md-24">&#xE146;</i></a>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="variation_name_id_0"
                                                                name="variation_name_id[]" class="md-input" value="" />
                                                            @if ($errors->first('variation_name_id.*'))
                                                                <div class="uk-text-danger uk-margin-top">Variation name is
                                                                    required.</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input type="number" id="carton_size_0"
                                                                name="carton_size[]" value="" class="md-input"/>
                                                            @if ($errors->first('carton_size.*'))
                                                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('carton_size.*') }}</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input type="text" id="sku_id_0" name="sku[]"
                                                                class="md-input" value="" oninput="" />
                                                            @if ($errors->first('sku.*'))
                                                                <div class="uk-text-danger uk-margin-top">{{ $errors->first('sku.*') }}</div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input id="item_sales_rate_id_0" type="number" class="md-input"
                                                                name="item_sales_rate[]" value="0" oninput="">
                                                            @if ($errors->first('item_sales_rate.*'))
                                                                <div class="uk-text-danger uk-margin-top">Sale rate is
                                                                    required.</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input id="item_purchase_rate_id_0" type="number"
                                                                class="md-input" name="item_purchase_rate[]" value="0"
                                                                oninput="">
                                                            @if ($errors->first('item_purchase_rate.*'))
                                                                <div class="uk-text-danger uk-margin-top">Purchase rate is
                                                                    required.</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <textarea name="item_about[]" id="item_about_id_0" rows="2"></textarea>
                                                            @if ($errors->first('item_about.*'))
                                                                <div class="uk-text-danger uk-margin-top">About is required.
                                                                </div>
                                                            @endif

                                                        </td>
                                                        <td style="text-align: center">
                                                            <a href="#" class="add_field_button">
                                                                <i style="padding-top: 10px"
                                                                    class="material-icons md-36">&#xE146;</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <table style="float:right;margin-top:-20px !important " class="add_table">
                                            <tr>
                                                <td style="text-align: center">
                                                    <a href="#" class="add_field_button">
                                                        <i style="padding-top: 10px"
                                                            class="material-icons md-36">&#xE146;</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-text-right">
                                        <button type="submit"
                                            class="md-btn md-btn-primary submit-form-btn">@lang('trans.submit')</button>
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
<script src="{{ asset('admin/assets/js/image-uploader.min.js') }}"></script>
    <script type="text/javascript">
       
        var modal_attr_id = 0;
        //show sub category by on change of select option
        function categoryChange() {

            var main_category = $('#item_category').val();

            $.get("{{ route('inventory_sub_category_show', ['id' => '']) }}/" + main_category, function(data) {

                var list = '';

                list = '<option value = "0">' + "Select Sub Category" + '</option>';

                $.each(data, function(i, data) {
                    list += '<option value = "' + data.id + '">' + data.item_sub_category_name +
                        '</option>';
                });

                $("#item_sub_category").html(list);

            });

            nameUpdate();

        }

        function nameUpdate() {

            var class_name = $('#item_category').find(":selected").text();
            var batch_name = $('#item_sub_category').find(":selected").text();
            var subject_name = $('#subject_name').val();

            class_name = $.trim(class_name);
            batch_name = $.trim(batch_name);
            subject_name = $.trim(subject_name);

            // $("#item_name").val(class_name + "-" + batch_name + "-" + subject_name);

        }

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        })
    </script>

    <script>
        $(document).ready(function() {
            $(window).keydown(function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    return false;
                }
            });

            $.get("{{ route('attribute_list') }}", function(data) {
                max_attribute_fields = data.length + 1;
            });
        });

        $(".submit-form-btn").click(function(e) {
            $("#user_edit_form").submit();
        });


        var max_attribute_fields = 1;
        var max_fields = 50; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var index_no = 1;

        //For apending another rows start
        var x = 0;
        $(add_button).click(function(e) {
            e.preventDefault();

            var x = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);

            if (x < max_fields) {
                x++;
                var serial = x + 1;

                $('.getMultipleRow').append(' ' + '<tr class="tr_' + x + '">' +
                    '<td>\n' + '<p style="padding-top: 10px">' + serial + '</p>' + '</td>\n' +
                    '<td id="tr_' + x +
                    '_attribute" style="padding-top: 25px; position: relative;" width="10%">\n' +
                    '<a data-toggle="uk-modal" data-uk-modal="{target:`#addAttribute`}"' +
                    'id="attribute-modal-' + x +
                    '" type="submit" class="sm-btn sm-btn-primary modal-action" data-modal_id="attribute-modal-' +
                    x +
                    '" onclick="attrBtn(this)" style="width: 90%; position: absolute; top: 0">\n' +
                    '<span class="uk-badge uk-align-center uk-margin-small-top">Create New Attribute</span>\n' +
                    '</a><select id="attribute_id_' + x +
                    '_0" class="select2-single-search-dropdown" name="attributes[' + x + '][]"' +
                    'onchange="populateValues(this)" >' +
                    '<option value="">Select Attribute</option>' +
                    '</select>' +
                    '</td>' +
                    '<td id="tr_' + x + '_value" width="15%" style="padding-top: 25px">\n' +
                    '<select id="attributes_value_' + x +
                    '_0" class="select2-single-search-dropdown value-select2" name="attributes_value[' + x +
                    '][]" onchange="" >' +
                    '<option value="">Select Value</option></select>' +
                    '</td>' +
                    '<td id="tr_' + x + '_add_section">' +
                    '<div style="padding-top: 20px">' +
                    '<span class="uk-input-group-addon" id="add_section_btn_' + x +
                    '_0"><a href="javascript:void(0)" class="btnSectionClone" onclick="addAttributeSection(this)">' +
                    '<i class="material-icons md-24">&#xE146;</i></a></span>' +
                    '</div>' +
                    '</td>' +
                    '<td>\n' + '<div class="md-input-wrapper"><input type="text" id="variation_name_id_' + x +
                    '" name="variation_name_id[]" class="md-input" value="" >\n<span class="md-input-bar"></span></div>' + '</td>\n' +
                    '<td>\n' + '<input type="number" id="carton_size_'+ x +
                    '" name="carton_size[]" class="md-input" value=""/>\n' + '</td>\n'+
                    '<td>\n' + '<input type="text" id="sku_id_' + x +
                    '" class="md-input" name="sku[]" value="" oninput=""/>\n' +
                    '</td>\n' +
                    '<td>\n' + '<input type="number" id="item_sales_rate_id_' + x +
                    '" class="md-input" name="item_sales_rate[]" value="0" oninput=""/>\n' + '</td>\n' +
                    '<td>\n' + '<input type="number" id="item_purchase_rate_id_' + x +
                    '" class="md-input" name="item_purchase_rate[]" value="0" oninput=""/>\n' + '</td>\n' +
                    '<td>\n' + '<textarea id="item_about_id_' + x + '" name="item_about[]" row="2">\n' +
                    '</textarea>\n' +
                    '</td>\n' +
                    '<td style="text-align: center">\n' + '<a href="#" data-val="' + x +
                    '" class="remove_field">\n' +
                    '<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n' + '</a>\n' +
                    '</td>\n' +
                    '</tr>\n');
                $('.select2-single-search-dropdown').select2({
                    width: 'element'
                });
                $('td>.select2-container').css('margin-bottom', '17px');

                $.get("{{ route('attribute_list') }}", function(data) {

                    var list5 = '';
                    var list7 = '';

                    $.each(data, function(i, data) {
                        list5 += '<option value = "' + data.id + '">' + data.name +
                            '</option>';

                    });

                    list7 += '<option value = "">' + 'Select Attribute  ' + '</option>';

                    $("#attribute_id_" + x + '_0').empty();
                    $("#attribute_id_" + x + '_0').append(list7);
                    $("#attribute_id_" + x + '_0').append(list5);
                });
            }
            if (serial > 1) {
                $('.add_table').css('display', 'inline');
            }
        });
        //For apending another rows end

        $(wrapper).on("click", ".remove_field", function(e) {
            e.preventDefault();
            //removing input array when delete tr 
            var serial_no_of_tr = $(this).data('val');
            var serial_input_value = $("#serial_" + serial_no_of_tr).val();

            if (serial_input_value != 'undefined') {
                $(this).parent().parent().remove();
                x--;
            }
        });

        function addItemAttributeSection(e){
            var current_section = parseInt($(e).parent().attr('id').match(/(\d+)/g)[1]);
            current_section = current_section + 1;
            $('.item-attr-container').append(
                `<div class="uk-width-medium-1-4" id="item-attr-section-${current_section}" style="display: flex">
                    <div class="md-input-wrapper">
                        <a data-toggle="uk-modal" data-uk-modal="{target:'#addAttribute'}"
                            id="item-attribute-modal-${current_section}" type="submit"
                            class="sm-btn sm-btn-primary modal-action"
                            data-modal_id="item-attribute-modal-${current_section}" onclick="attrBtn(this)"
                            style="width: 90%;">
                            <span class="uk-badge uk-align-center uk-margin-small-top">
                                Create New
                                Attribute
                            </span>
                        </a>
                        <select id="item_attribute_id_0_${current_section}"
                            class="select2-single-search-dropdown" name="item_attribute[]"
                            onchange="populateValues(this)" >
                            <option value="">Select Attribute</option>
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}">
                                    {{ $attribute->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('item_attribute.*.*'))
                            <div class="uk-text-danger uk-text-center ">Attributes must be
                                selected for all fields.
                            </div>
                        @endif
                        <select id="item_attributes_value_0_${current_section}"
                            class="select2-single-search-dropdown value-select2"
                            name="item_attributes_value[]" onchange="" >
                            <option value="">Select Value</option>
                        </select>
                        @if ($errors->has('item_attributes_value.*.*'))
                            <div class="uk-text-danger uk-text-center ">Values must be
                                selected for all fields.
                            </div>
                        @endif
                    </div>
                    <div style="padding-top: 10px; text-align: center">
                        <label for="measureable_attr_${current_section}">Measurable</label>
                        <input type="hidden" name="measurable_attr[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                        <span class="uk-input-group-addon" id="item_add_section_btn_0_${current_section}">
                            <a href="javascript:void(0)" class="itemBtnSectionClone"
                                onclick="addItemAttributeSection(this)"><i
                                    class="material-icons md-24">&#xE146;</i></a>
                        </span>
                    </div>
                </div>`
            );
            $('.select2-single-search-dropdown').select2();
            $.get("{{ route('attribute_list') }}", function(data) {

                var list5 = '';
                var list7 = '';

                $.each(data, function(i, data) {
                    list5 += '<option value = "' + data.id + '">' + data.name +
                        '</option>';

                });

                list7 += '<option value = "">' + 'Select Attribute  ' + '</option>';

                $("#item_attribute_id_0_" + current_section + '').empty();
                $("#item_attribute_id_0_" + current_section + '').append(list7);
                $("#item_attribute_id_0_" + current_section + '').append(list5);
            });
            $(e).removeClass('itemBtnSectionClone').addClass('itemBtnSectionRemove').attr('onclick',
                    'removeItemAttributeSection(this)')
                .children().html('delete');
        }        

        function removeItemAttributeSection(e) {
            var current_section = parseInt($(e).parent().attr('id').match(/(\d+)/g)[1]);
            $('#item-attr-section-'+current_section).remove();
        }
        

        function addAttributeSection(e) {
            var current_row = $(e).parent().parent().parent().parent().attr('class').match(/(\d+)/g)[0];
            var current_section = 0;
            $('.value-input-cls-' + current_row).each(function() {
                console.log(current_section, $(this).attr('id'));
                current_section = parseInt($(this).attr('id').match(/(\d+)/g)[1]) > current_section ? parseInt($(
                    this).attr('id').match(/(\d+)/g)[1]) : current_section;
            });
            current_section = current_section + 1;
            $('#tr_' + current_row + '_attribute a:first-child').after(
                '<select id="attribute_id_' + current_row + '_' + current_section +
                '" class="select2-single-search-dropdown"' +
                'name="attributes[' + current_row + '][]" onchange="populateValues(this)" >\n' +
                '<option value="">Select Attribute</option>\n' +
                '</select>\n'
            );
            $('#tr_' + current_row + '_value').prepend(

                '<select id="attributes_value_' + current_row + '_' + current_section +
                '" class="select2-single-search-dropdown value-select2" name="attributes_value[' + current_row +
                '][]" onchange="" >' +
                '<option value="">Select Value</option></select>'
            );
            $('#tr_' + current_row + '_add_section').prepend(
                '<div style="padding-top: 20px">' +
                '<span class="uk-input-group-addon" id="add_section_btn_' + current_row + '_' + current_section +
                '"><a href="javascript:void(0)" class="btnSectionClone" onclick="addAttributeSection(this)">' +
                '<i class="material-icons md-24">&#xE146;</i></a></span>' +
                '</div>'
            )
            $('.select2-single-search-dropdown').select2();
            $('td>.select2-container').css('margin-bottom', '17px');
            $.get("{{ route('attribute_list') }}", function(data) {

                var list5 = '';
                var list7 = '';

                $.each(data, function(i, data) {
                    list5 += '<option value = "' + data.id + '">' + data.name +
                        '</option>';

                });

                list7 += '<option value = "">' + 'Select Attribute  ' + '</option>';

                $("#attribute_id_" + current_row + '_' + current_section + '').empty();
                $("#attribute_id_" + current_row + '_' + current_section + '').append(list7);
                $("#attribute_id_" + current_row + '_' + current_section + '').append(list5);
            });
            $(e).removeClass('btnSectionClone').addClass('btnSectionRemove').attr('onclick',
                    'removeAttributeSection(this)')
                .children().html('delete');
        }

        function removeAttributeSection(e) {
            var current_row = parseInt($(e).parent().attr('id').match(/(\d+)/g)[0]);
            var current_section = parseInt($(e).parent().attr('id').match(/(\d+)/g)[1]);

            $('#attribute_id_' + current_row + '_' + current_section).next().remove();
            $('#attribute_id_' + current_row + '_' + current_section).remove();
            $('#attributes_value_' + current_row + '_' + current_section).next().remove();
            $('#attributes_value_' + current_row + '_' + current_section).remove();
            $(e).parent().parent().remove();
        }

        function attrBtn(e) {
            modal_attr_id = $(e).next().attr('id');
        }

        //Submit Attribute

        $('#submitAttributeBtn').click(function(e) {
            e.preventDefault();
            var attribute_name = $('#attribute_name').val();
            var attribute_values = [];

            $('input[name="attributes_value[]"]').each(function() {
                if ($(this).val == '') {
                    $('#addAttribute').modal('show');
                    attribute_values = [];
                    return false;
                } else {
                    attribute_values.push($(this).val());
                }
            });

            $.ajax({

                type: 'post',
                url: '/api/attributes/store',
                data: {
                    attribute_name: attribute_name,
                    attribute_values: attribute_values
                },

                success: function(data) {

                    UIkit.notify({
                        message: data.success,
                        status: 'success',
                        timeout: 2000,
                        pos: 'top-right'
                    });

                    $('#' + modal_attr_id).append($('<option>', {
                        value: data.id,
                        text: data.name,
                        'selected': 'selected'
                    }));

                    var row = modal_attr_id.match(/(\d+)/g)[0];
                    var column = modal_attr_id.match(/(\d+)/g)[1];
                    var id = data.id;
                    var url = "{{ route('attribute_value_list', ':id') }}";
                    url = url.replace(':id', id);

                    $.ajax({
                        type: "get",
                        url: url,
                        success: function(response) {
                            $('#attributes_value_' + row + '_' + column).empty();
                            $('#attributes_value_' + row + '_' + column).append($(
                                '<option>', {
                                    value: '',
                                    text: 'Select Value',
                                }));
                            $.each(response, function(i, data) {
                                $('#attributes_value_' + row + '_' + column).append(
                                    $('<option>', {
                                        value: data.id,
                                        text: data.value,
                                    }));
                            });
                        }
                    });

                    $('#addAttribute').hide();

                },

                error: function(data) {

                    UIkit.notify({
                        message: data.responseJSON.errors.attribute_name[0],
                        status: 'danger',
                        timeout: 2000,
                        pos: 'top-right'
                    });

                }

            });
        });

        function populateValues(e) {
            var id_prefix = $(e).attr('id').split("_")[0];
            var row = $(e).attr('id').match(/(\d+)/g)[0];
            var column = $(e).attr('id').match(/(\d+)/g)[1];
            var id = $(e).val();
            var url = "{{ route('attribute_value_list', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                type: "get",
                url: url,
                success: function(response) {
                    $('#'+ (id_prefix == 'item' ? 'item_' : '') + 'attributes_value_' + row + '_' + column).empty();
                    $('#'+ (id_prefix == 'item' ? 'item_' : '') + 'attributes_value_' + row + '_' + column).append($('<option>', {
                        value: '',
                        text: 'Select Value',
                    }));
                    $.each(response, function(i, data) {
                        $('#'+ (id_prefix == 'item' ? 'item_' : '') + 'attributes_value_' + row + '_' + column).append($('<option>', {
                            value: data.id,
                            text: data.value,
                        }));
                    });
                }
            });
        }



        $('.sop_files_edit').imageUploader({
            required:false,
            imagesInputName: "sop_file",
            multiple:true
        });
        $('.design_files_edit').imageUploader({
            required:false,
            imagesInputName: "design_file",
            multiple:true
        });
    </script>

@endsection
