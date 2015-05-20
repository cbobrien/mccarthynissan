@extends('admin/master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<p class="text-left">
			        {!! link_to_route('admin.categories.create', 'New Category', null, ['class' => 'btn btn-primary']) !!}
			    </p>
				@if (Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('message') }}
					</div>
				@endif
				<div class="panel panel-default">
					<div class="panel-heading">New Car Categories</div>
					<div class="panel-body">
						<table id="categories" class="table table-hover table-striped table-bordered">
						    <thead>
						        <tr>
						            <th class="col-md-10">Category Name</th>
						            <th class="col-md-1 text-center">Edit</th>
						            <th class="col-md-1 text-center">Delete</th>					         
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
		    oTable = $('#categories').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ajax": "{{ Config::get('app.url') }}/admin/categories/all",
		        "columns": [
		            {data: 'category', name: 'category'},
		            {data: 'edit', name: 'edit', orderable: false, class: 'text-center'},
		            {data: 'delete', name: 'delete', orderable: false, class: 'text-center'}       
		        ]
		    });
		});
	</script>

	@include('admin.partials.confirm') 
@stop



