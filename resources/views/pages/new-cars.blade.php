@extends('layout.master')

@section('content')

	<div class="copy-container new-cars">
		<div class="container">
			<h1 class="page-heading">New Cars</h1>
			<div class="row">				
				<div class="col-xs-12">	
					<div class="copy-accordion">

						<?php							

							foreach ($categories as $category):

								echo '<h4>' . $category->category . '</h4><div>';
								
								$i = 1;
								$num_cars = count($category->cars);

								foreach ($category->cars as $car):

									if($i == 1) echo '<div class="row">';

									echo '<div class="col-xs-6 col-md-3">												    
												<div class="car-menu-item">
													<h5>' . $car->title . '</h5>
													<p class="price">From: R' . $car->versions()->get()->min('price') . '</p>
													<img src="' . $car->image_path . '" alt="' . $car->title .'" class="img-responsive">
													<p>
														<a href="/new-car/' . $car->id .'" class="btn btn-grey btn-block" role="button">View</a>
														<a href="/test-drive/' . $car->id .'" class="btn btn-grey btn-block" role="button">Test Drive</a>
													</p>
												</div>
											</div>';

									if($i % 4 == 0) echo'</div><div class="row">';

									if($i == $num_cars) echo '</div>';

									$i++;
									
								endforeach;

								echo '</div>';

							endforeach;

							?>
					</div>						 											  					
				</div>																																			
			</div>
		</div>
	</div>

@stop
