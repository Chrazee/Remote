<?php

namespace App\Http\Requests\Admin\Device;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Delete extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|int'
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'Azonosító'
        ];
    }
}
