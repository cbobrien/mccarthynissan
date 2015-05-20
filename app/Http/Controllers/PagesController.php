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
		return view('pages.home')->with('path', '')->with(['menu' => $this->menu, 'dealershipMenu' => $this->dealershipMenu]);
	}

	public function newcars()
	{
		$categories = Category::with('cars')->get();
		return view('pages.new-cars')->with(['title' => 'New Cars',
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
											'title' => $car->title,
											'menu' => $this->menu,
											'path' => $this->path,
											'dealershipMenu' => $this->dealershipMenu]);
	}

	public function demos()
	{
		$dealerships = Dealership::lists('name', 'id');
		$specials = Special::currentSpecials(null, 9);
		$cars = Used::cars('demo');
		return view('pages.demos')->with(['title' => 'Demo Cars', 
											'menu' => $this->menu,
											'path' => $this->path,
											'specials' => $specials,
											'dealerships' => $dealerships,
											'cars' => $cars,
											'dealershipMenu' => $this->dealershipMenu]);
	}

	public function preownedcars()
	{
		$dealerships = Dealership::lists('name', 'id');
		$specials = Special::currentSpecials(null, 9);
		$cars = Used::cars('preowned');
		return view('pages.preowned')->with(['title' => 'Pre-owned Cars',
													'menu' => $this->menu,
													'path' => $this->path,
													'specials' => $specials,
													'dealerships' => $dealerships,
													'cars' => $cars,
													'dealershipMenu' => $this->dealershipMenu]);
	}

	public function testdrive($id = null, $dealership_id = null)
	{		
		$dealerships = Dealership::lists('name', 'id');
		$cars = Car::lists('title', 'id');	

		if(!isset($id) && !isset($dealership_id))
			return view('pages.test-drive')->with(['cars' => $cars, 'dealership_id' => null, 'car' => null, 'title' => 'Book a Test Drive', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu, 'dealerships' => $dealerships]);

		if(isset($id) && $id != 'dealership') {
			$car = Car::where('id', $id)->with(['versions'])->first();
			if(!$car) return redirect('/');
					
			return view('pages.test-drive')->with(['dealership_id' => null, 'car' => $car, 'title' => 'Book a Test Drive', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu, 'dealerships' => $dealerships]);
		}
		else {
			
			return view('pages.test-drive')->with(['cars' => $cars, 'dealership_id' => $dealership_id, 'title' => 'Book a Test Drive', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu, 'dealerships' => $dealerships]);
		}
	}

	public function service($dealer_id = null)
	{
		$dealerships = Dealership::lists('name', 'id');
		return view('pages.service')->with(['dealer_id' => $dealer_id, 'title' => 'Book a Service', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu, 'dealerships' => $dealerships]);
	}

	public function whymccarthy()
	{
		return view('pages.whymccarthy')->with(['title' => 'Why McCarthy', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu]);
	}

	public function specials()
	{		
		$promotions = Promotion::currentPromotions();
		$specials = Special::currentSpecials();

		return view('pages.specials')->with(['title' => 'Specials', 
											  'menu' => $this->menu, 
											  'path' => $this->path,
											  'dealershipMenu' => $this->dealershipMenu,
											  'promotions' => $promotions,
											  'specials' => $specials]);
	}

	public function special()
	{
		return view('pages.special')->with(['title' => 'Special', 'menu' => $this->menu, 'path' => $this->path, 'dealershipMenu' => $this->dealershipMenu]);
	}

	public function parts()
	{
		$dealerships = Dealership::lists('name', 'id');
		return view('pages.parts')->with(['title' => 'Parts & Accessories', 'menu' => $this->menu, 'path' => $this->path, 'dealerships' => $dealerships, 'dealershipMenu' => $this->dealershipMenu]);
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
		return view('pages.contact')->with(['title' => 'Contact', 'menu' => $this->menu, 'path' => $this->path, 'dealerships' => $dealerships, 'dealershipMenu' => $this->dealershipMenu]);
	}

	public function dealership($id)
	{
		$dealership = Dealership::where('id', $id)->with(['promotions'])->first();
		$coynumber = Dealership::getCoyById($id);
		$specials = Special::currentSpecials($coynumber, 2);
		
		if(!$dealership) return redirect('/');
		return view('pages.dealership')->with(['title' => $dealership->name, 
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
											'dealershipMenu' => $this->dealershipMenu]);
	}
	
}
