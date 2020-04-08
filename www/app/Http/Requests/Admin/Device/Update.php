<?php

namespace App\Http\Requests\Admin\Device;

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
            'id' => 'required|int',
            'user_id' => 'required|int|exists:users,id',
            'name' => 'required|string|max:255',
            'group_id' => 'required|int|exists:groups,id',
            'type_id' => 'required|int|exists:devices_type,id',
            'module_id' => 'required|int|exists:modules,id',
            'protocol_id' => 'required|int|exists:protocols,id',
            'address' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'Azonosító',
            'user_id' => 'Felhasználó',
            'name' => 'Név',
            'group_id' => 'Csoport',
            'type_id' => 'Típus',
            'module_id' => 'Modul',
            'protocol_id' => 'protocol',
            'address' => 'Cím',
        ];
    }
}
