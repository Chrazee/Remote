<?php

namespace App\Http\Controllers;

use App\DeviceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;
use App\Group as Group;
use App\Device as Device;

class GroupController extends Controller
{
    function showGroup($id)
    {
        /*$deviceTypes = DeviceType::with(['icon', 'devices', 'devices.group'])->where('devices.group.group_id', "=", '1')->get();
        $deviceTypes = Group::with(['types'])->find(1);
        dd($deviceTypes);
        */

        $group = Group::find($id);

        if($group) {
            $devices = DB::table('devices')
                ->join('devices_type', 'devices_type.id', '=', 'devices.type_id')
                ->join('devices_type_icon', 'devices_type_icon.id', '=', 'devices_type.icon_id')
                ->select(DB::raw('devices.type_id AS deviceTypeId,devices_type.display_name AS deviceTypeName, devices_type_icon.name AS iconName'
                ))
                ->where('group_id', $group->id)
                ->groupBy('devices.type_id')
                ->groupBy('devices_type.display_name')
                ->get();

            foreach ($devices as $device) {
                $device->devices = Device::where('type_id', '=', $device->deviceTypeId)->limit(3)->get();
            }

            $data = [
                'validGroup' => true,
                'currentGroup' => $group,
                'devices' => $devices,
                'subGroups' => $group->childs
            ];
        } else {
            $data = [
                'validGroup' => false,
                'error' => [
                    'title' => "A csoport nem található!",
                    'message' => "A megadott azonosítóval nincsen csoport a rendszerben."
                ]
            ];
        }

        return view('group', $data);
    }

    function showType($id, $type)
    {
        $group = Group::find($id);
        if($group) {
            $DeviceType = DeviceType::find($type);
            if($DeviceType) {
                $data = [
                    'validType' => true,
                    'currentType' => $DeviceType,
                    'devices' => Device::getGroupDevices($id, $type)
                ];
            } else {
                $data = [
                    'validType' => false,
                    'error' => [
                        'title' => "Az eszköz típus nem található!",
                        'message' => "A megadott azonosítóval nincsen ilyen eszköz típus a rendszerben."
                    ]
                ];
            }
        } else {
            return redirect()->to("group/{$id}");
        }

        return view('type', $data);
    }
}
