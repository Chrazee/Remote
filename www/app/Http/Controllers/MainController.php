<?php

namespace App\Http\Controllers;

use App\Device as Device;
use App\DeviceType;
use App\Group;
use App\Http\Requests\Device\SendRequest;
use App\UserSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Module\Exceptions\ValidationException;
use Module\Validators\StructureValidator;

class MainController extends Controller
{
    function index()
    {
        $deviceCount = Device::where('user_id', Auth::user()->id)->count();

        $groups = Group::withCount('devices')
            ->where('user_id', Auth::user()->id)
            ->where('parent_id', '-1')
            ->get();

        return view('index', [
            'title' => ucfirst(Lang::get('index.homepage')),
            'deviceCount' => $deviceCount,
            'groups' => $groups
        ]);
    }

    function group($id)
    {
        $userId =  Auth::user()->id;
        $deviceLimit = 3;
        $group = Group::with(['child'])->where('user_id', $userId)->findOrFail($id);

        $types = DeviceType::with(['devices' => function($q) use ($deviceLimit, $id) {
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

    function groups()
    {
        abort(404);
        /*$userId =  Auth::user()->id;
        $group = Group::with()->where('user_id', $userId)->get()


        return view('group', $data);
        */
    }

    function type($id, $type)
    {
        $userId =  Auth::user()->id;
        $group = Group::where('user_id', $userId)->findOrFail($id);

        if($group) {
            $deviceType = DeviceType::with(['devices' => function($q) use ($userId) {
                $q->where('devices.group_id', $userId);
            }])->findOrFail($type);

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

    function favorite()
    {
        $userSettings = UserSetting::where('user_id', Auth::user()->id)->first();

        $devices = null;
        $favorite = false;

        if($userSettings->favorite_group_id != null) {
            $favorite = true;
            $devices = Device::where('user_id', Auth::user()->id)->where('group_id', $userSettings->favorite_group_id)->get();
        }

        return view('favorite', [
            'title' => ucfirst(Lang::get('favorite.favorites')),
            'favorite' => $favorite,
            'devices' => $devices
        ]);
    }

    function device($id)
    {
        $device =  Device::with(['type','module'])->findOrFail($id);

        if(!$device) {
            return view('device', [
                'error' => [
                    'title' => 'Az eszköz nem található!',
                    'message' => 'A megadott azonosítóval az eszköz nem található a rendszerben.'
                ]
            ]);
        }

        try {
            $moduleValidator = new StructureValidator($device->module->directory);
        } catch (ValidationException $e) {
            return view('device', [
                'error' => [
                    'title' => 'Az eszközt nem sikerült betölteni!',
                    'message' => $e->getTitle() . ' ('.$e->getHttpStatusCode().'): ' . $e->getMessage()
                ]
            ]);
        }
        return view('device', [
            'title' => ['Eszközök', $device->name],
            'device' =>  $device,
            'directory' => $device->module->directory,
            'view' => $device->module->directory . ".View.View"
        ]);
    }

    function request(SendRequest $request) {
        $action = $request->input('action');
        $device = unserialize($request->input('device'));
        $parameters = json_decode($request->input('parameters'));
        $directory = $request->input('directory');

        $moduleClass = 'Module\Storage\\' . $directory . '\Controller\\' . 'Controller';
        $module = new $moduleClass();
        $module->callAction($action, $device, $parameters);
    }
}
