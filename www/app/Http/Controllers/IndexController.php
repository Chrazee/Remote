<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Device;
use App\Group;
use Illuminate\Support\Facades\Lang;

class IndexController extends Controller
{
    function index()
    {
        $deviceCount = Device::where('user_id', Auth::user()->id)->count();

        $groups = Group::with('icon')->withCount('devices')
            ->where('user_id', Auth::user()->id)
            ->where('parent_id', '-1')
            ->get();

        return view('index', [
            'title' => ucfirst(Lang::get('index.homepage')),
            'deviceCount' => $deviceCount,
            'groups' => $groups
        ]);
    }
}
