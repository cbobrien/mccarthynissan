<?php namespace App\Http\Controllers;

use Request;
use App\Category;
use App\Car;
use App\CBR\Helpers;
use App\Dealership;
use App\Special;
use App\Promotion;
use App\Used;

class PagesController extends Controller {

	protected $menu;
	protected $dealershipMenu;
	protected $path;

	public function __construct()
	{
		$this->path = Request::path();
		$this->menu = Helpers::makeMenu();
		$this->dealershipMenu = Helpers::makeDealershipMenu();	
	}

	public function home()
	{
		return view('pages.home')->with('path', '')->with(['menu' => $this->menu,
															'dealershipMenu' => $this->dealershipMenu,
															'title' => 'McCarthy Nissan Cars South Africa',
															'description' => 'McCarthy Nissan dealerships are all fully equipped to handle both the sale of new, pre-owned vehicles and after sales (Parts and Service). Contact us now.',
															'keywords' => 'nissan cars'
														]);
	}

	public function newcars()
	{
		$categories = Category::with('cars')->get();
		return view('pages.new-cars')->with(['title' => 'New Cars at McCarthy Nissan',
											 'menu' => $this->menu,
											 'path' => $this->path,
											 'categories' => $categories,
											 'dealershipMenu' => $this->dealershipMenu]);
	}

	public function newcar($id)
	{

		$car = Car::where('id', $id)->with(['versions', 'colours', 'galleries', 'galleryCategories.features'])->first();
		if(!$car) return redirect('/');
		return view('pages.new-car')->with(['car' => $car,
											'title' => $car->title . ' at McCarthy Nissan',
											'description' => $car->title,
											'menu' => $this->menu,
											'path' => $this->path,
											'dealershipMenu' => $this->dealershipMenu]);
	}

	public function demos()
	{
		$dealerships = Dealership::lists('name', 'id');
		$specials = Special::currentSpecials(null, 9);
		$cars = Used::cars('demo');
		return view('pages.demos')->with([	'menu' => $this->menu,
											'path' => $this->path,
											'specials' => $specials,
											'dealerships' => $dealerships,
											'cars' => $cars,
											'dealershipMenu' => $this->dealershipMenu,
											'title' => 'McCarthy Nissan Demo Cars For Sale',
											'description' => 'Take a look at some of McCarthy Nissan demo cars for sale.',
											'keywords' => 'demo cars'
										]);
	}

	public function preownedcars()
	{
		$dealerships = Dealership::lists('name', 'id');
		$specials = Special::currentSpecials(null, 9);
		$cars = Used::cars('preowned');
		return view('pages.preowned')->with(['menu' => $this->menu,
											 'path' => $this->path,
											 'specials' => $specials,
											 'dealerships' => $dealerships,
											 'cars' => $cars,
											 'dealershipMenu' => $this->dealershipMenu,
											 'title' => 'Buy Pre-Owned Vehicles At McCarthy Nissan Today',
											 'description' => 'We have a wide selection of pre-owned Nissan vehicles at all our Dealerships. Our dealers will ensure that you get the best deal.',
											 'keywords' => 'pre-owned vehicles, used vehicles'
											]);
	}

	public function testdrive($id = null, $dealership_id = null)
	{		
		$dealerships = Dealership::lists('name', 'id');
		$cars = Car::lists('title', 'id');	

		if(!isset($id) && !isset($dealership_id))
			return view('pages.test-drive')->with(['cars' => $cars, 'dealership_id' => null, 'car' => null, 'title' => 'Book a Test Drive at McCarthy Nissan', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu, 'dealerships' => $dealerships]);

		if(isset($id) && $id != 'dealership') {
			$car = Car::where('id', $id)->with(['versions'])->first();
			if(!$car) return redirect('/');
					
			return view('pages.test-drive')->with(['dealership_id' => null, 'car' => $car, 'title' => 'Book a Test Drive at McCarthy Nissan', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu, 'dealerships' => $dealerships]);
		}
		else {
			
			return view('pages.test-drive')->with(['cars' => $cars, 'dealership_id' => $dealership_id, 'title' => 'Book a Test Drive at McCarthy Nissan', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu, 'dealerships' => $dealerships]);
		}
	}

	public function service($dealer_id = null)
	{
		$dealerships = Dealership::lists('name', 'id');
		return view('pages.service')->with(['dealer_id' => $dealer_id,
											'menu' => $this->menu,
											'path' => $this->path,
											'dealershipMenu' => $this->dealershipMenu,
											'dealerships' => $dealerships,
											'title' => 'Service Your Vehicle at McCarthy Nissan',
											'description' => "Service your vehicle with McCarthy Nissan. We don't just give excellent service but build customer relationships to ensure a commitment of a long term purchase.",
											'keywords' => 'mccarthy nissan service'
										 ]);
	}

	public function whymccarthy()
	{
		return view('pages.whymccarthy')->with(['menu' => $this->menu,
											    'path' => $this->path,
											    'dealershipMenu' => $this->dealershipMenu,
											    'title' => 'Why Choose McCarthy',
												'description' => "McCarthy Nissan operates strictly according to the McCarthy values, which guide us in every interaction with our customers, our suppliers, stakeholders and staff members.",
												'keywords' => 'why mccarthy'
											   ]);
	}

	public function specials()
	{		
		$promotions = Promotion::currentPromotions();
		$groupPromotions = Promotion::groupPromotions();		
		$specials = Special::currentSpecials();
		$dealerships = Dealership::lists('name', 'id');

		return view('pages.specials')->with(['menu' => $this->menu, 
											  'path' => $this->path,
											  'dealershipMenu' => $this->dealershipMenu,
											  'groupPromotions' => $groupPromotions,
											  'promotions' => $promotions,
											  'specials' => $specials,
											  'dealerships' => $dealerships,
											  'title' => 'Nissan Specials from McCarthy Dealers South Africa',
											  'description' => 'With a wide selection of cars to choose from, you are assured of a great deal. All McCarthy Nissan dealers participate and offers are subject to stock availability.',
											  'keywords' => 'mccarthy nissan specials'
											 ]);
	}

	// public function special()
	// {
	// 	return view('pages.special')->with(['title' => 'Special', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu]);
	// }

	public function parts()
	{
		$dealerships = Dealership::lists('name', 'id');
		return view('pages.parts')->with(['menu' => $this->menu,
										  'path' => $this->path,
										  'dealerships' => $dealerships,
										  'dealershipMenu' => $this->dealershipMenu,
										  'title' => 'Nissan Car Parts For Sale at McCarthy Dealerships Near You',
									      'description' => 'With our service and parts team you can rest assured that your vehicle will be maintained and fitted with genuine parts.',
									      'keywords' => 'mccarthy nissan parts'
										]);
	}

	public function enquire($id)
	{
		$car = Car::where('id', $id)->with(['versions'])->first();
		if(!$car) return redirect('/');
		$dealerships = Dealership::lists('name', 'id');
		return view('pages.enquire')->with(['car' => $car,'title' => $car->title . ' | Enquire', 'menu' => $this->menu, 'path' => $this->path,'dealerships' => $dealerships, 'dealershipMenu' => $this->dealershipMenu]);
	}

	public function contact()
	{
		$dealerships = Dealership::lists('name', 'id');
		return view('pages.contact')->with(['menu' => $this->menu,
											'path' => $this->path,
											'dealerships' => $dealerships,
											'dealershipMenu' => $this->dealershipMenu,
											'title' => 'Contact McCarthy Nissan Dealerships Near You',
											'description' => 'Drive away with a new or used Nissan. Contact McCarthy Nissan today!',
											'keywords' => 'contact mccarthy nissan'
										  ]);
	}

	public function dealership($id)
	{
		$dealership = Dealership::where('id', $id)->with(['promotions'])->first();
		$coynumber = Dealership::getCoyById($id);
		$specials = Special::currentSpecials($coynumber, 3);
		
		switch($dealership->name) {

			case 'McCarthy Nissan Gateway':
				$description = 'Located in the northern part of Durban, we are conveniently situated. We provide a full dealership experience at Nissan gateway.';
				break;

			case 'McCarthy Nissan Germiston':
				$description = 'Our Germiston branch is located on Refinery Road, convenient for all East Rand Clients. We are a full service dealership and our friendly stalff will welcome you.';
				break;
				
			case 'McCarthy Nissan Johannesburg':
				$description = 'McCarthy Nissan Johannesburg has a good sales history. Located on End Street we are central to all clients within the city of gold. GPS coordinates available online.';
				break;

			case 'McCarthy Nissan Randburg':
				$description = 'At McCarthy Nissan Randburg we aim to serve the Fourways and greater Randburg areas. We are a full service dealership and have friendly staff as standard.';
				break;

			case 'McCarthy Nissan Woodmead':
				$description = 'The Woodmead dealership aims to serve the Sandton and Midrand clients. McCarthy Nissan takes pride in offering full service and a wide variety of vehicles at this dealership.';
				break;

			default:
				$description = '';	

		}

		if(!$dealership) return redirect('/');
		return view('pages.dealership')->with(['title' => $dealership->name,
											   'description' => $description,
											   'keywords' => $dealership->name,
											   'path' => $this->path,
											   'menu' => $this->menu,
											   'dealership' => $dealership,
												'specials' => $specials,											
												'dealershipMenu' => $this->dealershipMenu]);
	}

	public function viewCar($type, $vid)
	{		
		$car = Used::where('mmbrand', 'NISSAN')->where('vid', $vid)->first();

		if(!$car) return redirect('/');
		$dealerships = Dealership::lists('name', 'id');
		return view('pages.view-car')->with(['car' => $car,
											 'path' => $this->path,
											 'menu' => $this->menu,
											 'type' => $type,
											 'title' => $car->modeldesc,
											 'dealerships' => $dealerships,
											 'dealershipMenu' => $this->dealershipMenu]);
	}
		

	public function stock($dealership_id)
	{
		$dealership = Dealership::where('id', $dealership_id)->with(['promotions'])->first();
		$coynumber = Dealership::getCoyById($dealership_id);
		$demos = Used::where('mmbrand', 'NISSAN')->where('sdealercoy', $coynumber)->where('type', 'demo')->get();
		$preowneds = Used::where('mmbrand', 'NISSAN')->where('sdealercoy', $coynumber)->where('type', 'preowned')->get();
		$dealerships = Dealership::lists('name', 'id');
		return view('pages.stock')->with(['dealership' => $dealership,
											'coynumber' => $coynumber,
											'path' => 'dealership',
											'menu' => $this->menu,
											'demos' => $demos,
											'preowneds' => $preowneds,
											'dealerships' => $dealerships,
											'dealershipMenu' => $this->dealershipMenu,
											'title' => $dealership->name . ' Stock'
										]);
	}
	
}
