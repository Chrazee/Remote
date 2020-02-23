<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\Site;

class SensorController extends Controller
{
    function getData(Request $request)
    {
        $ip = DB::table('devices')->select('local_ip')->where('id', $request->id)->pluck('local_ip')[0];
        
        $client = new \GuzzleHttp\Client();
        $response = $client->post("http://{$ip}/getData/", [
            'form_params' => [
                'key' => Site::get('api_key'),
            ]
        ]);
        
        $json = json_decode($response->getBody()->getContents(), true);
        
        if(!$json['status']) {
            $json['message'] = "Nem sikerült kiolvasni az adatokat!";
        }
        
        return response()->json($json);  
    }
    
    function refresh(Request $request) {
        $input = $request->all();
        
        $ip = DB::table('devices')->select('local_ip')->where('id', $input['id'])->pluck('local_ip')[0];
        $id = $input['id'];
        
        $client = new \GuzzleHttp\Client();
        $response = $client->post("http://{$ip}/relayStatus/", [
            'form_params' => [
                'key' => Site::get('api_key')
            ]
        ]);
        $res = json_decode($response->getBody()->getContents(), true);
        
        if ($res['respond'] == "on") { // the Relay is On
            DB::table('devices')->where('id', $id)->update(['status' => 1]);
            $response =  'on';

        } elseif ($res['respond'] == "off") {
            DB::table('devices')->where('id', $id)->update(['status' => 0]);
            $response =  'off';
        } 
         elseif ($res['respond'] == "404") { // bad request
            $response =  '404';
        } else {
            DB::table('devices')->where('id', $id)->update(['status' => 1]);
            $response =  'noResponse';
        }

        return response()->json(['res' => $response]);  
    }
}
