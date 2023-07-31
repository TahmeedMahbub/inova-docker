@extends('layouts.main')

@section('title', 'Vendor Credit')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Vendor Credit</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            {!! Form::open(['url' => route('vendor_credit_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="customer_name">Vendor Name <span class="uk-badge"><a data-toggle="uk-modal" data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit" class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create Contact</a></span></label> <br>
                                            <select data-uk-tooltip="{pos:'top'}" class="md-input select2-single-search-dropdown" title="Select Customer" id="customer_id" name="vendor_name" required>
                                                <option value="">Select Name</option>
                                                @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" data-vendor="{{ $customer->bills }}">{{ $customer->display_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label for="invoice_number">Vendor credit No</label>
                                            <input class="md-input" type="text" id="vendor_credit_no" value="{{ $vendor_credit_no }}" name="vendor_credit_no" readonly/>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label for="vendor_credit_date">Venodor credit Date</label>
                                            <input class="md-input" type="text" id="bill_date" name="vendor_credit_date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                            <label class="uk-vertical-align-middle" for="customer_name"> Bill No </label> <br>
                                            <select data-uk-tooltip="{pos:'top'}" class="md-input select2-single-search-dropdown" title="Select bill" id="bill_no" name="bill_no">
                                                <option value="">Select Bill</option>
                                                @foreach($bills as $bill)
                                                <option value="{{ $bill->id }}" data-bill-vendor="{{ $bill->customer }}">Bill-{{ $bill->bill_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <a href="{{ route('inventory_create') }}" target="_blank" class="md-btn md-btn-default"style="margin:20px 0px  -30px 0px" >Create New Product/Service </a>
                                    <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                        <div style="overflow:auto" class="uk-width-medium-1-1">
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
                                                        <!-- <th class="uk-text-nowrap">Discount</th> -->
                                                        <!-- <th class="uk-text-nowrap"></th> -->
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
                                                            <select id="item_id_0" class="md-input itemId md-input select2-single-search-dropdown" name="item_id[]" onchange="itemChanged(this, ``); getItemPrice(0); calculatePcsToCtn(this);" required>
                                                            </select>
                                                            <a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, ``)"
                                                            data-uk-modal="{target:'#chooseVariation'}" id="purchase_choose_variation_modal_0" type="submit"
                                                            class="sm-btn sm-btn-primary">
                                                                <span
                                                                class="uk-badge uk-align-center uk-margin-small-top">
                                                                    Choose Variation
                                                                </span>
                                                            </a>
                                                            <input id="selected_variation_0" name="selected_variation[]" type="number" style="display: none" value="">
                                                        </td>
                                                        <td>
                                                            <input type="text" id="description_0" class="md-input description" name="description[]"  oninput="calculateActualAmount(0)" >
                                                        </td>
                                                        <td>
                                                            <input type="text" id="quantity_ctn_0" name="quantity_ctn[]" class="md-input quantity" value="1" oninput="calculateCtnToPcs(this)"/>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="quantity_pcs_0" name="quantity_pcs[]" class="md-input quantity" value="1" oninput="calculateActualAmount(0); calculatePcsToCtn(this)" />
                                                        </td>
                                                        {{-- <td>
                                                            <input  type="text" id="quantity_0" name="quantity[]" class="md-input quantity" value="1" oninput="calculateActualAmount(0)"/>
                                                        </td> --}}
                                                        <td>
                                                           
                                                            <select  id="unit_id_0"  name="unit_id[]" class="select2-single-search-dropdown"
                                                                required >
                                                                <option value="">Select Unit</option>
                                                                @foreach($units as $unit)
                                                                <option value="{{ $unit->id }}">
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
                                                            <input type="text" id="rate_0" name="rate[]" class="md-input rate" value="0.00" oninput="calculateActualAmount(0)" required/>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="amount_0" name="amount[]" class="md-input amount" value="0" oninput="calculateActualAmount(0)" readonly="readonly" />
                                                        </td>
                                                        <td>
                                                            <select id="account_id_0" class="md-input accountId md-input select2-single-search-dropdown" name="account_id[]" required>
                                                                <option value="" selected>Select Account</option>
                                                                @if(!empty($account))
                                                                    @foreach($account as $account_value)
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
                                        <div class="uk-width-medium-2-3" style="overflow:auto" >
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
                                    <div style="display: none;" class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-3-3">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="customer_note"> Note</label>
                                                    <textarea class="md-input" id="note" name="note"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        @if($errors->has('payment_account')|| $errors->has('payment_amount'))
                                        <span style="color:red; position: relative; right:0px; margin: 5px 0px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">{!! "Payment field required" !!}</span>
                                        @endif
                                    </p>
                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
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
    var ajax_data = [];
    var items_chosen = [];
    $( document ).ready(function() {
        $.get("{{route('item_list')}}/", function(data){

            var list2 = '';
            var list4 = '';
            $.each(data, function(i, data)
            {
                ajax_data[data.id] = data;
                list4 += '<option value = "' +  data.id + '">' + data.barcode_no + ', ' + data.item_name +'</option>';
            });

            list2 += '<option value = "">' + 'Select Product/Service  ' +'</option>';

            $("#item_id_0").empty();
            $("#item_id_0").append(list2);
            $("#item_id_0").append(list4);
        });
    });
</script>

<script type="text/javascript">
    function func(x)
    {
        $.get("{{route('item_list',['z'=>''])}}/"+ z, function(data){
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
                '<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="itemChanged(this, ``); getItemPrice('+x+'); calculatePcsToCtn(this);">\n'+ '</select>\n'+
                '</div>\n'+
                '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, ``)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_'+ x +'" type="submit" class="sm-btn sm-btn-primary variation-button">\n'+
                '<span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span>\n</a>\n'+
                '<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value="">'+
                '</td>\n'+
                '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                '<td>\n'+'<input type="text" id="quantity_ctn_'+x+'" class="md-input quantity" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this)"/>\n'+'</td>\n'+
                '<td>\n'+'<input type="text" id="quantity_pcs_'+x+'" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculateActualAmount('+x+'); calculatePcsToCtn(this)"/>\n'+'</td>\n'+
                '<td>\n'+'<select name="unit_id[]" id="unit_id_'+x+'" class="md-input  single_select2"  required>\n'+ '<option value="">Select Unit</option>\n'+ ' @foreach($units as $unit) <option  value="{{ $unit->id }}">{{ $unit->name }}</option> @endforeach</select>\n'+'</td>\n'+

                // '<td>\n'+'<input type="text" id="quantity_'+x+'" class="md-input quantity" name="quantity[]" value="1" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
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

    var total_val =   $("#totalAmount").val();
    var index_no  =   0;
    $('.field_button').on('click',function(e){
     e.preventDefault();
     index_no++;
     $('.add_row').append(
         '<tr class="app_tr_"'+index_no+'>'+
         '<td>'+
         `<input class="md-input" type="text" id="due_date_"`+ index_no +` name="due_date[]" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" />` +
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
    {   var check_due_amount = $('#due_ammount_'+z).val();
    var total_payable    = $('#totalAmount').val();

    var total_amount_val = 0;
    $('.amount_value').each(function(index ,value)
    {
      var t = ($(this).val()==0|| $(this).val() =="") ? 0 : $(this).val();
      total_amount_val += parseFloat(t);
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
        $("#due_date_amount").hide();
    }
    else
    {
      $('#installment').hide(1000);
      $("#due_date_amount").show(100);
  }

}
</script>
<script>
    $('#sidebar_main_account').addClass('current_section');
    $('#vendor_credit_index').addClass('act_item');
    $(window).load(function(){
        $("#tiktok_account").trigger('click');
    });
    $('#customer_id').change(function (e) { 
        e.preventDefault();
        $('#bill_no').empty();
        var vendor_bills = $('#customer_id option:selected').attr('data-vendor') ? JSON.parse($('#customer_id option:selected').attr('data-vendor')) : [];
        $('#bill_no').append(
            '<option value="">Select Bill</option>'
        );
        $.each(vendor_bills, function (indexInArray, bill) { 
            $('#bill_no').append(
                '<option value="'+bill.id+'">Bill-'+bill.bill_number+'</option>'
            );
        });
    });
</script>
<script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
<script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection
