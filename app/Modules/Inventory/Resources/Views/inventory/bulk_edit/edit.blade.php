@extends('layouts.main')

@section('title', 'Inventory Bulk Edit')

@section('header')
@include('inc.header')
@endsection

@section('sidebar')
@include('inc.sidebar')
@endsection
@section('content')
<div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
	<div class="uk-width-large-10-10">
		<form action="" class="uk-form-stacked" id="user_edit_form">
			<div class="uk-grid" data-uk-grid-margin>
				<div class="uk-width-large-10-10">
					<div class="md-card">
						<div class="user_heading">
							<div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-preview fileinput-exists thumbnail"></div>
							</div>
							<div class="user_heading_content">
								<h2 class="heading_b"><span class="uk-text-truncate">Inventory Bulk Edit </span></h2>
							</div>
						</div>
						<form></form>
						<div class="user_content">
							{!! Form::open(['url' => route('bulk_edit_update'), 'method' => 'post', 'class' =>
							'uk-form-stacked']) !!}

							<div class="uk-overflow-container uk-margin-bottom">
								<div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
								<table class="uk-table" cellspacing="0" width="100%" id="data_table_1">
									<thead>
										<tr>
											<th width="5%">Serial</th>
											<th width="35%">@lang('trans.name')</th>
											<th width="10%">Sales Price</th>
											<th width="10%">Purchase Price</th>
											<th width="20%">Barcode</th>
											<th width="20%">Status</th>
										</tr>
									</thead>

									<tfoot>
										<tr>
											<th>Serial</th>
											<th>@lang('trans.name')</th>
											<th>Sales Price</th>
											<th>Purchase Price</th>
											<th>Barcode</th>
											<th>Status</th>
										</tr>
									</tfoot>

									<tbody>
										@foreach ($items as $key => $item)
										<tr class="row_{{ $item->id }}">
											<td>{{ $loop->iteration }}</td>
											<td>
												<input class="md-input input-cls" type="text" id="item_name_{{ $item->id}}"
													name="item_name[{{ $item->id }}]" onchange="inputchange({{ $item->id }})"
													value="{{ $item->item_name }}" />
											</td>
											<td>
												<input class="md-input input-cls" type="number" id="item_sales_rate_{{ $item->id}}"
													name="item_sales_rate[{{ $item->id }}]" onchange="inputchange({{ $item->id }})"
													value="{{ $item->item_sales_rate }}" step=".01" />
												<input type="hidden" name="item_id[]" value="{{ $item->id }}">
											</td>
											<td>
												<input class="md-input input-cls" type="number" id="item_purchase_rate_{{ $item->id}}"
													name="item_purchase_rate[{{ $item->id }}]" onchange="inputchange({{ $item->id }})"
													value="{{ $item->item_purchase_rate }}" step=".01" />
											</td>
											<td>
												<input class="md-input input-cls" type="text" id="barcode_no_{{ $item->id}}"
													name="barcode_no[{{ $item->id }}]" onchange="inputchange({{ $item->id }})"
													value="{{ $item->barcode_no }}" />
													
												@if (session()->has('duplicates') && isset(session()->get('duplicates')[$item->id]))
												<div class="uk-text-danger uk-margin-top">
													This Barcode has to be unique.
												</div>
												@endif
											</td>
											<td>
											    <p id="status_{{ $item->id }}"></p>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="uk-grid" data-uk-grid-margin>
								<div class="uk-width-1-1 uk-float-right">
									<!--<button type="submit" class="md-btn md-btn-primary submit-form-btn">@lang('trans.submit')</button>-->
								</div>
							</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>

		</form>
	</div>
</div>
@endsection


@section('scripts')


<script type="text/javascript">
	$('#sidebar_main_account').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');

        $(window).load(function(){
            $(".alldata").trigger('click');
        });
        $(window).load(function(){
          $("#tiktok_account").trigger('click');
        });
</script>

<script>
        $(document).ready(function() {
            $(window).keydown(function(e){
                if(e.keyCode == 13) {
                  e.preventDefault();
                  return false;
                }
            });
        });
        
        $(".submit-form-btn").click(function(e){
            $("#user_edit_form").submit();
        });
        
        function inputchange(id){
            
            $('#status_' + id).text('updating data');
            
            var item_id             = id;
            var item_name           = $('#item_name_' + id).val();
            var item_sales_rate     = $('#item_sales_rate_' + id).val();
            var item_purchase_rate  = $('#item_purchase_rate_' + id).val();
            var barcode_no          = $('#barcode_no_' + id).val();
            
            $.ajax({
    			type: "get",
    			url: "{{ route('bulk_edit_update_single') }}",
    			data: {
    			    item_id: item_id,
    			    item_name: item_name, 
    			    item_sales_rate: item_sales_rate,
    			    item_purchase_rate: item_purchase_rate,
    			    barcode_no: barcode_no,
    			},
    			success: function (res) {
    			    $('#status_' + id).text(res);
    			}
    		});
        }
    </script>
@endsection