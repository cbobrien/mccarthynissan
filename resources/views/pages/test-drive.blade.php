@extends('layout.master')

@section('content')

	<div class="copy-container test-drive-container">
		<div class="container">
			<h1 class="page-heading">Book a Test Drive</h1>
			<div class="form-container">			
				<div class="row">

					<img src="/images/loader.gif" class="spinner">
					<div class="ajax-message"></div>

					{!! Form::open(['route' => 'test-drive.send', 'class' => '', 'id' => 'form']) !!}

						<div class="col-xs-12 col-md-4">
							<legend>Vehicle</legend>
							<fieldset>	
								@if (isset($car))

									<h2>{{ $car->title }}</h2>
									<img src="{{ $car->image_path }}" alt="{{ $car->title }}">

									@if (count($car->versions) > 0)
										<div class="form-group">
											<label for="version_id">Version</label>							
											<select name="version_id" id="version_id" class="form-control">
												<option value="">Please select a version</option>
												@foreach ($car->versions as $version)
													<option value="{{ $version->id }}">{{ $version->title }}</option>
												@endforeach
											</select>
										</div>
									@endif

								@else
															
									<div class="form-group">
										<label for="car_id" class="required-label">Car</label>
										{!! Form::select('car_id', [null => 'Please select a car'] + $cars, null, ['class' => 'form-control', 'id' => 'car_id', 'required']) !!}				
									</div>								
											
								@endif
							</fieldset>	

							<legend style="margin-top:20px">Dealership</legend>
							<div class="form-group">
								<label for="dealership_id" class="required-label">Dealership</label>
								{!! Form::select('dealership_id', [null => 'Please select a dealership'] + $dealerships, $dealership_id, ['class' => 'form-control', 'id' => 'dealership_id', 'required']) !!}
							</div>

						</div>			
						<div class="col-xs-12 col-md-8">																													
							<fieldset>
								<legend>Your Details</legend>
								<div class="form-group">
									<label for="firstname" class="required-label">First Name</label>
									{!! Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname', 'required']) !!}
								</div>
								<div class="form-group">
									<label for="surname" class="required-label">Surname</label>
									{!! Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'required']) !!}
								</div>
								<div class="form-group">
									<label for="email" class="required-label">Email</label>
									{!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'required']) !!}
								</div>
								<div class="form-group" class="-label">
									<label for="tel" class="required-label">Telephone</label>
									{!! Form::text('tel', null, ['class' => 'form-control', 'id' => 'tel', 'required']) !!}
								</div>	
								{{-- <div class="form-group">
									<label for="dealership_id" class="required-label">Dealership</label>
									{!! Form::select('dealership_id', [null => 'Please select a dealership'] + $dealerships, $dealership_id, ['class' => 'form-control', 'id' => 'dealership_id', 'required']) !!}
								</div> --}}
								<div class="form-group">
									<label for="test_drive_date">Preferred Test Drive Date</label>
									{!! Form::text('test_drive_date', null, ['class' => 'form-control', 'id' => 'date']) !!}
								</div>
								<div class="form-group">
									<label for="contact_time">Contact Time</label>
									<select class="form-control" name="contact_time" id="contact_time">
										<option value="">Please select</option>
										<option value="Any time">Any time</option>
										<option value="During the week">During the week</option>
										<option value="Morning">Morning</option>
										<option value="Afternoon">Afternoon</option>
										<option value="Only Saturday">Only Saturday</option>
									</select>
								</div>
								@if (isset($car))
									<input type="hidden" name="car_id" id="car_id" value="{{ $car->id }}">	
								@endif
								<button type="submit" class="btn btn-default btn-red btn-block btn-larger">Send</button>	
							</fieldset>
						</div>
					{!! Form::close() !!}	
				</div>							
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script>
		$('#form').submit(function(e) {			
			e.preventDefault();
			$('.ajax-message').html('').removeClass('alert alert-danger');
			// alert($('#form #date').val());
			var that = this;
			$('.spinner').show();
			$("#form :input").prop("disabled", true);
			$(this).css('opacity', 0);			
			$.ajax({
	            type: 'POST',           
	            dataType: 'json',
	            url: $('#form').attr('action'),
	            data: {
	            	_token: $('#form :input[name=_token]').val(),
	            	dealership_id: $('#form #dealership_id').val(),
	            	car_id: $('#form #car_id').val(),
	            	version_id: $('#form #version_id').val(),
	            	firstname: $('#form #firstname').val(),	    
	            	surname: $('#form #surname').val(),
	            	tel: $('#form #tel').val(),
	            	email: $('#form #email').val(),	            	
	            	test_drive_date: $('#form #date').val(),	            	
	            	contact_time: $('#form #contact_time').val()
	            },
	            error: function(data) {
	            	console.log(data);
	            	var message = (data.status === 422) ? 'Please complete all required fields' : data.responseText;
	            	responseActions('ajax-message', message, 'alert-danger', that, 'form', false, 1);        
	            },
	            success: function(data) {
	            	console.log(data);
	            	var message = 'Thank you for your enquiry. We will be in touch shortly.';
	            	responseActions('ajax-message', message, 'alert-success', that, 'form', true, 0);	
	            	ga('send', 'event', 'Submit Button Nissan Website', 'Submission Successful', 'Forms - Nissan');              	            
	            }
	        });        
		});

		function responseActions(messageClass, message, alert, that, formName, disabled, opacity) {
        	$('.' + messageClass).html(message).addClass('alert ' + alert);
        	$(that).css('opacity', opacity);
            $('.spinner').hide();
    		$('#' + formName + ' :input').prop('disabled', disabled);
    		$('html, body').animate({
			    scrollTop: $('.' + messageClass).offset().top - 110
			}, 200);
		}
	</script>
@stop