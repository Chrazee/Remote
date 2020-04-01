<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Device;
use App\Group;

class IndecController extends Controller
{
    function index()
    {
        $deviceCount = Device::where('user_id','=', Auth::user()->id)->count();
        $groups = Group::with('icon')->withCount('devices')
            ->where('user_id','=', Auth::user()->id)
            ->where('parent_id', '=', '-1')
            ->get();

        return view('index', [
            'deviceCount' => $deviceCount,
            'groups' => $groups
        ]);
    }
}
