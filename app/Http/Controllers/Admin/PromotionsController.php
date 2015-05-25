<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dealership;
use App\Promotion;
use Datatables;
use App\CBR\Helpers;
use App\Http\Requests\PromotionRequest;
use View;
use Carbon;


class PromotionsController extends Controller {

	public function index()
	{
		return view('admin.promotions.index')->with('title', 'Car colours');
	}

	public function create()
	{
		$dealerships = Dealership::lists('name', 'id');
		return view('admin.promotions.create', compact('dealerships'));
	}

	public function store(PromotionRequest $request)
	{		
		$data = Helpers::createDataArray($request, 'promotions');
		$data['expiry_date'] = Carbon::parse($data['expiry_date'])->format('Y-m-d');
		if(!isset($data['published'])) $data['published'] = 0;
		Promotion::create($data);
 		return redirect()->route('admin.promotions.index')->with('message', 'Promotion created');
	}

	public function edit(Promotion $promotion)		
	{
		$dealerships = Dealership::lists('name', 'id');
		return View::make('admin.promotions.edit')->with('promotion', $promotion)->with('dealerships', $dealerships);
	}

	public function update(Promotion $promotion, PromotionRequest $request)
	{
		$data = Helpers::createDataArray($request, 'promotions');
		$data['expiry_date'] = Carbon::parse($data['expiry_date'])->format('Y-m-d');
		if(!isset($data['published'])) $data['published'] = 0;
		$promotion->update($data);
		return redirect()->route('admin.promotions.edit', $promotion->id)->with('message', 'Promotion updated');
	}

	public function destroy(Promotion $promotion)
	{
		$promotion->delete();
		return redirect()->route('admin.promotions.index')->with('message', 'Promotion deleted');
	}

	public function all()
	{
		$colours = Promotion::join('nissan_dealerships', 'nissan_promotions.dealership_id', '=', 'nissan_dealerships.id')
					->select(['nissan_promotions.id as id',  'nissan_promotions.image_path as image_path',
							  'nissan_promotions.created_at as created_at',											  						
							  'nissan_dealerships.name as dealership_name'])
					->orderBy('order', 'asc');		

	    return Datatables::of($colours)
	        ->addColumn('edit', '<a href="/admin/promotions/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i></a>')
	        ->addColumn('delete', '<form method="POST" action="/admin/promotions/{{$id}}" id="deleteForm{{$id}}");">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->editColumn('image_path','<a href="/admin/promotions/{{$id}}/edit"><img src="{{ $image_path }}" style="max-width:300px"></a>')	      
	        ->make(true);
	}

}
