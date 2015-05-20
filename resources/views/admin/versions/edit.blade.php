@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.versions.index', 'List Versions', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Edit Version</div>
				<div class="panel-body">

					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible" role="alert">
	  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ Session::get('message') }}
						</div>
					@endif

					@include('errors.list')

					{!! Form::open(['method' => 'PATCH', 'route' => ['admin.versions.update', $version->id], 'class' => 'form-horizontal']) !!}

						<div class="form-group">
							<label for="title" class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								{!! Form::text('title', $version->title, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="car" class="col-md-4 control-label">Car</label>
							<div class="col-md-6">
								{!! Form::select('car_id', $cars, $version->car_id, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="price" class="col-md-4 control-label">Price</label>
							<div class="col-md-6">
								{!! Form::text('price', $version->price, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="features_1" class="col-md-4 control-label">Features 1</label>
							<div class="col-md-6">
								{!! Form::textarea('features_1', $version->features_1, ['class' => 'form-control', 'id' => 'richtext']) !!}
							</div>
						</div>
{{-- 
						<div class="form-group">
							<label for="features_2" class="col-md-4 control-label">Features 2</label>
							<div class="col-md-6">
								{!! Form::textarea('features_2', $version->features_2, ['class' => 'form-control']) !!}
							</div>
						</div> --}}
					
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	@include('admin.partials.script.rte')
@stop
