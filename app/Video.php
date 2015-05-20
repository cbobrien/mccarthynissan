<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

	protected $table = 'nissan_new_car_videos';
	protected $fillable = ['car_id', 'video_link'];

	function car() {
		return $this->belongsTo('App\Car');
	}

}
