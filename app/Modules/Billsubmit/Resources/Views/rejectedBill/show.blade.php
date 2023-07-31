@extends('layouts.main')

@section('title', 'Pending Bill')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
    
        @media only screen and (max-width: 600px) {
  .cls {
    margin-top: 10px;
  }
}
    </style>
@endsection
@section('angular')
    <script src="{{url('app/moneyout/bill/billSubmitEdit.controller.js')}}"></script>
@endsection


@section('content')
    <div class="uk-grid" ng-controller="BillSubmitEditController">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('rejected_bill_update',['id' => $bill->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
            <div class="uk-margin-top">
                <div class="uk-grid">
                    <div class="uk-width-medium-5-5">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div style="margin-top:-25px" class="uk-width-medium-1-3">
                              <label class="uk-vertical-align-middle" for="customer_name"> Name <span class="uk-badge"><a data-toggle="uk-modal" data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit" class="sm-btn sm-btn-primary" onclick="openContactModal(this)"><span style="color:white">Create Contact</span></a></span></label> <br>
                                <select  title="Select Customer" id="customer_id" name="customer_id" class="md-input select2-single-search-dropdown" required>
                                    <option value="">Select Vendor Name</option>
                                    @foreach($customers as $customer)
                                        <option {{$bill->vendor_name == $customer->id ? 'selected' : ' ' }} value="{{ $customer->id }}">{{ $customer->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="uk-width-medium-1-3 input cls">
                                <label for="invoice_number">Order Number#</label>
                                <input class="md-input" type="text" id="order_number" value="{{ $bill->order_number }}" name="order_number"/>
                            </div>
                            <div class="uk-width-medium-1-3 input cls">
                                <label for="bill_date">Select Bill date</label>
                                <input class="md-input" type="text" id="bill_date" name="bill_date" value="{{ date('d-m-Y',strtotime($bill->date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                            </div>
                        </div>
                        <div class="uk-grid hidden cls" data-uk-grid-margin>
                            <div class="uk-width-medium-1-5  uk-vertical-align">
                                <label class="uk-vertical-align-middle" for="due_date">Due Date</label>
                            </div>
                            <div class="uk-width-medium-3-5 cls">
                                <label for="due_date">Select date</label>
                                <input class="md-input" type="text" id="due_date" name="due_date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <label for="customer_note">Category<span style="color: red;" class="asterisc">*</span></label> <br>
                        <select  id="change" name="item_category_id" onchange="func()" class="md-input select2-single-search-dropdown">
                                <option value=""> Select Category</option>
                            @foreach($item_category as $value)
                                <option {{ $bill->item_category_id == $value->id ? 'selected' : '' }}  value="{{ $value->id }}">{{ $value->item_category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="uk-width-medium-1-2">
                        <label for="customer_note">Sub Category<span style="color: red;" class="asterisc">*</span></label> <br>
                        <select  id="item_sub_category_id" onchange="func()" name="item_sub_category_id" class="md-input select2-single-search-dropdown" selected>
                        </select>
                    </div>
                </div>

                <br>

                <div class="uk-grid uk-margin-small-top" data-uk-grid-margin>
                  <div class="uk-width-medium-1-1"style="overflow:auto">
                      <table class="input_fields_wrap uk-table" cellspacing="0" style="overflow:auto" width="100%">
                          <thead>
                              <tr>
                                  <th class="uk-text-nowrap" style="width:10px !important"> #</th>
                                  <th class="uk-text-nowrap" width="20%"> Product/Service <span style="color: red;" class="asterisc">*</span></th>
                                  <th class="uk-text-nowrap" width="10%"> Description </th>
                                  <th class="uk-text-nowrap" width="10%"> Quantity <span style="color: red;" class="asterisc">*</span></th>
                                  <th class="uk-text-nowrap" width="10%"> Rate <span style="color: red;" class="asterisc">*</span></th>
                                  <th class="uk-text-nowrap" width="10%"> Amount </th>
                                  <th class="uk-text-nowrap" width="20%"> Account </th>
                                  <th class="uk-text-nowrap" style="text-align:center" width="10%"> Action </th>
                              </tr>
                          </thead>

                          <tbody class="getMultipleRow">
                              @foreach($bill_entry as $key => $bill_entry_value)
                                  <tr class="tr_{{$key}}" id="data_clone"  >
                                      <td>
                                          <p style="padding-top: 10px">{{ $key + 1 }}</p>
                                      </td>

                                      <td style="width: 200px">
                                          <select id="item_id_{{$key}}" class="md-input itemId select2-single-search-dropdown" name="item_id[]" onchange="getItemPrice({{$key}})" required>
                                              <option value="" selected>Select Product/Service </option>
                                              @if(!empty($items) && (count($items) > 0))
                                                  @foreach($items as $item)
                                                      <option {{ $bill_entry_value->item_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->item_name }}</option>
                                                  @endforeach
                                              @endif
                                          </select>
                                      </td>

                                      <td>
                                          <input type="text" id="description_{{$key}}" class="md-input description" name="description[]" value="{{ $bill_entry_value->description }}"  oninput="calculateActualAmount({{$key}})" >
                                      </td>

                                      <td>
                                          <input  type="text" id="quantity_{{$key}}" name="quantity[]" class="md-input quantity" value="{{ $bill_entry_value->quantity }}" oninput="calculateActualAmount({{$key}})"/>
                                      </td>

                                      <td>
                                          <input type="text" id="rate_{{$key}}" name="rate[]" class="md-input rate" value="{{ $bill_entry_value->rate }}" oninput="calculateActualAmount({{$key}})" required/>
                                      </td>


                                      <td>
                                          <input type="text" id="amount_{{$key}}" name="amount[]" class="md-input amount" value="{{ $bill_entry_value->amount }}" oninput="calculateActualAmount({{$key}})" readonly="readonly" />
                                      </td>

                                      <td>
                                          <select id="account_id_{{$key}}" class="md-input accountId select2-single-search-dropdown" name="account_id[]" required>

                                                  @foreach($accounts as $account_value)
                                                      <option {{ $bill_entry_value->account_id == $account_value->id ? 'selected' : '' }} value="{{ $account_value->id }}">{{ $account_value->account_name }}</option>
                                                  @endforeach

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
                      <table style="display:none;float:right;margin-top:-20px !important;overflow:auto" class="add_table">
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

                <br>

                <div class="uk-grid" style="margin-top: 0px;" data-uk-grid-margin>
                    <div class="uk-width-medium-1-3 uk-margin-medium-top">
                      <div class="uk-width-medium-1-1">
                          <label for="user_edit_uname_control">Attach Files: </label>
                      </div>
                      <div class="uk-width-medium-1-1">
                          <div class="uk-form-file uk-text-primary"
                               style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                              <p style="margin: 4px;">Uplaod File</p>
                              <input onchange="uploadLavel()" id="form-file" type="file" name="file1">
                          </div>
                      </div>
                      <p id="upload_name"></p>
                  </div>
                    <div class="uk-width-medium-2-3" style="overflow:auto">
                        <table class="uk-table" cellspacing="0" style="overflow:auto" width="100%">
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
                                      <input type="text" id="adjustment" name="adjustment" class="md-input md-input-width-medium" value="{{ $bill->adjustment }}" oninput="calculateActualAmount(0)"/>
                                  </td>
                                  <td style="text-align: right">
                                      <a style="border: none;text-decoration: none;color: black" id="adjustmentShow">0.00</a>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="border-color: white" colspan="3"></td>
                                  <td> Vat/Tax (%)</td>
                                  <td colspan="4">
                                    @php
                                       $tax        = $bill->tax_total;
                                       $total      = $bill->amount;
                                       $subtotal   = $total - $bill->tax_total;

                                       $vat        = ( 100* $tax )/ $subtotal;

                                    @endphp
                                      <input type="text" id="vat" class="md-input md-input-width-medium" value="{{ $vat }}"  oninput="calculateActualAmount(0)" />
                                  </td>
                                  <td style="text-align: right">
                                      <a style="border: none;text-decoration: none;color: black" id="vatShow">0.00</a>
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
                <div class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-medium-1-3">
                      <label for="invoice_date">No Of Installment</label>
                      <input class="md-input" type="text" id="no_of_installment" onfocusout="installment()" value="{{ $bill->no_of_installment }}" name="no_of_installment">
                  </div>
                  <div class="uk-width-medium-1-3">
                      <label for="invoice_date">Time Interval</label>
                      <input class="md-input" type="text" id="time_interval" onfocusout="installment()" value="{{ $bill->day_interval }}"  name="time_interval">
                  </div>
                    <div class="uk-width-medium-1-3">
                        <label for="invoice_date">Start Sate</label>
                        <input class="md-input" type="text" id="start_date" onfocusout="installment()" name="start_date"value="{{ date('d-m-Y',strtotime($bill->start_date ?$bill->start_date :Carbon\Carbon::now()->format('d-m-Y'))) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                    </div>
                </div>
              @if( $bill->day_interval > 0 && $bill->no_of_installment > 0 )
                <div style="" id="installment" class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-1-1" >
                      <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2 ">
                        Installment Amount And Date
                      </div>
                  </div>
                   <div class="uk-width-medium-4-4"style="overflow:auto">
                    <table class="input_fields_wrap uk-table" cellspacing="0" style="overflow:auto" width="100%">
                      <tbody  id="install_due_date" class="add_row">
                      <tr>
                        <td> <b>Due Date</b></td>
                        <td><b>Due Amount</b></td>
                      </tr>

                        @foreach($due_bill_sub as $key=>$value)
                          <tr>
                            <td>
                               <input class="md-input" type="text" id="due_date" name="due_date[]" value="{{ $value->due_date }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" >
                            </td>
                            <td>
                              <input class="md-input amount_value" type="text" id="due_ammount_{{$key}}" value="{{$value->amount}}" onchange="valcheck({{$key}})" id="due_date" name="amount_val[]"  >
                            </td>
                          </tr>
                        @endforeach

                    </tbody>
                    </table>
                  </div>
                </div>
                <div style="display:none" id="due_date_amount" class="uk-grid hiddden" data-uk-grid-margin>
                  <div class="uk-width-1-1" >
                      <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2; ">
                        Multiple Due Date Add
                      </div>
                  </div>
                   <div class="uk-width-medium-4-4" style="overflow:auto">
                    <table class="input_fields_wrap uk-table" cellspacing="0" style="overflow:auto" width="100%">
                      <tbody  id="add_row" class="add_row">
                      <tr>
                        <td> <b>Due Date</b></td>
                        <td><b>Due Amount</b></td>
                        <td><b>Action</b></td>
                      </tr>
                         <tr>
                        <td>
                           <input class="md-input" type="text" id="due_date" name="due_date[]" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" >
                        </td>
                        <td>
                          <input class="md-input amount_value" type="text" id="due_ammount_0" value="" onchange="valcheck(0)" id="due_date" name="amount_val[]"  >
                        </td>
                        <td style="text-align: center">

                            <a  class="field_button">
                                <i style="padding-top: 10px" class="material-icons md-36">&#xE146;</i>
                            </a>

                        </td>
                      </tr>
                    </tbody>
                    </table>
                    <!-- <table>
                      <tr>
                        <td class="">Total</td>
                        <td id="total_due_ammount"> </td>
                      </tr>
                    </table> -->
                  </div>
                </div>
              @endif
              @if( $bill->day_interval == 0 || $bill->no_of_installment == 0 )
              <div style="display:none;" id="installment" class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-1" >
                    <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2 ">
                      Installment Amount And Date
                    </div>
                </div>
                 <div class="uk-width-medium-4-4" style="overflow:auto">
                  <table class="input_fields_wrap uk-table" cellspacing="0" style="overflow:auto" width="100%">
                    <tbody  id="install_due_date" class="add_row">
                    <tr>
                      <td> <b>Due Date</b></td>
                      <td><b>Due Amount</b></td>
                    </tr>
                  </tbody>
                  </table>
                </div>
              </div
                <div style="" id="due_date_amount" class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-1-1" >
                      <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2; ">
                        Multiple Due Date Add
                      </div>
                  </div>
                   <div class="uk-width-medium-4-4" style="overflow:auto">
                    <table class="input_fields_wrap uk-table" cellspacing="0" style="overflow:auto" width="100%">
                      <tbody  id="add_row" class="add_row">
                      <tr>
                        <td> <b>Due Date</b></td>
                        <td><b>Due Amount</b></td>
                        <td><b>Action</b></td>
                      </tr>
                      @if(count($due_bill_sub) == 0)
                         <tr>
                        <td>
                           <input class="md-input" type="text" id="due_date" name="due_date[]" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" >
                        </td>
                        <td>
                          <input class="md-input amount_value" type="text" id="due_ammount_0" value="" onchange="valcheck(0)" id="due_date" name="amount_val[]"  >
                        </td>
                        <td style="text-align: center">

                            <a  class="field_button">
                                <i style="padding-top: 10px" class="material-icons md-36">&#xE146;</i>
                            </a>

                        </td>
                      </tr>
                      @endif
                     @php
                      $i = 0;
                     @endphp
                      @foreach($due_bill_sub as $key=>$value)

                      <tr>
                        <td>
                           <input class="md-input" type="text" id="due_date" name="due_date[]" value="{{ $value->due_date }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" >
                        </td>
                        <td>
                          <input class="md-input amount_value" type="text" id="due_ammount_{{$key}}" value="{{$value->amount}}" onchange="valcheck({{$key}})" id="due_date" name="amount_val[]"  >
                        </td>
                        <td style="text-align: center">
                        @if($key==0)
                            <a  class="field_button">
                                <i style="padding-top: 10px" class="material-icons md-36">&#xE146;</i>
                            </a>
                        @else
                            <a  class="remove_date_amount"><i style="padding-top: 5px"  class="material-icons md-36">delete</i></a>
                        @endif
                        </td>
                      </tr>
                      @php
                       $i++;
                      @endphp
                      @endforeach
                    </tbody>
                    </table>
                    <!-- <table>
                      <tr>
                        <td class="">Total</td>
                        <td id="total_due_ammount"> </td>
                      </tr>
                    </table> -->
                  </div>
                </div>
                @endif

                <div class="uk-grid" data-uk-grid-margin>
                      <div class="uk-width-medium-1-1">
                          <div class="uk-grid" data-uk-grid-margin>
                              <div class="uk-width-medium-1-1">
                                  <label for="customer_note">Customer note</label>
                                  <textarea class="md-input" id="customer_note" name="customer_note"></textarea>
                              </div>
                          </div>
                      </div>
                </div>
            </div>

            <p>
                @if($errors->has('payment_account')|| $errors->has('payment_amount'))
                    <span style="color:red; position: relative; right:0px; margin: 5px 0px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">{!! "Payment field required" !!}</span>

                @endif
            </p>

            <br>

            <div class="uk-grid uk-ma" data-uk-grid-margin>
               <div class="uk-width-1-1 uk-float-left">
                   <button type="submit" class="md-btn md-btn-primary" name="approve">Approve Bill</button>
                   <button type="submit" class="md-btn md-btn-primary" name="reject" value="1">Send To Pending</button>
                   <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
               </div>
            </div>

        </div>
            {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        $('#document').ready(function(){
            var z =<?php echo $bill->item_sub_category_id; ?>;

            var y = document.getElementById('change').value;

            console.log(z);

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

            var bill_entry = <?php echo $bill_entry; ?>;

            var list2        = '';
            var list4        = '';
            var selected_tmp = 0;

            $.each(bill_entry, function(i, data_val)
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

    <script type="text/javascript">

         window.onload = function () {
             selector_sector = $('#selec_adv_100').selectize({
                 plugins: {
                     'remove_button': {
                         label: ''
                     }
                 },

                 onDropdownOpen: function($dropdown) {
                     $dropdown
                             .hide()
                             .velocity('slideDown', {
                                 begin: function() {
                                     $dropdown.css({'margin-top':'0'})
                                 },
                                 duration: 200,
                                 easing: easing_swiftOut
                             })
                 },
                 onDropdownClose: function($dropdown) {
                     $dropdown
                             .show()
                             .velocity('slideUp', {
                                 complete: function() {
                                     $dropdown.css({'margin-top':''})
                                 },
                                 duration: 200,
                                 easing: easing_swiftOut
                             })
                 }
             }).data('selectize');
         }
    </script>

    <script>
        function uploadLavel()
        {
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
        $('#sidebar_main_bill_submit').addClass('current_section');
        $('#sidebar_bill_submit_rejected').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });
        altair_forms.parsley_validation_config();
        //payment made
        $("#check_payment").on("click",function () {
            $("#payment_details").toggle(800);
        });
        $("#payment_amount").on("input",function () {
            var total_amount= parseInt($("#total_amount").text());
            if($(this).val()>total_amount)
            {
                $(this).val(total_amount);
                return true;
            }
            if($(this).val()<0)
            {
                $(this).val(0);
                return true;
            }
        })
        $("#payment_account").on("change",function (){
            var id=parseInt($(this).val());
            if(id!=3)
            {
                $("#show").show(900);
                return 0;
            }
            if(id==3)
            {
                $("#show").hide(900);
                return 0;
            }
        });
    </script>

    <script>
        var max_fields     = 50;                           //maximum input boxes allowed
        var wrapper        = $(".input_fields_wrap");      //Fields wrapper
        var add_button     = $(".add_field_button");       //Add button ID

        //For apending another rows start
        var x         = 0;
        var total_val = 0;
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
                    '<td style="width: 200px">\n'+'<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="getItemPrice('+x+')">\n'+ '</select>\n'+
                    '</td>\n'+
                    '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_'+x+'" class="md-input quantity" name="quantity[]" value="1" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    // '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    // '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($accounts as $account_all) <option {{ $account_all->id== 26 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
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
                $.get('/bill/check/item/rate/'+ item_id, function(data){

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
            var adjustment              = $("#adjustment").val();
            var vat                     = $("#vat").val();
            console.log(vat);
            var subTotal                = $("#subTotal").val();


            if (rate == '' || rate == 0 )
            {
                var rateCal             = 0.00;
            }else{
                var rateCal             = $("#rate_"+x).val();
            }

            if (quantity == ''|| quantity == 0)
            {
                var quantityCal         = 1;
            }else{
                var quantityCal         = $("#quantity_"+x).val();
            }

            var amount = (parseFloat(rateCal)*parseFloat(quantityCal)) ;

            $("#amount_"+x).val(amount);

            var subTotal       = 0;

            $('.amount').each(function()
            {
                subTotal     += parseFloat($(this).val());
            });
            //Calculating Subtotal Amount end
            if (adjustment == '0.00' || adjustment == '' )
            {
                var adjustment_value    = 0;
                 var adjustment_show = parseFloat(subTotal);
            }else{
                var adjustment_value    = adjustment;
                 var adjustment_show = parseFloat(subTotal) + parseFloat(adjustment_value);
            }

            $("#adjustmentShow").html(adjustment_value);
            $("#subTotalShow").html(subTotal);
            $("#subTotal").val(subTotal);

            if (vat == '' || vat == '0.00')
            {
                var vat                = 0;
                var vat_value          = 0;
                console.log('if',vat_value);
            }else{
                var vat_value                = (parseFloat(adjustment_show) +  (parseFloat(subTotal)*parseFloat(vat))/100);
                var vat                      = (parseFloat(adjustment_show) * parseFloat(vat))/100 ;
                    console.log('else',vat_value);
            }
            $("#vatShow").html(vat);
            $("#vat_total").val(vat);

            var total_amount     = parseFloat(subTotal) + parseFloat(vat) + parseFloat(adjustment_value);
            //Calculating Total Amount end
            $("#totalAmountShow").html(total_amount);
            $("#totalAmount").val(total_amount);

            total_val =  total_amount ;
            if(total_val > 0)
            {
              if($('#no_of_installment').val() ==0 || $('#time_interval').val()== 0 )
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
          installment();
        }
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

              });

              list2 += '<option value = "">' + 'Select Product/Service  ' +'</option>';
              $("#item_id_0").empty();
              $("#item_id_0").append(list2);
              $("#item_id_0").append(list4);
          });
        }
    </script>

    <script>

      var total_val =   $("#totalAmount").val();
      var index_no  =   "<?php echo isset($i) ? $i: 0 ;?>";
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
      setTimeout(calculateActualAmount(),3);
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
        else
        {
          $('#installment').hide(1000);
          $("#due_date_amount").show(100);
        }
      }

    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>


    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
