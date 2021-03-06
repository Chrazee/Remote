<?php

namespace App\Http\Controllers;

use App\Device as Device;
use App\DeviceType;
use App\Group;
use App\User;
use App\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Module\Controllers\RequestController;
use Module\Exceptions\ValidationException;
use Module\Validators\StructureValidator;

class MainController extends Controller
{
    private $title;
    public function __construct() {
        $this->title = [];
    }

    function index()
    {
        $deviceCount = Device::where('user_id', Auth::user()->id)->count();

        $groups = Group::withCount('devices')
            ->where('user_id', Auth::user()->id)
            ->where('parent_id', '-1')
            ->get();

        return view('home', [
            'title' => ucfirst(Lang::get('common.homepage')),
            'deviceCount' => $deviceCount,
            'groups' => $groups
        ]);
    }

    function group($id)
    {
        $userId =  Auth::user()->id;
        $deviceLimit = 3;
        $group = Group::with(['device','child', 'child.device'])->where('user_id', $userId)->findOrFail($id);
        $types = DeviceType::with(['devices' => function($q) use ($deviceLimit, $id) {
            $q->where('devices.group_id', $id)->limit($deviceLimit);
        }])->where('user_id', $userId)->get();

        $this->title[] = [
            'name' => ucfirst(Lang::get('common.groups')),
            'link' => route('index'),
        ];
        foreach (Group::getParentsFromId($group->id) as $parent) {
            $this->title[] = [
                'name' => $parent['name'],
                'link' => route('group', $parent['id']),
            ];
        }
        $this->title[] = [
            'name' => $group->name,
        ];

        return view('group', [
            'title' => $this->title,
            'group' => $group,
            'types' => $types,
            'devicesCount' => $group->devices_count,
            'currentGroup' => $group,
        ]);
    }

    function type($id, $type)
    {
        $userId =  Auth::user()->id;
        $group = Group::where('user_id', $userId)->findOrFail($id);
        $deviceType = DeviceType::with(['devices' => function($q) use ($group) {
            $q->where('devices.group_id', $group->id);
        }])->findOrFail($type);

        $this->title[] = [
            'name' => $group->name,
            'link' => route('group', $group->id)
        ];
        $this->title[] = [
            'name' => $deviceType->name,
        ];

        return view('type', [
            'title' =>  $this->title,
            'deviceType' => $deviceType
        ]);
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
            'title' => ucfirst(Lang::get('common.favorites')),
            'favorite' => $favorite,
            'devices' => $devices
        ]);
    }

    function device($id)
    {
        $device = Device::with(['type', 'module', 'protocol'])->findOrFail($id);
        $user = User::findorFail(Auth::user()->id);

        $this->title[] = [
            'name' => Lang::get('common.devices'),
        ];
        $this->title[] = [
            'name' => $device->name,
        ];

        if (!StructureValidator::validate($device->module->directory, true)) {
            return view('device', [
                'title' => $this->title,
                'error' => [
                    'title' => Lang::get('common.can_not_load_the_device'),
                    'messages' => StructureValidator::getMessages()
                ]
            ]);
        }

        $directory = $device->module->directory;
        $viewFile =  $directory .  "/" . env('MODULE_VIEW');
        View::addExtension(env('MODULE_VIEW_EXTENSION'), 'php');

        $data = json_encode([
            '_token' => csrf_token(),
            'device' =>   [
                'id' => $device->id,
                'address' => $device->address,
                'protocol' => $device->protocol->name
            ],
            'token' => $user->device_token,
            'action' => 'get',
            'parameters' => [],
        ]);

        return view('device', [
            'title' => $this->title,
            'deviceName' =>  $device->name,
            "data" => $data,
            'viewFile' => $viewFile,
        ]);
    }

    function deviceRequest(Request $request) {
        $data = $request->except('_token');

        $requestController = new RequestController();
        $requestController->postRequest($data);
    }
}
