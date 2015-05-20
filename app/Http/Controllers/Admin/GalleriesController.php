<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\CBR\Helpers;
use Datatables;
use App\Car;
use App\Gallery;
use View;

class GalleriesController extends Controller {

	protected $types = ['Exterior' => 'Exterior', 'Interior' => 'Interior'];

	public function index()
	{
		return view('admin.galleries.index')->with('title', 'Galleries');
	}

	public function create()
	{
		$cars = Car::lists('title', 'id');
		return view('admin.galleries.create', compact('cars'))->with('types', $this->types);
	}

	public function store(GalleryRequest $request)
	{		
		$data = Helpers::createDataArray($request, 'galleries');
		Gallery::create($data);
 		return redirect()->route('admin.galleries.index')->with('message', 'Image created');
	}

	public function edit(Gallery $gallery)		
	{
		$cars = Car::lists('title', 'id');
		return View::make('admin.galleries.edit')->with('gallery', $gallery)->with('cars', $cars)->with('types', $this->types);
	}

	public function update(Gallery $gallery, GalleryRequest $request)
	{
		$data = Helpers::createDataArray($request, 'galleries');
		$gallery->update($data);
		return redirect()->route('admin.galleries.edit', $gallery->id)->with('message', 'Image updated');
	}

	public function destroy(Gallery $gallery)
	{
		$gallery->delete();
		return redirect()->route('admin.galleries.index')->with('message', 'Image deleted');
	}

	public function all()
	{
		$galleries = Gallery::join('nissan_new_cars', 'nissan_galleries.car_id', '=', 'nissan_new_cars.id')
					->select(['nissan_galleries.id as id', 'nissan_galleries.image_path as image_path',
							  'nissan_galleries.type as type', 'nissan_galleries.created_at as created_at',
							  'nissan_new_cars.title as title']);		

	    return Datatables::of($galleries)
	        ->addColumn('edit', '<a href="/admin/galleries/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i></a>')
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/galleries/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	       	->editColumn('image_path','<img src="{{ $image_path }}" style="max-width:300px">')
	        ->make(true);
	}

}
