@extends('layouts.main')

@section('title', 'Manufacture')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{ url('app/inventory/product/product.module.js') }}"></script>
    <script src="{{ url('app/inventory/product/product.controller.js') }}"></script>
@endsection

@section('styles')
    <style>
        table tr th {
            border-bottom: 1px solid #ddd !important;
        }

        .selectize-dropdown.single.select_product_model {
            z-index: 1000;
            position: relative;
        }

        .uk-badge a {
            color: white
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile" ng-controller="ProductController">
        <div class="uk-width-large-10-10">
            {!! Form::open([
                'url' => route('track_update', ['id' => $manufacture->id]),
                'method' => 'post',
                'class' => 'uk-form-stacked',
                'id' => 'user_edit_form',
            ]) !!} <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Update Manufacture</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-3">
                                        <select name="bom_id" id="bom_id" title="Select quotation"
                                            class="select2-single-search-dropdown">
                                            <option value="">Select bill of material</option>
                                            @foreach ($boms as $bom)
                                                <option value="{{ $bom->id }}" {{ $bom->id == $manufacture->bill_of_material_id ? 'selected' : '' }}>
                                                    Project: {{ $bom->project_name }}, Item: {{ $bom->item->item_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive uk-margin-medium-top">
                                    <table class="input_fields_wrap uk-table table">
                                        <thead style="border-top: 1px solid #ddd;">
                                            <tr>
                                                <th class="uk-text-center" rowspan=2>Product</th>
                                                <th class="uk-text-center" colspan="2">Remaining</th>
                                                <th class="uk-text-center" colspan="2">To manufacture</th>
                                            </tr>
                                            <tr>
                                                <th class="uk-text-center">Ctn</th>
                                                <th class="uk-text-center">Pcs</th>
                                                <th class="uk-text-center">Ctn</th>
                                                <th class="uk-text-center">Pcs</th>
                                            </tr>
                                        </thead>

                                        <tbody id="product_data" class="bill_of_material_get">
                                            @foreach ($manufacture->manufactureEntries as $key => $mf_entry)
                                                <tr class="tr_{{ $key }}" id="data_clone">
                                                    <td class="uk-text-center" width="30%" style="padding-top: 22px">
                                                        <div class="item_container">
                                                            <select id="item_id_{{ $key }}"
                                                                class="item_add select2-single-search-dropdown"
                                                                style="min-width: 100px;" name="item[]"
                                                                onchange="itemChanged(this, '')">
                                                                <option value="">Select item</option>
                                                                @foreach ($item as $value)
                                                                    <option value="{{ $value->id }}"
                                                                        {{ $value->id == $mf_entry->item_id ? 'selected' : '' }}>
                                                                        {{ $value->item_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <a data-toggle="uk-modal"
                                                                onclick="chooseVariationBtnClicked(this, ``)"
                                                                data-uk-modal="{target:'#chooseVariation'}"
                                                                id="choose_variation_modal_{{ $key }}"
                                                                type="submit"
                                                                class="sm-btn sm-btn-primary variation-button">
                                                                <span class="uk-badge uk-align-center uk-margin-small-top">
                                                                    Choose Variation
                                                                </span>
                                                            </a>
                                                            <input id="selected_variation_{{ $key }}"
                                                                name="selected_variation[]" type="number"
                                                                style="display: none"
                                                                value="{{ !empty($mf_entry->variation_id) ? $mf_entry->item_variation->id : '' }}">
                                                            @if ($mf_entry->variation_id)
                                                                <div class="uk-text-center"
                                                                    id="variation_badge_container_{{ $key }}">
                                                                    <span class="uk-badge uk-text-nowrap"
                                                                        id="variation_badge_{{ $key }}">Selected
                                                                        Variation:
                                                                        {{ $mf_entry->item_variation->variation_name }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="uk-text-center" width="15%">
                                                        <div class="md-input-wrapper md-input-filled">
                                                            <input type="text" name="remaining_ctn[]"
                                                                class="md-input label-fixed remaining_ctn"
                                                                placeholder="Remaining(Ctn)"
                                                                value="{{ !empty($mf_entry->variation_id) ? number_format($mf_entry->item_variation->carton_size == 0 ? ($mf_entry->item->carton_size == 0 ? 0 : $mf_entry->required_quantity / $mf_entry->item->carton_size) : $mf_entry->required_quantity / $mf_entry->item_variation->carton_size, 3) : number_format(($mf_entry->item->carton_size == 0 ? 0 : $mf_entry->required_quantity / $mf_entry->item->carton_size), 3) }}"
                                                                style="min-width: 100px;">
                                                            <span class="md-input-bar"></span>
                                                        </div>
                                                    </td>
                                                    <td class="uk-text-center" width="15%">
                                                        <div class="md-input-wrapper md-input-filled">
                                                            <input type="text" name="remaining_pcs[]"
                                                                class="md-input label-fixed pieces"
                                                                placeholder="Remaining(Pcs)" style="min-width: 100px;"
                                                                value=" {{ $mf_entry->required_quantity }}">
                                                            <span class="md-input-bar"></span>
                                                        </div>
                                                    </td>
                                                    <td class="uk-text-center" width="15%">
                                                        <div class="md-input-wrapper md-input-filled">
                                                            <input type="text" name="manufacture_ctn[]"
                                                                id="quantity_ctn_0" class="md-input label-fixed"
                                                                placeholder="To manufacture(Ctn)" style="min-width: 100px;"
                                                                value="{{ !empty($mf_entry->variation_id) ? number_format($mf_entry->item_variation->carton_size == 0 ? ($mf_entry->item->carton_size == 0 ? 0 : $mf_entry->manufacture_quantity / $mf_entry->item->carton_size) : $mf_entry->manufacture_quantity / $mf_entry->item_variation->carton_size, 3) : number_format(($mf_entry->item->carton_size == 0 ? 0 : $mf_entry->manufacture_quantity / $mf_entry->item->carton_size), 3) }}"
                                                                oninput="calculateCtnToPcs(this)">
                                                            <span class="md-input-bar"></span>
                                                        </div>
                                                    </td>
                                                    <td class="uk-text-center" width="15%">
                                                        <div class="md-input-wrapper md-input-filled">
                                                            <input type="text" name="manufacture_pcs[]"
                                                                id="quantity_pcs_0" class="md-input label-fixed"
                                                                placeholder="To manufacture(Pcs)"
                                                                style="min-width: 100px;"
                                                                value=" {{ $mf_entry->manufacture_quantity }}"
                                                                oninput="calculatePcsToCtn(this)">
                                                            <span class="md-input-bar"></span>
                                                        </div>
                                                    </td>
                                                    <td width="10%" class="uk-text-center">
                                                        @if ($key == 0)
                                                            <button type="button"
                                                                class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left add_product"
                                                                data-model="0" onclick="addrow()">
                                                                <i class="material-icons">&#xe145;</i>
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left add_data"
                                                                id="remove_phases">
                                                                <i class="material-icons">&#xe872;</i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-2 uk-margin-medium-top">
                                        <div class="md-input-wrapper md-input-filled">
                                            <label>Start Date</label>
                                            <input type="text" name="start_date" class="md-input label-fixed"
                                                data-uk-datepicker="{format:'YYYY-MM-DD'}"
                                                value="{{ $manufacture->start_date }}">
                                            <span class="md-input-bar "></span>
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-2 uk-margin-medium-top">
                                        <div class="md-input-wrapper md-input-filled">
                                            <label>End Date</label>
                                            <input type="text" name="end_date" class="md-input label-fixed"
                                                data-uk-datepicker="{format:'YYYY-MM-DD'}"
                                                value="{{ $manufacture->end_date }}">
                                            <span class="md-input-bar "></span>
                                        </div>
                                    </div>
                                </div>

                                <p class="heading_c uk-margin-medium-top">Phases</p>
                                <div class="table-responsive uk-margin-top">
                                    <table class="input_fields_wrap uk-table table">
                                        <tbody class="getMultipleRow" id="phases">
                                            @foreach ($manufacture->manufacturePhases as $key => $mn_phase)
                                                <tr class="tr_{{ $key }}">
                                                    <td width="45%">
                                                        <div class="md-input-wrapper md-input-filled">
                                                            <input type="text" name="phase_name[]"
                                                                class="md-input label-fixed"
                                                                placeholder="Enter phase name" style="min-width: 200px;"
                                                                value="{{ $mn_phase->phase_name }}">
                                                            <span class="md-input-bar "></span>
                                                        </div>
                                                    </td>
                                                    <td width="45%">
                                                        <div class="md-input-wrapper md-input-filled">
                                                            <select id="customer_id_{{ $key }}"
                                                                class="select2-single-search-dropdown"
                                                                name="factory_id[]">
                                                                <option value="">Select factory</option>
                                                                @foreach ($contacts as $value)
                                                                    <option
                                                                        value="{{ $value->id }}"{{ $mn_phase->factory->id == $value->id ? 'selected' : '' }}>
                                                                        {{ $value->display_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span class="uk-badge uk-margin-small-top">
                                                            <a data-toggle="uk-modal"
                                                                data-uk-modal="{target:'#addContact'}" id="contact-modal-{{ $key }}"
                                                                type="submit" class="sm-btn sm-btn-primary"
                                                                onclick="openContactModal(this)">Create
                                                                Contact</a>
                                                        </span>
                                                    </td>
                                                    <td width="10%" class="uk-text-center">
                                                        @if ($key == 0)
                                                            <button type="button"
                                                                class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left"
                                                                id="add_phases">
                                                                <i class="material-icons">&#xe145;</i>
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left add_data"
                                                                id="remove_phases">
                                                                <i class="material-icons">&#xe872;</i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <button type="submit"
                                    class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Submit</button>
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
        $('#sidebar_track').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        });

        var ajax_data = [];

        $.each({!! $item !!}, function(indexInArray, valueOfElement) {
            ajax_data[valueOfElement.id] = valueOfElement;
        });

        var items_chosen = [];

        $.each({!! $manufacture->manufactureEntries !!}, function(indexInArray, value) {
            items_chosen[indexInArray] = structuredClone(ajax_data[value.item_id]);
            items_chosen[indexInArray]['variation_id'] = value.variation_id;
            items_chosen[indexInArray]['variations'] = [];
            $.each(ajax_data[value.item_id]['item_variations'], function(key, valueOfElement) {
                items_chosen[indexInArray]['variations'][valueOfElement.id] = structuredClone(
                    valueOfElement);
            });
        });

        $(document).ready(function() {
            $('#bom_id').change(function(e) {
                $('#product_data').empty();
                items_chosen = []
                $.ajax({
                    type: "get",
                    url: "{{ route('bom_get', ['id' => '']) }}/"+$(this).val(),
                    success: function(response) {
                        var value = response.bill_of_material;
                        console.log(ajax_data);
                            items_chosen[0] = structuredClone(ajax_data[value.item_id]);
                            items_chosen[0]['variation_id'] = null;
                            items_chosen[0]['variations'] = [];
                            var bill_of_material = "";
                            bill_of_material += `
                            <tr class="tr_0 extra_data">
                                <td class="uk-text-center" width="30%" style="padding-top: 22px">
                                    <select id="item_id_0" class=" item_add select2-single-search-dropdown"
                                        style="min-width: 100px;" name="item[]" >
                                        <option value="">Select model...</option>
                                        <option value="${value.item.id}" ${value.item.item_name}? selected>${value.item.item_name}</option>
                                    </select>
                                    <a data-toggle="uk-modal"
                                        onclick="chooseVariationBtnClicked(this, '')"
                                        data-uk-modal="{target:'#chooseVariation'}"
                                        id="choose_variation_modal_0" type="submit"
                                        class="sm-btn sm-btn-primary variation-button">
                                        <span class="uk-badge uk-align-center uk-margin-small-top">
                                            Choose Variation
                                        </span>
                                    </a>
                                    <input id="selected_variation_0" name="selected_variation[]"
                                        type="number" style="display: none" value="">
                                </td>
                                <td class="uk-text-center" width="15%">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input type="text" name="remaining_ctn[]"
                                            class="md-input label-fixed remaining_ctn" placeholder="Remaining(Ctn)"
                                            disabled style="min-width: 100px;"                                            
                                            value="${ajax_data[value.item_id].carton_size == 0 ? 0 : value.quantity / ajax_data[value.item_id].carton_size}">
                                        <span class="md-input-bar"></span>
                                    </div>
                                </td>
                                <td class="uk-text-center" width="15%">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input type="text" 
                                            class="md-input label-fixed pieces" placeholder="Remaining(Pcs)"
                                            disabled style="min-width: 100px;" value="${value.quantity}">
                                            <input type="hidden" name="remaining_pcs[]"
                                            class="md-input label-fixed pieces" placeholder="Remaining(Pcs)"
                                             style="min-width: 100px;" value="${value.quantity}">
                                        <span class="md-input-bar"></span>
                                    </div>
                                </td>
                                <td class="uk-text-center" width="15%">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input type="text" name="manufacture_ctn[]" id="quantity_ctn_0"
                                            class="md-input label-fixed" placeholder="To manufacture(Ctn)"
                                            style="min-width: 100px;" oninput="calculateCtnToPcs(this)">
                                        <span class="md-input-bar"></span>
                                    </div>
                                </td>
                                <td class="uk-text-center" width="15%">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input type="text" name="manufacture_pcs[]" id="quantity_pcs_0"
                                            class="md-input label-fixed" placeholder="To manufacture(Pcs)"
                                            style="min-width: 100px;" oninput="calculatePcsToCtn(this)">
                                        <span class="md-input-bar"></span>
                                    </div>
                                </td>
                            </tr>`;
                            $('.bill_of_material_get').append(bill_of_material);
                            $('.bill_of_material_get').addClass('new_data');
                            $('.item_add').append(`<option value="" >
                                    Select item value
                                </option>`);
                            $('.item_add').append(`${options}`);
                        $('.select2-single-search-dropdown').select2();
                    }
                });
            });
        });
    </script>
    <script>
        // add new product model
        var options = '';
        var items = {!! $item !!}

        $.each(items, function(indexInArray, valueOfElement) {
            options += '<option class ="option1" value="' + valueOfElement.id + '">' + valueOfElement.item_name +
                '</option>'
        });
        let productCount = parseInt($('#product_data').children().last().attr('class').match(/(\d+)/g)[0]) + 1;
        let phaseCount = parseInt($('.getMultipleRow').children().last().attr('class').match(/(\d+)/g)[0]) + 1;
        $('.select2-single-search-dropdown').select2();

        function addrow() {
            $('#product_data').append(`
                <tr>
                    <td class="uk-text-center" width="30%" style="padding-top: 22px">
                        <div class="md-input-wrapper md-input-filled md-input-wrapper-success">
                        <select id="item_id_` + productCount +
                `" class="select2-single-search-dropdown item_add1" name="item[]" onchange="itemChanged(this, '')" style="min-width: 100px;">
                            <option value="">Select model...</option>
                            ${options}
                        </select>
                        <a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, '')" data-uk-modal="{target:'#chooseVariation'}" id="choose_variation_modal_` +
                productCount + `" type="submit"'
                        class="sm-btn sm-btn-primary variation-button"><span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span></a>
                        <input id="selected_variation_` + productCount + `" name="selected_variation[]" type="number" style="display: none" value=""></div>
                    </td>
                    <td class="uk-text-center" width="15%">
                        <div class="md-input-wrapper md-input-filled">
                            <input type="text" name="remaining_ctn[]"
                                class="md-input label-fixed remaining_ctn" placeholder="Remaining(Ctn)"
                                 style="min-width: 100px;" value="0">
                            <span class="md-input-bar"></span>
                        </div>
                    </td>
                    <td class="uk-text-center" width="15%">
                        <div class="md-input-wrapper md-input-filled">
                            <input type="text" name="remaining_pcs[]"
                                class="md-input label-fixed pieces" placeholder="Remaining(Pcs)"
                                 style="min-width: 100px;" value="0">
                            <span class="md-input-bar"></span>
                        </div>
                    </td>
                    <td class="uk-text-center" width="15%">
                        <div class="md-input-wrapper md-input-filled">
                            <input type="text" name="manufacture_ctn[]" id="quantity_ctn_` + productCount + `"
                                class="md-input label-fixed" placeholder="To manufacture(Ctn)"
                                style="min-width: 100px;" value="0" oninput="calculateCtnToPcs(this)">
                            <span class="md-input-bar"></span>
                        </div>
                    </td>
                    <td class="uk-text-center" width="15%">
                        <div class="md-input-wrapper md-input-filled">
                            <input type="text" name="manufacture_pcs[]" id="quantity_pcs_` + productCount + `"
                                class="md-input label-fixed" placeholder="To manufacture(Pcs)"
                                style="min-width: 100px;" value="1" oninput="calculatePcsToCtn(this)">
                            <span class="md-input-bar"></span>
                        </div>
                    </td>
                    <td width="10%" class="uk-text-center">
                        <button type="button"
                            class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left add_data"
                            id="remove_phases">
                            <i class="material-icons">&#xe872;</i>
                        </button>
                    </td>
                </tr>
                `);
            $('.select2-single-search-dropdown').select2();
            productCount++;
        }

        // remove product
        $(document).on('click', '.remove_product', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        // add new phase
        $(document).on('click', '#add_phases', function(e) {
            e.preventDefault();
            var contacts = '';
            var contacts = {!! $contacts !!}
            $.each(contacts, function(indexInArray, valueOfElement) {
                contacts += '<option class ="option1" value="' + valueOfElement.id + '">' + valueOfElement
                    .display_name + '</option>'
            });
            $('#phases').append(`
                <tr>
                    <td width="45%">
                        <div class="md-input-wrapper md-input-filled">
                            <input type="text" name="phase_name[]"
                                class="md-input label-fixed" placeholder="Enter phase name"
                                style="min-width: 200px;">
                            <span class="md-input-bar "></span>
                        </div>
                    </td>
                    <td width="45%">
                        <div class="md-input-wrapper md-input-filled">
                            <select class="select2-single-search-dropdown" id="customer_id_`+phaseCount+`" name="factory_id[]">
                                <option value="">Select factory</option>
                              ${contacts}
                            </select>
                            <span class="uk-badge uk-margin-small-top">
                                <a data-toggle="uk-modal" data-uk-modal="{target:'#addContact'}" id="contact-modal-`+phaseCount+`" type="submit" class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create Contact</a>
                            </span>
                        </div>
                    </td>
                    <td width="10%" class="uk-text-center">
                        <button type="button"
                            class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left add_data"
                            id="remove_phases">
                            <i class="material-icons">&#xe872;</i>
                        </button>
                    </td>
                </tr>
                `);
            $('.select2-single-search-dropdown').select2();
            phaseCount++;
        });

        // remove phases
        $(document).on('click', '#remove_phases', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    </script>
@endsection
