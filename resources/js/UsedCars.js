var React = require('react/addons');
var ReactPaginate = require('react-paginate');

var ReactCSSTransitionGroup = React.addons.CSSTransitionGroup;

var CarList = React.createClass({

	render: function() {

		var used_type = this.props.type;

		var CarNodes = this.props.data.map(function(car, index) {

			return (	
				<ReactCSSTransitionGroup transitionName="example">
					<div className="row" key={car.modeldesc.replace(/\s+/g, '') + car.princl.replace(/\s+/g, '')}>
						<div className="car-row">
							<div className="col-xs-12 col-sm-4 used-car-image-container">
								<a href="/car"><img src={car.img1 ? car.img1 : "/images/unavailable.png"} className="img-responsive" alt={car.modeldesc} /></a>
							</div>
							<div className="col-xs-12 col-sm-8">
								<div className="description">
									<h2>{car.modeldesc}</h2>
									<h3>{car.mmmodel}</h3>
									<p className="price">R{car.princl}</p>
									<div className="row"> 
										<div className="col-xs-12 col-sm-6">																																	
											<p className="kms">{car.kms} kms</p>
										</div>
										<div className="col-xs-12 col-sm-6">
											<p className="text-right used-buttons"> 										
												<a href="#" className="btn btn-red left-top-radius border-grey" 
														data-toggle="modal"														
														data-target="#modalEnquire" 													
														data-vid={car.vid} 
														data-car-name={car.modeldesc}
														data-enquiry-type={car.type}>Enquire</a>
												&nbsp;
												<a href={"/view-car/" + car.type + "/" + car.vid} className="btn btn-grey right-bottom-radius view-hover border-grey">View</a>
											</p>
										</div>
									</div>																													
								</div>
							</div>
						</div>
					</div>
				</ReactCSSTransitionGroup>
			);
		});

		return (
			<div>
				{CarNodes}
			</div>
		);
	}

});


var UsedCars = React.createClass({

	loadCars: function() {						

		$.ajax({
			url: this.props.url,
			data: {page: this.state.selected + 1},
			dataType: 'json',
			type: 'GET',
			success: (data) => {
				this.setState({data: data.data, pageNum: Math.ceil(data.total / this.props.perPage)});
			},
			error: (xhr, status, err) => {				
				console.error(this.props.url, status, err.toString());
			}
		});
	},

	handlePageClick: function(data) {

		var selected = data.selected;
		var offset = Math.ceil(selected * this.props.perPage);

		this.setState({offset: offset, selected: selected}, function() {
			this.loadCars();
		}.bind(this));

		this.loadCars();
	},

	getInitialState: function() {
		return {data: [], offset: 0, selected: 0};
	},

	componentDidMount: function() {			
		this.loadCars();
	},

	render: function() {
		return (
			<div>
				<ReactPaginate previousLabel={"previous"}
					nextLabel={"next"}
					breakLabel={<li className="break">...</li>}
					pageNum={this.state.pageNum}
					marginPagesDisplayed={2}
					pageRangeDisplayed={3}
					clickCallback={this.handlePageClick}
					containerClassName={"pagination"}
					subContainerClassName={"pages pagination"}
					activeClass={"active"} />
				
				<CarList data={this.state.data} />

				<ReactPaginate previousLabel={"previous"}
					nextLabel={"next"}
					breakLabel={<li className="break">...</li>}
					pageNum={this.state.pageNum}
					marginPagesDisplayed={2}
					pageRangeDisplayed={3}
					clickCallback={this.handlePageClick}
					containerClassName={"pagination"}
					subContainerClassName={"pages pagination"}
					activeClass={"active"} />

			</div>
		);
	}

});

module.exports = UsedCars;

// React.render(
// 	<UsedCars url={'http://localhost:8000/api/v1/used/NISSAN/demo/2'} perPage={2} />,
// 		document.getElementById('demoCars')
// );






