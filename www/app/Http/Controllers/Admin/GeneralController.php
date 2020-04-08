<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Site\Update;
use App\Site;

class GeneralController extends Controller
{
    function index()
    {
        return view('admin.general', [
            'title' => 'Általános beállítások'
        ]);
    }

    function update(Update $request)
    {
        $validated = $request->validated();

        foreach ($validated as $key => $value) {
            Site::updateData($key, $value);
        }
        return response()->json(["message" => 'Sikeres adatmódosítás']);
    }
}
