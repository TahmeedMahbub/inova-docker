@extends('layouts.main')

@section('title', 'Edit Raw Materials')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            {{ Form::open(['url' => route('phase_raw_material_update', ['id' => $manufacture_phase->id]), 'method' => 'POST', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Edit Raw Material Info</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    {{-- <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">Date</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">Enter date</label>
                                            <input class="md-input" type="text" id="date" name="date" />
                                        </div>
                                    </div> --}}
                                   
                                    <div class="uk-grid uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <table class="uk-table">
                                                <thead>
                                                    <tr>
                                                        <th class="uk-text-nowrap">Raw Material</th>
                                                        <th class="uk-text-nowrap">CTN</th>
                                                        <th class="uk-text-nowrap">PCS</th>
                                                        <th class="uk-text-nowrap">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="material_container">
                                                    @foreach ($manufacture_phase->manufacturePhaseRawMaterials as $key => $phase_raw_material)
                                                        <tr data-section-added="{{ $key }}">
                                                            <td style="padding-top: 25px">
                                                                <input type="hidden" id="item_id_{{ $key }}" value="{{ $phase_raw_material->variation->item_id }}">
                                                                <select name="item_variation[]" id="item_variation_{{ $key }}" onchange="variationChanged(this)" class="select2-single-search-dropdown uk-margin-medium-top">
                                                                    <option value="">Select Raw Material</option>
                                                                    @foreach($raw_materials as $raw_material)
                                                                        <option value="{{ $raw_material->id }}" data-item-id={{ $raw_material->item->id }} {{ $phase_raw_material->variation_id == $raw_material->id ? 'selected' : '' }}>{{ $raw_material->variation_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input name="quantity_ctn[]" type="text" id="quantity_ctn_{{ $key }}" class="md-input ctn" oninput="calculateCtnToPcs(this)" value="{{ number_format($phase_raw_material->variation->carton_size == 0 ? ($phase_raw_material->variation->item->carton_size == 0 ? 0 :  $phase_raw_material->quantity / $phase_raw_material->variation->item->carton_size) : $phase_raw_material->quantity / $phase_raw_material->variation->carton_size , 3) }}" placeholder="Enter quantity" />
                                                                @if ($errors->has('quantity_ctn.'.$key))
                                                                    <div class="uk-text-danger uk-text-center">{{ $errors->first('quantity_ctn.*') }}</div>                                                                        
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input name="quantity_pcs[]" type="text" id="quantity_pcs_{{ $key }}" class="md-input pcs" oninput="calculatePcsToCtn(this)" value="{{ $phase_raw_material->quantity }}" placeholder="Enter quantity" />
                                                                @if ($errors->has('quantity_pcs.'.$key))
                                                                    <div class="uk-text-danger uk-text-center">{{ $errors->first('quantity_pcs.*') }}</div>                                                                        
                                                                @endif
                                                            </td>
                                                            <td class="uk-text-center uk-text-middle">
                                                                @if ($key == 0)
                                                                    <a href="#" class="btnSectionClone uk-width-medium-1-2" onclick="rowAdded(this)">
                                                                        <i class="material-icons md-24">&#xE145;</i>
                                                                    </a>
                                                                @else
                                                                    <a href="#" class="uk-width-medium-1-2" onclick="deleteRowSection(this)">
                                                                        <i class="material-icons md-24">&#xE872;</i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                         <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <a href="{{ route('phase_raw_material_show', ['id' => $manufacture_phase->id]) }}" class="md-btn md-btn-flat uk-modal-close">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
@section('scripts')
<script>
    var ajax_data = [];
    $.each({!! $items !!}, function (indexInArray, valueOfElement) { 
            ajax_data[valueOfElement.id] = valueOfElement;
    });
    var items_chosen = [];
    $.each({!! json_encode($manufacture_phase->manufacturePhaseRawMaterials) !!}, function (indexInArray, valueOfElement) {
        let item_id = valueOfElement.variation.item_id;
        items_chosen[indexInArray] = structuredClone(ajax_data[item_id]);
        items_chosen[indexInArray]['variation_id'] = valueOfElement.variation_id;
        items_chosen[indexInArray]['variations'] = [];
        $.each(ajax_data[item_id]['item_variations'], function (indexInArray2, valueOfElement) {
            items_chosen[indexInArray]['variations'][valueOfElement.id] = valueOfElement;
        });
    });
    var options = '';    
    $.each({!! $raw_materials !!}, function (indexInArray, valueOfElement) { 
        options += '<option value="'+valueOfElement.id+'" data-item-id="'+valueOfElement.item.id+'">'+valueOfElement.variation_name+'</option>';
    });
    
    $('#sidebar_main_account').addClass('current_section');
    $('#sidebar_track').addClass('act_item');
    $(window).load(function() {
        $("#tiktok_account").trigger('click');
    });

    function variationChanged(e){
        var item_id = null;
        var raw_mat_row = null;
        if($(e).val() != ''){
            item_id = $(e).find(':selected').data('item-id');
            raw_mat_row = $(e).attr('id').match(/\d+/)[0];
            $('#item_id_'+raw_mat_row).val(item_id);
            items_chosen[raw_mat_row] = structuredClone(ajax_data[item_id]);
            items_chosen[raw_mat_row]['variation_id'] = $(e).val();
            items_chosen[raw_mat_row]['variations'] = [];
            $.each(ajax_data[item_id]['item_variations'], function (indexInArray, valueOfElement) { 
                items_chosen[raw_mat_row]['variations'][valueOfElement.id] = valueOfElement;
            });
            calculatePcsToCtn(e);
        }
        else{
            $('#item_id_'+raw_mat_row).val("");
            $('#quantity_ctn_'+raw_mat_row).val(0);
            $('#quantity_pcs_'+raw_mat_row).val(0);
            items_chosen[raw_mat_row] = null;
            UIkit.notify({
                message : 'Please select a raw material',
                status  : 'warning',
                timeout : 2000,
                pos     : 'top-right'
            });
        }
    }

    function rowAdded(e){
        var section_row = $('#material_container').find('tr').last().data('section-added') + 1;
        $('#material_container').append(
            `<tr data-section-added="${section_row}">
                <td style="padding-top: 25px">
                    <input type="hidden" name="item_id[]" id="item_id_${section_row}" value="">
                    <select name="item_variation[]" id="item_variation_${section_row}" onchange="variationChanged(this)" class="select2-single-search-dropdown uk-margin-medium-top">
                        <option value="">Select Raw Material</option>
                        ${options}
                    </select>
                </td>
                <td>
                    <input name="quantity_ctn[]" type="text" id="quantity_ctn_${section_row}" class="md-input ctn" oninput="calculateCtnToPcs(this)" value="0" placeholder="Enter quantity" />
                </td>
                <td>
                    <input name="quantity_pcs[]" type="text" id="quantity_pcs_${section_row}" class="md-input pcs" oninput="calculatePcsToCtn(this)" value="1" placeholder="Enter quantity" />
                </td>
                <td class="uk-text-center uk-text-middle">
                    <a href="#" class="uk-width-medium-1-2" onclick="deleteRowSection(this)">
                        <i class="material-icons md-24">&#xE872;</i>
                    </a>
                </td>
            </tr>`
        );
        $('.select2-single-search-dropdown').select2();
    }

    function deleteRowSection(e){
        var section_row = $(e).closest('tr').data('section-added');
        delete items_chosen[section_row];
        $(e).closest('tr').remove();
    }
</script>
@endsection


