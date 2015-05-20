@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.services.index', 'List Service Enquiries', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Service Enquiry from {{ $enquiry->firstname }} {{ $enquiry->surname }}</div>
				<div class="panel-body">
					<table class="table table-striped">								
						<tr>
							<td><b>Dealership</b></td>
							<td>{{ $dealership }}</td>
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
							<td><b>Time</b></td>
							<td>{{ $enquiry->created_at }}</td>
						</tr>
						<tr>
							<td><b>Make</b></td>
							<td>{{ $enquiry->make }}</td>
						</tr>
						<tr>
							<td><b>Model</b></td>
							<td>{{ $enquiry->model }}</td>
						</tr>
						<tr>
							<td><b>Series</b></td>
							<td>{{ $enquiry->series }}</td>
						</tr>
						<tr>
							<td><b>Year</b></td>
							<td>{{ $enquiry->year }}</td>
						</tr>
						<tr>
							<td><b>Work required</b></td>
							<td>{{ $enquiry->work_required }}</td>
						</tr>
						<tr>
							<td><b>Registration number</b></td>
							<td>{{ $enquiry->registration}}</td>
						</tr>	
						<tr>
							<td><b>Odometer</b></td>
							<td>{{ $enquiry->odometer}}</td>
						</tr>
						<tr>
							<td><b>Service date</b></td>
							<td>{{ $enquiry->date }}</td>
						</tr>						
						<tr>
							<td><b>Contact Time</b></td>
							<td>{{ $enquiry->contact_time }}</td>
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
