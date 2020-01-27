<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddYourEmployeePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

     public $rules = [

            'company_name' => 'required',
            'company_address' => 'required',
            'company_phone'=>'required',
            'website_address'=>'required',
            'social_media'=>'required',
            'company_photo'=>'required'
     ];
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
        return $this->rules;
    }
}
