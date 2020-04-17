<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
{
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
        {
        $rules= [
            'title'             =>'required|unique:donations',
            'total_collection'  =>'required_with:donation_needed|integer',
            'donation_needed'   =>'required_with:total_collection|min:10000|integer|greater_than_field:total_collection',
            
            'image'             =>'mimes:jpeg,bmp,png,jpg',
        ];

            switch($this->method()){
                case 'PUT':
                case 'PATCH':
                $rules['title']='required';
                $rules['donation_needed']='nullable';
                $rules['total_collection']  ='nullable';
            
                break;
            }
        return $rules;
        }
    }
}
