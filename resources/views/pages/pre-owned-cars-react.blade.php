@extends('layout.master')

@section('content')

<div class="copy-container">
		<div class="container">
			<h1 class="page-heading">Pre-owned Cars</h1>			
			<div class="row">
				<div class="col-xs-12 col-md-8">
					<div id="preownedCars"></div>
				</div>
				<div class="col-xs-12 col-md-4 hidden-sm specials">
					<h2>Specials</h2>
					@if (count($specials) > 0)
						@foreach ($specials as $special)
							<div class="special-item">
								<a href="#">
									<img src="{{ $special->thumbnail }}" alt="{{ $special->title }}" class="img-responsive">
								</a>
								<div class="description">
									<p>{{ strip_tags(html_entity_decode($special->content)) }}</p>
									<a href="#" class="btn btn-red left-top-radius" 
										data-toggle="modal"
										data-target="#modalSpecial"									
										data-special-id="{{ $special->special_id }}"
										data-special-name="{{ $special->title }}">Enquire</a>
						  			<a href="/dealership/{{ $special->dealership_id }}" class="btn btn-grey right-bottom-radius">Visit Dealership</a>						  			
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script src="/js/bundle.js"></script>
@stop
