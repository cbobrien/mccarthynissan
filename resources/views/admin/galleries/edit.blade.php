@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.galleries.index', 'List galleries', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Edit Gallery Image</div>
				<div class="panel-body">

					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible" role="alert">
	  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ Session::get('message') }}
						</div>
					@endif

					@include('errors.list')

					{!! Form::open(['method' => 'PATCH', 'route' => ['admin.galleries.update', $gallery->id], 'class' => 'form-horizontal', 'files' => true]) !!}

						<div class="form-group">
							<label for="car_id" class="col-md-4 control-label">Car</label>
							<div class="col-md-6">
								{!! Form::select('car_id', [null => 'Please Select'] + $cars, $gallery->car_id, ['class' => 'form-control']) !!}
							</div>
						</div>						

						<div class="form-group">
							<label for="type" class="col-md-4 control-label">Type</label>
							<div class="col-md-6">							
								{!! Form::select('type', [null => 'Please Select'] + $types, $gallery->type, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group">
							<label for="image_path" class="col-md-4 control-label">Image</label>
							<div class="col-md-6">
								@if ($gallery->image_path != '')
									<img src="{{ $gallery->image_path }}">
								@else
									No file.
								@endif 
								{!! Form::file('image_path') !!}								 
							</div>
						</div>
					
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
