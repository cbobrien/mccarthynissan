<div class="modal fade modal-search" id="modalSpecial" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		{!! Form::open(['route' => 'special-enquiry.send', 'class' => 'form-horizontal', 'id' => 'specialForm']) !!}
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Special Enquiry</h4>
				</div>
				<div class="modal-body">
					<div class="row row-modal">
						<div class="col-xs-10 col-xs-offset-1">
							<h4 class="special-name"></h4>
							@include ('errors.list')								

							<img src="/images/loader.gif" class="spinner">

							<div class="ajax-message"></div>													

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
						
							<input type="hidden" id="specialId" name="specialId">						
							
						</div>
					</div>				
				</div>			 			
				<div class="modal-footer">
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3">
							<button type="button" class="btn btn-red btn-larger btn-block" id="specialSend">Send</button>							
						</div>	
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>

