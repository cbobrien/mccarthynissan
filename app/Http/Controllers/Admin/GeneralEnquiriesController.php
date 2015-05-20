<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GeneralEnquiryRequest;
use Datatables;
use App\GeneralEnquiry;
use App\Dealership;
use DB;

class GeneralEnquiriesController extends Controller {

	public function index()
	{
		return view('admin.enquiries_general.index')->with('title', 'General Enquiries');
	}

	public function show(GeneralEnquiry $enquiry)
	{
		$dealership = Dealership::getNameById($enquiry->dealership_id);
		return view('admin.enquiries_general.view')->with(['enquiry' => $enquiry, 'dealership' => $dealership]);
	}

	public function destroy(GeneralEnquiry $enquiry)
	{
		$enquiry->delete();
		return redirect()->route('admin.enquiries.index')->with('message', 'Enquiry deleted');
	}

	public function all() {
		$enquiries = GeneralEnquiry::join('nissan_dealerships', 'nissan_general_enquiries.dealership_id', '=', 'nissan_dealerships.id')
					->select(['nissan_general_enquiries.id as id', 'nissan_general_enquiries.email as email',
							  'nissan_general_enquiries.tel as tel', 'nissan_general_enquiries.created_at as created_at',
							  'nissan_dealerships.name as dealership',
							  DB::raw('CONCAT(nissan_general_enquiries.firstname, " ", nissan_general_enquiries.surname) AS name')])
					->orderBy('nissan_general_enquiries.created_at', 'desc');		

	    return Datatables::of($enquiries)
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/enquiries/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->editColumn('name','<a href="/admin/enquiries/{{$id}}"><i class="fa fa-eye"></i> {{ $name }}</a>')
	       	->editColumn('email','<a href="mailto:{{ $email }}">{{ $email }}</a>')
	        ->make(true);
	}

}
