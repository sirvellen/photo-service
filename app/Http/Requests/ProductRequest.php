<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends AdminRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:products|max:20',
            'price' => 'required|integer|min:1',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ];
    }
}
