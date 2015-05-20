@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.cars.index', 'All Cars', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Edit New Car Category</div>
				<div class="panel-body">

					@include('errors.list')

					{!! Form::open(['method' => 'PATCH', 'route' => ['admin.categories.update', $category->id], 'class' => 'form-horizontal']) !!}

					<div class="form-group">
						<label for="category" class="col-md-4 control-label">Category</label>
						<div class="col-md-6">
							{!! Form::text('category', $category->category, ['class' => 'form-control']) !!}
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
@endsection
