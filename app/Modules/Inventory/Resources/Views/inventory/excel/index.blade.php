@extends('layouts.main')

@section('title', 'Import Inventory')

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
						<div class="user_heading_content"
							style="display: flex; justify-content: space-between; align-items: center;">
							<h2 class="heading_b"><span class="uk-text-truncate">Import Inventory</span>
							</h2>
							<a href="{{route('demo_excel', 'inventory-import-demo-excel-file.xlsx')}}"
								class="md-btn md-btn-success"><i class="material-icons">get_app</i> Downlaod Demo
								Excel</a>
						</div>
					</div>

					<div class="user_content">
						<div class="uk-overflow-container uk-margin-bottom">
							<form id="single-file-upload" method="post" action="{{route('upload_excel')}}"
								enctype="multipart/form-data">
								{{ csrf_field() }}
								<input name="upload_excel" class="form-control" type="file"
									accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
									required />
								<br>
								<button type="submit" class="btn btn-primary btn-block">Import Now</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection