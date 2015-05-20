@extends('admin/master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">				
				@if (Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('message') }}
					</div>
				@endif
				<div class="panel panel-default">
					<div class="panel-heading">Used Car Enquiries</div>
					<div class="panel-body">
						<table id="enquiries" class="table table-hover table-striped table-bordered">
						    <thead>
						        <tr>
						        	<th>Date</th>
						        	<th>Name</th>		
						            <th>Dealership</th>
						            <th>Type</th>							            							         
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
		    oTable = $('#enquiries').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ajax": "{{ Config::get('app.url') }}/admin/used-enquiries/all",
		        "columns": [
		        	{data: 'created_at', name: 'created_at'},
		        	{data: 'name', name: 'name'},
		           	{data: 'dealership', name: 'dealership', searchable: false},
		           	{data: 'enquiry_type', name: 'enquiry_type'},
		            {data: 'delete', name: 'delete', orderable: false, searchable: false}       
		        ]
		    });
		});
	</script>
	@include('admin.partials.confirm') 
@stop



