@extends('layout.master')

@section('content')

	<div class="copy-container">
		<div class="container">
			<h1 class="page-heading">Book a Service</h1>
			<div class="form-container">			
				<div class="row">

					<img src="/images/loader.gif" class="spinner">
					<div class="ajax-message"></div>

					{!! Form::open(['route' => 'service.send', 'class' => '', 'id' => 'form']) !!}				
						<div class="col-xs-12 col-md-4">																																				
							<fieldset>
								<legend>Your Details</legend>
								<div class="form-group">
									<label for="firstname" class="required-label">First Name</label>
									{!! Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname', 'required']) !!}
								</div>
								<div class="form-group" class="required-label">
									<label for="surname" class="required-label">Surname</label>
									{!! Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'required']) !!}
								</div>
								<div class="form-group">
									<label for="email" class="required-label">Email</label>
									{!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'required']) !!}
								</div>
								<div class="form-group" class="required-label">
									<label for="tel" class="required-label">Telephone</label>
									{!! Form::text('tel', null, ['class' => 'form-control', 'id' => 'tel', 'required']) !!}
								</div>				
							</fieldset>						 											  	
						</div>
						<div class="col-xs-12 col-md-4">																						
							<fieldset>
								<legend>Vehicle Details</legend>
								<div class="form-group">
									<label for="make" class="required-label">Make</label>
									{!! Form::text('make', null, ['class' => 'form-control', 'id' => 'make', 'required']) !!}
								</div>
								<div class="form-group">
									<label for="model">Model</label>
									{!! Form::text('model', null, ['class' => 'form-control', 'id' => 'model']) !!}
								</div>
								<div class="form-group">
									<label for="series">Series</label>
									{!! Form::text('series', null, ['class' => 'form-control', 'id' => 'series']) !!}
								</div>							
								<div class="form-group">
									<label for="year">Year</label>
									{!! Form::text('year', null, ['class' => 'form-control', 'id' => 'year']) !!}
								</div>
								<div class="form-group">
									<label for="year">Work Required</label>
									{!! Form::textarea('work_required', null, ['class' => 'form-control', 'id' => 'work_required']) !!}
								</div>
								<div class="form-group">
									<label for="registration">Registration Number</label>
									{!! Form::text('registration', null, ['class' => 'form-control', 'id' => 'registration']) !!}
								</div>
								<div class="form-group">
									<label for="odometer">Current Odometer Reading</label>
									{!! Form::text('odometer', null, ['class' => 'form-control', 'id' => 'odometer']) !!}
								</div>															
							</fieldset>						 											  
						</div>
						<div class="col-xs-12 col-md-4">
							<fieldset>
								<legend>Preferences</legend>																						
								<div class="form-group">
									<label for="dealership_id" class="required-label">Dealership</label>
									{!! Form::select('dealership_id', [null => 'Please select a dealership'] + $dealerships, $dealer_id, ['class' => 'form-control', 'id' => 'dealership_id', 'required']) !!}
								</div>	
								<div class="form-group">
									<label for="date" class="required-label">Date</label>
									{!! Form::text('date', null, ['class' => 'form-control', 'id' => 'date', 'required']) !!}
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
							</fieldset>	
							<button type="submit" class="btn btn-default btn-red btn-block btn-larger">Send</button>											 											  						
						</div>
					{!! Form::close() !!}																																				
					</div>
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
	            	firstname: $('#form #firstname').val(),	    
	            	surname: $('#form #surname').val(),
	            	tel: $('#form #tel').val(),
	            	email: $('#form #email').val(),
	            	make: $('#form #make').val(), 
	            	model: $('#form #model').val(),
	            	series: $('#form #series').val(),
	            	year: $('#form #year').val(),
	            	work_required: $('#form #work_required').val(),
	            	registration: $('#form #registration').val(),
	            	odometer: $('#form #odometer').val(),
	            	date: $('#form #date').val(),	            	
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