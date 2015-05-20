<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryCategoryRequest;
use App\CBR\Helpers;
use Datatables;
use App\Car;
use App\GalleryCategory;
use View;

class GalleryCategoriesController extends Controller {

	//protected $types = ['Exterior' => 'Exterior', 'Interior' => 'Interior'];

	public function index()
	{
		return view('admin.gallery_categories.index')->with('title', 'Gallery Categories');
	}

	public function create()
	{
		$cars = Car::lists('title', 'id');
		return view('admin.gallery_categories.create', compact('cars'))->with('types', Helpers::$types);
	}

	public function store(GalleryCategoryRequest $request)
	{		
		$data = Helpers::createDataArray($request, 'gallery_categories');
		GalleryCategory::create($data);
 		return redirect()->route('admin.gallery-categories.index')->with('message', 'Gallery category created');
	}

	public function edit(GalleryCategory $gallery_category)		
	{
		$cars = Car::lists('title', 'id');
		return View::make('admin.gallery_categories.edit')->with('gallery_category', $gallery_category)->with('cars', $cars)->with('types', Helpers::$types);
	}

	public function update(GalleryCategory $gallery_category, GalleryCategoryRequest $request)
	{
		$data = Helpers::createDataArray($request, 'gallery_categories');
		$gallery_category->update($data);
		return redirect()->route('admin.gallery-categories.edit', $gallery_category->id)->with('message', 'Gallery category updated');
	}

	public function destroy(GalleryCategory $gallery_category)
	{
		$gallery_category->delete();
		return redirect()->route('admin.gallery-categories.index')->with('message', 'Gallery category deleted');
	}

	public function all()
	{
		$gallery_categories = GalleryCategory::join('nissan_new_cars', 'nissan_gallery_categories.car_id', '=', 'nissan_new_cars.id')
					->select(['nissan_gallery_categories.id as id', 'nissan_gallery_categories.title as title',							 
							  'nissan_gallery_categories.type as type', 'nissan_gallery_categories.created_at as created_at',
							  'nissan_new_cars.title as car_title']);		

	    return Datatables::of($gallery_categories)	       
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/gallery-categories/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	       	->editColumn('title','<a href="/admin/gallery-categories/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i> {{ $title }}</a>')
	        ->make(true);
	}

}
