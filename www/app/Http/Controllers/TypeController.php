<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\Group as Room;
use App\DeviceType as DeviceType;

class TypeController extends Controller
{
    function show($id, $type)
    {
        $valid = true;

        $currentType = DB::table('devicetype')
                ->select('name', 'display_name')
                ->where("name" , $type)
                ->get()[0];

        // SELECT type, COUNT(type) AS devices, devicetype.display_name FROM devices JOIN devicetype ON devicetype.name=type WHERE rooro_id=11 GROUP BY type;
        $devices = DB::table('devices')
                ->select('*')
                ->where('room_id', $id)
                ->where('type', $type)
                ->get()[0];

        return view('type', [
            'currentRoomId' => $id,
            'currentType' => $currentType,
            'devices' => $devices
        ]);
    }
}
