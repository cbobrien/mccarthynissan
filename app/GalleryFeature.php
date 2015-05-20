<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryFeature extends Model {

	protected $table = 'nissan_gallery_features';
	protected $fillable = ['car_id', 'category_id', 'type', 'image_path', 'title', 'description'];

	public function car()
	{
		return $this->belongsTo('App\Car');
	}

	public function category()
	{
		return $this->belongsTo('App\GalleryCategory');
	}

}
