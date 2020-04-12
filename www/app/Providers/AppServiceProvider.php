<?php

namespace App\Providers;

use App\UserSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use App\Site;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $site =  Site::all()->keyBy('name')->mapWithKeys(function ($item) {
                return [$item['name'] => $item['value']];
            });
            return $view->with('site', $site);
        });
        view()->composer('*', function ($view) {
            $site_name_admin =  ucfirst(Lang::get('admin.administration'));

            return $view->with('site_name_admin', $site_name_admin);
        });

        if (Auth::check())
        {
            view()->composer('*', function ($view) {
                $userSetting =  UserSetting::where('user_id', Auth::user()->id);
                return $view->with('userSetting', $userSetting);
            });
        }

        Blade::component('components.alert', 'alert');
        Blade::component('components.breadcrumb', 'breadcrumb');
        Blade::component('components.button', 'button');
    }
}
