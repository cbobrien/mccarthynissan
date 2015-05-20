<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralEnquiry extends Model {

	protected $table = 'nissan_general_enquiries';
	protected $fillable = ['dealership_id', 'firstname', 'surname', 'email', 'tel', 'message'];
	
}
