<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nif' => 'required|digits:9',
            'payType' => 'required',
            'address' => 'required',
            'payRef' => 'required',
        ];
    }
}
