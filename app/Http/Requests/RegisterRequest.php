<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
{
     public function rules()
     {
         return [
           'first_name' => 'required',
           'surname' => 'required',
           'phone' => 'required|unique:users|min:11|max:11',
           'password' => 'required',
         ];
     }
}
