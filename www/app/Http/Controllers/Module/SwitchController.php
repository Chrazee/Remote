<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\Site;

class SwitchController extends Controller
{

    function switch(Request $request)
    {
        // curl --data "key=a128f2a3b54a4786c4006410d5dd5967&status=1" http://192.168.0.245/relaySwitch/

        $input = $request->all();

        $ip = DB::table('devices')->select('local_ip')->where('id', $input['id'])->pluck('local_ip')[0];
        $id = $input['id'];

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post("http://{$ip}/relaySwitch/", [
                'timeout' => 5,
                'form_params' => [
                    'key' => Site::get('api_key'),
                    'status' => $input['status']
                ]
            ]);

            if($response->getStatusCode() == 200) {
                $response = json_decode($response->getBody()->getContents(), true);
                if($response['status']) {
                    if ($response["response"] == "switchedToOn") {
                        $response['message'] = "A kapcsoló felkapcsolva";
                    } elseif ($response["response"] == "switchedToOff") {
                        $response['message'] = "A kapcsoló lekapcsolva";
                    }
                } else {
                    if ($response["response"] == "alreadyOn") {
                        $response['message'] = "A kapcsoló már felkapcsolva";
                    } elseif ($response["response"] == "alreadyOn") {
                        $response['message'] = "A kapcsoló már lekapcsolva";
                    } elseif ($response["response"] == "wrongKey") {
                        $response['message'] = "Érvénytelen kulcs";
                    } elseif ($response["response"] == "unknownStatusValue") {
                        $response['message'] = "ismeretlen státusz érték";
                    }
                }
                return response()->json($response);
            } else {
                return response()->json(['status' => false, 'message' => "Az eszköz érvénytelen választ adott"]);
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return response()->json(['status' => false, 'message' => "Nincs kapcsolat az eszközzel"]);
        }
    }

    function refresh(Request $request) {
        $input = $request->all();

        $ip = DB::table('devices')->select('local_ip')->where('id', $input['id'])->pluck('local_ip')[0];
        $id = $input['id'];

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post("http://{$ip}/relayStatus/", [
                'timeout' => 5,
                'form_params' => [
                    'key' => Site::get('api_key')
                ]
            ]);

            if($response->getStatusCode() == 200) {
                $response = json_decode($response->getBody()->getContents(), true);
                if($response['status']) {
                    if ($response["response"] == "on") {
                        $response['message'] = "A kapcsoló felkapcsolva";
                    } elseif ($response["response"] == "off") {
                        $response['message'] = "A kapcsoló lekapcsolva";
                    }
                } else {
                    if ($response["response"] == "wrongKey") {
                        $response['message'] = "Érvénytelen kulcs";
                    }
                }
                return response()->json($response);
            } else {
                return response()->json(['status' => false, 'message' => "Az eszköz érvénytelen választ adott"]);
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return response()->json(['status' => false, 'message' => "Nincs kapcsolat az eszközzel"]);
        }
    }
}
