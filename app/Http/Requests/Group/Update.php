<?php

namespace App\Http\Requests\Group;

use App\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class Update extends FormRequest
{
    public function authorize()
    {
        $model = Group::find($this->id);
        return ($model != null && $model->user_id == Auth::user()->id);
    }

    public function rules()
    {
        return [
            'user_id' => 'required|int|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'parent_id' => 'required|int',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => ucfirst(Lang::get('common.user_identifier')),
            'name' => ucfirst(Lang::get('common.name')),
            'description' => ucfirst(Lang::get('common.description')),
            'parent_id' => ucfirst(Lang::get('common.parent_group')),
        ];
    }
}
