<?php

namespace App\Http\Requests\Device;

use App\Device;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class Delete extends FormRequest
{
    public function authorize()
    {
        $model = Device::find($this->id);
        return ($model != null && $model->user_id == Auth::user()->id);
    }

    public function rules()
    {
        return [
            'user_id' => 'required|int|exists:users,id',
            'id' => 'required|int'
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
