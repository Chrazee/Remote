<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Site;

class MainController extends Controller
{
    function index()
    {
        return view('admin.index', ['site_name' => Site::get('site_name')]);
    }
}
