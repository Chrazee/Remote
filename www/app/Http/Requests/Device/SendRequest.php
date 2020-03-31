<?php

namespace App\Http\Requests\Device;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SendRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'device' => 'required|string',
            'directory' => 'required|string|max:16',
            'action' => 'required|string',
            'parameters' => 'json',
        ];
    }
}
