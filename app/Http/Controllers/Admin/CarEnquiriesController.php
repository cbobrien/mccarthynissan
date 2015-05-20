<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CarEnquiryRequest;
use Datatables;
use App\CarEnquiry;
use DB;
use App\Dealership;
use App\Car;
use App\CarVersion;


class CarEnquiriesController extends Controller {

	public function index()
	{
		return view('admin.enquiries_cars.index')->with('title', 'New Car Enquiries');
	}

	public function show(CarEnquiry $enquiry)
	{
		$dealership = Dealership::getNameById($enquiry->dealership_id);
		$car = Car::getNameById($enquiry->car_id);
		$version = CarVersion::getNameById($enquiry->version_id);
		return view('admin.enquiries_cars.view')->with(['enquiry' => $enquiry, 'dealership' => $dealership, 'car' => $car, 'version' => $version]);
	}

	public function destroy(CarEnquiry $enquiry)
	{
		$enquiry->delete();
		return redirect()->route('admin.car-enquiries.index')->with('message', 'New Car enquiry deleted');
	}

	public function all() {
		$enquiries = CarEnquiry::join('nissan_dealerships', 'nissan_car_enquiries.dealership_id', '=', 'nissan_dealerships.id')
					->join('nissan_new_cars', 'nissan_car_enquiries.dealership_id', '=', 'nissan_new_cars.id')
					->select(['nissan_car_enquiries.id as id',
							   DB::raw('CONCAT(nissan_car_enquiries.firstname, " ", nissan_car_enquiries.surname) AS name'),
							   'nissan_car_enquiries.created_at as created_at',  'nissan_dealerships.name as dealership'])
					->orderBy('nissan_car_enquiries.created_at', 'desc');		

	    return Datatables::of($enquiries)	   
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/car-enquiries/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	       ->editColumn('name','<a href="/admin/car-enquiries/{{$id}}"><i class="fa fa-eye"></i> {{ $name }}</i></i></a>')
	        ->make(true);
	}


}
