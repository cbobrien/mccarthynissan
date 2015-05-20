<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model {

	protected $table = 'nissan_new_cars';
	protected $fillable = ['category_id' , 'title', 'description', 'brochure_link', 'specifications_link', 'image_path'];

	// public function getLowestVersionPrice() {
	// 	return $this->hasMany('App\CarVersion')->min('price');
	// }

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function versions()
	{
		return $this->hasMany('App\CarVersion')->orderBy('price');
	}

	public function colours()
	{
		return $this->hasMany('App\Colour');
	}

	public function galleries()
	{
		return $this->hasMany('App\Gallery');
	}

	public function galleryCategories()
	{
		return $this->hasMany('App\GalleryCategory');
	}

	public function galleryFeatures()
	{
		return $this->hasMany('App\GalleryFeature');
	}

	public function videos()
	{
		return $this->hasMany('App\Video');
	}

	public function getPriceAttribute($value)
	{
		return number_format($value);
	}

	public static function getNameById($id)
	{		
		return Car::where('id', '=', $id)->pluck('title');
	}


}
