@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.colours.index', 'All Colours', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Add Colour</div>
				<div class="panel-body">									

					@include ('errors.list')

					{!! Form::open(['route' => 'admin.colours.store', 'class' => 'form-horizontal', 'files' => true]) !!}					

						<div class="form-group">
							<label for="car_id" class="col-md-4 control-label">Car</label>
							<div class="col-md-6">
								{!! Form::select('car_id', [null => 'Please Select'] + $cars, null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="colour" class="col-md-4 control-label">Colour</label>
							<div class="col-md-6">
								{!! Form::text('colour', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="colour_code" class="col-md-4 control-label">Code</label>
							<div class="col-md-6">
								{!! Form::text('colour_code', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="image_path" class="col-md-4 control-label">Image</label>
							<div class="col-md-6">
								{!! Form::file('image_path') !!}
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Add</button>
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
	
@stop
