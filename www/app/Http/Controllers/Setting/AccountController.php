<?php

namespace App\Http\Controllers\Setting;

use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Update;
use App\User;
use App\UserSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AccountController extends Controller
{
    private $title;
    public function __construct() {
        $this->title = [
            [
                'name' => Lang::get('common.settings'),
                'link' => route('settings')
            ],
            [
                'name' => Lang::get('common.account'),
                'link' => route('settings.account')
            ]
        ];
    }

    function index()
    {
        $userId = Auth::user()->id;
        $account = User::find($userId);
        $groups = Group::where('user_id', Auth::user()->id)->get();

        return view('setting.account.index', [
            'title' => $this->title,
            'account' => $account,
            'groups' => $groups
        ]);
    }

    function update(Update $request, $id) {
        $validated = $request->validated();
        $data = [
            'email' => $validated['email'],
        ];

        if($validated['password'] != null) {
            $data['password'] = Hash::make($validated['password']);
        }

        User::findOrFail($id)->update($data);

        UserSetting::where('user_id', Auth::user()->id)->update([
            'favorite_group_id' => $validated['favorite_group_id'],
        ]);

        return response()->json(['message' => [Lang::get('response.account_update')]]);
    }
}
