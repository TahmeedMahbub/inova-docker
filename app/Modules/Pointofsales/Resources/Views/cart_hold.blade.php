@if (count($cart_holds) > 0)
<ul class="list-group cart-holds">
	@foreach ($cart_holds as $item)
	<li class="list-group-item" id="cart-{{ $item->id }}">
		<div class="d-flex justify-content-between">
			<div>
				<b>{{ $item->customer->display_name }} {{ $item->customer->phone_number_1 ?
					'('.$item->customer->phone_number_1.')' : ''
					}}</b> <br>
				<small class="text-muted">
					{{ date('d M Y', strtotime($item->created_at))}} at {{ date('h:i A',
					strtotime($item->created_at)) }}, {{ $item->countItems()
					}} items, <span style="font-size: 15px">৳</span>{{ $item->total }}
				</small>
			</div>
			<div style="color:#6b93d3; cursor:pointer;" id="loadCartData" data-cart-id="{{ $item->id }}" }
				title="Edit cart">
				<button class="md-btn md-btn-primary md-btn-mini"><i class="fas fa-edit"></i></button>
			</div>
		</div>
	</li>
	@endforeach
</ul>
@else
<div class="text-center">
	<p><h3>Cart Hold is Empty!</h3></p>
</div>
@endif