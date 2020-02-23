<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\Site;

class ModuleController extends Controller
{
    /*function switch(Request $request)
    {
        // curl --data "key=a128f2a3b54a4786c4006410d5dd5967&status=1" http://192.168.0.245/relaySwitch/
        
        $input = $request->all();
        
        $ip = DB::table('devices')->select('local_ip')->where('id', $input['id'])->pluck('local_ip')[0];
        $id = $input['id'];
        
        $postData = array(
            'key' => Site::get('api_key'),
            'status' => $input['status']
        );
        $postString = http_build_query($postData, '', '&');
        $ch = curl_init("http://".$ip."/relaySwitch/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res =  json_decode(curl_exec($ch), true);
        curl_close($ch);

        if(empty($res)) { // empty response, the controller not replies
            // bad response (controller not reached)
            // update the status in database to 0
            DB::table('devices')->where('id', $id)->update(['status' => 0]);
            $response = "unknown";
        }

        if ($res["respond"] == "alreadyOn") {
            DB::table('devices')->where('id', $id)->update(['status' => 1]);
            $response = "alreadyOn";
        } elseif ($res["respond"] == "switchedToOn") {
            DB::table('devices')->where('id', $id)->update(['status' => 1]);
            $response = "switchedToOn";

        } elseif ($res["respond"] == "alreadyOff") {
            DB::table('devices')->where('id', $id)->update(['status' => 0]);
            $response = "alreadyOff";

        } elseif ($res["respond"] == "switchedToOff") {
            DB::table('devices')->where('id', $id)->update(['status' => 0]);
            $response = "switchedToOff";
        } elseif ($res["respond"] == "wrongKey") {
            $response = "wrongKey";
        } elseif ($res["respond"] == "unknownStatusValue") {
            $response = "unknownStatusValue";
        } else {
            // bad response (controller not reached)
            // update the status in database to 0
            DB::table('devices')->where('id', $id)->update(['status' => 0]);
            $response = "unknown";
        }

        return response()->json(['res' => $response]);  
    }
    
    function refresh(Request $request) {
        $input = $request->all();
        
        $ip = DB::table('devices')->select('local_ip')->where('id', $input['id'])->pluck('local_ip')[0];
        $id = $input['id'];
        
        $postData = array(
            'key' => Site::get('api_key')
        );
        $postString = http_build_query($postData, '', '&');
        $ch = curl_init("http://".$ip."/relayStatus/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res =  json_decode(curl_exec($ch), true);
        curl_close($ch);

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
    }*/
}