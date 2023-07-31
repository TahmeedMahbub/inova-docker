@extends('layouts.main')

@section('title', 'Bill')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <style media="screen">

        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
        }
        span.select2-container {
            z-index: 0 !important;
        }

        .uk-badge a {
            color: white
        }

        input {
            margin-top: 10px;
        }

        .getMultipleRowItems input, .getMultipleRowAccounts input {
            margin-top: -12px;
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
        <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                <div class="md-card">
                    <div class="user_heading">
                        <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        </div>
                        <div class="user_heading_content">
                            <h2 class="heading_b"><span class="uk-text-truncate">Create New Bill</span></h2>
                        </div>
                    </div>
                    <div class="user_content">
                        {!! Form::open(['url' => route('bill_store'), 'method' => 'POST', 'class' => 'user_edit_form',
                        'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}

                        <div class="uk-margin-top">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-4">
                                    <label class="uk-vertical-align-middle" for="branch_name"> Branch </label> <br>
                                    <select data-uk-tooltip="{pos:'top'}"
                                        class="md-input select2-single-search-dropdown" title="Select Branch"
                                        id="branch_id" name="branch_id" required>
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="uk-width-medium-1-4">
                                    <label class="uk-vertical-align-middle" for="vendor_id"> Name <span
                                            class="uk-badge"><a data-toggle="uk-modal"
                                                data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit"
                                                class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create Contact</a></span></label> <br>
                                    <select data-uk-tooltip="{pos:'top'}"
                                        class="md-input select2-single-search-dropdown" title="Select Vendor"
                                        id="vendor_id" name="vendor_id" required>
                                        <option value="">Select Vendor</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" data-vendor-excess-payment="{{ $vendor->paymentMades->sum('excess_amount') }}" data-vendor-credit-note= {{ $vendor->vendorCredits->sum('sub_total') }}>{{ $vendor->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="uk-width-medium-1-4">
                                    <label for="invoice_number">Order No</label>
                                    <input class="md-input" type="text" id="order_number" name="order_number" />
                                </div>

                                <div class="uk-width-medium-1-4">
                                    <label for="bill_date">Bill Date</label>
                                    <input class="md-input" type="text" id="bill_date" name="bill_date"
                                        value="{{ Carbon\Carbon::now()->format('d-m-Y') }}"
                                        data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                </div>
                            </div>

                            <a href="{{ route('inventory_create') }}" target="_blank" class="md-btn md-btn-default"
                                style="margin:20px 0px  -30px 0px">Create New Product/Service </a>
                            <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1" style="overflow:auto">
                                    <table class="input_fields_wrap uk-table" cellspacing="0" style="overflow:auto"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">#</th>
                                                <th class="uk-text-nowrap" width="20%">Product/Service <span
                                                        style="color: red;" class="asterisc">*</span></th>
                                                <th class="uk-text-nowrap">Description</th>
                                                <th class="uk-text-nowrap">Quantity(CTN)<span style="color: red;"
                                                        class="asterisc">*</span></th>
                                                <th class="uk-text-nowrap">Quantity(PCS)<span style="color: red;"
                                                        class="asterisc">*</span></th>
                                                        <th class="uk-text-nowrap">Unit<span style="color: red;" class="asterisc">*</span></th>

                                                <th class="uk-text-nowrap" style="min-width: 120px">Rate<span style="color: red;"
                                                        class="asterisc">*</span></th>
                                                <th class="uk-text-nowrap" style="min-width: 120px">Discount</th>
                                                <!-- <th class="uk-text-nowrap"></th> -->
                                                <th class="uk-text-nowrap">Amount</th>
                                                <th class="uk-text-nowrap" width="20%">Account</th>
                                                <th class="uk-text-nowrap">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="getMultipleRowItems">
                                            <tr class="tr_0" id="data_clone">
                                                <td>
                                                    <p style="padding-top: 10px">1</p>
                                                </td>
                                                <td style="width: 200px">
                                                    <select id="item_id_0"
                                                        class="getProductList md-input itemId select2-single-search-dropdown"
                                                        name="item_id[]" onchange="itemChanged(this, `purchase`); getItemPrice(0); calculatePcsToCtn(this);" required>
                                                    </select>
                                                    <a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `purchase`)"
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
                                                    <input type="text" id="description_0" class="md-input description"
                                                        name="description[]" oninput="calculateActualAmount(0)">
                                                </td>
                                                <td>
                                                    <input type="text" id="quantity_ctn_0" name="quantity_ctn[]"
                                                        class="md-input quantity" value="1"
                                                        oninput="calculateCtnToPcs(this); checkOffer(0)"/>
                                                </td>
                                                <td>
                                                    <input type="text" id="quantity_pcs_0" name="quantity_pcs[]"
                                                        class="md-input quantity" value="1"
                                                        oninput="calculateActualAmount(0); calculatePcsToCtn(this); checkOffer(0)" />
                                                </td>
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
                                                    <div style="position: relative">
                                                        <input type="text" id="rate_0" name="rate[]" class="md-input rate"
                                                            value="0.00" oninput="calculateActualAmount(0)" required />
                                                        <select name="rate_type[]" id="rate_type_0" style="position: absolute; right: -5px; top: -5px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount(0)">
                                                            <option value="0">pcs</option>
                                                            <option value="1">ctn</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="position: relative">
                                                        <input id="discount_0" type="text" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount(0)">
                                                        <select name="discount_type[]" id="discount_type_0" style="position: absolute; right: -5px; top: -5px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount(0)">
                                                            <option value="1">Tk</option>
                                                            <option value="0">%</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" id="amount_0" name="amount[]"
                                                        class="md-input amount" value="0"
                                                        oninput="calculateActualAmount(0)" readonly="readonly" />
                                                </td>
                                                <td>
                                                    <div>
                                                        <select id="account_id_0"
                                                            class="md-input accountId md-input select2-single-search-dropdown"
                                                            name="account_id[]" required>
                                                            <option value="" selected>Select Account</option>
                                                            @if(!empty($account) && (count($account) > 0))
                                                            @foreach($accounts as $account_value)
                                                            <option value="{{ $account_value->id }}" {{$account_value->id==
                                                                26 ? 'selected':''}}>{{ $account_value->account_name }}
                                                            </option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <input type="text" style="width: 50%; display:none" class="uk-align-center uk-text-center uk-margin-small-top" name="depreciation_rate[]" id="depreciation_rate_0" placeholder="Depreciation Rate">
                                                    </div>

                                                </td>
                                                <td style="text-align: center">
                                                    <a href="#" class="add_field_button_items">
                                                        <i style="padding-top: 10px"
                                                            class="material-icons md-36">&#xE146;</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <table style="display:none;float:right;margin-top:-20px !important; "
                                            class="add_table_items">
                                            <tr>
                                                <td style="text-align: center">
                                                    <a href="#" class="add_field_button_items">
                                                        <i style="padding-top: 10px"
                                                            class="material-icons md-36">&#xE146;</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 uk-margin-small-top uk-margin-medium-bottom">
                                    <div class="uk-grid">
                                        <div class="uk-width-4-5">
                                            <div class="uk-text-nowrap" style=" padding:10px;height: 40px; color: white; background-color: #2991fa; ">
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
                                    <div class="uk-grid" style="display: none;" id="payment_details">
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-2">
                                                    <label for="payment_amount">Amount</label>
                                                    <input class="md-input" type="text" id="payment_amount"
                                                        name="payment_amount" value="{{ old(" payment_amount") }}" oninput="calculateActualAmount(0); createNote();" />
                                                </div>
        
                                                <div class="uk-width-medium-1-2">
                                                    <label class="uk-vertical-align-middle" for="payment_account">Paid Through
                                                        <span style="color:red">*</span></label> <br>
        
                                                    <select name="payment_account" id="payment_account"
                                                        class="md-input select2-single-search-dropdown"
                                                        data-uk-tooltip="{pos:'top'}" title="Select Account" onchange="paymentTypeChanged(); createNote();">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($account as $value)
                                                            @if(empty(old('payment_account')) && $value->id==3)
                                                                <option data-account-type="{{ $value->account_type_id }}" selected value="{{ $value->id }}">
                                                                    {{ $value->account_name }}
                                                                </option>
                                                            @else
                                                                <option data-account-type="{{ $value->account_type_id }}" value="{{ $value->id }}" {{ $value->id == old('payment_account') ? 'selected' : '' }}>
                                                                    {{ $value->account_name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                        
                                                <div class="uk-width-medium-1-2 uk-margin-medium-top" id="cheque_number_container" style="{{ !empty(old('payment_account')) && $accounts->where('id', old('payment_account'))->first()->account_type_id == 5 ? '' : 'display:none' }}">
                                                    <label for="cheque_number">Cheque Number</label> <br>
                                                    <select name="cheque_number" id="cheque_number" class="md-input select2-single-search-dropdown" onchange="createNote();">
                                                        <option value="">Select a bank first!</option>
                                                    </select>
                                                    @if ($errors->has('cheque_number'))
                                                        <span class="uk-text-danger">{{ $errors->first('cheque_number') }}</span>
                                                    @endif
                                                </div>
                                                
                                                <div class="uk-width-medium-1-2 uk-margin-medium-top" id="issue_date_container" style="{{ !empty(old('payment_account')) && $accounts->where('id', old('payment_account'))->first()->account_type_id == 5 ? '' : 'display:none' }}">
                                                    <label for="issue_date">Issue Date</label>
                                                    <input class="md-input" type="text" id="issue_date"
                                                        name="issue_date" value="{{ old("issue_date") }}" onchange="createNote()" data-uk-datepicker="{format:'DD-MM-YYYY'}"/>
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
                                            <div class="uk-text-nowrap" style=" padding:10px;height: 40px; color: white; background-color: #2991fa; ">
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
                                    <div class="uk-grid" style="display: none;" id="advance_details">
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
                                            <div class="uk-text-nowrap" style=" padding:10px;height: 40px; color: white; background-color: #2991fa; ">
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
                                    <div class="uk-grid" style="display: none;" id="vendor_credit_details">
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
                                    <div class="uk-grid" style="display: none" id="available_balance">
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
                                <div style="overflow:auto" class="uk-width-medium-1-2">
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
                                                    <a style="border: none;text-decoration: none;color: black"
                                                        id="subTotalShow">0.00</a>
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
                                                    <input type="text" id="vat" class="md-input md-input-width-medium"
                                                        value="0.00" oninput="calculateActualAmount(0)" />
                                                </td>
                                                <td style="text-align: right">
                                                    <a style="border: none;text-decoration: none;color: black"
                                                        id="vatShow">0.00</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-color: white" colspan="3"></td>
                                                <th colspan="5">Grand Total(BDT)</th>
                                                <th style="text-align: right">
                                                    <a style="border: none;text-decoration: none;color: black"
                                                        id="totalAmountShow">0.00</a>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td style="border-color: white" colspan="3"></td>
                                                <th colspan="5">Total Paid(BDT)</th>
                                                <th style="text-align: right">
                                                    <a style="border: none;text-decoration: none;color: black"
                                                        id="paidAmount">0.00</a>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td style="border-color: white" colspan="3"></td>
                                                <th colspan="5">Total Due(BDT)</th>
                                                <th style="text-align: right">
                                                    <a style="border: none;text-decoration: none;color: black"
                                                        id="dueAmount">0.00</a>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="subTotal" name="sub_total">
                                    <input type="hidden" id="totalAmount" name="total_amount">
                                    <input type="hidden" id="vat_total" name="tax_total">
                                    <input type="hidden" id="total_paid" name="total_paid">
                                    <input type="hidden" id="total_due" name="total_due">
                                </div>
                            </div>

                            {{-- <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-1-1">
                                    <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2 ">
                                        Offers & Free Products
                                    </div>
                                </div>
                            </div>
                            <div class="uk-grid" style="margin-top: 0 !important">
                                <div class="uk-width-medium-1-2 uk-margin-medium-top">
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa;">
                                                Name of the Offer Campaign Here
                                            </div>
                                        </div>
                                        <div class="uk-width-1-2"
                                            style="padding: 10px; height: 40px; position:relative;background: #2991fa ">
                                            <div style="position: absolute; right: 10px; height: 40px; ">
                                                <input {{ old('check_payment_vendor_credit')?"checked":'' }} type="radio"
                                                    name="offer_choice_id" id="offer_choice_id_0"
                                                    style=" margin-top: -1px; height: 25px; width: 20px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid" id="dada">
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-2">
                                                    <label for="free_product_id">Product Name</label>
                                                    <input class="md-input" type="text" id="free_product_id_0"
                                                        name="free_product_id" value="5000" disabled/>
                                                </div>
        
                                                <div class="uk-width-medium-1-2">
                                                    <label for="free_product_quantity">Quantity</label>
                                                    <input class="md-input" type="number" id="free_product_quantity_0"
                                                        name="free_product_quantity" value="5" disabled/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-2">
                                                    <label for="offer_incentive">Incentive Amount</label>
                                                    <input class="md-input" type="number" id="offer_incentive_0"
                                                        name="offer_incentive" value="15000.00" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                        
                                </div>
                                <div class="uk-width-medium-1-2 uk-margin-medium-top">
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa;">
                                                Name of the Offer Campaign Here
                                            </div>
                                        </div>
                                        <div class="uk-width-1-2"
                                            style="padding: 10px; height: 40px; position:relative;background: #2991fa ">
                                            <div style="position: absolute; right: 10px; height: 40px; ">
                                                <input {{ old('check_payment_vendor_credit')?"checked":'' }} type="radio"
                                                    name="offer_choice_id" id="offer_choice_id_1"
                                                    style=" margin-top: -1px; height: 25px; width: 20px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid" id="dada">
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-2">
                                                    <label for="free_product_id">Product Name</label>
                                                    <input class="md-input" type="text" id="free_product_id_1"
                                                        name="free_product_id" value="5000" disabled/>
                                                </div>
        
                                                <div class="uk-width-medium-1-2">
                                                    <label for="free_product_quantity">Quantity</label>
                                                    <input class="md-input" type="number" id="free_product_quantity_1"
                                                        name="free_product_quantity" value="5" disabled/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-2">
                                                    <label for="offer_incentive">Incentive Amount</label>
                                                    <input class="md-input" type="number" id="offer_incentive_1"
                                                        name="offer_incentive" value="15000.00" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                        
                                </div>
                                <div class="uk-width-medium-1-2 uk-margin-medium-top">
                                    <div class="uk-grid">
                                        <div class="uk-width-1-2">
                                            <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa;">
                                                Name of the Offer Campaign Here
                                            </div>
                                        </div>
                                        <div class="uk-width-1-2"
                                            style="padding: 10px; height: 40px; position:relative;background: #2991fa ">
                                            <div style="position: absolute; right: 10px; height: 40px; ">
                                                <input {{ old('check_payment_vendor_credit')?"checked":'' }} type="radio"
                                                    name="offer_choice_id" id="offer_choice_id_2"
                                                    style=" margin-top: -1px; height: 25px; width: 20px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid" id="dada">
                                        <div class="uk-width-1-1">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-2">
                                                    <label for="free_product_id">Product Name</label>
                                                    <input class="md-input" type="text" id="free_product_id_2"
                                                        name="free_product_id" value="5000" disabled/>
                                                </div>
        
                                                <div class="uk-width-medium-1-2">
                                                    <label for="free_product_quantity">Quantity</label>
                                                    <input class="md-input" type="number" id="free_product_quantity_2"
                                                        name="free_product_quantity" value="5" disabled/>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-2">
                                                    <label for="offer_incentive">Incentive Amount</label>
                                                    <input class="md-input" type="number" id="offer_incentive_2"
                                                        name="offer_incentive" value="15000.00" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                        
                                </div>
                            </div> --}}
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

                            {{-- <div class="uk-grid" >
                                <div class="uk-width-1-2">
                                    <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2 ">
                                        Create Account Entries
                                    </div>
                                </div>
                                <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: #1976d2 ">
                                    <div id="inv" style="position: absolute; right: 10px; height: 40Cpx; ">
                                        <input {{ old('check_journal_entry')?"checked" : '' }} type="checkbox" name="check_journal_entry" id="check_journal_entry" style=" margin-top: -1px; height: 25px; width: 20px;" />
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="uk-grid" style="display: none;" id="journal_entry_details">
                                <div class="uk-width-1-1" >
                                    <div class="uk-grid uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <table class="uk-table">
                                                <thead>
                                                <tr>
                                                    <th class="uk-text-nowrap">SL</th>
                                                    <th class="uk-text-nowrap">Account</th>
                                                    <th class="uk-text-nowrap">Debit</th>
                                                    <th class="uk-text-nowrap">Credit</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody class="getRow">

                                                <tr class="journal_tr_0">
                                                    <td>
                                                        <span id="jounal_serial0" class="jounal_serial">1</span>
                                                    </td>
                                                    <td>
                                                        <select name="account_id[]" onchange="selectAccount(0)" class="getJournalAccountList form-control single_select2" id="account_id_0">
                                                            @foreach($accounts as $account)
                                                                <option value="{{ $account->id }}" @if( $account->id == 1) selected @endif >{{ $account->account_name }}</option>
                                                            @endforeach
                                                        </select> --}}
                                                        
                                                        {{-- <div id="sp_offer_dropdown_0" style="margin-top: 10px; display: none;">
                                                            <select name="sp_offer_id[]"  class="getSpOfferList form-control single_select2" id="sp_offer_id_0">
                                                                    <option value="">Select Offer Validity</option>
                                                                @foreach($special_offers as $special_offers_tmp)
                                                                    <option value="{{ $special_offers_tmp->id }}" >{{ $special_offers_tmp->contact->display_name . " - " . date("d-m-Y", strtotime($special_offers_tmp->from_date)) . " to " . date("d-m-Y", strtotime($special_offers_tmp->to_date))  }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                                    
                                                    {{-- </td>
                                                    <td>
                                                        <input type="text" class="md-input debit" name="debit[]" oninput="calculateJournal(0)" id="debit_0" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="md-input credit" name="credit[]" oninput="calculateJournal(0)" id="credit_0" value="">
                                                    </td>
                                                    <td class="uk-text-right uk-text-middle">
                                                        <span class="uk-input-group-addon add_journal_row">
                                                            <a href="#!" onclick="addJournalEntryRow()" class="material-icons md-24">add_box</a>
                                                        </span>
                                                        <span class="uk-input-group-addon delete_journal_row" style="visibility:hidden">
                                                            <a href="#!" onclick="deleteJournalEntryRow(0)" class="material-icons md-24">delete</a>
                                                        </span>
                                                    </td>
                                                </tr>

                                                <tr class="journal_tr_1">
                                                    <td>
                                                        <span id="jounal_serial0" class="jounal_serial">2</span>
                                                    </td>
                                                    <td>
                                                        <select name="account_id[]" class="getJournalAccountList form-control single_select2" id="account_id_1">
                                                            @foreach($accounts as $account)
                                                                <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="md-input debit" name="debit[]" oninput="calculateJournal(1)" id="debit_1" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="md-input credit" name="credit[]" oninput="calculateJournal(1)" id="credit_1" value="">
                                                    </td>
                                                    <td class="uk-text-right uk-text-middle">
                                                        <span class="uk-input-group-addon add_journal_row">
                                                            <a href="#!" onclick="addJournalEntryRow()" class="material-icons md-24">add_box</a>
                                                        </span>
                                                        <span class="uk-input-group-addon delete_journal_row" style="visibility:hidden">
                                                            <a href="#!" onclick="deleteJournalEntryRow(1)" class="material-icons md-24">delete</a>
                                                        </span>
                                                    </td>
                                                </tr>

                                                <tr class="journal_tr_2">
                                                    <td>
                                                        <span id="jounal_serial0" class="jounal_serial">3</span>
                                                    </td>
                                                    <td>
                                                        <select name="account_id[]" class="getJournalAccountList form-control single_select2" id="account_id_2">
                                                            @foreach($accounts as $account)
                                                                <option value="{{ $account->id }}" @if( $account->id == 2) selected @endif >{{ $account->account_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="md-input debit" name="debit[]" oninput="calculateJournal(2)" id="debit_2" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="md-input credit" name="credit[]" oninput="calculateJournal(2)" id="credit_2" value="">
                                                    </td>
                                                    <td class="uk-text-right uk-text-middle">
                                                        <span class="uk-input-group-addon add_journal_row">
                                                            <a onclick="addJournalEntryRow()" ><i class="material-icons md-24">&#xE146;</i></a>
                                                        </span>
                                                        <span class="uk-input-group-addon delete_journal_row" style="visibility:hidden">
                                                            <a href="#!" onclick="deleteJournalEntryRow(2)" class="material-icons md-24">delete</a>
                                                        </span>
                                                    </td>
                                                </tr>

                                                <tr class="journal_tr_3">
                                                    <td>
                                                        <span id="jounal_serial0" class="jounal_serial">4</span>
                                                    </td>
                                                    <td>
                                                        <select name="account_id[]" class="getJournalAccountList form-control single_select2" id="account_id_3">
                                                            @foreach($accounts as $account)
                                                                <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" readonly class="md-input debit" name="debit[]" oninput="calculateJournal(3)" id="debit_3" value="0">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="md-input credit" name="credit[]" oninput="calculateJournal(3)" id="credit_3" value="0">
                                                    </td>
                                                    <td class="uk-text-right uk-text-middle">
                                                        <span class="uk-input-group-addon add_journal_row">
                                                            <a onclick="addJournalEntryRow()" ><i class="material-icons md-24">&#xE146;</i></a>
                                                        </span>
                                                        <span class="uk-input-group-addon delete_journal_row" style="visibility:hidden">
                                                            <a href="#!" onclick="deleteJournalEntryRow(3)" class="material-icons md-24">delete</a>
                                                        </span>
                                                    </td>
                                                </tr>

                                                </tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>Total</td>
                                                    <td> <input type="text" class="md-input" id="totalDebit" value="" readonly> </td>
                                                    <td> <input type="text" class="md-input" id="totalCredit" value="" readonly> </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <hr>

                            {{-- <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-2-4">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <label for="personal_note">Personal note</label>
                                            <textarea class="md-input" id="personal_note"
                                                name="personal_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-medium-2-4">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <label for="vendor_note">Vendor Note</label>
                                            <textarea class="md-input" id="vendor_note"
                                                name="vendor_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-3">
                                    <label for="invoice_date">No Of Installment</label>
                                    <input class="md-input" type="text" id="no_of_installment"
                                        onfocusout="installment()" value="" name="no_of_installment">
                                </div>
                                <div class="uk-width-medium-1-3">
                                    <label for="invoice_date">Time Interval</label>
                                    <input class="md-input" type="text" id="time_interval" onfocusout="installment()"
                                        value="" name="time_interval">
                                </div>
                                <div class="uk-width-medium-1-3">
                                    <label for="invoice_date">Start Date</label>
                                    <input class="md-input" type="text" id="start_date" onfocusout="installment()"
                                        name="start_date" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}"
                                        data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                </div>
                            </div> --}}
                            {{-- <div style="display:none;" id="installment" class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-1-1">
                                    <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2 ">
                                        Installment Amount And Date
                                    </div>
                                </div>
                                <div style="overflow:auto" class="uk-width-medium-4-4">
                                    <table class="input_fields_wrap uk-table" cellspacing="0" style="overflow:auto"
                                        width="100%">
                                        <tbody id="install_due_date" class="add_row">
                                            <tr>
                                                <td> <b>Due Date</b></td>
                                                <td><b>Due Amount</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                            {{-- <div style="display:none;" id="due_date_amount" class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-1-1">
                                    <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2; ">
                                        Multiple Due Date Add
                                    </div>
                                </div>
                                <div style="overflow:auto" class="uk-width-medium-4-4">
                                    <table class="input_fields_wrap uk-table" cellspacing="0" style="overflow:auto"
                                        width="100%">
                                        <tbody id="add_row" class="add_row">
                                            <tr>
                                                <td><b>Due Date</b></td>
                                                <td><b>Due Amount</b></td>
                                                <td><b>Action</b></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="md-input" type="text" id="due_date" name="due_date[]"
                                                        value="{{ Carbon\Carbon::now()->format('d-m-Y') }}"
                                                        data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                                </td>
                                                <td>
                                                    <input class="md-input amount_value" type="text" id="due_ammount_0"
                                                        onchange="valcheck(0)" name="amount_val[]" />
                                                </td>
                                                <td style="text-align: center">
                                                    <a class="field_button">
                                                        <i style="padding-top: 10px"
                                                            class="material-icons md-36">&#xE146;</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <table id="add_row" class="add_row hidden" cellspacing="0" style="overflow:auto"
                                            width="100%">
                                            <tr>
                                                <td>Total</td>
                                                <td id="total_due_ammount">125</td>
                                            </tr>
                                        </table>
                                    </table>
                                </div>
                            </div> --}}
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <label for="general_note"> Note</label>
                                            <textarea class="md-input" id="general_note"
                                                name="general_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-2 uk-margin-medium-top">
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
                            </div>
                            {{-- <p>
                                @if($errors->has('payment_account')|| $errors->has('payment_amount'))
                                <span
                                    style="color:red; position: relative; right:0px; margin: 5px 0px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">{!!
                                    "Payment field required" !!}</span>

                                @endif
                            </p> --}}

                            <div class="uk-grid uk-text-right" data-uk-grid-margin>
                                <div class="uk-width-1-1 uk-float-left">
                                    <button type="submit"
                                        class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"
                                        value="Submit" name="submit">Submit</button>
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
        function func(x){
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

        var ajax_data = [];
        var items_chosen = [];
        $(document).ready(function() {
            $.get("{{route('item_list')}}/", function(data){

                // ajax_data = data;
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

        var max_fields_items        = 50;                               //maximum input boxes allowed
        var max_fields_accounts     = 50;                               //maximum input boxes allowed
        var wrapper                 = $(".input_fields_wrap");          //Fields wrapper
        var add_button_items        = $(".add_field_button_items");     //Add button ID
        var add_button_accounts     = $(".add_field_button_accounts");  //Add button ID

        //For apending another rows start
        var x         = 0;
        var y         = 0;
        var total_val = 0;

        $(add_button_items).click(function(e){
            e.preventDefault();

            var x = parseInt($('.getMultipleRowItems tr:last').attr('class').match(/(\d+)/g)[0]);

            if(x < max_fields_items)
            {
                x++;

                var serial = x + 1;

                $('.getMultipleRowItems').append( ' ' +'<tr class="tr_'+x+'">'+
                    '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+
                    '<td style="width: 200px">\n'+
                    '<div class="md-input-wrapper md-input-filled md-input-wrapper-success">\n'+
                    '<select id="item_id_'+x+'" class="getProductList md-input itemId select2-single-search-dropdown" name="item_id[]" onchange="itemChanged(this, `purchase`); getItemPrice('+ x +'); calculatePcsToCtn(this);">\n</select>\n'+
                    '</div>\n'+
                    '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `purchase`)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_'+ x +'" type="submit" class="sm-btn sm-btn-primary variation-button">\n'+
                    '<span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span>\n</a>\n'+
                    '<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value="">'+
                    '</td>\n'+
                    '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_ctn_'+x+'" class="md-input quantity" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_pcs_'+x+'" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculateActualAmount('+x+'); calculatePcsToCtn(this); checkOffer('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select name="unit_id[]" id="unit_id_'+x+'" class="md-input select2-single-search-dropdown" required>\n'+ '<option value="">Select Unit</option>\n'+ ' @foreach($units as $unit) <option  value="{{ $unit->id }}">{{ $unit->name }}</option> @endforeach</select>\n'+'</td>\n'+

                    '<td>\n'+
                    '<div style="position: relative">\n<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+
                    '<select name="rate_type[]" id="rate_type_'+x+'" style="position: absolute; right: -5px; top: 12px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount('+x+')">\n'+
                    '<option value="0">pcs</option><option value="1">ctn</option></select></div>'+'<td>\n'+
                    '<div style="position: relative">\n<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+
                    '<select name="discount_type[]" id="discount_type_'+x+'" style="position: absolute; right: -5px; top: 12px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount('+x+')">\n'+
                    '<option value="1">Tk</option><option value="0">%</option></select></div></td>\n'+
                    // '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<div>\n'+'<select id="account_id_'+x+'" class="md-input accountId select2-single-search-dropdown" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($accounts as $account_all) <option {{ $account_all->id== 26 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+''+'</div>\n'+
                    '<input type="text" style="width: 50%; display:none"" class=" uk-align-center uk-text-center uk-margin-small-top" name="depreciation_rate[]" id="depreciation_rate_'+x+'" placeholder="Depreciation Rate">'+
                    '</td>\n'+
                    '<td style="text-align: center">\n'+'<a href="#" class="remove_field_items" onclick="rowRemoved('+x+')">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                    '</tr>\n'
                );

                var list5 = '';
                var list7 = '';

                ajax_data.forEach(data => {
                    list5 += '<option value = "' +  data['id'] + '">' + data['barcode_no'] + ', ' + data['item_name'] +'</option>';
                });

                list7 += '<option value = "">' + 'Select Product/Service  ' +'</option>';

                $("#item_id_"+x).empty();
                $("#item_id_"+x).append(list7);
                $("#item_id_"+x).append(list5);

                $('.select2-single-search-dropdown').select2();
            }
            if(serial>1)
            {
            $('.add_table_items').css('display','inline');
            }
            else{
                $('.add_table_items').css('display','none');
            }
        });

        // $(add_button_accounts).click(function(e)
        // {
        //     e.preventDefault();

        //     var y = parseInt($('.getMultipleRowAccounts tr:last').attr('class').match(/(\d+)/g)[0]);

        //     if(y < max_fields_accounts)
        //     {
        //         y++;

        //         var serial = y + 1;

        //         $.get("{{route('item_list')}}/", function(data){

        //             var list5 = '';
        //             var list7 = '';

        //             $.each(data, function(i, data)
        //             {
        //                 list5 += '<option value = "' +  data.id + '">' + data.barcode_no + ', ' + data.item_name +'</option>';

        //             });

        //             list7 += '<option value = "">' + 'Select Product/Service  ' +'</option>';

        //             $("#account_entries_id_"+y).empty();
        //             $("#account_entries_id_"+y).append(list7);
        //             $("#account_entries_id_"+y).append(list5);
        //         });


        //         $('.getMultipleRowAccounts').append( ' ' +'<tr class="tr_accounts_'+y+'">'+
        //             '<td style="width: 30%">\n'+'<select id="account_entries_id_'+y+'" class="md-input itemId md-input select2-single-search-dropdown" name="account_id[]" onchange=""  class="uk-margin-medium-top" required></select>'+'</td>\n'+
        //             '<td>\n'+'<input class="md-input" type="text" id="reference_'+y+'" onchange="" name="reference[]" />\n'+'</td>\n'+
        //             '<td>\n'+'<input class="md-input" type="number" id="debit_amount_'+y+'" onchange="" name="debit_amount[]" />\n'+'</td>\n'+
        //             '<td>\n'+'<input class="md-input" type="number" id="credit_amount_'+y+'" onchange="" name="credit_amount[]" />\n'+'</td>\n'+
        //             '<td style="text-align: center">\n'+'<a href="#" class="remove_field_accounts">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
        //             '</tr>\n');
        //         $('.select2-single-search-dropdown').select2();
        //     }
        //     if(serial>1)
        //     {
        //       $('.add_table_accounts').css('display','inline');
        //     }
        //     else{
        //         $('.add_table_accounts').css('display','none');
        //     }
        // });

        //For apending another rows end

        $(wrapper).on("click",".remove_field_items", function(e)
        {
            e.preventDefault();
            $(this).parent().parent().remove(); x--;

            calculateActualAmount();
            if($(".getMultipleRowItems tr").length < 2){
                $('.add_table_items').css('display','none');
            }
        });

        $(wrapper).on("click",".remove_field_accounts", function(e)
        {
            e.preventDefault();
            $(this).parent().parent().remove();
            y--;
            if($(".getMultipleRowAccounts tr").length < 2){
                $('.add_table_accounts').css('display','none');
            }
        });

        function getItemPrice(x){
            //For getting item commission information from items table start
            var item_id  = $("#item_id_"+x).val();
            if(item_id)
            {            
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

                        $("#rate_"+x).val(ajax_data[item_id]['item_purchase_rate']);
                        $("#amount_"+x).val(ajax_data[item_id]['item_purchase_rate']);
                        calculateActualAmount(x);
                        
                        // $.get('/bill/check/item/rate/'+ item_id, function(data){

                        //     $("#rate_"+x).val(data.item_purchase_rate);
                        //     $("#amount_"+x).val(data.item_purchase_rate);

                        //     calculateActualAmount(x);
                        // });
                    }
                });
            }
            //For getting item commission information from items table end
        }

        function calculateActualAmount(x){
            var rate                    = $("#rate_"+x).val();
            var quantity                = $("#quantity_pcs_"+x).val();
            var quantity_cartoon        = $("#quantity_cartoon_"+x).val();
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

            if (quantity == '' || quantity == 0)
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

            var amount = ($('#rate_type_'+x).val() == 0 ? (parseFloat(rateCal)*parseFloat(quantityCal)) : (parseFloat(rateCal)*parseFloat(quantityCtnCal))).toFixed(2);

            if(discount > 0 && amount > 0){
                amount = (amount - ($('#discount_type_'+x).val() == 0 ? (amount*discount/100) : discount)).toFixed(2);
            }

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
                var adjustment_value   = $('#adjustment_type').val() == 0 ? subTotal * adjustment / 100 : adjustment;
                var adjustment_show = parseFloat(subTotal) - parseFloat(adjustment_value);
            }

            
            var payment_amount = $('#check_payment').is(':checked') && $('#payment_amount').val() != '' ? $('#payment_amount').val() : 0;
            var payment_advance = $('#check_payment_advance').is(':checked') && $('#payment_amount_advance').val() != '' ? $('#payment_amount_advance').val() : 0;
            var payment_vendor_credit = $('#check_payment_vendor_credit').is(':checked') && $('#credit_amount_advance').val() != '' ? $('#credit_amount_advance').val() : 0;

            $("#adjustmentShow").html(-adjustment_value);
            $("#subTotalShow").html(subTotal);
            $("#subTotal").val(subTotal);
            $('#paidAmount').html((parseFloat(payment_amount) + parseFloat(payment_advance) + parseFloat(payment_vendor_credit)).toFixed(2));
            $('#total_paid').val((parseFloat(payment_amount) + parseFloat(payment_advance) + parseFloat(payment_vendor_credit)).toFixed(2));
            $('#adjusted_amount').html(parseFloat(payment_advance) + parseFloat(payment_vendor_credit))

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

            var total_amount     = parseFloat(subTotal) + parseFloat(vat) - parseFloat(adjustment_value);
            $('#total_due').val((parseFloat(total_amount) - parseFloat(payment_amount) - parseFloat(payment_advance) - parseFloat(payment_vendor_credit)).toFixed(2));

            //Calculating Total Amount end
            $("#totalAmountShow").html(total_amount.toFixed(2));
            $("#totalAmount").val(total_amount.toFixed(2));

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
            // installment();
            $('#dueAmount').html((parseFloat($('#totalAmountShow').html()) - parseFloat(payment_amount) - parseFloat(payment_advance) - parseFloat(payment_vendor_credit)).toFixed(2));
        }

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
        $('#sidebar_bill').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });
        altair_forms.parsley_validation_config();
        //payment made
        var total_val = $("#totalAmount").val();
        var index_no = 0;

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
                    '</td>'+
                '</tr>'
            )
            var nn = parseFloat(index_no) - 1;
            $('#due_ammount_'+nn).attr('readonly', 'readonly');
        });

        $('.add_row').on('click', '.remove_date_amount',function(){
            $(this).parent().parent().remove();
            valcheck();
        });

        function valcheck(z){
            var check_due_amount = $('#due_ammount_'+z).val();
            var total_payable    = $('#totalAmount').val();

            var total_amount_val = 0;
            $('.amount_value').each(function(index ,value){
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

        var date_formate  = function (date_find){
            var today_date       = new Date(date_find);
            var year_find        = today_date.getFullYear().toString();
            var month_find       = (today_date.getMonth() + 1).toString();
            var date_find        = today_date.getDate().toString();
            var next_date_form   = (date_find[1] ? date_find:"0" + date_find[0]) + "-" + (month_find[1] ? month_find:"0" + month_find[0]) + "-" + year_find;

            return next_date_form;
        }

        // function installment(){
        //     $('#install_due_date').empty();
        //     var time_int             = 0;
        //     var no_of_installment    = $('#no_of_installment').val();
        //     var time_interval        = $('#time_interval').val();
        //     var start_date           = $('#start_date').val().split("-");
        //     var new_date             = new Date(start_date[2], start_date[1] - 1, start_date[0]);
        //     var mili_date            = new_date.getTime();
        //     var amount               = $("#totalAmount").val()/no_of_installment;

        //     if($('#no_of_installment').val() >0 && $('#time_interval').val()>0){
        //         for(var i = 0; i< no_of_installment;i++){
        //         if(i == 0){
        //             var start_date =date_formate(mili_date)
        //         }
        //         else{
        //             time_int           = time_int+(86400000*(time_interval));
        //             var start_date     = date_formate(mili_date+time_int);
        //         }
        //         $('#install_due_date').append(
        //             '<tr>'+
        //                 '<td>'+
        //                     `<input class="md-input" type="text" id="due_date" name="due_date[]" value="`+start_date+`" data-uk-datepicker="{format:'DD-MM-YYYY'}" >`+
        //                 '</td>' +
        //                 '<td>'+
        //                 '<input class="md-input amount_value" type="text" id="due_ammount_0" onchange="valcheck(0)" value="'+Number(amount).toFixed(2)+'" name="amount_val[]" />'+
        //                 '</td>'+
        //             '</tr>'
        //             );
        //         }
        //         $('#installment').show(1000);
        //         $("#due_date_amount").hide();
        //     }
        //     else{
        //         $('#installment').hide(1000);
        //         $("#due_date_amount").show(100);
        //     }

        // }

        $('#vendor_id').change(function (e) { 
            e.preventDefault();
            var vendor_excess_payment_amount = $('#' + $(this).attr('id') + ' option:selected').attr('data-vendor-excess-payment');
            var vendor_credit_note_amount    = $('#' + $(this).attr('id') + ' option:selected').attr('data-vendor-credit-note');
            $("#payment_available_amount_advance").val(vendor_excess_payment_amount);
            $('#payment_amount_advance').attr('max', vendor_excess_payment_amount);
            $("#credit_available_amount_advance").val(vendor_credit_note_amount);
            $('#credit_amount_advance').attr('max', vendor_credit_note_amount);
            var total_available_amount = parseFloat(vendor_excess_payment_amount) + parseFloat(vendor_credit_note_amount);
            $('#total_available_balance').html(total_available_amount);
        });

        
        function createNote(){
            var issue_date      = $("#issue_date").val() || "";
            var amount          = $("#payment_amount").val() || 0;
            var paid_through_id = $("#payment_account").val() || 3;
            var cheque_number   = $("#cheque_number").val();
            var acc_name = "";
            $.ajax({
                type: "GET",
                url: "../api/manual-journal/account-by-id/"+paid_through_id,
                success: function (response1) {
                    acc_name = response1.account_name;
                    
                    if(paid_through_id == 3)
                    {
                        var note            = "Amount: "+amount+" TK, Via Cash";
                    }
                    else if(cheque_number === undefined || cheque_number == null)
                    {
                        var note            = "Amount: "+amount+" TK "+ (issue_date != "" ? " on "+issue_date : "" )+ ", Via "+acc_name;
                    }
                    else
                    {
                        var note            = "Amount: "+amount+" TK, using Cheque Number: "+cheque_number + (issue_date != "" ? "  on "+issue_date : "" )+ ", from "+acc_name;
                    }
                    
                    $("#general_note").empty();
                    $("#general_note").append(note);
                }
            });
        }
        
        function paymentTypeChanged(){
            if($('#payment_account option:selected').data('account-type') == 5){
                var url = "{{ route('available_cheque_number', ['id' => ':id']) }}";
                url = url.replace(':id', $('#payment_account option:selected').val());
                $.ajax({
                    type: "get",
                    url: url,
                    success: function (response) {
                        $("#cheque_number").empty();
                        option_html = "";
                        $.each(response.data, function (index, chequePage) {
                            option_html += '<option value="'+chequePage+'">'+chequePage+'</option>';
                        });
                        $("#cheque_number").append(option_html);

                        
                        var amount          = $("#payment_amount").val() || 0;
                        var paid_through_id = $("#payment_account").val() || 3;
                        var issue_date      = $("#issue_date").val() || "";
                        var acc_name = "";
                        $.ajax({
                            type: "GET",
                            url: "../api/manual-journal/account-by-id/"+paid_through_id,
                            success: function (response1) {
                                acc_name = response1.account_name;
                                if(paid_through_id == 3)
                                {
                                    var note            = "Amount: "+amount+" TK, Via Cash";
                                }
                                else if(Object.values(response.data)[0] === undefined || Object.values(response.data)[0] == null)
                                {
                                    var note            = "Amount: "+amount+" TK, "+ (issue_date != "" ? " on "+issue_date : "" )+ " Via "+acc_name;
                                }
                                else
                                {
                                    var note            = "Amount: "+amount+" TK, "+ (issue_date != "" ? " on "+issue_date : "" )+ " using Cheque Number: "+Object.values(response.data)[0]+", from "+acc_name;
                                }
                                
                                $("#general_note").empty();
                                $("#general_note").append(note);
                            }
                        });
                    }
                });
                $('#cheque_number_container, #issue_date_container').show(800);
                $('#cheque_number_container, #issue_date_container').attr('required', true);
            }else{
                $('#cheque_number_container, #issue_date_container').hide(800);
                $('#cheque_number_container, #issue_date_container').attr('required', false);
                $('#cheque_number_container input, #issue_date_container input').val('');
            }
        }

    // $("#check_journal_entry").on("click",function () {
    //     $("#journal_entry_details").toggle(800);

    //     var due_amount          = parseFloat($("#dueAmount").html());
    //     var paid_payment        = parseFloat($("#paidAmount").html());
    //     var product_total       = parseFloat($("#subTotalShow").html());

    //     var total_row           = parseInt($(".getJournalAccountList").size());
    //     var totalDebit          = 0;
    //     var totalCredit         = 0;
    //     var grand_total         = parseFloat($("#totalAmountShow").text());
    //     var total_item          = parseInt($(".getProductList").size());


    //     //Journal tr 0 Account Payable
    //     //show Account Payable in credit
    //     if(due_amount > 0 && ajax_data.account_payable !== null){

    //         $(".journal_tr_0").show();
    //         $("#credit_0").val(due_amount.toFixed(2));

    //         var ajax_data_account_payable_id = ajax_data.account_payable['id'];

    //         $("#account_id_0").children('[value="'+ajax_data_account_payable_id+'"]').attr('selected', true);

    //     }else{
    //         $(".journal_tr_0").hide();
    //     }

    //     $(".journal_tr_1").hide();

    //     //Journal tr 2 Cash Account
    //     //show Total BDT Amount in credit
    //     if( paid_payment  > 0 && ajax_data.cash_account !== null ){

    //         $(".journal_tr_2").show();
    //         $("#credit_2").val(paid_payment.toFixed(2));

    //         var ajax_data_cash_account_id = ajax_data.cash_account['id'];

    //         $("#account_id_2").children('[value="'+ajax_data_cash_account_id+'"]').attr('selected', true);
    //     }else{
    //         $(".journal_tr_2").hide();
    //     }

    //     //Journal tr 3 Purchase Account
    //     //show Total BDT Amount in credit
    //     if( product_total  > 0 && ajax_data.purchase_account !== null ){

    //         $(".journal_tr_3").show();
    //         $("#debit_3").val(product_total.toFixed(2));

    //         var ajax_data_purchase_account_id = ajax_data.purchase_account['id'];

    //         $("#account_id_3").children('[value="'+ajax_data_purchase_account_id+'"]').attr('selected', true);

    //     }else{
    //         $(".journal_tr_3").hide();
    //     }



    //     /*Total Debit*/
    //     $(".debit").each(function(){
    //         if(parseFloat($(this).val()) > 0){
    //             totalDebit += parseFloat($(this).val());
    //         }
    //     });

    //     if(totalDebit > 0){
    //         $("#totalDebit").val(totalDebit.toFixed(2));
    //     }
    //     /*Total Debit End*/

    //     /*Total Credit*/
    //     $(".credit").each(function(){
    //         if(parseFloat($(this).val()) > 0){
    //             totalCredit += parseFloat($(this).val());
    //         }
    //     });

    //     if(totalCredit > 0){
    //         $("#totalCredit").val(totalCredit.toFixed(2));
    //     }
    //     /*Total Credit End*/

    //     /*Show Submit Button*/
    //     var total_debit = $("#totalDebit").val();
    //     var total_credit = $("#totalCredit").val();

    //     if(total_debit == total_credit && total_item > 0 && grand_total > 0 && due_amount >= 0){
    //         $("#submit").show();
    //     }else{
    //         $("#submit").hide();
    //     }
    //     /*Show Submit Button End*/
        
    //     $.fn.select2.amd.require(['select2/compat/matcher'], function (oldMatcher) {
                        
    //         $(".single_select2").select2({
    //         matcher: oldMatcher(matchStart)
    //         })
    //     });

    // });

</script>
<script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
<script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection