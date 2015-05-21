@extends('layout.master')

@section('content')

	<div class="copy-container">
		<div class="container">			
			<div class="row">
				<div class="col-xs-12 col-sm-6">						
					<div class="">
						<h1 class="page-heading">
							{{ ucwords(strtolower($dealership->name)) }}
						</h1>

						<div class="row row-button">
							<div class="col-xs-12 col-md-6 text-center">
								<a href="/test-drive/dealership/{{ $dealership->id }}" class="btn btn-lg btn-red btn-block">Book a Test Drive</a>					
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6 text-center">
								<a href="/service/{{ $dealership->id }}" class="btn btn-lg btn-red btn-block">Book a Service</a>	
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6 text-center">
								<a href="/stock/{{ $dealership->id }}" class="btn btn-lg btn-red btn-block">View our Stock</a>	
							</div>							
						</div>		
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="dealership-details">
						@if (trim($dealership->address) != '')
							<h6>Address</h6>
							{!! html_entity_decode($dealership->address) !!}
						@endif
						
						@if (trim($dealership->tel) != '')
							<h6>Telephone</h6>
							{{ $dealership->tel }}
						@endif

						@if (trim($dealership->fax) != '')
							<h6>Fax</h6>
							{{ $dealership->fax }}
						@endif

						@if (trim($dealership->longitude) != '' || trim($dealership->latitude) != '')
							<h6>GPS Co-ordinates</h6>
							  {{ $dealership->latitude }}, {{ $dealership->longitude }}
						@endif					
											
						@if (trim($dealership->hours) != '')
							<h6>Hours</h6>
							{!! html_entity_decode($dealership->hours) !!}
						@endif
					</div>
					<!-- <div class="dealership-image">						
						<img src="{{ $dealership->image_path }}" alt="{{ ucwords(strtolower($dealership->name)) }}" class="img-responsive hidden-xs">
						<div class="row row-button">
							<div class="col-xs-12 c text-center">
								<a href="/test-drive/dealership/{{ $dealership->id }}" class="btn btn-lg btn-red btn-block">Book a Test Drive</a>					
							</div>
							<div class="col-xs-12 text-center">
								<a href="/service/{{ $dealership->id }}" class="btn btn-lg btn-red btn-block">Book a Service</a>	
							</div>
							<div class="col-xs-12 col-4 text-center">
								<a href="/stock/{{ $dealership->id }}" class="btn btn-lg btn-red btn-block">View our Stock</a>	
							</div>
						</div>			
					</div>					 -->
				</div>																																
			</div>			
		</div>
	</div>

	<div class="copy-container white-bg">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div id="map-canvas"></div>
				</div>
			</div>	
		</div>
	</div>

	@if (count($dealership->promotions) > 0)

		<div class="copy-container white-bg">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 hidden-sm specials">
						{{-- <h2>Promotions</h2> --}}
					</div>
				</div>
				<div class="row">
					@foreach ($dealership->promotions as $promotion)
						<div class="col-xs-12 col-sm-4">
							<div class="promotion-container">
								<a href="#" data-toggle="modal"
											data-target="#modalPromotion"									
											data-promotion-id="{{ $promotion->id }}"
											data-promotion-name="{{ $promotion->name }}">									
									<img src="{{ $promotion->image_path }}" alt="{{ $promotion->name }}" class="img-responsive">
								</a>
								<div class="promotion-caption">
									<p>{{ html_entity_decode($promotion->name) }}</p>												
									<a href="#" class="btn btn-red left-top-radius" 
										data-toggle="modal"
										data-target="#modalPromotion"									
										data-promotion-id="{{ $promotion->id }}"
										data-promotion-name="{{ $promotion->name }}">Enquire</a>
								</div>								  			
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>

	@endif

	@if (count($specials) > 0)

		<div class="copy-container white-bg">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 hidden-sm specials">
						{{-- <h2>Specials</h2> --}}
					</div>
				</div>
				<div class="row">

					<?php $i = 1; ?>

					@foreach ($specials as $special)						

						<div class="col-xs-12 col-sm-4">
							<div class="special-container">
							  	<a href="#" data-toggle="modal"
											data-target="#modalSpecial"									
											data-special-id="{{ $special->special_id }}"
											data-special-name="{{ $special->title }}">
									<img src="{{ $special->thumbnail }}" alt="{{ $special->title }}" class="img-responsive">
								</a>										
																  		
						  	</div>
						  </div>

					@endforeach
				</div>
			</div>
		</div>

	@endif

@stop

@section('scripts')
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
	<script>

		function initialize() {

			var myLatlng = new google.maps.LatLng({{ trim($dealership->latitude) }},{{ trim($dealership->longitude) }});

			var mapOptions = {
				center: myLatlng,
			  	zoom: 15
			};

			var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

			var marker = new google.maps.Marker({
		    	position: myLatlng,
		      	map: map,
		      	title: '{{ trim($dealership->name) }}',
		      	icon: '{{ Config::get('app.url') }}/images/marker.png'
		  	});
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
@stop