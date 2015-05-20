<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialEnquiry extends Model {

	protected $table = 'nissan_special_enquiries';
	protected $fillable = ['special_id', 'firstname', 'surname', 'email', 'tel'];

}
