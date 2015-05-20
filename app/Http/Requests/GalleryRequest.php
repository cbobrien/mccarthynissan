<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class GalleryRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'car_id' => 'required',
			'type' => 'required'
			// 'image' => 'required'
		];
	}

}
