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
            {!! Form::open(['url' => route('serial_entry_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Bill-{{$bill_number}} Serial Entry</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        
                                        <div class="uk-width-medium-1-2">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Bill" id="customer_id" name="customer_id" onchange="func()">
                                                 <option value="">Select Bill</option>

                                                @foreach($bills as $bill)
                                                    <option value="{{ $bill->bill->id }}"
                                                        {{$bill->bill->id==$bill_id ?'selected' :''}}
                                                        >Bill-{{$bill->bill->bill_number.' '.$bill->bill->customer->display_name }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <input class="md-input" type="text" id="date" name="date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                        </div>
                                    </div>
                                    <br>
                                <div class="serial-entry">
                                     @foreach($product as $value )
                                     <div  class="md-card">
                                        
                                       <h1 class="item-name">{{$value->name.'( '.$value->qty.' pcs)'}}</h1>
                                      
                                    <div class="uk-grid" data-uk-grid-margin>
                                            <input type="hidden" name="bill_entry_id[]" value="{{$value->bill_entry_id}}">
                                         @for($i=0;$i<$value->qty;$i++)
                                        <div class="uk-width-medium-1-6">
                                            
                                             <input  class="md-input input-class"  value="" type="text" name="serial[{{$value->bill_entry_id}}][]"  placeholder="serial no" required>
                                        </div>
                                        @endfor
                                       <br>
                                        
                                    </div>
                                </div>
                                     @endforeach
                            </div>
                                  <br>
                                 
                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="submit" name="submit" />
                                           
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
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
          $('#databaseActionForm').submit();
        });
    </script>
    <script type="text/javascript"> 
        $(document).ready(function() {
          $(window).keydown(function(event){
            if(event.keyCode == 13 || event.keyCode == 10) {
              event.preventDefault();
              return false;
               }
             });
        });
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
