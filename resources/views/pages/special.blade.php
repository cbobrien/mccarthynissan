@extends('layout.master')

@section('content')

	<div class="copy-container specials-containerx">
		<div class="container">
			<h1 class="page-heading">Special No 4565</h1>
			<div class="row">
				<div class="special-details-container">
					<div class="col-xs-12 col-sm-6">
						<img src="/images/specials/detail/one.jpg" class="img-responsive">
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="specials-details">
							<h2>2013 Nissan Juke 1.6 Acenta</h2>
							<p>
								Only at Participating Dealership.
								<br><br><br><br><br>
								Ref: <strong>4565</strong>
							</p>
						</div>
						<div class="price-container">
							<div class="price">Only R175 995</div>
							<a href="#" class="btn btn-red btn-block btn-largest" 
										data-toggle="modal"
										data-target="#modalSpecial"									
										data-special-id="{{ $special->special_id }}"
										data-special-name="{{ $special->title }}">Enquire</a>							
						</div>								
					</div>
				</div>
			</div>			
		</div>
	</div>

@stop
