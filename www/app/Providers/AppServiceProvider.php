<?php

namespace App\Providers;

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
    }
}
