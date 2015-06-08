@extends('layout.master')

@section('content')

	<div class="car-detail-top">
		<div class="container">			
			<div class="row">				
					<div class="col-xs-12 col-sm-6">
						<div class="row">
							<div class="col-xs-12">
								<h1 class="page-heading">{{ $car->title }}</h1>
								<p><?php echo $car->description; ?></p>
								
									<?php 
										$picker_dots = "";
										$picker_pics = "";
										$i = 0;

										foreach ($car->colours as $colour):
											$class = $i == 0 ? 'active' : '';
											$picker_dots .= '<li><a href="#" class="' . $class . '" style="background:#' . $colour->colour_code . '" data-item="' . $i . '"></a></li>';
											$picker_pics .= '<div class="picker-pic-item ' .  $class . '" id="picker-item-' . $i . '">
																
																<div class="pic-item-container">
																	<img src="' . $colour->image_path . '" alt="' . $colour->colour . '" class="img-responsive">
																	<div class="picker-pic-caption">' . $colour->colour . '</div>
																</div>																
															</div>';
											$i++;
										endforeach
									?>
								<ul class="colour-picker">
									<?php echo $picker_dots; ?>
								</ul>
								<p><a href="/test-drive/{{ $car->id }}" class="btn btn-red btn-larger">Book a Test Drive</a></p>
							</div>
						</div>		
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="picker-pics">
							<?php echo $picker_pics; ?>
						</div>

						<div style="clear:both"></div>

					</div>				
				</div>																														
			</div>
		</div>
	</div>

	<div class="new-car-nav">
		<div class="container">
			<nav role="navigation" id="navbar-example">
				<ul class="nav car-details-menu">
					<li><div class="car-name">{{ $car->title }}</div></li>
					<li><a href="#versions">Versions</a></li>
					<li><a href="#exterior">Exterior</a></li>
					<li><a href="#interior">Interior</a></li>
					{{-- <li><a href="#video">Video</a></li>			 --}}
				</ul>
			</nav>
		</div>
	</div>

	<div>
		<div class="copy-container" id="versions">
			<div class="container new-car-container">
				<div class="row">
					<div class="car-section-heading">					
						<div class="col-xs-12 col-md-8 col-md-push-4">
							<ul class="car-links">
								<li><a href="/enquire/{{ $car->id }}" class="btn btn-outline">Enquire</a></li>
								<li><a href="/test-drive/{{ $car->id }}" class="btn btn-outline">Book a Test Drive</a></li>								
								@if (trim($car->brochure_link) != '')
									<li><a href="{{ $car->brochure_link }}" class="btn btn-outline hidden-xs" target="_blank">Brochure</a></li>
								@endif
								@if (trim($car->specifications_link) != '')
									<li><a href="{{ $car->specifications_link }}" class="btn btn-outline hidden-xs" target="_blank">Tech Specs</a></li>
								@endif
							</ul>					
						</div>
						<div class="col-xs-12 col-md-4 col-md-pull-8">				
							<h3>Versions</h3>
						</div>
					</div>
				</div>
			
					<?php 
						$col_size = count($car->versions) >= 3 ? 4 : 6;
						$i = 1;
						$num_versions = count($car->versions);
					?>	

					@foreach ($car->versions as $version)

						
						@if ($i == 1)
							<div class="row">
						@endif
						

							<div class="col-sm-4">
								<div class="version-container">
									<h4>{{ $version->title }}</h4>
									<p class="price">R{{ number_format($version->price) }}</p>
									<p class="description">								
										{!!html_entity_decode($version->features_1)!!}
									</p>
								</div>
							</div>

						@if ($i % 3 == 0)
							</div>

							@if ($i < $num_versions)
								<div class="row">
							@endif

						@else

							@if ($i == $num_versions)
								</div>
							@endif

						@endif

						<?php $i++; ?>

					@endforeach

			
				<div class="car-features-container" id="exterior">
					<div class="row">
						<div class="car-section-heading">						
							<div class="col-xs-12 col-sm-8 exterior-download-links col-sm-push-4">
								@if (trim($car->brochure_link) != '')								
									<a href="{{ $car->brochure_link }}" class="btn btn-red btn-min-2">Download the Brochure</a>
								@endif
								@if (trim($car->specifications_link) != '')								
									<a href="{{ $car->specifications_link }}" class="btn btn-red btn-min-2">Download the Tech Specs</a>
								@endif							
							</div>
							<div class="col-xs-12 col-sm-4 col-sm-pull-8">				
								<h3>Exterior</h3>
							</div>
						</div>
					</div>

					<div class="row hidden-xs">
						<div class="col-xs-12">
							<div class="car-gallery">
								@foreach ($car->galleries as $gallery)
									@if ($gallery->type == 'Exterior')
										<div><img src="{{ $gallery->image_path }}"></div>
									@endif
								@endforeach							
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="copy-accordion accordion-cars">
								@foreach ($car->galleryCategories as $galleryCategory)
									@if ($galleryCategory->type == 'Exterior')
										<h4>{{ $galleryCategory->title }}</h4>							
										<div>
											<div class="row">
												<div class="car-category-description">
													<div class="col-xs-6 hidden-sm hidden-md hidden-lg">
														<img src="{{ $galleryCategory->image_path }}" class="img-responsive">
													</div>
													<div class="col-xs-6 col-sm-12">														
														{!! html_entity_decode($galleryCategory->description) !!}														
													</div>
												</div>
											</div>
											<?php

												$i = 0;
												$tabs = '';
												$panels = '';
												$id = '';

												foreach ($galleryCategory->features as $feature):
													$class = $i == 0 ? 'active' : '';
													$id = str_slug($feature->title);

													// $id = Helpers::cleanInput($feature->title);
																						
													$tabs .= '<li role="presentation" class="' . $class . '">
																<a href="#' . $id . '" aria-controls="' . $id . '" role="tab" data-toggle="tab">' . $feature->title . '</a>
															</li>';

													$panels .= '<div role="tabpanel" class="tab-pane ' . $class . '" id="' . $id . '">											
																	<div class="row">
																		<div class="col-xs-6">
																			<img src="' . $feature->image_path . '" class="img-responsive">
																		</div>
																		<div class="col-xs-6">
																			' . $feature->description . '
																		</div>																						
																	</div>																													
																</div>';

													$i++;
												endforeach
											?>
											<ul class="nav nav-tabs hidden-xs" role="tablist">
												{!! html_entity_decode($tabs) !!}
											</ul>
											<div class="tab-content hidden-xs">
												{!! html_entity_decode($panels) !!}
											</div>
										</div>
									@endif
								@endforeach	
							</div>
						</div>
					</div>
				</div>

				<div class="car-features-container" id="interior">
					<div class="row">
						<div class="car-section-heading">						
							<div class="col-xs-12 col-sm-8 col-sm-push-4 interior-download-links">
								<a href="/test-drive/{{ $car->id }}" class="btn btn-red">Book a Test Drive</a>
							</div>
							<div class="col-xs-12 col-sm-4 col-sm-pull-8">				
								<h3>Interior</h3>
							</div>
						</div>
					</div>

					<div class="row hidden-xs">
						<div class="col-xs-12">
							<div class="car-gallery">
								@foreach ($car->galleries as $gallery)
									@if ($gallery->type == 'Interior')
										<div><img src="{{ $gallery->image_path }}"></div>
									@endif
								@endforeach		
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="copy-accordion accordion-cars">
								@foreach ($car->galleryCategories as $galleryCategory)
									@if ($galleryCategory->type == 'Interior')
										<h4>{{ $galleryCategory->title }}</h4>							
										<div>
											<div class="row">
												<div class="col-xs-6 hidden-sm hidden-md hidden-lg">
													<img src="{{ $galleryCategory->image_path }}" class="img-responsive">
												</div>
												<div class="col-xs-6 col-sm-12">
													{!! html_entity_decode($galleryCategory->description) !!}
												</div>
											</div>
											<?php

												$i = 0;
												$tabs = '';
												$panels = '';
												$id = '';

												foreach ($galleryCategory->features as $feature):
													$class = $i == 0 ? 'active' : '';
													$id = str_slug($feature->title);
																						
													$tabs .= '<li role="presentation" class="' . $class . '">
																<a href="#' . $id . '" aria-controls="' . $id . '" role="tab" data-toggle="tab">' . $feature->title . '</a>
															</li>';

													$panels .= '<div role="tabpanel" class="tab-pane ' . $class . '" id="' . $id . '">											
																	<div class="row">
																		<div class="col-xs-6">
																			<img src="' . $feature->image_path . '" class="img-responsive">
																		</div>
																		<div class="col-xs-6">
																			' . $feature->description . '
																		</div>																						
																	</div>																													
																</div>';

													$i++;
												endforeach
											?>
											<ul class="nav nav-tabs hidden-xs" role="tablist">
												{!! html_entity_decode($tabs) !!}
											</ul>
											<div class="tab-content hidden-xs">
												{!! html_entity_decode($panels) !!}
											</div>
										</div>
									@endif
								@endforeach	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop


@section('scripts')
	<script src="/js/slick.min.js"></script>
	<script>
		$('.car-gallery').slick({
			dots: true,
			infinite: true,
			speed: 500,
			fade: true,
			cssEase: 'linear',
			autoplay: true
		});
	</script>
@stop