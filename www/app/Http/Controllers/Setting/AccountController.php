<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Update;
use App\User;
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
        return view('setting.account.index', [
            'title' => $this->title,
            'account' => $account,
        ]);
    }

    function update(Update $request, $id) {
        $validated = $request->validated();
        if($validated['password'] == null) {
            User::findOrFail($id)->update([
                'email' => $validated['email']
            ]);
        } else {
            User::findOrFail($id)->update([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);
        }

        return response()->json(['message' => [Lang::get('response.account_update')]]);
    }
}
