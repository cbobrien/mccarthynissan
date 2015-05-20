@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.versions.index', 'List Versions', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Add New Car Version</div>
				<div class="panel-body">									

					@include ('errors.list')

					{!! Form::open(['route' => 'admin.versions.store', 'class' => 'form-horizontal', 'files' => true]) !!}					

						<div class="form-group">
							<label for="car_id" class="col-md-4 control-label">Car</label>
							<div class="col-md-6">
								{!! Form::select('car_id', [null => 'Please Select'] + $cars, null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="title" class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								{!! Form::text('title', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="price" class="col-md-4 control-label">Price</label>
							<div class="col-md-6">
								{!! Form::text('price', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="features_1" class="col-md-4 control-label">Features 1</label>
							<div class="col-md-6">
								{!! Form::textarea('features_1', null, ['class' => 'form-control', 'id' => 'richtext']) !!}
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
	@include('admin.partials.script.rte')
@stop
