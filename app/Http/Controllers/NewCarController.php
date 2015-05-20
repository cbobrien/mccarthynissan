<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Car;


class NewCarController extends Controller {

	public function show($id)
	{
		$car = Car::where('id', $id)->with('versions')->get();
		
		dd(Car::getLowestVersionPrice());
		return view('pages.new-car')->with(['car' => $car, 'path' => '/new-car']);
	}

}
