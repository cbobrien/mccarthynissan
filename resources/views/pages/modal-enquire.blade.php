<div class="modal fade modal-search" id="modalEnquire" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		{!! Form::open(['route' => 'vehicle-enquiry.send', 'class' => 'form-horizontal', 'id' => 'enquireForm']) !!}
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Enquire</h4>
				</div>
				<div class="modal-body">
					<div class="row row-modal">
						<div class="col-xs-10 col-xs-offset-1">
							<h4 class="enquiry-car-name"></h4>
							@include ('errors.list')								

							<img src="/images/loader.gif" class="spinner">

							<div class="ajax-message"></div>						

							@if (isset($dealerships))
								<div class="form-group">
									<label for="dealership_id"  class="required-label">Dealership</label>
									{!! Form::select('dealership_id', [null => 'Please select a dealership'] + $dealerships, null, ['class' => 'form-control', 'id' => 'dealership_id', 'required']) !!}
								</div>
							@endif

							<div class="form-group">
								<label for="firstname" class="required-label">First Name</label>								
								{!! Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname', 'required']) !!}
							</div>
							<div class="form-group">
								<label for="surname" class="required-label">Surname</label>								
								{!! Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'required']) !!}
							</div>
							<div class="form-group">
								<label for="email" class="required-label">Email</label>
								{!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'required']) !!}
							</div>
							<div class="form-group">
								<label for="tel" class="required-label">Phone Number</label>							
								{!! Form::text('tel', null, ['class' => 'form-control', 'id' => 'tel', 'required']) !!}
							</div>						
						
							<input type="hidden" id="vid" name="vid">
							<input type="hidden" id="enquiryType" name="enquiryType">
							
						</div>
					</div>				
				</div>			 			
				<div class="modal-footer">
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3">
							<button type="button" class="btn btn-red btn-larger btn-block" id="enquireSend">Send</button>							
						</div>	
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>

