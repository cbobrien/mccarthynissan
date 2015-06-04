@extends('layout.master')

@section('content')

	<div class="copy-container">
		<div class="container used-page">
			<h1 class="page-heading">Demo Cars</h1>			
			<div class="row">
				<div class="col-xs-12 col-md-8">
	
					{!! html_entity_decode($cars->render()) !!}

					@foreach ($cars as $car)

						<div class="row">
							<div class="car-row">
								<div class="col-xs-12 col-sm-4 used-car-image-container">
									<a href="/view-car/demo/{{ $car->vid }}"><img src="{{ (trim($car->img1) != '') ? $car->img1 : '/images/unavailable.png' }}" class="img-responsive {{ (trim($car->img1) == '') ? 'hidden-xs' : '' }}" alt=""></a>
								</div>
								<div class="col-xs-12 col-sm-8">
									<div class="description">
										<h2>{{ $car->modeldesc }}</h2>								
										<p class="price">R{{ $car->princl }}</p>
										<div class="row"> 
											<div class="col-xs-12 col-sm-6">																																	
												<p class="kms">{{ $car->kms }} kms</p>
											</div>
											<div class="col-xs-12 col-sm-6">
												<p class="text-right used-buttons"> 										
													<a href="#" class="btn btn-red left-top-radius border-grey" 
															data-toggle="modal"														
															data-target="#modalEnquire" 													
															data-vid="{{ $car->vid }}"
															data-car-name="{{ $car->modeldesc }}"
															data-enquiry-type="demo">Enquire</a>

													<a href="/view-car/demo/{{ $car->vid }}" class="btn btn-grey right-bottom-radius view-hover border-grey">View</a>
												</p>
											</div>
										</div>																													
									</div>
								</div>
							</div>
						</div>

					@endforeach

					{!! html_entity_decode($cars->render()) !!}
					
				</div>
				<div class="col-xs-12 col-md-4 hidden-sm specials">

					@if (count($specials) > 0)

						{{-- {{ count($specials) }} --}}

						<?php
							$i = 1;
							$j = 1;
							$num_specials = count($specials);
						?>

						@foreach ($specials as $special)
						
							@if ($i == 1)
								<div class="specials-gallery-container">
									<div class="flexslider{{ $j }}">
										<ul class="slides">
							@endif
											<li>
												<a href="#" data-toggle="modal"
														data-target="#modalSpecial"									
														data-special-id="{{ $special->special_id }}"
														data-special-name="{{ $special->title }}">
													<img src="{{ $special->thumbnail }}" alt="{{ $special->title }}" class="img-responsive">
												</a>
											</li>

							@if (($i % 3 == 0) || ($i == $num_specials))
										</ul>
									</div>
								</div>

								@if ($i < $num_specials)
									<?php $j++ ?>
									<div class="specials-gallery-container">
										<div class="flexslider{{ $j }}">
											<ul class="slides">
								@endif

							@endif

							<?php $i++; ?>
						
							
						@endforeach
		
					@endif

				</div>
			</div>
		</div>
	</div>

@stop


@if (count($specials) > 0)

	@section('scripts')
		<script>
			$(window).load(function() {

				$('.flexslider1').flexslider({
					animation: 'slide',
					slideshowSpeed: 4000, 
					pauseOnHover: true,
					controlNav: false,
					directionNav: false				
				});

				$('.flexslider2').flexslider({
					animation: 'slide',
					slideshowSpeed: 4000,
					pauseOnHover: true,
					controlNav: false,
					directionNav: false,
					reverse: true,
					initDelay: 2000					
				});

				$('.flexslider3').flexslider({
					animation: 'slide',
					slideshowSpeed: 4000,
					pauseOnHover: true,
					controlNav: false,
					directionNav: false,
					initDelay: 1000				
				});
			});
		</script>
	@stop

@endif