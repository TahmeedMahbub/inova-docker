@if (!is_null($data) && $data->count() > 0)
@foreach($data as $key => $value)
<div class="col mx-auto">
	<div data-product-name="{{ $value->item_name }}">
		<div id="add1" value="{{ $value->item_sales_rate }}" name="{{ $value->item_name }}"
			barcode="{{ $value->barcode_no }}" data-item-id="{{ $value->id }}"
			class="min-width mx-auto md-card md-card-hover-img offcanvas_toggle">
			<div class="md-card-head uk-text-center uk-position-relative">
				<div class="uk-badge uk-badge-danger uk-position-absolute uk-position-top-left uk-margin-left uk-margin-top"
					style="font-size:15px">
					<span style="font-size: 22px">৳</span> {{ $value->item_sales_rate }}
				</div>
				<img class="md-card-head-img"
					src="{{ $value->item_image_url != null ? $value->item_image_url : asset('img/1.jpg') }}"
					alt="{{ $value->item_name }}" style="width:100%" />
			</div>
			<div class="md-card-content" style="height: 80px;">
				<h4 class="heading_c uk-text-center">
					{{ $value->item_name }}
				</h4>
				<h6 class="uk-text-center"><b>{{ $value->barcode_no }}</b></h6>
			</div>
		</div>
	</div>
</div>
@endforeach
@else
<img src="{{ asset('img/404.png') }}" alt="404" style="width: 100%">
@endif