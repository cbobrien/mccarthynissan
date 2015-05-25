@extends('admin/master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<p class="text-left">
			        {!! link_to_route('admin.gallery-features.create', 'Add Gallery Feature', null, ['class' => 'btn btn-primary']) !!}
			    </p>
				@if (Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('message') }}
					</div>
				@endif
				<div class="panel panel-default">
					<div class="panel-heading">Gallery Features</div>
					<div class="panel-body">
						<table id="galleryFeatures" class="table table-hover table-striped table-bordered">
						    <thead>
						        <tr>
						        	<th>Car</th>
						        	<th>Category</th>
						        	<th>Title</th>						            						       					           
						            <th class="text-center">Delete</th>					         
						        </tr>
						    </thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script>
		$(function() {
		    oTable = $('#galleryFeatures').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ajax": "/admin/gallery-features/all",
		        "columns": [
		        	{data: 'car_title', name: 'nissan_new_cars.title'},
		        	{data: 'category_title', name: 'nissan_gallery_categories.title'}, 
		        	{data: 'title', name: 'nissan_gallery_features.title'},		        	      			        		            
		            {data: 'delete', name: 'delete', orderable: false, searchable: false, class: 'text-center'}       
		        ]
		    });
		});
	</script>
	@include('admin.partials.confirm') 
@stop



