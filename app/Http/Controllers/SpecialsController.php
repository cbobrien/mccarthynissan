<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SpecialsController extends Controller {

	public function index(Request $request, $brand = 'NISSAN',  $type = 'demo', $perPage = 10)
	{	
		return Special::where('brand', $brand)->where('type', $type)->paginate($perPage)->toJson();
	}

}
