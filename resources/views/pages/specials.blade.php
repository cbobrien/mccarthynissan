@extends('layout.master')

@section('content')

	<div class="copy-container specials-container">
		<div class="container">
			<h1 class="page-heading">Specials and Promotions</h1>
			<div role="tabpanel">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#specials-feed" aria-controls="passenger" role="tab" data-toggle="tab">Specials</a></li>
					<li role="presentation"><a href="#promotions" aria-controls="electric" role="tab" data-toggle="tab">Promotions</a></li>					
				</ul>
				<div class="tab-content specials">
					<div role="tabpanel" class="tab-pane active" id="specials-feed">											

						<?php

							$num_specials = count($specials);

							if ($num_specials > 0)
							{
	
								$i = 1;
									
								foreach ($specials as $special):

									if($i == 1) echo'<div class="row">';

									echo '<div class="col-xs-12 col-sm-4">
											<div class="special-container">
											  	<a href="#"	data-toggle="modal"
														data-target="#modalSpecial"									
														data-special-id="'. $special->special_id .'"
														data-special-name="'. $special->title .'">
													<img src="'. $special->thumbnail .'" alt="'. $special->title .'" class="img-responsive">
												</a>										
																			  		
										  	</div>
										  </div>';

									if($i % 3 == 0) echo '</div><div class="row">';
									if($i == $num_specials ) echo '</div>';
									$i++;

								endforeach;

							}
							else
							{
								echo '<div class="col-xs-12">
									  	 <p>No current specials</p>
									  </div>';
							}
						?>
					</div>
					<div role="tabpanel" class="tab-pane" id="promotions">
						<div class="row">						
							@if (count($promotions) > 0)
								@foreach ($promotions as $promotion)
									<div class="col-xs-12 col-md-6">
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
											  			<a href="/dealership/{{ $promotion->dealership_id }}" class="btn btn-grey right-bottom-radius">Visit Dealership</a>										  			
												{{-- <a href="/dealership/{{ $promotion->dealership_id }}">{{ $promotion->dealership_name }}</a> --}}
											
											</div>
										</div>
									</div>
								@endforeach
							@else
								<div class="col-xs-12">
									<p>No current promotions</p>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
