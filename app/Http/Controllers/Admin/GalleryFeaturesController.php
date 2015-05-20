<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryFeatureRequest;
use App\CBR\Helpers;
use Datatables;
use App\Car;
use App\GalleryCategory;
use App\GalleryFeature;
use View;
use DB;


class GalleryFeaturesController extends Controller {

	public function index()
	{
		return view('admin.gallery_features.index')->with('title', 'Gallery Features');
	}

	public function create()
	{
		$cars = Car::lists('title', 'id');
		return view('admin.gallery_features.create', compact('cars'))->with('types', Helpers::$types);
	}

	public function store(GalleryFeatureRequest $request)
	{		
		$data = Helpers::createDataArray($request, 'gallery_features');
		GalleryFeature::create($data);
 		return redirect()->route('admin.gallery-features.index')->with('message', 'Gallery feature created');
	}

	public function edit(GalleryFeature $gallery_feature)		
	{
		$cars = Car::lists('title', 'id');
		$categories = DB::table('nissan_gallery_categories')->where('car_id', $gallery_feature->car_id)->lists('title', 'id');
		return View::make('admin.gallery_features.edit')
						->with('gallery_feature', $gallery_feature)
						->with('cars', $cars)
						->with('categories', $categories)
						->with('types', Helpers::$types);
	}

	public function update(GalleryFeature $gallery_feature, GalleryFeatureRequest $request)
	{
		$data = Helpers::createDataArray($request, 'gallery_features');
		$gallery_feature->update($data);
		return redirect()->route('admin.gallery-features.edit', $gallery_feature->id)->with('message', 'Gallery feature updated');
	}

	public function destroy(GalleryFeature $gallery_feature)
	{
		$gallery_feature->delete();
		return redirect()->route('admin.gallery-features.index')->with('message', 'Gallery feature deleted');
	}

	public function all()
	{
		$gallery_features = GalleryFeature::join('nissan_new_cars', 'nissan_gallery_features.car_id', '=', 'nissan_new_cars.id')
					->join('nissan_gallery_categories', 'nissan_gallery_features.category_id', '=', 'nissan_gallery_categories.id')
					->select(['nissan_gallery_features.id as id', 'nissan_gallery_features.title as title',
							  'nissan_gallery_categories.title as category_title', 'nissan_gallery_features.created_at as created_at',
							  'nissan_new_cars.title as car_title']);		

	    return Datatables::of($gallery_features)	   
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/gallery-features/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->editColumn('title','<a href="/admin/gallery-features/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i> {{ $title }}</a>')
	        ->make(true);
	}

	public function get_categories_by_car($car_id) {
		$categories = DB::table('nissan_gallery_categories')->where('car_id', $car_id)->lists('title', 'id');
		return $categories;
	}

}
