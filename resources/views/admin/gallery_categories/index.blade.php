@extends('admin/master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<p class="text-left">
			        {!! link_to_route('admin.gallery-categories.create', 'Add Gallery Category', null, ['class' => 'btn btn-primary']) !!}
			    </p>
				@if (Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('message') }}
					</div>
				@endif
				<div class="panel panel-default">
					<div class="panel-heading">Galleries</div>
					<div class="panel-body">
						<table id="galleryCategories" class="table table-hover table-striped table-bordered">
						    <thead>
						        <tr>
						        	<th>Title</th>			        	
						            <th>Car</th>
						            <th>Image</th>
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
		    oTable = $('#galleryCategories').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ajax": "{{ Config::get('app.url') }}/admin/gallery-categories/all",
		        "columns": [
		        	{data: 'title', name: 'nissan_gallery_categories.title'},		        			        
		            {data: 'car_title', name: 'nissan_new_cars.title'},		          
		           	{data: 'type', name: 'type'},
		            {data: 'delete', name: 'delete', orderable: false, searchable: false, class: 'text-center'}       
		        ]
		    });
		});
	</script>
	@include('admin.partials.confirm') 
@stop



