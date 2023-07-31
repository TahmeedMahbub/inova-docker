@extends('layouts.main')

@section('title', 'Recurring Invoice')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
 <style media="screen">
     span.select2-container{
    z-index: 30 !important;
    }

    input{
      margin-top:10px;
    }
    .getMultipleRow input,discount_type{
      margin-top:-10px;
    }
    .discount_type{
      margin-top:-10px;
    }
 </style>
@endsection

@section('content')

    <div class="uk-grid">

        <div class="uk-width-large-10-10">
            @if(app('request')->input('amount'))
            <h3>Last Invoice Amount: {{app('request')->input('amount')}} BDT</h3>
            @endif

            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        {!! Form::open(['url' => route('recurring_invoices_update',['id' => $recurring_invoice->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                        <input type="hidden" ng-init="invoice_id='asdfg'" value="{{$recurring_invoice->id}}" name="invoice_id" ng-model="invoice_id">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit  Recurring Invoice</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                      <div class="uk-width-medium-1-4">
                                        <label  for="invoice_number">Recurring Invoice Number</label>
                                          <input type="text" class="md-input" id="invoice_number" name="invoice_number" value="{{ str_pad($recurring_invoice->recurring_invoice_number, 6, '0', STR_PAD_LEFT) }}" disabled />
                                      </div>
                                     <div class="uk-width-medium-1-4">
                                       <label  for="customer_name"> Name</label> <br>
                                        <select class="md-input select2-single-search-dropdown" title="Select Customer" id="customer_id" name="customer_id">
                                            <option value="">Select Name</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $customer->id == $recurring_invoice->customer_id ? 'selected' : '' }}>{{ $customer->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div  clpass="uk-width-medium-1-4" style="width:25%">
                                        <label for="invoice_date">Select Invoice date</label>
                                        <input class="md-input" type="text" id="invoice_date" name="invoice_date" value="{{ date("d-m-Y",strtotime($recurring_invoice->invoice_date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label for="invoice_date">Reference</label>
                                        <input class="md-input" type="text" id="reference" name="reference" value="{{ $recurring_invoice->reference }}">
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-6">
                                          <label for="">Start Date</label>
                                            <input class="md-input" type="text" id="start_on" name="start_date" value="{{$recurring_invoice->start_date}}" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                        </div>
                                        <div class="uk-width-medium-2-6">
                                          <label class="label-fixed"for=""> Days Interval</label>
                                            <input class="md-input" type="text" id="day_interval" name="day_interval" value="{{$recurring_invoice->day_interval}}">
                                        </div>
                                        <div class="uk-width-medium-2-6">
                                             <label class="label-fixed"for=""> Instance</label>
                                            <input class="md-input"type="text" id="instance" name="no_of_installment" value="{{$recurring_invoice->day_interval}}">
                                        </div>
                                    </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                       <label for="customer_note">Category <span style="color: red;" class="asterisc">*</span></label><br>
                                        <select class="md-input select2-single-search-dropdown" id="change" onchange="func()" name="item_category_id" disabled>
                                                <option value=""> Select Category</option>
                                            @foreach($item_category as $value)
                                                <option {{ $value->id == $recurring_invoice->item_category_id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->item_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                    <label for="customer_note">Sub Category <span style="color: red;" class="asterisc">*</span></label><br>
                                        <select class="md-input select2-single-search-dropdown" id="item_sub_category_id" name="item_sub_category_id" disabled>
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="invoice_date">Add New Item By Serial</label>
                                        <input class="md-input" type="text" id="new_item_serial" onfocusout="newserial()" name="new_item_serial">
                                          <p id = "serial_message" style = "color: red; font-weight: bold; display: none;"></p>
                                    </div>
                                </div>
                                  <a href="{{ route('inventory_create') }}" target="_blank" class="md-btn md-btn-default"style="margin:20px 0px  -30px 0px" >Create New Item</a>
                                <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="input_fields_wrap uk-table">
                                            <thead>
                                              <tr>
                                                  <th class="uk-text-nowrap">#</th>
                                                  <th class="uk-text-nowrap"width="20%">Product/Service <span style="color: red;" class="asterisc">*</span></th>
                                                  <th class="uk-text-nowrap">Description</th>
                                                  <th class="uk-text-nowrap">Quantity<span style="color: red;" class="asterisc">*</span></th>
                                                  <th class="uk-text-nowrap">Rate<span style="color: red;" class="asterisc">*</span></th>
                                                  <th class="uk-text-nowrap">Discount</th>
                                                  <th class="uk-text-nowrap"></th>
                                                  <th class="uk-text-nowrap">Amount</th>
                                                  <th class="uk-text-nowrap" width="20%">Account</th>
                                                  <th class="uk-text-nowrap">Action</th>
                                              </tr>
                                            </thead>
                                                
                                            <tbody class="getMultipleRow">
                                                @foreach($recurring_invoice_entry as $key => $recurring_invoice_entry_value)
                                                    <tr class="tr_{{$key}}" id="data_clone"  >
                                                        <td>
                                                            <p style="padding-top: 10px">{{ $key + 1 }}</p>
                                                        </td>

                                                        <td style="width: 200px">
                                                            <select id="item_id_{{$key}}" class="md-input itemId select2-single-search-dropdown" name="item_id[]" onchange="getItemPrice(<?php echo $key; ?>)" required>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <input type="text" id="description_{{$key}}" class="md-input description" name="description[]" value="{{ $recurring_invoice_entry_value->description }}"  oninput="calculateActualAmount(<?php echo $key; ?>)" >
                                                        </td>

                                                        <td>
                                                            <input  type="text" id="quantity_{{$key}}" name="quantity[]" class="md-input quantity" value="{{ $recurring_invoice_entry_value->quantity }}" oninput="calculateActualAmount(<?php echo $key; ?>)" />
                                                        </td>

                                                        <td>
                                                            <input type="text" id="rate_{{$key}}" name="rate[]" class="md-input rate" value="{{ $recurring_invoice_entry_value->rate }}" oninput="calculateActualAmount(<?php echo $key; ?>)" required/>
                                                        </td>

                                                        <td>
                                                            <input id="discount_{{$key}}" type="text" class="md-input discount" name="discount[]" value="{{ $recurring_invoice_entry_value->discount }}" oninput="calculateActualAmount(<?php echo $key; ?>)">
                                                        </td>

                                                        <td style="width: 80px">
                                                            <select class="md-input discount_type" id="discount_type_{{$key}}" name="discount_type[]" onchange="calculateActualAmount(<?php echo $key; ?>)">
                                                                <option {{ $recurring_invoice_entry_value->discount_type == 1 ? 'selected' : '' }} value="1" selected>BDT</option>
                                                                <option {{ $recurring_invoice_entry_value->discount_type == 0 ? 'selected' : '' }} value="0">%</option>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <input type="text" id="amount_{{$key}}" name="amount[]" class="md-input amount" value="{{ $recurring_invoice_entry_value->amount }}" oninput="calculateActualAmount(<?php echo $key; ?>)" readonly="readonly" />
                                                        </td>

                                                        <td>
                                                            <select id="account_id_{{$key}}" class="md-input accountId select2-single-search-dropdown" name="account_id[]" required>
                                                                @if(!empty($account) && (count($account) > 0))
                                                                    @foreach($account as $account_value)
                                                                        <option {{ $recurring_invoice_entry_value->account_id == $account_value->id ? 'selected' : '' }} value="{{ $account_value->id }}">{{ $account_value->account_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>

                                                        <td style="text-align: center">
                                                            @if($key == 0)
                                                                <a href="#" class="add_field_button">
                                                                    <i style="padding-top: 10px" class="material-icons md-36">&#xE146;</i>
                                                                </a>
                                                            @else
                                                                <a href="#" class="remove_field">
                                                                    <i style="padding-top: 10px" class="material-icons md-36">delete</i>
                                                                </a>
                                                            @endif
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table style="display: none;float:right;margin-top:-20px !important " class="add_table">
                                          <tr>

                                              <td style="text-align: center"  >
                                                  <a href="#" class="add_field_button">
                                                      <i style="padding-top: 10px" class="material-icons md-36">&#xE146;</i>
                                                  </a>
                                              </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3 uk-margin-medium-top">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                @if($recurring_invoice->file_name)
                                                    <a href="{{ url('invoice/invoice-download'.'/'.$recurring_invoice->file_name) }}"><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
                                                @endif
                                                <label for="user_edit_uname_control">Attach Files: </label>
                                            </div>
                                            <div class="uk-width-medium-1-1">

                                                <div class="uk-form-file uk-text-primary"
                                                     style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">

                                                    <p style="margin: 4px;">Upload File  </p>

                                                    <input onchange="uploadLavel()" id="form-file" type="file" name="file">


                                                </div>
                                                <p id="upload_name"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-2-3">
                                      <table class="uk-table">
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
                                                    <input type="text" id="adjustment" name="adjustment" class="md-input md-input-width-medium" value="{{$recurring_invoice->adjustment}}" oninput="calculateActualAmount(0)"/>
                                                </td>
                                                <td style="text-align: right">
                                                    <a style="border: none;text-decoration: none;color: black" id="adjustmentShow">0.00</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-color: white" colspan="3"></td>
                                                <td> Vat/Tax (%)</td>
                                                <td colspan="4">
                                                    <input type="text" id="vat" class="md-input md-input-width-medium" value="{{ $tax }}" oninput="calculateActualAmount(0)" />
                                                </td>
                                                <td style="text-align: right">
                                                    <a style="border: none;text-decoration: none;color: black" id="vatShow">0.00</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="border-color: white" colspan="3"></td>
                                                <td>Shipping Charges</td>
                                                <td colspan="4">
                                                    <input type="text" id="shippingCharge" name="shipping_charge" class="md-input md-input-width-medium"  value="{{ $recurring_invoice->shipping_charge }}" oninput="calculateActualAmount(0)"/>
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

                                      <input type="hidden" id="item_category_id" name="item_category_id"  value="{{ $recurring_invoice->item_category_id }}">
                                        <input type="hidden" id="item_sub_category_id" name="item_sub_category_id" value="{{ $recurring_invoice->item_sub_category_id }}">

                                    </div>
                                </div>

                                <hr>
                                 <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-6">
                                          <label for=""> Agents</label><br>
                                            <select  title="Select Agent"  class="select2-single-search-dropdown" id="agent_id" name="agent_id">
                                                <option value="">Select Agent </option>
                                                @foreach($agents as $agent)
                                                    <option value="{{ $agent->id }}" {{ $recurring_invoice->agents_id == $agent->id ? 'selected': ''}}>{{ $agent->display_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="uk-width-medium-2-6">
                                          <label for=""> Commision Amount</label>
                                             <input class="md-input label-fixed" type="text"  id="commission" name="commission"  value="" oninput="commissionAmount()" />
                                        </div>
                                        <div class="uk-width-medium-1-6">
                                          <label for=""> Commision Type</label><br>
                                            <select  title="Select Commision"   class="select2-single-search-dropdown" id="commission_type" name="commission_type" onchange="commissionAmount()" />
                                                <option value="1" {{ $recurring_invoice->commission_type == 1 ? 'selected': ''}}>BDT </option>
                                                <option value="2" {{ $recurring_invoice->commission_type == 2 ? 'selected': ''}}>% </option>
                                            </select>
                                        </div>
                                        <div class="uk-width-medium-1-6">
                                            <label style="" class="" for="due_date">Total Commission</label>
                                            <input class="md-input label-fixed" type="text" id="agentcommissionAmount" name="agentcommissionAmount" value="{{ $recurring_invoice->agentcommissionAmount }}">
                                        </div>
                                    </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-2-4">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note">Personal note</label>
                                                <textarea class="md-input" id="customer_note" name="personal_note">{{ $recurring_invoice->personal_note}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-width-medium-2-4">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note">Customer note</label>
                                                <textarea class="md-input" id="customer_note" name="customer_note"> {{ $recurring_invoice->customer_note }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    </tbody>
                                  </div>
                                </div>
                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        @if($recurring_invoice->save==1)
                                        <input type="submit" class="md-btn md-btn-success" value="save" name="submit" />
                                        @else
                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="submit" name="submit" />
                                        @endif
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    </div>
                                </div>

                         {!! Form::close() !!}

                                <hr>       <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script>
        altair_forms.parsley_validation_config();
    </script>
    <script type="text/javascript">
        function func(x)
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

                list3 += '<option value = "">' + 'Select Batch' +'</option>';
                $("#item_sub_category_id").empty();
                $("#item_sub_category_id").append(list3);
                $("#item_sub_category_id").append(list);
                $("#item_sub_category_id").val('{{ $recurring_invoice->item_sub_category_id }}');
            });
          $.get("{{route('item_list',['z'=>''])}}/"+ z, function(data){
            console.log(data);
              var list2 = '';
              var list4 = '';
              $.each(data, function(i, data)
              {
                  list4 += '<option value = "' +  data.id + '">' + data.item_name +'</option>';

              });

              list2 += '<option value = "">' + 'Select Product/Service  ' +'</option>';
              $("#item_id_0").empty();
              $("#item_id_0").append(list2);
              $("#item_id_0").append(list4);
          });
        }
    </script>
    <script type="text/javascript">
     $('#document').ready(function(){
      var z =<?php echo $recurring_invoice->item_sub_category_id; ?>;

          var y = document.getElementById('change').value;

       console.log(z);
        $.get("{{route('item_category_check',['y'=>''])}}/"+ y, function(data){
            var list = '';
            var list3 = '';
            $.each(data, function(i, data)
            {
                list += '<option value = "' +  data.id + '">' + data.item_sub_category_name +'</option>';

            });

            list3 += '<option value = "">' + 'Select Batch' +'</option>';
            $("#item_sub_category_id").empty();
            $("#item_sub_category_id").append(list3);
            $("#item_sub_category_id").append(list);
            $("#item_sub_category_id").val(z);
        });



        var recurring_invoice_entry = <?php echo $recurring_invoice_entry; ?>;

        var list2             = '';
        var list4             = '';
        var selected_tmp      = 0;

        var total_val         = 0;
        var total_inv_amount  = 0;

        $.each(recurring_invoice_entry, function(i, data_val)
        {
            //Initially show the items for all apended index start
            $.get("{{route('item_list',['z'=>''])}}/"+ z, function(data){

                var list2 = '';
                var list4 = '';

                $.each(data, function(j, data)
                {
                    var item_id_check = data.id;

                    if(item_id_check == data_val.item_id)
                    {
                        selected_tmp = 1;
                    }
                    else
                    {
                        selected_tmp = 0;
                    }

                    if(selected_tmp == 1)
                    {
                        list2 += '<option value = "' +  data.id + '" selected>' + data.item_name +'</option>';
                    }
                    else
                    {
                        list2 += '<option value = "' +  data.id + '">' + data.item_name +'</option>';
                    }

                    $("#item_id_"+i).empty();
                    $("#item_id_"+i).append(list4);
                    $("#item_id_"+i).append(list2);
                });

                selected_tmp = 0;

            });
            //Initially show the items for all apended index start

        });
    });
    </script>
    <script>
        var max_fields     = 50;                           //maximum input boxes allowed
        var wrapper        = $(".input_fields_wrap");      //Fields wrapper
        var add_button     = $(".add_field_button");       //Add button ID

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
                    '<td style="width: 200px">\n'+'<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="getItemPrice('+x+')">\n'+ '</select>\n'+'<div class="row">'+'<label style="padding-top: 10px;padding-right: 0px;" class="col-md-6">'+''+'</label>'+'<input  style="padding-top: 10px;border: none;padding-left: 0px;font-weight: white;color:white" class="col-md-6" type="text" id="stock_'+x+'" class="" name="stock[]" />'+'</div>'+
                    '</td>\n'+
                    '<td>\n'+'<input type="text" id="description_'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_'+x+'" class="md-input quantity" name="quantity[]" value="1" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
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
$(document).ready(function(){

    var x = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);
     x++;
    console.log(x);
  if(x>1)
  {
    $('.add_table').css('display','inline');
  }
});
        function getItemPrice(x)
        {

            var item_id  = $("#item_id_"+x).val();
            if(item_id)
            {
                $.get('/invoice/check/item/rate/'+ item_id, function(data){

                    $("#rate_"+x).val(data.item_sales_rate);
                    $("#amount_"+x).val(data.item_sales_rate);

                    calculateActualAmount(x);

                });
            }

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

            if (discountType == 0)
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
          var vat_cal =  ((parseFloat(subTotal) + parseFloat(adjustment_value))  * parseFloat(vat_val))/100;
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
            if(total_val > 0)
            {
              if($('#no_of_installment').val() == 0 || $('#time_interval').val()== 0 )
               {
                $("#due_date_amount").show(1500);
                var total_payable    = $('#totalAmount').val();
              }
            }
            else
            {
              if($('#no_of_installment').val() >0 && $('#time_interval').val()>0 )
                {
                  $("#due_date_amount").hide(1500);
                }
            }
    commissionAmount();
   installment();
        }

    </script>
    <script type="text/javascript">
    setTimeout( calculateActualAmount(),3);
    </script>
    <script>

    var total_val =   $("#totalAmount").val();
    var index_no  =   "<?php echo isset($i) ? $i :0;?>";
     $('.field_button').on('click',function(e){
       e.preventDefault();

    //  var index_no = parseInt($('.add_row tr:last').attr('class').match(/(\d+)/g)[0]);

        index_no++;

         $('.add_row').append(
           '<tr class="app_tr_"'+index_no+'>'+
              '<td>'+
                  `<input class="md-input" type="text" id="due_date_"`+ index_no +` name="due_date[]" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" >` +
               '</td>' +
              '<td>'+
                  '<input class="md-input amount_value" id="due_ammount_'+index_no+'" name="amount_val[]" onchange="valcheck('+ index_no +')" type="text">'+
              '</td>'+
              '<td>'+
                  '<a  class="remove_date_amount">\n'+'<i style="padding-top: 5px"  class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
              '</td>'
           +'</tr>'
         )
         var nn = parseFloat(index_no) - 2;
         $('#due_ammount_'+nn).attr('readonly', 'readonly');
     });

     $('#add_row').on('click', '.remove_date_amount',function(){
      $(this).parent().parent().remove();
      valcheck();
     });

     function valcheck(z)
     {
         var check_due_amount = $('#due_ammount_'+z).val();
         var total_payable    = $('#totalAmount').val();

         var total_amount_val = 0;
         $('.amount_value').each(function(index ,value)
         {
             total_amount_val += parseFloat($(this).val());
         });

         var balance_due       = parseFloat(total_payable) - parseFloat(total_amount_val);

         if(isNaN(parseFloat(balance_due)))
         {
             var balance_due      =  0;
         }

         if(total_amount_val <= total_payable)
         {
             $('#due_ammount_'+z).val(check_due_amount);
         }
         else
         {
             if(balance_due < 0)
             {
                 var bl  = parseFloat(check_due_amount) +  parseFloat(balance_due);

                 $('#due_ammount_'+z).val(bl);
             }
             else
             {
                 $('#due_ammount_'+z).val(balance_due);
             }
         }
     }
    </script>
    <script type="text/javascript">
    function commissionAmount()
    {
      var commission_amount = $('#commission').val();
      var commission_type   = $('#commission_type').val();

      var sub_total   = $('#subTotal').val();
      var adjustment   = $('#adjustment').val();
      if(adjustment ==0|| adjustment=='')
      {
        adjustment = 0;
      }
      sub_total = parseFloat(adjustment) + parseFloat(sub_total);
      if(commission_type == 1){
        var com = commission_amount;
      }
      else{
          if(commission_amount >= 100)
             var com = sub_total;
          else
            var com = (parseFloat(sub_total) * parseFloat(commission_amount))/100;
      }

      if(isNaN(com)){
          $('#agentcommissionAmount').val(0);
          }
          else
          {
           $('#agentcommissionAmount').val(Number(com).toFixed(1));
           
          }
    }
    $(document).ready(function(){
        var commission_type   = $('#commission_type').val();
        var commission  = "<?php echo $recurring_invoice->commission_type ;?>";
        var total_commission_amount  = "{{$recurring_invoice->agentcommissionAmount}}";
          var sub_total   = $('#subTotal').val();
        if(commission == 2)
        {
          var total = parseFloat(total_commission_amount)*100;
          var total = parseFloat(total) / parseFloat(sub_total);
          $('#commission').val(Number(total).toFixed(1));
            $("#commission").trigger('click');
        }
        else
        {
          $('#commission').val(total_commission_amount);
          $("#commission").trigger('click');
        }
    });
    </script>
    <script>

       function uploadLavel(){
           var fullPath = document.getElementById('form-file').value;
           var upload_file_name_ = document.getElementById('upload_name');
           if (fullPath) {
               var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
               var filename = fullPath.substring(startIndex);
               if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                   filename = filename.substring(1);
               }

               upload_file_name_.innerHTML  = filename;

           }
       }
        $('#sidebar_main_account').addClass('current_section');
        $('#recurring_invoices_index').addClass('act_item');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
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

                          if(x == 0 && item_0_val == ""){

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
                                  '<td style="width: 200px">\n'+'<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="getItemPrice('+x+')">\n'+ '</select>\n'+'<div class="row">'+'<label style="padding-top: 10px;padding-right: 0px;" class="col-md-6">'+''+'</label>'+'<input  style="padding-top: 10px;border: none;padding-left: 0px;font-weight: white;color:white" class="col-md-6" type="text" id="stock_'+x+'" class="" name="stock[]"/>'+'</div>'+
                                  '</td>\n'+
                                  '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                  '<td>\n'+'<input type="text" id="quantity_'+x+'" class="md-input quantity" name="quantity[]" value="1" oninput="calculateActualAmount('+x+')"/ >\n'+'</td>\n'+
                                  '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                  '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                  '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
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
    </script>
<script type="text/javascript">
    var date_formate  = function (date_find)
    {
        var today_date       = new Date(date_find);
        var year_find        = today_date.getFullYear().toString();
        var month_find       = (today_date.getMonth() + 1).toString();
        var date_find        = today_date.getDate().toString();
        var next_date_form   = (date_find[1] ? date_find:"0" + date_find[0]) + "-" + (month_find[1] ? month_find:"0" + month_find[0]) + "-" + year_find;

        return next_date_form;
    }

  function installment()
  {
    $('#install_due_date').empty();
    var time_int             = 0;
    var no_of_installment    = $('#no_of_installment').val();
    var time_interval        = $('#time_interval').val();
    var start_date           = $('#start_date').val().split("-");
    var new_date             = new Date(start_date[2], start_date[1] - 1, start_date[0]);
    var mili_date            = new_date.getTime();
    var amount               = $("#totalAmount").val()/no_of_installment;
    if($('#no_of_installment').val() >0 && $('#time_interval').val()>0 )
    {
      for(var i = 0; i< no_of_installment;i++)
      {
        if(i == 0)
        {
        var start_date = date_formate(mili_date);

        }
        else
        {
            time_int           = time_int+(86400000*(time_interval));
            var start_date     = date_formate(mili_date+time_int);
        }
         $('#install_due_date').append
         (
           '<tr>'+
             '<td>'+
                `<input class="md-input" type="text" id="due_date" name="due_date[]" value="`+start_date+`" data-uk-datepicker="{format:'DD-MM-YYYY'}" >`+
             '</td>' +
             '<td>'+
               '<input class="md-input amount_value" type="text" id="due_ammount_0" onchange="valcheck(0)" value="'+Number(amount).toFixed(2)+'" name="amount_val[]" />'+
             '</td>'
           +'</tr>'
         );

      }
       $('#installment').show(1000);
       $("#due_date_amount").hide();

    }
  else  {
      $('#installment').hide(1000);
      $("#due_date_amount").show(100);
    }
  }

</script>

<script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
<script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>


@endsection
