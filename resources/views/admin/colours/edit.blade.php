@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.colours.index', 'List Colours', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Edit Colour</div>
				<div class="panel-body">

					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible" role="alert">
	  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ Session::get('message') }}
						</div>
					@endif

					@include('errors.list')

					{!! Form::open(['method' => 'PATCH', 'route' => ['admin.colours.update', $colour->id], 'class' => 'form-horizontal', 'files' => true]) !!}

						<div class="form-group">
							<label for="car_id" class="col-md-4 control-label">Car</label>
							<div class="col-md-6">
								{!! Form::select('car_id', $cars, $colour->car_id, ['class' => 'form-control']) !!}
							</div>
						</div>					
	
						<div class="form-group">
							<label for="colour" class="col-md-4 control-label">Colour</label>
							<div class="col-md-6">
								{!! Form::text('colour', $colour->colour, ['class' => 'form-control']) !!}
							</div>
						</div>					

						<div class="form-group">
							<label for="colour_code" class="col-md-4 control-label">Code</label>
							<div class="col-md-6">
								{!! Form::text('colour_code', $colour->colour_code, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="image_path" class="col-md-4 control-label">Image</label>
							<div class="col-md-6">
								@if ($colour->image_path != '')
									<img src="{{ $colour->image_path }}" alt="{{ $colour->colour }}">
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
