<?php

namespace App\Http\Controllers;

use App\DeviceType;
use App\Group as Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;


class GroupController extends Controller
{
    function show($id)
    {
        $userId =  Auth::user()->id;
        $deviceLimit = 3;
        $group = Group::with(['child'])->where('user_id', $userId)->find($id);

        $types = DeviceType::with(['icon', 'devices' => function($q) use ($deviceLimit, $id) {
            $q->where('devices.group_id', $id)->limit($deviceLimit);
        }])->where('user_id', $userId)->get();

        if($group) {
            $data = [
                'title' => [$group->name],
                'centerTitle' => $group->name,
                'group' => $group,
                'types' => $types,
                'devicesCount' => $group->devices_count,
                'validGroup' => true,
                'currentGroup' => $group,
            ];
        } else {
            $data = [
                'validGroup' => false,
                'title' => Lang::get('group.not_found_title'),
                'error' => [
                    'title' => Lang::get('group.not_found_title'),
                    'message' => Lang::get('group.not_found_message')
                ]
            ];
        }

        return view('group', $data);
    }

    function type($id, $type)
    {
        $userId =  Auth::user()->id;
        $group = Group::where('user_id', $userId)->find($id);

        if($group) {
            $deviceType = DeviceType::with(['icon', 'devices' => function($q) use ($userId) {
                $q->where('devices.group_id', $userId);
            }])->find($type);

            if($deviceType) {
                $data = [
                    'title' => [$group->name, $deviceType->name],
                    'centerTitle' => $deviceType->name,
                    'validType' => true,
                    'deviceType' => $deviceType
                ];
            } else {
                $data = [
                    'validType' => false,
                    'title' => Lang::get('deviceType.not_found_title'),
                    'error' => [
                        'title' =>  Lang::get('deviceType.not_found_title'),
                        'message' =>  Lang::get('deviceType.not_found_message'),
                    ]
                ];
            }
        } else {
            return redirect()->to(route('group', ['id' => $id]));
        }

        return view('type', $data);
    }
}
