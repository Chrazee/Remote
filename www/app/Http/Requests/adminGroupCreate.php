<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class adminGroupCreate extends FormRequest
{
    protected $errorBag = "groupCreate";

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255|string',
            'description' => 'max:255',
            'groupId' => 'required|int',
            'iconId' => 'required|int'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Név',
            'groupId' => 'Csoport',
            'iconId' => 'Ikon'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['error' => $validator->errors()->all()]), 422);
    }
}
