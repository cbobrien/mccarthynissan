@extends('layout.master')

@section('content')

	<div class="copy-container">
		<div class="container">
			<h1 class="page-heading">Contact</h1>
			<div class="form-container">			
				<div class="row">				
					<div class="col-xs-12 col-sm-6">

						@include ('errors.list')								

						<img src="/images/loader.gif" class="spinner">

						<div class="ajax-message"></div>

						{!! Form::open(['route' => 'contact.send', 'class' => 'form-horizontal', 'id' => 'form']) !!}

							<div class="form-group">
								<label for="dealership_id" class="required-label">Dealership</label>
								{!! Form::select('dealership_id', [null => 'Please select a dealership'] + $dealerships, null, ['class' => 'form-control', 'id' => 'dealership_id', 'required']) !!}
							</div>
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
							<div class="form-group">
								<label for="tel" class="required-label">Phone Number</label>							
								{!! Form::text('tel', null, ['class' => 'form-control', 'id' => 'tel', 'required']) !!}
							</div>
							<div class="form-group">
								<label for="message" class="required-label">Message</label>
								{!! Form::textarea('message', null, ['class' => 'form-control', 'id' => 'message', 'required']) !!}
							</div>
							<button type="submit" class="btn btn-default btn-red btn-block btn-larger">Send</button>

						{!! Form::close() !!}

					</div>
					<div class="col-xs-12 hidden-xs col-sm-offset-1 col-sm-5">										
						<img src="/images/cars/x-trail.jpg" style="margin-top:80px" class="img-responsive" alt="Contact">					
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
			var token = $('#form :input[name=_token]').val();
			$.ajax({
	            type: 'POST',           
	            dataType: 'json',
	            url: $('#form').attr('action'),
	            data: {
	            	_token: $('#form :input[name=_token]').val(),
	            	dealership_id: $('#form #dealership_id').val(),
	            	firstname: $('#form #firstname').val(),	    
	            	surname:  $('#form #surname').val(),
	            	tel:  $('#form #tel').val(),
	            	email:  $('#form #email').val(),
	            	message:  $('#form #message').val()	             
	            },
	            error: function(data) {
	            	var message = (data.status === 422) ? 'Please complete all required fields' : data.responseText;
	            	responseActions('ajax-message', message, 'alert-danger', that, 'form', false, 1);
        
	            },
	            success: function(data) {
	            	console.log(data);
	            	var message = 'Thank you for your enquiry. We will be in touch shortly.';
	            	responseActions('ajax-message', message, 'alert-success', that, 'form', true, 0);     

	        //         if(data.status === 'captcha_failure') {w
	        //             $('.captcha-error').html(data.message).addClass('alert-box warning');
	        //             reloadCaptcha();
	        //             $('#form-enquiry').css('opacity', 1);
	        //         }
	        //         else {     	         		
	        //     		$('.enquiry-message').html(data.message).addClass('alert-box');
	        //     		console.log(data.message);
	        //         	if(data.status === 'failure') {            		
	        //         		$('#form-enquiry').css('opacity', 1);
	        //         		$('.enquiry-message').html(data.message).addClass('warning');
	        //         	}
	        //         	else {
	        //         		$('#form-enquiry').css('opacity', 0);
	        //         	}
	        //         	$('html, body').animate({
	    				//     scrollTop: $('.enquiry-message').offset().top - 40
	    				// }, 200);
	        //         }

	        		// $(this).css('opacity', 1).bind(that);
	             	            	
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

