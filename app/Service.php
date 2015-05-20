<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Service extends Model {

	protected $table = 'nissan_services';
	protected $fillable = ['dealership_id', 'firstname', 'surname', 'email', 'tel', 'make', 'model', 'series', 'year', 'work_required', 'registration', 'odometer', 'date', 'contact_time'];

	public function getDateAttribute($value)
	{
		return Carbon::parse($value)->format('d-m-Y');
	}
}
