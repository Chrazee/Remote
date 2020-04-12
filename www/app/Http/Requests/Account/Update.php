<?php

namespace App\Http\Requests\Account;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class Update extends FormRequest
{
    public function authorize()
    {
        return (User::find(Auth::user()->id) != null) ? true : false;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|int|exists:users,id',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'password' => 'nullable|string|confirmed|min:6|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => ucfirst(Lang::get('common.user_identifier')),
            'password' => ucfirst(Lang::get('common.password')),
        ];
    }
}
