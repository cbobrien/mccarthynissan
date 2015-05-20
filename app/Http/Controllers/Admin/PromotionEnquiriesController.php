<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PromotionEnquiryRequest;
use Datatables;
use App\PromotionEnquiry;
use App\Dealership;
use App\Promotion;
use DB;

class PromotionEnquiriesController extends Controller {

	public function index()
	{
		return view('admin.enquiries_promotions.index')->with('title', 'Promotion Enquiries');
	}

	public function show(PromotionEnquiry $enquiry)
	{
		$dealership_id = Promotion::getDealerIdById($enquiry->promotion_id);
		$dealership = Dealership::getNameById($dealership_id);
		$promotion = Promotion::getNameById($enquiry->promotion_id);	
		return view('admin.enquiries_promotions.view')->with(['enquiry' => $enquiry, 'dealership' => $dealership, 'promotion' => $promotion]);
	}

	public function destroy(PromotionEnquiry $enquiry)
	{
		$enquiry->delete();
		return redirect()->route('admin.promotion-enquiries.index')->with('message', 'Promotion enquiry deleted');
	}

	public function all() {
		$enquiries = PromotionEnquiry::join('nissan_promotions', 'nissan_promotion_enquiries.promotion_id', '=', 'nissan_promotions.id')
					->join('nissan_dealerships', 'nissan_promotions.dealership_id', '=', 'nissan_dealerships.id')				
					->select(['nissan_promotion_enquiries.id as id', 
							  DB::raw('CONCAT(nissan_promotion_enquiries.firstname, " ", nissan_promotion_enquiries.surname) AS name'),
									  'nissan_promotion_enquiries.created_at as created_at', 'nissan_dealerships.name as dealership'])
					->orderBy('nissan_promotion_enquiries.created_at', 'desc');		

	    return Datatables::of($enquiries)	       
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/promotion-enquiries/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	       ->editColumn('name','<a href="/admin/promotion-enquiries/{{$id}}"><i class="fa fa-eye"></i> {{ $name }}</i></i></a>')
	        ->make(true);
	}

}
