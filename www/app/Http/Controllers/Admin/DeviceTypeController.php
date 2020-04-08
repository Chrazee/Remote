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
        $deviceTypes = DeviceType::with(['user', 'icon'])->get();
        $icons =  DevicesTypeIcon::where('default', '0')->get();
        $defaultIcon = DevicesTypeIcon::where('default', '1')->first();

        return view('admin.devicetype', [
            'title' => ['Eszközök', 'Típusok'],
            'deviceTypes' => $deviceTypes,
            'icons' => $icons,
            'defaultIcon' => $defaultIcon
        ]);
    }

    function create(Create $request) {
        $validated = $request->validated();
        DeviceType::create($validated);
        return response()->json(['message' => ['Az eszköz-típus sikeresen létrehozva!']]);
    }

    function delete(Delete $request) {
        $validated = $request->validated();
        DeviceType::findOrFail($validated['id'])->delete();
        return response()->json(['message' => ['Az eszköz-típus sikeresen törölve!']]);
    }

    function update(Update $request) {
        $validated = $request->validated();
        DeviceType::findOrFail($validated['id'])->update($request->all());
        return response()->json(['message' => ['Az eszköz-típus sikeresen módosítva!']]);
    }
}
