@extends('layouts.main')

@section('title', 'Point Of Sales')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('pos/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        #add1 {
            cursor: pointer;
        }

        #add1:hover {
            box-shadow: 0 0 11px rgba(33, 33, 33, .4) !important;
        }

        .single-list {
            cursor: pointer;
        }

        .modal {
            z-index: 100000 !important;
        }

        .select2-container--open {
            z-index: 9999999 !important;
        }

        .select2-search .select2-search--dropdown .select2-search__field {
            z-index: 9999999 !important;
        }

        .ui-dialog {
            z-index: 999;
        }

        
    </style>
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-sm-8">

                <div class="p-1 pt-3 m-4">
                    <div class="input-group flex-nowrap mb-3">
                        <input type="text" class="form-control border rounded p-2 search_input"
                            style="color: #6b93d3;z-index: 0;" placeholder="Enter item name or barcode number..."
                            aria-label="Search Products" aria-describedby="addon-wrapping" name="search" autofocus>
                        <span class="input-group-text" id="addon-wrapping" type="submit" name="submit" style="z-index: 0"><i
                                class="fas fa-search"></i></span>
                    </div>

                    <div class="d-flex justify-content-md-between mt-2">

                        <div id="btn-1" class="" type="button">
                            <a class="md-btn md-btn-wave rounded clicked category category_btn" href="javascript:void(0)"
                                id="recent" style="margin-left: 0 !important; margin-top: 5px;">Recent</a>
                            <a class="md-btn md-btn-wave rounded category_btn" href="javascript:void(0)" id="top"
                                style="margin-left: 0 !important; margin-top: 5px;">Top</a>
                            <a class="md-btn md-btn-wave rounded category_btn" href="javascript:void(0)" id="all"
                                style="margin-left: 0 !important; margin-top: 5px;">All</a>
                        </div>

                    </div>
                    <hr>
                    <div class="container-fluid p-0 m-0">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                            <div id="htmlData" class="product-flex product-container">
                                <div id="dummy" class="">
                                    <div class="container-fluid p-0 ">

                                        <div class="my-auto" style="display: flex;justify-content: center;
                               align-items: center;position: absolute;width: 100%;height: 50vh;">
                                            <div id="loader" class="spinner-border text-primary" role="status"
                                                style="display:none;width: 6rem; height: 6rem;">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>

                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 load_items">
                                            @if (!is_null($recent_items) && $recent_items->count() > 0)
                                                @foreach ($recent_items as $key => $value)
                                                    <div class="col">
                                                        <div data-product-name="{{ $value->item_name }}">
                                                            <div id="add1" value="{{ $value->item_sales_rate }}"
                                                                name="{{ $value->item_name }}"
                                                                barcode="{{ $value->barcode_no }}"
                                                                data-item-id="{{ $value->id }}"
                                                                class="min-width mx-auto md-card md-card-hover-img offcanvas_toggle">
                                                                <div
                                                                    class="md-card-head uk-text-center uk-position-relative">
                                                                    <div class="uk-badge uk-badge-danger uk-position-absolute uk-position-top-left uk-margin-left uk-margin-top"
                                                                        style="font-size:15px">
                                                                        <span style="font-size: 22px">৳</span>
                                                                        {{ $value->item_sales_rate }}
                                                                    </div>
                                                                    <img class="md-card-head-img"
                                                                        src="{{ $value->item_image_url != null ? $value->item_image_url : asset('img/1.jpg') }}"
                                                                        alt="{{ $value->item_name }}"
                                                                        style="width:100%" />
                                                                </div>
                                                                <div class="md-card-content" style="height: 80px;">
                                                                    <h4 class="heading_c uk-text-center">
                                                                        {{ $value->item_name }}
                                                                    </h4>
                                                                    <h6 class="uk-text-center">
                                                                        <b>{{ $value->barcode_no }}</b>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <img src="{{ asset('img/404.png') }}" alt="404" style="width: 100%">
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="hierarchical_show uk-margin-top" style="padding-left: 0px !important;"
                                data-uk-grid="{gutter: 10, controls: '#products_sort'}" data-show-delay="280">
                                <div id="htmlData" class="product-flex product-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 ps-0">
                <!-- Modal -->
                <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="main-modal-body">
                            <div class="modal-content select-user-container">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel" style="width: 100%">Select Customer</h5>
                                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="uk-grid d-flex justify-content-center" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <label for="customers" class="">Customers <span
                                                    style="color: red;" class="asterisc">*</span></label>
                                            <div class="main">
                                                <select id="customer" name="customer" class="select2" required
                                                    size="width: 100%;">
                                                    @foreach ($contacts as $contact)
                                                        <option value="{{ $contact->id }}"
                                                            data-phone="{{ $contact->phone_number_1 }}"
                                                            data-name="{{ $contact->display_name }}"
                                                            {{ (isset($cart) && $cart->customer->id == $contact->id) || (Auth::user()->branch_id == 3 && $contact->id == 53) ? 'selected': '' }}>
                                                            {{ $contact->phone_number_1 }} -
                                                            {{ $contact->display_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->first('customer'))
                                                <div class="uk-text-danger uk-margin-top">
                                                    {{ $errors->first('customer') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="display: flex; align-items-center">
                                    <div style="float: left; position: absolute; left: 15px;">
                                        <button class="md-btn md-btn-success add-new-customer">Add New</button>
                                    </div>
                                    <button type="button" class="md-btn md-btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" class="md-btn md-btn-primary select-this-customers">Select
                                        Customer</button>
                                </div>
                            </div>

                            {{-- add new user container --}}
                            <div class="modal-content add-new-user-container" style="display: none;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel" style="width: 100%">Add New Customer</h5>
                                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <form id="addNewCustomerForm" method="POST" action="#">
                                        {{ csrf_field() }}
                                        <div class="uk-grid d-flex" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="customer_name">Customer Name<span style="color: red;"
                                                        class="asterisc">*</span></label>
                                                <input class="form-control" type="text" id="customer_name"
                                                    name="customer_name" value="{{ old('customer_name') }}" required />
                                                @if ($errors->has('customer_name'))
                                                    <div class="uk-text-danger uk-margin-top">
                                                        {{ $errors->first('customer_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="uk-width-medium-1-1 pt-3">
                                                <label for="customer_phone">Customer Phone<span style="color: red;"
                                                        class="asterisc">*</span></label>
                                                <input class="form-control" type="number" id="customer_phone"
                                                    name="customer_phone" value="{{ old('customer_phone') }}" required />
                                                @if ($errors->has('customer_phone'))
                                                    <div class="uk-text-danger uk-margin-top">
                                                        {{ $errors->first('customer_phone') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="uk-width-medium-1-1 pt-3 d-flex justify-content-center">
                                                <button type="submit" class="md-btn md-btn-primary">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="md-btn md-btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" class="md-btn md-btn-primary select-customer"><i
                                            class="fas fa-arrow-left"></i> Select Customer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- List Modal -->

                <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="listModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="listModalLabel" style="width: 100%">Cart Hold</h5>
                                <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </div>
                            </div>
                            <div class="modal-body" style="height: 400px; overflow: scroll;">
                                @if (count($cart_holds) > 0)
                                    <ul class="list-group cart-holds">
                                        @foreach ($cart_holds as $item)
                                            <li class="list-group-item" id="cart-{{ $item->id }}">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        @if ($item->customer)
                                                            <b>{{ $item->customer->display_name }}
                                                                {{ $item->customer->phone_number_1 ? '(' . $item->customer->phone_number_1 . ')' : '' }}</b>
                                                            <br>
                                                        @endif

                                                        <small class="text-muted">
                                                            {{ date('d M Y', strtotime($item->created_at)) }} at
                                                            {{ date('h:i A', strtotime($item->created_at)) }},
                                                            {{ $item->countItems() }}
                                                            items, <span
                                                                style="font-size: 15px">৳</span>{{ $item->total }}
                                                        </small>
                                                    </div>
                                                    <div style="color:#6b93d3; cursor:pointer;" id="loadCartData"
                                                        data-cart-id="{{ $item->id }}" title="Edit cart">
                                                        <button class="md-btn md-btn-primary md-btn-mini"><i
                                                                class="fas fa-edit"></i></button>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-center">
                                        <p>
                                        <h3>Cart Hold is Empty!</h3>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="md-btn md-btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hold Modal -->

                <div class="modal fade" id="holdModal" tabindex="-1" role="dialog" aria-labelledby="holdModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="listModalLabel" style="float: left; width: 100%;">Cart Hold
                                </h5>
                                <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </div>
                            </div>
                            <div class="modal-body submit-cart-header">
                                Save This Cart for Later?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="md-btn md-btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success submit-cart"
                                    style="display: flex; justify-content: center; align-items: center;">Save The Current
                                    Cart</button>
                            </div>
                            <input type="hidden" id="get_loaded_cart_id" name="get_loaded_cart_id" value="">
                        </div>
                    </div>
                </div>


                <!-- Modal End -->

                <div class="container-fluid ps-0 me-5" style="position: fixed; height: 90vh;">
                    <div id="cart" class="bg-white"
                        style="max-width: 30%; right: 3px; padding-left: 0px; margin-left: 0px; border-left: 1px solid #ccc">
                        <div class="md-card-toolbar uk-sticky" style="padding-left: 10px; padding-right: 10px">
                            <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
                                <div class="ms-2" id="deleteCart">
                                    <i style="font-size: 2rem; color: rgb(116, 10, 10); cursor: pointer;"
                                        class="uk-icon-trash-o"></i>
                                </div>
                                <h3 class="md-card-toolbar-heading-text js_hidden sticky uk-text-bold" style="">
                                    Cart
                                </h3>
                                <div class="d-flex">
                                    <div id="addbox" class="me-2"
                                        style="color: #6b93d3; margin-right: 15px !important;" data-toggle="modal"
                                        data-target="#userModal">
                                        <i style="font-size: 1.7rem; color: #6b93d3; cursor: pointer;"
                                            class="far fa-user fa-lg">
                                        </i>
                                    </div>
                                    <div class="me-3" style="color: #6b93d3 " data-toggle="modal"
                                        data-target="#listModal" onclick="listCart()">
                                        <i style="font-size: 1.7rem; color: #6b93d3; cursor: pointer;"
                                            class="uk-icon-th-list"></i>
                                    </div>
                                    <div class="me-2" style="color: #6b93d3 ;" data-toggle="modal"
                                        data-target="#holdModal" onclick="holdCart()">
                                        <i style="font-size: 1.7rem; color: #6b93d3; cursor: pointer;"
                                            class="uk-hover uk-icon-save">
                                        </i>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" value="" id="check_if_customer">


                            <button class="btn btn-primary" style="display: none;" id="offcanvas-btn" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                aria-controls="offcanvasRight">Toggle
                                Offcanvas</button>

                            <div class="offcanvas offcanvas-end" style="bottom:5px; top: 50px;" tabindex="-1"
                                id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header mt-3 mb-0">
                                    <h5 id="offcanvasRightLabel">Product Details</h5>

                                    <button id="close-btn" type="button" class="btn-close text-reset"
                                        data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body pt-0 mt-0" style="overflow-y: hidden;">

                                    {{-- <div class="my-auto" style="display: flex;justify-content: center;
										align-items: center;position: absolute;width: 100%;height: 50vh;">
									<div id="offcanvas-loader" class="spinner-border text-primary" role="status"
										style="display:none;width: 6rem; height: 6rem;">
										<span class="visually-hidden">Loading...</span>
									</div>
								</div> --}}

                                    <div class="laod-item-offcanvas"></div>

                                </div>
                            </div>


                            <!-- main -->
                            <div class="uk-width-large-1-3 uk-width-medium-1-2"
                                style="width:100%;  margin-top: 10px; overflow-y: auto; ">

                                <div class="my-auto" style="display: flex;justify-content: center;
                                     align-items: center;position: absolute;width: 25%;height: 20vh;">
                                    <div id="main-cart-loader" class="spinner-border text-primary" role="status"
                                        style="display:none;width: 6rem; height: 6rem;">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>

                                <ul id="cart-list" class="md-list scroller uk-padding-small">

                                </ul>
                            </div>
                        </div>

                        <!-- Calculation -->
                        <div id="costlist" class="uk-width-large-1-3 uk-width-medium-1-2"
                            style="width:100%; padding-left:10px; padding-right : 10px; margin-top:32px !important; border-top: 1px solid #ccc;">
                            <ul class="md-list ">
                                <li class="">
                                    <div class="md-list-content d-flex justify-content-between align-items-center">
                                        <h6 class="m-2">Subtotal</h6>
                                        <h6 class="m-2 me-0 qtn-box text-end"
                                            style="display: flex; justify-content: flex-end;">
                                            ৳ <span class="cart-inputs" id="cart-subtotal"
                                                style="padding-left: 2px">0</span>
                                        </h6>
                                    </div>
                                </li>

                                <li class="pb-1 ">
                                    <div class="md-list-content   d-flex justify-content-between align-items-center">
                                        <h6 class="m-2 ">Discount</h6>

                                        <div class="input-group p-0 h-50" style="width: 30%">
                                            <div class="input-group-text"
                                                style="padding: 0 !important; border: 0 !important;">
                                                <div class="btn-group" id="cart-options" data-toggle="buttons">
                                                    <label class="btn btn-default cart-discount-type">
                                                        <input type="radio" name="cart-option" id="option1"
                                                            value="percent"><i class="fas fa-percentage"></i>
                                                    </label>
                                                    <label class="btn btn-default cart-discount-type active">
                                                        <input type="radio" name="cart-option" id="option2" value="money"><i
                                                            class="fas fa-dollar-sign"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control cart-inputs" id="cart-discount"
                                                name="discount" value="0">
                                        </div>
                                        <h6 id="discount" class="qtn-box text-end" style="width: 100px !important">
                                            ৳ <span class="cart-inputs" id="cart-discount-append"
                                                style="padding-left: 2px">0</span>
                                        </h6>
                                    </div>
                                </li>
                                <li class="pb-0 mb-0">
                                    <div class="md-list-content  d-flex justify-content-between align-items-center">
                                        <h6 class="m-2">Tax (%) </h6>

                                        <div class="input-group p-0 ms-3" style="width: 30%">
                                            <input type="number" class="form-control cart-inputs" value="0"
                                                aria-label="taxinput" aria-describedby="basic-addon1" id="cart-tax">
                                        </div>
                                        <h6 id="tax" class="qtn-box text-end" style="width: 100px !important">
                                            ৳ <span class="cart-inputs" id="cart-tax-append"
                                                style="padding-left: 2px">0</span>
                                        </h6>
                                    </div>
                                </li>
                                <li class="pb-0 mb-0">
                                    <div class="md-list-content  d-flex justify-content-between align-items-center">
                                        <h6 class="m-2">Shipping </h6>

                                        <div class="input-group p-0 ms-1" style="width: 30%">
                                            <input type="number" class="form-control cart-inputs" aria-label="shipinput"
                                                aria-describedby="basic-addon1" value="0" id="cart-shipping">
                                        </div>
                                        <h6 id="ship" class="qtn-box text-end" style="width: 100px !important">
                                            ৳ <span class="cart-inputs" id="cart-shipping-append"
                                                style="padding-left: 2px">0</span>
                                        </h6>
                                    </div>
                                </li>

                                <li class="pb-0 mb-0">
                                    <div class="md-list-content d-flex justify-content-between align-items-center">
                                        <h5 class="m-2">Total</h5>
                                        <h5 id="total" class="mb-0 pb-0">
                                            ৳ <span class="cart-inputs" id="cart-total"
                                                style="padding-left: 2px">0</span>
                                        </h5>
                                    </div>
                                </li>

                            </ul>

                            <div class="">
                                <button type="button" id="confirm-cart"
                                    class="md-btn md-btn-primary md-btn-block md-btn-wave-light"
                                    style="padding: 5px;">Charge</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://kit.fontawesome.com/9bca460c29.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('pos/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript">
        //Select2
        var select2 = function() {
            $('.main .select2').select2({
                width: '100%',
                tags: true,
                placeholder: "Select a customer",
                allowClear: true,
                closeOnSelect: true,
                dropdownParent: $("#userModal")
            });
        }

        $(document).ready(function() {
            select2();
        });

        //toastr options
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        //select default customer 
        $(window).on('load', function() {
            var customer_id = $('#customer').val();
            $('#check_if_customer').val(customer_id);
        });

        //Load Items
        $(document).on('click', '.category_btn', function() {
            var button_id = $(this).attr('id');
            $(this).addClass('clicked').siblings().removeClass('clicked');

            $('.load_items').html('');
            $('.search_input').val('');
            $('#loader').css('display', 'block');

            $.ajax({
                type: "get",
                url: "{{ route('point_of_sales_ajax') }}",
                data: {
                    button_id: button_id
                },
                success: function(res) {
                    $('.load_items').html(res.view);
                    $('#loader').css('display', 'none');
                }
            });
        });

        //Search Items
        var timeout = null;
        $(".search_input").on('input', function() {
            if (timeout) {
                clearTimeout(timeout);
            }
            var value = $('.search_input').val();

            if (!isNaN(value) && value.length != 0) {
                if (value.length >= 6) {
                    function barcodeAjaxCall() {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('point_of_sales_ajax') }}",
                            data: {
                                barcode_no: value,
                                button_id: 'getItemForBarcode'
                            },
                        }).done(function(res) {
                            if (res.status == 'error') {
                                // toastr.warning(res.msg);
								console.log(res.msg);
                            } else {
                                var product = {
                                    'item_id': res.item['id'],
                                    'rate': res.item['item_sales_rate'],
                                    'discount_type': 'percent',
                                    'discount': 0,
                                    'item_image': res.item['item_image_url'],
                                    'item_name': res.item['item_name'],
                                    'total': res.item['item_sales_rate'],
                                    'quantity': 1,
                                    'item_sales_rate': res.item['item_sales_rate'],
                                    'cart_entry_id': null
                                };

                                offcanvasFormSubmit(product, true);
                            }

                            timeout = null;
                        });
                    }

                    timeout = setTimeout(barcodeAjaxCall, 1000);
                }
            } else if (isNaN(value)) {
                if ($('.category_btn').hasClass('clicked')) {
                    $('.category_btn').removeClass('clicked');
                };

                $('.load_items').html('');
                $('#loader').css('display', 'block');

                function ajaxCall() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('point_of_sales_ajax') }}",
                        data: {
                            item_data: value,
                            button_id: 'search'
                        },
                        success: function(res) {
                            $('.load_items').html(res.view);
                            $('#loader').css('display', 'none');
                        }
                    });
                }

                ajaxCall();
            }
        });

        var getItemDetails = function(item_id) {

            $.ajax({
                type: "GET",
                url: "{{ route('point_of_sales_ajax') }}",
                data: {
                    item_id: item_id,
                    button_id: 'getItemData'
                },
                success: function(res) {
                    $('.laod-item-offcanvas').html(res.view);
                    $('#offcanvas-form-submit').text('Add to Cart');

                    $.each(cart, function(index, value) {
                        if (value.item_id == item_id) {
                            $('#quantity').val(value.quantity);
                            $('#rate').val(value.rate);
                            $('.discount-type.active').removeClass('active');
                            $('input[name="option"][value="' + value.discount_type + '"]').closest(
                                '.discount-type').addClass('active');
                            $('input[name="option"][value="' + value.discount_type + '"]').prop(
                                'checked', true);
                            $('#discount').val(value.discount);
                            $('#offcanvas-form-submit').text('Update Cart');

                            calculate();
                        }
                    });

                    $('#offcanvas-loader').css('display', 'none');
                }
            });
        }

        //Add items to Offcanvas
        $(document).on('click', '.offcanvas_toggle', function() {

            $('#offcanvas-btn').click();
            $('#offcanvas-form-submit').text('Add To Cart');
            $('.laod-item-offcanvas').html('');
            $('#offcanvas-loader').css('display', 'block');

            var item_id = $(this).data('item-id');

            getItemDetails(item_id);
        })

        var cart = Array();

        var calculate = function() {
            var quantity = $('#quantity').val();
            var rate = $('#rate').val();
            var discount_type = $('.discount-type.active').find('input').val();
            var discount = $('#discount').val();

            var total = Number(quantity) * Number(rate);

            if (discount_type == 'money') {
                total = total - discount;
            } else {
                total = total * ((100 - discount) / 100);
            }

            $('#totalshow').val(total.toFixed(2));
            $('#total').val(total.toFixed(2));
        }

        //Offcanvas Calculation
        $(document).on('change click paste input', '.offcanvas-inputs', calculate);

        $(document).on('click', '.discount-type', function() {
            $('.discount-type.active').removeClass('active');
            $(this).addClass('active');
            calculate();
        });

        $(document).on('click', '#offcanvas-form-submit', function(e) {
            e.preventDefault();
            var quantity = $('#quantity').val();
            var rate = $('#rate').val();
            var discount_type = $('.discount-type.active').find('input').val();
            var discount = $('#discount').val();
            var item_image = $('#item_image').val();
            var item_name = $('#item_name').val();
            var item_id = $('#item_id').val();
            var total = $('#total').val();
            var item_sales_rate = $('#item_sales_rate').val();

            var product = {
                'item_id': item_id,
                'rate': rate,
                'discount_type': discount_type,
                'discount': discount,
                'item_image': item_image,
                'item_name': item_name,
                'item_id': item_id,
                'total': total,
                'quantity': quantity,
                'item_sales_rate': item_sales_rate,
                'cart_entry_id': null
            };

            offcanvasFormSubmit(product, false);

            $('#offcanvas-btn').click();
        });

        function offcanvasFormSubmit(product, from_barcode) {
            var found = false;

            if (from_barcode) {
                $.each(cart, function(index, value) {
                    if (value.item_id == product.item_id) {
                        value.quantity = Number(value.quantity) + 1;
                        value.total = (Number(value.rate) * Number(value.quantity)).toFixed(2);
                        product.cart_entry_id = value.cart_entry_id;
                        found = true;
                    }
                });

                if (!found) {
                    cart.push(product);
                }

                $('.search_input').val('');
                $('.search_input').focus();
            } else {
                $.each(cart, function(index, value) {
                    if (value.item_id == product.item_id) {
                        product.cart_entry_id = cart[index].cart_entry_id;
                        cart[index] = product;
                        found = true;
                    }
                });

                if (!found) {
                    cart.push(product);
                }
            }

            populateCartList(cart);
        }

        function populateCartList(cart) {
            var html = '';

            if (!cart === undefined || !cart.length == 0) {
                $.each(cart, function(index, value) {
                    var discount_checker = '';

                    if (value.discount_type == 'money') {
                        discount_checker = ' (- ৳' + value.discount + ')';
                    } else {
                        discount_checker = ' (- %' + value.discount + ')';
                    }

                    html += '<li class="border rounded p-2 single-list" id="' + value.item_id +
                        '" style="z-index: 3;">' +
                        '<div class="d-flex justify-content-between align-items-center">' +
                        '<div class="d-flex justify-content-between align-items-center">' +
                        '<div class="d-flex flex-row mt-2">' +
                        '<h5 class="text-secondary" style="padding-right: 5px;">' + value.item_name + '</h5>';
                    if (Number(value.discount) == 0) {
                        html += ' <p>(' + value.quantity + ' X ' + Number(value.rate).toFixed(2) + ')</p>';
                    } else {
                        html += ' <p>(' + value.quantity + ' X ' + Number(value.rate).toFixed(2) +
                            discount_checker + ')</p>';
                    }

                    html += '</div>' +
                        '</div>' +
                        '<div class="d-flex">' +
                        '<h5 class=""> ৳ ' + Number(value.total).toFixed(2) + '</h5>' +
                        '<div class="d-flex ms-3">' +
                        '<div class="me-2">' +
                        '<button data-item-id="' + value.item_id +
                        '" class="btn btn-outline-danger btn-sm remove-cart-item" style="z-index: 2;">' +
                        '<i class="fas fa-times fa-lg"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</li>';

                    calculateCart();
                });
            }

            $('#cart-list').html(html);
        }

        //Upadate rate
        $(document).on('input', '#totalshow', function() {
            var total = $(this).val();
            var quantity = $('#quantity').val();
            var rate = $('#rate').val();
            var discount_type = $('.discount-type.active').find('input').val();
            var discount = $('#discount').val();
            var new_rate;

            if (discount_type == 'money') {
                new_rate = (total - discount) / quantity;
            } else {
                new_rate = (total / (1 - (discount / 100))) / quantity;
            }

            $('#total').val(new_rate.toFixed(2));
            $('#rate').val(new_rate.toFixed(2));
        });

        //Update Offcanvas
        $(document).on('click', '.single-list', function() {

            var item_id = $(this).attr('id');

            $('#offcanvas-btn').click();
            $('.laod-item-offcanvas').html('');
            $('#offcanvas-loader').css('display', 'block');

            getItemDetails(item_id);
            calculateCart();
        });

        //Remove Cart Items
        $(document).on('click', '.remove-cart-item', function(e) {
            e.stopPropagation();

            var id = $(this).data('item-id');


            swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then(function() {
                    $.each(cart, function(index, value) {
                        if (value.item_id == id) {
                            var get_loaded_cart_id = $('#get_loaded_cart_id').val();

                            if (get_loaded_cart_id != '') {
                                $('.cart-holds').html('');
                                $.ajax({
                                    type: "GET",
                                    url: "{{ route('point_of_sales_ajax') }}",
                                    data: {
                                        item_id: id,
                                        cart_id: get_loaded_cart_id,
                                        button_id: 'removeCartItem'
                                    },
                                    success: function(res) {
                                        if (res.action == 'cart_removed') {
                                            $('.cart-holds').html(res.view);
                                            toastr.success(res.msg);
                                        } else if (res.action == 'something_went_wrong') {
                                            toastr.warning(res.msg);
                                        } else {
                                            $('.cart-holds').html(res.view);
                                            toastr.success(res.msg);
                                        }
                                    }
                                });
                            } else {
                                toastr.success('Success, Item removed successfully!');
                            }
                            cart.splice(index, 1);
                            populateCartList(cart);
                            calculateCart();
                        }
                    });
                })
        })

        //calculate Main cart
        $(document).on('change click paste input', '.cart-inputs', function() {
            calculateCart();
        });

        $(document).on('click', '.cart-discount-type', function() {
            $('.cart-discount-type.active').removeClass('active');
            $(this).addClass('active');
            calculateCart();
        });

        var calculateCart = function() {
            var sub_total = 0;
            var after_discount = 0;
            var after_tax = 0;

            $.each(cart, function(index, value) {
                sub_total += Number(value.total);
            });

            var cart_discount_type = $('.cart-discount-type.active').find('input').val();
            var cart_discount = $('#cart-discount').val();
            var cart_tax = $('#cart-tax').val();
            var cart_shipping = $('#cart-shipping').val();

            if (cart_discount_type == 'money') {
                after_discount = (Number(sub_total) - Number(cart_discount));
            } else {
                after_discount = Number(sub_total) * ((100 - Number(cart_discount)) / 100);
            }

            //tax calculate
            var tax_amount = after_discount * (Number(cart_tax) / 100);
            after_tax = after_discount + tax_amount;

            $('#cart-subtotal').text(Number(sub_total).toFixed(2));
            $('#cart-discount-append').text((Number(sub_total) - Number(after_discount)).toFixed(2));
            $('#cart-tax-append').text((Number(tax_amount).toFixed(2)));
            $('#cart-shipping-append').text(Number(cart_shipping).toFixed(2));
            $('#cart-total').text((Number(after_tax) + Number(cart_shipping)).toFixed(2));
        };

        //Submit cart using ajax
        $(document).on('click', '.submit-cart', function() {

            var customer_id = $('#check_if_customer').val();

            if (cart.length == 0) {
                toastr.warning('Warning, There is nothing in the cart!');
            } else if (customer_id == '') {
                toastr.warning('Warning, Select a customer to save this cart!');
            } else {
                var get_loaded_cart_id = $('#get_loaded_cart_id').val();

                $('.submit-cart').prop("disabled", true);

                if (get_loaded_cart_id == '') {
                    $('.submit-cart').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="padding-right: 3px;"></span> Saving...'
                    );
                } else {
                    $('.submit-cart').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="padding-right: 3px;"></span> Updating...'
                    );
                }

                var sub_total = $('#cart-subtotal').text();
                var discount_type = $('.cart-discount-type.active').find('input').val();
                var discount = $('#cart-discount').val();
                var tax = $('#cart-tax').val();
                var tax_amount = $('#cart-tax-append').text();
                var shipping = $('#cart-shipping').val();
                var total = $('#cart-total').text();
                var cart_id = $('#get_loaded_cart_id').val();

                var data = {
                    'cart': cart,
                    'sub_total': sub_total,
                    'discount_type': discount_type,
                    'discount': discount,
                    'tax': tax,
                    'tax_amount': tax_amount,
                    'shipping': shipping,
                    'total': total,
                    'customer_id': customer_id,
                    'cart_id': cart_id
                };

                $.ajax({
                    type: "GET",
                    url: "{{ route('point_of_sales_ajax') }}",
                    data: {
                        item_data: data,
                        button_id: 'storeCart'
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            toastr.success(res.msg);

                            var html =
                                '<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">' +
                                '<circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />' +
                                '<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />' +
                                '</svg>';

                            if (get_loaded_cart_id == '') {
                                $('.submit-cart').html(html + ' Cart Saved');
                            } else {
                                $('.submit-cart').html(html + ' Cart Updated');
                            }

                            setTimeout(location.reload.bind(location), 1500);
                        } else
                            toastr.warning(res.msg);
                    }
                });
            }
        });

        //Add new customer
        $(document).on('click', '.add-new-customer', function() {
            $('.add-new-user-container').css('display', 'block').show().animate({
                opacity: 1
            });
            $('.select-user-container').css('display', 'none');
        });

        //Select Customer
        $(document).on('click', '.select-customer', function() {
            $('.add-new-user-container').css('display', 'none');
            $('.select-user-container').css('display', 'block').show().animate({
                opacity: 1
            });
        });

        //Store new customer
        $(document).on('submit', '#addNewCustomerForm', function(e) {

            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ route('ajax_add_customer') }}",
                data: $('#addNewCustomerForm').serialize(),
                success: function(res) {
                    if (res.status == 'success') {
                        toastr.success('Success, New customer added successfully!');
                        $('.main-modal-body').html(res.view);
                        select2();
                    }
                }
            });
        });

        //Select the selected customer from the dropdown
        $(document).on('click', '.select-this-customers', function() {
            var customer_name = $('#customer').find(":selected").data('name');
            var customer_phone = $('#customer').find(":selected").data('phone');
            var customer_id = $('#customer').find(":selected").val();

            if (customer_id == '') {
                toastr.warning('Warning, Select a customer first!');
            } else {

                $('#check_if_customer').val(customer_id);

                $('#userModal').find('.close').click();
            }
        });

        //Load cart data from database
        $(document).on('click', '#loadCartData', function() {

            var cart_id = $(this).data('cart-id');

            loadDataToCart(cart_id);
        })

        //Delete Cart
        $(document).on('click', '#deleteCart', function() {
            var get_loaded_cart_id = $('#get_loaded_cart_id').val();


            swal({
                    title: 'Are you sure you want to delete this cart?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then(function() {
                    if (get_loaded_cart_id) {
                        $.ajax({
                            type: "get",
                            url: "{{ route('point_of_sales_ajax') }}",
                            data: {
                                cart_id: get_loaded_cart_id,
                                button_id: 'deleteCart'
                            },
                            success: function(res) {
                                if (res.status == 'success') {
                                    toastr.success(res.msg);
                                    location.reload();
                                }
                            }
                        });
                    } else {
                        if (cart.length == 0) {
                            toastr.warning('Warning, You have nothing in your cart to delete!')
                        } else
                            location.reload();
                    }
                })
        });

        //Submit cart using ajax
        $(document).on('click', '#confirm-cart', function() {

            var customer_id = $('#check_if_customer').val();

            if (cart.length == 0) {
                toastr.warning('Warning, There is nothing in the cart!');
            } else if (customer_id == '') {
                toastr.warning('Warning, Select a customer to save this cart!');
            } else {
                var get_loaded_cart_id = $('#get_loaded_cart_id').val();

                $('#confirm-cart').prop("disabled", true);

                $('#confirm-cart').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"' +
                    'style="padding-right: 3px;"></span> Saving cart...');

                var sub_total = $('#cart-subtotal').text();
                var discount_type = $('.cart-discount-type.active').find('input').val();
                var discount = $('#cart-discount').val();
                var tax = $('#cart-tax').val();
                var tax_amount = $('#cart-tax-append').text();
                var shipping = $('#cart-shipping').val();
                var total = $('#cart-total').text();
                var cart_id = $('#get_loaded_cart_id').val();

                var data = {
                    'cart': cart,
                    'sub_total': sub_total,
                    'discount_type': discount_type,
                    'discount': discount,
                    'tax': tax,
                    'tax_amount': tax_amount,
                    'shipping': shipping,
                    'total': total,
                    'customer_id': customer_id,
                    'cart_id': cart_id
                };

                $.ajax({
                    type: "GET",
                    url: "{{ route('point_of_sales_ajax') }}",
                    data: {
                        item_data: data,
                        button_id: 'cartCheckout'
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            toastr.success(res.msg);
                            $('#confirm-cart').html(res.msg);
                            setTimeout(window.location.href = "{{ route('checkout') }}", 1500);
                        } else
                            toastr.warning(res.msg);
                    }
                });
            }
        });

        //load cart data
        function loadDataToCart(cart_id) {
            swal({
                    title: 'Are you sure?',
                    text: "You want to load this cart data?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Of course!'
                })
                .then(function() {

                    $('#main-cart-loader').css('display', 'block');

                    $.ajax({
                        type: "GET",
                        url: "{{ route('point_of_sales_ajax') }}",
                        data: {
                            cart_id: cart_id,
                            button_id: 'loadCartData'
                        },
                        success: function(res) {
                            if (res.cart["discount_type"] == 1) {
                                $('.cart-discount-type.active').removeClass('active');
                                $('input[name="cart-option"][value="money"]').closest('.cart-discount-type')
                                    .addClass('active');
                                $('input[name="cart-option"][value="money"]').prop('checked', true);
                            } else {
                                $('.cart-discount-type.active').removeClass('active');
                                $('input[name="cart-option"][value="percent"]').closest(
                                    '.cart-discount-type').addClass('active');
                                $('input[name="cart-option"][value="percent"]').prop('checked', true);
                            }

                            var after_discount = 0;

                            $('#cart-discount').val(res.cart["discount"]);

                            if (res.cart["discount"] > 0) {
                                if (res.cart["discount_type"] == 1) {
                                    after_discount = res.cart["subtotal"] - res.cart["discount"];
                                    after_discount = res.cart["subtotal"] - after_discount;
                                } else {
                                    after_discount = res.cart["subtotal"] * ((100 - res.cart["discount"]) /
                                        100);
                                    after_discount = res.cart["subtotal"] - after_discount;
                                }
                            }

                            $('#cart-tax').val(res.cart["tax"]);
                            $('#cart-shipping').val(res.cart["shipping"]);

                            $('#check_if_customer').val(res.customer['id']);
                            $('#get_loaded_cart_id').val(res.cart['id']);
                            $('#customer').val(res.customer['id']).trigger('change');

                            $('#listModal').find('.close').click();

                            cart = Array();

                            $.each(res.cart_entries, function(index, value) {

                                var discount_type = '';
                                if (value.discount_type == 0) {
                                    var discount_type = 'percent';
                                } else {
                                    var discount_type = 'money';
                                }

                                var product = {
                                    'item_id': value['item_id'],
                                    'rate': value['rate'],
                                    'discount_type': discount_type,
                                    'discount': value['discount'],
                                    'item_image': value['item_image'],
                                    'item_name': value['item_name'],
                                    'total': value['total'],
                                    'quantity': value['quantity'],
                                    'item_sales_rate': value['item_sales_rate'],
                                    'cart_entry_id': value['id']
                                };

                                cart.push(product);
                            });

                            populateCartList(cart);

                            $('#cart-subtotal').text(res.cart['subtotal'].toFixed(2));
                            $('#cart-discount-append').text(after_discount.toFixed(2));
                            $('#cart-tax-append').text(res.cart['tax_amount'].toFixed(2));
                            $('#cart-shipping-append').text(res.cart['shipping'].toFixed(2));
                            $('#cart-total').text(res.cart['total'].toFixed(2));

                            $('#main-cart-loader').css('display', 'none');

                            var get_loaded_cart_id = $('#get_loaded_cart_id').val();

                            if (get_loaded_cart_id != '') {
                                $('.submit-cart-header').html('Update this cart?');
                                $('.submit-cart').html('Update this cart');
                            }
                        }
                    });
                })
        }

        //back to cart
        @php
        if (isset($_GET['back_to_cart'])) {
            echo 'loadDataToCart(' . $_GET['back_to_cart'] . ')';
        }
        @endphp
    </script>
@endsection
