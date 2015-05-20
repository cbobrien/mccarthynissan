<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);
		$router->model('categories', 'App\Category');
		$router->model('cars', 'App\Car');
		$router->model('versions', 'App\CarVersion');
		$router->model('colours', 'App\Colour');
		$router->model('galleries', 'App\Gallery');
		$router->model('gallery_categories', 'App\GalleryCategory');
		$router->model('gallery_features', 'App\GalleryFeature');
		$router->model('dealerships', 'App\Dealership');
		$router->model('videos', 'App\Video');
		$router->model('enquiries', 'App\GeneralEnquiry');
		$router->model('car-enquiries', 'App\CarEnquiry');
		$router->model('parts', 'App\Part');
		$router->model('services', 'App\Service');
		$router->model('test-drives', 'App\TestDrive');
		$router->model('promotions', 'App\Promotion');
		$router->model('used_enquiries', 'App\UsedEnquiry');
		$router->model('special_enquiries', 'App\SpecialEnquiry');
		$router->model('promotion_enquiries', 'App\PromotionEnquiry');
	}



	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
