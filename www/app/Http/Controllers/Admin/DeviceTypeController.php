<?php

namespace App\Http\Controllers\Admin;

use App\DevicesTypeIcon;
use App\DeviceType;
use App\Http\Requests\Admin\DeviceType\Create;
use App\Site;
use App\Http\Controllers\Controller;

class DeviceTypeController extends Controller
{
    function index()
    {
        $deviceTypes = DeviceType::with('icon')->get();
        $icons =  DevicesTypeIcon::where('default', '0')->get();
        $defaultIcon = DevicesTypeIcon::where('default', '1')->first();

        return view('admin.devicetype', [
            'site_name' => Site::get('site_name'),
            'deviceTypes' => $deviceTypes,
            'icons' => $icons,
            'defaultIcon' => $defaultIcon
        ]);
    }

    function create(Create $request) {
        $request->validated();
        DeviceType::create($request->all());
        return response()->json(['success' => ['Az eszköz-típus sikeresen létrehozva!']]);
    }
}
