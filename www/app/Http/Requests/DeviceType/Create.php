<?php

namespace App\Http\Requests\DeviceType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class Create extends FormRequest
{
    public function authorize()
    {
        return (Auth::user()->id == $this->user_id);
    }

    public function rules()
    {
        return [
            'user_id' => 'required|int|exists:users,id',
            'name' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => ucfirst(Lang::get('common.user_identifier')),
            'name' => ucfirst(Lang::get('common.name')),
        ];
    }
}
