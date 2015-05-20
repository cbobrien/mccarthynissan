<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use View;
use App\Http\Requests\CarRequest;
use Config;
use App\Category;
use App\Car;
use Datatables;

class CarController extends Controller {

	protected $filePath = '/public/files';

	public function index()
	{
		return view('admin.cars.index')->with(['title' => 'New Cars', 'path' => 'admin/cars']);
	}

	public function create()
	{
		$categories = Category::lists('category', 'id');
		return view('admin.cars.create', compact('categories'));
	}

	public function store(CarRequest $request)
	{
		$data = $this->createDataArray($request);
		Car::create($data);
 		return redirect()->route('admin.cars.index')->with('message', 'New car created');
	}

	public function edit(Car $car)
	{
		$categories = Category::lists('category', 'id');
		return View::make('admin.cars.edit')->with('car', $car)->with('categories', $categories);
	}

	public function update(Car $car, CarRequest $request)
	{
		$data = $this->createDataArray($request);
		$car->update($data);
		return redirect()->route('admin.cars.edit', $car->id)->with('message', 'Car updated');
	}

	public function destroy(Car $car)
	{
		$car->delete();
		return redirect()->route('admin.cars.index')->with('message', 'Car deleted');
	}

	public function ajaxAll()
	{
		$cars = Car::join('nissan_new_car_categories', 'nissan_new_cars.category_id', '=', 'nissan_new_car_categories.id')
					->select(['nissan_new_cars.id as id', 'nissan_new_cars.title as title', 'nissan_new_cars.created_at as created_at', 'nissan_new_car_categories.category as category']);
					//->orderBy('nissan_new_cars.created_at' ,'desc');        		

	    return Datatables::of($cars)
	        ->addColumn('edit', '<a href="/admin/cars/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i></a>')
	        ->addColumn('delete', '<form method="POST" action="/admin/cars/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->make(true);
	}

	protected function moveFile($file, $title)
	{	
	    $fileName = $this->cleanInput($title) . '-' . mt_rand() . '.' . $file->getClientOriginalExtension();
	    $file->move(public_path() . '/files/', $fileName);
	    return '/files/' . $fileName;
	}

	protected function processFile($name, $title, $request)
	{

		

		if ($request->hasFile($name))
		{			
		//	dd($request);
			if ($request->file($name)->isValid())
			{
			    $file = $request->file($name);
			    return $this->moveFile($file, $title);		   
			}
		}
	}

	protected function createDataArray($request) {

		$title = $request->get('title');
		$data = $request->all();

		$brochure_link = $this->processFile('brochure', $title, $request);
		$specifications_link = $this->processFile('specifications', $title, $request);
		$image_path = $this->processFile('image_path', $title, $request);

		if(isset($brochure_link)) $data['brochure_link'] = $brochure_link;
		if(isset($specifications_link)) $data['specifications_link'] = $specifications_link;
		if(isset($image_path)) $data['image_path'] = $image_path;

		return $data;
	}

	public function cleanInput($input)
	{
		return preg_replace('@[\'"/\\<>;\r\n- ]@', '', $input);
	}

}
