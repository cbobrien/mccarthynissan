var React = require('react/addons');
var UsedCars = require('./UsedCars');
var FeedSpecialsSidebar = require('./FeedSpecialsSidebar');


if(document.getElementById('demoCars') !== null) {
	React.render(
		<UsedCars url={'http://localhost:8000/api/v1/used/NISSAN/demo/10'} perPage={10} type={'demo'} />,
			document.getElementById('demoCars')
	);
}


if(document.getElementById('preownedCars')) {
	React.render(
		<UsedCars url={'http://localhost:8000/api/v1/used/NISSAN/preowned/10'} perPage={10} type={'pre-owned'} />,
			document.getElementById('preownedCars')
	);
}

// if(document.getElementById('specialsSidebar') !== null) {
// 	React.render(
// 		<FeedSpecialsSidebar url={'http://localhost:8000/api/v1/feedspecials/NISSAN/1'} perPage={1} />,
// 			document.getElementById('specialsSidebar')
// 	);
// }

// console.log(UsedCars);