<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\CBR\Helpers;
use Datatables;
use App\Car;
use App\Video;
use View;

class VideosController extends Controller {

	public function index()
	{
		return view('admin.videos.index')->with('title', 'Videos');
	}

	public function create()
	{
		$cars = Car::lists('title', 'id');
		return view('admin.videos.create', compact('cars'));
	}

	public function store(VideoRequest $request)
	{
		Video::create($request->all());
 		return redirect()->route('admin.videos.index')->with('message', 'Video created');
	}

	public function edit(Video $video)		
	{
		$cars = Car::lists('title', 'id');
		return View::make('admin.videos.edit')->with('video', $video)->with('cars', $cars);
	}

	public function update(Video $video, VideoRequest $request)
	{
		$video->update($request->all());
		return redirect()->route('admin.videos.edit', $colour->id)->with('message', 'Video updated');
	}

	public function destroy(Video $colour)
	{
		$colour->delete();
		return redirect()->route('admin.videos.index')->with('message', 'Video deleted');
	}

	public function all()
	{
		$videos = Video::join('nissan_new_cars', 'nissan_new_car_videos.car_id', '=', 'nissan_new_cars.id')
					->select(['nissan_new_car_videos.id as id', 'nissan_new_car_videos.video_link as video_link',
							  'nissan_new_car_videos.created_at as created_at', 'nissan_new_cars.title as title']);		

	    return Datatables::of($videos)
	        ->addColumn('edit', '<a href="/admin/videos/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i></a>')
	        ->addColumn('delete', '<form method="POST" action="/admin/videos/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	       	->editColumn('video_link','<a href="{{ $video_link }}" target="_blank">{{ $video_link }}</a>')
	        ->make(true);
	}


}
