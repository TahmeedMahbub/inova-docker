@extends('layouts.main')

@section('title', 'Product Item')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style type="text/css">
        input{
            margin-top: 10px;
        }
    </style>
@endsection



@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('product_item_store'), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">@lang('trans.create_item')</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label class="uk-vertical-align-middle" for="recipient_name">@lang('trans.recepient_name') <span style="color:red">*</span> </label><br>
                                            <select id="recipient_id" name="recipient_id" class="md-input select2-single-search-dropdown">
                                                <option value="">@lang('trans.select_recepient')</option>
                                                @foreach($recipients as $recipient)
                                                    <option value="{{ $recipient->id}}">{{ $recipient->display_name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->first('recipient_id'))
                                                <div class="uk-text-danger uk-margin-top">Recipient is required.</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label class="uk-vertical-align-middle" for="issued_by">@lang('trans.issued_by')<span style="color:red">*</span></label><br>
                                            <select id="issued_by" name="issued_by" class="md-input select2-single-search-dropdown">
                                                <option value="">@lang('trans.select_user')</option>
                                                @foreach($issue_creators as $issue_creator)
                                                    <option value="{{ $issue_creator->id }}">{{ $issue_creator->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->first('issued_by'))
                                                <div class="uk-text-danger uk-margin-top">Issued By is required.</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="issued_number">@lang('trans.enter_issued_number')</label>
                                            <input class="md-input" type="text" id="issued_number" name="issued_number" value="{{$issue_number}}"  required/>
                                            @if($errors->first('issued_number'))
                                                <div class="uk-text-danger uk-margin-top">Issued Numbery is required.</div>
                                            @endif
                                        </div>
                                    </div>

                                    <input  class="md-input" value="{{ $id }}" type="hidden" id="product_id" name="product_id" />

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-3">
                                            <label for="reference">@lang('trans.enter_reference')</label>
                                            <input class="md-input" type="text" id="reference" name="reference" value="{{ old('reference') }}" />
                                            @if($errors->first('reference'))
                                                <div class="uk-text-danger uk-margin-top">Reference is required.</div>
                                            @endif
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label for="date">@lang('trans.enter_date') <span style="color:red">*</span></label>
                                            <input class="md-input" type="text" id="date" name="date" data-uk-datepicker="{format:'DD-MM-YYYY'}" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" required/>
                                            @if($errors->first('date'))
                                                <div class="uk-text-danger uk-margin-top">Date is required.</div>
                                            @endif
                                        </div>

                                        <div class="uk-width-medium-1-3">
                                            <label class="uk-vertical-align-middle" for="phase">@lang('trans.phase') <span style="color:red">*</span></label><br>
                                            <select id="phase" name="phase" class="md-input select2-single-search-dropdown">
                                                <option value="">@lang('trans.select_phase')</option>
                                                @foreach($phases as $phase)
                                                    <option value="{{ $phase->id }}">{{ $phase->product_phase_name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->first('phase'))
                                                <div class="uk-text-danger uk-margin-top">Phase is required.</div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <table class="uk-table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30%" class="uk-text-nowrap">Item Category<span style="color:red">*</span></th>
                                                        <th style="width: 30%" class="uk-text-nowrap">Item<span style="color:red">*</span></th>
                                                        <th style="width: 20%" class="uk-text-nowrap">@lang('trans.quantity')<span style="color:red">*</span></th>
                                                        <th style="width: 20%" class="uk-text-nowrap uk-text-center">@lang('trans.action')</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="add_row">
                                                    <tr style="border-bottom: 0px;" class="form_section" id="data_clone">
                                                        <td style="width: 30%">
                                                            <select class="md-input select2-single-search-dropdown" title="Item Category" id="item_category_id_0" name="item_category_id[0]" onchange="getItem(0)" required>
                                                              <option value="0"> Select Item Caregory</option>
                                                              @foreach($item_categories as $category)
                                                              <option value="{{ $category->id }}"> {{ $category->item_category_name }}</option>
                                                              @endforeach
                                                            </select>
                                                        </td>
                                                        <td style="width: 30%">
                                                            <select class="md-input select2-single-search-dropdown" title="Select Item" id="item_id_0" name="item_id[0]" required>

                                                            </select>
                                                        </td>
                                                        <td style="width: 20%">
                                                            <input style="margin-top: -8px" type="text" class="md-input" placeholder="Enter Quantity" name="total[0]" /><span class="uk-input-group-addon" required/>
                                                        </td>
                                                        <td class="uk-text-right uk-text-middle" style="width: 20%">
                                                            <span class="uk-input-group-addon">
                                                            <a id="append_field"><i style="font-size: 30px" class="material-icons">&#xE147;</i></a></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="personal_note">@lang('trans.personal_note')</label>
                                                    <textarea class="md-input" id="personal_note" name="personal_note">{{ old('personal_note') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($errors->first('personal_note'))
                                        <div class="uk-text-danger uk-margin-top">Personal Note is required.</div>
                                    @endif

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                         <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >@lang('trans.submit')</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">@lang('trans.close')</button>
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
<script>
    $('#sidebar_main_account').addClass('current_section');
    $('#sidebar_inventory_product').addClass('act_item');
    $(window).load(function(){
        $("#tiktok_account").trigger('click');
    })

</script>
<script type="text/javascript">
// item sub category
function getItem(x)
{
  var item_sub_cat_id = $('#item_category_id_'+x).val();
  $.get('/product-track/item/sub_category/'+ item_sub_cat_id,function(data){
    var list = '';
    var list1 = '';

    $.each(data, function(i, data)
    {
       list += '<option value = "' +  data.id + '" selected>' + data.item_name +'</option>';
    });
    list1 += '<option value = "0">' + 'Select Item ' +'</option>';

    $("#item_id_"+x).empty();
    $("#item_id_"+x).append(list1);
    $("#item_id_"+x).append(list);

  });
}
var index_no = 0;
$('#append_field').on('click',function(){
    index_no++;
     $('.add_row').append(
       `<tr style="border-bottom: 0px;" class="form_section tr_`+index_no+`" id="data_clone">
           <td style="width: 30%">
               <select class="md-input select2-single-search-dropdown single_select2" title="Item Category" id="item_category_id_`+ index_no +`" name="item_category_id[]" onchange="getItem(`+ index_no +`)" required>
                 <option value="0"> Select Item Caregory</option>
                 @foreach($item_categories as $category)
                 <option value="{{ $category->id }}"> {{ $category->item_category_name }}</option>
                 @endforeach
               </select>
           </td>
           <td style="width: 30%">
               <select class="md-input select2-single-search-dropdown single_select2" title="Select Item" id="item_id_`+ index_no +`" name="item_id[]" required>

               </select>
           </td>
           <td style="width: 20%">
               <input style="margin-top: -8px" type="text" class="md-input" placeholder="Enter Quantity" name="total[]" /><span class="uk-input-group-addon" required/>
           </td>
           <td>
             <span class="uk-input-group-addon">
                 <a class="remove_field"><i style="font-size: 30px" class="material-icons">&#xE15C;</i></a>
             </span>
           </td>

       </tr>`
     );
       $('.single_select2').select2();
 });
 //For apending another rows end
 $('.add_row').on("click",".remove_field", function(e)
 {

   e.preventDefault();
   $(this).parents("tr").remove();

 });
</script>
@endsection
