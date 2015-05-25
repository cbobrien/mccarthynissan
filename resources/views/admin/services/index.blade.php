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
					<div class="panel-heading">Service Enquiries</div>
					<div class="panel-body">
						<table id="enquiries" class="table table-hover table-striped table-bordered">
						    <thead>
						        <tr>
						        	<th>Date</th>
						        	<th>Name</th>						      
						        	<th>Email</th>						            						          
						            <th>Dealership</th>							           						
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
		    oTable = $('#enquiries').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ajax": "/admin/services/all",
		        "columns": [
		        	{data: 'created_at', name: 'created_at', searchable: false},
		        	{data: 'name', name: 'name'},
		        	{data: 'email', name: 'email'},		        	      			        		            
		           	{data: 'dealership', name: 'dealership', searchable: false},		
		            {data: 'delete', name: 'delete', orderable: false, searchable: false, class: 'text-center'}       
		        ]
		    });
		});
	</script>
	@include('admin.partials.confirm') 
@stop



