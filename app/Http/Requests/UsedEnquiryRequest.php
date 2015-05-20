<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsedEnquiryRequest extends Request {

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
			'dealership_id' => 'required',
			'vid' => 'required',
			'firstname' => 'required',
			'surname' => 'required',
			'email' => 'required|email',
			'tel' => 'required',
			'enquiry_type' => 'required'
		];
	}

}
