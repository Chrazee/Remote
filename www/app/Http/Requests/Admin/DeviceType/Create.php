<?php

namespace App\Http\Requests\Admin\DeviceType;

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
            'icon_id' => 'required|int|exists:devices_type_icon,id',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'Felhasználó',
            'name' => 'Név',
            'icon_id' => 'Ikon'
        ];
    }
}
