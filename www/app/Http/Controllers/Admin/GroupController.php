<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Site;
use Validator;

class GroupController extends Controller
{
    function show()
    {
        return view('admin.group', [
            'site_name' => Site::get('site_name'),
            'groups' => Group::all(),
            'parentGroups' => Group::where('parent_id', '=', '-1')->get(),
        ]);
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        $niceNames = array(
            'name' => 'Név',
        );
        $validator->setAttributeNames($niceNames);


        if ($validator->passes()) {

            $update = Group::find($request->get('id'))->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ]);

            $res = array('success' => array('SIkeres adatmódosítás!'));

            return response()->json($res);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }


    function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $validator->setAttributeNames([
            'name' => 'Név',
        ]);

        if ($validator->passes()) {
            $create = Group::create($request->all());
            $res = array('success' => array('A csoport sikeresen létrehozva!'));
            return response()->json($res);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
}
