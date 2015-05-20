@extends('admin/master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<p class="text-left">
			        {!! link_to_route('admin.colours.create', 'Add Colour', null, ['class' => 'btn btn-primary']) !!}
			    </p>
				@if (Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('message') }}
					</div>
				@endif
				<div class="panel panel-default">
					<div class="panel-heading">Colours</div>
					<div class="panel-body">
						<table id="colours" class="table table-hover table-striped table-bordered">
						    <thead>
						        <tr>						        	
						            <th class="col-md-10">Colour</th>
						            <th class="col-md-10">Code</th>
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
		    oTable = $('#colours').DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ajax": "{{ Config::get('app.url') }}/admin/colours/all",
		        "columns": [			        	
		            {data: 'colour', name: 'colour'},
		           	{data: 'colour_code', name: 'colour_code'},
		           	{data: 'title', name: 'title'},
		            {data: 'edit', name: 'edit', orderable: false, searchable: false, class: 'text-center'},
		            {data: 'delete', name: 'delete', orderable: false, searchable: false, class: 'text-center'}       
		        ]
		    });
		});
	</script>
	@include('admin.partials.confirm') 
@stop



