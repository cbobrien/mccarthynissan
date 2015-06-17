<?php
	$path = str_replace('/admin/', '', $_SERVER['REQUEST_URI']);
	// dd($path);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{{ isset($title) ? ucwords(strtolower($title)) . ' | ' : '' }}}Admin | McCarthy Nissan</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>	
	<link href="/css/admin/bootstrap.min.css" rel="stylesheet">
	{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> --}}
	<link rel="stylesheet" href="/css/admin/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/jquery-ui.min.css">
	
<!-- 	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css"> -->
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="/css/admin/AdminLTE.min.css">
	<link rel="stylesheet" href="/css/admin/skin-red.css">
	<link rel="stylesheet" href="/css/admin/admin.css">
</head>
<body class="skin-red">

	<div class="wrapper">
		<header class="main-header">
			<a href="/admin" class="logo">Admin</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li>
							<a href="/">View Site</a>							
						</li>
						<li>
							<a href="/auth/logout">Log out</a>							
						</li>				
					</ul>
				</div>
			</nav>
		</header>

		<aside class="main-sidebar">
			<section class="sidebar">				
				<ul class="sidebar-menu">
					<li class="treeview">
						<a href="#">
							<i class="fa fa-dashboard"></i> <span>Promotions</span> <i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu" <?php if(stristr($path, 'promotions')) echo 'style="display:block;"'; ?>>							
		                	<li <?php if($path == 'promotions') echo 'class="active"'; ?>><a href="{{ URL::route('admin.promotions.index') }}"><i class="fa fa-circle-o"></i> List Promotions</a></li>
		                	<li <?php if($path == 'promotions/create') echo 'class="active"'; ?>><a href="{{ URL::route('admin.promotions.create') }}"><i class="fa fa-circle-o"></i> Add Promotion</a></li>		                	
		              	</ul>		              											
					</li>					
					<li class="treeview">
						<a href="#">
							<i class="fa fa-dashboard"></i> <span>New Cars</span> <i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="header">Categories</li>
		                	<li><a href="{{ URL::route('admin.categories.index') }}"><i class="fa fa-circle-o"></i> List Categories</a></li>
		                	<li><a href="{{ URL::route('admin.categories.create') }}"><i class="fa fa-circle-o"></i> Add Category</a></li>
		                	<li class="header">New Cars</li>
		                	<li class="<?php if (Request::is('admin/cars/*')) echo 'style="display:block;"';?>"><a href="{{ URL::route('admin.cars.index') }}"><i class="fa fa-circle-o"></i> List New Cars</a></li>
		                	<li><a href="{{ URL::route('admin.cars.create') }}"><i class="fa fa-circle-o"></i> Add New Car</a></li>		                	
		                	<li class="header">Versions</li>
		                	<li><a href="{{ URL::route('admin.versions.index') }}"><i class="fa fa-circle-o"></i> List Versions</a></li>
		                	<li><a href="{{ URL::route('admin.versions.create') }}"><i class="fa fa-circle-o"></i> Add Version</a></li>
		                	<li class="header">Colours</li>
		                	<li><a href="{{ URL::route('admin.colours.index') }}"><i class="fa fa-circle-o"></i> List Colours</a></li>
		                	<li><a href="{{ URL::route('admin.colours.create') }}"><i class="fa fa-circle-o"></i> Add Colour</a></li>
		                	<li class="header">Galleries</li>
		                	<li><a href="{{ URL::route('admin.galleries.index') }}"><i class="fa fa-circle-o"></i> List Galleries</a></li>
		                	<li><a href="{{ URL::route('admin.galleries.create') }}"><i class="fa fa-circle-o"></i> Add Gallery</a></li>
		                	<li class="header">Gallery Categories</li>
		                	<li><a href="{{ URL::route('admin.gallery-categories.index') }}"><i class="fa fa-circle-o"></i> List Gallery Categories</a></li>
		                	<li><a href="{{ URL::route('admin.gallery-categories.create') }}"><i class="fa fa-circle-o"></i> Add Gallery Category</a></li>
		                	<li class="header">Gallery Features</li>
		                	<li><a href="{{ URL::route('admin.gallery-features.index') }}"><i class="fa fa-circle-o"></i> List Gallery Features</a></li>
		                	<li><a href="{{ URL::route('admin.gallery-features.create') }}"><i class="fa fa-circle-o"></i> Add Gallery Feature</a></li>
		              	</ul>		              										
					</li>
					<li class="treeview">
						<a href="{{ URL::route('admin.special-enquiries.index') }}"><i class="fa fa-circle-o"></i>Special Enquiries</a>
					</li>										
					<li class="treeview">
						<a href="{{ URL::route('admin.enquiries.index') }}"><i class="fa fa-circle-o"></i>General Enquiries</a>
					</li>
					<li class="treeview">
						<a href="{{ URL::route('admin.parts.index') }}"><i class="fa fa-circle-o"></i>Parts Enquiries</a>
					</li>
					<li class="treeview">
						<a href="{{ URL::route('admin.services.index') }}"><i class="fa fa-circle-o"></i>Service Enquiries</a>
					</li>
					<li class="treeview">
						<a href="{{ URL::route('admin.test-drives.index') }}"><i class="fa fa-circle-o"></i>Test Drive Enquiries</a>
					</li>
					<li class="treeview">
						<a href="{{ URL::route('admin.car-enquiries.index') }}"><i class="fa fa-circle-o"></i>New Car Enquiries</a>
					</li>
					<li class="treeview">
						<a href="{{ URL::route('admin.used-enquiries.index') }}"><i class="fa fa-circle-o"></i>Used Car Enquiries</a>
					</li>					
					<li class="treeview">
						<a href="{{ URL::route('admin.promotion-enquiries.index') }}"><i class="fa fa-circle-o"></i>Promotion Enquiries</a>
					</li>
					<li><a href="{{ URL::route('admin.dealerships.index') }}"><i class="fa fa-circle-o"></i>Dealerships</a></li>		
																								
				</ul>
			</section>
		</aside>

		<div class="content-wrapper">
			@yield('content')
		</div>

	</div>

	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/js/jquery-ui.min.js"></script>
	<script src="/bower/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    {{-- <script src="/plugins/datatables/dataTables.bootstrap.js"></script> --}}
	<script src="/js/admin/slimScroll/jquery.slimScroll.min.js"></script>
	<script src="/js/admin/app.min.js"></script>
	<script src="/js/admin/admin.js"></script>

	


	@yield('scripts')

</body>
</html>