@extends('admin/master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<p class="text-left">
			        {!! link_to_route('admin.galleries.create', 'Add Gallery', null, ['class' => 'btn btn-primary']) !!}
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
						<table id="galleries" class="table table-hover table-striped table-bordered">
						    <thead>
						        <tr>				        	
						            <th>Car</th>
						            <th>Image</th>
						            <th>Type</th>							           
						            <th class="text-center">Edit</th>
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
		    oTable = $('#galleries').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ajax": "/admin/galleries/all",
		        "columns": [		        			        
		            {data: 'title', name: 'title'},
		           	{data: 'image_path', name: 'image_path', searchable: false},
		           	{data: 'type', name: 'type'},
		            {data: 'edit', name: 'edit', orderable: false, searchable: false, class: 'text-center'},
		            {data: 'delete', name: 'delete', orderable: false, searchable: false, class: 'text-center'}       
		        ]
		    });
		});
	</script>
	@include('admin.partials.confirm') 
@stop



