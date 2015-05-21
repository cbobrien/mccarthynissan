<?php namespace App\CBR;

use App\Category;
use App\Car;
use App\Dealership;
use Debugbar;
use Request;
use Mail;

class Helpers {

	public static $types = ['Exterior' => 'Exterior', 'Interior' => 'Interior'];

	public static function sendMail($data, $view)
	{
		Mail::send('emails.' . $view, $data, function($message) use ($data)
		{

		    $message->from($data['email'], $data['firstname'] . ' ' . $data['surname']);
		    $message->subject($data['subject'] . ' from McCarthy Nissan website');
		    $message->to($data['admin_to'])->cc(explode(';',$data['admin_cc']));
		});
	}

	public static function makeDealershipMenu()
	{

		$dealerships = Dealership::orderBy('name')->get();

		$items = '';
		$offcanvas_items = '';
		$class = '';
		$path = Request::path();

		foreach ($dealerships as $dealership)
		{
			$id = $dealership->id;
			$pos = strpos($path, (string)$id);

			if((stristr($path, 'dealership') ||stristr($path, 'stock')) && (!stristr($path, 'test-drive')))
				$class = $pos ? 'active' : '';

			$items .= '<li class="'. $class .'"><span></span><a href="/dealership/'. $id . '/'. strtolower(str_replace('McCarthy Nissan ', '', $dealership->name))  .'">'. $dealership->name .'</a></li>';
		}

		$offcanvas_items = str_replace('McCarthy Nissan ', '', $items);
		return ['main' => $items, 'offcanvas' => $offcanvas_items];
	}

	public static function makeMenu()
	{

		$category_tabs_container = '';
		$category_tabs = '';
		$tab_panels = '';
		$car_items = '';
		$menu = '';

		$categories = Category::with('cars')->get();

		$i = 0;

		foreach ($categories as $category)
		{
			$class = $i === 0 ? 'active' : '';
			$id = str_replace(' ', '', $category->category);
			$category_tabs .= '<li role="presentation" class="' . $class . '"><a href="#' . $id . '" aria-controls="sports" role="tab" data-toggle="tab">' . $category->category . '</a></li>';
			
			$ii = 1;
			$num_cars = count($category->cars);

			foreach ($category->cars as $car) {

				if($ii == 1) $car_items .= '<div class="row">';

				$car_items .= '<div class="col-xs-6 col-md-4">												    
								<div class="car-menu-item">
									<h5>' . $car->title . '</h5>
									<p class="price">From: R' . $car->versions()->get()->min('price') . '</p>
									<img src="' . $car->image_path . '" alt="' . $car->title .'">
									<p>
										<a href="/new-car/' . $car->id .'/'. strtolower(str_replace(' ', '-', $car->title)) .'" class="btn btn-grey small-button-left" role="button">View</a>
										<a href="/test-drive/' . $car->id .'" class="btn btn-grey small-button-right" role="button">Test Drive</a>
									</p>
								</div>
							</div>';

				if($ii % 3 == 0) $car_items .= '</div><div class="row">';
				if($ii == $num_cars) $car_items .= '</div>';
				$ii++;
				
			}

			$tab_panels .= '<div role="tabpanel" class="tab-pane ' . $class . '" id="' . $id . '">' 																		   
								. $car_items .							 
						   '</div>';

			$car_items = '';			
			$i++;
		}

		$category_tabs_container = '<ul class="nav nav-tabs" role="tablist">' . $category_tabs . '</ul>';

		$menu = '<div role="tabpanel">' . 
					$category_tabs_container . 
					'<div class="tab-content">' . 
						$tab_panels . 
					'</div>' . 
				'</div>';

		return $menu;
	}





	protected static function moveFile($file, $title, $folder)
	{	
	    $fileName = self::cleanInput($title) . '-' . mt_rand() . '.' . $file->getClientOriginalExtension();
	    $file->move(public_path() . '/uploads/'. $folder . '/', $fileName);	    
	    return '/uploads/'. $folder . '/' . $fileName;
	}

	protected static function processFile($name, $title, $request, $folder)
	{

		if ($request->hasFile($name))
		{			
			if ($request->file($name)->isValid())
			{			   
			    $file = $request->file($name);
			    return self::moveFile($file, $title, $folder);		   
			}
		}
	}

	public static function createDataArray($request, $folder)
	{
		$title = $request->get('car_id');
		$data = $request->all();

		$image_path = self::processFile('image_path', $title, $request, $folder);

		if(isset($image_path)) $data['image_path'] = $image_path;

		return $data;
	}

	public static function cleanInput($input)
	{
		return preg_replace('@[\'"/\\<>;\r\n- ]@', '', $input);
	}
}