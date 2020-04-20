<?php

namespace App\Http\Requests\Module;

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
            'description' => 'nullable|string|max:255',
            'view_file' => "required|mimetypes:text/html",
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => ucfirst(Lang::get('common.user_identifier')),
            'name' => ucfirst(Lang::get('common.name')),
            'description' => ucfirst(Lang::get('common.description')),
            'view_file' => ucfirst(Lang::get('common.view_file')),
        ];
    }
}
