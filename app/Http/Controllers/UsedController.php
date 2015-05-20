<?php namespace App\Http\Controllers;

use Request;
use App\Used;
use View;

class UsedController extends Controller {

	protected $menu;
	protected $dealershipMenu;
	protected $path;

	public function __construct()
	{
		$this->path = Request::path();
	}

	public function index(Request $request, $brand = 'NISSAN',  $type = 'demo', $perPage = 10, $coynumber = null)
	{	
		return Used::where('mmbrand', $brand)->where('type', $type)->paginate($perPage)->toJson();
	}

	public function cars($type = demos)
	{
		$cars = Used::where('mmbrand', 'NISSAN')
					->where('type', $type)
					->paginate(10);

		return $cars;
	}	
	
}
