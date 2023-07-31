@extends('layouts.main')

@section('title', 'Create Invoice')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style media="screen">
        .md-input-filled > label, .md-input-focus > label {
            top: -10px !important;
        }
        span.select2-container{
            z-index: 30 !important;
        }
        .uk-badge a{
            color:white
        }
        input{
            margin-top: 10px;
        }
        .getMultipleRow input,discount_type{
            margin-top:-10px;
        }
        .discount_type{
            margin-top:-10px;
        }
        .uk-table td, .uk-table th {
            padding: 7px 4px;
        }

        select.md-input, textarea.md-input, input:not([type]).md-input, input[type="text"].md-input, input[type="password"].md-input, 
        input[type="datetime"].md-input, input[type="datetime-local"].md-input, input[type="date"].md-input, input[type="month"].md-input, 
        input[type="time"].md-input, input[type="week"].md-input, input[type="number"].md-input, input[type="email"].md-input, 
        input[type="url"].md-input, input[type="search"].md-input, input[type="tel"].md-input, input[type="color"].md-input{
            padding: 9px 4px;
        }
        .fixed-height-div{
            display: block;
            height: 320px;
            overflow-y: scroll;
        }
        .md-input-wrapper {
            padding-top: 0px;
        }
        .low-height-input{
            padding: 4px 4px !important;
            margin-top: 0px;
        }
        .md-36{
            font-size: 26px !important;
        }
        .uk-table thead th, .uk-table tfoot td, .uk-table tfoot th{
            font-size: 12px;
            line-height: 1px;
        }
        #page_content_inner {
            padding: 10px 10px 100px;
        }
        .uk-grid + .uk-grid, .uk-grid-margin, .uk-grid > * > .uk-panel + .uk-panel{
            margin-top: 0px;
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('pos_invoice_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card" style="z-index: 1;">
                                
                            <!-- <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Invoice</span></h2>
                                </div>
                            </div> -->
                            <div class="user_content" style="padding: 7px 10px;">
                                <div class="">
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-4">
                                          <label  for="customer_name">Name <br>
                                            <span class="uk-badge"><a data-toggle="uk-modal" data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit" class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create Contact</a></span>
                                            <span class="uk-badge"><a href="{{ route('sales_return_create') }}">Add Sales Return</a></span> </label> <br>
                                            <select class="md-input select2-single-search-dropdown" onchange="customerChange()" title="Select Customer" id="customer_id" name="customer_id" required>
                                                <option value="">Select Name</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" @if($customer_id == $customer->id) selected @endif>
                                                        {{ $customer->phone_number_1 . ', ' . $customer->display_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="uk-width-medium-1-4">
                                            <label for="invoice_date">Invoice Date</label>
                                            <input class="md-input" type="text" id="invoice_date" name="invoice_date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                        </div>

                                        <!-- <div class="uk-width-medium-2-4">
                                            <label for="invoice_date">Reference</label>
                                            <input class="md-input" type="text" id="reference" name="reference">
                                        </div> -->

                                        <div class="uk-width-medium-2-4">
                                            <label for="invoice_date">Add New Item By Serial</label>
                                            <input class="md-input" type="text" id="new_item_serial" oninput="newserial()" name="new_item_serial" autofocus>
                                              <p id = "serial_message" style = "color: red; font-weight: bold; display: none;"></p>
                                        </div>
                                    </div>

                                    <!-- <a href="{{ route('inventory_create') }}" target="_blank" class="md-btn md-btn-default"style="margin:20px 0px  -30px 0px" >Create New Product/Service </a> -->

                                    <div class="uk-grid" style="margin-top: 15px;">
                                        <div class="uk-width-medium-1-1 uk-overflow-container fixed-height-div">
                                            <table class="input_fields_wrap uk-table">
                                                <thead>
                                                    <tr>
                                                        <th class="uk-text-nowrap">#</th>
                                                        <th class="uk-text-nowrap"width="20%">Product/Service <span style="color: red;" class="asterisc">*</span></th>
                                                        <th class="uk-text-nowrap hidden">Serial No</th>
                                                        <th class="uk-text-nowrap">Stock</th>
                                                        <th class="uk-text-nowrap hidden">Description</th>
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
                                                    <tr class="tr_0" id="data_clone"  >
                                                        <td>
                                                            <p style="padding-top: 7px; margin-bottom: 0px;">1</p>
                                                        </td>

                                                        <td style="width: 200px">
                                                            <select id="item_id_0" class="md-input itemId select2-single-search-dropdown" 
                                                                    name="item_id[]" onchange="getItemPrice(0)" required>
                                                            </select>                                                           
                                                        </td>
                                                        <td class="hidden">
                                                            <input type="text" id="serial_0" name="serial[]" class="md-input serial" value="" />
                                                        </td>
                                                        <td class="">
                                                            <input type="text" id="available_stock_0" name="available_stock[]" class="md-input serial" value="0" />
                                                        </td>
                                                        <td class="hidden">
                                                            <input type="text" id="description_0" class="md-input description" name="description[]"  oninput="calculateActualAmount(0)" >
                                                        </td>

                                                        <td>
                                                            <input type="text" id="quantity_0" name="quantity[]" class="md-input quantity" value="1" oninput="calculateActualAmount(0)" />
                                                        </td>

                                                        <td>
                                                            <input type="text" id="rate_0" name="rate[]" class="md-input rate" value="0.00" oninput="calculateActualAmount(0)" required/>
                                                        </td>

                                                        <td>
                                                            <input id="discount_0" type="text" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount(0)">
                                                        </td>

                                                        <td style="width: 80px">
                                                            <select class="md-input discount_type" id="discount_type_0" name="discount_type[]" onchange="calculateActualAmount(0)">
                                                                <option value="1" selected>BDT</option>
                                                                <option value="0">%</option>
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
                                                                <i class="material-icons md-36">&#xE146;</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table style="display:none;float:right;margin-top:-20px !important " class="add_table">
                                              <tr>
                                                  <td style="text-align: center"  >
                                                      <a href="#" class="add_field_button">
                                                          <i class="material-icons md-36">&#xE146;</i>
                                                      </a>
                                                  </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="uk-grid">
                                        <div class="uk-width-medium-3-3 uk-overflow-container">
                                            <table class="uk-table">
                                                <tbody>
                                                    <tr>
                                                        <td>Sub Total</td>
                                                        <td style="text-align: right">
                                                          <a style="border: none;text-decoration: none;color: black" id="subTotalShow">0.00</a>
                                                        </td>
                                                        <td>
                                                            <label for="adjustment_amount">Adjustment</label>
                                                            <input type="text" id="adjustment_amount" name="adjustment_amount" class="md-input md-input-width-medium low-height-input" 
                                                                 value="{{ $OrganizationProfile->adjustment_default }}" oninput="calculateActualAmount(0)"/>
                                                        </td>
                                                        <td style="width: 80px">
                                                            <select class="md-input adjustment_type" id="adjustment_type" name="adjustment_type" onchange="calculateActualAmount(0)">
                                                                <option value="1">BDT</option>
                                                                <option value="0" selected>%</option>
                                                            </select>
                                                        </td>
                                                        <td colspan="1">
                                                            <label for="adjustment">Total Adjusted</label>
                                                            <input type="text" id="adjustment" name="adjustment" class="md-input md-input-width-medium low-height-input" 
                                                                 value="0.00" oninput="calculateActualAmount(0)" readonly/>
                                                        </td>
                                                        <td colspan="1">
                                                            <label for="vat">Vat (%)</label>
                                                            <input type="text" id="vat" class="md-input md-input-width-medium low-height-input" value="{{ $OrganizationProfile->vat_default }}" oninput="calculateActualAmount(0)" />
                                                        </td>
                                                        <td style="text-align: right">
                                                            <a style="border: none;text-decoration: none;color: black" id="vatShow">0.00</a>
                                                        </td>
                                                        <td colspan="1">
                                                            <label for="shippingCharge">Shipping</label>
                                                            <input type="text" id="shippingCharge" name="shipping_charge" class="md-input md-input-width-medium low-height-input"  value="0.00" oninput="calculateActualAmount(0)"/>
                                                        </td>                                                  
                                                        <td style="text-align: right">
                                                            <a style="border: none;text-decoration: none;color: black" id="shippingChargeShow">0.00</a>
                                                        </td>
                                                        <td>
                                                            <label for="customer_credit">Customer Credit</label>
                                                            <input type="text" id="customer_credit" name="customer_credit" class="md-input md-input-width-medium low-height-input" value="0.00" oninput="calculateActualAmount(0)" readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Total<br>
                                                            Payable
                                                        </th>
                                                        <th style="text-align: right" colspan="1">
                                                            <a style="border: none;text-decoration: none;color: black" id="totalAmountShow">0.00</a>
                                                            <br>
                                                            <a style="border: none;text-decoration: none;color: black" id="totalPayableShow">0.00</a>
                                                        </th>
                                                        <th style="text-align: left" colspan="1">
                                                            <label for="payment_amount">Cash Paid</label>
                                                            <input class="md-input low-height-input" type="number" oninput="checkPaidamount()" id="payment_amount" 
                                                                name="payment_amount" value="{{ old("payment_amount") }}"/>
                                                        </th>
                                                        <th style="text-align: left" colspan="2">
                                                            <label for="payment_amount_bank">Bank Paid</label>
                                                            <input class="md-input low-height-input" type="number" oninput="checkPaidamount()" id="payment_amount_bank" 
                                                                name="payment_amount_bank" value="{{ old("payment_amount_bank") }}"/>
                                                        </th>
                                                        <th style="text-align: left" colspan="1">
                                                        <label for="return_amount">Return</label>
                                                            <input class="md-input low-height-input" type="text" id="return_amount" 
                                                                name="return_amount" value="0" readonly/>
                                                        </th>
                                                        <th colspan="2">
                                                            <!-- <label class="uk-vertical-align-middle" for="payment_account">Deposit To</label> -->
                                                            <select name="payment_account" id="payment_account" class="md-input select2-single-search-dropdown" 
                                                                title="Select Account">
                                                                <option value="" disabled selected hidden>Select...</option>
                                                                @foreach($accounts as $value)
                                                                    @if($value->id==3)
                                                                        <option selected  value="{{ $value->id }}">{{ $value->account_name }}</option>
                                                                    @else
                                                                        <option value="{{ $value->id }}">{{ $value->account_name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </th>
                                                        <th colspan="2">
                                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary" 
                                                                    value="submit" style="width: 100%" name="submit" />
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
                                        <div class="uk-width-medium-2-4">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="customer_note">Personal note</label>
                                                    <textarea class="md-input" id="customer_note" name="personal_note"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-width-medium-2-4">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="customer_note">Customer note</label>
                                                    <textarea class="md-input" id="customer_note" name="customer_note"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid hidden" data-uk-grid-margin>
                                      <div class="uk-width-medium-1-3">
                                          <label for="invoice_date">No Of Installment</label>
                                          <input class="md-input" type="text" id="no_of_installment" onfocusout="installment()" value="" name="no_of_installment">
                                      </div>
                                      <div class="uk-width-medium-1-3">
                                          <label for="invoice_date">Time Interval</label>
                                          <input class="md-input" type="text" id="time_interval" onfocusout="installment()" value=""  name="time_interval">
                                      </div>
                                        <div class="uk-width-medium-1-3">
                                            <label for="invoice_date">Start Sate</label>
                                            <input class="md-input" type="text" id="start_date" onfocusout="installment()" name="start_date"value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                        </div>
                                    </div>

                                    <div style="display:none;" id="installment" class="uk-grid" data-uk-grid-margin>
                                      <div class="uk-width-1-1" >
                                          <div style=" padding:10px;height: 40px; color: white; background-color: #2D2D2D ">
                                            Installment Amount And Date
                                          </div>
                                      </div>
                                       <div class="uk-width-medium-4-4">
                                        <table class="input_fields_wrap uk-table">
                                          <tbody  id="install_due_date" class="add_row">
                                          <tr>
                                            <td> <b>Due Date</b></td>
                                            <td><b>Due Amount</b></td>
                                          </tr>
                                        </tbody>
                                        </table>
                                      </div>
                                    </div>

                                    <div style="display:none;" id="due_date_amount" class="uk-grid" data-uk-grid-margin>
                                      <div class="uk-width-1-1" >
                                          <div style=" padding:10px;height: 40px; color: white; background-color: #2D2D2D ">
                                              Multiple Due Date Add
                                          </div>
                                      </div>
                                       <div class="uk-width-medium-4-4">
                                        <table class="input_fields_wrap uk-table">
                                          <tbody  id="add_row" class="add_row">
                                          <tr>
                                            <td> <b>Due Date</b> </td>
                                            <td> <b>Due Amount</b> </td>
                                            <td> <b>Action</b> </td>
                                          <tr>
                                            <td>
                                               <input class="md-input" type="text" id="due_date" name="due_date[]" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" >
                                            </td>
                                            <td>
                                              <input class="md-input amount_value" type="text" id="due_ammount_0" onchange="valcheck(0)"  name="amount_val[]" />
                                            </td>
                                            <td style="text-align: center">
                                                <a  class="field_button">
                                                    <i style="padding-top: 7px" class="material-icons md-36">&#xE146;</i>
                                                </a>
                                            </td>
                                          </tr>
                                        </tbody>
                                        </table>
                                      </div>
                                    </div>

                                    <hr>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="submit" name="submit" />
                                            <!-- <input type="submit" class="md-btn md-btn-success" value="save" name="save" /> -->
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
        $( document ).ready(function() {
            
            customerChange({!! $customer_id !!});
            
        });
    </script>

    <script type="text/javascript">
        altair_forms.parsley_validation_config();

        $(document).ready( function() {
            $("#new_item_serial").focus();
        });

        $(document).on( 'keydown', function (e) {

            if(e.keyCode === 27)
            {
                $("#new_item_serial").focus();
            }

        });

        function customerChange(customer = 0){
            
            if(customer > 0){
                var customer_id = customer;
            }else{
                var customer_id = $('#customer_id option:selected').val();    
            }
            

            $.get('/invoice/check/customer/credit/'+ customer_id, function(data){

                $("#customer_credit").val(data);

                calculateActualAmount(0);
            });
        }
    </script>

    <script type="text/javascript">
        var max_fields       = 50;                           //maximum input boxes allowed
        var wrapper          = $(".input_fields_wrap");      //Fields wrapper
        var add_button       = $(".add_field_button");       //Add button ID
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

                $.get("{{route('item_list')}}/", function(data){

                    var list5 = '';
                    var list7 = '';

                    $.each(data, function(i, data)
                    {
                        list5 += '<option value = "' +  data.id + '">' + String("000000" + data.id).slice(-6) + ', ' + data.item_name +'</option>';

                    });

                    list7 += '<option value = "">' + 'Select Product/Service  ' +'</option>';

                    $("#item_id_"+x).empty();
                    $("#item_id_"+x).append(list7);
                    $("#item_id_"+x).append(list5);
                });


                $('.getMultipleRow').append( ' ' +'<tr class="tr_'+x+'">'+
                    '<td>\n'+'<p style="padding-top: 7px; margin-bottom: 0px;">'+serial+'</p>'+'</td>\n'+
                    '<td style="width: 200px">\n'+'<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="getItemPrice('+x+')">\n'+ '</select>\n'+'<div class="row" style="display: none;">'+'<label style="padding-top: 10px;padding-right: 0px;" class="col-md-6">'+''+'</label>'+'<input  style="padding-top: 10px;border: none;padding-left: 0px;font-weight: white;color:white" class="col-md-6" type="text" id="stock_'+x+'" class="" name="stock[]"/>'+'</div>'+
                    '</td>\n'+
                    ' <td class="hidden">'+
                    '<input  type="text" id="serial_'+x+'" name="serial[]"  value="" class="md-input serial" />'+
                    '</td>'+
                    '<td class="">'+
                        '<input type="text" id="available_stock_'+x+'" name="available_stock[]" class="md-input serial" value="0" />'+
                    '</td>'+
                    '<td class="hidden">\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_'+x+'" class="md-input quantity" name="quantity[]" value="1" oninput="calculateActualAmount('+x+')"/ >\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" readonly value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($account as $account_all) <option {{$account_all->id==16 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
                    '<td style="text-align: center">\n'+'<a href="#" data-val="'+x+'" class="remove_field">\n'+'<i" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
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
            //removing input array when delete tr 
            var serial_no_of_tr      = $(this).data('val');
            // var serial_input_value   = $("#serial_"+serial_no_of_tr).val();

            // if(serial_input_value != 'undefined')
            // {
            //     var serial_input_value   = serial_input_value.split(",");
    
            //     for(var j = 0; j < serial_input_value.length; j++)
            //     {
            //         for( var i = 0; i < serial_arr.length; i++)
            //         {
            //             if ( serial_arr[i] == serial_input_value[j])
            //             {
            //                 serial_arr.splice(i, 1);
            //                 i--;
            //             }
            //         }
            //             console.log('ok');
            //     }  
            // }

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
                    $("#available_stock_"+x).val(data.total_purchases - data.total_sales);

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
            var customer_credit         = $("#customer_credit").val();

            var adjustment_type         = $("#adjustment_type").val();
            var adjustment_amount       = $("#adjustment_amount").val();

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

            var amount  = (parseFloat(rateCal)*parseFloat(quantityCal)) - (parseFloat(discountTypeCal));
            amount      = Math.round(amount);

            $("#amount_"+x).val(amount);

            var subTotal       = 0;

            $('.amount').each(function()
            {
                subTotal     += parseFloat($(this).val());
            });

            subTotal = Math.round(subTotal);

            //Calculating Subtotal Amount end
            $("#subTotalShow").html(subTotal);
            $("#subTotal").val(subTotal);

            if(adjustment_type == 0){
                adjustment              = parseFloat(parseFloat(parseFloat(subTotal) * parseFloat(adjustment_amount)) / 100);
                adjustment              = -adjustment;
                adjustment              = Math.round(adjustment);
                $("#adjustment").val(adjustment);
            }else{
                adjustment              = adjustment_amount;
                $("#adjustment").val(adjustment);
            }

            if(isNaN(adjustment)){
                adjustment = 0;
                $("#adjustment").val(adjustment);
            }

            if (adjustment == '0.00' || adjustment == '' )
            {
                var adjustment_value    = 0;
                var adjustment_show     = 0;
            }else{
                var adjustment_value    = adjustment;
                var adjustment_show     = Math.round(parseFloat(subTotal) + parseFloat(adjustment_value));
            }

            if(vat =='' || vat ==0.00)
            {
                var vat_val     = 0;
                var vat_show    = 0;
                var vat_cal     = 0;
            }
            else {
                var vat_val     =  vat;
                var vat_cal     =  ((parseFloat(subTotal) + parseFloat(adjustment_value)) * parseFloat(vat_val))/100;
                vat_cal         = Math.round(vat_cal);

                var vat_show    = parseFloat(vat_cal) + parseFloat(subTotal);
                vat_show        = Math.round(vat_show);
            }
            if(shippingCharge =='' || shippingCharge ==0.00)
            {
                var shippingCharge_val  = 0;
                var shippingCharge_show = 0;
            }
            else {
                var shippingCharge_val  =  shippingCharge;
                var shippingCharge_show = Math.round(parseFloat(adjustment_value) + parseFloat(shippingCharge_val)+parseFloat(vat_cal)+parseFloat(subTotal));
            }

            var total_amount     = Math.round(parseFloat(adjustment_value) + parseFloat(shippingCharge_val)+parseFloat(vat_cal)+parseFloat(subTotal));

            $("#adjustmentShow").html(adjustment_value);
            $("#vatShow").html(vat_cal);
            $("#vat_total").val(vat_cal);
            $("#shippingChargeShow").html(shippingCharge_val);
            $("#totalAmountShow").html(total_amount);
            $("#totalPayableShow").html(total_amount - parseFloat(customer_credit));
            $("#totalAmount").val(total_amount);

            total_val =  total_amount ;

            if(total_val > 0)
            {
                // $("#due_date_amount").show(2000);
                var total_payable    = $('#totalAmount').val();
            }
            else
            {
                $("#due_date_amount").hide(2000);
            }
            
            checkPaidamount();
            commissionAmount();
            installment();
        }
    </script>

    <script type="text/javascript">
        function commissionAmount()
        {
            var commission_amount = $('#commission').val();
            var commission_type   = $('#commission_type').val();

            var sub_total       = $('#subTotal').val();
            var adjustment      = $('#adjustment').val();

            if(adjustment == 0|| adjustment =='')
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
                $('#agentcommissionAmount').val(Number(com).toFixed(2));
            }
        }
    </script>

    <script type="text/javascript">
        function uploadLavel(){
           var fullPath             = document.getElementById('form-file').value;
           var upload_file_name_    = document.getElementById('upload_name');

           if (fullPath) {
               var startIndex   = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
               var filename     = fullPath.substring(startIndex);
               if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                   filename     = filename.substring(1);
               }

               upload_file_name_.innerHTML  = filename;
           }
        }

        $("#check_payment").on("click",function () {
            $("#payment_details").toggle(800);
        });

        $("#payment_amount").on("input",function () {
            var total_amount = parseInt($("#total_amount").text());
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

        $('#sidebar_pos').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>

    <script type="text/javascript">
        $( document ).ready(function() {
            $.get("{{route('item_list')}}/", function(data){

                var list2 = '';
                var list4 = '';
                $.each(data, function(i, data)
                {
                    list4 += '<option value = "' +  data.id + '">' + String("000000" + data.id).slice(-6) + ', ' + data.item_name +'</option>';
                });

                list2 += '<option value = "">' + 'Select Product/Service  ' +'</option>';

                $("#item_id_0").empty();
                $("#item_id_0").append(list2);
                $("#item_id_0").append(list4);
            });
        });
    </script>

    <script type="text/javascript">
        var total_val =   $("#totalAmount").val();
        var index_no  =   0;

        $('.field_button').on('click',function(e){
            e.preventDefault();
            index_no++;
            $('.add_row').append(
                '<tr class="app_tr_'+index_no+'">'+
                    '<td>'+
                        `<input class="md-input" type="text" id="due_date_`+ index_no +`" name="due_date[]" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" />` +
                    '</td>' +
                    '<td>'+
                        '<input class="md-input amount_value" id="due_ammount_'+index_no+'"  name="amount_val[]" onchange="valcheck('+ index_no +')" type="text"/>'+
                    '</td>'+
                    '<td>'+
                        '<a  class="remove_date_amount">\n'+'<i style="padding-top: 5px" value="'+ index_no +'"  class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                    '</td>'
                +'</tr>'
            )

            var nn = parseFloat(index_no) - 1;

            $('#due_ammount_'+nn).attr('readonly', 'readonly');
        });

        $('.add_row').on('click', '.remove_date_amount',function(){
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

        var serial_arr      = [];

        function newserial()
        {
            var x               = parseInt($('.getMultipleRow tr:last').attr('class').match(/(\d+)/g)[0]);
            var new_serial      = $('#new_item_serial').val();
            var tmp             = 0;
            var stop_op         = 0;

            if(new_serial.length != 6){
                return false;
            }

            $('#serial_message').text('');

            $("#serial_message").hide();

            //check if serial already used in previous rows
            // for(tmp = 0; tmp <= x; tmp++){

            //     var used_serial = $('#serial_'+tmp).val();
            //     if(used_serial == new_serial && new_serial != ""){

            //         stop_op = 1;

            //         $('#serial_message').text('You have already used the serial in this invoice..!!');

            //         $("#serial_message").show();

            //     }
            // }

            //if not used proceed with ajax call
            if(stop_op != 1){
                $.get('/invoice/check/serial/'+ new_serial, function(data){
                    
                    var item_id             = data.item_id;
                    var item_serial         = data.item_serial;
                    var item_sales_rate     = data.item_sales_rate;
                    var item_exist_before   = 0;
                    var value               = data.value;
                    
                    //array push using serial entry
                    serial_arr.push(item_serial);

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

                        function checkDuplicateSerial(checkId) {
                            return checkId >= item_serial;
                        }

                        // if(value == 1 )
                        // {
                        //     var new_serial_arr = find_duplicate_in_array(serial_arr);
                        //     var index_no = new_serial_arr.find(checkDuplicateSerial)

                        //     // if(index_no >0)
                        //     // {
                        //     //    $('#serial_message').text('You have already used the serial in this invoice..!!');
                        //     //    $("#serial_message").show();
                        //     //    return false;
                        //     // }
                        // }

                        $('#serial_message').text('');
                        $("#serial_message").hide();

                        var item_0_val = $("#item_id_"+0).val();

                        //when no row was appended yet; we are at the very first row and item was not found before
                        if(item_exist_before != 1){

                            if(x == 0 && !(item_0_val > 0)){

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

                                // $('#serial_0').val(item_serial);
                                $('#rate_0').val(item_sales_rate);
                                $('#amount_0').val(item_sales_rate);
                                $('#available_stock_0').val(data.item_stock);

                                calculateActualAmount(0);

                                $('#new_item_serial').val('');
                                $('#new_item_serial').focus();

                                $('#quantity_0').focus();
                                var qty_tmp_val = $('#quantity_0').val();
                                $("#quantity_0").val('');
                                $('#quantity_0').val(qty_tmp_val);

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

                                    $('#quantity_'+x).focus();
                                    var qty_tmp_val = $('#quantity_'+x).val();
                                    $('#quantity_'+x).val('');
                                    $('#quantity_'+x).val(qty_tmp_val);
                                });


                                $('.getMultipleRow').append( ' ' +'<tr class="tr_'+x+'">'+
                                    '<td>\n'+'<p style="padding-top: 7px; margin-bottom: 0px;">'+serial+'</p>'+'</td>\n'+
                                    '<td style="width: 200px">\n'+'<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="getItemPrice('+x+')">\n'
                                    + '</select>\n'+'<div class="row" style="display: none;">'+'<label style="padding-top: 10px;padding-right: 0px;" class="col-md-6">'+''+'</label>'
                                    +'<td class="">'+
                                        '<input type="text" id="available_stock_'+x+'" name="available_stock[]" class="md-input serial" value="'+data.item_stock+'" />'+
                                    '</td>'+
                                    // '</td>\n'+
                                    '<td class="hidden">'+
                                    '<input  type="text" id="serial_'+x+'" value="'+item_serial+'" name="serial[]" class="md-input serial"  />'+
                                    '</td>'+
                                    '<td class="hidden">\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                    '<td>\n'+'<input type="text" id="quantity_'+x+'" class="md-input quantity" name="quantity[]" value="1" oninput="calculateActualAmount('+x+')"/ >\n'+'</td>\n'+
                                    '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" readonly value="' + data.item_sales_rate + '" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                    '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                    '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'
                                    +'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
                                    '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                    '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'
                                    + ' @foreach($account as $account_all) <option {{$account_all->id==16 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
                                    '<td style="text-align: center">\n'+'<a href="#" data-val="'+x+'" class="remove_field">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'
                                    +'</a>\n'+'</td>\n'+
                                    '</tr>\n');

                                $('.single_select2').select2();

                                calculateActualAmount(x);

                                $('#new_item_serial').val('');
                                $('#new_item_serial').focus();
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

                            // $('#serial_'+x).val(cur_serial);

                            calculateActualAmount(x);

                            $('#new_item_serial').val('');
                            $('#new_item_serial').focus();

                            $('#quantity_'+x).focus();
                            var qty_tmp_val = $('#quantity_'+x).val();
                            $('#quantity_'+x).val('');
                            $('#quantity_'+x).val(qty_tmp_val);
                        }

                    }else {
                        $('#serial_message').text(data.message);
                        $("#serial_message").show();
                    }

                });
            }
        }

        function find_duplicate_in_array(arra1) 
        {
            var object = {};
            var result = [];

            arra1.forEach(function (item) {
                if(!object[item])
                    object[item] = 0;
                    object[item] += 1;
            })

            for (var prop in object) {
                if(object[prop] >= 2) {
                   result.push(prop);
                }
            }

            return result;
        }

        function checkPaidamount(){
            var total_amount        = parseFloat($('#totalPayableShow').html());
            var paid_amount         = parseFloat($('#payment_amount').val());
            var paid_amount_bank    = parseFloat($('#payment_amount_bank').val());
            
            paid_amount             = paid_amount > 0 ? paid_amount : 0;
            paid_amount_bank        = paid_amount_bank > 0 ? paid_amount_bank : 0;
            
            if((paid_amount + paid_amount_bank) > total_amount){
                $('#return_amount').val((paid_amount + paid_amount_bank) - total_amount);
            }else{
                $('#return_amount').val(0);
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

            if($('#no_of_installment').val() >0 && $('#time_interval').val()>0)
            {
              for(var i = 0; i< no_of_installment;i++)
              {
                if(i == 0)
                {
                var start_date =date_formate(mili_date)
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
               $("#due_date_amount").hide(1000);
            }
            else  {
              $('#installment').hide(1000);
            //   $("#due_date_amount").show(100);
            }
        }
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
