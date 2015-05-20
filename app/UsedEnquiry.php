<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedEnquiry extends Model {

	protected $table = 'nissan_used_enquiries';
	protected $fillable = ['dealership_id', 'vid', 'firstname', 'surname', 'email', 'tel', 'enquiry_type'];


}
