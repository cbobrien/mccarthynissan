@extends('layout.master')

@section('content')

<div class="copy-container">
		<div class="container search-page">
			<h1 class="page-heading">Search <span class="brand-colour">{{ $type }}</span> {{ $type == 'specials' ? '' : 'cars' }}</h1>			
			<div class="row">
				<div class="col-xs-12">
					<div class="search-meta">
						<p>
							@if ($type != 'specials')
								Minimum price: <span class="brand-colour">R{{ number_format($min) }}</span><br> 
								Maximum price: <span class="brand-colour">R{{ number_format($max) }}</span><br>
							@endif
							@if (isset($region) && $region != 'all')
								Region: <span class="brand-colour">{{ $region }}</span><br>
							@endif
							@if (isset($series))
								Series: <span class="brand-colour">{{ $series }}</span>
							@endif
						</p>
						@if (count($cars) > 0)
							<p>
								Total: 
								@if ($type == 'new')
									<b>{{ count($cars) }}</b>
								@else
									<b>{{ $cars->total() }}</b>
								@endif
							</p>
						@endif					
					</div>
										
				</div>
				<div class="col-xs-12">
					<?php

						$num_cars = count($cars);

						if ($num_cars > 0)
						{

							if ($type != 'new')	echo $cars->render();

							echo '<div class="search-results">';

							$i = 1;
								
							foreach ($cars as $car):

								if($i == 1) echo'<div class="row">';

								$img = (trim($car->image) != '') ? trim($car->image) : '/images/unavailable2.png';

								if($type != 'specials') {

									echo '<div class="col-xs-12 col-sm-6">
											<div class="car-row stock">
												<div class="col-xs-12 col-md-4">
													<img class="img-responsive" src="'. $img .'">
												</div>						
												<div class="col-xs-12 col-md-8">																							
													<h2>'. trim($car->title) .'</h2>																					
													<span class="price">From R'. $car->price .'</span>
													&nbsp;												
													<a href="/'. $view_path .'/'. $car->id  .'" class="btn btn-grey right-bottom-radius view-hover border-grey">View</a>																											
												</div>
											</div>
										 </div>';

										if($i % 2 == 0) echo '</div><div class="row">';
										
								}
								else {

									echo '<div class="col-xs-12 col-sm-6 col-md-4">
											<a href="#"	data-toggle="modal"
														data-target="#modalSpecial"									
														data-special-id="'. $car->id .'"
														data-special-name="'. strip_tags($car->title) .'">											
												<img class="img-responsive special-thumb" src="'. $img .'">
											</a>											
										 </div>';

										if($i % 3 == 0) echo '';

								}

								if($i == $num_cars ) echo '</div>';
								$i++;

							endforeach;

							echo '</div>';

							if ($type != 'new')	echo $cars->render();
						}
						else
						{
							echo '<div class="col-xs-12">
									<div class="search-results" style="margin-top:20px">
								  		<p>No results.</p>
								  	</div>
								  </div>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
@stop
