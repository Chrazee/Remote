<?php

namespace App\Http\Controllers\Admin;


use App\Site;
use App\Group;
use App\GroupsIcon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\Create;
use App\Http\Requests\Admin\Group\Delete;
use App\Http\Requests\Admin\Group\Update;

class GroupController extends Controller
{
    function show()
    {
        $icons =  GroupsIcon::where('default', '0')->get();
        $defaultIcon = GroupsIcon::where('default', '1')->first();

        return view('admin.group', [
            'site_name' => Site::get('site_name'),
            'groups' => Group::with(['parent', 'icon'])->get(),
            'parentGroups' => Group::where('parent_id', '=', '-1')->get(),
            'icons' => $icons,
            'defaultIcon' => $defaultIcon
        ]);
    }

    function create(Create $request) {
        $request->validated();
        Group::create($request->all());
        return response()->json(['success' => ['A csoport sikeresen létrehozva!']]);
    }

    function delete(Delete $request) {
        $request->validated();
        Group::findOrFail($request->input('id'))->delete();
        return response()->json(['success' => ['A csoport sikeresen törölve!']]);
    }

    function update(Update $request) {
        $request->validated();
        Group::findOrFail($request->input('id'))->update($request->all());
        return response()->json(['success' => ['A csoport sikeresen módosítva!']]);
    }
}
