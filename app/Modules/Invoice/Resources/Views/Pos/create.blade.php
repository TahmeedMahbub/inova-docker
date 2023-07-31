@extends('layouts.main')

@section('title', ' Pos Invoice')

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

    .uk-badge a{
    color:white
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
    .md-card{
      margin-top:10px;
      width:100%;
    }
     .card-1{
      margin-top:-60px;
      width:100%;
    }
.single_select2{
  width:100%
}
    @media (min-width: 1200px){
.container {
    width: 1100px;
}
}
@media (max-width: 992px){
.container {
    width: 800px;
}
}
@media (max-width: 700px){
.container {
    width: 700px;
}

}
@media (max-width: 600px){
.container {
    width: 100%;
    margin-right: 143px !important;
}
.uk-grid>* {
padding-left: 19px;
}
.user_heading_avatar.fileinput {

    height: 0px;
    margin: 0 auto 16px;
    display: block;
}
.user_heading_content {
  padding: 0px 0;
}
}
#page_content_inner {
    padding: 24px 3px 100px;
}
</style>
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('point_of_sales_store'), 'method' => 'POST', 'class' => 'user_edit_form ', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">

                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Invoice</span></h2>
                                </div>
                            </div>

                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div id="custome_hide" class="uk-width-medium-2-6">
                                          <label   for="customer_name"> Customer Name &nbsp  <span class="uk-badge"><a id="dropdown" type="submit" class="sm-btn sm-btn-primary">Dropdown</a></span> </label> <br>
                                          <input style="margin-top: -13px" type="text" class="md-input"  id="customer_name_input" onfocusout="customer_name()" value="">
                                          <input style="margin-top: -13px" type="hidden" class="md-input" name="customer_id" id="customer_id"  value="">

                                        </div>


                                        <div class="uk-width-medium-2-6">
                                            <label style="margin-top:8px" for="invoice_date">Select Invoice date</label>
                                            <input class="md-input" type="text" id="invoice_date" name="invoice_date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                        </div>
                                        <div class="uk-width-medium-2-6">
                                            <label for="invoice_date">Reference</label>
                                            <input class="md-input" type="text" id="reference" name="reference">
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                     <div class="uk-width-medium-1-1">
                                         <label for="invoice_date">Add New Item By Serial</label>
                                         <input class="md-input" type="text" id="new_item_serial" onfocusout="newserial()" name="new_item_serial">
                                           <p id = "serial_message" style = "color: red; font-weight: bold; display: none;"></p>
                                     </div>
                                   </div>

                                    <div  class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                          <div  class="uk-grid" data-uk-grid-margin>
                                              <div class="uk-width-medium-1-1  ">
                                                <table class='input_fields_wrap'>
                                                  <tbody class="getMultipleRow" >
                                                    <tr  class="tr_0">
                                                      <td>
                                                       <div class="md-card card-1">
                                                         <div  class="container">
                                                          <div class="row">
                                                            <div  style="padding:11px 10px 13px 10px"  class="col-md-12 col-sm-12 col-xs-12">
                                                              <select  id="item_id_0" class="md-input select2-single-search-dropdown" name="item_id[]" onchange="getItemPrice(0)"required>
                                                                <option value="">select Product/Service </option>
                                                                @foreach($product as $value)
                                                                  <option value="{{ $value->id }}"> {{ $value->item_name}} </option>
                                                                  @endforeach
                                                                </select>
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                                 ImeI:
                                                            </div>
                                                            <div  class="col-md-10 col-sm-8 col-xs-8">
                                                               <input  type="text" id="serial_0" name="serial[]" class="md-input serial" value="" />
                                                            </div>
                                                          </div> 
                                                          <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                              Qty:
                                                            </div>
                                                            <div  class="col-md-10 col-sm-8 col-xs-8">
                                                              <input  type="text" id="quantity_0" name="quantity[]" class="md-input quantity" value="1" oninput="calculateActualAmount(0)" />
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                              Rate:
                                                            </div>
                                                            <div  class="col-md-10 col-sm-8 col-xs-8">
                                                              <input type="text" id="rate_0" name="rate[]" class="md-input rate" value="0.00" oninput="calculateActualAmount(0)" required readonly/>
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                                 Dis:
                                                            </div>
                                                            <div  class="col-md-10 col-sm-8 col-xs-8">
                                                              <input id="discount_0" type="text" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount(0)">
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                                 Type:
                                                            </div>
                                                            <div style="margin-top:3px" class="col-md-10 col-sm-8 col-xs-8">

                                                            <select class="md-input discount_type"  id="discount_type_0" name="discount_type[]" onchange="calculateActualAmount(0)" class="md-input  select2-single-search-dropdown">
                                                                <option value="1" selected>BDT</option>
                                                                <option value="0">%</option>
                                                            </select>
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                                Amnt:
                                                            </div>
                                                            <div  class="col-md-10 col-sm-8 col-xs-8">
                                                              <input type="text" id="amount_0" name="amount[]" class="md-input amount" value="0" oninput="calculateActualAmount(0)" readonly="readonly" />
                                                            </div>
                                                          </div>
                                                             <div style="display: none" class="uk-accordion" data-uk-accordion>
                                                               <select id="account_id_0" class="md-input accountId select2-single-search-dropdown" name="account_id[]" required>
                                                                   <option value="" selected>Select Account</option>
                                                                   @if(!empty($account) && (count($account) > 0))
                                                                       @foreach($account as $account_value)
                                                                           <option value="{{ $account_value->id }}" {{$account_value->id==16 ? 'selected':''}}>{{ $account_value->account_name }}</option>
                                                                       @endforeach
                                                                   @endif
                                                               </select>
                                                             </div>
                                                             <div  class="">
                                                               <div  class="uk-accordion" data-uk-accordion>
                                                                 <a style="margin-left:0px;margin-bottom:-5px" href="#" class="add_field_button btn btn-info btn-large">
                                                                  &nbsp &nbsp Add &nbsp&nbsp
                                                                 </a>
                                                               </div>
                                                             </div>
                                                             <br>
                                                        </div>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                    <br>
                                                    <br>
                                                  </tbody>
                                              </table>
                                              </div>
                                          </div>
                                          <div style="display:none;float:right;margin-top:5px !important; " class="add_table">
                                              <a href="#"  class="add_field_button btn btn-info">
                                                &nbsp &nbsp  Add &nbsp &nbsp
                                              </a>
                                          </div>
                                        </div>
                                    </div>

                                    <div style="" class="uk-grid" data-uk-grid-margin>
                                        <div style="margin-bottom: 12px"class="uk-width-medium-1-3 uk-margin-medium-top">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="user_edit_uname_control">Attach Files: </label>
                                                </div>
                                                <div class="uk-width-medium-1-1">
                                                    <div class="uk-form-file uk-text-primary"
                                                         style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                                        <p style="margin: 4px;">Upload File</p>
                                                        <input onchange="uploadLavel()"  id="form-file" type="file" name="file">
                                                    </div>
                                                </div>
                                                <p id="upload_name"></p>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-2-3">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-1">
                                                        <div style="padding-top: 10px;padding-bottom: 10px" class="md-card">
                                                          <div style="width:97% ; margin:1px" class="container">
                                                            <div class="row">
                                                              <div class="col-md-4 col-sm-4  col-xs-3">
                                                                Sub.T.
                                                              </div>
                                                              <div class="col-md-4 col-sm-4 col-xs-5">
                                                              </div>
                                                              <div class="col-md-4 col-sm-4  col-xs-4">
                                                                <a style="border: none;text-decoration: none;color: black" id="subTotalShow">0.00</a>
                                                              </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                              <div class="col-md-4 col-sm-4 col-xs-3">
                                                                 Adj.
                                                              </div>
                                                              <div class="col-md-4 col-sm-4 col-xs-5">
                                                                 <input type="text" style="margin-top :-25px" id="adjustment" name="adjustment" class="md-input md-input-width-medium" value="0.00" oninput="calculateActualAmount(0)"/>
                                                              </div>
                                                              <div class="col-md-4 col-sm-4 col-xs-4">
                                                                <a style="border: none;text-decoration: none;color: black" id="adjustmentShow">0.00</a>
                                                              </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                              <div class="col-md-4 col-sm- col-xs-3">
                                                                  Vat(%)
                                                              </div>
                                                              <div class="col-md-4 col-sm-4 col-xs-5">
                                                                  <input type="text" style="margin-top :-25px" id="vat" class="md-input md-input-width-medium" value="0.00" oninput="calculateActualAmount(0)" />
                                                              </div>
                                                              <div class="col-md-4 col-sm-4 col-xs-4">

                                                                  <a style="border: none;text-decoration: none;color: black" id="vatShow">0.00</a>
                                                              </div>
                                                            </div>
                                                            <br />
                                                            <div class="row">
                                                              <div class="col-md-4 col-sm-4 col-xs-3" >
                                                               S.Char.
                                                              </div>
                                                              <div class="col-md-4 col-sm-4 col-xs-5">
                                                                <input style="margin-top :-25px" type="text" id="shippingCharge" name="shipping_charge" class="md-input md-input-width-medium"  value="0.00" oninput="calculateActualAmount(0)"/>
                                                              </div>
                                                              <div class="col-md-4 col-sm-4 col-xs-4">
                                                                 <a style="border: none;text-decoration: none;color: black" id="shippingChargeShow">0.00</a>

                                                              </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                              <div class="col-md-4 col-sm-4 col-xs-4" >
                                                               Total(BDT)
                                                              </div>
                                                              <div class="col-md-4 col-sm-4 col-xs-4">
                                                              </div>
                                                              <div class="col-md-4 col-sm-4 col-xs-4">

                                                                <a style="border: none;text-decoration: none;color: black" id="totalAmountShow">0.00</a>
                                                              </div>
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>

                                              </div>
                                          </div>

                                          <div class="uk-width-medium-1-6 hidden">
                                            <label for=""> Commision Type</label><br>
                                              <select  title="Select Commision"   class="select2-single-search-dropdown" id="commission_type" name="commission_type"  />
                                                  <option value="1">BDT </option>
                                                  <option value="2">% </option>
                                              </select>
                                          </div>
                                              <input class="md-input label-fixed" type="hidden" id="agentcommissionAmount" name="agentcommissionAmount" value="0.0">

                                            <input type="hidden" id="subTotal" name="sub_total">
                                            <input type="hidden" id="totalAmount" name="total_amount">
                                            <input type="hidden" id="vat_total" name="tax_total">
                                            <input type="hidden" id="lat" name="lat" value=""/>
                                           <input type="hidden" id="long" name="long" value=""/>
                                        </div>
                                    </div>

                            <hr>

                            <div style="padding-left: 25px;padding-right: 25px" class="uk-grid" data-uk-grid-margin>
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

                            <p>
                                @if($errors->has('payment_account')|| $errors->has('payment_amount'))

                                    <span style="color:red; position: relative; right:0px; margin: 5px 0px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">{!! "Payment field required" !!}</span>

                                @endif
                            </p>

                            <div style="padding-left: 25px;padding-right: 25px" class="uk-grid" >
                                <div class="uk-width-2-3" >
                                    <div style=" padding:10px;height: 40px; color: white; background-color: #2D2D2D ">
                                        Payment Receive
                                    </div>

                                </div>
                                <div class="uk-width-1-3" style="padding: 10px; height: 40px; position:relative;background: #2D2D2D ">
                                    <div id="inv" style="position: absolute; right: 10px; height: 40px; ">
                                        <input {{ old('check_payment')?"checked":'' }} type="checkbox" name="check_payment" id="check_payment" style=" margin-top: -1px; height: 25px; width: 20px;" />
                                    </div>

                                </div>
                            </div>

                            <div class="uk-grid" style="display: none;padding-left: 25px;padding-right: 25px" id="payment_details">
                                <div class="uk-width-1-1" >

                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-2">
                                            <label for="payment_amount">Amount</label>
                                            <input class="md-input" type="number" id="payment_amount" name="payment_amount" value="{{ old("payment_amount") }}"/>
                                        </div>

                                        <div class="uk-width-medium-1-2">
                                          <label class="uk-vertical-align-middle" for="payment_account">Deposit to</label> <br>
                                            <select   name="payment_account" id="payment_account" class="md-input select2-single-search-dropdown"  title="Select Account">
                                                <option value="" disabled selected hidden>Select...</option>
                                                @foreach($accounts as $value)
                                                    @if($value->id==3)
                                                        <option selected  value="{{ $value->id }}">{{ $value->account_name }}</option>
                                                    @else
                                                        <option value="{{ $value->id }}">{{ $value->account_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>
                                    <div style="display: none;" id="show" class="uk-grid">

                                        <div class="uk-width-medium-3-3">
                                          <label class="" for="payment_deposit_details">Details</label>
                                            <input class="md-input" type="text" id="payment_deposit_details" name="payment_deposit_details" value="{{ old("payment_deposit_details") }}"/>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <hr style="margin-bottom: 0px">

                            <div class="uk-grid uk-ma" data-uk-grid-margin>
                                <div style="margin-bottom: 10px;margin-left: 25px" class="uk-width-1-1 uk-float-left">
                                    <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="submit" name="submit" />
                                    <button style="margin-top: 13px" type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <input  type="hidden" name="ime_no" id='ime_no' value="" />
                <input  type="hidden" name="item_ime" id='item_ime' value="" />
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script>
        var max_fields         = 50;                           //maximum input boxes allowed
        var wrapper            = $(".input_fields_wrap");      //Fields wrapper
        var add_button         = $(".add_field_button");       //Add button ID
        var index_no           = 1;

        //For apending another rows start
        var x = 0;
        $(add_button).click(function(e)
        {
            e.preventDefault();

            if(x < max_fields)
            {

                var k = $('.getMultipleRow tr:last-child').attr('class').split('_');
                x = k[1];
                var serial = x + 1;
                   x++,
                $('.getMultipleRow').append(`<tr class="tr_`+x+`" >`+`<td>`+`<div class="md-card card-2">
                    <div class="uk-accordion" data-uk-accordion>

                      <div  style="padding:13px 10px 13px 10px"  class="col-md-12 col-sm-12 col-xs-12">
                        <select id="item_id_`+x+`" class="md-input  select2-single-search-dropdown single_select2" name="item_id[]" onchange="getItemPrice(`+x+`)" required>
                          <option value="">select Product/Service </option>
                          @foreach($product as $value)
                            <option value="{{ $value->id }}"> {{ $value->item_name}} </option>
                            @endforeach
                       </select>
                      </div>
                    </div>
                    <div class="uk-accordion" data-uk-accordion>
                      <div class="col-md-2 col-sm-4 col-xs-4">
                           ImeI:
                      </div>
                      <div  class="col-md-10 col-sm-8 col-xs-8">
                      <input  type="text" id="serial_`+x+`" name="serial[]"  value="" class="md-input serial" />
                      </div>
                    </div>
                    <div class="uk-accordion" data-uk-accordion>
                      <div class="col-md-2 col-sm-4 col-xs-4">
                           Qty:
                      </div>
                      <div  class="col-md-10 col-sm-8 col-xs-8">
                        <input  type="text" id="quantity_`+x+`" name="quantity[]" class="md-input quantity" value="1" oninput="calculateActualAmount(`+x+`)" />
                      </div>
                    </div>
                    <div class="uk-accordion" data-uk-accordion>
                      <div class="col-md-2 col-sm-4 col-xs-4">
                        Rate:
                      </div>
                      <div  class="col-md-10 col-sm-8 col-xs-8">
                        <input type="text" id="rate_`+x+`" name="rate[]" class="md-input rate" value="0.00" oninput="calculateActualAmount(`+x+`)" required readonly/>
                      </div>
                    </div>
                    <div class="uk-accordion" data-uk-accordion>
                      <div class="col-md-2 col-sm-4 col-xs-4">
                           Dist:
                      </div>
                      <div  class="col-md-10 col-sm-8 col-xs-8">
                        <input id="discount_`+x+`" type="text" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount(`+x+`)">
                      </div>
                    </div>
                    <div class="uk-accordion" data-uk-accordion>
                      <div class="col-md-2 col-sm-4 col-xs-4">
                           Type:
                      </div>
                      <div style="margin-top:3px" class="col-md-10 col-sm-8 col-xs-8">
                      <select class="md-input discount_type"  id="discount_type_`+x+`" name="discount_type[]" onchange="calculateActualAmount(`+x+`)" class="md-input  select2-single-search-dropdown">
                          <option value="1" selected>BDT</option>
                          <option value="0">%</option>
                      </select>
                      </div>
                    </div>
                    <div class="uk-accordion" data-uk-accordion>
                      <div class="col-md-2 col-sm-4 col-xs-4">
                          Amount:
                      </div>
                      <div  class="col-md-10 col-sm-8 col-xs-8">
                        <input type="text" id="amount_`+x+`" name="amount[]" class="md-input amount" value="0" oninput="calculateActualAmount(0)" readonly="readonly" />
                      </div>
                    </div>
                       <div style="display: none" class="uk-accordion" data-uk-accordion>
                         <select id="account_id_`+x+`" class="md-input accountId select2-single-search-dropdown" name="account_id[]" required>
                             <option value="" selected>Select Account</option>
                             @if(!empty($account) && (count($account) > 0))
                                 @foreach($account as $account_value)
                                     <option value="{{ $account_value->id }}" {{$account_value->id==16 ? 'selected':''}}>{{ $account_value->account_name }}</option>
                                 @endforeach
                             @endif
                         </select>
                       </div>
                       <div  class="">

                         <div  class="uk-accordion" data-uk-accordion>
                          <a href="#" style="margin-left:12px" class="remove_field btn btn-danger" data-val="`+x+`"> Delete</a>
                         </div>
                       </div>
                       <br>
                  </div>`+`</td>`+`</tr>`+`<br>`);

                $('.single_select2').select2();
            }
            if(serial>0)
            {
              $('.add_table').css('display','inline');
            }
        });
        //For apending another rows end

        $('.getMultipleRow').on("click",".remove_field", function(e)
        {

          e.preventDefault();
          //removing input array when delete tr 
            var serial_no_of_tr      = $(this).data('val');
            var serial_input_value   = $("#serial_"+serial_no_of_tr).val();
            var serial_input_value   = serial_input_value.split(",");
            for(var j =0; j<serial_input_value.length; j++)
             {
               for( var i = 0; i < serial_arr.length; i++)
                    {

                      if ( serial_arr[i] == serial_input_value[j])
                      {
                        
                        serial_arr.splice(i, 1);
                        i--;
                      }
                      console.log(serial_arr)
                      // alert(serial_arr)
                    }
                     console.log(serial_input_value[j]);
              }   
          $(this).parents("tr").remove();

          x--;
          calculateActualAmount();
        });

        function calculateActualAmount(x)
        {
            //For getting item commission information from items table start

            //For getting item commission information from items table end

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

            if (discountType == 0 )
            {
                var discountTypeCal     = (parseFloat(discountCal)*parseFloat(rateCal)*parseFloat(quantityCal))/100;
            }else{
                var discountTypeCal     = $("#discount_"+x).val();
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
        }
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
        $('#sidebar_point_of_sell_index').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
    </script>

    <script>

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
        var imei            = [];
        var item_id2        = [];
        function newserial()
        {   
            
            var k = $('.getMultipleRow tr:last-child').attr('class').split('_');


            x = k[1];
            []

            var new_serial      = $('#new_item_serial').val();
            var tmp             = 0;
            var stop_op         = 0;

            serial_arr.push(new_serial);

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

                $.get('/pos/check/serial/'+ new_serial, function(data){
                    console.log(data)
                    var item_id             = data.item_id;
                    var item_serial         = data.item_serial;
                    var item_sales_rate     = data.item_sales_rate;
                    var value               = data.value;
                    var item_exist_before   = 0;
                  
                    function checkAdult(checkId) {
                      return checkId >= item_serial;
                    }

                    if(value == 1 )
                    {
                        var new_serial_arr = find_duplicate_in_array(serial_arr);
                        var index_no = new_serial_arr.find(checkAdult)

                        if(index_no >0)
                        {
                           $('#serial_message').text('You have already used the serial in this invoice..!!');
                           $("#serial_message").show();
                           return false;
                        }
                    }

                    //if any item found append new row
                    if(item_id > 0){
                             imei.push(item_serial);
                             item_id2.push(item_id);
                              console.log(imei,'a');
                              $('#ime_no').val(imei);
                              $('#item_ime').val(item_id2);

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
                          if(item_exist_before != 1 ){

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
                                 $('.getMultipleRow').append(`<tr class="tr_`+x+`" >`+`<td>`+`<div class="md-card card-2">
                                     <div class="uk-accordion" data-uk-accordion>

                                       <div  style="padding:13px 10px 13px 10px" class="col-md-12 col-sm-12 col-xs-12">
                                         <select id="item_id_`+x+`" class="md-input  select2-single-search-dropdown single_select2" name="item_id[]" onchange="getItemPrice(`+x+`)" required>


                                        </select>
                                       </div>
                                     </div>
                                     <div class="uk-accordion" data-uk-accordion>
                                      <div class="col-md-2 col-sm-4 col-xs-4">
                                          ImeI:
                                      </div>
                                      <div  class="col-md-10 col-sm-8 col-xs-8">
                                        <input  type="text" id="serial_`+x+`" name="serial[]"  value="`+item_serial+`" class="md-input serial" />
                                      </div>
                                    </div>
                                     <div class="uk-accordion" data-uk-accordion>
                                       <div class="col-md-2 col-sm-4 col-xs-4">
                                            Quanity:
                                       </div>
                                       <div  class="col-md-10 col-sm-8 col-xs-8">
                                         <input  type="text" id="quantity_`+x+`" name="quantity[]" class="md-input quantity" value="1" oninput="calculateActualAmount(`+x+`)" />
                                       </div>
                                     </div>
                                     <div class="uk-accordion" data-uk-accordion>
                                       <div class="col-md-2 col-sm-4 col-xs-4">
                                         Rate :
                                       </div>
                                       <div  class="col-md-10 col-sm-8 col-xs-8">
                                         <input type="text" id="rate_`+x+`" name="rate[]" class="md-input rate" value="0.00" oninput="calculateActualAmount(`+x+`)" required readonly/>
                                       </div>
                                     </div>
                                     <div class="uk-accordion" data-uk-accordion>
                                       <div class="col-md-2 col-sm-4 col-xs-4">
                                            Discount:
                                       </div>
                                       <div  class="col-md-10 col-sm-8 col-xs-8">
                                         <input id="discount_`+x+`" type="text" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount(`+x+`)">
                                       </div>
                                     </div>
                                     <div class="uk-accordion" data-uk-accordion>
                                       <div class="col-md-2 col-sm-4 col-xs-4">
                                            Type:
                                       </div>
                                       <div style="margin-top:3px" class="col-md-10 col-sm-8 col-xs-8">
                                       <select class="md-input discount_type"  id="discount_type_`+x+`" name="discount_type[]" onchange="calculateActualAmount(`+x+`)" class="md-input  select2-single-search-dropdown">
                                           <option value="1" selected>BDT</option>
                                           <option value="0">%</option>
                                       </select>
                                       </div>
                                     </div>
                                     <div class="uk-accordion" data-uk-accordion>
                                       <div class="col-md-2 col-sm-4 col-xs-4">
                                           Amount:
                                       </div>
                                       <div  class="col-md-10 col-sm-8 col-xs-8">
                                         <input type="text" id="amount_`+x+`" name="amount[]" class="md-input amount" value="0" oninput="calculateActualAmount(0)" readonly="readonly" />
                                       </div>
                                     </div>
                                        <div style="display: none" class="uk-accordion" data-uk-accordion>
                                          <select id="account_id_`+x+`" class="md-input accountId select2-single-search-dropdown" name="account_id[]" required>
                                              <option value="" selected>Select Account</option>
                                              @if(!empty($account) && (count($account) > 0))
                                                  @foreach($account as $account_value)
                                                      <option value="{{ $account_value->id }}" {{$account_value->id==16 ? 'selected':''}}>{{ $account_value->account_name }}</option>
                                                  @endforeach
                                              @endif
                                          </select>
                                        </div>
                                        <div  class="">

                                          <div  class="uk-accordion" data-uk-accordion>
                                           <a href="#" style="margin-left:12px" class="remove_field btn btn-danger" data-val="`+x+`"> Delete</a>
                                          </div>
                                        </div>
                                        <br>
                                   </div>`+`</td>`+`</tr>`+`<br>`);
                                   $('.single_select2').select2();

                                    $.get("{{ route('item_list_stock_serial') }}", function(data2){

                                      var list5 = '';
                                      var list7 = '';

                                      $.each(data2, function(i, data2)
                                      {
                                          if(data2.id == item_id){
                                              list5 += '<option value = "' +  data2.id + '" selected>' + data2.item_name +'</option>';

                                                $.get('/invoice/check/item/rate/'+ data2.id, function(data){

                                                    $("#rate_"+x).val(data.item_sales_rate);
                                                    $("#amount_"+x).val(data.item_sales_rate);
                                                    calculateActualAmount(x);
                                                });

                                          }else{
                                              list5 += '<option value = "' +  data2.id + '">' + data2.item_name +'</option>';
                                          }

                                      });

                                      list7 += '<option value = "">' + 'Select Item ' +'</option>';

                                      $("#item_id_"+x).empty();
                                      $("#item_id_"+x).append(list7);
                                      $("#item_id_"+x).append(list5);
                                  });



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
        function find_duplicate_in_array(arra1) {
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
    </script>
   <script type="text/javascript">
 var x = document.getElementById("demo");
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  Latitude  = position.coords.latitude;
  Longitude = position.coords.longitude; 
  $('#lat').val(Latitude);
  $('#long').val(Longitude);
}
   setTimeout(getLocation,300);
   
</script>

    <script type="text/javascript">
        $('#dropdown').on('click',function(){
          $('#custome_hide').empty();
          $('#customer_name_input').hide();
          $('#custome_hide').append(`
            <label   for="customer_name"> Customer Name  </label>
            <select  id="customer_id" title="Select Customer"  name="customer_id" class="md-input single_select2">
            <option value="">Select Name</option>
            @foreach($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->display_name }}</span></option>
            @endforeach
          </select>`);
          $('.single_select2').select2();
        });
    </script>

    <script type="text/javascript">
        function customer_name()
        {
          var bar_code =$('#customer_name_input').val();
          $.get('/pos/customer/name/'+bar_code,function(data){
            $('#customer_name_input').val(data.display_name);
            $('#customer_id').val(data.id);
          });
        }
    </script>
    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
