@extends('layouts.main')

@section('title', 'Chart Of Accounts')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
 <style media="screen">

    input{
      margin-top:10px;
    }

     </style>
@endsection
@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Account Account</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('account_chart_update', ['id' => $account->id]), 'method' => 'POST']) !!}
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                          <label for="account_type_id">Account Type <span style="color: red">*</span></label> <br>
                                            <select id="account_type_id" name="account_type_id" class="md-input select2-single-search-dropdown">
                                                <option value="">Select type</option>
                                                @foreach($parent_account_types as $parent_account_type)
                                                    <optgroup label="{{ $parent_account_type->account_name }}">
                                                        @foreach($account_types as $account_type)
                                                            @if($account_type->parent_account_type_id == $parent_account_type->id)
                                                                @if($account_type->id == $account->account_type_id)
                                                                    <option value="{{ $account_type->id }}" selected>{{ $account_type->account_name }}</option>
                                                                @else
                                                                    <option value="{{ $account_type->id }}">{{ $account_type->account_name }}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                            @if($errors->first('account_type_id'))
                                                <div class="uk-text-danger uk-margin-top">Account type is required.</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="account_name">Account Name</label>
                                            <input class="md-input" type="text" id="account_name" name="account_name" value="{{ $account->account_name }}" required />
                                            @if($errors->first('account_name'))
                                                <div class="uk-text-danger">Account name is required.</div>
                                            @endif
                                        </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="account_code">Account Code</label>
                                        <input class="md-input" type="text" id="account_code" name="account_code" value="{{ $account->account_code }}"/>
                                        @if($errors->first('account_code'))
                                            <div class="uk-text-danger">Account code is required.</div>
                                        @endif
                                    </div>
                                  </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-5-5">
                                          <br>
                                          <label class="uk-vertical-align-middle" for="description">Description</label>
                                            <textarea class="md-input" name="description" id="description" cols="30" rows="4" placeholder="Write description here...">{{ $account->description }}</textarea>
                                            @if($errors->first('description'))
                                                <div class="uk-text-danger">Description is required.</div>
                                            @endif
                                        </div>
                                    </div>


                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($account->createdBy['name']) ? $account->createdBy['name']:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated By</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($account->updatedBy['name']) ? $account->updatedBy['name']:''  !!}</span>
                                    </div>
                                </div>


                                <hr class="uk-grid-divider">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Created At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($account->created_at) ? $account->created_at:''  !!}</span>
                                    </div>
                                </div>
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-large-1-3">
                                        <span class="uk-text-muted uk-text-small">Updated At</span>
                                    </div>
                                    <div class="uk-width-large-2-3">
                                        <span class="uk-text-large uk-text-middle">{!! isset($account->updated_at) ? $account->updated_at:''  !!}</span>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <hr>
                                <br>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <a href="{{ route('account_chart') }}" class="md-btn md-btn-flat uk-modal-close">Close</a>
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
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_account_chart_of_accounts').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });
    </script>
@endsection
