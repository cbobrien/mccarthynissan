var React = require('react/addons');
// var ReactPaginate = require('react-paginate');

// var ReactCSSTransitionGroup = React.addons.CSSTransitionGroup;

var SpecialList = React.createClass({

	render: function() {

		var SpecialNodes = this.props.data.map(function(special, index) {

			return (					
				<div className="row" key={special.thumbnail.replace(/\s+/g, '')}>
					<div className="car-row">
						<div className="col-xs-12 col-md-6 used-car-image-container">
							Special
						</div>
						<div className="col-xs-12 col-md-6">				
							<p className="price">R{special.title}</p>										
						</div>
					</div>
				</div>				
			);
		});

		return (
			<div>
				{SpecialNodes}
			</div>
		);
	}
});


var FeedSpecialsSidebar = React.createClass({

	loadSpecials: function() {						

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

		this.loadSpecials();
	},

	getInitialState: function() {
		return {data: [], offset: 0, selected: 0};
	},

	componentDidMount: function() {			
		this.loadSpecials();
	},

	render: function() {
		return (
			<div>						
				<SpecialList data={this.state.data} />
			</div>
		);
	}

});

module.exports = FeedSpecialsSidebar;






