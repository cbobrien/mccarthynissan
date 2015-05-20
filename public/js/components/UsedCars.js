var React = require('react/addons');
var ReactPaginate = require('react-paginate');

var ReactCSSTransitionGroup = React.addons.CSSTransitionGroup;

var CarList = React.createClass({

	render: function() {

		var CarNodes = this.props.data.map(function(car, index) {

			return (	
				<ReactCSSTransitionGroup transitionName="example">
					<div className="row" key={car.modeldesc.replace(/\s+/g, '') + car.princl.replace(/\s+/g, '')}>
						<div className="car-row">
							<div className="col-xs-12 col-md-6 used-car-image-container">
								<a href="/car"><img src={car.img1 ? car.img1 : "/images/unavailable.png"} className="img-responsive" alt={car.modeldesc} /></a>
							</div>
							<div className="col-xs-12 col-md-6">
								<div className="description">
									<h2>{car.modeldesc}</h2>
									<h3>{car.mmmodel}</h3>
									<p className="year">{car.year}</p>
									<p className="price">R{car.princl}</p>
									<p className="kms">{car.kms} kms</p>												
									<p> 
										<a href={"/view-car/demo/" + car.vid} className="btn btn-grey left-top-radius">View</a>
										<a href="/enquire" className="btn btn-grey right-bottom-radius">Enquire</a>
									</p>
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

		//console.log('this.props.perPage: ' + this.props.perPage);

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
					breakLabel={<li className="break"><a href="">...</a></li>}
					pageNum={this.state.pageNum}
					marginPagesDisplayed={2}
					pageRangeDisplayed={3}
					clickCallback={this.handlePageClick}
					containerClassName={"pagination"}
					subContainerClassName={"pages pagination"}
					activeClass={"active"} />
				
				<CarList data={this.state.data} />

			</div>
		);
	}

});

//module.exports = UsedCars;s






