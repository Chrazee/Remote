<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\Site;
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
