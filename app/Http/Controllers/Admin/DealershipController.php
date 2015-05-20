<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dealership;
use Datatables;
use App\CBR\Helpers;
use App\Http\Requests\DealershipRequest;
use View;

class DealershipController extends Controller {

		public function index()
	{
		return view('admin.dealerships.index')->with('title', 'Dealerships');
	}

	public function create()
	{
		return view('admin.dealerships.create');
	}

	public function store(DealershipRequest $request)
	{		
		$data = Helpers::createDataArray($request, 'dealerships');
		Dealership::create($data);
 		return redirect()->route('admin.dealerships.index')->with('message', 'Dealership created');
	}

	public function edit(Dealership $dealership)		
	{
		return View::make('admin.dealerships.edit')->with('dealership', $dealership);
	}

	public function update(Dealership $dealership, DealershipRequest $request)
	{
		$data = Helpers::createDataArray($request, 'dealerships');
		// dd($request);
		$dealership->update($data);
		return redirect()->route('admin.dealerships.edit', $dealership->id)->with('message', 'Dealership updated');
	}

	public function destroy(Dealership $dealership)
	{
		$dealership->delete();
		return redirect()->route('admin.dealerships.index')->with('message', 'Dealership deleted');
	}

	public function all()
	{
		$dealerships = Dealership::select(['id', 'name', 'coynumber']);
	
	    return Datatables::of($dealerships)
	        ->addColumn('edit', '<a href="/admin/dealerships/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i></a>')
	        ->addColumn('delete', '<form method="POST" action="/admin/dealerships/{{$id}}" id="deleteForm{{$id}}" onsubmit="return confirm(\'Are you sure you want to delete this category?\');">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->make(true);

	}

}
