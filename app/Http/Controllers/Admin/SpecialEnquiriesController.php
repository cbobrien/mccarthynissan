<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SpecialEnquiryRequest;
use Datatables;
use App\SpecialEnquiry;
use DB;
use App\Dealership;
use App\Used;
use App\Special;

class SpecialEnquiriesController extends Controller {

	public function index()
	{
		return view('admin.enquiries_specials.index')->with('title', 'Special Enquiries');
	}

	public function show(SpecialEnquiry $enquiry)
	{
		$coy = Special::getCoyById($enquiry->special_id);	
		$dealership = Dealership::getNameByCoy($coy);	
		$special = Special::getTitleById($enquiry->special_id);	
		return view('admin.enquiries_specials.view')->with(['enquiry' => $enquiry, 'dealership' => $dealership, 'special' => $special]);
	}

	public function destroy(SpecialEnquiry $enquiry)
	{
		$enquiry->delete();
		return redirect()->route('admin.enquiries-specials.index')->with('message', 'Special enquiry deleted');
	}

	public function all() {
		$enquiries = SpecialEnquiry::join('specials', 'nissan_special_enquiries.special_id', '=', 'specials.specialid')
					->join('nissan_dealerships', 'specials.dealercoynumber', '=', 'nissan_dealerships.coynumber')				
					->select(['nissan_special_enquiries.id as id', 
							  DB::raw('CONCAT(nissan_special_enquiries.firstname, " ", nissan_special_enquiries.surname) AS name'),
							  'nissan_special_enquiries.created_at as created_at',
							  'nissan_dealerships.name as dealership_name'])
					->orderBy('nissan_special_enquiries.created_at', 'desc');		

	    return Datatables::of($enquiries)
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/special-enquiries/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	      	->editColumn('name','<a href="/admin/special-enquiries/{{$id}}"><i class="fa fa-eye"></i> {{ $name }}</i></i></a>')
	        ->make(true);
	}

}
