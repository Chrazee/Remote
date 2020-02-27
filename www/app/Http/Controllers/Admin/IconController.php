<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use App\Group;
use App\GroupsIcon;
use App\DeviceType;
use App\DevicesTypeIcon;
use App\Http\Controllers\Controller;
use App\Http\Requests\adminIconUpload;
use Illuminate\Http\Request;

class IconController extends Controller
{
    private $fileTpyes = "svg,jpg,jpeg,png";

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

        return view('admin.iconsGroup', [
            'site_name' => Site::get('site_name'),
            'icons' =>  $icons,
            'fileTpyes' => $this->fileTpyes
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

    function delete(Request $request) {
        if($request->get('type') == "group") {
            $icon = GroupsIcon::find($request->get('id'));
            $defaultIcon = GroupsIcon::where('default', '=', '1')->first();

            Group::where('icon_id', '=', $request->get('id'))->update(['icon_id' => $defaultIcon->id]);
            GroupsIcon::destroy($request->get('id'));
            unlink(public_path('assets/imgs/icons/' . $icon->name));

            return response()->json(['success' => ['Az ikon sikeresen törölve!']]);
        } else if ($request->get('type') == "devicetype") {
            $icon = DevicesTypeIcon::find($request->get('id'));
            $defaultIcon = DevicesTypeIcon::where('default', '=', '1')->first();

            DeviceType::where('icon_id', '=', $request->get('id'))->update(['icon_id' => $defaultIcon->id]);
            DevicesTypeIcon::destroy($request->get('id'));
            unlink(public_path('assets/imgs/icons/' . $icon->name));

            return response()->json(['success' => ['Az ikon sikeresen törölve!']]);
        } else {
            return response()->json(['error' => ['Belső szerver hiba!']]);
        }
    }

    function default(Request $request) {
        if($request->get('type') == "group") {
            GroupsIcon::where('default', '=', '1')->update(['default' => '0']);
            GroupsIcon::where('id', '=', $request->get('id'))->update(['default' => '1']);

            return response()->json(['success' => ['A beállítás sikeres volt!']]);
        } else if ($request->get('type') == "devicetype") {
            DevicesTypeIcon::where('default', '=', '1')->update(['default' => '0']);
            DevicesTypeIcon::where('id', '=', $request->get('id'))->update(['default' => '1']);

            return response()->json(['success' => ['A beállítás sikeres volt!']]);

        } else {
            return response()->json(['error' => ['Belső szerver hiba!']]);
        }
    }
}
