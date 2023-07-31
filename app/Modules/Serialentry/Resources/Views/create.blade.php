@extends('layouts.main')

@section('title', 'Serial Create')

@section('header')
    @include('inc.header')
@endsection



@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
<style type="text/css">
    
    .item-name{font-size: 16px;font-weight:bold;margin-left: 15px !important}
    .input-class{
        margin:10px 
    }
    input .input-class:last-child{
        margin:0px !important;
    }
</style>

@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('product_by_bill'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Serial Entry</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Bill</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Bill" id="customer_id" name="customer_id" onchange="func()">
                                                <option value="">Select Bill</option>

                                                @foreach($bills as $bill)
                                                    <option value="{{$bill->bill->id}}">Bill-{{$bill->bill->bill_number.' '.$bill->bill->customer->display_name }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <br>
                                    
                                 
                                  

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
   
    

    <style>
        .last td a i{
            display: block !important;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script> 
        $('#serial_entry').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
    </script>
    <script type="text/javascript">
       function func(){
            
            $('#customer_id').on('change', function() {
                $('#submitStock').submit();
            });
           
        }

    </script>

    <script type="text/javascript">
        $( "#customer_id" ).change(function() {
          $('#my_profile').submit();
         
        });
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
