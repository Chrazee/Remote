<?php

namespace App\Http\Requests\Admin\Site;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'site_name' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'site_name' => 'Oldal neve',
        ];
    }
}
