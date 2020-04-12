<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Device;
use App\Group;
use Illuminate\Support\Facades\Lang;

class IndexController extends Controller
{
    function index()
    {
        return view('setting.index', [
            'title' => ucfirst(Lang::get('common.settings')),
        ]);
    }
}
