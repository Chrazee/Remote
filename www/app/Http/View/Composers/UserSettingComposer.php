<?php

namespace App\Http\View\Composers;

use App\UserSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserSettingComposer {

    public function compose(View $view)
    {
        if (Auth::check()) {
            $userSetting =  UserSetting::where('user_id', Auth::user()->id)->get();
            $view->with('userSetting', $userSetting->toArray()[0]);
        }
    }

}
