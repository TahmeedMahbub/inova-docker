<form id="offcanvas-form" action="#" style="height: 85vh; overflow-y: scroll;">
	<div class="uk-grid-collapse uk-child-width-expands uk-text-center" uk-grid>
		<div>
			<div class="d-flex flex-column bd-highlight mb-3">
				<div class="p-2 bd-highlight text-start">
					<div class="">
						<h5><span id="canvas-name">{{ $data->item_name . ' ৳' . $data->item_sales_rate . ', ' . $data->barcode_no }}</span></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>

	<input type="hidden" name="image" id="item_image"
		value="{{ $data->item_image_url != null ? $data->item_image_url : asset('img/1.jpg') }}">
	<input type="hidden" name="item_name" id="item_name" value="{{ $data->item_name}}">
	<input type="hidden" name="item_id" id="item_id" value="{{ $data->id}}">
	<input type="hidden" name="total" id="total" value="{{ $data->item_sales_rate }}">
	<input type="hidden" name="item_sales_rate" id="item_sales_rate" value="{{ $data->item_sales_rate }}">

	<div class="d-flex flex-row justify-content-between bd-highlight mb-3">
		<div class="p-2 bd-highlight">
			<h4 class="p-1 text-start">Quantity :</h4>
		</div>
		<div class="p-2 bd-highlight" style="width: 20rem !important">
			<div class="input-group">
				<input type="number" class="form-control offcanvas-inputs" aria-label="Sizing example input"
					aria-describedby="inputGroup-sizing-default" value="1" id="quantity" name="quantity">
			</div>
		</div>
	</div>
	<hr>
	<div class="d-flex flex-row justify-content-between bd-highlight mb-3">
		<div class="p-2 bd-highlight">
			<h4 class="p-1 me-1">Rate : </h4>
		</div>
		<div class="p-2 bd-highlight" style="width: 20rem !important">
			<div class="input-group w-100">
				<input type="number" class="form-control offcanvas-inputs" aria-label="Sizing example input" id="rate"
					name="rate" aria-describedby="inputGroup-sizing-default" step=".01"
					value="{{ $data->item_sales_rate }}">
			</div>
		</div>
	</div>
	<hr>
	<div class="d-flex flex-row justify-content-between bd-highlight mb-3">
		<div class="p-2 bd-highlight">
			<h4 class="p-1 me-1">Discount : </h4>
		</div>
		<div class="bd-highlight">
			<div class="input-group mb-3 ms-3 me-3 pe-4 w-100" style="margin-top: 5px;">
				<div class="input-group-text" style="padding: 0 !important; border: 0 !important;">
					<div class="btn-group" id="options" data-toggle="buttons">
						<label class="btn btn-default discount-type">
							<input type="radio" name="option" id="option1" value="percent"><i
								class="fas fa-percentage"></i>
						</label>
						<label class="btn btn-default discount-type active">
							<input type="radio" name="option" id="option2" value="money"><i
								class="fas fa-dollar-sign"></i>
						</label>
					</div>
				</div>
				<input type="number" class="form-control offcanvas-inputs" id="discount" name="discount" value="0">
			</div>
		</div>
	</div>
	<hr>
	<div class="d-flex flex-row justify-content-between align-items-center bd-highlight mb-3">
		<div class="p-2 bd-highlight">
			<h2>Total :</h2>
		</div>
		<div class="p-2 bd-highlight d-flex flex-row justify-content-center align-items-center">
			<h4 class="pt-3" style="padding-right: 5px">৳ </h4>
			<input id="totalshow" type="number" class="form-control" value="{{ $data->item_sales_rate}}">
		</div>
	</div>


	<div class="">
		<button type="submit" id="offcanvas-form-submit" class="btn btn-primary btn-lg md-btn-block"
			style="margin-bottom: 10px !important ; padding: 10px !important; font-size:20px; font-style: bold;"> Add to
			Cart</button>
	</div>
</form>