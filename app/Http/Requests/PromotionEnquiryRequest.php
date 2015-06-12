<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PromotionEnquiryRequest extends Request {

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'promotion_id' => 'required',
			'dealership_id' => 'required',
			'firstname' => 'required',
			'surname' => 'required',
			'email' => 'required|email',
			'tel' => 'required'
		];
	}

}
