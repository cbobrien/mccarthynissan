<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionEnquiry extends Model {

	protected $table = 'nissan_promotion_enquiries';
	protected $fillable = ['promotion_id', 'dealership_id', 'firstname', 'surname', 'email', 'tel', 'message'];

}
