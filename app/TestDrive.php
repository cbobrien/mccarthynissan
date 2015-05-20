<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class TestDrive extends Model {
	protected $table = 'nissan_test_drives';
	protected $fillable = ['dealership_id', 'car_id', 'version_id', 'firstname', 'surname', 'email', 'tel', 'test_drive_date', 'contact_time'];

	public function getTestDriveDateAttribute($value)
	{
		return Carbon::parse($value)->format('d-m-Y');
	}

	
}
