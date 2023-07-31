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
				<label for="customers" class="">Customers <span style="color: red;" class="asterisc">*</span></label>
				<div class="main">
					<select id="customer" name="customer" class="select2" required size="width: 100%;">
						@foreach($customers as $contact)
							<option value="{{ $contact->id }}" {{ $contact->id == $customer->id ? 'selected' : '' }}
								data-phone="{{ $contact->phone_number_1 }}" data-name="{{ $contact->display_name }}">
								{{ $contact->phone_number_1 }} - {{ $contact->display_name }}
							</option>
						@endforeach
					</select>
				</div>
				@if($errors->first('customer'))
				<div class="uk-text-danger uk-margin-top">{{ $errors->first('customer') }}
				</div>
				@endif
			</div>
		</div>
	</div>
	<div class="modal-footer" style="display: flex; align-items-center">
		<div style="float: left; position: absolute; left: 15px;">
			<button class="md-btn md-btn-success add-new-customer">Add New</button>
		</div>
		<button type="button" class="md-btn md-btn-secondary" data-dismiss="modal">Close</button>
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
					<label for="customer_name">Customer Name<span style="color: red;" class="asterisc">*</span></label>
					<input class="form-control" type="text" id="customer_name" name="customer_name"
						value="{{ old('customer_name') }}" required />
					@if($errors->has('customer_name'))
					<div class="uk-text-danger uk-margin-top">{{ $errors->first('customer_name')
						}}
					</div>
					@endif
				</div>
				<div class="uk-width-medium-1-1 pt-3">
					<label for="customer_phone">Customer Phone<span style="color: red;"
							class="asterisc">*</span></label>
					<input class="form-control" type="number" id="customer_phone" name="customer_phone"
						value="{{ old('customer_phone') }}" required />
					@if($errors->has('customer_phone'))
					<div class="uk-text-danger uk-margin-top">{{
						$errors->first('customer_phone') }}
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
		<button type="button" class="md-btn md-btn-secondary" data-dismiss="modal">Close</button>
		<button type="button" class="md-btn md-btn-primary select-customer"><i class="fas fa-arrow-left"></i> Select
			Customer</button>
	</div>
</div>