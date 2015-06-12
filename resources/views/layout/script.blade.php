<script src="/bower/jquery/dist/jquery.min.js"></script>
<script src="/bower/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
<script src="/js/offcanvas.js"></script>
<script src="/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript" src="/js/jquery.flexslider-min.js"></script>
<script src="/js/script.js"></script>

<script>

	$('#enquireSend').click(function(e) {
		e.preventDefault();
		$('#enquireForm .ajax-message').html('').removeClass('alert alert-danger');
		var that = this;
		$('#enquireForm .spinner').show();
		//$("#enquireForm :input[type=text]").prop("disabled", true);
		$('#enquireForm .form-group, #enquireSend').css('opacity', 0);
		var token = $('#enquireForm :input[name=_token]').val();
		$.ajax({
            type: 'POST',           
            dataType: 'json',
            url: $('#enquireForm').attr('action'),
            data: {
	            _token: $('#enquireForm :input[name=_token]').val(),
	            dealership_id: $('#enquireForm #dealership_id').val(),
	            firstname: $('#enquireForm #firstname').val(),	    
	            surname:  $('#enquireForm #surname').val(),
	            tel:  $('#enquireForm #tel').val(),
	            email:  $('#enquireForm #email').val(),
	            vid:  $('#enquireForm #vid').val(),
	            enquiry_type:  $('#enquireForm #enquiryType').val()	                
            },
            error: function(data) {
            	console.log(data.status);
            	var message = (data.status === 422) ? 'Please complete all required fields' : data.responseText;
            	enquireResponseActions('ajax-message', message, 'alert-danger', that, 'enquireForm', false, 1);
    
            },
            success: function(data) {
            	console.log(data);
            	var message = 'Thank you for your enquiry. We will be in touch shortly.';
            	enquireResponseActions('ajax-message', message, 'alert-success', that, 'enquireForm', true, 0);
            	ga('send', 'event', 'Submit Button Nissan Website', 'Submission Successful', 'Forms - Nissan');  
            }
        });        
	});

	function enquireResponseActions(messageClass, message, alert, that, formName, disabled, opacity) {
    	$('#enquireForm .' + messageClass).html(message).addClass('alert ' + alert);
    	$('#enquireForm .form-group, #enquireSend').css('opacity', opacity);
        $('#enquireForm .spinner').hide();
	}

	</script>	


<script>

	$('#specialSend').click(function(e) {
		e.preventDefault();
		$('#specialForm .ajax-message').html('').removeClass('alert alert-danger');
		var that = this;
		$('#specialForm .spinner').show();
		//$("#enquireForm :input[type=text]").prop("disabled", true);
		$('#specialForm .form-group, #specialSend').css('opacity', 0);
		//var token = $('##specialSend :input[name=_token]').val();
		$.ajax({
            type: 'POST',           
            dataType: 'json',
            url: $('#specialForm').attr('action'),
            data: {
	            _token: $('#specialForm :input[name=_token]').val(),
	            special_id: $('#specialForm #specialId').val(),
	            firstname: $('#specialForm #firstname').val(),	    
	            surname:  $('#specialForm #surname').val(),
	            tel:  $('#specialForm #tel').val(),
	            email:  $('#specialForm #email').val(),	                     
            },
            error: function(data) {
            	console.log(data);
            	var message = (data.status === 422) ? 'Please complete all required fields' : data.responseText;
            	specialResponseActions('ajax-message', message, 'alert-danger', that, 'enquireForm', false, 1);
    
            },
            success: function(data) {
            	console.log(data);
            	var message = 'Thank you for your enquiry. We will be in touch shortly.';
            	specialResponseActions('ajax-message', message, 'alert-success', that, 'enquireForm', true, 0);
            	ga('send', 'event', 'Submit Button Nissan Website', 'Submission Successful', 'Forms - Nissan');  
            }
        });        
	});

	function specialResponseActions(messageClass, message, alert, that, formName, disabled, opacity) {
    	$('#specialForm .' + messageClass).html(message).addClass('alert ' + alert);
    	$('#specialForm .form-group, #specialSend').css('opacity', opacity);
        $('#specialForm .spinner').hide();
	}

</script>

<script>

	$('#promotionSend').click(function(e) {
		e.preventDefault();
		$('#promotionForm .ajax-message').html('').removeClass('alert alert-danger');
		var that = this;
		$('#promotionForm .spinner').show();
		//$("#enquireForm :input[type=text]").prop("disabled", true);
		$('#promotionForm .form-group, #specialSend').css('opacity', 0);
		//var token = $('##specialSend :input[name=_token]').val();
		$.ajax({
            type: 'POST',           
            dataType: 'json',
            url: $('#promotionForm').attr('action'),
            data: {
	            _token: $('#promotionForm :input[name=_token]').val(),
	            promotion_id: $('#promotionForm #promotionId').val(),
	            dealership_id: $('#promotionForm #dealership_id').val(),
	            firstname: $('#promotionForm #firstname').val(),	    
	            surname:  $('#promotionForm #surname').val(),
	            tel:  $('#promotionForm #tel').val(),
	            email:  $('#promotionForm #email').val(),	                     
            },
            error: function(data) {
            	console.log(data);
            	var message = (data.status === 422) ? 'Please complete all required fields' : data.responseText;
            	promotionResponseActions('ajax-message', message, 'alert-danger', that, 'promotionForm', false, 1);
    
            },
            success: function(data) {
            	console.log(data);
            	var message = 'Thank you for your enquiry. We will be in touch shortly.';
            	promotionResponseActions('ajax-message', message, 'alert-success', that, 'promotionForm', true, 0);
            	ga('send', 'event', 'Submit Button Nissan Website', 'Submission Successful', 'Forms - Nissan');	  
            }
        });        
	});

	function promotionResponseActions(messageClass, message, alert, that, formName, disabled, opacity) {
    	$('#promotionForm .' + messageClass).html(message).addClass('alert ' + alert);
    	$('#promotionForm .form-group, #promotionSend').css('opacity', opacity);
        $('#promotionForm .spinner').hide();
	}

	//search form
	$('.search-button').on('click', function() {
		$(this).fadeOut('fast');
		$('.banner').revpause();    	
	});

	$('#modalSearch').on('hidden.bs.modal', function(e) {
		$('.search-button').fadeIn('fast');
    	$('.banner').revresume();
	});

	// $('#changeRange').click(function() {

	// 	if($('#priceLabel').text().indexOf('Vehicle') !== -1) {
	// 		var newPriceLabel = 'Monthly Price:';
	// 		var newButtonLabel = 'Use Vehicle Price Range';	
	// 	}
	// 	else {
	// 		var newPriceLabel = 'Vehicle Price:';
	// 		var newButtonLabel = 'Use Monthly Price Range';
	// 	}		
	// 	$('#priceLabel').text(newPriceLabel);
	// 	$('#changeRange').text(newButtonLabel);
	// });

	$('#sliderRange').slider({
		range: true,
		min: 50000,
		max: 2000000,
		values: [50000, 2000000],
		slide: function(event, ui) {
			$("#searchForm #priceRange").val("R" + numberWithCommas(ui.values[0]) + " - R" + numberWithCommas(ui.values[1]));
			$('#searchForm #min').val(ui.values[0]);
			$('#searchForm #max').val(ui.values[1]);
		}
	});

	$('#sliderRange').draggable();

	$("#priceRange").val("R" + numberWithCommas($("#sliderRange").slider("values", 0)) + " - R" + numberWithCommas($("#sliderRange").slider("values", 1)));


	$('#modalSearch .btn-type').on('click', function(e) {	

		if($(this).hasClass('selected'))
			return;

		var selected_type = $(this).attr('data-type');

		$('#searchPriceRow').show();
		$('#searchPriceSliderRow').show();

		$('.btn-type').removeClass('selected');
		$(this).addClass('selected');
		
		$('#modalSearch #type').val(selected_type);

		if(selected_type == 'demo' || selected_type == 'pre-owned') {

			$('#searchRegionRow').show();
			$('#searchSeriesRow').show();

			$('#region').attr('disabled', 'disabled');
			$('#series').attr('disabled', 'disabled');

			selected_type = (selected_type == 'pre-owned') ? 'preowned' : 'demo';

			$.ajax({
	            type: 'GET',           
	            dataType: 'json',
	            url: '/search/regions/' + selected_type,
	            error: function(jqXHR, exception){
	                console.log(exception);                
	            },
	            success: function(response) {
	               	var options = '<option value="">All Regions</option>';

	               	$.each(response, function(key, value) {
						options += '<option value="' + key + '">' + value + '</option>';
					});
					$('#region').html(options);
					$('#region').removeAttr('disabled');         	
	            }
	        }); 

			$.ajax({
	            type: 'GET',           
	            dataType: 'json',
	            url: '/search/series/' + selected_type,
	            error: function(jqXHR, exception){
	                console.log(exception);                
	            },
	            success: function(response) {
	               	var options = '<option value="">All Series</option>';
	               	$.each(response, function(key, value) {
						options += '<option value="' + key + '">' + value + '</option>';
					});
					$('#series').html(options);
					$('#series').removeAttr('disabled');      	
	            }
	        }); 
		}
		else if(selected_type == 'specials') {

			$('#series').html('');
			$('#searchRegionRow').show();
			$('#searchSeriesRow').hide();
			$('#searchPriceRow').hide();
			$('#searchPriceSliderRow').hide();

			$('#region').attr('disabled', 'disabled');

			$.ajax({
	            type: 'GET',           
	            dataType: 'json',
	            url: '/search/specials-regions',
	            error: function(jqXHR, exception){
	                console.log(exception);                
	            },
	            success: function(response) {
	               	var options = '<option value="">All Regions</option>';

	               	$.each(response, function(key, value) {
						options += '<option value="' + key + '">' + value + '</option>';
					});
					$('#region').html(options);
					$('#region').removeAttr('disabled');         	
	            }
	        }); 
		}
		else {
			$('#region').html('');
			$('#series').html('');
			$('#searchRegionRow').hide();
			$('#searchSeriesRow').hide();
		}

	});

	$('#searchButton').on('click', function() {
		var type = $('#modalSearch #type').val();
		var min = $('#modalSearch #min').val();
		var max = $('#modalSearch #max').val();
		var region = $('#modalSearch #region').val();
		var series = $('#modalSearch #series').val();

		min = (min != '') ? min : 50000;
		max = (max != '') ? max : 2000000;

		var url = '/search/' + type + '/' + min + '/' + max;

		if(region)
			var url = url + '/' + region;
		else
			var url = url + '/all';

		if(series)
			var url = url + '/' + series;

		window.location.href = url;
	});


</script>



@yield('scripts')

