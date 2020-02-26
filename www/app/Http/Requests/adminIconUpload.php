<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminIconUpload extends FormRequest
{
    private $fileTpyes = "svg,jpg,jpeg,png";
    private $fileMaxSize = "2048";
    protected $errorBag = "icon";

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'icon' => "required|mimes:{$this->fileTpyes}|max:{$this->fileMaxSize}"
        ];
    }

    public function attributes()
    {
        return [
            'icon' => 'fájl',
        ];
    }
}
