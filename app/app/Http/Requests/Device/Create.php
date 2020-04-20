<?php

namespace App\Http\Requests\Device;

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
            'user_id' => ucfirst(Lang::get('common.user_identifier')),
            'name' => ucfirst(Lang::get('common.name')),
            'group_id' => ucfirst(Lang::get('common.group_id')),
            'type_id' => ucfirst(Lang::get('common.group_id')),
            'module_id' => ucfirst(Lang::get('common.module_id')),
            'protocol_id' => ucfirst(Lang::get('common.protocol_id')),
            'address' => ucfirst(Lang::get('common.address')),
        ];
    }
}
