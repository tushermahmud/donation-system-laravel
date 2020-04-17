<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        return [
            'grand_total'   =>'integer|between:20,500000',
            'email'         =>'required',
            /*'slug'          =>'required|unique:posts',*/
            'name'          =>'required',
            'address'       =>'required',
            'city'          =>'required',
            'country'       =>'required',
            'post_code'     =>'required',
            'currency'      =>'required',
            'phone_number'  =>'required',
        ];
    }
}
