@extends('layouts.main')

@section('title', 'Checkout')

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
@endsection

@section('content')
<div class="row mb-0 pb-0">
	<div class="col-4 pe-0 mb-0 pb-0" style="border-right: 2px solid rgb(184, 184, 184);">
		<div class="container-fluid ps-0 border-right" style="padding-right: 0px;">
			<div id=" cart-checkout" class="bg-white"
				style="max-width: 100%; right: 3px; padding-left: 0px; margin-left: 0px; ">
				<div class="md-card-toolbar uk-sticky" style="padding-left: 10px; padding-right: 10px">

					<a type="button" href="{{ route('point_of_sales', ['back_to_cart' => $cart->id]) }}"
						class="md-btn md-btn-block md-btn-primary p-2 m-1 mb-0 d-flex justify-content-start align-items-center"
						style="font-size: 15px">
						<i class="fas fa-caret-left" style="font-size: 25px; padding-right: 5px;"></i> Back To Cart
					</a>

					<div id="userbox" class="container-fluid bg-light rounded mt-3 p-3 d-block border">
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex p-2 rounded ms-3" style="color: #496796">
								<div class=""><i class="far fa-user fa-lg"></i></div>
								<h4 class="ms-3" style="color: #496796">{{ $cart->customer->phone_number_1 }} - {{
									$cart->customer->display_name }}</h4>
							</div>
						</div>
					</div>

					<!-- main -->
					<div class="uk-width-large-1-3 uk-width-medium-1-2"
						style="width:100%; margin-top: 10px; overflow-y: auto; ">
						<ul id="cart-list" class="md-list scroller uk-padding-small">
							<div id="cart1">
								@foreach ($cart->cartItems as $item)
								<li class="border rounded p-2" style="">
									<div class="d-flex justify-content-between align-items-center">
										<div class="d-flex justify-content-between align-items-center">
											<h4 class="rounded-circle m-1 me-3 p-2 fw-bold qtn-box">{{ $loop->iteration
												}}
											</h4>
											<div class="img-sizing">
												<img class="md-card-head-img img-fluid border"
													src="{{ $item->item->item_image_url != null ? $item->item->item_image_url : asset('img/1.jpg') }}"
													alt="{{ $item->item->item_name }}" style="width: 50px" />
											</div>
											<div class="d-flex flex-column mt-2">
												<h5 class="text-secondary" style="width: 15rem;">
													{{ $item->item->item_name }}
												</h5>
												@php
												$discount_checker;
												if ($item->discount_type == 1) {
												$discount_checker = ' (- ৳'. $item->discount .')';
												}
												else{
												$discount_checker = ' (- %'. $item->discount .')';
												}
												@endphp

												@if ($item->discount == 0)
												<p> {{ $item->quantity }} X {{ $item->rate }} </p>
												@else
												<p> {{ $item->quantity }} X {{ $item->rate }} {{ $discount_checker }}
												</p>
												@endif
											</div>
										</div>
										<div class="d-flex mt-2">
											<h5 class="">&#2547 {{ number_format($item->total, 2) }}</h5>
										</div>
									</div>
								</li>
								@endforeach
							</div>
						</ul>
					</div>
				</div>
				<!-- Calculation -->
				<div id="costlist" class="uk-width-large-1-3 uk-width-medium-1-2 mb-0 mt-3"
					style="width:100%; padding-left:10px; padding-right : 10px; margin-top:32px !important; border-top: 1px solid #ccc;">
					<ul class="md-list">
						<li class="">
							<div class="md-list-content d-flex justify-content-between align-items-center">
								<h5 class="m-2 text-secondary">Subtotal</h5>
								<h6 class="m-2 me-0 qtn-box text-end" id="subtotal" style="width: 50% !important">
									&#2547 {{
									number_format($cart->subtotal, 2) }}</h6>
							</div>
						</li>
						<li class="pb-1 ">
							<div class="md-list-content   d-flex justify-content-between align-items-center">
								<h5 class="m-2 text-secondary">
									Discount
									{{ $cart->discount > 0 ? ($cart->discount_type == 0 ? '(-'.$cart->discount.'%)' :
									'(-'.$cart->discount.'৳)') : '' }}
								</h5>

								@php
								$after_discount = 0;
								if ($cart->discount_type == 1) {
								$after_discount = $cart->subtotal - $cart->discount;
								} else {
								$after_discount = $cart->subtotal * ((100 - $cart->discount) / 100);
								}
								$after_discount = $cart->subtotal - $after_discount;
								@endphp

								<h6 id="discount" class="qtn-box text-end" style="width: 50% !important">&#2547 {{
									number_format($after_discount, 2) }} </h6>
							</div>
						</li>
						<li class="pb-0 mb-0">
							<div class="md-list-content  d-flex justify-content-between align-items-center">
								<h5 class="m-2 text-secondary">Tax ({{ $cart->tax }}%) </h5>

								<h6 id="tax" class="qtn-box text-end" style="width: 50% !important">&#2547 {{
									number_format($cart->tax_amount, 2) }}</h6>
							</div>
						</li>

						<li class="pb-0 mb-0">
							<div class="md-list-content  d-flex justify-content-between align-items-center">
								<h5 class="m-2 text-secondary">Shipping </h5>

								<h6 id="ship" class="qtn-box text-end" style="width: 50% !important">&#2547 {{
									number_format($cart->shipping, 2) }}</h6>
							</div>
						</li>

						<li class="pb-0 mb-0">
							<div class="md-list-content d-flex justify-content-between align-items-center">
								<h5 class="m-2 text-secondary fw-bold">Total</h5>
								<h5 id="total" class="mb-0 pb-0">&#2547 {{
									number_format($cart->total, 2) }}</h5>
							</div>
							<input type="hidden" id="target_amount" value="{{ $cart->total}}">
						</li>
					</ul>
				</div>
			</div>

		</div>
	</div>
	<div class="col-8 bg-light">
		<div class="container-fluid border-right bg-light" style="padding: 0 !important; margin: 0 !important;">
			<div class=" me-3" style="max-width: 100%;">
				<div class="md-card-toolbar uk-sticky mt-3">
					<div id="userbox"
						class="container-fluid bg-light rounded mb-3 d-block justify-content-center align-items-center bg-white"
						style="border: 1px solid rgb(212, 212, 212); border-radius: 5px !important;">

						<div class="m-3 mb-3">
							<div class="row">
								<div class="col-md-6 d-flex align-items-center">
									<h4>Amount Tendered</h4>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<input type="number" class="form-control float-end text-end tendered_amount"
											aria-label="Username" aria-describedby="basic-addon1"
											placeholder="Amount to pay" style="height: 45px;font-size: 30px;">
										<span class="input-group-text" id="basic-addon1"
											style="font-size: 20px; font-weight: 900;">&#2547</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row text-center mb-3 font-white payment_buttons_div">

						@foreach ($data['cash'] as $item)
						<div class="col-md-3 pb-3">
							<button type="button" class="btn btn-info w-100 p-4 fw-bold text-white payment-buttons {{ $item->account_name }}"
								style="font-size: 20px" data-button-type="cash"
								data-button-name="{{ $item->account_name }}" id="{{ $item->id }}">{{
								$item->account_name }}</button>
						</div>
						@endforeach

						@foreach ($data['banks'] as $item)
						<div class="col-md-3 pb-3">
							<button type="button" class="btn btn-info w-100 p-4 fw-bold text-white payment-buttons"
								style="font-size: 20px" data-button-type="bank" id="{{ $item->id }}"
								data-button-name="{{ $item->account_name }}">{{
								$item->account_name }}</button>
						</div>
						@endforeach

						<div class="col-md-3 pb-3">
							<button type="button" class="btn btn-info w-100 p-4 fw-bold text-white payment-buttons credit-btn"
								style="font-size: 20px" data-button-type="credit" id="credit" data-button-name="Credit"
								{{ $data['available_credit']==0 ? 'disabled' : '' }}>Credit</button>
							<b>Available: ৳{{ $data['available_credit'] }}</b>
							<input type="hidden" id="available_credit" value="{{ $data['available_credit'] }}">
						</div>

						{{-- <div class="col-md-3 pb-3">
							<button type="button" class="btn btn-info w-100 p-4 fw-bold text-white payment-buttons"
								style="font-size: 20px" data-button-type="excess_payment"
								data-button-name="Excess Payment" id="excess_payment" {{ $data['excess_payment']==0
								? 'disabled' : '' }}>Excess
								Payment</button>
							<b>Available: ৳{{ $data['excess_payment'] }}</b>
						</div> --}}

					</div>
					<ul id="cart-list" class="md-list scroller uk-padding-small">
						<div class="payment-list">

						</div>
					</ul>
				</div>
			</div>
			<!-- Calculation -->
			<div id="costlist" class="uk-width-large-1-3 uk-width-medium-1-2 rounded"
				style="width:100%;margin-top: 70px !important;">
				<div class="d-flex justify-content-between">
					<h5 class="m-2 text-secondary total-paid">Total Paid: ৳0</h5>
					<h5 class="m-2 text-secondary return">Return: ৳0</h5>
				</div>
					<button class="btn btn-primary text-center p-4 m-0 me checkout-button"
						style="font-size: 20px !important; border-radius: 5px !important; width: 100%;">
						Confirm
					</button>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="total_paid">
<input type="hidden" id="return_amount">

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

	var payments 	= Array();

	//handle enter keypress on tendered amount input field
	$(document).on('keypress', '.tendered_amount', function(e) {
		if(e.which == 13) 
		{
			var tendered_amount	= $(this).val();	
			var button_type 	= $('.payment_buttons_div').find('button.Cash').data('button-type');
			var button_name 	= $('.payment_buttons_div').find('button.Cash').data('button-name');
			var button_id 		= $('.payment_buttons_div').find('button.Cash').attr('id');

			if (tendered_amount == '') {
				toastr.warning('Error, you must provide an amount first!');
			}
			else if (tendered_amount == 0) {
				toastr.warning('Error, amount must be greater than zero!');
			}
			else {
				var payment = {
					'tendered_amount': Number(tendered_amount).toFixed(2),
					'button_type': button_type,
					'button_name': button_name,
					'id': button_id
				}; 

				payments.push(payment);
				populate();

				$('.payment_buttons_div').find('button.Cash').addClass('active');
			}
		}
	});

	$(document).on('click', '.payment-buttons', function(){
		var tendered_amount 	= $('.tendered_amount').val();
		var button_type 		= $(this).data('button-type');
		var button_name 		= $(this).data('button-name');
		var id 					= $(this).attr('id');
		var available_credit 	= $('#available_credit').val(); 

		if (Number(tendered_amount) > Number(available_credit) && button_type == 'credit') {
			toastr.warning('Error, you don\'t! have sufficient credits!');
			return;
		}
		else if (tendered_amount == '') {
			toastr.warning('Error, you must provide an amount first!');
		}
		else if (tendered_amount == 0) {
			toastr.warning('Error, amount must be greater than zero!');
		}
		else {
			var payment = {
				'tendered_amount': Number(tendered_amount).toFixed(2),
				'button_type': button_type,
				'button_name': button_name,
				'id': id
			}; 

			payments.push(payment);
			populate();
		}
	});

	function populate(){
		var html 			= '';
		var amount 			= 0;
		var target_amount 	= $('#target_amount').val();

		console.log(payments);

		if (payments.length == 0) 
			$('.credit-btn').prop('disabled', false);

		$.each(payments, function (index, value) {
			html += '<li class="border rounded p-2 bg-white">'+
						'<div class="d-flex justify-content-between align-items-center">'+
							'<div class="d-flex justify-content-between align-items-center">'+
								'<div class="d-flex justify-content-between align-items-center mt-2 ms-3" style="width: 15rem;">'+
									'<h5 class="fw-bold">'+
										'৳'+ value.tendered_amount +'</h5>'+
								'</div>'+
								'<h4 class="rounded-circle m-1 me-3 p-2 fw-bold  text-secondary">'+
									value.button_name +
								'</h4>'+
							'</div>'+
							'<div class="d-flex mt-2 ms-3 me-3">'+
								'<button id="' + index + '" class="md-btn md-btn-primary md-btn-mini remove-payment" type="button">'+
									'<i class="fas fa-minus-circle fa-lg text-danger"></i></button>'+
							'</div>'+
						'</div>'+
					'</li>';

			amount += Number(value.tendered_amount);
			
			if (value.button_type == 'credit') {
				$('.credit-btn').prop('disabled', true);
			}
		});

		$('.payment-list').html(html);

		$('.total-paid').html('Total Paid: ৳'+ amount.toFixed(2));

		$('#total_paid').val(amount.toFixed(2));

		$('.tendered_amount').val(0);

		if (amount > target_amount){
			$('.return').html('Return: ৳'+ (Number(amount) - Number(target_amount)).toFixed(2));
			$('#return_amount').val((Number(amount) - Number(target_amount)).toFixed(2));
		}else{
			$('.return').html('Return: ৳0');
			$('#return_amount').val(0);
		}

		if (amount < target_amount) {
			$('.checkout-button').prop("disabled", false);
		}
		else
			$('.checkout-button').prop("disabled", false);
	}

	//Remove Cart Items
	$(document).on('click', '.remove-payment', function () {

		var id = $(this).attr('id');

		$.each(payments, function (index, value) { 
			if (index == id) 
			{
				payments.splice(index, 1);
				toastr.success('Success, Payment has been removed!')
				populate();

				if (value.button_type == 'credit') {
					$('.credit-btn').prop('disabled', false);
				}
			}
		});
	})

	//Submit checkout
	$(document).on('click', '.checkout-button', function() {

		var total_paid 		= $('#total_paid').val();
		var return_amount 	= $('#return_amount').val();

		$('.checkout-button').prop('disabled', false);
		$('.checkout-button').html('Please wait while we process the data...');

		$.ajax({
			type: "GET",
			url: "{{ route('ajax_checkout') }}",
			data: {payments: payments,  total_paid: total_paid, return_amount: return_amount},
			success: function(res)
			{
				if (res.status == 'success') {
					$('.checkout-button').html(res.msg);
					setTimeout(window.location.href = res.route, 1500);
				}
				else{
					$('.checkout-button').html(res.msg);
					setTimeout(window.location.reload(), 1500);
				}
			}
		});
	});
</script>
@endsection