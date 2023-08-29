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
    </style>
@endsection

@section('content')
@include('inc.choose-variation-modal')
    <div class="uk-grid" >
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('bill_update',['id' => $bill->id]), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile', 'files' => 'true', 'enctype' => "multipart/form-data", 'novalidate']) !!}

            <input type="hidden" ng-init="bill_id='asdfg'" value="{{$bill->id}}" name="bill_id" ng-model="bill_id">
            
            @php
                $i = null;
            @endphp

            <div class="uk-margin-top">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-5">
                        <label class="uk-vertical-align-middle" for="branch_name"> Branch </label> <br>
                        <select data-uk-tooltip="{pos:'top'}"
                            class="md-input select2-single-search-dropdown" title="Select Branch"
                            id="branch_id" name="branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ $branch->id == $bill->branch_id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-width-medium-1-5">
                        <label class="uk-vertical-align-middle" for="vendor_id"> Name <span
                                class="uk-badge"><a data-toggle="uk-modal"
                                    data-uk-modal="{target:'#addContact'}" id="contact-modal" type="submit"
                                    class="sm-btn sm-btn-primary" onclick="openContactModal(this)">Create Contact</a></span></label> <br>
                        <select data-uk-tooltip="{pos:'top'}"
                            class="md-input select2-single-search-dropdown" title="Select Vendor"
                            id="vendor_id" name="vendor_id" required>
                            <option value="">Select Vendor</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ $vendor->id == $bill->vendor_id ? 'selected' : '' }}>{{ $vendor->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-width-medium-1-5">
                        <label class="uk-vertical-align-middle" for="project_contact_id"> Project</label> <br>
                        <select data-uk-tooltip="{pos:'top'}"
                            class="md-input select2-single-search-dropdown" title="Select Project"
                            id="project_contact_id" name="project_contact_id">
                            <option value="">Select Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ $project->id == $bill->project_contact_id ? 'selected' : '' }}>{{ $project->display_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="uk-width-medium-1-5">
                        <label for="invoice_number">Order No</label>
                        <input class="md-input" type="text" id="order_number" name="order_number" value="{{ $bill->order_number }}"/>
                    </div>

                    <div class="uk-width-medium-1-5">
                        <label for="bill_date">Bill Date</label>
                        <input class="md-input" type="text" id="bill_date" name="bill_date"
                            value="{{ date('d-m-Y', strtotime($bill->bill_date)) }}"
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
                                            <th class="uk-text-nowrap">Unit<span style="color: red;"
                                                class="asterisc">*</span></th>
                                    <th class="uk-text-nowrap" style="min-width: 120px">Rate<span style="color: red;"
                                            class="asterisc">*</span></th>
                                    <th class="uk-text-nowrap" style="min-width: 120px">Discount</th>
                                    <th class="uk-text-nowrap">Amount</th>
                                    <th class="uk-text-nowrap" width="20%">Account</th>
                                    <th class="uk-text-nowrap">Action</th>
                                </tr>
                            </thead>

                            <tbody class="getMultipleRowItems">
                                @foreach ($bill->billEntries as $key => $bill_entry)
                                    @php
                                        $i[$bill_entry->id] = $key;
                                    @endphp
                                    <tr class="tr_{{ $key }}" id="data_clone">
                                        <td>
                                            <p style="padding-top: 10px">{{ $key+1 }}</p>
                                        </td>
                                        <td style="width: 200px">
                                            <select id="item_id_{{ $key }}"
                                                class="getProductList md-input itemId item_select select2-single-search-dropdown"
                                                name="item_id[]" onchange="itemChanged(this, `purchase`); getItemPrice({{ $key }}); calculatePcsToCtn(this)" required>
                                            </select>
                                            <a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, 'purchase')"
                                            data-uk-modal="{target:'#chooseVariation'}" id="choose_variation_modal_{{ $key }}" type="submit"
                                            class="sm-btn sm-btn-primary variation-button">
                                                <span
                                                class="uk-badge uk-align-center uk-margin-small-top">
                                                    Choose Variation
                                                </span>
                                            </a>
                                            <input id="selected_variation_{{ $key }}" name="selected_variation[]" type="number" style="display: none" value="{{ isset($bill_entry->variation->id) ? $bill_entry->variation->id : '' }}">
                                            @if ($bill_entry->variation_id)
                                            <div class="uk-text-center" id="variation_badge_container_{{ $key }}">
                                                <span class="uk-badge uk-text-nowrap" id="variation_badge_{{ $key }}">Selected Variation: {{ $bill_entry->variation->variation_name }}</span>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="text" id="description_{{ $key }}" class="md-input description"
                                                name="description[]" oninput="calculateActualAmount({{ $key }})" value="{{ $bill_entry->description }}">
                                        </td>
                                        <td>
                                            <input type="text" id="quantity_ctn_{{ $key }}" name="quantity_ctn[]"
                                                class="md-input quantity" value="{{ !empty($bill_entry->variation_id) ? ($bill_entry->variation->carton_size == 0 ? ($bill_entry->item->carton_size == 0 ? 0 : $bill_entry->quantity/$bill_entry->item->carton_size )  : $bill_entry->quantity/$bill_entry->variation->carton_size) : ($bill_entry->item->carton_size * $bill_entry->basic_unit_conversion == 0 ? 0 : $bill_entry->quantity / ($bill_entry->item->carton_size * $bill_entry->basic_unit_conversion)) }}"
                                                oninput="calculateCtnToPcs(this); checkOffer({{ $key }})"/>
                                        </td>
                                        <td>
                                            <input type="text" id="quantity_pcs_{{ $key }}" name="quantity_pcs[]"
                                                class="md-input quantity" value="{{$bill_entry->unit_id?$bill_entry->quantity/$bill_entry->basic_unit_conversion: $bill_entry->quantity}}"
                                                oninput="calculateActualAmount({{ $key }}); calculatePcsToCtn(this); checkOffer({{ $key }})" />
                                        </td>
                                         <td>         
                                                <select  id="unit_id_{{ $key }}"  name="unit_id[]" class="select2-single-search-dropdown"
                                                    required >
                                                    <option value="">Select Unit</option>
                                                    @foreach($units as $unit)
                                                    <option value="{{ $unit->id }}"{{ $unit->id == $bill_entry->unit_id?'selected':''}}>
                                                        {{ $unit->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            
                                            @if ($errors->has('unit_id.*'))
                                                    <span class="error" style="color: red">
                                                        Unit is required
                                                    </span>                                                                
                                             @endif
                                            </td>
                                        <td>
                                            <div style="position: relative">
                                                <input type="text" id="rate_{{ $key }}" name="rate[]" class="md-input rate"
                                                    value="{{ $bill_entry->rate }}" oninput="calculateActualAmount({{ $key }})" required />
                                                <select name="rate_type[]" id="rate_type_{{ $key }}" style="position: absolute; right: -5px; top: -5px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount({{ $key }})">
                                                    <option value="0" {{ $bill_entry->rate_type == 0 ? 'selected' : '' }}>pcs</option>
                                                    <option value="1" {{ $bill_entry->rate_type == 1 ? 'selected' : '' }}>ctn</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="position: relative">
                                                <input id="discount_{{ $key }}" type="text" class="md-input discount" name="discount[]" value="{{ $bill_entry->discount }}" oninput="calculateActualAmount({{ $key }})">
                                                <select name="discount_type[]" id="discount_type_{{ $key }}" style="position: absolute; right: -5px; top: -5px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount({{ $key }})">
                                                    <option value="1" {{ $bill_entry->discount_type == 1 ? 'selected' : '' }}>Tk</option>
                                                    <option value="0" {{ $bill_entry->discount_type == 0 ? 'selected' : '' }}>%</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" id="amount_{{ $key }}" name="amount[]"
                                                class="md-input amount" value="{{ $bill_entry->amount }}"
                                                oninput="calculateActualAmount({{ $key }})" readonly="readonly" />
                                        </td>
                                        <td>
                                            <div>
                                                <select id="account_id_{{ $key }}"
                                                    class="md-input accountId md-input select2-single-search-dropdown"
                                                    name="account_id[]" required>
                                                    <option value="" selected>Select Account</option>
                                                    @if(!empty($account) && (count($account) > 0))
                                                    @foreach($accounts as $account_value)
                                                    <option value="{{ $account_value->id }}" {{$account_value->id==
                                                        $bill_entry->account_id ? 'selected':''}}>{{ $account_value->account_name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <input type="text" style="width: 50%; {{ $bill_entry->item->item_category_id != 3 ? 'display:none' : '' }}" class="md-input uk-align-center" name="depreciation_rate[]" id="depreciation_rate_{{ $key }}" placeholder="Depreciation Rate" value = {{ $bill_entry->depreciation != 0 ? $bill_entry->depreciation : '' }}>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            @if ($loop->first)
                                                <a href="#" class="add_field_button_items">
                                                    <i style="padding-top: 10px"
                                                        class="material-icons md-36">&#xE146;</i>
                                                </a>
                                            @else
                                                <a href="#" class="remove_field" onclick="rowRemoved({{ $key }})">
                                                    <i style="padding-top: 5px"
                                                        class="material-icons md-36">delete</i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <table style="float:right;margin-top:-20px !important; "
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
                    </div>
                    <div style="display: none" class="uk-width-medium-1-2 uk-margin-small-top uk-margin-medium-bottom">
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                                <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa; ">
                                    Add New Payment
                                </div>
                            </div>
                            <div class="uk-width-1-2"
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
                                        <input class="md-input" type="number" id="payment_amount"
                                            name="payment_amount" value="{{ old(" payment_amount") }}" oninput="calculateActualAmount(0)" />
                                    </div>

                                    <div class="uk-width-medium-1-2">
                                        <label class="uk-vertical-align-middle" for="payment_account">Paid Through
                                            <span style="color:red">*</span></label> <br>

                                        <select name="payment_account" id="payment_account"
                                            class="md-input select2-single-search-dropdown"
                                            data-uk-tooltip="{pos:'top'}" title="Select Account">
                                            <option value="" disabled selected hidden>Select...</option>
                                            @foreach($account as $value)
                                            @if($value->id==3)
                                            <option selected value="{{ $value->id }}">{{ $value->account_name }}
                                            </option>
                                            @else
                                            <option value="{{ $value->id }}">{{ $value->account_name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
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
                            <div class="uk-width-1-2">
                                <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa; ">
                                    Adjust from Advance Payments
                                </div>
                            </div>
                            <div class="uk-width-1-2"
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
                                        <input class="md-input" type="number" id="payment_amount_advance"
                                            name="payment_amount_advance" value="{{ old(" payment_amount_advance") }}" oninput="calculateActualAmount(0)"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                                <div style=" padding:10px;height: 40px; color: white; background-color: #2991fa; ">
                                    Adjust from Vendor Credit
                                </div>
                            </div>
                            <div class="uk-width-1-2"
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
                                        <input class="md-input" type="number" id="credit_amount_advance"
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
                                    <td>Adjustment</td>
                                    <td style="width: 10%;">
                                          <div class="md-input-wrapper md-input-filled"><select style="padding-top: 19px;" class="md-input adjustment_type" id="adjustment_type" name="adjustment_type" onchange="calculateActualAmount(0)">
                                              <option value="1" {{ $bill->adjustment_type == 1 ? 'selected': '' }}>BDT</option>
                                              <option value="0" {{ $bill->adjustment_type == 0 ? 'selected': '' }}>%</option>
                                          </select><span class="md-input-bar "></span></div>
                                    </td>
                                    <td colspan="3">
                                        <div class="md-input-wrapper md-input-filled"><input type="text" id="adjustment" name="adjustment" class="md-input md-input-width-medium" value="{{ $bill->adjustment }}" oninput="calculateActualAmount(0)"><span class="md-input-bar "></span></div>
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
                                            value="{{ $bill->total_tax*100/(($bill->amount - $bill->total_tax) == 0 ? 1 : $bill->amount - $bill->total_tax) }}" oninput="calculateActualAmount(0)" />
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
                                            id="dueAmount">{{ $bill->due_amount }}</a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <input type="hidden" id="subTotal" name="sub_total">
                        <input type="hidden" id="totalAmount" name="total_amount">
                        <input type="hidden" id="vat_total" name="tax_total">
                        <input type="hidden" id="total_paid" name="total_paid">
                        <input type="hidden" id="total_due" name="total_due" value="{{ $bill->due_amount }}">
                    </div>
                </div>
                <div class="uk-grid" style="{{ count($bill->billFreeEntries) < 1 ? 'display:none;' : '' }}" id="free_entry_header">
                    <div class="uk-width-1-1">
                        <div style=" padding:10px;height: 40px; color: white; background-color: #1976d2 ">
                            Offers & Free Products
                        </div>
                    </div>
                </div>
                <div class="uk-grid" style="{{ count($bill->billFreeEntries) < 1 ? 'display:none;' : '' }}" id="free_entry_details">
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
                                        @foreach ($bill->billFreeEntries as $key => $bill_free_entry) 
                                            <tr class="free_entry_tr_{{ $i[$bill_free_entry->billEntry->id] }}">
                                            <td style="padding-top: 25px">
                                                <span>{{ $key + 1 }}</span>
                                            </td>
                                            <td style="padding-top: 25px">
                                                <select name="offer_details_id[{{ $i[$bill_free_entry->billEntry->id] }}]" class="form-control select2-single-search-dropdown" id="offer_details_id_{{ $i[$bill_free_entry->billEntry->id] }}" onchange="offerSelected(this)">
                                                    @foreach ( $bill_free_entry->offer->item->itemOffers as $key1 => $offer )
                                                        <option value="{{ $offer->id }}" id="offer_option_{{ $i[$bill_free_entry->billEntry->id] }}_{{ $key1 }}" {{ $offer->id == $bill_free_entry->offer_id ? 'selected' : '' }}>
                                                                {{ $offer->item->item_name }}({{ $offer->item->barcode_no }}) - {{ $offer->start_date }} - {{ $offer->end_date }}
                                                        </option>                                                        
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style="padding-top: 25px">
                                                <select name="base_item_id[{{ $i[$bill_free_entry->billEntry->id] }}]" class="form-control select2-single-search-dropdown" id="base_item_id_{{ $i[$bill_free_entry->billEntry->id] }}">
                                                    <option value="{{ $bill_free_entry->offer->item_id }}"> {{ $bill_free_entry->offer->item->item_name }} </option>
                                                </select>
                                                <div class="uk-text-center uk-margin-small-top" id="variation_badge_container_{{ $i[$bill_free_entry->billEntry->id] }}">
                                                    <span class="uk-badge uk-text-nowrap" id="variation_badge_{{ $i[$bill_free_entry->billEntry->id] }}">Selected Variation: {{ $bill_free_entry->billEntry->variation->variation_name }}</span>
                                                </div>
                                            </td>
                                            <td style="padding-top: 25px">
                                                <select name="free_item_id[{{ $i[$bill_free_entry->billEntry->id] }}]" class="form-control select2-single-search-dropdown" id="free_item_id_{{ $i[$bill_free_entry->billEntry->id] }}">
                                                        @if ($bill_free_entry->free_item_id != null)
                                                            <option value="{{ $bill_free_entry->free_item_id }}">{{ $bill_free_entry->freeItem->item_name }}</option> 
                                                        @else
                                                            <option value="">Select Free Item</option>
                                                        @endif
                                                </select>
                                                <div class="uk-text-center uk-margin-small-top" id="variation_badge_container_{{ $i[$bill_free_entry->billEntry->id] }}">
                                                    @if ($bill_free_entry->free_item_variation_id != null)
                                                        <span class="uk-badge uk-text-nowrap" id="variation_badge_{{ $i[$bill_free_entry->billEntry->id] }}">Selected Variation: {{ $bill_free_entry->freeItemVariation->variation_name }}</span>
                                                    @endif
                                                </div>
                                                <input id="selected_free_variation_{{ $i[$bill_free_entry->billEntry->id] }}" name="selected_free_variation[]" type="number" style="display: none" value='{{ empty($bill_free_entry->free_item_variation_id) ? "" : $bill_free_entry->free_item_variation_id }}'>
                                            </td>
                                            <td>
                                                <input type="text" class="md-input" name="free_item_quantity[{{ $i[$bill_free_entry->billEntry->id] }}]" oninput="calculateFreeEntry('{{ $i[$bill_free_entry->billEntry->id] }}')" id="free_item_quantity_id_'{{ $i[$bill_free_entry->billEntry->id] }}" value="{{ $bill_free_entry->free_item_quantity == null ? 0 : $bill_free_entry->free_item_quantity }}">
                                            </td>
                                            <td>
                                                <div style="position: relative">
                                                    <input type="text" class="md-input" name="offer_amount[{{ $i[$bill_free_entry->billEntry->id] }}]" oninput="calculateFreeEntry({{ $i[$bill_free_entry->billEntry->id] }})" id="offer_amount_id_{{ $i[$bill_free_entry->billEntry->id] }}" value="{{ $bill_free_entry->offer_amount == null ? 0 : $bill_free_entry->offer_amount }}">
                                                    <select name="offer_amount_type[{{ $i[$bill_free_entry->billEntry->id] }}]" style="position: absolute; top: 0; right: 0; margin-top: 10px; border: none" id="offer_amount_type_id_{{ $i[$bill_free_entry->billEntry->id] }}">
                                                        <option value="">Type</option>
                                                        <option value="0" {{ $bill_free_entry->offer_amount_type == 0 ? 'selected' : '' }} >Tk</option>
                                                        <option value="1" {{ $bill_free_entry->offer_amount_type == 1 ? 'selected' : '' }} >%</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-3-3">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <label for="general_note"> Note</label>
                                <textarea class="md-input" id="general_note"
                                    name="general_note">{{ $bill->note }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <p>
                    @if($errors->has('payment_account')|| $errors->has('payment_amount'))
                    <span
                        style="color:red; position: relative; right:0px; margin: 5px 0px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">{!!
                        "Payment field required" !!}</span>

                    @endif
                </p>
                <div class="uk-grid">
                    <div class="uk-width-medium-1-3 uk-margin-medium-top">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                @if($bill->file_name)
                                    <a href="{{ url('bill/bill-download'.'/'.$bill->file_name) }}"><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
                                @endif
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
                <hr>

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
@endsection

@section('scripts')
    <script type="text/javascript">
        var ajax_data       = [];
        var bill_entries    = <?php echo $bill->billEntries; ?>;
        var items_chosen    = [];
        $.each(bill_entries, function (indexInArray, bill_entry) { 
             items_chosen[indexInArray] = bill_entry.item;
             items_chosen[indexInArray]['variation_id'] = bill_entry.variation_id;
             items_chosen[indexInArray]['variations'] = [];
        });
        $( document ).ready(function() {
            $.get("{{route('item_list')}}/", function(data){

                $.each(data, function(i, data){
                    ajax_data[data.id] = data;
                });

                $.each(bill_entries, function (x, valueOfElement) {
                    var list5 = '';
                    var list7 = '<option value = "">' + 'Select Product ' +'</option>';
                    ajax_data.forEach(element => {
                        list5 += '<option value = "' +  element.id + '"'+(element.id == valueOfElement.item_id ? 'selected' : '' )+'>' + element.barcode_no + ', ' + element.item_name +'</option>';
                    });

                    $("#item_id_"+x).empty();
                    $("#item_id_"+x).append(list7);
                    $("#item_id_"+x).append(list5);
                });

                $('.select2-single-search-dropdown').select2();
            });

            $.each(items_chosen, function (indexInArray, item_chosen) {
                $.get("/api/inventory/check-variation/"+item_chosen.id, function (data) {
                    $.each(data.variations, function (indexInArrayOfVariation, variation) {
                        items_chosen[indexInArray]['variations'][variation.id] = variation;
                    });
                });
            });

            calculateActualAmount(0);
        });

        function func(x)
        {
            $.get("{{route('item_list',['z'=>''])}}/"+ z, function(data){
                var list2 = '';
                var list4 = '';

                $.each(data, function(i, data)
                {
                    list4 += '<option value = "' +  data.id + '">' + data.barcode_no + ', ' + data.item_name +'</option>';

                });

                list2 += '<option value = "">' + 'Select Product ' +'</option>';

                $("#item_id_0").empty();
                $("#item_id_0").append(list2);
                $("#item_id_0").append(list4);
            });
        }
        var max_fields     = 50;                           //maximum input boxes allowed
        var wrapper        = $(".input_fields_wrap");      //Fields wrapper
        var add_button     = $(".add_field_button_items");       //Add button ID

        //For apending another rows start
        var x = 0;
        var total_val = 0;
        $(add_button).click(function(e){
            e.preventDefault();

            var x = parseInt($('.getMultipleRowItems tr:last').attr('class').match(/(\d+)/g)[0]);

            if(x < max_fields){
                x++;

                var serial = x + 1;

                $.get("{{route('item_list')}}/", function(data){

                    var list5 = '';
                    var list7 = '';

                    $.each(data, function(i, data)
                    {
                        list5 += '<option value = "' +  data.id + '">' + data.barcode_no + ', ' + data.item_name +'</option>';

                    });

                    list7 += '<option value = "">' + 'Select Product ' +'</option>';

                    $("#item_id_"+x).empty();
                    $("#item_id_"+x).append(list7);
                    $("#item_id_"+x).append(list5);
                });

                $('.getMultipleRowItems').append( ' ' +'<tr class="tr_'+x+'">'+
                    '<td>\n'+'<p style="padding-top: 10px">'+serial+'</p>'+'</td>\n'+
                    '<td style="width: 200px">\n'+
                    '<div class="md-input-wrapper md-input-filled md-input-wrapper-success">\n'+
                    '<select id="item_id_'+x+'" class="getProductList md-input itemId item_select select2-single-search-dropdown" name="item_id[]" onchange="itemChanged(this, `purchase`); getItemPrice('+ x +'); calculatePcsToCtn(this)">\n</select>\n'+
                    '</div>\n'+
                    '<a data-toggle="uk-modal" onclick="chooseVariationBtnClicked(this, `purchase`)" data-uk-modal="{target:`#chooseVariation`}" id="choose_variation_modal_'+ x +'" type="submit" class="sm-btn sm-btn-primary variation-button">\n'+
                    '<span class="uk-badge uk-align-center uk-margin-small-top">Choose Variation</span>\n</a>\n'+
                    '<input id="selected_variation_'+x+'" name="selected_variation[]" type="number" style="display: none" value="">'+
                    '</td>\n'+
                    '<td>\n'+'<input type="text" id="description'+x+'" class="md-input description" name="description[]" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_ctn_'+x+'" class="md-input quantity" name="quantity_ctn[]" value="1" oninput="calculateCtnToPcs(this); checkOffer('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="quantity_pcs_'+x+'" class="md-input quantity" name="quantity_pcs[]" value="1" oninput="calculateActualAmount('+x+'); calculatePcsToCtn(this); checkOffer('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<select name="unit_id[]" id="unit_id_'+x+'" class="md-input  single_select2"  required>\n'+ '<option value="">Select Unit</option>\n'+ ' @foreach($units as $unit) <option  value="{{ $unit->id }}">{{ $unit->name }}</option> @endforeach</select>\n'+'</td>\n'+

                    '<td>\n'+
                    '<div style="position: relative">\n<input type="text" id="rate_'+x+'" class="md-input rate" name="rate[]" value="0.00" oninput="calculateActualAmount('+x+')"/>\n'+
                    '<select name="rate_type[]" id="rate_type_'+x+'" style="position: absolute; right: -5px; top: 12px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount('+x+')">\n'+
                    '<option value="0">pcs</option><option value="1">ctn</option></select></div>'+'</td>\n'+
                    '<td>\n'+'<div style="position: relative">\n<input type="text" id="discount_'+x+'" class="md-input discount" name="discount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+
                    '<select name="discount_type[]" id="discount_type_'+x+'" style="position: absolute; right: -5px; top: 12px; border: none; border-bottom: 1px solid #ccc" onchange="calculateActualAmount('+x+')">\n'+
                    '<option value="1">Tk</option><option value="0">%</option></select></div></td>\n'+
                    // '<td>\n'+'<select id="discount_type_'+x+'" name="discount_type[]" value="0" class="md-input discount_type" onchange="calculateActualAmount('+x+')">\n'+'<option value="1" selected>BDT</option>\n'+'<option value="0">%</option>\n'+'</select>\n'+'</td>\n'+
                    '<td>\n'+'<input type="text" id="amount_'+x+'" class="md-input amount" name="amount[]" value="0" oninput="calculateActualAmount('+x+')"/>\n'+'</td>\n'+
                    '<td>\n'+'<div>\n'+'<select id="account_id_'+x+'" class="md-input accountId select2-single-search-dropdown" name="account_id[]" required>\n'+ '<option value="">Select Account</option>\n'+ ' @foreach($accounts as $account_all) <option {{ $account_all->id== 26 ? "selected":""}} value="{{ $account_all->id }}">{{ $account_all->account_name }}</option> @endforeach</select>\n'+''+'</div>\n'+
                    '<input type="text" style="width: 50%; display:none"" class="md-input uk-align-center" name="depreciation_rate[]" id="depreciation_rate_'+x+'" placeholder="Depreciation Rate">'+
                    '</td>\n'+
                    '<td style="text-align: center">\n'+'<a href="#" class="remove_field" onclick="rowRemoved('+x+')">\n'+'<i style="padding-top: 5px" class="material-icons md-36">delete</i>\n'+'</a>\n'+'</td>\n'+
                    '</tr>\n'
                );

                $('.select2-single-search-dropdown').select2();
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

            var x = parseInt($('.getMultipleRowItems tr:last').attr('class').match(/(\d+)/g)[0]);
            x++;

            if(x>1)
            {
                $('.add_table').css('display','inline');
            }
        });

        function getItemPrice(x)
        {
            //For getting item commission information from items table start
            var item_id  = $("#item_id_"+x).val();
            if(item_id)
            {
                $.get('/bill/check/item/rate/'+ item_id, function(data){

                    $("#rate_"+x).val(data.item_purchase_rate);
                    $("#amount_"+x).val(data.item_purchase_rate);

                    calculateActualAmount(x);

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
            var adjustment              = $("#adjustment").val();
            var vat                     = $("#vat").val();
            var subTotal                = $("#subTotal").val();  
            var paid_amount             = parseFloat({!! $bill->amount !!}) - parseFloat({!! $bill->due_amount !!});

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

            if (quantity_cartoon == '' || quantity_cartoon == 0)
            {
                var quantityCtnCal         = 1;
            }else{
                var quantityCtnCal         = $("#quantity_ctn_"+x).val();
            }

            var amount = ($('#rate_type_'+x).val() == 0 ? (parseFloat(rateCal)*parseFloat(quantityCal)) : (parseFloat(rateCal)*parseFloat(quantityCtnCal))).toFixed(2);

            if(discount > 0 && amount > 0){
                amount = (amount - (($('#discount_type_'+x).val() == 0 ? (amount*discount/100) : discount))).toFixed(2);
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

            $("#adjustmentShow").html(-adjustment_value);
            $("#subTotalShow").html(subTotal);
            $("#subTotal").val(subTotal);
            $('#paidAmount').html(paid_amount.toFixed(2));
            $('#total_paid').val(paid_amount.toFixed(2));

            if (vat == '' || vat == '0.00')
            {
                var vat                = 0;
                var vat_value          = 0;
            }else{
                var vat_value                = (parseFloat(adjustment_show) *parseFloat(vat)/100);
                var vat                      = (parseFloat(adjustment_show) * parseFloat(vat))/100 ;
            }
            $("#vatShow").html(vat);
            $("#vat_total").val(vat);
            
            
            var total_amount     = parseFloat(subTotal) + parseFloat(vat) - parseFloat(adjustment_value);
            //Calculating Total Amount end
            $("#totalAmountShow").html(total_amount.toFixed(2));
            $("#totalAmount").val(total_amount.toFixed(2));
            total_val =  total_amount ;
            $('#total_due').val((parseFloat(total_amount) - paid_amount).toFixed(2));
            $('#dueAmount').html((parseFloat($('#totalAmountShow').html()) - paid_amount).toFixed(2));
        }

        function uploadLavel()
        {
            var fullPath = document.getElementById('form-file').value;
            var upload_file_name_ = document.getElementById('upload_name');
            if (fullPath) {
                var startIndex  = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename    = fullPath.substring(startIndex);
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
        var total_val =   $("#totalAmount").val();
        var index_no  =   0;
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

        var date_formate  = function (date_find){
            var today_date       = new Date(date_find);
            var year_find        = today_date.getFullYear().toString();
            var month_find       = (today_date.getMonth() + 1).toString();
            var date_find        = today_date.getDate().toString();
            var next_date_form   = (date_find[1] ? date_find:"0" + date_find[0]) + "-" + (month_find[1] ? month_find:"0" + month_find[0]) + "-" + year_find;

            return next_date_form;
        }    

        function rowRemoved(row){
            $('.free_entry_tr_'+row).remove()
            if($('.getFreeEntryRow tr').length > 0){
                $('#free_entry_header').show(400);
                $('#free_entry_details').show(800);
            }else{
                $('#free_entry_details').hide(400);
                $('#free_entry_header').hide(800);
            }
        }
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
@endsection