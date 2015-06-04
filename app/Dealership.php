<?php namespace App;

use Illuminate\Database\Eloquent\Model;
//use Promotion;

class Dealership extends Model {

	protected $table = 'nissan_dealerships';
	protected $fillable = ['name', 'address', 'longitude', 'latitude', 'tel', 'fax', 'hours', 'blurb', 'image_path', 'coynumber',
							'emails_new', 'emails_demo', 'emails_preowned', 'emails_specials', 'emails_service', 'emails_parts',
							'emails_test_drive', 'emails_general_enquiries', 'emails_dealer_principal', 'emails_promotions'];

	public function promotions()
	{
		return $this->hasMany('App\Promotion')->where('nissan_promotions.published' , '=', 1)
												->where('nissan_promotions.expiry_date', '>=', date('Y-m-d'))
												->orderBy('nissan_promotions.order', 'asc')
												->take(3);
	}

	public static function getIdByCoy($coy)
	{
		return Dealership::where('coynumber', '=', $coy)->pluck('id');
	}

	public static function getCoyById($id)
	{
		return Dealership::where('id', '=', $id)->pluck('coynumber');
	}

	public static function getNameById($id)
	{
		return Dealership::where('id', '=', $id)->pluck('name');
	}

	public static function getNameByCoy($coy)
	{
		return Dealership::where('coynumber', '=', $coy)->pluck('name');
	}

	public static function getEmails($dealer_id, $column)
	{
		return Dealership::where('id', '=', $dealer_id)->pluck($column);
	}

	public static function getDealershipByCoy($coy)
	{
		return Dealership::where('coynumber', '=', $coy)->first();
	}

}
