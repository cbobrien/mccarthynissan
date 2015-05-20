@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.gallery-categories.index', 'List Gallery Categories', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Add Gallery Category</div>
				<div class="panel-body">									

					@include ('errors.list')

					{!! Form::open(['route' => 'admin.gallery-categories.store', 'class' => 'form-horizontal', 'files' => true]) !!}					

						<div class="form-group">
							<label for="car_id" class="col-md-4 control-label">Car</label>
							<div class="col-md-6">
								{!! Form::select('car_id', [null => 'Please Select'] + $cars, null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="type" class="col-md-4 control-label">Type</label>
							<div class="col-md-6">
								{!! Form::select('type', [null => 'Please Select'] + $types, null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="title" class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
									{!! Form::text('title', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="description" class="col-md-4 control-label">Description</label>
							<div class="col-md-6">
									{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
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
