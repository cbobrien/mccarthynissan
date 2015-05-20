<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Special extends Model {

	protected $table = "specials";

	protected static function currentSpecials($coynumber = null, $limit = null)
	{
		
		$query = Special::join('nissan_dealerships', 'specials.dealercoynumber', '=', 'nissan_dealerships.coynumber')
						->where('specials.brand', '=', 'NISSAN')						
						->where('specials.start' , '<=', date('Y-m-d'))
						->where('specials.end', '>=', date('Y-m-d'))
						->select(['specials.specialid as special_id', 'specials.start as start', 'specials.end as end',
								  'specials.title as title', 'specials.contentexcerpt as contentexcerpt', 'specials.content as content',
								  'specials.thumbnail as thumbnail',							  		
							  	  'nissan_dealerships.id as dealership_id']);
						// ->orderBy('specials.end', 'asc');

		if(isset($coynumber))
			$query = $query->where('specials.dealercoynumber', '=', $coynumber);

		if(isset($limit))
			$query = $query->take($limit);

		return $query->orderBy(DB::raw('RAND()'))->get();

	}

	public static function getTitleById($id)
	{
		return Special::where('specialid', '=', $id)->pluck('title');
	}

	public static function getCoyById($id)
	{
		return Special::where('specialid', '=', $id)->pluck('dealercoynumber');
	}

}
