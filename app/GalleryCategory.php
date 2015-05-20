<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model {

	protected $table = 'nissan_gallery_categories';
	protected $fillable = ['car_id', 'type', 'image_path', 'title', 'description'];

	public function car()
	{
		return $this->belongsTo('App\Car');
	}

	public function features()
	{
		return $this->hasMany('App\GalleryFeature', 'category_id');
	}

}
