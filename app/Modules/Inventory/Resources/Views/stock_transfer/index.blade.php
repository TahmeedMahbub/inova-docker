@extends('layouts.main')

@section('title', 'Stock Transfer')

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
		<div class="uk-grid" data-uk-grid-margin>
			<div class="uk-width-large-10-10">
				<div class="md-card">
					<div class="user_heading">
						<div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview fileinput-exists thumbnail"></div>
						</div>
						<div class="user_heading_content">
							<h2 class="heading_b"><span class="uk-text-truncate">Invoice List</span>

							</h2>
						</div>
					</div>

					<div class="user_content">
						<div class="uk-overflow-container uk-margin-bottom">
							<div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
							<table class="uk-table" cellspacing="0" width="100%" id="data_table">
								<thead>
									<tr>
										<th width="7%">SL</th>
										<th>Transferred From</th>
										<th>Transferred To</th>
										<th>Item Category</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Date</th>
										<th>Created By</th>
										<th>Updated By</th>
										<th class="uk-text-center">Action</th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<th width="7%">SL</th>
										<th>Transferred From</th>
										<th>Transferred To</th>
										<th>Item Category</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Date</th>
										<th>Created By</th>
										<th>Updated By</th>
										<th class="uk-text-center">Action</th>
									</tr>
								</tfoot>

								<tbody>
									@php
									// dd($data);
									@endphp
									@foreach ($data as $value)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ isset($value->transferFrom) ? $value->transferFrom->branch_name : '' }}</td>
										<td>{{ isset($value->transferTo) ? $value->transferTo->branch_name : '' }}</td>
										<td>{{ $value->item->itemCategory->item_category_name }}</td>
										<td>{{ $value->item->item_name }}</td>
										<td>{{$value->unit_id ? $value->quantity/$value->basic_unit_conversion.''.$value->unit->name:$value->quantity}}</td>
										<td>{{ date('M d Y', strtotime($value->date)) }}</td>
										<td>{{ $value->createdBy->name}}</td>
										<td>{{ $value->updatedBy->name }}</td>
										<td class="uk-text-center" style="white-space:nowrap !important;">
											<a href="{{ route('stock_transfer_edit', $value->id) }}"><i
													data-uk-tooltip="{pos:'top'}" title="Edit"
													class="material-icons">&#xE254;</i></a>
											<a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete"
													class="material-icons">&#xE872;</i></a>
											<input type="hidden" class="delete_route"
												value="{{ route('stock_transfer_delete', $value->id) }}">
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- Add branch plus sign -->

						<div class="md-fab-wrapper branch-create">
							<a id="add_branch_button" href="{{ route('stock_transfer_create') }}"
								class="md-fab md-fab-accent branch-create">
								<i class="material-icons">&#xE145;</i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
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

	$('.delete_btn').click(function () {
		var route = $(this).next('.delete_route').val();
		swal({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
		})
		.then(function () {
			window.location.href = route;
		})
	})
</script>

@endsection