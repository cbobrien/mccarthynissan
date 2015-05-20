@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.car-enquiries.index', 'List New Car Enquiries', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">New Car Enquiry from {{ $enquiry->firstname }} {{ $enquiry->surname }}</div>
				<div class="panel-body">
					<table class="table table-striped">
						<tr>
							<td><b>Dealership</b></td>
							<td>{{ $dealership }}</td>
						</tr>
						<tr>
							<td><b>Car</b></td>
							<td>{{ $car }}</td>
						</tr>
						<tr>
							<td><b>Version</b></td>
							<td>{{ $version }}</td>
						</tr>
						<tr>
							<td><b>Name</b></td>
							<td>{{ $enquiry->firstname }} {{ $enquiry->surname }}</td>
						</tr>
						<tr>
							<td><b>Email</b></td>
							<td><a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a></td>
						</tr>
						<tr>
							<td><b>Phone</b></td>
							<td>{{ $enquiry->tel }}</td>
						</tr>					
						<tr>
							<td><b>Time sent</b></td>
							<td>{{ $enquiry->created_at }}</td>
						</tr>
						<tr>
							<td><b>Message</b></td>
							<td>{{ $enquiry->message }}</td>
						</tr>	
																																	
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	@include('admin.partials.script.rte')
@stop
