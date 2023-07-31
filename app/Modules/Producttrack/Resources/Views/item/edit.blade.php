@extends('layouts.main')

@section('title', 'Product Item')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('product_phase_item_update', ['id' => $product_phase_item->id]), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">

                            <input type="hidden" ng-init="item_id='asdfg'" value="{{$item_id}}" name="item_id" ng-model="item_id">

                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Edit Item</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                          <label class="uk-vertical-align-middle" for="recipient_name">Recipient Name <span style="color:red">*</span></label> <br>
                                            <select title="Select Recipient" id="recipient_id" name="recipient_id" class="md-input select2-single-search-dropdown">
                                                <option value="">Select Recipient</option>
                                                @foreach($recipients as $recipient)
                                                    @if($recipient->id == $product_phase_item->recipient_id)
                                                        <option value="{{ $recipient->id }}" selected>{{ $recipient->display_name }}</option>
                                                    @else
                                                        <option value="{{ $recipient->id }}">{{ $recipient->display_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->first('recipient_id'))
                                                <div class="uk-text-danger uk-margin-top">Recipient is required.</div>
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                          <label class="uk-vertical-align-middle" for="issued_by">Issued By <span style="color:red">*</span></label> <br>
                                            <select title="Select Recipient" id="issued_by" name="issued_by" class="md-input select2-single-search-dropdown">
                                                <option value="">Select User</option>
                                                @foreach($issue_creators as $issue_creator)

                                                    @if($issue_creator->id == $product_phase_item->issued_by)
                                                        <option value="{{ $issue_creator->id }}" selected>{{ $issue_creator->name}}</option>
                                                    @else
                                                        <option value="{{ $issue_creator->id }}">{{ $issue_creator->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->first('issued_by'))
                                                <div class="uk-text-danger uk-margin-top">Issued By is required.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>

                                        <div class="uk-width-medium-1-3">
                                            <label for="issued_number">Enter issued number</label>
                                            <input  class="md-input" type="text" id="issued_number" name="issued_number" value="{{$product_phase_item->issued_number}}" required/>
                                        </div>

                                    @if($errors->first('issued_number'))
                                        <div class="uk-text-danger uk-margin-top">Issued Numbery is required.</div>
                                    @endif
                                        <div class="uk-width-medium-1-3">
                                            <label for="reference">Enter Reference</label>
                                            <input class="md-input" type="text" id="reference" name="reference" value="{{$product_phase_item->reference}}" />
                                        </div>
                                    @if($errors->first('reference'))
                                        <div class="uk-text-danger uk-margin-top">Reference is required.</div>
                                    @endif
                                        <div class="uk-width-medium-1-3">
                                            <label for="date">Enter date <span style="color:red">*</span></label>
                                            <input class="md-input" type="text" id="date" name="date" data-uk-datepicker="{format:'DD.MM.YYYY'}" value="{{$product_phase_item->date}}" required/>
                                        </div>
                                    </div>
                                    @if($errors->first('date'))
                                        <div class="uk-text-danger uk-margin-top">Date is required.</div>
                                    @endif

                                    <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <table class="uk-table">
                                                <thead>
                                                    <tr>
                                                        <th class="uk-text-nowrap">Item Category<span style="color:red">*</span></th>
                                                        <th class="uk-text-nowrap">Item<span style="color:red">*</span> </th>
                                                        <th class="uk-text-nowrap">Quantity<span style="color:red">*</span></th>
                                                        <th class="uk-text-nowrap">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="add_row">
                                                  @foreach($product_phase_item_add as $key=>$product_phase)
                                                <tr class="tr_{{$key}}" id="data_clone">
                                                    <td style="width: 30%">
                                                        <select id="item_category_id_{{ $key }}" name="item_category_id[]" class="md-input select2-single-search-dropdown"  onchange="getItem( {{$key}} )" required>
                                                          @foreach($item_categories as $category)
                                                          <option {{$category->id==$product_phase->item_category_id ? 'selected' :'' }} value="{{ $category->id }}"> {{ $category->item_category_name }}</option>
                                                          @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width: 30%">
                                                        <select title="Select Item" id="item_id_{{ $key}}" name="item_id[]" class="md-input select2-single-search-dropdown" required>
                                                          @foreach($items as $item)
                                                          <option {{$item->id == $product_phase->item_id ? 'selected' :'' }} value="{{ $item->id }}"> {{ $item->item_name }}</option>
                                                          @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width: 20%">
                                                        <input type="text" class="md-input" placeholder="Enter Quantity" value="{{ $product_phase->total }}" name="total[]" />
                                                    </td>
                                                    <td style="width: 20%" class="uk-text-right uk-text-middle">
                                                            <span class="uk-input-group-addon">
                                                                 <a class="remove_field"><i style="font-size: 30px" class="material-icons">&#xE15C;</i></a>
                                                            </span>
                                                    </td>
                                                </tr>
                                                @endforeach

                                                </tbody>
                                                <tr style="border-bottom: 0px;" class="form_section" id="data_clone">
                                                    <td>

                                                    </td>
                                                    <td>

                                                    </td>
                                                    <td>

                                                    </td>
                                                    <td class="uk-text-right uk-text-middle">
                                                            <span class="uk-input-group-addon">
                                                              <a id="append_field"><i style="font-size: 30px" class="material-icons">&#xE147;</i></a></span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="personal_note">Personal note</label>
                                                    <textarea class="md-input" id="personal_note" name="personal_note" required>{{$product_phase_item->personal_note}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($errors->first('personal_note'))
                                        <div class="uk-text-danger uk-margin-top">Personal Note is required.</div>
                                    @endif

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                         <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
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
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_product').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

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

    </script>
    <script type="text/javascript">

    $('#append_field').on('click',function(){
      var k = $('.add_row tr:last-child').attr('class').split('_');
      x = k[1];
      var index_no =   x;
        index_no++;
         $('.add_row').append(
           `<tr style="border-bottom: 0px;" class="tr_`+index_no+`" id="data_clone">
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
