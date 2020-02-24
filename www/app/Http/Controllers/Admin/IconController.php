<?php

namespace App\Http\Controllers\Admin;

use App\DevicesTypeIcon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Site;
use Validator;

class IconController extends Controller
{
    private $fileTpyes = "svg,jpg,jpeg,png";
    private $niceNames = [
        'file' => 'fájl',
    ];

    function index()
    {
        return view('admin.icons', [
            'site_name' => Site::get('site_name'),
        ]);
    }

    function deviceType()
    {
        $icons =  DevicesTypeIcon::all()->sortByDesc('updated_at');
        $defaultIcon = DevicesTypeIcon::where('default', '=', '1')->first();

        return view('admin.iconsDeviceType', [
            'site_name' => Site::get('site_name'),
            'icons' =>  $icons,
            'fileTpyes' => $this->fileTpyes,
            'defaultIcon' => $defaultIcon,
        ]);
    }

    function deviceTypeUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => "required|mimes:{$this->fileTpyes}|max:2048"
        ]);
        $validator->setAttributeNames($this->niceNames);

        if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('assets/imgs/devicetype'), $fileName);
            $icon = new DevicesTypeIcon();
            $icon->name = $fileName;
            $icon->save();

            return redirect()->back()->with('success', 'Sikeres fájl feltöltés!');
        }
    }

    function deviceTypeUploadDefault(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'defaultIcon' => "required|mimes:{$this->fileTpyes}|max:2048"
        ]);
        $validator->setAttributeNames([
            'defaultIcon' => 'fájl',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, ' iconDefault')->withInput();
        } else {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('assets/imgs/devicetype'), $fileName);
            $defaultIcon = DevicesTypeIcon::where('default', '=', '1')->first();
            unlink(public_path("assets/imgs/devicetype/{$defaultIcon->name}"));
            $defaultIcon->name =$fileName;
            $defaultIcon->save();

            return redirect()->back()->with('success', 'Az alapértelmezett ikon sikeresen frissítve!');
        }
    }

    function group()
    {
        return view('admin.iconsGroup', [
            'site_name' => Site::get('site_name'),
        ]);
    }

}
