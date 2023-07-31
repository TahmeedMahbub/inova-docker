@extends('layouts.main')

@section('title', 'Access Level')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-2-10 uk-width-large-2-10">
                    <div class="md-list-outside-wrapper">
                        @include('inc.settings_menu')
                    </div>
                </div>
                <div class="uk-width-xLarge-8-10  uk-width-large-8-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Quotation Header</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('quotation_header_update'), 'method' => 'POST', 'files' => true]) !!}

                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-1-1">
                                        <label for="heading">Enter Heading</label>
                                        <textarea  id="editor1" name="heading" rows="12" cols="100">{!! $quotation_info->heading !!}</textarea>
        
                                    </div>
                                </div>
        
                                <div class="uk-grid" data-uk-grid-margin>
        
                                    <div class="uk-width-medium-1-1">
                                        <label for="table_head">Enter Table Head</label>
                                        <input class="md-input" type="text" id="table_head" name="table_head" value="{{ $quotation_info->table_head }}"/>
                                    </div>
                                </div>
        
                                <div class="uk-grid" data-uk-grid-margin>
        
                                    <div class="uk-width-medium-3-3">
                                        <label for="terms_conditions">Terms & Conditions</label>
                                        <textarea  id="editor2" name="terms_conditions" rows="12" cols="100">{!! $quotation_info->terms_conditions !!}</textarea>
        
                                    </div>
                                </div>
        
                                <div class="uk-grid" data-uk-grid-margin>
        
                                    <div class="uk-width-medium-3-3">
                                        <label for="left_notation">Left Notation</label>
                                        <textarea  id="editor3" name="left_notation" rows="12" cols="100">{!! $quotation_info->left_notation !!}</textarea>
        
                                    </div>
                                </div>
        
                                <div class="uk-grid" data-uk-grid-margin>
        
                                    <div class="uk-width-medium-3-3">
                                        <label for="right_notation">Right Notation</label>
                                        <textarea  id="editor4" name="right_notation" rows="12" cols="100">{!! $quotation_info->right_notation !!}</textarea>
        
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-1-1 uk-float-right">
                                        {{-- <input type="hidden" name="id" value="{{ $op->id }}"> --}}
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <a type="button" href="{{ redirect()->back()->getTargetUrl() }}" class="md-btn md-btn-flat uk-modal-close">Close</a>
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

    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.editorConfig = function (config) {
            config.language = 'es';
            config.uiColor = '#F7B42C';
            config.height = 300;
            config.toolbarCanCollapse = true;

        };
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
    </script>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#quotation_header').addClass('md-list-item-active');
    </script>
@endsection