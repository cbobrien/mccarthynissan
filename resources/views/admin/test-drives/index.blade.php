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
					<div class="panel-heading">Test Drive Enquiries</div>
					<div class="panel-body">
						<table id="testdrives" class="table table-hover table-striped table-bordered">
						    <thead>
						        <tr>
						        	<th>Date Sent</th>
						        	<th>Name</th>						        
						            <th>Dealership</th>	
						           	<th>Test Drive Date</th>	 						           
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
		    oTable = $('#testdrives').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ajax": "{{ Config::get('app.url') }}/admin/test-drives/all",
		        "columns": [
		        	{data: 'created_at', name: 'created_at', searchable: false},		        	
		        	{data: 'name', name: 'name'},       	      			        		            
		           	{data: 'dealership', name: 'dealership'},
		           	{data: 'test_drive_date', name: 'test_drive_date'},
		            {data: 'delete', name: 'delete', orderable: false, searchable: false, class: 'text-center'}       
		        ]
		    });
		});
	</script>
	@include('admin.partials.confirm') 
@stop



