<?php

namespace App\Http\Requests\Admin\Group;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Create extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|int|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'parent_id' => 'required|int',
            'icon_id' => 'required|int|exists:groups_icon,id',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'Felhasználó',
            'name' => 'Név',
            'description' => 'Leírás',
            'parent_id' => 'Csoport',
            'icon_id' => 'Ikon',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['error' => $validator->errors()->all()]), 422);
    }
}
