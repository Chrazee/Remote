<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    function index()
    {
        return view('admin.modules', [
            'site_name' => Site::get('site_name'),
            'site_homepage' => Site::get('site_homepage_group_id'),
            'api_key' => Site::get('api_key'),
            'modules' => [],

        ]);
    }
}
