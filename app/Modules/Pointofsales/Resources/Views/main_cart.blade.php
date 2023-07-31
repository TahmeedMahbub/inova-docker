@foreach ($data->cartItems() as $item)
<li class="border rounded p-2 single-list" id="{{ $item->id }}" style="z-index: 3;">
	<div class="d-flex justify-content-between align-items-center">
		<div class="d-flex justify-content-between align-items-center">
			<h6 class="rounded-circle m-1 me-3 p-2 fw-bold qtn-box"><img
					src="{{ $item->item_image_url != null ? $item->item_image_url : asset('img/1.jpg') }}"></h6>
			<div class="d-flex flex-column mt-2">
				<h5 class="text-secondary">{{ $item->item_name }}</h5>

				@php
					$discount_checker;
					if ($item->discount_type == 'money') {
						$discount_checker = ' (- ৳'. $item->discount .')';
					}
					else{
						$discount_checker = ' (- %'. $item->discount .')';
					}
				@endphp

				@if ($item->discount == 0)
					<p> {{ $item->quantity }} X  {{ $item->rate }} </p>
				@else
					<p> {{ $item->quantity }}  X  {{ $item->rate }} {{ $discount_checker }} </p>
				@endif
			</div>
		</div>
		<div class="d-flex mt-2">
			<h5 class=""> ৳  {{ $item->total }} </h5>
			<div class="d-flex ms-3">
				<div class="me-2">
					<button data-item-id="{{ $item->id }}" class="btn btn-outline-danger btn-sm remove-cart-item"
						style="z-index: 2;">
						<i class="fas fa-times fa-lg"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</li>
@endforeach