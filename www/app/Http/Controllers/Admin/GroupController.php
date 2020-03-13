<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use App\Group;
use App\GroupsIcon;
use App\Http\Controllers\Controller;
use App\Http\Requests\adminGroupCreate;
use App\Http\Requests\adminGroupUpdate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    function show()
    {
        return view('admin.group', [
            'site_name' => Site::get('site_name'),
            'groups' => Group::with(['parent', 'icon'])->get(),
            'parentGroups' => Group::where('parent_id', '=', '-1')->get(),
            'icons' => GroupsIcon::where('default', '=', '0')->get(),
        ]);
    }

    function update(adminGroupUpdate $request)
    {
        $request->validated();

        Group::find($request->input('id'))->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent_id' => $request->input('groupId'),
            'icon_id' => ($request->input('iconId') == "-1") ? GroupsIcon::where('default', '=', '1')->first()->id : $request->input('iconId')
        ]);

        return response()->json(['success' => ['SIkeres adatmódosítás!']]);
    }


    function create(adminGroupCreate $request) {
        $request->validated();

        $iconId = $request->input('iconId');
        if($iconId == "-1") {
            $iconId = GroupsIcon::where('default', '=', '1')->first()->id;
        }

        $group = new Group();
        $group->parent_id = $request->input('groupId');
        $group->user_id = Auth::user()->id;
        $group->icon_id = $iconId;
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->save();

        return response()->json(['success' => ['A csoport sikeresen létrehozva!']]);
    }

    function get(Request $request) {
        $group = Group::with(['parent', 'icon'])->find($request->input('id'));
        $defaultIcon = GroupsIcon::where('default', '=', '1')->first();

        if($group) {
            return response()->json(['success' => [
                'group' => $group,
                'defaultIcon' => ($group->icon->id == $defaultIcon->id) ? true : false
            ]]);
        }
        return response()->json(['error' => ['Nem sikerült betölteni az adatokat!']]);
    }

    function delete(Request $request) {
        $group = Group::find($request->input('id'));

        if($group) {
            if($group->childs->count()) {
                return response()->json(['error' => ['A csoport nem törölhető, amíg tartalmaz alcsoportokat!']]);
            }
            if($group->devices->count()) {
                return response()->json(['error' => ['A csoport nem törölhető, amíg tartalmaz eszközöket!']]);
            }

            $group->delete();
            return response()->json(['success' => ['A csoport sikeresen törölve!']]);
        }

        return response()->json(['error' => ['A csoport nem létezik!']]);
    }
}
