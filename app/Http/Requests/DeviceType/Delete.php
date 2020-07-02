<?php

namespace App\Http\Requests\DeviceType;

use App\DeviceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class Delete extends FormRequest
{
    public function authorize()
    {
        $model = DeviceType::find($this->id);
        return ($model != null && $model->user_id == Auth::user()->id);
    }

    public function rules()
    {
        return [
            'user_id' => 'required|int|exists:users,id',
            'id' => 'required|int|unique:devices,type_id'
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => ucfirst(Lang::get('common.user_identifier')),
            'id' => ucfirst(Lang::get('common.identifier')),
        ];
    }
}
