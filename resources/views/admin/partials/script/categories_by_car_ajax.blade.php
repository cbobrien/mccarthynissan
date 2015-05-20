<script>
	$(function() {
	$('#car_id').change(function(e) {
		e.preventDefault();
		var token = $('#frm :input[name=_token]').val();
		var car_id = $('#car_id').val();
		if(car_id) {					
			var url =  '{{ Config::get('app.url') }}/admin/gallery-features/categories/' + car_id;
			$.ajax({
	            type: 'GET',           
	            dataType: 'json',
	            url: url,
	            data: {
	            	_token: token
	            },
	            error: function(jqXHR, exception){
	                console.log(exception);                
	            },
	            success: function(response) {
	               	var options = '';
	               	$.each(response, function(key, value) {
						options += '<option value="' + key + '">' + value + '</option>';
					});
					$('#category_id').html(options);
	            	$("#category_id").prop("disabled", false);           	
	            }
	        }); 
	     }       
	});
});
</script>