<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

	protected $table = 'nissan_galleries';
	protected $fillable = ['car_id', 'type', 'image_path'];

}
