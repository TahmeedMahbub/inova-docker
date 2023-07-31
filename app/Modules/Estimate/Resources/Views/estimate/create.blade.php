@extends('layouts.main')

@section('title', 'Estimate')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
<style media="screen">
.getMultipleRow input, .discount_type{
    margin-top:-10px;
}
span.select2-container--open {
    z-index: 5000 !important;
}
</style>
@endsection
@section('content')
    <div class="uk-grid" >
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('estimate_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Estimate</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                      <label class="uk-vertical-align-middle" for="customer_name">Customer Name<sup><sup><i style="color:red; font: 14px; " class="material-icons">stars</i></sup></label> <br>
                                        <select id="customer_id" name="customer_id" class="md-input select2-single-search-dropdown" required>
                                            <option value="">Select Customer</option>
                                            @foreach($customer as $value)
                                                <option value="{{ $value->id }}">{{ $value->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="margin-top: 12px" class="uk-width-medium-1-3">
                                        <label for="estimate_number">Estimate Number</label>
                                        <input  class="md-input" type="text" id="estimate_number"  name="estimate_number" readonly  value="QUOT-{{ str_pad($estimate_number->id+2,6,"0",STR_PAD_LEFT) }}" />
                                        @if($errors->first('estimate_number'))
                                            <div class="uk-text-danger">Estimate number is required.</div>
                                        @endif
                                    </div>
                                    <div style="margin-top: 12px" class="uk-width-medium-1-3">
                                        <label class="" for="date">Date<sup><i style="color:red; font: 14px; " class="material-icons">stars</i></sup></label>
                                        <input class="md-input" id="date" type="text"  name="date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                  <div class="uk-width-medium-1-4">
                                      <label for="reference">Enter Reference Number</label>
                                      <input class="md-input" type="text" id="reference" name="ref" />
                                  </div>
                                  <div class="uk-width-medium-1-4">
                                      <label for="ref">Enter attn</label>
                                      <input class="md-input" type="text" id="attn"  name="attn"  />
                                      @if($errors->first('attn'))
                                          <div class="uk-text-danger">Ref is required.</div>
                                      @endif
                                  </div>
                                    <div class="uk-width-medium-1-4">
                                        <label for="ref">Enter Designation</label>
                                        <input class="md-input" type="text" id="attn_designation"  name="attn_designation"  />
                                        @if($errors->first('attn_designation'))
                                          <div class="uk-text-danger">Attn Designation is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label for="subject">Enter Subject</label>
                                        <input class="md-input" type="text" id="subject" name="subject" />
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-1-1">
                                        <label for="heading">Enter Heading</label>
                                        <textarea  id="editor1" name="heading" rows="12" cols="100"></textarea>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-1-1">
                                        <label for="table_head">Enter Table Head</label>
                                        <input class="md-input" type="text" id="table_head" name="table_head" />
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-3-3">
                                        <label for="terms_conditions">Terms & Conditions</label>
                                        <textarea  id="editor2" name="terms_conditions" rows="12" cols="100"></textarea>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-3-3">
                                        <label for="left_notation">Left Notation</label>
                                        <textarea  id="editor3" name="left_notation" rows="12" cols="100"></textarea>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-3-3">
                                        <label for="right_notation">Right Notation</label>
                                        <textarea  id="editor4" name="right_notation" rows="12" cols="100"></textarea>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div style="margin-top: 4px" class="uk-width-medium-1-3">
                                        <label for="customer_note"> Category <span style="color: red;" class="asterisc">*</span></label> <br>
                                        <select id="change" name="item_category_id" onchange="func()" class="select2-single-search-dropdown">
                                                <option value=""> Select Category </option>
                                            @foreach($item_category as $value)
                                                <option  value="{{ $value->id }}">{{ $value->item_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="customer_note">Sub Category<span style="color: red;" class="asterisc">*</span></label><br>
                                        <select id="item_sub_category_id" onchange="func()" name="item_sub_category_id" class="md-input select2-single-search-dropdown" selected>
                                        </select>
                                    </div>

                                    <div style="margin-top:10px" class="uk-width-medium-1-3">
                                        <label for="invoice_date">Add New Item By Serial</label>
                                        <input class="md-input" type="text" id="new_item_serial" onfocusout="newserial()" name="new_item_serial">
                                          <p id = "serial_message" style = "color: red; font-weight: bold; display: none;"></p>
                                    </div>

                                </div>

                                <br />

                                <div class="uk-width-medium-1-1 table-responsive">
                                    <table class="input_fields_wrap uk-table table">
                                        <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">#</th>
                                                <th class="uk-text-nowrap"width="20%">Product/Service <span style="color: red;" class="asterisc">*</span></th>
                                                <th class="uk-text-nowrap">Description</th>
                                                <th class="uk-text-nowrap">Quantity<span style="color: red;" class="asterisc">*</span></th>
                                                <th class="uk-text-nowrap">Unit<span style="color: red;" class="asterisc">*</span></th>

                                                <th class="uk-text-nowrap">Rate<span style="color: red;" class="asterisc">*</span></th>
                                                <th class="uk-text-nowrap">Discount</th>
                                                <th class="uk-text-nowrap"></th>
                                                <th class="uk-text-nowrap">Amount</th>
                                                <th class="uk-text-nowrap" width="20%">Account</th>
                                                <th class="uk-text-nowrap">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="getMultipleRow">
                                            <tr class="tr_0" id="data_clone"  >
                                                <td>
                                                    <p style="padding-top: 10px">1</p>
                                                </td>

                                                <td style="width: 200px">
                                                    <select id="item_id_0" class="md-input itemId select2-single-search-dropdown" name="item_id[]" onchange="itemChanged(this,'');getItemPrice(0)" required>

                                                    </select>
                                                    <a data-toggle="uk-modal" onclick="addVariationBtnClicked(this)"
                                                    data-uk-modal="{target:'#chooseVariationWithAttributeValues'}" id="choose_variation_modal_0" type="submit"
                                                    class="sm-btn sm-btn-primary variation-button">
                                                        <span
                                                        class="uk-badge uk-align-center uk-margin-small-top">
                                                            Add Variation
                                                        </span>
                                                    </a>
                                                    <input id="selected_variation_0" name="selected_variation[]" type="number" style="display: none" value="">

                                                    <!--<div class="row">-->
                                                    <!--    <label style="padding-right: 0px;padding-top: 10px" class="col-md-6">Stock Left : </label>-->
                                                    <!--    <input style="border: none;padding-left: 0px;font-weight: bold;padding-top: 10px" class="col-md-6" type="text" id="stock_0" class="stock" name="stock[]" readonly="readonly" onchange="getItemPrice(0)"/>-->
                                                    <!--</div>-->
                                                </td>

                                                <td>
                                                    <input type="text" id="description_0" class="md-input description" name="description[]"  oninput="calculateActualAmount(0)" >
                                                </td>

                                                <td>
                                                    <input  type="text" id="quantity_0" name="quantity[]" class="md-input quantity" value="1" oninput="calculateActualAmount(0)" />
                                                </td>
                                                <td>
                                                           
                                                    <select  id="unit_id_0"  name="unit_id[]" class="select2-single-search-dropdown"
                                                        required >
                                                        <option value="">Select Unit</option>
                                                        @foreach($units as $unit)
                                                        <option value="{{ $unit->id }}" >
                                                            {{ $unit->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                   
                                                @if ($errors->has('unit_id.*'))
                                                        <span class="error" style="color: red">
                                                            Unit  is required
                                                        </span>                                                                
                                                    @endif
                                                </td>

                                                <td style="width: 200px"> 
                                                    <input type="text" id="rate_0" name="rate[]" class="md-input rate" value="0.00" oninput="calculateActualAmount(0)" required/>
                                                </td>

                                                <td>
                                                    <input id="discount_0" type="text" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount(0)">
                                                </td>

                                                <td style="width: 80px">
                                                    <select class="md-input discount_type" id="discount_type_0" name="tax_id[]" onchange="calculateActualAmount(0)">
                                                        <option value="1" selected>BDT</option>
                                                        <option value="2">%</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" id="amount_0" name="amount[]" class="md-input amount" value="0" oninput="calculateActualAmount(0)" readonly="readonly" />
                                                </td>

                                                <td>
                                                    <select id="account_id_0" class="md-input accountId select2-single-search-dropdown" name="account_id[]" required>
                                                        <option value="" selected>Select Account</option>
                                                        @if(!empty($account) && (count($account) > 0))
                                                            @foreach($account as $account_value)
                                                                <option value="{{ $account_value->id }}" {{$account_value->id==16 ? 'selected':''}}>{{ $account_value->account_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>

                                                <td style="text-align: center">
                                                    <a href="#" class="add_field_button">
                                                        <i style="padding-top: 10px" class="material-icons md-36">&#xE146;</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="display:none;float:right;margin-top:-20px !important " class="add_table">
                                      <tr>

                                          <td style="text-align: center"  >
                                              <a href="#" class="add_field_button">
                                                  <i style="padding-top: 10px" class="material-icons md-36">&#xE146;</i>
                                              </a>
                                          </td>
                                        </tr>
                                    </table>
                                </div>

                                <div style="margin-left: 0px" class="uk-grid table-responsive" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3 uk-width-small-1-3 uk-margin-medium-top">


                                    </div>

                                    <div class="uk-width-medium-2-3 uk-width-small-2-3">
                                        <table class="uk-table table">
                                            <tbody>
                                              <tr>
                                                  <td style="border-color: white" colspan="3"></td>
                                                  <td>Sub Total</td>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td style="text-align: right">
                                                      <a style="border: none;text-decoration: none;color: black" id="subTotalShow">0.00</a>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="border-color: white" colspan="3"></td>
                                                  <td>Adjustment</td>
                                                  <td colspan="4">
                                                      <input type="text" id="adjustment" name="adjustment" class="md-input md-input-width-medium" value="0.00" oninput="calculateActualAmount(0)"/>
                                                  </td>
                                                  <td style="text-align: right">
                                                      <a style="border: none;text-decoration: none;color: black" id="adjustmentShow">0.00</a>
                                                  </td>
                                              </tr>
                                              <tr>
                                                    <td style="border-color: white" colspan="3"></td>
                                                    <td> Vat/Tax (%)</td>
                                                    <td colspan="4">
                                                        <input type="text" id="vat" class="md-input md-input-width-medium" value="0.00" oninput="calculateActualAmount(0)" />
                                                    </td>
                                                    <td style="text-align: right">
                                                        <a style="border: none;text-decoration: none;color: black" id="vatShow">0.00</a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="border-color: white" colspan="3"></td>
                                                    <td>Shipping Charges</td>
                                                    <td colspan="4">
                                                        <input type="text" id="shippingCharge" name="shipping_charge" class="md-input md-input-width-medium"  value="0.00" oninput="calculateActualAmount(0)"/>
                                                    </td>
                                                    <td style="text-align: right">
                                                        <a style="border: none;text-decoration: none;color: black" id="shippingChargeShow">0.00</a>
                                                    </td>
                                                </tr>

                                              <tr>
                                                  <td style="border-color: white" colspan="3"></td>
                                                  <th colspan="5">Total(BDT)</th>
                                                  <th style="text-align: right">
                                                      <a style="border: none;text-decoration: none;color: black" id="totalAmountShow">0.00</a>
                                                  </th>
                                              </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" id="subTotal" name="sub_total">
                                        <input type="hidden" id="totalAmount" name="total_amount">
                                        <input type="hidden" id="vat_total" name="tax_total">
                                    </div>
                                </div>

                                <hr>

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
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var ajax_data = [];
        var items_chosen = [];
        altair_forms.parsley_validation_config();
        $('#sidebar_estimate').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>
    <script type="text/javascript">
    function newserial()
  {
      var x               = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);

      var new_serial      = $('#new_item_serial').val();
      var tmp             = 0;
      var stop_op         = 0;

      $('#serial_message').text('');

      $("#serial_message").hide();

      //check if serial already used in previous rows
      for(tmp = 0; tmp <= x; tmp++){

          var used_serial = $('#serial_'+tmp).val();
          if(used_serial == new_serial && new_serial != ""){

              stop_op = 1;

              $('#serial_message').text('You have already used the serial in this invoice..!!');

              $("#serial_message").show();

          }
      }

      //if not used proceed with ajax call
      if(stop_op != 1){
          $.get('/invoice/check/serial/'+ new_serial, function(data){

              var item_id             = data.item_id;
              var item_serial         = data.item_serial;
              var item_sales_rate     = data.item_sales_rate;
              var item_exist_before   = 0;

              //if any item found append new row
              if(item_id > 0){

                  //check if item_id already exists in previous rows
                  for(tmp = 0; tmp <= x; tmp++){

                      var used_item = $('#item_id_'+tmp).val();

                      if(used_item == item_id && item_id > 0){

                          x = tmp;

                          item_exist_before = 1;

                      }
                  }

                  $('#serial_message').text('');
                  $("#serial_message").hide();

                  var item_0_val = $("#item_id_"+0).val();

                  //when no row was appended yet; we are at the very first row and item was not found before
                  if(item_exist_before != 1){

                      if(x == 0 && item_0_val == null){

                          $.get("{{ route('item_list_stock_serial') }}", function(data2){

                              var list5 = '';
                              var list7 = '';

                              $.each(data2, function(i, data2)
                              {
                                  if(data2.id == item_id){
                                      list5 += '<option value = "' +  data2.id + '" selected>' + data2.item_name +'</option>';
                                  }else{
                                      list5 += '<option value = "' +  data2.id + '">' + data2.item_name +'</option>';
                                  }

                              });

                              list7 += '<option value = "">' + 'Select Item ' +'</option>';

                              $("#item_id_"+0).empty();
                              $("#item_id_"+0).append(list7);
                              $("#item_id_"+0).append(list5);
                          });

                          $('#serial_0').val(item_serial);
                          $('#rate_0').val(item_sales_rate);
                          $('#amount_0').val(item_sales_rate);

                          calculateActualAmount(0);

                          $('#new_item_serial').val('');

                      }else{
                          x++;
                          var serial = x + 1;

                          $.get("{{ route('item_list_stock_serial') }}", function(data2){

                              var list5 = '';
                              var list7 = '';

                              $.each(data2, function(i, data2)
                              {
                                  if(data2.id == item_id){
                                      list5 += '<option value = "' +  data2.id + '" selected>' + data2.item_name +'</option>';
                                  }else{
                                      list5 += '<option value = "' +  data2.id + '">' + data2.item_name +'</option>';
                                  }

                              });

                              list7 += '<option value = "">' + 'Select Item ' +'</option>';

                              $("#item_id_"+x).empty();
                              $("#item_id_"+x).append(list7);
                              $("#item_id_"+x).append(list5);
                          });


                          $('.getMultipleRow').append( ' ' +'<tr class="tr_'+x+'">'+
                                '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+
                                '<td style="width: 200px">\n'+'<div class="md-input-wrapper md-input-filled md-input-wrapper-success">'+'<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="itemChanged(this,``);getItemPrice('+x+')" required>\n'+ '</select>\n'+
                                    '<a data-toggle="uk-modal" onclick="addVariationBtnClicked(this)" data-uk-modal="{target:`#chooseVariationWithAttributeValues`}" id="choose_variation_modal_'+x+'" type="submit" class="sm-btn sm-btn-primary variation-button">\n'+
                                    '<span class="uk-badge uk-align-center uk-margin-small-top">Add Variation</span>\n</a>\n'+'<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value="">'+'</div>'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="quantity_'+x+'" class="md-input quantity" name="quantity[]" value="1" oninput="calculateActualAmount('+x+')"/ >\n'+'</td>\n'+
                                '<td>\n'+'<select name="unit_id[]" id="unit_id_'+x+'" class="md-input  single_select2"  required>\n'+ '<option value="">Select Unit</option>\n'+ ' @foreach($units as $unit) <option  value="{{ $unit->id }}">{{ $unit->name }}</option> @endforeach</select>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<select id="discount_type_'+x+'" name="tax_id[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="2">%</option>\n'+'</select>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($account as $account_all) <option {{$account_all->id==16 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
                                '<td style="text-align: center">\n'+'<a href="#" class="remove_field">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                                '</tr>\n');
                          $('.single_select2').select2();

                          $('.single_select2').select2();

                          calculateActualAmount(x);

                          $('#new_item_serial').val('');

                      }

                  }else{

                      var total_amount    = 0;
                      var cur_rate        = $('#rate_'+x).val();
                      var cur_qty         = parseInt($('#quantity_'+x).val());

                      $('#quantity_'+x).val(cur_qty + 1);

                      cur_qty             = $('#quantity_'+x).val();

                      total_amount        = parseFloat(cur_qty * cur_rate);

                      $('#amount_'+x).val(total_amount);

                      var cur_serial      = $('#serial_'+x).val();

                      cur_serial          = cur_serial + ", " + item_serial;

                      $('#serial_'+x).val(cur_serial);

                      calculateActualAmount(x);

                      $('#new_item_serial').val('');

                  }
              }else{

                  $('#serial_message').text(data.message);

                  $("#serial_message").show();

              }

          });

      }

  }
  function func()
  {
      var z = '';
      var y = document.getElementById('change').value;
      z = $('#item_sub_category_id').val();

      $.get("{{route('item_category_check',['y'=>''])}}/"+ y, function(data){

          var list = '';
          var list3 = '';
          $.each(data, function(i, data)
          {
              list += '<option value = "' +  data.id + '">' + data.item_sub_category_name +'</option>';

          });

          list3 += '<option value = "">' + 'Select Sub Category' +'</option>';
          $("#item_sub_category_id").empty();
          $("#item_sub_category_id").append(list3);
          $("#item_sub_category_id").append(list);
          $("#item_sub_category_id").val(z);
      });



    $.get("{{route('item_list',['z'=>''])}}/"+ z, function(data){

        var list2 = '';
        var list4 = '';
        $.each(data, function(i, data)
        {
            list4 += '<option value = "' +  data.id + '">' + data.item_name +'</option>';
            ajax_data[data.id] = data;
        });

        list2 += '<option value = "">' + 'Select Product/Service  ' +'</option>';
        $("#item_id_0").empty();
        $("#item_id_0").append(list2);
        $("#item_id_0").append(list4);
    });
  }
    </script>
    <script>
        var max_fields         = 50;                           //maximum input boxes allowed
        var wrapper            = $(".input_fields_wrap");      //Fields wrapper
        var add_button         = $(".add_field_button");       //Add button ID
        var index_no         = 1;

        //For apending another rows start
        var x = 0;
        $(add_button).click(function(e)
        {
            e.preventDefault();

            var x = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);

            if(x < max_fields)
            {
                x++;

                var serial = x + 1;

                var y = $("#item_sub_category_id").val();
                $.get("{{route('item_list',['y'=>''])}}/"+ y, function(data){

                    var list5 = '';
                    var list7 = '';

                    $.each(data, function(i, data)
                    {
                        list5 += '<option value = "' +  data.id + '">' + data.item_name +'</option>';

                    });

                    list7 += '<option value = "">' + 'Select Product/Service  ' +'</option>';

                    $("#item_id_"+x).empty();
                    $("#item_id_"+x).append(list7);
                    $("#item_id_"+x).append(list5);
                });


                $('.getMultipleRow').append( ' ' +'<tr class="tr_'+x+'">'+
                    '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+
                    '<td style="width: 200px">\n'+'<div class="md-input-wrapper md-input-filled md-input-wrapper-success">\n'+'<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="itemChanged(this,``);getItemPrice('+x+')" required>\n'+ '</select>\n'+
                        '<a data-toggle="uk-modal" onclick="addVariationBtnClicked(this)" data-uk-modal="{target:`#chooseVariationWithAttributeValues`}" id="choose_variation_modal_'+x+'" type="submit" class="sm-btn sm-btn-primary variation-button">\n'+
                        '<span class="uk-badge uk-align-center uk-margin-small-top">Add Variation</span>\n</a>\n'+'<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value="">'+'</div>'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_'+x+'" class="md-input quantity" name="quantity[]" value="1" oninput="calculateActualAmount('+x+')"/ >\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="discount_type_'+x+'" name="tax_id[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="2">%</option>\n'+'</select>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($account as $account_all) <option {{$account_all->id==16 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
                    '<td style="text-align: center">\n'+'<a href="#" class="remove_field">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                    '</tr>\n');
                $('.single_select2').select2();
            }
            if(serial>1)
            {
              $('.add_table').css('display','inline');
            }
        });
        //For apending another rows end

        $(wrapper).on("click",".remove_field", function(e)
        {
            e.preventDefault();
            $(this).parent().parent().remove(); x--;

            calculateActualAmount();
        });

        function getItemPrice(x)
        {
            //For getting item commission information from items table start
            var item_id  = $("#item_id_"+x).val();
            if(item_id)
            {
                $.get('/invoice/check/item/rate/'+ item_id, function(data){

                    $("#rate_"+x).val(data.item_sales_rate);
                    $("#amount_"+x).val(data.item_sales_rate);

                    calculateActualAmount(x);

                });
            }
            //For getting item commission information from items table end
        }

        function calculateActualAmount(x)
        {
            var rate                    = $("#rate_"+x).val();
            var quantity                = $("#quantity_"+x).val();
            var discount                = $("#discount_"+x).val();
            var discountType            = $("#discount_type_"+x).val();

            var subTotal                = $("#subTotal").val();
            var adjustment              = $("#adjustment").val();
            var vat                     = $("#vat").val();
            var shippingCharge          = $("#shippingCharge").val();

            if (rate == '')
            {
                var rateCal             = 0.00;
            }else{
                var rateCal             = $("#rate_"+x).val();
            }

            if (quantity == '')
            {
                var quantityCal         = 1;
            }else{
                var quantityCal         = $("#quantity_"+x).val();
            }

            if (discount == '')
            {
                var discountCal         = 0;
            }else{
                var discountCal         = $("#discount_"+x).val();
            }

            if (discountType == 2)
            {
                var discountTypeCal     = (parseFloat(discountCal)*parseFloat(rateCal)*parseFloat(quantityCal))/100;
            }else{
                var discountTypeCal     = $("#discount_"+x).val()=='' ? 0 : $("#discount_"+x).val() ;
            }


            var amount = (parseFloat(rateCal)*parseFloat(quantityCal)) - (parseFloat(discountTypeCal));

            $("#amount_"+x).val(amount);

            var subTotal       = 0;

            $('.amount').each(function()
            {
                subTotal     += parseFloat($(this).val());
            });
            //Calculating Subtotal Amount end
            $("#subTotalShow").html(subTotal);
            $("#subTotal").val(subTotal);

            if (adjustment == '0.00' || adjustment == '' )
            {
                var adjustment_value    = 0;
                 var adjustment_show = 0;
            }else{
                var adjustment_value    = adjustment;
                 var adjustment_show = parseFloat(subTotal) + parseFloat(adjustment_value);
            }

          if(vat =='' || vat ==0.00)
          {
            var vat_val = 0;
            var  vat_show = 0;
            var vat_cal = 0;
          }
          else {
              var vat_val =  vat;
              var vat_cal =  ((parseFloat(subTotal) + parseFloat(adjustment_value)) * parseFloat(vat_val))/100;
              var vat_show= parseFloat(vat_cal) + parseFloat(subTotal);
          }
          if(shippingCharge =='' || shippingCharge ==0.00)
          {
              var shippingCharge_val = 0;
              var shippingCharge_show = 0;
          }
          else {
            var shippingCharge_val =  shippingCharge;
            var shippingCharge_show = parseFloat(adjustment_value) + parseFloat(shippingCharge_val)+parseFloat(vat_cal)+parseFloat(subTotal);
          }

            var total_amount     = parseFloat(adjustment_value) + parseFloat(shippingCharge_val)+parseFloat(vat_cal)+parseFloat(subTotal);;
            $("#adjustmentShow").html(adjustment_value);
            $("#vatShow").html(vat_cal);
            $("#vat_total").val(vat_cal);
            $("#shippingChargeShow").html(shippingCharge_val);
            $("#totalAmountShow").html(total_amount);
            $("#totalAmount").val(total_amount);
            total_val =  total_amount ;
            if(total_val > 0)
            {
                $("#due_date_amount").show(2000);

                var total_payable    = $('#totalAmount').val();

                $("#due_ammount_0").val(total_payable);
            }
            else
            {
                 $("#due_date_amount").hide(2000);
            }

        }
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
