<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'nissan_new_car_categories';
	protected $fillable = ['category'];

	public function cars()
	{
		return $this->hasMany('App\Car');
	}

}
