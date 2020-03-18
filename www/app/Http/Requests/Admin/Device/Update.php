<?php

namespace App\Http\Requests\Admin\DeviceType;

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
            'name' => 'required|max:255|string|unique:devices_type,name,' . $this->id,
            'display_name' => 'required|max:255',
            'icon_id' => 'required|int'
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'Azonosító',
            'name' => 'Típus',
            'display_name' => 'Megjelenített név',
            'icon_id' => 'Ikon'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['error' => $validator->errors()->all()]), 422);
    }
}
