<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Used extends Model {

	protected $table = 'used';

	public function getPrinclAttribute($value)
	{
		return number_format($value);
	}

	public function getPriceAttribute($value)
	{
		return number_format($value);
	}

	public static function cars($type = 'demos')
	{
		$cars = Used::where('mmbrand', 'NISSAN')
					->where('type', $type)
					->paginate(10);

		return $cars;
	}

	public static function getNameById($vid)
	{
		return Used::where('vid', $vid)->pluck('modeldesc');
	}

}
