<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model {
	
	protected $table = 'nissan_promotions';
	protected $fillable = ['dealership_id', 'name', 'published', 'image_path', 'order', 'expiry_date'];

	public function dealership()
	{
		return $this->belongsTo('App\Dealership');
	}

	public static function currentPromotions()
	{
		return Promotion::join('nissan_dealerships', 'nissan_promotions.dealership_id', '=', 'nissan_dealerships.id')
							 	->where('nissan_promotions.published' , '=', 1)
							 	->where('nissan_promotions.expiry_date', '>=', date('Y-m-d'))
							 	->select(['nissan_promotions.id as id', 'nissan_promotions.name as name',
										  'nissan_promotions.image_path as image_path', 'nissan_promotions.created_at as created_at',
										  'nissan_promotions.published as published', 'nissan_promotions.order as order',
										  'nissan_promotions.expiry_date as expiry_date',
										  'nissan_dealerships.name as dealership_name', 'nissan_dealerships.id as dealership_id'])
								->orderBy('expiry_date', 'asc')
							 	->get();
	}

	public static function getNameById($id)
	{
		return Promotion::where('id', $id)->pluck('name');
	}

	public static function getDealerIdById($id)
	{
		return Promotion::where('id', $id)->pluck('dealership_id');
	}
}

