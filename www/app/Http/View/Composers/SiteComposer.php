<?php

namespace App\Http\View\Composers;

use App\Site;
use Illuminate\View\View;

class SiteComposer {

    public function compose(View $view)
    {
        $site =  Site::all()->keyBy('name')->mapWithKeys(function ($item) {
            return [$item['name'] => $item['value']];
        });
        $view->with('site', $site);
    }

}
