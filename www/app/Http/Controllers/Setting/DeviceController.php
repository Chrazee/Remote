<?php

namespace App\Http\Controllers\Setting;

use App\Device;
use App\DeviceType;
use App\Group;
use App\Http\Requests\Device\Create;
use App\Http\Requests\Device\Delete;
use App\Http\Requests\Device\Update;
use App\Module;
use App\Protocol;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class DeviceController extends Controller
{
    private $title;
    public function __construct() {
        $this->title = [
            [
                'name' => Lang::get('common.settings'),
                'link' => route('settings')
            ],
            [
                'name' => Lang::get('common.devices'),
                'link' => route('settings.devices')
            ]
        ];
    }

    function index()
    {
        $userId = Auth::user()->id;
        $devices = Device::With('group', 'type', 'module', 'protocol')->where('user_id', $userId)->orderBy('updated_at', 'desc')->get();

        return view('setting.device.index', [
            'title' => $this->title,
            'devices' => $devices,
        ]);
    }

    function show($id)
    {
        $userId = Auth::user()->id;
        $device = Device::With('group', 'type', 'module', 'protocol')->where('user_id',$userId)->findOrFail($id);
        $groups = Group::where('user_id', $userId)->get();
        $types = DeviceType::where('user_id', $userId)->get();
        $modules = Module::where('user_id', $userId)->get();
        $protocols = Protocol::all();

        $this->title[] = [
            'name' => $device->name,
        ];

        return view('setting.device.show', [
            'title' => $this->title,
            'device' => $device,
            'groups' => $groups,
            'types' => $types,
            'modules' => $modules,
            'protocols' => $protocols,
        ]);
    }

    function add()
    {
        $userId = Auth::user()->id;
        $groups = Group::where('user_id', $userId)->get();
        $types = DeviceType::where('user_id', $userId)->get();
        $modules = Module::where('user_id', $userId)->get();
        $protocols = Protocol::all();

        $this->title[] = [
            'name' => Lang::get('common.create_new'),
        ];

        return view('setting.device.add', [
            'title' => $this->title,
            'groups' => $groups,
            'types' => $types,
            'modules' => $modules,
            'protocols' => $protocols,
        ]);
    }

    function create(Create $request) {
        $validated = $request->validated();
        Device::create($validated);
        return response()->json(['message' => [Lang::get('response.device_create')]]);
    }

    function update(Update $request, $id) {
        $validated = $request->validated();
        Device::findOrFail($id)->update($validated);
        return response()->json(['message' => [Lang::get('response.device_update')]]);
    }

    function delete(Delete $request, $id) {
        $validated = $request->validated();
        Device::findOrFail($id)->delete();
        return response()->json(['message' => [Lang::get('response.device_delete')]]);
    }


}
