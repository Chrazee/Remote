<?php

namespace App\Http\Requests\Admin\Group;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Update extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|int|exists:users,id',
            'display_name' => 'required|string|max:255',
            'group_id' => 'required|int|exists:groups,id',
            'type_id' => 'required|int|exists:devices_type,id',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'Felhasználó',
            'display_name' => 'Név',
            'group_id' => 'Csoport',
            'type_id' => 'Típus',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['error' => $validator->errors()->all()]), 422);
    }
}
