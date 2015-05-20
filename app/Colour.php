<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Colour extends Model {

	protected $table = "nissan_new_car_colours";
	protected $fillable = ["car_id", "colour", "colour_code", "image_path"];
	
}
