@extends('layouts.main')

@section('title', 'Contact')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
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
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                 <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">

                                        @if($contact->profile_pic_url)
                                            <img alt="user avatar" src="{{url($contact->profile_pic_url)}}">
                                        @else
                                            <img alt="user avatar" src="{{url('admin/assets/img/avatars/user.png')}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">
                                             @if(Session::get('locale') == 'bn')
                                             {{ $contact->first_name_bn }} {{ $contact->last_name }}
                                             @else
                                             {{ $contact->first_name }} {{ $contact->last_name }}
                                             @endif
                                        </span></h2>
                                    <!-- <h2 class="heading_b"><span class="uk-text-truncate">@lang('trans.display_name') : <span style="color: yellow">{{ $contact->display_name }}</span> </span></h2> -->
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <h3 class="full_width_in_card heading_c">
                                        @lang('trans.general_info')
                                    </h3>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="category_id" class="uk-vertical-align-middle">@lang('trans.category')</label><br>
                                            {{ $contact_category }}
                                            <br>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label class="uk-vertical-align-middle" for="company_name">@lang('trans.company_name')</label><br>
                                            @if(Session::get('locale') == 'bn')
                                            {{ $contact->company_name }}</label>
                                            @else
                                            {{ $contact->company_name }}</label>
                                            @endif
                                            <br>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label class="uk-vertical-align-middle" for="email_address">@lang('trans.email_address')</label><br>
                                            @if(Session::get('locale') == 'bn')
                                               {{ $contact->email_address }}</label>
                                            @else
                                               {{ $contact->email_address }}</label>
                                            @endif
                                            <br>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="phone_number_1">Contact Number 1</label><br>
                                            {{ $contact->phone_number_1 }}
                                            <br>
                                        </div>
                                        
                                        <div class="uk-width-medium-1-3">
                                            <label for="phone_number_1">Contact Number 2</label><br>
                                            {{ $contact->phone_number_2 }}
                                            <br>
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label for="phone_number_1">Contact Number 3</label><br>
                                            {{ $contact->phone_number_3 }}
                                            <br>
                                        </div>
                                    </div>

                                    <hr>
                                    
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="skype_name">@lang('trans.created_by')</label><br>
                                            {{ $contact->createdBy->name }}
                                        </div>
                            
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="skype_name">@lang('trans.created_at')</label><br>
                                            {{ $contact->created_at }}
                                        </div>   
                                       
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="skype_name">@lang('trans.updated_by')</label><br>
                                            {{ $contact->updatedBy->name }}
                                        </div>

                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="skype_name">@lang('trans.updated_at')</label><br>
                                            {{ $contact->updated_at }}
                                        </div>
                                    </div>
                                 
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <h3 class="full_width_in_card heading_c">
                                                @lang('trans.billing_address')
                                            </h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-3-4">
                                                        @if(Session::get('locale') == 'bn')
                                                            {!! $contact->billing_address !!}
                                                        @else
                                                            {!! $contact->billing_address !!}
                                                        @endif
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-1-2">
                                            <h3 class="full_width_in_card heading_c">
                                                @lang('trans.shipping_address')
                                            </h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-3-4">
                                                        @if(Session::get('locale') == 'bn')
                                                            {!! $contact->shipping_address !!}
                                                        @else
                                                            {!! $contact->shipping_address !!}
                                                        @endif
                                                    </label>
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
                                                        <label for="shipping_country">{{ $contact->fb_id }}</label>

                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                            <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                        </span>
                                                        <label for="shipping_country">{{ $contact->tw_id }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($contact->about != null)
                                    <h3 class="full_width_in_card heading_c">
                                        @lang('trans.remarks')
                                    </h3>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1">
                                            <label for="about">@lang('trans.about')</label>
                                            <p>
                                                @if(Session::get('locale') == 'bn')
                                                    {{ $contact->about }}
                                                @else
                                                    {{ $contact->about }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @endif
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
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_contact').addClass('act_item');
    </script>
@endsection