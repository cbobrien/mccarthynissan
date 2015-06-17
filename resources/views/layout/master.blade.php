<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>{{ $title or '' }}</title>
	<meta name="description" content="{{ $description or '' }}">
	<meta name="keywords" content="{{ $keywords or '' }}">
	<link rel="stylesheet" href="/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="/css/everything.css">

</head>
<body>
	<div class="navmenu navmenu-default navmenu-fixed-right offcanvas">
		<ul>
			<li class="{{ ($path == '') ? 'active' : '' }}"><a href="/">Home</a></li>
			<li><a href="/new-cars">New Cars</a></li>
			<li class="{{ (strpos($path, 'demo') !== false) ? 'active' : '' }}"><a href="{{ URL::route('pages.demos') }}">Demo Cars</a></li>
			<li class="<?php if((strpos($path, 'pre-owned') !== false) || (strpos($path, 'preowned') !== false)) echo 'active'; ?>"><a href="{{ URL::route('pages.pre-owned-cars') }}">Pre-owned Cars</a></li>
			<li class="dropdown <?php if(stristr($path, 'dealership') !== false && stristr($path, 'test-drive') == false) echo 'active'; ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Our Dealerships <span class="caret"></span></a>
    			<ul class="dropdown-menu" role="menu">																									
    				{!!html_entity_decode($dealershipMenu['offcanvas'])!!}
    			</ul>
        	</li>
			<li class="{{ ($path == 'specials') ? 'active' : '' }}"><a href="{{ URL::route('pages.specials') }}">Specials</a></li>
			<li class="{{ ($path == 'service') ? 'active' : '' }}"><a href="{{ URL::route('pages.service') }}">Service</a></li>
			<li class="{{ ($path == 'parts') ? 'active' : '' }}"><a href="{{ URL::route('pages.parts') }}">Parts</a></li>
			<li class="{{ ($path == 'why-mccarthy') ? 'active' : '' }}"><a href="{{ URL::route('pages.why') }}">Why McCarthy</a></li>
			<li class="{{ ($path == 'contact') ? 'active' : '' }}"><a href="{{ URL::route('pages.contact') }}">Contact</a></li>			
		</ul>
    </div>
	<nav class="navbar yamm navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="page-title">{{ $title or '' }}</div>
				<a class="navbar-brand {{ ($path != '') ? 'active' : '' }}" href="/">McCarthy Nissan</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="{{ ($path == '') ? 'active' : '' }}"><a href="/">Home</a></li>					
					<li class="dropdown yamm-fw <?php if((stristr($path, 'new-cars') !== false) || (stristr($path, 'new-car'))) echo 'active'; ?>">
						<a href="#" class="dropdown-toggle new-car-link" data-toggle="dropdown" role="button" aria-expanded="false">New Cars</a>            			
            			<ul class="dropdown-menu mm-outer new-car-menu-container" role="menu">
            				<li>															
								{!!html_entity_decode($menu)!!}																
            				</li>																												
            			</ul>            			
                	</li>
					<li class="{{ (strpos($path, 'demo') !== false) ? 'active' : '' }}"><a href="{{ URL::route('pages.demos') }}">Demo Cars</a></li>
					<li class="<?php if((strpos($path, 'pre-owned') !== false) || (strpos($path, 'preowned') !== false)) echo 'active'; ?>"><a href="{{ URL::route('pages.pre-owned-cars') }}">Pre-owned Cars</a></li>
					<li class="dropdown <?php if(stristr($path, 'dealership') !== false && stristr($path, 'test-drive') == false) echo 'active'; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Our Dealerships <span class="caret"></span></a>            			
            			<ul class="dropdown-menu mm-outer dealerships" role="menu">
            				<li>
								<ul class="mm-inner-dealerships">								
									{!!html_entity_decode($dealershipMenu['main'])!!}
								</ul>
            				</li>																												
            			</ul>            			
                	</li>					
					<li class="{{ ($path == 'specials') ? 'active' : '' }}"><a href="{{ URL::route('pages.specials') }}">Specials</a></li>
					<li class="{{ ($path == 'service') ? 'active' : '' }}"><a href="{{ URL::route('pages.service') }}">Service</a></li>
					<li class="{{ ($path == 'parts') ? 'active' : '' }}"><a href="{{ URL::route('pages.parts') }}">Parts</a></li>
					<li class="{{ ($path == 'why-mccarthy') ? 'active' : '' }}"><a href="{{ URL::route('pages.why') }}">Why McCarthy</a></li>
					<li class="{{ ($path == 'contact') ? 'active' : '' }}"><a href="{{ URL::route('pages.contact') }}">Contact</a></li>
					<li class="dropdown more-links" id="more-links">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">More <span class="caret"></span></a>
						<ul class="dropdown-menu more-links-dropdown pull-left" role="menu">													
						</ul>
		            </li>
 				</ul>
			</div>
		</div>
	</nav>
	<button type="button" class="search-button" data-toggle="modal" data-target="#modalSearch"></button>

	@yield('content')

	<div class="bottom-menu">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-md-3">
					<h5>Cars</h5>
					<ul>
						<li><a href="/new-cars">New Cars</a></li>
						<li><a href="/demo-cars">Demo Cars</a></li>
						<li><a href="/pre-owned-cars">Pre-owned Cars</a></li>
						<li><a href="/specials">Specials</a></li>
					</ul>
				</div>
				<div class="col-xs-6 col-md-3">
					<h5>Dealerships</h5>
					<ul>
						<li><a href="/dealership/1">McCarthy Nissan Gateway</a></li>
						<li><a href="/dealership/2">McCarthy Nissan Germiston</a></li>
						<li><a href="/dealership/3">McCarthy Nissan Johannesburg</a></li>
						<li><a href="/dealership/4">McCarthy Nissan Randburg</a></li>
						<li><a href="/dealership/5">McCarthy Nissan Woodmead</a></li>
					</ul>
				</div>
				<div class="col-xs-6 col-md-3">
					<h5>Our Services</h5>
					<ul>
						<li><a href="/test-drive">Book a Test Drive</a></li>
						<li><a href="/service">Book a Service</a></li>
						<li><a href="/parts">Parts &amp; Accessories</a></li>
					</ul>
				</div>
				<div class="col-xs-6 col-md-3">
					<h5>More From McCarthy</h5>
					<ul>
						<li><a href="http://mccarthy-nissan.pnet.co.za" target="_blank">Careers</a></li>
						<li><a href="/blog" target="_blank">Blog</a></li>						
					</ul>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer">
		<ul class="social-icons">
			<li><a href="https://www.facebook.com/NissanMcCarthy" class="facebook" target="_blank">Facebook</a></li>
			<li><a href="https://twitter.com/NissanMcCarthy" class="twitter" target="_blank">Twitter</a></li>
		</ul>
		<img src="/images/McCarthyBidvest.png" width="100" height="58" alt="McCarthy Bidvest">
		<p>
			&copy; {{ date('Y') }} McCarthy Nissan<br>All Rights Reserved
		</p>
	</footer>

	@include('pages.modal-search')
	@include('pages.modal-enquire')
	@include('pages.modal-special')
	@include('pages.modal-promotion')
	@include('layout.script')

	@section('scripts')

	@stop

</body>
</html>
