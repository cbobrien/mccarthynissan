<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PartRequest;
use Datatables;
use App\Part;
use App\Dealership;
use DB;

class PartsController extends Controller {

	public function index()
	{
		return view('admin.parts.index')->with('title', 'Parts Enquiries');
	}

	
	public function show(Part $enquiry)
	{
		$dealership = Dealership::getNameById($enquiry->dealership_id);
		return view('admin.parts.view')->with(['enquiry' => $enquiry, 'dealership' => $dealership]);
	}

	
	public function destroy(Part $part)
	{
		$part->delete();
		return redirect()->route('admin.parts.index')->with('message', 'Parts enquiry deleted');
	}

	public function all() {
		$parts = Part::join('nissan_dealerships', 'nissan_parts.dealership_id', '=', 'nissan_dealerships.id')
					->select(['nissan_parts.id as id', 'nissan_parts.email as email',
							  'nissan_parts.tel as tel', 'nissan_parts.created_at as created_at',
							  DB::raw('CONCAT(nissan_parts.firstname, " ", nissan_parts.surname) AS name'),
							  'nissan_dealerships.name as dealership'])
					->orderBy('nissan_parts.created_at', 'desc');		

	    return Datatables::of($parts)	       
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/parts/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->editColumn('name','<a href="/admin/parts/{{$id}}"><i class="fa fa-eye"></i> {{ $name }}</i></i></a>')
	       	->editColumn('email','<a href="mailto:{{ $email }}">{{ $email }}</a>')
	        ->make(true);
	}

}
