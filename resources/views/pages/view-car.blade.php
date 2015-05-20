@extends('layout.master')

@section('content')

	<div class="car-detail-top">
		<div class="container">			
			<div class="row">				
					<div class="col-xs-12 col-sm-6">
						<div class="row">
							<div class="col-xs-12">							
								<h1 class="page-heading used-cars">{{ $car->yr }} {{ $car->modeldesc }}</h1>
								<p class="price">
									R{{ $car->princl }}
								</p>
								<table class="table table-striped">
									<tr>
										<td><b>Series</b></td>
										<td>{{ $car->mmseries }}</td>
									</tr>
									<tr>
										<td><b>Model</b></td>
										<td>{{ $car->mmmodel }}</td>
									</tr>
									<tr>
										<td><b>Kms</b></td>
										<td>{{ $car->kms }}</td>
									</tr>
									<tr>
										<td><b>Colour</b></td>
										<td>{{ $car->colr }}</td>
									</tr>
									@if (trim($car->fuel) != '')
										<tr>
											<td><b>Fuel</b></td>
											<td>{{ $car->fuel }}</td>
										</tr>
									@endif
									@if (trim($car->trans) != '')
										<tr>
											<td><b>Transmission</b></td>
											<td>{{ $car->trans }}</td>
										</tr>
									@endif
									<tr>
										<td><b>Registration Number</b></td>
										<td>{{ $car->regno }}</td>
									</tr>		
								</table>									
							</div>
						</div>		
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="row">
							<div class="col-xs-12">
								<div class="used-car-gallery">
									<div class="flexslider">
										<ul class="slides">

											<?php $gallery_count = 0; ?>

											@for($i = 1; $i <= 5; $i++)	

												@if (trim($car['img'.$i] !== ""))
													<li data-thumb="{{ $car['img'.$i] }}">
														<img src="{{ $car['img'.$i] }}">
													</li>
													<?php $gallery_count++; ?>									
												@endif
																		
											@endfor	

										</ul>

										@if ($gallery_count == 0)
											<img src="/images/unavailable3.png" class="img-responsive">
										@endif

									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">							
							<a href="#" class="btn btn-red btn-larger btn-block" 
										data-toggle="modal"
										data-target="#modalEnquire"									
										data-vid="{{ $car->vid }}"
										data-car-name="{{ $car->modeldesc }}"
										data-enquiry-type="{{ $type }}">Enquire</a>
							</div>
						</div>
					</div>				
				</div>																														
			</div>
		</div>
	</div>

@stop


@if ($gallery_count != 0)

	@section('scripts')
		<script>
			$(window).load(function() {

				$('.flexslider').flexslider({
					animation: 'slide',
					slideshowSpeed: 4000, 
					pauseOnHover: true,
					controlNav: 'thumbnails'			
				});

			});
		</script>
	@stop

@endif
