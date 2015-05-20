<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model {

	protected $table = 'nissan_parts';
	protected $fillable = ['dealership_id', 'firstname', 'surname', 'email', 'tel', 'make', 'model', 'series', 'year', 'parts_info', 'contact_time'];
}
