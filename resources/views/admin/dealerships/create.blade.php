@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.dealerships.index', 'List Dealerships', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Add Dealership</div>
				<div class="panel-body">									

					@include ('errors.list')

					{!! Form::open(['route' => 'admin.dealerships.store', 'class' => 'form-horizontal', 'files' => true]) !!}									

						<div class="form-group">
							<label for="name" class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								{!! Form::text('name', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="coynumber" class="col-md-4 control-label">Coynumber</label>
							<div class="col-md-6">
								{!! Form::text('coynumber', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="tel" class="col-md-4 control-label">Telephone</label>
							<div class="col-md-6">
								{!! Form::text('tel', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="fax" class="col-md-4 control-label">Fax</label>
							<div class="col-md-6">
								{!! Form::text('fax', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="address" class="col-md-4 control-label">Address</label>
							<div class="col-md-6">
								{!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'richtext1']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="hours" class="col-md-4 control-label">Hours</label>
							<div class="col-md-6">
								{!! Form::textarea('hours', null, ['class' => 'form-control', 'id' => 'richtext2']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="latitude" class="col-md-4 control-label">Latitude</label>
							<div class="col-md-6">
								{!! Form::text('latitude', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="longitude" class="col-md-4 control-label">Longitude</label>
							<div class="col-md-6">
								{!! Form::text('longitude', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="blurb" class="col-md-4 control-label">Blurb</label>
							<div class="col-md-6">
								{!! Form::textarea('blurb', null, ['class' => 'form-control', 'id' => 'richtext3']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="image_path" class="col-md-4 control-label">Image</label>
							<div class="col-md-6">
								{!! Form::file('image_path') !!}
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
								{!! Form::text('emails_dealer_principal', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">New Car Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_new', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Demo Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_demo', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Specials Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_specials', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Promotions Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_promotions', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Pre-owned Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_preowned', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Service Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_service', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Parts Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_parts', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">Test Drive Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_test_drive', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">											
							<label for="blurb" class="col-md-4 control-label">General Enquiries</label>
							<div class="col-md-6">
								{!! Form::textarea('emails_general_enquiries', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Add</button>
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
