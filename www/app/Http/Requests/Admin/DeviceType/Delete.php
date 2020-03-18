<?php

namespace App\Http\Requests\Admin\DeviceType;

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
            'id' => 'required|int|unique:devices,type_id'
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'Azonosító'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['error' => $validator->errors()->all()]), 422);
    }
}
