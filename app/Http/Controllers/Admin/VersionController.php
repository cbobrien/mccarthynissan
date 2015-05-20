<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Car;
use App\CarVersion;
use View;
use App\Http\Requests\VersionRequest;
use Config;
use App\Category;
use Datatables;
use DB;

class VersionController extends Controller {

	public function index()
	{
		return view('admin.versions.index')->with('title', 'Car Versions');
	}

	public function create()
	{
		$cars = Car::lists('title', 'id');
		return view('admin.versions.create', compact('cars'));
	}

	public function store(VersionRequest $request)
	{
		CarVersion::create($request->all());
 		return redirect()->route('admin.versions.index')->with('message', 'Version created');
	}

	public function edit(CarVersion $version)		
	{
		$cars = Car::lists('title', 'id');
		return View::make('admin.versions.edit')->with('version', $version)->with('cars', $cars);
	}

	public function update(CarVersion $CarVersion, VersionRequest $request)
	{
		$CarVersion->update($request->all());
		return redirect()->route('admin.versions.edit', $CarVersion->id)->with('message', 'Version updated');
	}

	public function destroy(CarVersion $CarVersion)
	{
		$CarVersion->delete();
		return redirect()->route('admin.versions.index')->with('message', 'Version deleted');
	}

	public function ajaxAll()
	{
		$versions = CarVersion::join('nissan_new_cars', 'nissan_new_car_versions.car_id', '=', 'nissan_new_cars.id')
					->select(['nissan_new_car_versions.id as id', 'nissan_new_car_versions.title as title',
							  'nissan_new_car_versions.created_at as created_at', 'nissan_new_cars.title as car'])
					->orderBy('nissan_new_car_versions.created_at', 'desc');		

	    return Datatables::of($versions)
	        ->addColumn('edit', '<a href="/admin/versions/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i></a>')
	        ->addColumn('delete', '<form method="POST" action="/admin/versions/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->make(true);
	}

}
