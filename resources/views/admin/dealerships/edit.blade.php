@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.dealerships.index', 'List Dealerships', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Edit Version</div>
				<div class="panel-body">

					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible" role="alert">
	  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ Session::get('message') }}
						</div>
					@endif

					@include('errors.list')

					{!! Form::open(['method' => 'PATCH', 'route' => ['admin.dealerships.update', $dealership->id], 'class' => 'form-horizontal', 'files' => true]) !!}

						<div class="form-group">
							<label for="name" class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								{!! Form::text('name', $dealership->name, ['class' => 'form-control']) !!}
							</div>
						</div>

							<div class="form-group">
							<label for="coynumber" class="col-md-4 control-label">Coynumber</label>
							<div class="col-md-6">
								{!! Form::text('coynumber', $dealership->coynumber, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="tel" class="col-md-4 control-label">Telephone</label>
							<div class="col-md-6">
								{!! Form::text('tel', $dealership->tel, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="fax" class="col-md-4 control-label">Fax</label>
							<div class="col-md-6">
								{!! Form::text('fax', $dealership->fax, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="address" class="col-md-4 control-label">Address</label>
							<div class="col-md-6">
								{!! Form::textarea('address', $dealership->address, ['class' => 'form-control', 'id' => 'richtext']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="hours" class="col-md-4 control-label">Hours</label>
							<div class="col-md-6">
								{!! Form::textarea('hours', $dealership->hours, ['class' => 'form-control', 'id' => 'richtext2']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="latitude" class="col-md-4 control-label">Latitude</label>
							<div class="col-md-6">
								{!! Form::text('latitude', $dealership->latitude, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="longitude" class="col-md-4 control-label">Longitude</label>
							<div class="col-md-6">
								{!! Form::text('longitude', $dealership->longitude, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="blurb" class="col-md-4 control-label">Blurb</label>
							<div class="col-md-6">
								{!! Form::textarea('blurb', $dealership->blurb, ['class' => 'form-control', 'id' => 'richtext3']) !!}
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-xs-6 col-md-offset-4">
								<h4>Emails</h4>
								<hr>
							</div>
						</div>

						<div class="form-group">
													
							<label for="blurb" class="col-md-4 control-label">Dealer Principal</label>
							<div class="col-md-6">
								{!! Form::text('emails_dealer_principal', $dealership->emails_dealer_principal, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">New Car Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_new', $dealership->emails_new, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Demo Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_demo', $dealership->emails_demo, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Specials Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_preowned', $dealership->emails_preowned, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Pre-owned Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_specials', $dealership->emails_specials, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Service Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_service', $dealership->emails_service, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Parts Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_parts', $dealership->emails_parts, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Test Drive Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_test_drive', $dealership->emails_test_drive, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">General Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_general_enquiries', $dealership->emails_general_enquiries, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="image_path" class="col-md-4 control-label">Image</label>
							<div class="col-md-6">
								@if ($dealership->image_path != '')
									<img src="{{ $dealership->image_path }}" alt="{{ $dealership->name }}">
								@else
									No image.
								@endif 
								{!! Form::file('image_path') !!}								 
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	@include('admin.partials.script.rte')


@stop
