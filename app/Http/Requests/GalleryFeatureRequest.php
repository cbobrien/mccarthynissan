<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class GalleryFeatureRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'car_id' => 'required',
			'category_id' => 'required',
			'type' => 'required',
			'title' => 'required'
		];
	}

}
