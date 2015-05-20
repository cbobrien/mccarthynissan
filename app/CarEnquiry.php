<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CarEnquiry extends Model {

	protected $table = 'nissan_car_enquiries';
	protected $fillable = ['dealership_id', 'car_id', 'version_id', 'firstname', 'surname', 'email', 'tel', 'message', 'contact_time'];

}
