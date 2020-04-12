<?php

namespace App\Http\Controllers\Setting;

use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\Group\Create;
use App\Http\Requests\Group\Delete;
use App\Http\Requests\Group\Update;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class GroupController extends Controller
{
    private $title;
    public function __construct() {
        $this->title = [
            [
                'name' => Lang::get('common.settings'),
                'link' => route('settings')
            ],
            [
                'name' => Lang::get('common.groups'),
                'link' => route('settings.groups')
            ]
        ];
    }

    function index()
    {
        $userId = Auth::user()->id;
        $groups = Group::With('parent')->where('user_id', $userId)->orderBy('parent_id')->get();
        $parentGroups = Group::where('parent_id', '-1')->where('user_id', $userId)->get();

        return view('setting.group.index', [
            'title' => $this->title,
            'groups' => $groups,
            'parentGroups' => $parentGroups,
        ]);
    }

    function show($id)
    {
        $userId = Auth::user()->id;
        $group = Group::with('parent')->where('user_id',$userId)->findOrFail($id);
        $groups = Group::where('user_id', $userId)->get();

        $this->title[] = [
            'name' => $group->name,
        ];

        return view('setting.group.show', [
            'title' => $this->title,
            'group' => $group,
            'groups' => $groups
        ]);
    }

    function add()
    {
        $userId = Auth::user()->id;
        $groups = Group::with('parent')->where('user_id', $userId)->get();

        $this->title[] = [
            'name' => Lang::get('common.create_new')
        ];

        return view('setting.group.add', [
            'title' => $this->title,
            'groups' => $groups
        ]);
    }

    function create(Create $request) {
        $validated = $request->validated();
        Group::create($validated);
        return response()->json(['message' => [Lang::get('response.group_create')]]);
    }

    function update(Update $request, $id) {
        $validated = $request->validated();
        Group::findOrFail($id)->update($validated);
        return response()->json(['message' => [Lang::get('response.group_update')]]);
    }

    function delete(Delete $request, $id) {
        $validated = $request->validated();
        Group::findOrFail($id)->delete();
        return response()->json(['message' => [Lang::get('response.group_delete')]]);
    }
}
