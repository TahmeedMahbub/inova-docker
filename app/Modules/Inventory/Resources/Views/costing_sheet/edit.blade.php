@extends('layouts.main')

@section('title', 'Costing Sheet')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style media="screen">
        span.select2-container {
            z-index: 30 !important;
        }

        input {
            /* max-resolution: 100% !important; */
            margin-top: 10px;
        }

        .getMultipleRow input,
        .discount_type {
            /* max-width: ; */
            margin-top: -10px;
        }

        .discount_type {
            /* max-resolution: ; */
            margin-top: -10px;
        }
    </style>
@endsection

@section('content')

    <div class="uk-grid">

        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        {!! Form::open([
                            'url' => route('costing_sheet_update', ['id' => $item_variation->id]),
                            'method' => 'POST',
                            'class' => 'user_edit_form',
                            'id' => 'my_profile',
                            'files' => 'true',
                            'enctype' => 'multipart/form-data',
                            'novalidate',
                        ]) !!}
                        @php
                            $row_index = null;
                            
                        @endphp
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">
                                    Add Costing Sheet</span></h2>
                            </div>
                        </div>

                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="input_fields_wrap uk-table">
                                            <thead>
                                                <tr>
                                                    <th class="uk-text-nowrap">#</th>
                                                    <th class="uk-text-nowrap">raw material<span style="color: red;"
                                                            class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap">Quantity(pcs)</th>
                                                    <th class="uk-text-nowrap">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="getMultipleRow">
                                                @if (count($costing_sheet) > 0)
                                                    @foreach ($costing_sheet as $key => $costing_sheet_value)
                                                        @php
                                                            $row_index[$costing_sheet_value->id] = $key;
                                                        @endphp
                                                        <tr class="tr_{{ $key }}" id="data_clone">
                                                            <td>
                                                                <p style="padding-top: 10px">{{ $key + 1 }}</p>
                                                            </td>
                                                            <td>
                                                                <select class="form-control select2-single-search-dropdown"
                                                                    id="raw_material_id_{{ $key }}"
                                                                    name="raw_material_id[]">
                                                                    <option value="">select raw material</option>
                                                                    @foreach ($variations as $value)
                                                                        <option value="{{ $value->id }}"
                                                                            {{ $value->id == $item_variation->id ? 'selected' : '' }}>
                                                                            {{ $value->variation_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                
                                                            </td>
                                                            <td>
                                                                <input type="number" id="quantity_{{ $key }}"
                                                                    name="quantity[]" class="md-input quantity"
                                                                    value="{{ $costing_sheet_value->quantity }}"
                                                                    oninput="calculatePcsToCtn(this); checkOffer({{ $key }})" />
                                                            </td>
                                                            <td style="text-align: center">
                                                                @if ($key == 0)
                                                                    <a href="#" class="add_field_button">
                                                                        <i style="padding-top: 10px"
                                                                            class="material-icons md-36">&#xE146;</i>
                                                                    </a>
                                                                @else
                                                                    <a href="#" class="remove_field"
                                                                        onclick="rowRemoved({{ $key }})">
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
                                                            <p style="padding-top: 10px">1</p>
                                                        </td>
                                                        <td>
                                                            <select class="select2-single-search-dropdown"
                                                                id="raw_material_id_0" name="raw_material_id[]">
                                                                <option value="">select raw material</option>
                                                                @foreach ($variations as $value)
                                                                    <option value="{{ $value->id }}">
                                                                        {{ $value->variation_name }}</option>
                                                                @endforeach
                                                               
                                                            </select>
                                                            @if ($errors->first('raw_material_id.*'))
                                                            <div class="uk-text-danger uk-margin-top">raw material field is required</div>
                                                        @endif
                                                        </td>

                                                        <td>
                                                            <input type="number" id="quantity_0" name="quantity[]"
                                                                class="md-input quantity" value=""
                                                                oninput="calculatePcsToCtn(this); checkOffer(0)" />
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
                                        <table style="display: none;float:right;margin-top:-20px !important "
                                            class="add_table">
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

                                <div class="uk-grid uk-text-right" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        <input type="submit" class="md-btn md-btn-success" value="save" name="submit" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script type="text/javascript">
        var max_fields = 50; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var item_variations = {!! $variations !!}
        var options = '';

        $.each(item_variations, function(indexInArray, valueOfElement) {
            options += '<option value="' + valueOfElement.id + '">' + valueOfElement.variation_name + '</option>'
        });

        //For apending another rows start1010
        var x = 0;
        $(add_button).click(function(e) {
            e.preventDefault();
// 2020
            var x = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);

            if (x < max_fields) {
                x++;

                var serial = x + 1;

                $('.getMultipleRow').append(' ' + '<tr class="tr_' + x + '">' +
                    '<td>\n' + '<p style="padding-top: 10px">' + serial + '</p>' + '</td>\n' +
                    '<td>\n' + '<select class="select2-single-search-dropdown" id="raw_material_id_' + x +
                    '" name="raw_material_id[]"><option>select raw material</option>' + options + '</select>' +
                    '</td>\n' +
                    '<td>\n' + '<input type="number" id="quantity_' + x +
                    '" class="md-input quantity" name="quantity[]" value=""  oninput="calculatePcsToCtn(this); checkOffer(' +
                    x + ')"/>\n' + '</td>\n' +
                    '<td style="text-align: center">\n' + '<a href="#" data-val="' + x +
                    '" class="remove_field" onclick="rowRemoved(' + x + ')">\n' +
                    '<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n' + '</a>\n' +
                    '</td>\n' +
                    '</tr>\n');
                $('.select2-single-search-dropdown').select2();
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

            if (serial_input_value == 'undefined') {
                var serial_input_value = serial_input_value.split(",");

                for (var j = 0; j < serial_input_value.length; j++) {
                    for (var i = 0; i < serial_arr.length; i++) {

                        if (serial_arr[i] == serial_input_value[j]) {
                            serial_arr.splice(i, 1);
                            i--;
                        }
                    }
                }
            }

            $(this).parent().parent().remove();
            x--;
        });

        $(document).ready(function() {
            var x = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);
            x++;

            if (x > 1) {
                $('.add_table').css('display', 'inline');
            }
        });
    </script>

<script type="text/javascript">
    $('#sidebar_main_account').addClass('current_section');
    $('#sidebar_costing_sheet').addClass('act_item');
    $(window).load(function() {
        $("#tiktok_account").trigger('click');
    });

   
</script>
    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
