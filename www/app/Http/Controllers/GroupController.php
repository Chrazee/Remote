<?php

namespace App\Http\Controllers;

use App\DeviceType;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\Group as Group;
use App\Device as Device;

class GroupController extends Controller
{
    function showGroup($id)
    {
        /*
           var_dump(Group::with(['devices', 'type'])
            ->where('id', '=',$id)
            ->where('user_id', '=', Auth::user()->id)
            ->get());
         */

        var_dump(DeviceType::with(['devices'])
            ->get());

        $types = DeviceType::with(['devices', 'devices.group'])
            ->where('devices.group.id', '=',$id)
            ->where('devices.group.user_id', '=', Auth::user()->id)
            ->get();


        //var_dump($types);

        $group = Group::with(['devices', 'devices.type'])
            ->where('id', '=',$id)
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        //var_dump($group);

        //exit();

        if($group) {
            $data = [
                'validGroup' => true,
                'currentGroup' => $group,
                'devices' => $group->devices,
                'subGroups' => $group->childs
            ];
            //var_dump($group->devices);
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
