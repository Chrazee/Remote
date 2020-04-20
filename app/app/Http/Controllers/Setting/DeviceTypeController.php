<?php

namespace App\Http\Controllers\Setting;

use App\DeviceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceType\Create;
use App\Http\Requests\DeviceType\Delete;
use App\Http\Requests\DeviceType\Update;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class DeviceTypeController extends Controller
{
    private $title;
    public function __construct() {
        $this->title = [
            [
                'name' => Lang::get('common.settings'),
                'link' => route('settings')
            ],
            [
                'name' => Lang::get('common.devicetypes'),
                'link' => route('settings.devicetypes')
            ]
        ];
    }

    function index()
    {
        $userId = Auth::user()->id;
        $deviceTypes = DeviceType::where('user_id', $userId)->orderBy('updated_at', 'desc')->get();

        return view('setting.devicetype.index', [
            'title' => $this->title,
            'deviceTypes' => $deviceTypes,
        ]);
    }

    function show($id)
    {
        $userId = Auth::user()->id;
        $deviceType = DeviceType::where('user_id',$userId)->findOrFail($id);

        $this->title[] = [
            'name' => $deviceType->name
        ];

        return view('setting.devicetype.show', [
            'title' => $this->title,
            'deviceType' => $deviceType,
        ]);
    }

    function add()
    {
        $this->title[] = [
            'name' => Lang::get('common.create_new'),
        ];

        return view('setting.devicetype.add', [
            'title' => $this->title,
        ]);
    }

    function create(Create $request) {
        $validated = $request->validated();
        DeviceType::create($validated);
        return response()->json(['message' => [Lang::get('response.devicetype_create')]]);
    }

    function update(Update $request, $id) {
        $validated = $request->validated();
        DeviceType::findOrFail($id)->update($validated);
        return response()->json(['message' => [Lang::get('response.devicetype_update')]]);
    }

    function delete(Delete $request, $id) {
        $validated = $request->validated();
        DeviceType::findOrFail($id)->delete();
        return response()->json(['message' => [Lang::get('response.devicetype_delete')]]);
    }
}
