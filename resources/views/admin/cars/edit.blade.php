@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.cars.index', 'List Cars', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Edit Car</div>
				<div class="panel-body">

					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible" role="alert">
	  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ Session::get('message') }}
						</div>
					@endif

					@include('errors.list')

					{!! Form::open(['method' => 'PATCH', 'route' => ['admin.cars.update', $car->id], 'class' => 'form-horizontal', 'files' => true]) !!}

						<div class="form-group">
							<label for="title" class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								{!! Form::text('title', $car->title, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="category" class="col-md-4 control-label">Category</label>
							<div class="col-md-6">
								{!! Form::select('category_id', $categories, $car->category_id, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="description" class="col-md-4 control-label">Description</label>
							<div class="col-md-6">
								{!! Form::textarea('description', $car->description, ['class' => 'form-control', 'id' => 'richtext']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="image_path" class="col-md-4 control-label">Thumb</label>
							<div class="col-md-6">
								@if ($car->image_path != '')
									<img src="{{ $car->image_path }}">
								@else
									No file.
								@endif 
								{!! Form::file('image_path') !!}								 
							</div>
						</div>

						<div class="form-group">
							<label for="brochure" class="col-md-4 control-label">Brochure</label>
							<div class="col-md-6">
								@if ($car->brochure_link != '')
									<a href="{{ $car->brochure_link }}">View {{ $car->brochure_link }}</a>
								@else
									No file.
								@endif 
								{!! Form::file('brochure') !!}								 
							</div>
						</div>

						<div class="form-group">
							<label for="specifications" class="col-md-4 control-label">Specifications</label>
							<div class="col-md-6">
								@if ($car->specifications_link != '')
									<a href="{{ $car->specifications_link }}" target="_blank">View {{ $car->specifications_link }}</a>
								@else
									No file.
								@endif 
								{!! Form::file('specifications') !!}
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
