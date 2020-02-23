<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Site;
use View;
use App\Device as Device;

class DeviceController extends Controller
{
    function show($id)
    {
        if(Device::exists($id)) {
            $device = Device::find($id);
            $data = [
                'validDevice' => true,
                'device' => $device
            ];
            if(View::exists('modules.' . $device->type)) {
                $data['validModulePath'] = true;
                $data['modulePath'] = 'modules.' . $device->type;
            } else {
                $data['validModulePath'] = false;
                $data['error'] = [
                    'title' => 'A modul nem található!',
                    'message' => 'Az eszközt nem sikerült megjeleníteni, mert a vezérlő modul nem található az eszköz típusához.'
                ];
            }
        } else {
            $data = [
                'validDevice' => false,
                'error' => [
                    'title' => 'Az eszköz nem található!',
                    'message' => 'A megadott azonosítóval az eszköz nem található a rendszerben.'
                ]
            ];
        }
        return view('device', $data);
    }
    
    function checkConnection(Request $request) {
        $input = $request->all();
        $ip = DB::table('devices')->select('local_ip')->where('id', $input['id'])->pluck('local_ip')[0];

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post("http://{$ip}/validate/", [
                'timeout' => 5,
                'form_params' => [
                    'key' => Site::get('api_key'),
                    'status' => $input['status']
                ]
            ]);

            if($response->getStatusCode() != 200) {
                return response()->json(['status' => false, 'message' => "Az eszköz érvénytelen választ adott"]);  
            }
            return response()->json(['status' => true]);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return response()->json(['status' => false, 'message' => "Nincs kapcsolat az eszközzel"]);  
        }
    }
}