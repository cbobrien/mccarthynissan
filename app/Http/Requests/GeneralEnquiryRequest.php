<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class GeneralEnquiryRequest extends Request {

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
			'_token' => 'required',
			'dealership_id' => 'required',
			'firstname' => 'required',
			'surname' => 'required',
			'email' => 'required|email',
			'tel' => 'required',
			'message' => 'required'
		];
	}

}
