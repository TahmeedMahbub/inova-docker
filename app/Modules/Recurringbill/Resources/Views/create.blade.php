@extends('layouts.main')

@section('title', 'Recurring Bill')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Recurring  Bill</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            {!! Form::open(['url' => route('recurring_bill_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}

                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                      <label class="uk-vertical-align-middle" for="customer_name"> Name <span class="uk-badge"><a data-toggle="uk-modal" data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit" class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create Contact</a></span></label> <br>
                                        <select data-uk-tooltip="{pos:'top'}" class="md-input select2-single-search-dropdown" title="Select Customer" id="customer_id" name="customer_id" required>
                                            <option value="">Select Name</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="invoice_number">Order No</label>
                                        <input class="md-input" type="text" id="order_number" name="order_number"/>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="bill_date">Bill Date</label>
                                        <input class="md-input" type="text" id="bill_date" name="bill_date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-3">
                                        <label for="start_date">Start Date</label>
                                        <input class="md-input" type="text" id="start_date" name="start_date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label for="day_interval">Day Interval</label>
                                        <input class="md-input" type="number" id="day_interval" name="day_interval" required/>
                                    </div>

                                    <div class="uk-width-medium-1-3">
                                        <label for="instance">Instance</label>
                                        <input class="md-input" type="number" id="instance" name="instance" value="" >
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2">
                                        <label for="customer_note">Category<span style="color: red;" class="asterisc">*</span></label> <br>
                                        <select  id="change" name="item_category_id" onchange="func()" class="md-input select2-single-search-dropdown">
                                                <option value=""> Select Category</option>
                                            @foreach($item_category as $value)
                                                <option  value="{{ $value->id }}">{{ $value->item_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uk-width-medium-1-2">
                                        <label for="customer_note">Sub Category<span style="color: red;" class="asterisc">*</span></label> <br>
                                        <select  id="item_sub_category_id" onchange="func()" name="item_sub_category_id" class="md-input select2-single-search-dropdown" selected>
                                        </select>
                                    </div>
                                </div>
                                  <a href="{{ route('inventory_create') }}" target="_blank" class="md-btn md-btn-default"style="margin:20px 0px  -30px 0px" >Create New Product/Service </a>
                                <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1" style="overflow:auto">
                                        <table class="input_fields_wrap uk-table"  cellspacing="0" style="overflow:auto" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="uk-text-nowrap">#</th>
                                                    <th class="uk-text-nowrap" width="20%">Product/Service <span style="color: red;" class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap">Description</th>
                                                    <th class="uk-text-nowrap">Quantity<span style="color: red;" class="asterisc">*</span></th>
                                                    <th class="uk-text-nowrap">Rate<span style="color: red;" class="asterisc">*</span></th>
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
                                                        <select id="item_id_0" class="md-input itemId md-input select2-single-search-dropdown" name="item_id[]" onchange="getItemPrice(0)" required>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <input type="text" id="description_0" class="md-input description" name="description[]"  oninput="calculateActualAmount(0)" >
                                                    </td>

                                                    <td>
                                                        <input  type="text" id="quantity_0" name="quantity[]" class="md-input quantity" value="1" oninput="calculateActualAmount(0)"/>
                                                    </td>

                                                    <td>
                                                        <input type="text" id="rate_0" name="rate[]" class="md-input rate" value="0.00" oninput="calculateActualAmount(0)" required/>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="amount_0" name="amount[]" class="md-input amount" value="0" oninput="calculateActualAmount(0)" readonly="readonly" />
                                                    </td>

                                                    <td>
                                                        <select id="account_id_0" class="md-input accountId md-input select2-single-search-dropdown" name="account_id[]" required>
                                                            <option value="" selected>Select Account</option>
                                                            @if(!empty($account) && (count($account) > 0))
                                                                @foreach($accounts as $account_value)
                                                                    <option value="{{ $account_value->id }}" {{$account_value->id== 26 ? 'selected':''}}>{{ $account_value->account_name }}</option>
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
                                        <table style="display:none;float:right;margin-top:-20px !important;overflow:auto " class="add_table" cellspacing="0" width="100%">
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
                                              <!-- <label for="user_edit_uname_control">Attach Files: </label> -->
                                          </div>
                                          <div class="uk-width-medium-1-1">
                                              <!-- <div class="uk-form-file uk-text-primary"
                                                   style="width: 200px; height: 30px; border-color: #ececec; border-style: dotted; text-align: center; ">
                                                  <p style="margin: 4px;">Upload File</p>
                                                  <input onchange="uploadLavel()" id="form-file" type="file" name="file1">
                                              </div> -->
                                          </div>
                                          <p id="upload_name"></p>
                                      </div>

                                    </div>
                                    <div style="overflow:auto" class="uk-width-medium-2-3">
                                        <table class="uk-table"  cellspacing="0" style="overflow:auto" width="100%">
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
                                                      <input type="text" id="vat" class="md-input md-input-width-medium" value="0.00"  oninput="calculateActualAmount(0)" />
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
                                <div class="uk-grid" data-uk-grid-margin>

                                    <div class="uk-width-medium-3-3">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_note"> Note</label>
                                                <textarea class="md-input" id="customer_note" name="customer_note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <hr>
                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
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
        var item_sub_category_id  = '';
        var item_category_id      = document.getElementById('change').value;
        item_sub_category_id      = $('#item_sub_category_id').val();
        $.get("{{route('item_category_check',['item_category_id'=>''])}}/"+ item_category_id, function(data){
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
            $("#item_sub_category_id").val(item_sub_category_id);
        });

      $.get("{{route('item_list',['item_sub_category_id'=>''])}}/"+ item_sub_category_id, function(data){
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
        $("#due_date_amount").show(1500);
        var total_payable    = $('#totalAmount').val();

        }
        else
        {
             $("#due_date_amount").hide(1500);
        }
       
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
    $('#sidebar_main_account').addClass('current_section');
    $('#sidebar_recurring_bill').addClass('act_item');
    $(window).load(function(){
        $("#tiktok_account").trigger('click');
    });
    altair_forms.parsley_validation_config();
  
   
</script>
<script>
    var date_formate  = function (date_find)
    {
        var today_date       = new Date(date_find);
        var year_find        = today_date.getFullYear().toString();
        var month_find       = (today_date.getMonth() + 1).toString();
        var date_find        = today_date.getDate().toString();
        var next_date_form   = (date_find[1] ? date_find:"0" + date_find[0]) + "-" + (month_find[1] ? month_find:"0" + month_find[0]) + "-" + year_find;

        return next_date_form;
    }
  
</script>
<script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
<script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
