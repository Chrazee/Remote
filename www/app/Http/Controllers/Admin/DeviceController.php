<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Device;
use App\DeviceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Device\Create;
use App\Http\Requests\Admin\Device\Delete;
use App\Http\Requests\Admin\Device\Update;
use App\Module;
use App\Protocol;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    function index()
    {
        $devices = Device::with(['user', 'group', 'type', 'module', 'protocol'])->where('user_id', Auth::user()->id)->get();

        $types = DeviceType::where('user_id', Auth::user()->id)->get();
        $groups = Group::where('user_id', Auth::user()->id)->get();
        $modules = Module::where('user_id', Auth::user()->id)->get();
        $protocols= Protocol::all();

        return view('admin.devices', [
            'title' => 'Eszközök',
            'devices' => $devices,
            'types' => $types,
            'groups' => $groups,
            'modules' => $modules,
            'protocols' => $protocols
        ]);
    }

    function create(Create $request) {
        $validated = $request->validated();
        Device::create($validated);
        return response()->json(['message' => ['Az eszköz sikeresen létrehozva!']]);
    }

    function delete(Delete $request) {
        $validated = $request->validated();
        Device::findOrFail($validated['id'])->delete();
        return response()->json(['message' => ['Az eszköz sikeresen törölve!']]);
    }

    function update(Update $request) {
        $validated = $request->validated();
        Device::findOrFail($validated['id'])->update($request->all());
        return response()->json(['message' => ['Az eszköz-típus sikeresen módosítva!']]);
    }
}
