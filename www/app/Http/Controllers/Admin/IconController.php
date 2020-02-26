<?php

namespace App\Http\Controllers\Admin;

use App\DevicesTypeIcon;
use App\GroupsIcon;
use App\Http\Controllers\Controller;
use App\Http\Requests\adminDefaultIconUpload;
use App\Http\Requests\adminIconUpload;
use Illuminate\Http\Request;
use App\Site;

class IconController extends Controller
{
    private $fileTpyes = "svg,jpg,jpeg,png";
    private $fileMaxSize = "2048";
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
        $icons =  DevicesTypeIcon::all()->sortByDesc('updated_at')->sortByDesc('default');

        return view('admin.iconsDeviceType', [
            'site_name' => Site::get('site_name'),
            'icons' =>  $icons,
            'fileTpyes' => $this->fileTpyes
        ]);
    }

    function group()
    {
        $icons =  GroupsIcon::all()->sortByDesc('updated_at');
        $defaultIcon = GroupsIcon::where('default', '=', '1')->first();

        return view('admin.iconsGroup', [
            'site_name' => Site::get('site_name'),
            'icons' =>  $icons,
            'fileTpyes' => $this->fileTpyes,
            'defaultIcon' => $defaultIcon,
        ]);
    }

    function upload(adminIconUpload $request) {
        $request->validated();
        $type = $request->type;

        if($type == "GroupsIcon" || $type == "DevicesTypeIcon") {
            $type = '\App\\' . $type;
            $fileName = time() . '.' . $request->icon->extension();
            $request->icon->move(public_path('assets/imgs/icons/'), $fileName);

            if($request->input('defaultIcon')) {
                $type::where('default', '=', '1')->update(['default' => 0]);
            }

            $icon = new $type();
            $icon->name = $fileName;
            $icon->default = $request->input('defaultIcon') ? '1' : '0';
            $icon->save();

            return redirect()->back()->with('success', 'Sikeres fájl feltöltés!');
        } else {
             return redirect()->back()->withErrors(['Belső szerver hiba!'], 'icon');
        }
    }
}
