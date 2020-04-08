<?php

namespace App\Http\Controllers\Admin;

use App\Module;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    function index()
    {
        $modules = Module::all();

        return view('admin.modules', [
            'title' => 'Modulok',
            'modules' => $modules,

        ]);
    }
}
