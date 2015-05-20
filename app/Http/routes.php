<?php

use App\Used;

Route::get('/', 'PagesController@home');
Route::get('/new-cars', ['as' => 'pages.new-cars', 'uses' => 'PagesController@newcars']);
Route::get('/new-car/{id}/{name?}', ['as' => 'pages.new-car', 'uses' => 'PagesController@newcar']);
Route::get('/why-mccarthy', ['as' => 'pages.why', 'uses' => 'PagesController@whymccarthy']);
Route::get('/dealership/{id}/{name?}', ['as' => 'pages.dealership', 'uses' => 'PagesController@dealership']);
Route::get('/service/{dealerid?}', ['as' => 'pages.service', 'uses' => 'PagesController@service']);
Route::get('/parts', ['as' => 'pages.parts', 'uses' => 'PagesController@parts']);
Route::get('/test-drive/{carid?}/{dealerid?}', ['as' => 'pages.test-drive', 'uses' => 'PagesController@testdrive']);
// Route::get('/test-drive', ['as' => 'pages.test-drive-none-selected', 'uses' => 'PagesController@testDriveNoneSelected']);
Route::get('/contact', ['as' => 'pages.contact', 'uses' => 'PagesController@contact']);
//Route::get('/demo-cars', ['as' => 'pages.demo-cars', 'uses' => 'PagesController@democars']);
Route::get('/demo-cars', ['as' => 'pages.demos', 'uses' => 'PagesController@demos']);
Route::get('/pre-owned-cars', ['as' => 'pages.pre-owned-cars', 'uses' => 'PagesController@preownedcars']);
Route::get('/specials', ['as' => 'pages.specials', 'uses' => 'PagesController@specials']);
Route::get('/special', ['as' => 'pages.special', 'uses' => 'PagesController@special']);
Route::get('/enquire/{id}', ['as' => 'pages.enquire', 'uses' => 'PagesController@enquire']);
Route::get('/view-car/{type}/{vid}', ['as' => 'pages.view-car', 'uses' => 'PagesController@viewCar']);
Route::any('/search/{type}/{min}/{max}/{region?}/{series?}', ['as' => 'pages.search', 'uses' => 'SearchController@search']);
Route::get('/stock/{coy}', ['as' => 'pages.stock', 'uses' => 'PagesController@stock']);


//front end forms
Route::post('/contact/send', ['as' => 'contact.send', 'uses' => 'FormsController@contact']);
Route::post('/parts/send', ['as' => 'parts.send', 'uses' => 'FormsController@parts']);
Route::post('/service/send', ['as' => 'service.send', 'uses' => 'FormsController@service']);
Route::post('/test-drive/send', ['as' => 'test-drive.send', 'uses' => 'FormsController@testDrive']);
Route::post('/enquire/send', ['as' => 'enquire.send', 'uses' => 'FormsController@enquire']);
Route::post('/vehicle-enquiry/send', ['as' => 'vehicle-enquiry.send', 'uses' => 'FormsController@vehicleEnquiry']);
Route::post('/special-enquiry/send', ['as' => 'special-enquiry.send', 'uses' => 'FormsController@specialEnquiry']);
Route::post('/promotion-enquiry/send', ['as' => 'promotion-enquiry.send', 'uses' => 'FormsController@promotionEnquiry']);

//search
Route::get('/search/regions/{type}', ['as' => 'search.regions', 'uses' => 'SearchController@regions']);
Route::get('/search/series/{type}', ['as' => 'search.series', 'uses' => 'SearchController@series']);
Route::get('/search/specials-regions/', ['as' => 'search.specials-regions', 'uses' => 'SearchController@specialsRegions']);
//api
Route::get('/api/v1/used/{brand}/{type}/{perPage}', ['as' => 'api.used', 'uses' => 'UsedController@index']);
// Route::get('/api/v1/feedspecials/{brand}/{perPage}', ['as' => 'api.feedspecials', 'uses' => 'FeedSpecialsController@index']);

// Route::group(['middleware' => 'auth'], function () {

	//admin
	Route::get('/admin', ['as' => 'admin.home', 'uses' => 'AdminController@index']);
	//categories
	Route::get('/admin/categories/all', 'Admin\CategoryController@ajaxAll');
	Route::resource('/admin/categories', 'Admin\CategoryController');
	//cars
	Route::get('/admin/cars/all', 'Admin\CarController@ajaxAll');
	Route::resource('/admin/cars', 'Admin\CarController');
	//versions
	Route::get('/admin/versions/all', 'Admin\VersionController@ajaxAll');
	Route::resource('/admin/versions', 'Admin\VersionController');
	//colours
	Route::get('/admin/colours/all', 'Admin\ColourController@ajaxAll');
	Route::resource('/admin/colours', 'Admin\ColourController');
	//galleries
	Route::get('/admin/galleries/all', 'Admin\GalleriesController@all');
	Route::resource('/admin/galleries', 'Admin\GalleriesController');
	//gallery categories
	Route::get('/admin/gallery-categories/all', 'Admin\GalleryCategoriesController@all');
	Route::resource('/admin/gallery-categories', 'Admin\GalleryCategoriesController');
	//gallery features
	Route::get('/admin/gallery-features/categories/{car_id}', 'Admin\GalleryFeaturesController@get_categories_by_car');
	Route::get('/admin/gallery-features/all', 'Admin\GalleryFeaturesController@all');
	Route::resource('/admin/gallery-features', 'Admin\GalleryFeaturesController');
	//videos
	Route::get('/admin/videos/all', 'Admin\VideosController@all');
	Route::resource('/admin/videos', 'Admin\VideosController');
	//dealerships
	Route::get('/admin/dealerships/all', 'Admin\DealershipController@all');
	Route::resource('/admin/dealerships', 'Admin\DealershipController');
	//general enquiries
	Route::get('/admin/enquiries/all', 'Admin\GeneralEnquiriesController@all');
	Route::resource('/admin/enquiries', 'Admin\GeneralEnquiriesController', ['except' => ['create', 'store', 'update', 'edit']]);
	//car enquiries
	Route::get('/admin/car-enquiries/all', 'Admin\CarEnquiriesController@all');
	Route::resource('/admin/car-enquiries', 'Admin\CarEnquiriesController', ['except' => ['create', 'store', 'update', 'edit']]);
	//parts
	Route::get('/admin/parts/all', 'Admin\PartsController@all');
	Route::resource('/admin/parts', 'Admin\PartsController', ['except' => ['create', 'store', 'update', 'edit']]);
	//parts
	Route::get('/admin/services/all', 'Admin\ServicesController@all');
	Route::resource('/admin/services', 'Admin\ServicesController', ['except' => ['create', 'store', 'update', 'edit']]);
	//test drives
	Route::get('/admin/test-drives/all', 'Admin\TestDrivesController@all');
	Route::resource('/admin/test-drives', 'Admin\TestDrivesController', ['except' => ['create', 'store', 'update', 'edit']]);
	//promotions
	Route::get('/admin/promotions/all', 'Admin\PromotionsController@all');
	Route::resource('/admin/promotions', 'Admin\PromotionsController');
	//used car enquiries
	Route::get('/admin/used-enquiries/all', 'Admin\UsedEnquiriesController@all');
	Route::resource('/admin/used-enquiries', 'Admin\UsedEnquiriesController', ['except' => ['create', 'store', 'update', 'edit']]);
	//special enquiries
	Route::get('/admin/special-enquiries/all', 'Admin\SpecialEnquiriesController@all');
	Route::resource('/admin/special-enquiries', 'Admin\SpecialEnquiriesController', ['except' => ['create', 'store', 'update', 'edit']]);
	//promotion enquiries
	Route::get('/admin/promotion-enquiries/all', 'Admin\PromotionEnquiriesController@all');
	Route::resource('/admin/promotion-enquiries', 'Admin\PromotionEnquiriesController', ['except' => ['create', 'store', 'update', 'edit']]);

// });


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
