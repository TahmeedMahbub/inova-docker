@extends('layouts.main')

@section('title', 'vendor credit')

@section('header')
@include('inc.header')
@endsection

@section('sidebar')
@include('inc.sidebar')
@endsection

@section('styles')
  <style media="screen">
      span.select2-container{
        z-index: 0 !important;
    }
    .uk-badge a{
        color:white
    }
    input{
        margin-top:10px;
    }
    .getMultipleRow input{
        margin-top:-12px;
    }
  </style>
@endsection

@section('content')
   <div class="uk-grid" >
      <div class="uk-width-large-10-10">
         <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
               <div class="md-card">
                  <div class="user_heading">
                     <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                     </div>
                     <div class="user_heading_content">
                        <h2 class="heading_b"><span class="uk-text-truncate">Edit Vendor Credit</span></h2>
                     </div>
                  </div>
                  <div class="user_content">
                     {!! Form::open(['url' => route('vendor_credit_update',['id'=>$id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                        <div class="uk-margin-top">
                           <div class="uk-grid" data-uk-grid-margin>
                              <div class="uk-width-medium-1-4">
                                 <label class="uk-vertical-align-middle" for="customer_name">Vendor Name <span class="uk-badge"><a data-toggle="uk-modal" data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit" class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create Contact</a></span></label> <br>
                                 <select data-uk-tooltip="{pos:'top'}" class="md-input select2-single-search-dropdown" title="Select Customer" id="customer_id" name="vendor_name" required>
                                    <option value="">Select Name</option>
                                    @foreach($customers as $customer)
                                    <option  value="{{ $customer->id }}" {{ $vendor_credit->vendor_name == $customer->id ? 'selected' : ' ' }}>{{ $customer->display_name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="uk-width-medium-1-4">
                                 <label for="invoice_number">Vendor credit No</label>
                                 <input class="md-input" type="text" id="vendor_credit_no" value="{{ str_pad($vendor_credit->vendor_credit_no,6,0,STR_PAD_LEFT) }}" name="vendor_credit_no" readonly/>
                              </div>
                              <div class="uk-width-medium-1-4">
                                 <label for="vendor_credit_date">Venodor credit Date</label>
                                 <input class="md-input" type="text" id="bill_date" name="vendor_credit_date" value="{{ date('d-m-Y',strtotime($vendor_credit->vendor_credit_date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                              </div>
                              <div class="uk-width-medium-1-4">
                                 <label class="uk-vertical-align-middle" for="customer_name"> Bill No </label> <br>
                                 <select data-uk-tooltip="{pos:'top'}" class="md-input select2-single-search-dropdown" title="Select bill" id="bill_no" name="bill_no">
                                    <option value="">Select Bill</option>
                                    @foreach($bills as $bill)
                                    <option value="{{ $bill->id }}"{{ $vendor_credit->bill_id == $bill->id ? 'selected' : ' ' }}>Bill-{{ $bill->bill_number }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <a href="{{ route('inventory_create') }}" target="_blank" class="md-btn md-btn-default"style="margin:20px 0px  -30px 0px" >Create New Product/Service </a>
                           <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                              <div  class="uk-width-medium-1-1" style="overflow:auto">
                                 <table class="input_fields_wrap uk-table" style="overflow:auto" width="100%" cellspacing="0">
                                    <thead>
                                       <tr>
                                          <th class="uk-text-nowrap">#</th>
                                          <th class="uk-text-nowrap" width="20%">Product/Service <span style="color: red;" class="asterisc">*</span></th>
                                          <th class="uk-text-nowrap">Description</th>
                                          <th class="uk-text-nowrap">Quantity(ctn)<span style="color: red;" class="asterisc">*</span></th>
                                          <th class="uk-text-nowrap">Quantity(pcs)<span style="color: red;" class="asterisc">*</span></th>
                                          <th class="uk-text-nowrap">Unit<span style="color: red;" class="asterisc">*</span></th>
                                          <th class="uk-text-nowrap">Rate<span style="color: red;" class="asterisc">*</span></th>
                                          <th class="uk-text-nowrap">Amount</th>
                                          <th class="uk-text-nowrap" width="20%">Account</th>
                                          <th class="uk-text-nowrap">Action</th>
                                       </tr>
                                    </thead>

                                    <tbody class="getMultipleRow">
                                       @foreach($vendor_credit_entry as $key=>$value)
                                          <tr class="tr_{{$key}}" id="data_clone"  >
                                             <td>
                                                <p style="padding-top: 10px">1</p>
                                             </td>

                                             <td style="width: 200px">
                                                <select id="item_id_{{$key}}" class="md-input itemId md-input select2-single-search-dropdown" name="item_id[]"  onchange="itemChanged(this, ``); getItemPrice({{ $key }}); calculatePcsToCtn(this)" required>
                                                </select>
                                                <a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, '')"
                                                data-uk-modal="{target:'#chooseVariation'}" id="choose_variation_modal_{{ $key }}" type="submit"
                                                class="sm-btn sm-btn-primary variation-button">
                                                      <span
                                                      class="uk-badge uk-align-center uk-margin-small-top">
                                                         Choose Variation
                                                      </span>
                                                </a>
                                                <input id="selected_variation_{{ $key }}" name="selected_variation[]" type="number" style="display: none" value="{{ isset($value->variation_id) ? $value->variation_id : '' }}">
                                                @if ($value->variation_id)
                                                   <div class="uk-text-center" id="variation_badge_container_{{ $key }}">
                                                         <span class="uk-badge uk-text-nowrap" id="variation_badge_{{ $key }}">Selected Variation: {{ $value->itemVariation->variation_name }}</span>
                                                   </div>
                                                @endif
                                             </td>

                                             <td>
                                                <input type="text" id="description_{{$key}}" class="md-input description" name="description[]" value="{{ $value->description }}"  oninput="calculateActualAmount({{$key}})" >
                                             </td>

                                             <td>
                                                <input  type="text" id="quantity_ctn_{{$key}}" name="quantity_ctn[]" class="md-input quantity" value="{{ !empty($value->variation_id) ? ($value->variation->carton_size == 0 ? ($value->item->carton_size == 0 ? 0 : $value->quantity/$value->item->carton_size )  : $value->quantity/$value->variation->carton_size) : ($value->item->carton_size * $value->basic_unit_conversion == 0 ? 0 : $value->quantity / ($value->item->carton_size * $value->basic_unit_conversion)) }}" oninput="calculateCtnToPcs(this); checkOffer({{ $key }})"/>
                                             </td>
                                             
                                             <td>
                                                <input  type="text" id="quantity_pcs_{{$key}}" name="quantity_pcs[]" class="md-input quantity" value="{{ $value->unit_id?$value->quantity/$value->basic_unit_conversion:$value->quantity}}" oninput="calculateActualAmount({{ $key }}); calculatePcsToCtn(this); checkOffer({{ $key }})"/>
                                             </td>
                                             <td>
                                                           
                                                <select  id="unit_id_{{$key}}"  name="unit_id[]" class="select2-single-search-dropdown"
                                                    required >
                                                    <option value="">Select Unit</option>
                                                    @foreach($units as $unit)
                                                    <option value="{{ $unit->id }}"{{$value->unit_id==  $unit->id?'selected':'' }}>
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
                                             <td>
                                                <input type="text" id="rate_{{$key}}" name="rate[]" class="md-input rate" value="{{ $value->rate }}" oninput="calculateActualAmount({{$key}})" required/>
                                             </td>
                                             <td>
                                                <input type="text" id="amount_{{$key}}" name="amount[]" class="md-input amount"  oninput="calculateActualAmount({{$key}})" value="{{ $value->amount }}" readonly="readonly" />
                                             </td>

                                             <td>
                                                <select id="account_id_{{$key}}" class="md-input accountId md-input select2-single-search-dropdown" name="account_id[]" required>
                                                   <option value="" selected>Select Account</option>
                                                   @if(!empty($account))
                                                   @foreach($account as $account_value)
                                                   <option value="{{ $account_value->id }}" {{$account_value->id== 26 ? 'selected':''}}>{{ $account_value->account_name }}</option>
                                                   @endforeach
                                                   @endif
                                                </select>
                                             </td>

                                             <td style="text-align: center">
                                                <a href="#" class="remove_field"><i style="padding-top: 5px" class="material-icons md-36">delete</i></a>
                                             </td>
                                          </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                                 <table style="float:right;margin-top:-20px !important " class="add_table">
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
                                       <label for="user_edit_uname_control">Attach Files: </label>
                                    </div>
                                    <div class="uk-width-medium-1-1">
                                       <div class="uk-form-file uk-text-primary"
                                       style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                          <p style="margin: 4px;">Upload File</p>
                                          <input onchange="uploadLavel()" id="form-file" type="file" name="file1">
                                       </div>
                                    </div>
                                    <p id="upload_name"></p>
                                 </div>
                              </div>
                              <div class="uk-width-medium-2-3" style="overflow:auto">
                                 <table class="uk-table" style="overflow:auto" width="100%" cellspacing="0">
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
                                             <input type="text" id="adjustment" name="adjustment" class="md-input md-input-width-medium" value="{{$vendor_credit->adjustment}}" oninput="calculateActualAmount(0)"/>
                                          </td>
                                          <td style="text-align: right">
                                                <a style="border: none;text-decoration: none;color: black" id="adjustmentShow">0.00</a>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="border-color: white" colspan="3"></td>
                                          <td> Vat/Tax (%)</td>
                                          <td colspan="4">
                                             <input type="text" id="vat" class="md-input md-input-width-medium" value="{{ sprintf('%0.2f', $tax) }}"  oninput="calculateActualAmount(0)" />
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
                                 <input type="hidden" id="totalAmount" name="total">
                                 <input type="hidden" id="vat_total" name="vat_tax">

                              </div>
                           </div>

                           <hr>
                           <div class="uk-grid" data-uk-grid-margin>
                              <div class="uk-width-medium-2-4">
                                 <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                       <label for="customer_note">Personal note</label>
                                       <textarea class="md-input" id="customer_note" name="personal_note" value="">
                                          {{ $vendor_credit->presonal_note }}
                                       </textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="uk-width-medium-2-4">
                                 <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                       <label for="customer_note">Customer note</label>
                                       <textarea class="md-input" id="customer_note" name="customer_note" >
                                       {{ $vendor_credit->customer_note }}
                                       </textarea>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div style="display: none;" class="uk-grid" data-uk-grid-margin>
                              <div class="uk-width-medium-3-3">
                                 <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                       <label for="customer_note"> Note</label>
                                       <textarea class="md-input" id="note" name="note"  > {{ $vendor_credit->note }}</textarea>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <p>
                              @if($errors->has('payment_account')|| $errors->has('payment_amount'))
                              <span style="color:red; position: relative; right:0px; margin: 5px 0px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">{!! "Payment field required" !!}</span>
                              @endif
                           </p>

                           <div class="uk-grid" data-uk-grid-margin>
                              <div class="uk-width-1-1 uk-text-right">
                                 <button type="submit" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" value="Submit" name="submit">Submit</button>
                              </div>
                           </div>
                        </div>
                     {!! Form::close() !!}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@section('scripts')
<script type="text/javascript">
   function func(x)
   {
      $.get("{{route('item_list')}}/", function(data){
         var list2 = '';
         var list4 = '';
         $.each(data, function(i, data)
         {
            list4 += '<option value = "' +  data.id + '">' + data.barcode_no + ', ' + data.item_name +'</option>';
         });

         list2 += '<option value = "">' + 'Select Product/Service  ' +'</option>';
         $("#item_id_0").empty();
         $("#item_id_0").append(list2);
         $("#item_id_0").append(list4);
      });
   }
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

         $.get("{{route('item_list')}}/", function(data){

            var list5 = '';
            var list7 = '';

            $.each(data, function(i, data)
            {
               list5 += '<option value = "' +  data.id + '">' + data.barcode_no + ', ' + data.item_name +'</option>';
            });

            list7 += '<option value = "">' + 'Select Product/Service  ' +'</option>';

            $("#item_id_"+x).empty();
            $("#item_id_"+x).append(list7);
            $("#item_id_"+x).append(list5);
         });


         $('.getMultipleRow').append( ' ' +'<tr class="tr_'+x+'">'+
            '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+
            '<td style="width: 200px">\n'+
            '<div class="md-input-wrapper md-input-filled md-input-wrapper-success">\n'+
            '<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="itemChanged(this, ``); getItemPrice('+ x +'); calculatePcsToCtn(this)">\n'+ '</select>\n'+
            '</div>\n'+
            '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, ``)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_'+ x +'" type="submit" class="sm-btn sm-btn-primary variation-button">\n'+
            '<span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span>\n</a>\n'+
            '<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value="">'+
            '</td>\n'+
            '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
            '<td>\n'+'<input type="text" id="quantity_ctn_'+x+'" class="md-input quantity" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer('+x+')"/>\n'+'</td>\n'+
            '<td>\n'+'<input type="text" id="quantity_pcs_'+x+'" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculateActualAmount('+x+'); calculatePcsToCtn(this); checkOffer('+x+')"/>\n'+'</td>\n'+
            '<td>\n'+'<select name="unit_id[]" id="unit_id_'+x+'" class="md-input  single_select2"  required>\n'+ '<option value="">Select Unit</option>\n'+ ' @foreach($units as $unit) <option  value="{{ $unit->id }}">{{ $unit->name }}</option> @endforeach</select>\n'+'</td>\n'+

            '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
            // '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
            // '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
            '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
            '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($account as $account_all) <option {{ $account_all->id== 26 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
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
      var quantity                = $("#quantity_pcs_"+x).val();
      var discount                = $("#discount_"+x).val();
      var adjustment              = $("#adjustment").val();
      var vat                     = $("#vat").val();
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
         var quantityCal         = $("#quantity_pcs_"+x).val();
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
      }else{
         var vat_value                = (parseFloat(adjustment_show) +  (parseFloat(subTotal)*parseFloat(vat))/100);
         var vat                      = (parseFloat(adjustment_show) * parseFloat(vat))/100 ;
      }
      $("#vatShow").html(vat);
      $("#vat_total").val(vat);

      var total_amount     = parseFloat(subTotal) + parseFloat(vat) + parseFloat(adjustment_value);
        //Calculating Total Amount end
      $("#totalAmountShow").html(total_amount);
      $("#totalAmount").val(total_amount);


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
   });
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
<script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
<script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
<script type="text/javascript">
   $('#sidebar_main_account').addClass('current_section');
   $('#vendor_credit_index').addClass('act_item');
   $(window).load(function(){
      $("#tiktok_account").trigger('click');
   });
</script>
<script type="text/javascript">

   var ajax_data       = [];
   var items_chosen    = [];
   var vendorCreditEntries =  <?php echo $vendor_credit_entry; ?>;

   $.each(vendorCreditEntries, function (indexInArray, vendor_credit_entry) {
      items_chosen[indexInArray] = vendor_credit_entry.item;
      items_chosen[indexInArray]['variation_id'] = vendor_credit_entry.variation_id;
      items_chosen[indexInArray]['variations'] = [];
   });
   $('#document').ready(function(){ 

      var list2             = '';
      var list4             = '';
      var selected_tmp      = 0;

      var total_val         = 0;
      var total_inv_amount  = 0;

      $.each(vendorCreditEntries, function(i, data_val)
      {
         //Initially show the items for all apended index start
         $.get("{{route('item_list')}}/", function(data){

            var list2 = '';
            var list4 = '';

            $.each(data, function(j, data)
            {
               ajax_data[data.id] = data;
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
                  list2 += '<option value = "' +  data.id + '" selected>' + data.barcode_no + ', ' + data.item_name +'</option>';
               }
               else
               {
                  list2 += '<option value = "' +  data.id + '">' + data.barcode_no + ', ' + data.item_name +'</option>';
               }
               $("#item_id_"+i).empty();
               $("#item_id_"+i).append(list4);
               $("#item_id_"+i).append(list2);
            });
            selected_tmp = 0;
         });

         $.each(items_chosen, function (indexInArray, item_chosen) {
            $.get("/api/inventory/check-variation/"+item_chosen.id, function (data) {
               $.each(data.variations, function (indexInArrayOfVariation, variation) {
                  items_chosen[indexInArray]['variations'][variation.id] = variation;
               });
            });
         });
      });
   });
</script>
<script type="text/javascript">
   setTimeout( calculateActualAmount(),3);
</script>

@endsection
