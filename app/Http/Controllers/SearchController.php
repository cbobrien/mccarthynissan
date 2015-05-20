<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Used;
use App\Car;
use App\Special;
use App\Dealership;
use App\CBR\Helpers;
use DB;

class SearchController extends Controller {

	public function search($type = 'new', $min, $max, $region = null, $series = null)
	{
		
		$dealerships = Dealership::lists('name', 'id');

		switch ($type) {
			case 'new':

				$query = Car::distinct()
							->join('nissan_new_car_versions', 'nissan_new_cars.id', '=', 'nissan_new_car_versions.car_id')
							->join('nissan_new_car_categories', 'nissan_new_cars.category_id', '=', 'nissan_new_car_categories.id')
							->where('nissan_new_car_versions.price', '>=', $min)
							->where('nissan_new_car_versions.price', '<=', $max)							
							->select(['nissan_new_cars.id as id', 'nissan_new_cars.title as title', 'nissan_new_car_versions.price as price',
									  'nissan_new_cars.image_path as image', 'nissan_new_car_versions.title as version'])
							->orderBy('price', 'ASC')
							->groupBy('title');

				$cars = $query->get();
				
				break;

			case 'demo':
				$query = Used::where('type', 'demo')->where('mmbrand', 'NISSAN')
							->where('princl', '>=', $min)
							->where('princl', '<=', $max)
							->select(['vid as id', 'modeldesc as title', 'princl as price',
									  'img1 as image'])
							->orderBy('price', 'ASC');

				if (isset($region) && $region != 'all') 
					$query->where('sregion', '=', $region);

				if (isset($series)) 
					$query->where('mmseries', '=', $series);

				$cars = $query->paginate(10);
				break;

			case 'pre-owned':
				$query = Used::where('type', 'preowned')->where('mmbrand', 'NISSAN')
							->where('princl', '>=', $min)
							->where('princl', '<=', $max)
							->select(['vid as id', 'modeldesc as title', 'princl as price',
									  'img1 as image'])
							->orderBy('price', 'ASC');

				if (isset($region) && $region != 'all') 
					$query->where('sregion', '=', $region);

				if (isset($series)) 
					$query->where('mmseries', '=', $series);

				$cars = $query->paginate(10);
				break;

			case 'specials':
				$query = Special::where('specials.brand', '=', 'NISSAN')						
						->where('specials.start' , '<=', date('Y-m-d'))
						->where('specials.end', '>=', date('Y-m-d'))
						->select(['specials.specialid as id', 'specials.title as title', 'specials.thumbnail as image'])
						->orderBy('specials.end', 'asc');

					$cars = $query->paginate(10);

				break;

			default:
				$query = Car::all();
				$cars = $query->get();
				$type = 'new';
				break;
		}


		switch ($type) {

			case 'new':
				$view_path = 'new-car';
				break;

			case 'demo':
				$view_path = 'view-car/demo';
				break;

			case 'pre-owned':
				$view_path = 'view-car/pre-owned';
				break;

			case 'specials':
				$view_path = '';
				break;

			default:
				$view_path = '';
				break;	
		}

		return view('pages.search')->with(['type' => $type,
											'path' => 'search',
											'menu' => Helpers::makeMenu(),
											'dealerships' => $dealerships,
											'min' => $min,
											'max' => $max,
											'region' => $region,
											'series' => $series,
											'cars' => $cars,
											'view_path' => $view_path,
											'dealershipMenu' => Helpers::makeDealershipMenu()]);
	}

	public function regions($type = 'demo')
	{

		$regions = Used::where('type', $type)
						->where('mmbrand', 'NISSAN')
						->select('sregion')
						->groupBy('sregion')
						->orderBy('sregion')
						->lists('sregion', 'sregion');

		return $regions;
	}

	public function series($type = 'demo')
	{

		$series = Used::where('type', $type)
						->where('mmbrand', 'NISSAN')
						->select('mmseries')
						->groupBy('mmseries')
						->orderBy('mmseries')
						->lists('mmseries', 'mmseries');

		return $series;
	}

	public function specialsRegions()
	{
		$regions = DB::table('dealerships')
						->join('specials', 'dealerships.coynumber', '=', 'specials.dealercoynumber')
						->where('specials.brand', '=', 'NISSAN')
						->where('specials.start' , '<=', date('Y-m-d'))
						->where('specials.end', '>=', date('Y-m-d'))
						->select('region')
						->groupBy('region')
						->orderBy('region')
						->lists('region', 'region');

		return $regions;
	}

}
