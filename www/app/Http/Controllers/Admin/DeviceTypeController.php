<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use App\DeviceType;
use App\DevicesTypeIcon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeviceType\Create;
use App\Http\Requests\Admin\DeviceType\Delete;
use App\Http\Requests\Admin\DeviceType\Update;

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

    function delete(Delete $request) {
        $request->validated();
        DeviceType::find($request->input('id'))->delete();
        return response()->json(['success' => ['Az eszköz-típus sikeresen törölve!']]);
    }

    function update(Update $request) {
        $request->validated();
        DeviceType::find($request->input('id'))->update($request->all());
        return response()->json(['success' => ['Az eszköz-típus sikeresen módosítva!']]);
    }
}
