@extends('layouts.main')

@section('title', ' Hide Show')

@section('header')
	@include('inc.header')
@endsection

@section('sidebar')
	@include('inc.sidebar')
@endsection

@section('styles')
	<style type="text/css">

	    .squaredOne {
	        -webkit-appearance: none;
	    background-color: #fafafa;
	    border: 10px solid #cacece;
	    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
	    padding: 9px;
	    border-radius: 3px;
	    display: inline-block;
	    position: relative;
	}

	.squaredOne:active, .squaredOne:checked:active {
	    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
	}

	.squaredOne:checked {
	    background-color: #e9ecee;
	    border: 10px solid #009E89;
	    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
	    color: #99a1a7;
	}

	.squaredOne:checked:after {
	    content: '\2714';
	    font-size: 15px;
	    position: absolute;
	    top: -10.5px;
	    left: -7px;
	    color: white;
	}
	</style>
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
                    <div class="user_content">
                        <div class="uk-margin-top">
                            {!! Form::open(['url' => route('settings_hide_show_store'), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <h3>Item Hide Show List</h3>
                                        <br>
                                    </div>

                                    <div class="uk-width-medium-1-1">
                                        <div class="uk-overflow-container">
                                            
                                            <div class="">
                                                <div class="uk-accordion" id="accor1" data-uk-accordion>
                                                    <h3 class="uk-accordion-title uk-accordion-title-primary">Sidebar</h3>
                                                    <div class="uk-accordion-content">
                                                        <!-- <div class="uk-width-medium-1-1 uk-overflow-container"> -->
                                                            <table class="input_fields_wrap1 uk-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uk-text-nowrap">#</th>
                                                                        <th class="uk-text-nowrap">Id</th>
                                                                        <th class="uk-text-center">Action</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody class="getMultipleRow1">
                                                                    @if(!empty($hide_show_list_sidebar))
                                                                    @foreach($hide_show_list_sidebar as $key1 => $sidebar_id1)
                                                                    <tr class="tr_{{$key1}}" id="data_clone">
                                                                        <td>
                                                                            <p style="padding-top: 10px">{{ $key1 + 1 }}</p>
                                                                        </td>

                                                                        <td>
                                                                            <input id="sidebar_id1_{{$key1}}" type="text" class="md-input" name="sidebar_id[]" value="{{ $sidebar_id1->sidebar_id }}" />
                                                                            <input type="hidden" class="md-input" name="type[]" value="1" />
                                                                        </td>

                                                                        <td style="text-align: center">
                                                                            <a href="#" class="remove_field1">
                                                                                <i style="padding-top: 5px;" class="material-icons md-36">delete</i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif

                                                                    <tr class="tr_{{$count_1}}" id="data_clone">
                                                                        <td>
                                                                            <p style="padding-top: 10px">{{ $count_1 + 1 }}</p>
                                                                        </td>

                                                                        <td>
                                                                            <input id="sidebar_id1_{{$count_1}}" type="text" class="md-input" name="sidebar_id[]" />
                                                                            <input type="hidden" class="md-input" name="type[]" value="1" />
                                                                        </td>

                                                                        <td style="text-align: center">
                                                                            <a href="#" class="remove_field1">
                                                                                <i style="padding-top: 5px;" class="material-icons md-36">delete</i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                            <table style="float:right;margin-top:-20px !important " class="add_table1">
                                                                <tr>
                                                                    <td style="text-align: center;text-align: center">
                                                                        <a href="#" class="add_field_button1">
                                                                            <i style="padding-top: 15px;padding-bottom: 38px" class="material-icons md-36">&#xE146;</i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-1">
                                        <div class="uk-overflow-container">
                                            
                                            <div class="">
                                                <div class="uk-accordion" id="accor2" data-uk-accordion>
                                                    <h3 class="uk-accordion-title uk-accordion-title-success">Report</h3>
                                                    <div class="uk-accordion-content">
                                                        <!-- <div class="uk-width-medium-1-1 uk-overflow-container"> -->
                                                            <table class="input_fields_wrap1 uk-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uk-text-nowrap">#</th>
                                                                        <th class="uk-text-nowrap">Id</th>
                                                                        <th class="uk-text-center">Action</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody class="getMultipleRow2">
                                                                    @if(!empty($hide_show_list_report))
                                                                    @foreach($hide_show_list_report as $key2 => $sidebar_id2)
                                                                    <tr class="tr_{{$key2}}" id="data_clone">
                                                                        <td>
                                                                            <p style="padding-top: 10px">{{ $key2 + 1 }}</p>
                                                                        </td>

                                                                        <td>
                                                                            <input id="sidebar_id2_{{$key2}}" type="text" class="md-input" name="sidebar_id[]" value="{{ $sidebar_id2->sidebar_id }}" />
                                                                            <input type="hidden" class="md-input" name="type[]" value="2" />
                                                                        </td>

                                                                        <td style="text-align: center">
                                                                            <a href="#" data-val="{{$key2}}"class="remove_field2">
                                                                                <i style="padding-top: 5px;" class="material-icons md-36">delete</i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif

                                                                    <tr class="tr_{{$count_2}}" id="data_clone">
                                                                        <td>
                                                                            <p style="padding-top: 10px">{{ $count_2 + 1 }}</p>
                                                                        </td>

                                                                        <td>
                                                                            <input id="sidebar_id2_{{$count_2}}" type="text" class="md-input" name="sidebar_id[]" />
                                                                            <input type="hidden" class="md-input" name="type[]" value="2" />
                                                                        </td>

                                                                        <td style="text-align: center">
                                                                            <a href="#" class="remove_field2">
                                                                                <i style="padding-top: 5px;" class="material-icons md-36">delete</i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                            <table style="float:right;margin-top:-20px !important " class="add_table2">
                                                                <tr>
                                                                    <td style="text-align: center;text-align: center">
                                                                        <a href="#" class="add_field_button2">
                                                                            <i style="padding-top: 15px;padding-bottom: 38px" class="material-icons md-36">&#xE146;</i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-1">
                                        <div class="uk-overflow-container">
                                            
                                            <div class="">
                                                <div class="uk-accordion" id="accor3" data-uk-accordion>
                                                    <h3 class="uk-accordion-title uk-accordion-title-warning">Input Fields</h3>
                                                    <div class="uk-accordion-content">
                                                        <!-- <div class="uk-width-medium-1-1 uk-overflow-container"> -->
                                                            <table class="input_fields_wrap1 uk-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uk-text-nowrap">#</th>
                                                                        <th class="uk-text-nowrap">Id</th>
                                                                        <th class="uk-text-center">Action</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody class="getMultipleRow3">
                                                                    @if(!empty($hide_show_list_fields))
                                                                    @foreach($hide_show_list_fields as $key3 => $sidebar_id3)
                                                                    <tr class="tr_{{$key3}}" id="data_clone">
                                                                        <td>
                                                                            <p style="padding-top: 10px">{{ $key3 + 1 }}</p>
                                                                        </td>

                                                                        <td>
                                                                            <input id="sidebar_id3_{{$key3}}" type="text" class="md-input" name="sidebar_id[]" value="{{ $sidebar_id3->sidebar_id }}" />
                                                                            <input type="hidden" class="md-input" name="type[]" value="3" />
                                                                        </td>

                                                                        <td style="text-align: center">
                                                                            <a href="#" class="remove_field3">
                                                                                <i style="padding-top: 5px;" class="material-icons md-36">delete</i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif

                                                                    <tr class="tr_{{$count_3}}" id="data_clone">
                                                                        <td>
                                                                            <p style="padding-top: 10px">{{ $count_3 + 1 }}</p>
                                                                        </td>

                                                                        <td>
                                                                            <input id="sidebar_id3_{{$count_3}}" type="text" class="md-input" name="sidebar_id[]" />
                                                                            <input type="hidden" class="md-input" name="type[]" value="3" />
                                                                        </td>

                                                                        <td style="text-align: center">
                                                                            <a href="#" class="remove_field3">
                                                                                <i style="padding-top: 5px;" class="material-icons md-36">delete</i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                            <table style="float:right;margin-top:-20px !important " class="add_table3">
                                                                <tr>
                                                                    <td style="text-align: center;text-align: center">
                                                                        <a href="#" class="add_field_button3">
                                                                            <i style="padding-top: 15px;padding-bottom: 38px" class="material-icons md-36">&#xE146;</i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <a href="#" class="md-btn md-btn-flat">Close</a>
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
        $('#settings_menu_item_hide_show').addClass('md-list-item-active');

        var accordion1 = UIkit.accordion(document.getElementById('accor1'), {
            showfirst:false
        });

        var accordion2 = UIkit.accordion(document.getElementById('accor2'), {
            showfirst:false
        });

        var accordion3 = UIkit.accordion(document.getElementById('accor3'), {
            showfirst:false
        });
    </script>

    <script type="text/javascript">
        var max_fields        = 50;                           //maximum input boxes allowed
        var wrapper1          = $(".input_fields_wrap1");      //Fields wrapper
        var add_button1       = $(".add_field_button1");       //Add button ID

        //For apending another rows start
        var x = 0;
        $(add_button1).click(function(e)
        {
            e.preventDefault();

            var x = parseInt($('.getMultipleRow1 tr:last').attr('class').match(/(\d+)/g)[0]);

            if(x < max_fields)
            {
                x++;

                var serial = x + 1;
                
                $('.getMultipleRow1').append( ' ' +'<tr class="tr_'+x+'">'+
                    '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="sidebar_id1_'+x+'" class="md-input" name="sidebar_id[]" value="" />\n'+
                    '<input type="hidden" class="md-input" name="type[]" value="1" />'+'</td>\n'+
                    '<td style="text-align: center">\n'+'<a href="#" data-val="'+x+'" class="remove_field1">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                    '</tr>\n');
            }

            if(serial>1)
            {
              $('.add_table1').css('display','inline');
            }
        });
        //For apending another rows end

        $(wrapper1).on("click",".remove_field1", function(e)
        {   
            e.preventDefault();
            $(this).parent().parent().remove(); x--;
        });
    </script>

    <script type="text/javascript">
        var max_fields        = 50;                           //maximum input boxes allowed
        var wrapper2          = $(".input_fields_wrap2");      //Fields wrapper
        var add_button2       = $(".add_field_button2");       //Add button ID

        //For apending another rows start
        var x = 0;
        $(add_button2).click(function(e)
        {
            e.preventDefault();

            var x = parseInt($('.getMultipleRow2 tr:last').attr('class').match(/(\d+)/g)[0]);

            if(x < max_fields)
            {
                x++;

                var serial = x + 1;
                
                $('.getMultipleRow2').append( ' ' +'<tr class="tr_'+x+'">'+
                    '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="sidebar_id2_'+x+'" class="md-input" name="sidebar_id[]" value="" />\n'+
                    '<input type="hidden" class="md-input" name="type[]" value="2" />'+'</td>\n'+
                    '<td style="text-align: center">\n'+'<a href="#" data-val="'+x+'" class="remove_field2">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                    '</tr>\n');
            }

            if(serial>1)
            {
              $('.add_table2').css('display','inline');
            }
        });
        //For apending another rows end

        $('.getMultipleRow2').on("click",".remove_field2", function(e)
        {   
            e.preventDefault();
           
            
            $(this).parent().parent().remove(); x--;
        });
    </script>

    <script type="text/javascript">
        var max_fields        = 50;                           //maximum input boxes allowed
        var wrapper3          = $(".input_fields_wrap3");      //Fields wrapper
        var add_button3       = $(".add_field_button3");       //Add button ID

        //For apending another rows start
        var x = 0;
        $(add_button3).click(function(e)
        {
            e.preventDefault();

            var x = parseInt($('.getMultipleRow3 tr:last').attr('class').match(/(\d+)/g)[0]);

            if(x < max_fields)
            {
                x++;

                var serial = x + 1;
                
                $('.getMultipleRow3').append( ' ' +'<tr class="tr_'+x+'">'+
                    '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="sidebar_id3_'+x+'" class="md-input" name="sidebar_id[]" value="" />\n'+
                    '<input type="hidden" class="md-input" name="type[]" value="3" />'+'</td>\n'+
                    '<td style="text-align: center">\n'+'<a href="#" data-val="'+x+'" class="remove_field3">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                    '</tr>\n');
            }

            if(serial>1)
            {
              $('.add_table3').css('display','inline');
            }
        });
        //For apending another rows end

        $('.getMultipleRow3').on("click",".remove_field3", function(e)
        {   
            e.preventDefault();
            $(this).parent().parent().remove(); x--;
        });
    </script>
@endsection
