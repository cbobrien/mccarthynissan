<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>McCarthy Nissan</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link href="/css/admin/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/css/admin/font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="/css/admin/AdminLTE.min.css">
	<link rel="stylesheet" href="/css/admin/skin-red.css">
	<link rel="stylesheet" href="/css/admin/admin.css">

	<link rel="stylesheet" href="/js/admin/timepicker/bootstrap-timepicker.css">
	<link rel="stylesheet" href="/js/admin/datepicker/datepicker3.css">
</head>
<body class="skin-red">

	<div class="wrapper">
		<header class="main-header">
			<a href="/admin" class="logo">Admin</a>
			<nav class="navbar navbar-static-top" role="navigation">

			</nav>
		</header>

		<div class="content-wrapper" style="margin-left:0px">


<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">

								<button type="submit" class="btn btn-primary">Login</button>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


		</div>

	</div>

	<script src="/bower/jquery/dist/jquery.min.js"></script>
	<script src="/bower/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    {{-- <script src="/plugins/datatables/dataTables.bootstrap.js"></script> --}}
	<script src="/js/admin/slimScroll/jquery.slimScroll.min.js"></script>
	<script src="/js/admin//app.min.js"></script>
	<script src="/css/dist/js/demo.js"></script>

	<script src="/js/admin/datepicker/bootstrap-datepicker.js"></script>
	<script src="/js/admin/timepicker/bootstrap-timepicker.min.js"></script>

	<script src="/js/admin/custom.js"></script>

	@yield('scripts')

</body>
</html>
