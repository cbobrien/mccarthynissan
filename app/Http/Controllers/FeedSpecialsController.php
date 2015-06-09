<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\FeedSpecial;

class FeedSpecialsController extends Controller {

	public function index(Request $request, $brand = 'NISSAN',  $type = 'demo', $perPage)
	{	
		return FeedSpecial::where('brand', $brand)->paginate($perPage)->toJson();
	}

}
