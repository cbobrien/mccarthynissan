<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UsedEnquiryRequest;
use Datatables;
use App\UsedEnquiry;
use App\Dealership;
use App\Car;
use App\Used;
use DB;

class UsedEnquiriesController extends Controller {

	public function index()
	{
		return view('admin.enquiries_used.index')->with('title', 'Used Car Enquiries');
	}

	public function show(UsedEnquiry $enquiry)
	{		
		$dealership = Dealership::getNameById($enquiry->dealership_id);	
		$car = Used::getNameById($enquiry->vid);	
		return view('admin.enquiries_used.view')->with(['enquiry' => $enquiry, 'dealership' => $dealership, 'car' => $car]);
	}

	public function destroy(UsedEnquiry $enquiry)
	{
		$enquiry->delete();
		return redirect()->route('admin.used-enquiries.index')->with('message', 'Used car enquiry deleted');
	}

	public function all() {
		$enquiries = UsedEnquiry::join('nissan_dealerships', 'nissan_used_enquiries.dealership_id', '=', 'nissan_dealerships.id')
					->join('used', 'nissan_used_enquiries.vid', '=', 'used.vid')				
					->select(['nissan_used_enquiries.id as id',
							  DB::raw('CONCAT(nissan_used_enquiries.firstname, " ", nissan_used_enquiries.surname) AS name'),
										'nissan_used_enquiries.enquiry_type as enquiry_type',
							 	 		'nissan_used_enquiries.created_at as created_at',
							  			'nissan_dealerships.name as dealership'])
					->orderBy('nissan_used_enquiries.created_at', 'desc');		

	    return Datatables::of($enquiries)	    
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/used-enquiries/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	       	->editColumn('name','<a href="/admin/used-enquiries/{{$id}}"><i class="fa fa-eye"></i> {{ $name }}</i></i></a>')
	        ->make(true);
	}

}
