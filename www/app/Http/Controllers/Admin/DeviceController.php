<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use App\Group;
use App\Device;
use App\DeviceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Device\Create;
use App\Http\Requests\Admin\Device\Delete;
use App\Http\Requests\Admin\Device\Update;

class DeviceController extends Controller
{
    function index()
    {
        $devices = Device::with(['group', 'type'])->get();
        $types = DeviceType::all();
        $groups = Group::all();

        return view('admin.devices', [
            'site_name' => Site::get('site_name'),
            'site_homepage' => Site::get('site_homepage_group_id'),
            'api_key' => Site::get('api_key'),
            'devices' => $devices,
            'types' => $types,
            'groups' => $groups
        ]);
    }

    function create(Create $request) {
        $request->validated();
        Device::create($request->all());
        return response()->json(['success' => ['Az eszköz sikeresen létrehozva!']]);
    }

    function delete(Delete $request) {
        $request->validated();
        Device::findOrFail($request->input('id'))->delete();
        return response()->json(['success' => ['Az eszköz sikeresen törölve!']]);
    }

    function update(Update $request) {
        $request->validated();
        Device::findOrFail($request->input('id'))->update($request->all());
        return response()->json(['success' => ['Az eszköz-típus sikeresen módosítva!']]);
    }
}
