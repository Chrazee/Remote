<?php

namespace App\Http\Controllers;

use App\Device as Device;
use App\Http\Requests\Device\SendRequest;
use Module\Exceptions\ValidationException;
use Module\Validators\StructureValidator;

class DeviceController extends Controller
{
    function show($id)
    {
        $device =  Device::with(['type','module'])->find($id);

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
