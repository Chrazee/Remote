<?php

namespace App\Http\Controllers;

use App\Device;
use App\UserSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class FavoriteController extends Controller
{
    function index()
    {
        $userSettings = UserSetting::where('user_id', Auth::user()->id)->first();

        $devices = null;
        $favorite = false;

        if($userSettings->favorite_group_id != null) {
            $favorite = true;
            $devices = Device::where('user_id', Auth::user()->id)->where('group_id', $userSettings->favorite_group_id)->get();
        }

        return view('favorite', [
            'title' => ucfirst(Lang::get('favorite.favorites')),
            'favorite' => $favorite,
            'devices' => $devices
        ]);
    }
}
