@extends('layout.master')

@section('content')

	<div class="copy-container">
		<div class="container">
			<h2 class="page-heading">{{ $dealership->name }} Stock</h2>
			<div role="tabpanel" class="stock-tabs">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#specials-feed" aria-controls="passenger" role="tab" data-toggle="tab">Demos</a></li>
					<li role="presentation"><a href="#promotions" aria-controls="electric" role="tab" data-toggle="tab">Preowned</a></li>					
				</ul>
				<div class="tab-content specials">
					<div role="tabpanel" class="tab-pane active" id="specials-feed">											

						<?php

							$num_specials = count($demos);

							if ($num_specials > 0)
							{
								$i = 1;
									
								foreach ($demos as $demo):

									if($i == 1) echo'<div class="row">';

									$img = (trim($demo->img1) != '') ? trim($demo->img1) : '/images/unavailable2.png';
 
									echo '<div class="col-xs-12 col-lg-6">
											<div class="car-row stock">
												<div class="col-xs-12 col-sm-4">
													<img class="img-responsive" src="'. $img .'">
												</div>						
												<div class="col-xs-12 col-sm-8 description">													
													<h2>'. trim($demo->modeldesc) .'</h2>													
													<span class="price">R'. $demo->princl .'</span>
													&nbsp;
													<a href="#" class="btn btn-red left-top-radius border-grey" data-toggle="modal" data-target="#modalEnquire" data-vid="'. $demo->vid  .'" data-car-name="'. $demo->modeldesc  .'" data-enquiry-type="demo" data-dealer-id="'. $dealership->id .'">Enquire</a>													
													<a href="/view-car/demo/'. $demo->vid  .'" class="btn btn-grey right-bottom-radius view-hover border-grey">View</a>																											
												</div>
											</div>
										 </div>';

									if($i % 2 == 0) echo '</div><div class="row">';
									if($i == $num_specials ) echo '</div>';
									$i++;

								endforeach;
							}
							else
							{
								echo '<div class="col-xs-12">
									  	 <p>No current demos</p>
									  </div>';
							}
						?>
					</div>
					<div role="tabpanel" class="tab-pane" id="promotions">
						
						<?php

							$num_specials = count($preowneds);

							if ($num_specials > 0)
							{

								$i = 1;
									
								foreach ($preowneds as $preowned):

									if($i == 1) echo'<div class="row">';

									$img = (trim($preowned->img1) != '') ? trim($preowned->img1) : '/images/unavailable2.png';
 
									echo '<div class="col-xs-12 col-lg-6">
											<div class="car-row stock">
												<div class="col-xs-12 col-sm-4">
													<img class="img-responsive" src="'. $img .'">
												</div>						
												<div class="col-xs-12 col-sm-8 description">													
													<h2>'. trim($preowned->modeldesc) .'</h2>													
													<span class="price">R'. $preowned->princl .'</span>
													&nbsp;
													<a href="#" class="btn btn-red left-top-radius border-grey" data-toggle="modal" data-target="#modalEnquire" data-vid="'. $preowned->vid  .'" data-car-name="'. $preowned->modeldesc  .'" data-enquiry-type="preowned" data-dealer-id="'. $dealership->id .'">Enquire</a>													
													<a href="/view-car/demo/'. $preowned->vid  .'" class="btn btn-grey right-bottom-radius view-hover border-grey">View</a>																											
												</div>
											</div>
										 </div>';

									if($i % 2 == 0) echo '</div><div class="row">';
									if($i == $num_specials ) echo '</div>';
									$i++;

								endforeach;

							}
							else
							{
								echo '<div class="col-xs-12">
									  	 <p>No current demos</p>
									  </div>';
							}
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
@stop
