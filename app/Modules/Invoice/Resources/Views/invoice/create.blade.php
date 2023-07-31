@extends('layouts.main')

@section('title', 'Invoice')

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

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('invoice_store'), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}
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
                                        <div class="uk-width-medium-1-4">
                                          <label for="branch_id">Branch</label> <br>
                                            <select class="md-input select2-single-search-dropdown" title="Select Branch" id="branch_id" name="branch_id">
                                                <option value="">Select Branch</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}">
                                                        {{ $branch->branch_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('branch_id'))
                                                <span class="error" style="color: red">
                                                    {{ $errors->first('branch_id') }}
                                                </span>                                                
                                            @endif
                                        </div>
                                        <div class="uk-width-medium-1-4">
                                          <label  for="customer_name">Name &nbsp <span class="uk-badge"><a data-toggle="uk-modal" data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit" class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create Contact</a></span> </label> <br>
                                            <select  class="md-input select2-single-search-dropdown" title="Select Customer" id="customer_id" name="customer_id">
                                                <option value="">Select Name</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" data-customer-credit-note="{{ $customer->creditNotes->sum('available_credit') }}" data-customer-excess-payment="{{ $customer->paymentReceives->sum('excess_payment') }}">
                                                        {{ $customer->display_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('customer_id'))
                                                <span class="error" style="color: red">
                                                    {{ $errors->first('customer_id') }}
                                                </span>                                                
                                            @endif
                                        </div>

                                        <div class="uk-width-medium-1-4">
                                            <label for="invoice_date">Select Invoice date</label>
                                            <input class="md-input" type="text" id="invoice_date" name="invoice_date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                        </div>

                                        <div class="uk-width-medium-1-4">
                                            <label for="invoice_date">Reference</label>
                                            <input class="md-input" type="text" id="reference" name="reference">
                                        </div>

                                        <div class="uk-width-medium-1-4 hidden">
                                            <label for="invoice_date">Add New Item By Serial</label>
                                            <input class="md-input" type="text" id="new_item_serial" onfocusout="newserial()" name="new_item_serial">
                                              <p id = "serial_message" style = "color: red; font-weight: bold; display: none;"></p>
                                        </div>
                                    </div>

                                    <a href="{{ route('inventory_create') }}" target="_blank" class="md-btn md-btn-default"style="margin:20px 0px  -30px 0px" >Create New Product/Service </a>

                                    <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1 uk-overflow-container">
                                            <table class="input_fields_wrap uk-table">
                                                <thead>
                                                    <tr>
                                                        <th class="uk-text-nowrap">#</th>
                                                        <th class="uk-text-nowrap"width="20%">Product/Service <span style="color: red;" class="asterisc">*</span></th>
                                                        <th class="uk-text-nowrap hidden">Serial No</th>
                                                        <th class="uk-text-nowrap">Description</th>
                                                        <th class="uk-text-nowrap">Quantity(ctn)<span style="color: red;" class="asterisc">*</span></th>
                                                        <th class="uk-text-nowrap">Quantity(pcs)<span style="color: red;" class="asterisc">*</span></th>
                                                        <th class="uk-text-nowrap">Unit<span style="color: red;" class="asterisc">*</span></th>
                                                        <th class="uk-text-nowrap" style="min-width: 120px">Rate<span style="color: red;" class="asterisc">*</span></th>
                                                        <th class="uk-text-nowrap">Discount</th>
                                                        <th class="uk-text-nowrap" style="min-width: 85px"></th>
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
                                                            <select id="item_id_0" class="md-input itemId select2-single-search-dropdown" name="item_id[]" onchange="itemChanged(this, `sales`); getItemPrice(0); calculatePcsToCtn(this)" required>

                                                            </select>
                                                            <a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `sales`)"
                                                            data-uk-modal="{target:'#chooseVariation'}" id="choose_variation_modal_0" type="submit"
                                                            class="sm-btn sm-btn-primary variation-button">
                                                                <span
                                                                class="uk-badge uk-align-center uk-margin-small-top">
                                                                    Choose Variation
                                                                </span>
                                                            </a>
                                                            <input id="selected_variation_0" name="selected_variation[]" type="number" style="display: none" value="">
                                                            @if ($errors->has('item_id.*'))
                                                                <span class="error" style="color: red">
                                                                    {{ $errors->first('item_id.0') }}
                                                                </span>
                                                                
                                                            @endif
                                                        </td>
                                                        <td class="hidden">
                                                            <input  type="text" id="serial_0" name="serial[]" class="md-input serial" value="" />
                                                        </td>
                                                        <td>
                                                            <input type="text" id="description_0" class="md-input description" name="description[]">
                                                        </td>

                                                        <td>
                                                            <input type="text" id="quantity_ctn_0" name="quantity_ctn[]" class="md-input" value="1" oninput="calculateCtnToPcs(this); checkOffer(0)"/>
                                                            @if ($errors->has('quantity_ctn.*'))
                                                                <span class="error" style="color: red">
                                                                    Quantity is required
                                                                </span>                                                                
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <input  type="text" id="quantity_pcs_0" name="quantity_pcs[]" class="md-input quantity" value="1" oninput="calculateActualAmount(0); calculatePcsToCtn(this); checkOffer(0)" />
                                                            @if ($errors->has('quantity_pcs.*'))
                                                                <span class="error" style="color: red">
                                                                    Quantity is required
                                                                </span>                                                                
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{-- <input type="text" id="unit_id_0"  name="unit_id[]"> --}}
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
                                                            <div style="position: relative">
                                                                <input type="text" id="rate_0" name="rate[]" class="md-input rate" value="0.00" oninput="calculateActualAmount(0)" required/>
                                                                <select name="rate_type[]" id="rate_type_0" style="position: absolute; right: -5px; top: -5px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount(0)">
                                                                    <option value="0">pcs</option>
                                                                    <option value="1">ctn</option>
                                                                </select>
                                                                @if ($errors->has('rate.*'))
                                                                    <span class="error" style="color: red">
                                                                        {{ $errors->first('rate.0') }}
                                                                    </span>                                                                    
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <input id="discount_0" type="text" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount(0)">
                                                        </td>

                                                        <td>
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
                                        <div class="uk-width-medium-1-2 uk-margin-small-top uk-margin-medium-bottom">
                                            <div class="uk-grid">
                                                <div class="uk-width-4-5">
                                                    <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa; ">
                                                        Add New Payment
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-5"
                                                    style="padding: 10px; height: 40px; position:relative;background: #2991fa ">
                                                    <div id="inv_0" style="position: absolute; right: 10px; height: 40px; ">
                                                        <input {{ old('check_payment')?"checked":'' }} type="checkbox"
                                                            name="check_payment" id="check_payment"
                                                            style=" margin-top: -1px; height: 25px; width: 20px;" onchange="calculateActualAmount(0)" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" style="{{ old('check_payment') == 'on' ? '' : 'display: none' }};" id="payment_details">
                                                <div class="uk-width-1-1">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="payment_amount">Amount</label>
                                                            <input class="md-input" type="text" id="payment_amount"
                                                                name="payment_amount" value="{{ old(" payment_amount") }}" oninput="calculateActualAmount(0)" />
                                                        </div>
                                                        
                                                        <div class="uk-width-medium-1-2">
                                                            <label class="uk-vertical-align-middle" for="payment_account">Paid Through
                                                                <span style="color:red">*</span></label> <br>
                                                                
                                                            <select name="payment_account" id="payment_account"
                                                                class="md-input select2-single-search-dropdown"
                                                                data-uk-tooltip="{pos:'top'}" title="Select Account" onchange="paymentTypeChanged()">
                                                                <option value="" disabled selected hidden>Select...</option>
                                                                @foreach($accounts as $value)
                                                                    @if(empty(old('payment_account')) && $value->id==3)
                                                                        <option data-account-type="{{ $value->account_type_id }}" selected value="{{ $value->id }}">{{ $value->account_name }}
                                                                        </option>
                                                                    @else
                                                                        <option data-account-type="{{ $value->account_type_id }}" value="{{ $value->id }}" {{ $value->id == old('payment_account') ? 'selected' : '' }}>{{ $value->account_name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="uk-width-medium-1-2 uk-margin-medium-top" id="cheque_number_container" style="{{ !empty(old('payment_account')) && $accounts->where('id', old('payment_account'))->first()->account_type_id == 5 ? '' : 'display:none' }}">
                                                            <label for="cheque_number">Cheque Number</label>
                                                            <input class="md-input" type="number" id="cheque_number"
                                                                name="cheque_number" value="{{ old("cheque_number") }}"/>
                                                            @if ($errors->has('cheque_number'))
                                                                <span class="uk-text-danger">{{ $errors->first('cheque_number') }}</span>
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="uk-width-medium-1-2 uk-margin-medium-top" id="issue_date_container" style="{{ !empty(old('payment_account')) && $accounts->where('id', old('payment_account'))->first()->account_type_id == 5 ? '' : 'display:none' }}">
                                                            <label for="issue_date">Issue Date</label>
                                                            <input class="md-input" type="text" id="issue_date"
                                                                name="issue_date" value="{{ old("issue_date") }}" data-uk-datepicker="{format:'DD-MM-YYYY'}"/>
                                                            @if ($errors->has('issue_date'))
                                                                <span class="uk-text-danger">{{ $errors->first('issue_date') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div style="display: none;" id="show" class="uk-grid">
                
                                                        <div class="uk-width-medium-1-1">
                                                            <label class="uk-vertical-align-middle"
                                                                for="payment_deposit_details">Details</label>
                                                            <input class="md-input" type="text" id="payment_deposit_details"
                                                                name="payment_deposit_details" value="{{ old(" payment_deposit_details")
                                                                }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-4-5">
                                                    <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa; ">
                                                        Adjust from Advance Payments
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-5"
                                                    style="padding: 10px; height: 40px; position:relative;background: #2991fa ">
                                                    <div id="inv_1" style="position: absolute; right: 10px; height: 40px; ">
                                                        <input {{ old('check_payment_advance')?"checked":'' }} type="checkbox"
                                                            name="check_payment_advance" id="check_payment_advance"
                                                            style=" margin-top: -1px; height: 25px; width: 20px;" onchange="calculateActualAmount(0)" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" style="{{ old('check_payment_advance') == 'on' ? '' : 'display: none' }}" id="advance_details">
                                                <div class="uk-width-1-1">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="payment_available_amount_advance">Available Amount</label>
                                                            <input class="md-input" type="number" id="payment_available_amount_advance"
                                                                name="payment_available_amount_advance" value="0" disabled/>
                                                        </div>
                
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="payment_amount_advance">Use Available Amount</label>
                                                            <input class="md-input" type="text" id="payment_amount_advance"
                                                                name="payment_amount_advance" value="{{ old(" payment_amount_advance") }}" oninput="calculateActualAmount(0)"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-4-5">
                                                    <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa; ">
                                                        Adjust from Vendor Credit
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-5"
                                                    style="padding: 10px; height: 40px; position:relative;background: #2991fa ">
                                                    <div id="inv_2" style="position: absolute; right: 10px; height: 40px; ">
                                                        <input {{ old('check_payment_vendor_credit')?"checked":'' }} type="checkbox"
                                                            name="check_payment_vendor_credit" id="check_payment_vendor_credit"
                                                            style=" margin-top: -1px; height: 25px; width: 20px;" onchange="calculateActualAmount(0)" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" style="{{ old('check_payment_vendor_credit') == 'on' ? '' : 'display: none' }}" id="vendor_credit_details">
                                                <div class="uk-width-1-1">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="credit_available_amount_advance">Available Amount</label>
                                                            <input class="md-input" type="number" id="credit_available_amount_advance"
                                                                name="credit_available_amount_advance" value="0" disabled/>
                                                        </div>
                
                                                        <div class="uk-width-medium-1-2">
                                                            <label for="credit_amount_advance">Use Available Credit Amount</label>
                                                            <input class="md-input" type="text" id="credit_amount_advance"
                                                                name="credit_amount_advance" value="{{ old(" credit_amount_advance") }}" oninput="calculateActualAmount(0)"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" style="{{ old('check_payment_vendor_credit') == 'on' || old('check_payment_advance') == 'on' ? '' : 'display: none' }}" id="available_balance">
                                                <div class="row" style="width: 100%">
                                                    <div class="col-sm-6">
                                                        <strong>Balance: </strong> <span id="total_available_balance" style="font-size: 16px">0</span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <strong>Adjusted Amount: </strong> <span id="adjusted_amount" style="font-size: 16px">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-width-medium-1-2 uk-overflow-container">
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
                                                    <td>Discount</td>
                                                    <td style="width: 10%;">
                                                          <div class="md-input-wrapper md-input-filled"><select style="padding-top: 19px;" class="md-input adjustment_type" id="adjustment_type" name="adjustment_type" onchange="calculateActualAmount(0)">
                                                              <option value="1">BDT</option>
                                                              <option value="0">%</option>
                                                          </select><span class="md-input-bar "></span></div>
                                                    </td>
                                                    <td colspan="3">
                                                        <div class="md-input-wrapper md-input-filled"><input type="text" id="adjustment" name="adjustment" class="md-input md-input-width-medium" value="0.00" oninput="calculateActualAmount(0)"><span class="md-input-bar "></span></div>
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
                                                    <tr>
                                                        <td style="border-color: white" colspan="3"></td>
                                                        <th colspan="5">Paid Amount(BDT)</th>
                                                        <th style="text-align: right">
                                                            <a style="border: none;text-decoration: none;color: black" id="totalPaidAmount">0.00</a>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-color: white" colspan="3"></td>
                                                        <th colspan="5">Due Amount(BDT)</th>
                                                        <th style="text-align: right">
                                                            <a style="border: none;text-decoration: none;color: black" id="totalDueAmount">0.00</a>
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <input type="hidden" id="subTotal" name="sub_total">
                                            <input type="hidden" id="totalAmount" name="total_amount">
                                            <input type="hidden" id="paidAmount" name="paid_amount">
                                            <input type="hidden" id="dueAmount" name="due_amount">
                                            <input type="hidden" id="vat_total" name="tax_total">
                                        </div>
                                    </div>
                                    
                                    <div class="uk-grid" style="display: none" id="free_entry_header">
                                        <div class="uk-width-1-1">
                                            <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2 ">
                                                Offers & Free Products
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-grid" style="display: none" id="free_entry_details">
                                        <div class="uk-width-1-1" >
                                            <div class="uk-grid uk-margin-large-bottom" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <table class="uk-table">
                                                        <thead>
                                                        <tr>
                                                            <th class="uk-text-nowrap">SL</th>
                                                            <th class="uk-text-nowrap">Offer Details</th>
                                                            <th class="uk-text-nowrap">Base Product</th>
                                                            <th class="uk-text-nowrap">Free Product</th>
                                                            <th class="uk-text-nowrap">Free Quantity</th>
                                                            <th class="uk-text-nowrap">Offer Amount</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="getFreeEntryRow">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="customer_note">Note</label>
                                                    <textarea class="md-input" id="customer_note" name="personal_note"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2 uk-margin-medium-top">
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

                                        {{-- <div class="uk-width-medium-2-4">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="customer_note">Customer note</label>
                                                    <textarea class="md-input" id="customer_note" name="customer_note"></textarea>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>

                                    {{-- <div class="uk-grid" data-uk-grid-margin>
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
                                                        <i style="padding-top: 10px" class="material-icons md-36">&#xE146;</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <p>
                                        @if($errors->has('payment_account')|| $errors->has('payment_amount'))

                                            <span style="color:red; position: relative; right:0px; margin: 5px 0px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">{!! "Payment field required" !!}</span>

                                        @endif
                                    </p>

                                    <div class="uk-grid" >
                                        <div class="uk-width-1-2 uk-width-small-*" >
                                            <div style=" padding:10px;height: 40px; color: white; background-color: #2D2D2D ">
                                                Payment Receive
                                            </div>

                                        </div>
                                        <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: #2D2D2D ">
                                            <div id="inv" style="position: absolute; right: 10px; height: 40px; ">
                                                <input {{ old('check_payment')?"checked":'' }} type="checkbox" name="check_payment" id="check_payment" style=" margin-top: -1px; height: 25px; width: 20px;" />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="uk-grid" style="display: none;" id="payment_details">
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

                                    <hr> --}}

                                    <div class="uk-grid uk-text-right" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="button" class="uk-margin-small-top md-btn md-btn-flat uk-modal-close">Close</button>
                                            <input type="submit" id="submitStock" class="md-btn md-btn-primary" value="submit" name="submit" />
                                            <!-- <input type="submit" class="md-btn md-btn-success" value="save" name="save" /> -->

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
        altair_forms.parsley_validation_config();
    </script>

    <script type="text/javascript">
        var ajax_data        = [];
        var items_chosen     = [];
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
                        list5 += '<option value = "' +  data.id + '">' + data.item_name +'</option>';

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
                            '<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="itemChanged(this, `sales`); getItemPrice('+x+'); calculatePcsToCtn(this)" required>\n'+ '</select>\n'+
                            '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `sales`)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_'+x+'" type="submit"'+
                            'class="sm-btn sm-btn-primary variation-button"><span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span></a>'+
                        '<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value=""></div>\n'+
                    '</td>\n'+
                    '<td class="hidden">'+
                    '<input  type="text" id="serial_'+x+'" name="serial[]"  value="" class="md-input serial" />'+
                    '</td>'+
                    '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" />\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_ctn_'+x+'" class="md-input" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer('+x+')"/ >\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_pcs_'+x+'" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculateActualAmount('+x+'); calculatePcsToCtn(this); checkOffer('+x+')"/ >\n'+'</td>\n'+
                    '<td>\n'+'<select name="unit_id[]" id="unit_id_'+x+'" class="md-input  single_select2"  required>\n'+ '<option value="">Select Unit</option>\n'+ ' @foreach($units as $unit) <option  value="{{ $unit->id }}">{{ $unit->name }}</option> @endforeach</select>\n'+'</td>\n'+

                    '<td>\n'+
                    '<div style="position: relative">\n<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')" required/>\n'+
                    '<select name="rate_type[]" id="rate_type_'+x+'" style="position: absolute; right: -5px; top: 12px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount('+x+')">\n'+
                    '<option value="0">pcs</option><option value="1">ctn</option></select></div>'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($account as $account_all) <option {{$account_all->id==16 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
                    '<td style="text-align: center">\n'+'<a href="#" data-val="'+x+'" class="remove_field" onclick="rowRemoved('+x+')">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
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
            var serial_input_value   = $("#serial_"+serial_no_of_tr).val();

            if(serial_input_value != 'undefined')
            {
                var serial_input_value   = serial_input_value.split(",");
    
                for(var j = 0; j < serial_input_value.length; j++)
                {
                    for( var i = 0; i < serial_arr.length; i++)
                    {
                        if ( serial_arr[i] == serial_input_value[j])
                        {
                            serial_arr.splice(i, 1);
                            i--;
                        }
                    }
                }  
            }

            $(this).parent().parent().remove(); x--;
            
            calculateActualAmount();
        });

        function getItemPrice(x)
        {
            //For getting item commission information from items table start
            var item_id  = $("#item_id_"+x).val();     
            if(item_id){
                var url = "{{ route('check-variation', ':id') }}";
                url = url.replace(':id', item_id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function (data) {
                        $("#rate_"+x).val(0.00);
                        $("#amount_"+x).val(0.00);
                        calculateActualAmount(x);
                        UIkit.notify({
                            message: 'Please select a Variation',
                            status: 'warning',
                            timeout: 2000,
                            pos: 'top-right'
                        });
                    },
                    error: function(data){                    

                        $("#rate_"+x).val(ajax_data[item_id]['item_sales_rate'] == null || ajax_data[item_id]['item_sales_rate'] == '' ? 0.00 : ajax_data[item_id]['item_sales_rate']);
                        $("#amount_"+x).val(ajax_data[item_id]['item_sales_rate'] == null || ajax_data[item_id]['item_sales_rate'] == '' ? 0.00 : ajax_data[item_id]['item_sales_rate']);
                        calculateActualAmount(x);
                    }
                });
            }
            //For getting item commission information from items table end
        }

        function calculateActualAmount(x)
        {
            var rate                    = $("#rate_"+x).val();
            var quantity                = $("#quantity_pcs_"+x).val();
            var quantity_cartoon        = $("#quantity_cartoon_"+x).val();
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
                var quantityCal         = $("#quantity_pcs_"+x).val();
            }

            if (quantity_cartoon == '' || quantity_cartoon == 0)
            {
                var quantityCtnCal         = 1;
            }else{
                var quantityCtnCal         = $("#quantity_ctn_"+x).val();
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


            var amount = ($('#rate_type_'+x).val() == 0 ? ((parseFloat(rateCal)*parseFloat(quantityCal)) - (parseFloat(discountTypeCal))) : (parseFloat(rateCal)*parseFloat(quantityCtnCal)) - (parseFloat(discountTypeCal))).toFixed(2);
            

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
                var adjustment_show     = 0;
            }else{
                var adjustment_value    = $('#adjustment_type').val() == 0 ? subTotal * adjustment / 100 : adjustment;
                var adjustment_show     = parseFloat(subTotal) - parseFloat(adjustment_value);
            }

            var payment_amount = $('#check_payment').is(':checked') && $('#payment_amount').val() != '' ? $('#payment_amount').val() : 0;
            var payment_advance = $('#check_payment_advance').is(':checked') && $('#payment_amount_advance').val() != '' ? $('#payment_amount_advance').val() : 0;
            var payment_vendor_credit = $('#check_payment_vendor_credit').is(':checked') && $('#credit_amount_advance').val() != '' ? $('#credit_amount_advance').val() : 0;

            $('#adjusted_amount').html(parseFloat(payment_advance) + parseFloat(payment_vendor_credit));
            $('#totalPaidAmount').html((parseFloat(payment_amount) + parseFloat(payment_advance) + parseFloat(payment_vendor_credit)).toFixed(2));
            $('#paidAmount').val((parseFloat(payment_amount) + parseFloat(payment_advance) + parseFloat(payment_vendor_credit)).toFixed(2));

            if(vat =='' || vat ==0.00)
            {
                var vat_val     = 0;
                var vat_show    = 0;
                var vat_cal     = 0;
            }
            else {
                var vat_val     =  vat;
                var vat_cal     =  ((parseFloat(subTotal) - parseFloat(adjustment_value)) * parseFloat(vat_val))/100;
                var vat_show    = parseFloat(vat_cal) + parseFloat(subTotal);
            }
            if(shippingCharge =='' || shippingCharge ==0.00)
            {
                var shippingCharge_val  = 0;
                var shippingCharge_show = 0;
            }
            else {
                var shippingCharge_val  =  shippingCharge;
                var shippingCharge_show = parseFloat(shippingCharge_val)+parseFloat(vat_cal)+parseFloat(subTotal)-parseFloat(adjustment_value);
            }

            var total_amount     = parseFloat(shippingCharge_val)+parseFloat(vat_cal)+parseFloat(subTotal)-parseFloat(adjustment_value);

            $("#adjustmentShow").html(-adjustment_value);
            $("#vatShow").html(vat_cal);
            $("#vat_total").val(vat_cal);
            $("#shippingChargeShow").html(shippingCharge_val);
            $("#totalAmountShow").html(total_amount.toFixed(2));
            $("#totalAmount").val(total_amount.toFixed(2));            
            $('#totalDueAmount').html((parseFloat(total_amount) - parseFloat(payment_amount) - parseFloat(payment_advance) - parseFloat(payment_vendor_credit)).toFixed(2));
            $('#dueAmount').val((parseFloat(total_amount) - parseFloat(payment_amount) - parseFloat(payment_advance) - parseFloat(payment_vendor_credit)).toFixed(2));

            total_val =  total_amount ;

            if(total_val > 0)
            {
                $("#due_date_amount").show(2000);
                var total_payable    = $('#totalAmount').val();
            }
            else
            {
                $("#due_date_amount").hide(2000);
            }

            // commissionAmount();
            // installment();
        }

        // function commissionAmount()
        // {
        //     var commission_amount = $('#commission').val();
        //     var commission_type   = $('#commission_type').val();

        //     var sub_total       = $('#subTotal').val();
        //     var adjustment      = $('#adjustment').val();

        //     if(adjustment == 0|| adjustment =='')
        //     {
        //         adjustment = 0;
        //     }

        //     sub_total = parseFloat(adjustment) + parseFloat(sub_total);

        //     if(commission_type == 1){
        //         var com = commission_amount;
        //     }
        //     else{
        //         if(commission_amount >= 100)
        //             var com = sub_total;
        //         else
        //             var com = (parseFloat(sub_total) * parseFloat(commission_amount))/100;
        //     }

        //     if(isNaN(com)){
        //         $('#agentcommissionAmount').val(0);
        //     }
        //     else
        //     {
        //         $('#agentcommissionAmount').val(Number(com).toFixed(2));
        //     }
        // }

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

        $('#sidebar_invoice').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
        $( document ).ready(function() {
            $.get("{{route('item_list')}}/", function(data){
                
                var list2 = '';
                var list4 = '';
                $.each(data, function(i, data)
                {
                    ajax_data[data.id] = data;
                    list4 += '<option value = "' +  data.id + '">' + data.item_name +'</option>';
                });
    
                list2 += '<option value = "">' + 'Select Product/Service  ' +'</option>';
    
                $("#item_id_0").empty();
                $("#item_id_0").append(list2);
                $("#item_id_0").append(list4);
            });
        });

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

                    if(value == 1 )
                    {
                        var new_serial_arr = find_duplicate_in_array(serial_arr);
                        var index_no = new_serial_arr.find(checkDuplicateSerial)

                        if(index_no >0)
                        {
                           $('#serial_message').text('You have already used the serial in this invoice..!!');
                           $("#serial_message").show();
                           return false;
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
                                '<td style="width: 200px">\n'+
                                    '<div class="md-input-wrapper md-input-filled md-input-wrapper-success">\n'+
                                        '<select id="item_id_'+x+'" class="md-input itemId single_select2" name="item_id[]" onchange="getItemPrice('+x+'); calculatePcsToCtn(this); itemChanged(this, `sales`)">\n'+ '</select>\n'+
                                        '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `sales`)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_'+x+'" type="submit"'+
                                        'class="sm-btn sm-btn-primary variation-button"><span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span></a>'+
                                    '<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value=""></div>\n'+
                                '</td>\n'+
                                '<td class="hidden">'+'<input  type="text" id="serial_'+x+'" value="'+item_serial+'" name="serial[]" class="md-input serial"  />'+'</td>'+
                                '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="quantity_ctn_'+x+'" class="md-input" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer('+x+')"/ >\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="quantity_pcs_'+x+'" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculateActualAmount('+x+'); calculatePcsToCtn(this); checkOffer(0)"/ >\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
                                '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                                '<td>\n'+'<select id="account_id_'+x+'" class="md-input accountId single_select2" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($account as $account_all) <option {{$account_all->id==16 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+'</td>\n'+
                                '<td style="text-align: center">\n'+'<a href="#" data-val="'+x+'" class="remove_field" onclick="rowRemoved('+x+')">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                            '</tr>\n');

                                $('.single_select2').select2();

                                calculateActualAmount(x);

                                $('#new_item_serial').val('');

                            }

                        }else{
                            var total_amount    = 0;
                            var cur_rate        = $('#rate_'+x).val();
                            var cur_qty         = parseInt($('#quantity_pcs_'+x).val());

                            $('#quantity_pcs_'+x).val(cur_qty + 1);

                            cur_qty             = $('#quantity_pcs_'+x).val();

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

        $('#customer_id').change(function (e) { 
            e.preventDefault();
            var customer_credit_note_amount = $('#' + $(this).attr('id') + ' option:selected').attr('data-customer-credit-note');
            var customer_excess_payment_amount = $('#' + $(this).attr('id') + ' option:selected').attr('data-customer-excess-payment');
            $("#credit_available_amount_advance").val(customer_credit_note_amount);
            $('#credit_amount_advance').attr('max', customer_credit_note_amount);
            $("#payment_available_amount_advance").val(customer_excess_payment_amount);
            $('#payment_amount_advance').attr('max', customer_excess_payment_amount);
            var total_available_amount = parseFloat(customer_excess_payment_amount) + parseFloat(customer_credit_note_amount);
            $('#total_available_balance').html(total_available_amount);
        });
        
        function paymentTypeChanged(){
            if($('#payment_account option:selected').data('account-type') == 5){
                $('#cheque_number_container, #issue_date_container').show(800);
                $('#cheque_number_container, #issue_date_container').attr('required', true);
            }else{
                $('#cheque_number_container, #issue_date_container').hide(800);
                $('#cheque_number_container, #issue_date_container').attr('required', false);
                $('#cheque_number_container input, #issue_date_container input').val('');
            }
        }

        // function installment()
        // {
        //     $('#install_due_date').empty();
        //     var time_int             = 0;
        //     var no_of_installment    = $('#no_of_installment').val();
        //     var time_interval        = $('#time_interval').val();
        //     var start_date           = $('#start_date').val().split("-");
        //     var new_date             = new Date(start_date[2], start_date[1] - 1, start_date[0]);
        //     var mili_date            = new_date.getTime();
        //     var amount               = $("#totalAmount").val()/no_of_installment;

        //     if($('#no_of_installment').val() >0 && $('#time_interval').val()>0)
        //     {
        //       for(var i = 0; i< no_of_installment;i++)
        //       {
        //         if(i == 0)
        //         {
        //         var start_date =date_formate(mili_date)
        //         }
        //         else
        //         {
        //             time_int           = time_int+(86400000*(time_interval));
        //             var start_date     = date_formate(mili_date+time_int);
        //         }
        //          $('#install_due_date').append
        //          (
        //            '<tr>'+
        //              '<td>'+
        //                 `<input class="md-input" type="text" id="due_date" name="due_date[]" value="`+start_date+`" data-uk-datepicker="{format:'DD-MM-YYYY'}" >`+
        //              '</td>' +
        //              '<td>'+
        //                '<input class="md-input amount_value" type="text" id="due_ammount_0" onchange="valcheck(0)" value="'+Number(amount).toFixed(2)+'" name="amount_val[]" />'+
        //              '</td>'
        //            +'</tr>'
        //          );
        //       }
        //        $('#installment').show(1000);
        //        $("#due_date_amount").hide(1000);
        //     }
        //     else  {
        //       $('#installment').hide(1000);
        //       $("#due_date_amount").show(100);
        //     }
        // }
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection
