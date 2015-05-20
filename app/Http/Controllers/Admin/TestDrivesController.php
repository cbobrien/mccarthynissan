<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TestDriveRequest;
use Datatables;
use App\TestDrive;
use DB;
use Carbon;
use App\Dealership;
use App\Car;
use App\CarVersion;

class TestDrivesController extends Controller {

	public function index()
	{
		return view('admin.test-drives.index')->with('title', 'Test Drive Enquiries');
	}
	
	public function show(TestDrive $enquiry)
	{

		$dealership = Dealership::getNameById($enquiry->dealership_id);
		$car = Car::getNameById($enquiry->car_id);
		$version = CarVersion::getNameById($enquiry->version_id);
		return view('admin.test-drives.view')->with(['enquiry' => $enquiry, 'dealership' => $dealership, 'car' => $car, 'version' => $version]);
	}
	
	public function destroy(TestDrive $testdrive)
	{
		$testdrive->delete();
		return redirect()->route('admin.test-drives.index')->with('message', 'Test drive enquiry deleted');
	}

	public function all() {
		$testdrives = TestDrive::join('nissan_dealerships', 'nissan_test_drives.dealership_id', '=', 'nissan_dealerships.id')
						->join('nissan_new_cars', 'nissan_test_drives.car_id', '=', 'nissan_new_cars.id')						
						->select(['nissan_test_drives.id as id',
								  DB::raw('CONCAT(nissan_test_drives.firstname, " ", nissan_test_drives.surname) AS name'),
							     'nissan_test_drives.created_at as created_at','nissan_test_drives.test_drive_date as test_drive_date',
							     'nissan_dealerships.name as dealership'])
						->orderBy('nissan_test_drives.created_at', 'desc');

	    return Datatables::of($testdrives)
	        ->addColumn('view', '<a href="/admin/test-drives/{{$id}}/show"><i class="fa fa-pencil-square-o"></i></a>')
	        ->addColumn('delete',
	        			'<form method="POST" action="/admin/test-drives/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	     	->editColumn('name','<a href="/admin/test-drives/{{$id}}"><i class="fa fa-eye"></i> {{ $name }}</i></i></a>')
	       //	->editColumn('test_drive_date', )
	        ->make(true);
	}

}
