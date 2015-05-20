<div class="modal fade modal-search" id="modalSearch" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Search</h4>
			</div>
			{!! Form::open(['route' => 'pages.search', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'searchForm']) !!}
				<div class="modal-body">
					<div class="row row-modal">
						<div class="col-xs-6 no-padding-right">
							<button type="button" class="btn btn-block btn-modal btn-grey-modal selected btn-type" data-type="new">New</button>
						</div>
						<div class="col-xs-6 no-padding-left">
							<button type="button" class="btn btn-block btn-modal btn-grey-modal btn-type" data-type="demo">Demo</button>
						</div>
					</div>
					<div class="row row-modal">
						<div class="col-xs-6 no-padding-right">
							<button type="button" class="btn btn-block btn-modal btn-grey-modal btn-type" data-type="pre-owned">Pre-Owned</button>
						</div>	
						<div class="col-xs-6 no-padding-left">
							<button type="button" class="btn btn-block btn-modal btn-grey-modal btn-type" data-type="specials">Specials</button>
						</div>
					</div>					
					<div class="row" id="searchRegionRow">
						<div class="col-xs-12">						
							<select class="form-control modal-select" name="region" id="region" class="region">
							</select>							
						</div>
					</div>	
					<div class="row" id="searchSeriesRow">
						<div class="col-xs-12">
							<select class="form-control modal-select" name="series" id="series" class="series">													
							</select>
						</div>
					</div>
					<div class="row" id="searchPriceRow">
						<div class="price-range-container clearfix">
							<div class="col-xs-12 col-md-10 col-md-offset-2">						
								<label for="price" class="price-label" id="priceLabel">Vehicle price:</label>
								<input type="text" id="priceRange" class="price-range" readonly>																												
							</div>
						</div>					
					</div>
				{{-- 	<div class="row" id="searchPriceButtonRow">
						<div class="price-range-container clearfix">
							<div class="col-xs-12 col-md-6 col-md-offset-3">
								<button type="button" id="changeRange" class="change-range" style="display:table-cell">Use Monthly Price Range</button>
							</div>
						</div>
					</div>	 --}}				
					<div class="row" id="searchPriceSliderRow">
						<div class="col-xs-12">
							<div id="sliderRange"></div>				
						</div>
					</div>				
				</div>

				<input type="hidden" name="type" id="type" value="new">
				<input type="hidden" name="min" id="min" value="">
				<input type="hidden" name="max" id="max" value="">		

				<div class="modal-footer">
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3">
							<button type="button" class="btn btn-red btn-larger btn-block" id="searchButton">Search</button>
						</div>	
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

