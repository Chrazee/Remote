<?php

namespace App\Http\Controllers\Admin;

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
            'title' => 'Csoportok',
            'groups' => Group::with(['parent', 'icon'])->get(),
            'parentGroups' => Group::where('parent_id', '-1')->get(),
            'icons' => $icons,
            'defaultIcon' => $defaultIcon
        ]);
    }

    function create(Create $request) {
        $validated = $request->validated();
        Group::create($validated);
        return response()->json(['message' => ['A csoport sikeresen létrehozva!']]);
    }

    function delete(Delete $request) {
        $validated = $request->validated();
        Group::findOrFail($validated['id'])->delete();
        return response()->json(['message' => ['A csoport sikeresen törölve!']]);
    }

    function update(Update $request) {
        $validated = $request->validated();
        Group::findOrFail($validated['id'])->update($validated);
        return response()->json(['message' => ['A csoport sikeresen módosítva!']]);
    }
}
