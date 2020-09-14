<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class AdminRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::user()->role) {
            throw new HttpResponseException(response()->json([
                'message' => 'Forbidden',
            ])->setStatusCode(403, 'Forbidden'));
        }

        return true;
    }


}
