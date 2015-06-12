@extends('admin/master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="text-left">
		        {!! link_to_route('admin.promotions.index', 'All Promotions', null, ['class' => 'btn btn-primary']) !!}
		    </p>
			<div class="panel panel-default">
				<div class="panel-heading">Add Promotion</div>
				<div class="panel-body">									

					@include ('errors.list')

					{!! Form::open(['route' => 'admin.promotions.store', 'class' => 'form-horizontal', 'files' => true]) !!}					

						<div class="form-group">
							<label for="dealership_id" class="col-md-4 control-label">Dealership</label>
							<div class="col-md-6">
								{!! Form::select('dealership_id', ['0' => 'Group'] + $dealerships, null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								{!! Form::text('name', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="published" class="col-md-4 control-label">Published</label>
							<div class="col-md-6">
								{!! Form::checkbox('published', '1', 0) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="image_path" class="col-md-4 control-label">Image</label>
							<div class="col-md-6">
								{!! Form::file('image_path') !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="order" class="col-md-4 control-label">Order</label>
							<div class="col-md-6">
								{!! Form::input('number', 'order', null) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="expiry_date" class="col-md-4 control-label">Expiry Date</label>
							<div class="col-md-6">
								{!! Form::text('expiry_date', null, ['class' => 'form-control', 'id' => 'date']) !!}
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
