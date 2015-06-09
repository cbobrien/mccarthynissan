@extends('layout.master')

@section('content')

	<div class="copy-container specials-container">
		<div class="container">
			<h1 class="page-heading">Specials and Promotions</h1>
			<div role="tabpanel">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#specials-feed" aria-controls="passenger" role="tab" data-toggle="tab">Specials</a></li>
					<li role="presentation"><a href="#promotions" aria-controls="electric" role="tab" data-toggle="tab" id="promotionsTabButton">Promotions</a></li>					
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
									  	 <p> There are no current specials</p>
									  </div>';
							}
						?>
					</div>
					<div role="tabpanel" class="tab-pane promotions-panel" id="promotions">
						<div class="row">
											
								@if (count($promotions) > 0)

									<?php
										$items = '';
										$filter = '<a class="filter" data-filter="all">All</a>';

										$filter_array = [];

										foreach ($promotions as $promotion)
										{
											$dealer = str_replace('McCarthy Nissan ', '', $promotion->dealership_name);
											$dealerClass = str_replace(' ', '', $dealer);

											if (!in_array($dealer, $filter_array)) {
										       $filter_array[ $dealer] = $dealerClass;
										       $filter .= '<a class="filter" data-filter=".'. $dealerClass . '">'. $dealer .'</a>';
										    }

											$items .= '<a href="#" 
															data-toggle="modal"
															data-target="#modalPromotion"									
															data-promotion-id="'. $promotion->id .'"
															data-promotion-name="'. $promotion->name .'">
																<div class="mix '. $dealerClass  .'" data-myorder="'. $promotion->order .'">
																	<img src="'. $promotion->image_path . '" alt="'. $promotion->title .'" class="img-responsive">
																</div>
															</a>';
										}

										// dd($filter_array);
									?>						
													
									<div class="promo-links">
										<a class="filter" data-filter="all">All</a>
										<?php
											asort($filter_array);
											foreach ($filter_array as $key => $value)
											{
												echo '<a class="filter" data-filter=".'. $value . '">'. $key .'</a>';
											}
										?>
									</div>

									<div id="promoContainer" class="promo-container">
										<?php echo $items; ?>
									</div>
								@else								
									<p>There are no current promotions</p>								
								@endif
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop

@section('scripts')
	<script src="/js/jquery.mixitup.js"></script>
	<script>
		$(function() {
			$("#promotionsTabButton").click(function() {
				$('#promoContainer').mixItUp();
			});
			
		});
	</script>
@stop