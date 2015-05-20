<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ServiceRequest extends Request {

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
			'firstname' => 'required',
			'surname' => 'required',
			'email' => 'required|email',
			'tel' => 'required',
			'make' => 'required',
			'dealership_id' => 'required',
			'date' => 'required'
		];
	}

}
