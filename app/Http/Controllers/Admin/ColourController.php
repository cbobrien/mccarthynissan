<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Car;
use App\Colour;
use Datatables;
use App\CBR\Helpers;
use App\Http\Requests\ColourRequest;
use View;

class ColourController extends Controller {

	public function index()
	{
		return view('admin.colours.index')->with('title', 'Car colours');
	}

	public function create()
	{
		$cars = Car::lists('title', 'id');
		return view('admin.colours.create', compact('cars'));
	}

	public function store(ColourRequest $request)
	{		
		$data = Helpers::createDataArray($request, 'colours');
		Colour::create($data);
 		return redirect()->route('admin.colours.index')->with('message', 'Colour created');
	}

	public function edit(Colour $colour)		
	{
		$cars = Car::lists('title', 'id');
		return View::make('admin.colours.edit')->with('colour', $colour)->with('cars', $cars);
	}

	public function update(Colour $colour, ColourRequest $request)
	{
		$data = Helpers::createDataArray($request, 'colours');
		$colour->update($data);
		return redirect()->route('admin.colours.edit', $colour->id)->with('message', 'Colour updated');
	}

	public function destroy(Colour $colour)
	{
		$colour->delete();
		return redirect()->route('admin.colours.index')->with('message', 'Colour deleted');
	}

	public function ajaxAll()
	{
		$colours = Colour::join('nissan_new_cars', 'nissan_new_car_colours.car_id', '=', 'nissan_new_cars.id')
					->select(['nissan_new_car_colours.id as id', 'nissan_new_car_colours.colour as colour',
							  'nissan_new_car_colours.colour_code as colour_code', 'nissan_new_car_colours.created_at as created_at',
							  'nissan_new_cars.title as title'])
					->orderBy('nissan_new_car_colours.created_at', 'DESC');		

	    return Datatables::of($colours)
	        ->addColumn('edit', '<a href="/admin/colours/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i></a>')
	        ->addColumn('delete', '<form method="POST" action="/admin/colours/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->make(true);
	}




}
