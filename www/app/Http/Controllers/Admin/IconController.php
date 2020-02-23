<?php

namespace App\Http\Controllers\Admin;

use App\DevicesTypeIcon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Site;
use Validator;

class IconController extends Controller
{
    function index()
    {
        return view('admin.icons', [
            'site_name' => Site::get('site_name'),
        ]);
    }

    function deviceType()
    {
        return view('admin.iconsDeviceType', [
            'site_name' => Site::get('site_name'),
            'icons' => DevicesTypeIcon::all()->sortByDesc('updated_at')
        ]);
    }

    function group()
    {
        return view('admin.iconsGroup', [
            'site_name' => Site::get('site_name'),
        ]);
    }

    function deviceTypeUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:svg,jpg,jpeg,png|max:2048'
        ]);
        $niceNames = array(
            'file' => 'fájl',
        );
        $validator->setAttributeNames($niceNames);

        if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('assets/imgs/devicetype'), $fileName);
            $icon = new DevicesTypeIcon();
            $icon->name = $fileName;
            $icon->save();

            return redirect()->back()->with('success', 'Sikeres fájl feltöltés!');
        }

    }
}
