@extends('layouts.main')

@section('title', 'Unit')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-xLarge-2-10 uk-width-large-2-10">
                    <div class="md-list-outside-wrapper">
                        @include('inc.settings_menu')
                    </div>
                </div>
                <div class="uk-width-large-8-10">
                    <div class="md-card">
                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create Unit</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('settings_unit_store'), 'method' => 'POST']) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="branch_name" class="uk-vertical-align-middle">Unit Name<i style="color:red" class="material-icons">&#xE8D0;</i></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="tax_name">Enter Unit Name</label>
                                        <input class="md-input" type="text" id="name" name="name" value="{{ old('name') }}" required/>
                                        @if($errors->first('name'))
                                            <div class="uk-text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="tax_description" class="uk-vertical-align-middle">1 Base Unit <i style="color:red" class="material-icons">&#xE8D0;</i></label>
                                    </div>
                                    <div class="uk-width-medium-4-5">
                                        <label for="location">Enter Base Unit </label>
                                        <input class="md-input" type="text" id="basic-unit-conversion" name="basic_unit_conversion" value="{{ old('basic-unit-conversion') }}" required/>
                                        @if($errors->first('basic_unit_conversion'))
                                            <div class="uk-text-danger">{{ $errors->first('basic_unit_conversion') }}</div>
                                        @endif
                                    </div>
                                </div>
                               
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="branch_description" class="uk-vertical-align-middle">Note</label>
                                    </div>
                                    <div class="uk-width-medium-4-5">
                                        <label for="branch_description">Note</label>
                                       <textarea  wrap="hard" class="md-input" cols="5" rows="4" type="text" id="branch_description" name="note" >
                                       {{ old('note') }}
                                       </textarea>
                                      
                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <a href="{!! route('settings_unit_index') !!}" type="button" class="md-btn md-btn-flat uk-modal-close">Close</a>
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
        $('textarea#branch_description').html($('textarea#branch_description').html().trim());
        $('#settings_unit').addClass('md-list-item-active');
    </script>
@endsection