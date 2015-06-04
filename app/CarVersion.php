<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CarVersion extends Model {

	protected $table = 'nissan_new_car_versions';
	protected $fillable = ['car_id', 'title', 'price', 'features_1', 'features_2'];

	public function car()
	{
		return $this->belongsTo('App\Car');
	}

	// public function getPriceAttribute($value)
	// {
	// 	return number_format($value);
	// }


	public static function getNameById($id)
	{		
		return CarVersion::where('id', '=', $id)->pluck('title');
	}

}
