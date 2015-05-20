@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.promotions.index', 'List Promotions', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Edit Promotion</div>
				<div class="panel-body">

					@if (Session::has('message'))
						<div class="alert alert-success alert-dismissible" role="alert">
	  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ Session::get('message') }}
						</div>
					@endif

					@include('errors.list')

					{!! Form::open(['method' => 'PATCH', 'route' => ['admin.promotions.update', $promotion->id], 'class' => 'form-horizontal', 'files' => true]) !!}

						<div class="form-group">
							<label for="dealership_id" class="col-md-4 control-label">Dealership</label>
							<div class="col-md-6">
								{!! Form::select('dealership_id', [null => 'Please Select'] + $dealerships, $promotion->dealership_id, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								{!! Form::text('name', $promotion->name, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="published" class="col-md-4 control-label">Published</label>
							<div class="col-md-6">
								{!! Form::checkbox('published', '1', $promotion->published) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="image_path" class="col-md-4 control-label">Image</label>
							<div class="col-md-6">
								@if ($promotion->image_path != '')
									<img src="{{ $promotion->image_path }}" alt="{{ $promotion->name }}" style="max-width:600px">
								@else
									No file.
								@endif 
								{!! Form::file('image_path') !!}								 
							</div>
						</div>
						
						<div class="form-group">
							<label for="order" class="col-md-4 control-label">Order</label>
							<div class="col-md-6">
								{!! Form::input('number', 'order', $promotion->order) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="expiry_date" class="col-md-4 control-label">Expiry Date</label>
							<div class="col-md-6">
								{!! Form::text('expiry_date', $promotion->expiry_date, ['class' => 'form-control', 'id' => 'date']) !!}
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
