<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use Datatables;
use App\Service;
use App\Dealership;
use DB;


class ServicesController extends Controller {

	public function index()
	{
		return view('admin.services.index')->with('title', 'Service Enquiries');
	}

	
	public function show(Service $enquiry)
	{
		// dd($enquiry);
		$dealership = Dealership::getNameById($enquiry->dealership_id);
		// dd($enquiry);
		return view('admin.services.view')->with(['enquiry' => $enquiry, 'dealership' => $dealership]);
	}
	
	public function destroy(Service $service)
	{
		$service->delete();
		return redirect()->route('admin.services.index')->with('message', 'Service enquiry deleted');
	}

	public function all() {
		$parts = Service::join('nissan_dealerships', 'nissan_services.dealership_id', '=', 'nissan_dealerships.id')
					->select(['nissan_services.id as id', 'nissan_services.email as email',
							 'nissan_services.created_at as created_at',
							  DB::raw('CONCAT(nissan_services.firstname, " ", nissan_services.surname) AS name'),
							  'nissan_dealerships.name as dealership'])
					->orderBy('nissan_services.created_at', 'desc');;		

	    return Datatables::of($parts)	       
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/services/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->editColumn('name','<a href="/admin/services/{{$id}}"><i class="fa fa-eye"></i> {{ $name }}</i></i></a>')
	       	->editColumn('email','<a href="mailto:{{ $email }}">{{ $email }}</a>')
	        ->make(true);

	}

}
