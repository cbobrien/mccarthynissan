<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralEnquiryRequest;
use App\Http\Requests\PartRequest;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\TestDriveRequest;
use App\Http\Requests\CarEnquiryRequest;
use App\Http\Requests\UsedEnquiryRequest;
use App\Http\Requests\SpecialEnquiryRequest;
use App\Http\Requests\PromotionEnquiryRequest;
use Illuminate\Http\Request;
use App\GeneralEnquiry;
use App\Part;
use App\Service;
use App\TestDrive;
use App\CarEnquiry;
use App\UsedEnquiry;
use App\SpecialEnquiry;
use App\PromotionEnquiry;
use App\Dealership;
use App\Car;
use App\Used;
use App\CarVersion;
use App\Special;
use Carbon;
use App\CBR\Helpers;
use App\Promotion;

class FormsController extends Controller {

	public function contact(GeneralEnquiryRequest $request)
	{

		GeneralEnquiry::create($request->all());

		$dealer = Dealership::getNameById($request->dealership_id);
		$firstname = trim($request->firstname);
		$surname = trim($request->surname);
		$email = trim($request->email);
		$tel = trim($request->tel);
		$message_body = trim($request->message);
		$date = date('d F Y');
		$time = date('G:i');

		$admin_to = Dealership::getEmails($request->dealership_id, 'emails_dealer_principal');
		$admin_cc = Dealership::getEmails($request->dealership_id, 'emails_general_enquiries');

		if (trim($admin_to) == '')	
			dd('The to address cannot be empty.');

		$data = ['dealer' => $dealer, 'firstname' => $firstname, 'surname' => $surname,
				'email' => $email, 'tel' => $tel, 'message_body' => $message_body, 'date' => $date, 'time' => $time,
				'admin_to' => $admin_to, 'admin_cc' => $admin_cc, 'subject' => 'General Enquiry'];

		Helpers::sendMail($data, 'general_enquiries');
		return response()->json(['message' => 'success']);
	}

	public function parts(PartRequest $request)
	{
		Part::create($request->all());

		$data = ['dealership' => Dealership::getNameById($request->dealership_id), 
				 'firstname' => trim($request->firstname), 
				 'surname' => trim($request->surname),
				 'email' => trim($request->email), 
				 'tel' => trim($request->tel), 			
				 'date' => date('d F Y'), 
				 'time' => date('G:i'),
				 'make' => trim($request->make),
				 'model' => trim($request->model),
				 'series' => trim($request->series),
				 'year' => trim($request->year),
				 'parts_info' => trim($request->parts_info),
				 'contact_time' => trim($request->contact_time),
				 'admin_to' => Dealership::getEmails($request->dealership_id, 'emails_dealer_principal'), 
				 'admin_cc' => Dealership::getEmails($request->dealership_id, 'emails_parts'), 
				 'subject' => 'Parts Enquiry'];

		if (trim($data['admin_to']) == '')
			dd('The to address cannot be empty.');

		Helpers::sendMail($data, 'parts');

		return response()->json(['message' => 'success']);
	}

	public function service(ServiceRequest $request)
	{		
		Service::create($request->all());

		$data = ['dealership' => Dealership::getNameById($request->dealership_id), 
				 'firstname' => trim($request->firstname), 
				 'surname' => trim($request->surname),
				 'email' => trim($request->email), 
				 'tel' => trim($request->tel), 			
				 'date' => date('d F Y'), 
				 'time' => date('G:i'),
				 'make' => trim($request->make),
				 'model' => trim($request->model),
				 'series' => trim($request->series),
				 'year' => trim($request->year),
				 'work_required' => trim($request->work_required),
				 'registration' => trim($request->registration),
				 'odometer' => trim($request->odometer),
				 'service_date' => Carbon::parse(trim($request->date))->format('d-m-Y'),
				 'contact_time' => trim($request->contact_time),
				 'admin_to' => Dealership::getEmails($request->dealership_id, 'emails_dealer_principal'), 
				 'admin_cc' => Dealership::getEmails($request->dealership_id, 'emails_service'), 
				 'subject' => 'Service Enquiry'];

		if (trim($data['admin_to']) == '')
			dd('The to address cannot be empty.');

		Helpers::sendMail($data, 'services');
		return response()->json(['message' => 'success']);
	}

	public function testDrive(TestDriveRequest $request)
	{	

		TestDrive::create($request->all());		

		$data = ['dealership' => Dealership::getNameById($request->dealership_id),
				 'car' => Car::getNameById($request->car_id),
				 'version' => CarVersion::getNameById($request->version_id),
				 'firstname' => trim($request->firstname), 
				 'surname' => trim($request->surname),
				 'email' => trim($request->email), 
				 'tel' => trim($request->tel), 			
				 'date' => date('d F Y'), 
				 'time' => date('G:i'),							
				 'test_drive_date' => Carbon::parse(trim($request->test_drive_date))->format('d-m-Y'),
				 'contact_time' => trim($request->contact_time),
				 'admin_to' => Dealership::getEmails($request->dealership_id, 'emails_dealer_principal'), 
				 'admin_cc' => Dealership::getEmails($request->dealership_id, 'emails_test_drive'), 
				 'subject' => 'Test Drive Enquiry'];

		if (trim($data['admin_to']) == '')
			dd('The to address cannot be empty.');

		Helpers::sendMail($data, 'test-drives');
		return response()->json(['message' => 'success']);
	}

	public function enquire(CarEnquiryRequest $request)
	{	
		// dd($request);
		CarEnquiry::create($request->all());

		$data = ['dealership' => Dealership::getNameById($request->dealership_id),
				 'car' => Car::getNameById($request->car_id),
				 'version' => CarVersion::getNameById($request->version_id),
				 'firstname' => trim($request->firstname), 
				 'surname' => trim($request->surname),
				 'email' => trim($request->email), 
				 'tel' => trim($request->tel), 			
				 'date' => date('d F Y'), 
				 'time' => date('G:i'),							
				 'message' => trim($request->message),
				 'admin_to' => Dealership::getEmails($request->dealership_id, 'emails_dealer_principal'), 
				 'admin_cc' => Dealership::getEmails($request->dealership_id, 'emails_new'), 
				 'subject' => 'New Car Enquiry'];

		if (trim($data['admin_to']) == '')
			dd('The to address cannot be empty.');

		Helpers::sendMail($data, 'new-car');

		return response()->json(['message' => 'success']);
	}

	public function vehicleEnquiry(UsedEnquiryRequest $request)
	{	
		UsedEnquiry::create($request->all());

		if($request->enquiry_type == 'demo') {
			$admin_cc = 'emails_demo';
		}
		else {
			$admin_cc = 'emails_preowned';
		}

		$data = ['dealership' => Dealership::getNameById($request->dealership_id),
				 'car' => Used::getNameById($request->vid),
				 'firstname' => trim($request->firstname), 
				 'surname' => trim($request->surname),
				 'email' => trim($request->email), 
				 'tel' => trim($request->tel),
				 'type' => ucfirst($request->enquiry_type),		
				 'date' => date('d F Y'), 
				 'time' => date('G:i'),				 
				 'admin_to' => Dealership::getEmails($request->dealership_id, 'emails_dealer_principal'), 
				 'admin_cc' => Dealership::getEmails($request->dealership_id, $admin_cc), 
				 'subject' => ucfirst($request->enquiry_type) . ' Car Enquiry'];

		if (trim($data['admin_to']) == '')
			dd('The to address cannot be empty.');

		Helpers::sendMail($data, 'used');

		return response()->json(['message' => 'success']);
	}

	public function specialEnquiry(SpecialEnquiryRequest $request)
	{	
		
		SpecialEnquiry::create($request->all());

		$coy = Special::getCoyById($request->special_id);	
		$dealership = Dealership::getDealershipByCoy($coy);

		$data = ['dealership' => $dealership->name,
				 'special' => Special::getTitleById($request->special_id),
				 'firstname' => trim($request->firstname), 
				 'surname' => trim($request->surname),
				 'email' => trim($request->email), 
				 'tel' => trim($request->tel),				
				 'date' => date('d F Y'), 
				 'time' => date('G:i'),				 
				 'admin_to' => Dealership::getEmails($dealership->id, 'emails_dealer_principal'), 
				 'admin_cc' => Dealership::getEmails($dealership->id, 'emails_specials'), 
				 'subject' => 'Special Enquiry'];

		if (trim($data['admin_to']) == '')
			dd('The to address cannot be empty.');

		Helpers::sendMail($data, 'special');

		return response()->json(['message' => 'success']);
	}

	public function promotionEnquiry(PromotionEnquiryRequest $request)
	{	
		PromotionEnquiry::create($request->all());

		// $dealership_id = Promotion::getDealerIdById($request->promotion_id);
		
		$dealership = Dealership::getNameById($request->dealership_id);
		// dd($dealership);

		$data = ['dealership' => $dealership,
				 'promotion' => Promotion::getNameById($request->promotion_id),
				 'firstname' => trim($request->firstname), 
				 'surname' => trim($request->surname),
				 'email' => trim($request->email), 
				 'tel' => trim($request->tel),				 
				 'date' => date('d F Y'), 
				 'time' => date('G:i'),				 
				 'admin_to' => Dealership::getEmails($request->dealership_id, 'emails_dealer_principal'), 
				 'admin_cc' => Dealership::getEmails($request->dealership_id, 'emails_promotions'), 
				 'subject' => 'Promtion Enquiry'];

		if (trim($data['admin_to']) == '')
			dd('The to address cannot be empty.');

		Helpers::sendMail($data, 'promotion');

		return response()->json(['message' => 'success']);
	}

}
