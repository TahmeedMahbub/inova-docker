@extends('layouts.main')

@section('title', 'Edit Stock Transfer')

@section('header')
@include('inc.header')
@endsection

@section('sidebar')
@include('inc.sidebar')
@endsection
@section('styles')
<style media="screen">
	.input-cls {
		margin-top: 12px
	}
</style>
@endsection
@section('content')
<div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
	<div class="uk-width-large-10-10">
		{!! Form::open(['url' => route('stock_transfer_update', $data->id), 'method' => 'post', 'class' =>
		'uk-form-stacked', 'id'
		=>
		'user_edit_form']) !!}
		<div class="uk-grid" data-uk-grid-margin>
			<div class="uk-width-large-10-10">
				<div class="md-card">
					<div class="user_heading">
						<div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview fileinput-exists thumbnail"></div>
						</div>
						<div class="user_heading_content">
							<h2 class="heading_b"><span class="uk-text-truncate">Edit Stock Transfer </span></h2>
						</div>
					</div>
					<div class="user_content">
						<div class="uk-margin-top">
							<div class="uk-grid" data-uk-grid-margin>
								<div class="uk-width-medium-3-6">
									<label for="item_category_id" class="">Transfer From <span style="color: red;"
											class="asterisc">*</span></label>
									<select id="transfer_from" name="transfer_from"
										class="select2-single-search-dropdown" required>
										<option value="">Select Branch</option>
										@foreach($branches as $branch)
										<option value="{{ $branch->id }}" {{ $branch->id == $data->transfer_from ?
											'selected' : '' }}>
											{{ $branch->branch_name }}
										</option>
										@endforeach
									</select>
									@if($errors->first('transfer_from'))
									<div class="uk-text-danger uk-margin-top">{{ $errors->first('transfer_from') }}
									</div>
									@endif
								</div>
								<div class="uk-width-medium-3-6">
									<label for="transfer_to" class="">Transfer To <span style="color: red;"
											class="asterisc">*</span></label>
											<select id="transfer_to" name="transfer_to"
										class="select2-single-search-dropdown" required>
										<option value="">Select Branch</option>
										@foreach($branches as $branch)
										<option value="{{ $branch->id }}" {{ $branch->id == $data->transfer_to ?
											'selected' : '' }}>
											{{ $branch->branch_name }}
										</option>
										@endforeach
									</select>
									@if($errors->first('transfer_to'))
									<div class="uk-text-danger uk-margin-top">{{ $errors->first('transfer_to') }}
									</div>
									@endif
								</div>

								<div class="uk-width-medium-3-6">
									<label for="item_category_id" class="">Transfer Item <span style="color: red;"
											class="asterisc">*</span></label>
									<select id="transfer_item" name="transfer_item"
										class="select2-single-search-dropdown transfer_item" required>
										<option value="">Select Item</option>
										@foreach($items as $item)
										<option value="{{ $item->id }}" {{ $item->id == $data->item_id ?
											'selected' : '' }}>
											{{ str_pad($item->id, 6, '0', STR_PAD_LEFT) }}, {{ $item->item_name }}
										</option>
										@endforeach
									</select>
									@if($errors->first('transfer_item'))
									<div class="uk-text-danger uk-margin-top">{{ $errors->first('transfer_item') }}
									</div>
									@endif
								</div>

								<br>
								<div class="uk-width-medium-3-6" style="padding-top: 10px;">
									<label for="subject_name">Quantity<span style="color: red;"
											class="asterisc">*</span></label>
									<input class="md-input input-cls" type="number" id="quantity" name="quantity"
										value="{{$data->unit_id? $data->quantity/$data->basic_unit_conversion:$data->quantity}}" required />
									@if($errors->has('quantity'))
									<div class="uk-text-danger uk-margin-top">{{ $errors->first('quantity') }}</div>
									@endif
								</div>

							
								<div class="uk-width-medium-3-6" style="padding-top: 10px;">
									<label for="item_category_id" class="">Unit <span style="color: red;"
											class="asterisc">*</span></label>
									<select  name="unit_id" class="select2-single-search-dropdown"
										required  >
										<option value="">Select Unit</option>
										@foreach($units as $unit)
										<option value="{{ $unit->id }}" {{ $unit->id == $data->unit_id?'selected':''}}>
											{{ $unit->name }}
										</option>
										@endforeach
									</select>
									@if($errors->first('unit'))
									<div class="uk-text-danger uk-margin-top">{{ $errors->first('unit') }}
									</div>
									@endif
								</div>

								<div class="uk-width-medium-3-6" style="padding-top: 20px;">
									<label for="item_category_id" class="">Date <span style="color: red;"
											class="asterisc">*</span></label>
									<input class="md-input" type="text" id="date" name="date"
										value="{{ date('d-m-Y', strtotime($data->date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}"
										required=""><span class="md-input-bar "></span>
									@if($errors->first('date'))
									<div class="uk-text-danger uk-margin-top">{{ $errors->first('date') }}
									</div>
									@endif
								</div>

							</div>

							<br>
							<div class="uk-grid" data-uk-grid-margin>
								<div class="uk-width-1-1 uk-float-right">
									<button type="submit" class="md-btn md-btn-primary">@lang('trans.submit')</button>
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

<script type="text/javascript">
	$('#sidebar_main_account').addClass('current_section');
	$('#sidebar_inventory_product_transfer').addClass('act_item');
	$(window).load(function(){
		$("#tiktok_account").trigger('click');
	})

</script>

@endsection