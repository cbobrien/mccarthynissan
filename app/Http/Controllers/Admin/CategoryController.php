<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\PrepareCategoryRequest;

use App\Category;
use Datatables;

use Input;
use View;

class CategoryController extends Controller {

	public function index()
	{
		return view('admin.categories.index')->with('title', 'New Car Categories');
	}

	public function create()
	{
		return view('admin.categories.create');
	}

	public function store(PrepareCategoryRequest $request)
	{		
		Category::create($request->all());
		return redirect()->route('admin.categories.index')->with('message', 'Category created');
	}

	public function edit(Category $category)
	{
		return View::make('admin.categories.edit')->with('category', $category);
	}

	public function update(Category $category, PrepareCategoryRequest $request)
	{
		$category->update($request->all());
		return redirect()->route('admin.categories.index')->with('message', 'Category updated');
	}

	public function destroy(Category $category)
	{
		$category->delete();
		return redirect()->route('admin.categories.index')->with('message', 'Category deleted');
	}

	public function ajaxAll()
	{
		$categories = Category::select(['id', 'category']);
	
	    return Datatables::of($categories)
	        ->addColumn('edit', '<a href="/admin/categories/{{$id}}/edit"><i class="fa fa-pencil-square-o"></i></a>')
	        ->addColumn('delete', '<form method="POST" action="/admin/categories/{{$id}}" id="deleteForm{{$id}}" onsubmit="return confirm(\'Are you sure you want to delete this category?\');">
	        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        				<input name="_method" type="hidden" value="DELETE">	        				
	        				<a href="#" onclick="confirmSubmit(\'deleteForm{{$id}}\');"><i class="fa fa-trash-o"></i></a>
	        			</form>')
	        ->make(true);
	}

}
