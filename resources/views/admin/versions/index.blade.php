@extends('admin/master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<p class="text-left">
			        {!! link_to_route('admin.versions.create', 'Add Version', null, ['class' => 'btn btn-primary']) !!}
			    </p>
				@if (Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('message') }}
					</div>
				@endif
				<div class="panel panel-default">
					<div class="panel-heading">New Car Versions</div>
					<div class="panel-body">
						<table id="versions" class="table table-hover table-striped table-bordered">
						    <thead>
						        <tr>						        	
						            <th class="col-md-10">Title</th>
						            <th class="col-md-10">Car</th>
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
		    oTable = $('#versions').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ajax": "{{ Config::get('app.url') }}/admin/versions/all",
		        "columns": [			        	
		            {data: 'title', name: 'title'},
		           	{data: 'car', name: 'car'},
		            {data: 'edit', name: 'edit', orderable: false, searchable: false, class: 'text-center'},
		            {data: 'delete', name: 'delete', orderable: false, searchable: false, class: 'text-center'}       
		        ]
		    });
		});
	</script>
	@include('admin.partials.confirm') 
@stop


