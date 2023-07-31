@extends('layouts.main')

@section('title', 'Contact')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('angular')
    <script src="{{ url('app/contact/contact/contact.controller.js') }}"></script>
@endsection

@section('styles')
    <style media="screen">
        input {
            margin-top: 10px;
        }
    </style>
@endsection

@section('top_bar')
    <div id="top_bar">
        <div class="md-top-bar">
            <ul id="menu_top" class="uk-clearfix">
                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>@lang('trans.contact')</span></a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('contact_create') }}">@lang('trans.create_contact')</a></li>
                            <li><a href="{{ route('contact') }}">@lang('trans.all_contact')</a></li>
                        </ul>
                    </div>
                </li>

                <li data-uk-dropdown class="uk-hidden-small">
                    <a href="#"><i class="material-icons">&#xE02E;</i><span>@lang('trans.category')</span></a>
                    <div class="uk-dropdown uk-dropdown-scrollable">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="{{ route('category_create') }}">Create Category</a></li>
                            <li><a href="{{ route('category') }}">@lang('trans.all_category')</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile"
        xmlns:color="http://www.w3.org/1999/xhtml">
        <div class="uk-width-large-10-10" ng-controller="ContactController">
            {!! Form::open([
                'url' => 'contact/store',
                'method' => 'post',
                'class' => 'uk-form-stacked',
                'id' => 'user_edit_form',
                'files' => 'true',
            ]) !!}
            <input type="hidden" id="recruit" name="recruit" value="{{ $recruit }}" />
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">@lang('trans.create_contact')</span>
                                </h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <h3 class="full_width_in_card heading_c">
                                    @lang('trans.general_info')
                                </h3>
                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-large-1-3 uk-row-first">
                                        <label for="contact_category_id"
                                            class="uk-vertical-align-middle">@lang('trans.category')<span style="color: red;" class="asterisc"> *</span></label><br />
                                        <select id="contact_category_id"
                                            class="contact_category_id md-input select2-single-search-dropdown"
                                            name="contact_category_id" required>
                                        </select>
                                        <p style="color:red;" id="category_error">{{ $errors->first('contact_category_id') }}</p>
                                    </div>

                                    {{-- <div class="uk-width-large-1-4">
                                        <label for="contact_category_id"
                                            class="uk-vertical-align-middle">Agent</label><br />
                                        <select id="agent" class="agent md-input select2-single-search-dropdown"
                                            name="agent">
                                            <option value="0">Select an agent</option>
                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->id }}">
                                                    {{ $agent->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <div class="uk-width-large-1-3">
                                        <label for="first_name">First Name</label>
                                        <input class="md-input" type="text" id="first_name" name="first_name"
                                            value="{{ old('first_name') }}" />
                                        <p style="color:red;">{{ $errors->first('first_name') }}</p>
                                    </div>

                                    <div class="uk-width-large-1-3">
                                        <label for="last_name">Last Name</label>
                                        <input class="md-input" type="text" id="last_name" name="last_name"
                                            value="{{ old('first_name') }}" />
                                        <p style="color:red;">{{ $errors->first('last_name') }}</p>
                                    </div>

                                </div>

                                <div class=" err uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <label class="uk-vertical-align-middle" for="display_name">Display Name<span
                                                style="color: red;" class="asterisc">*</span></label>
                                        <input class="md-input" type="text" id="display_name" name="display_name"
                                            value="" onchange="" required />
                                        <p style="color:red;">{{ $errors->first('display_name') }}</p>
                                        <p id="err" style="color:red; display:none"> This name has already Exist</p>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="company_name">Company Name</label>
                                        <input class="md-input" type="text" id="company_name" name="company_name" />
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label class="uk-vertical-align-middle"
                                            for="display_name">@lang('trans.select_profile_picture')</label>
                                        <input style="margin-top:30px" class="md-input label-fixed" type="file"
                                            id="profile_picture" name="profile_picture" />
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-2-6">
                                        <label for="phone_number_1">@lang('trans.contact_no_1')<span style="color: red;"
                                                class="asterisc">*</span></label>
                                        <input class="md-input" type="text" id="phone_number_1" name="phone_number_1"
                                            required />
                                        <p style="color:red;">{{ $errors->first('phone_number_1') }}</p>
                                    </div>
                                    <div class="uk-width-medium-2-6">
                                        <label for="phone_number_2">@lang('trans.contact_no_2')</label>
                                        <input class="md-input" type="text" id="phone_number_2"
                                            name="phone_number_2" />
                                    </div>
                                    <div class="uk-width-medium-2-6">
                                        <label for="phone_number_3">@lang('trans.contact_no_3')</label>
                                        <input class="md-input" type="text" id="phone_number_3"
                                            name="phone_number_3" />
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-3" id="contact_code_container" style="display: none">
                                        <label for="contact_code">Contact Code<span
                                            style="color: red;" class="asterisc">*</span></label>
                                        <input class="md-input" type="text" id="contact_code" name="contact_code" required/>
                                        <p style="color:red;">{{ $errors->first('contact_code') }}</p>
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-1-2">
                                        <h3 class="full_width_in_card heading_c">
                                            Billing Address
                                        </h3>
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-4-4">
                                                <label for="billing_address">Address</label>
                                                <textarea id="billing_address" class="md-input" name="billing_address" rows="3" cols="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-2">
                                        <h3 class="full_width_in_card heading_c">
                                            Shipping Address
                                        </h3>
                                        <div class="uk-grid" data-uk-grid-margin>

                                            <div class="uk-width-medium-4-4">
                                                <label for="shipping_address">Address</label>
                                                <textarea class="md-input" id="shipping_address" name="shipping_address" rows="3" cols="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="full_width_in_card heading_c">
                                    @lang('trans.other_details')
                                </h3>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                            <div>
                                                <div class="uk-input-group">
                                                    <span class="uk-input-group-addon">
                                                        <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                    </span>
                                                    <input type="text" class="md-input" id="fb_id" name="fb_id"
                                                        placeholder="facebook.com/user" />
                                                </div>
                                            </div>

                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <i class="material-icons"> email </i>
                                                </span>
                                                <input class="md-input" type="text" id="email_address"
                                                    name="email_address" placeholder="Email" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="full_width_in_card heading_c">
                                    Remarks
                                </h3>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-1-1">
                                        <label for="about">Write Anything Useful</label>
                                        <textarea class="md-input" name="about" id="about" cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button id="submit" type="submit"
                                            class="md-btn md-btn-primary submit-form-btn">@lang('trans.submit')</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close"><a
                                                href="{{ route('contact') }}">@lang('trans.close') </a></button>
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
        $('#sidebar_contact').addClass('act_item');
    </script>
    <script type="text/javascript">
        function checkDisplayName() {
            var display_name = $('#display_name').val();
            $.get('{{ url('contact/display_name') }}' + '/' + display_name, function(data) {
                if (data != '') {
                    $('#err').show();
                    $('#submit').hide();
                } else {
                    $('#err').hide();
                    $('#submit').show();
                }
            });
        }

        $('#contact_category_id').on('change', function () {
            if($('#contact_category_id').val() == 1){
                $('#contact_code_container').show(400);
            }else{
                $('#contact_code_container').hide(400);
                $('#contact_code').val('');
            }
        });

        $(".submit-form-btn").click(function(e) {  
            var category = $('#contact_category_id').val();
            if(category.length == 0){
                $('#category_error').empty(); //here
                $('#category_error').append('<div class="category_error">Category is Required</div>');
            }
            else {
                $('#category_error').empty(); //here
                $('#user_edit_form').validate({
                    errorPlacement: function(label, element) {
                        label.insertAfter(element.next());
                        label.css({'color': 'red'});
                    },
                    wrapper: 'span'
                });
                $("#user_edit_form").submit();
            }

        });
    </script>
@endsection
