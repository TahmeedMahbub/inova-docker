@extends('layouts.main')

@section('title', 'Quotation Request')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
<style media="screen">
.getMultipleRow input, .discount_type{
  margin-top:-10px;
}
#cke_requirements{
    margin-top: 20px;
}
</style>
@endsection
@section('content')
    <div class="uk-grid" >
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('estimate.request.update', ['id' =>  $estimateRequest->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Quotation Request</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid uk-margin-medium-bottom" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2 uk-margin-medium-top" style="font-size: 20px;">
                                        @php
                                            $expData = explode('-', $estimateRequest->order_code);
                                        @endphp
                                        <strong>Order Code:</strong> <span>{{ $expData[0].'-'.$expData[1].'-' }}<span id="order_quantity">{{ $expData[2] }}</span></span>
                                        <input type="hidden" name="order_code" value="{{ $estimateRequest->order_code }}">
                                    </div>
                                    <div class="uk-width-medium-1-2 uk-margin-small-top">
                                        <label class="" for="date">Date<sup><i style="color:red; font: 14px; ">*</i></sup></label>
                                        <input class="md-input @if($errors->first('date')) md-input-danger @endif" id="date" type="text"  name="date" value="{{ date('d-m-Y',strtotime($estimateRequest->request_date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                        @if($errors->first('date'))
                                        <p style="color:red;">{{ $errors->first('date') }}</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- model start --}}
                                <div id="card-model">
                                    @if(!empty($estimateRequest->estimateRequestModel))
                                        @foreach($estimateRequest->estimateRequestModel as $key => $model)
                                            <div class="md-card uk-margin-medium-bottom" style="margin-top: 0;" id="model-{{ $model->model_name }}">
                                                <div class="md-card-content">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="md-input-wrapper">
                                                                <label for="model_name">Model Name <sup><i style="color:red; font: 14px; ">*</i></sup></label>
                                                                <input class="md-input @if($errors->first('model_name.'.$key)) md-input-danger @endif" id="model_name" type="text"  name="model_name[]" value="{{ $model->model_name }}">
                                                                @if($errors->first('model_name.'.$key))
                                                                    <p style="color:red;">{{ $errors->first('model_name.'.$key) }}</p>
                                                                @endif
                                                                <span class="md-input-bar "></span>
                                                            </div>
                                                        </div>
                                                        @if($key !== 0)
                                                            <div class="uk-width-medium-1-2">
                                                                <button type="button" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left delete_model" data-model="#model-{{ $model->model_name }}" style="display: table;margin-left: auto;"><i class="material-icons">&#xe872;</i></button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="input_fields_wrap uk-table table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Length <span style="color: red;" class="asterisc">*</span></th>
                                                                    <th>Size</th>
                                                                    <th>Color</th>
                                                                    <th>Quantity <span style="color: red;" class="asterisc">*</span></th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                    
                                                            <tbody class="getMultipleRow">
                                                                @foreach($model->estimateRequestModelEntries as $key1 => $model_entries)
                                                                    <tr class="tr_{{ $key1 }}" id="data_clone">
                                                                        <td>
                                                                            <div class="md-input-wrapper md-input-filled">
                                                                                <input type="text" name="length[{{ $key }}][]" value="{{ $model_entries->length }}" class="md-input label-fixed @if($errors->first('length.'.$key.'.'.$key1)) md-input-danger @endif" placeholder="Enter Length">
                                                                                <span class="md-input-bar "></span>
                                                                            </div>
                                                                            @if($errors->first('length.'.$key.'.'.$key1))
                                                                                <p style="color:red;">{{ $errors->first('length.'.$key.'.'.$key1) }}</p>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <div class="md-input-wrapper md-input-filled">
                                                                                <input type="text" name="size[{{ $key }}][]" value="{{ $model_entries->size }}" class="md-input label-fixed @if($errors->first('size.'.$key.'.'.$key1)) md-input-danger @endif" placeholder="Enter Size">
                                                                                <span class="md-input-bar "></span>
                                                                            </div>
                                                                            @if($errors->first('size.'.$key.'.'.$key1))
                                                                                <p style="color:red;">{{ $errors->first('size.'.$key.'.'.$key1) }}</p>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <div class="md-input-wrapper md-input-filled">
                                                                                <input type="text" name="color[{{ $key }}][]" value="{{ $model_entries->color }}" class="md-input label-fixed @if($errors->first('color.'.$key.'.'.$key1)) md-input-danger @endif" placeholder="Enter Color">
                                                                                <span class="md-input-bar "></span>
                                                                            </div>
                                                                            @if($errors->first('color.'.$key.'.'.$key1))
                                                                                <p style="color:red;">{{ $errors->first('color.'.$key.'.'.$key1) }}</p>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <div class="md-input-wrapper md-input-filled">
                                                                                <input type="number" name="quantity[{{ $key }}][]" min="1" value="{{ $model_entries->quantity }}" class="md-input label-fixed quantity @if($errors->first('quantity.'.$key.'.'.$key1)) md-input-danger @endif" oninput="totalQuantity()" placeholder="Enter Quantity">
                                                                                <span class="md-input-bar"></span>
                                                                            </div>
                                                                            @if($errors->first('quantity.'.$key.'.'.$key1))
                                                                                <p style="color:red;">{{ $errors->first('quantity.'.$key.'.'.$key1) }}</p>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($key1 == 0)
                                                                                <button type="button" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left add_data" data-model="{{ $key }}"><i class="material-icons">&#xe145;</i></button>
                                                                            @else
                                                                                <button type="button" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left remove_data"><i class="material-icons">&#xe872;</i></button>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="md-card uk-margin-medium-bottom" style="margin-top: 0;">
                                            <div class="md-card-content">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-2">
                                                        <div class="md-input-wrapper">
                                                            <label for="model_name">Model Name <sup><i style="color:red; font: 14px; ">*</i></sup></label>
                                                            <input class="md-input" id="model_name" type="text"  name="model_name[]">
                                                            {{-- <input type="hidden" name="model_number[]" value="1" /> --}}
                                                            <span class="md-input-bar "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="input_fields_wrap uk-table table">
                                                        <thead>
                                                            <tr>
                                                                <th>Length <span style="color: red;" class="asterisc">*</span></th>
                                                                <th>Size</th>
                                                                <th>Color</th>
                                                                <th>Quantity <span style="color: red;" class="asterisc">*</span></th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                
                                                        <tbody class="getMultipleRow">
                                                            <tr class="tr_0" id="data_clone">
                                                                <td>
                                                                    <div class="md-input-wrapper md-input-filled">
                                                                        <input type="text" name="length[0][]" class="md-input label-fixed" placeholder="Enter Length">
                                                                        <span class="md-input-bar "></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="md-input-wrapper md-input-filled">
                                                                        <input type="text" name="size[0][]" class="md-input label-fixed" placeholder="Enter Size">
                                                                        <span class="md-input-bar "></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="md-input-wrapper md-input-filled">
                                                                        <input type="text" name="color[0][]" class="md-input label-fixed" placeholder="Enter Color">
                                                                        <span class="md-input-bar "></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="md-input-wrapper md-input-filled">
                                                                        <input type="number" name="quantity[0][]" min="1" class="md-input label-fixed quantity" oninput="totalQuantity()" placeholder="Enter Quantity">
                                                                        <span class="md-input-bar"></span>
                                                                    </div>
                                                                </td>
                                                                <td><button type="button" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left add_data" data-model="0"><i class="material-icons">&#xe145;</i></button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                {{-- model start --}}

                                {{-- model add new button --}}
                                <button type="button" id="add-new-model" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light uk-margin-medium-bottom" style="margin: auto;display: block;">Add Model</button>

                                <br />

                                {{-- requirements start --}}
                                <div class="md-input-wrapper md-input-filled">
                                    <label for="note">Requirements</label>
                                    <textarea name="requirements" id="requirements" cols="30" rows="10">{{ $estimateRequest->requirements }}</textarea>
                                    @if($errors->first('requirements'))
                                        <p style="color:red;">{{ $errors->first('requirements') }}</p>
                                    @endif
                                </div>
                                {{-- requirements end --}}

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-2">
                                        {{-- note start --}}
                                        <div class="uk-form-row uk-margin-medium-top">
                                            <div class="md-input-wrapper">
                                                <label for="note">Note</label>
                                                <textarea cols="30" rows="1" class="md-input no_autosize @if($errors->first('note')) md-input-danger @endif" name="note" id="note">{{ $estimateRequest->note }}</textarea>
                                                <span class="md-input-bar "></span>
                                                @if($errors->first('note'))
                                                    <p style="color:red;">{{ $errors->first('note') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- note end --}}
                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        {{-- deadline start --}}
                                        <div class="md-input-wrapper uk-margin-medium-top">
                                            <label for="deadline">Deadline</label>
                                            <input type="text" class="md-input @if($errors->first('deadline')) md-input-danger @endif" name="deadline" id="deadline" data-uk-datepicker="{format:'DD-MM-YYYY'}" value="{{ $estimateRequest->deadline_date }}">
                                            <span class="md-input-bar "></span>
                                            @if($errors->first('deadline'))
                                                <p style="color:red;">{{ $errors->first('deadline') }}</p>
                                            @endif
                                        </div>
                                        {{-- deadline end --}}
                                    </div>
                                </div>
                                <div style="margin-left: 0px" class="uk-grid table-responsive" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3 uk-width-small-1-3 uk-margin-medium-top">
                                    </div>
                                </div>
                                <hr>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        {{-- <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

            <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.editorConfig = function(config) {
                    config.language = 'es';
                    config.uiColor = '#F7B42C';
                    config.height = 300;
                    config.toolbarCanCollapse = true;

                };
                CKEDITOR.replace('requirements');
            </script>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        altair_forms.parsley_validation_config();
        $('#sidebar_estimate_request').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        })
    </script>
    {{-- <script type="text/javascript">
    function newserial()
  {
      var x               = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

    {{-- custom js start here --}}
    <script>
        $(document).ready(function(){
            let model = 1;
            $('#add-new-model').click(function(e){
                e.preventDefault();
                $('#card-model').append(`
                <div class="md-card uk-margin-medium-bottom" style="margin-top: 0;" id="model-${model}">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <div class="md-input-wrapper">
                                    <label for="model_name">Model Name <sup><i style="color:red; font: 14px; ">*</i></sup></label>
                                    <input class="md-input" id="model_name" type="text"  name="model_name[]">
                                    <span class="md-input-bar "></span>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <button type="button" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left delete_model" data-model="#model-${model}" style="display: table;margin-left: auto;"><i class="material-icons">&#xe872;</i></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="input_fields_wrap uk-table table">
                                <thead>
                                    <tr>
                                        <th>Length <span style="color: red;" class="asterisc">*</span></th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Quantity <span style="color: red;" class="asterisc">*</span></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody class="getMultipleRow">
                                    <tr class="tr_0" id="data_clone"  >
                                        <td>
                                            <div class="md-input-wrapper md-input-filled">
                                                <input type="text" name="length[${model}][]" class="md-input label-fixed" placeholder="Enter Length">
                                                <span class="md-input-bar "></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="md-input-wrapper md-input-filled">
                                                <input type="text" name="size[${model}][]" class="md-input label-fixed" placeholder="Enter Size">
                                                <span class="md-input-bar "></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="md-input-wrapper md-input-filled">
                                                <input type="text" name="color[${model}][]" class="md-input label-fixed" placeholder="Enter Color">
                                                <span class="md-input-bar "></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="md-input-wrapper md-input-filled">
                                                <input type="number" min="1" name="quantity[${model}][]" class="md-input label-fixed quantity" oninput="totalQuantity()" placeholder="Enter Quantity">
                                                <span class="md-input-bar"></span>
                                            </div>
                                        </td>
                                        <td><button type="button" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left add_data" data-model="${model}"><i class="material-icons">&#xe145;</i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                `);
                model++;
            });

            // delete model
            $(document).on('click', '.delete_model', function(e){
                e.preventDefault();
                let model = $(this).data('model');
                $(model).remove();
            });

            // add model data
            $(document).on('click', '.add_data', function(e){
                e.preventDefault();
                let model_number = $(this).data('model');
                $(this).parent().parent().parent().append(`
                <tr>
                    <td>
                        <div class="md-input-wrapper md-input-filled">
                            <input type="text" name="length[${model_number}][]" class="md-input label-fixed" placeholder="Enter Length">
                            <span class="md-input-bar "></span>
                        </div>
                    </td>
                    <td>
                        <div class="md-input-wrapper md-input-filled">
                            <input type="text" name="size[${model_number}][]" class="md-input label-fixed" placeholder="Enter Size">
                            <span class="md-input-bar "></span>
                        </div>
                    </td>
                    <td>
                        <div class="md-input-wrapper md-input-filled">
                            <input type="text" name="color[${model_number}][]" class="md-input label-fixed" placeholder="Enter Color">
                            <span class="md-input-bar "></span>
                        </div>
                    </td>
                    <td>
                        <div class="md-input-wrapper md-input-filled">
                            <input type="number" name="quantity[${model_number}][]" min="1" class="md-input label-fixed quantity" oninput="totalQuantity()" placeholder="Enter Quantity">
                            <span class="md-input-bar"></span>
                        </div>
                    </td>
                    <td><button type="button" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right uk-margin-small-left remove_data"><i class="material-icons">&#xe872;</i></button></td>
                </tr>
                `);
            });

            $(document).on('click', '.remove_data', function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
            });

        });
        function totalQuantity(){
            let total = 0;
            $('.quantity').each(function(){
                total += $(this).val() !== '' ? parseInt($(this).val()) : 0;
            });

            $('#order_quantity').text(total);
            $('input[name="order_code"]').val( "<?php echo $expData[0]."-".$expData[1]."-" ?>" + "" + total);

        }
        </script>
    {{-- custom js end here --}}
@endsection
