@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.cars.index', 'List Cars', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Add New Car</div>
				<div class="panel-body">									

					@include ('errors.list')

					{!! Form::open(['route' => 'admin.cars.store', 'class' => 'form-horizontal', 'files' => true]) !!}					

						<div class="form-group">
							<label for="category" class="col-md-4 control-label">Category</label>
							<div class="col-md-6">
								{!! Form::select('category_id', [null => 'Please Select'] + $categories, null, ['class' => 'form-control']) !!}
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
								{!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'richtext']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="image_path" class="col-md-4 control-label">Thumb</label>
							<div class="col-md-6">
								{!! Form::file('image_path') !!}
							</div>
						</div>

						<div class="form-group">
							<label for="brochure" class="col-md-4 control-label">Brochure</label>
							<div class="col-md-6">
								{!! Form::file('brochure') !!}
							</div>
						</div>

						<div class="form-group">
							<label for="specifications" class="col-md-4 control-label">Specifications</label>
							<div class="col-md-6">
								{!! Form::file('specifications') !!}
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
