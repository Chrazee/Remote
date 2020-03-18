<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Site;
use Validator;

class DeviceController extends Controller
{
    function index()
    {
        return view('admin.general', [
            'site_name' => Site::get('site_name'),
            'site_homepage' => Site::get('site_homepage_group_id'),
            'api_key' => Site::get('api_key')
        ]);
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siteName' => 'required',
            'siteHomepage' => 'required',
            'apiKey' => 'required'
        ]);
        $niceNames = array(
            'siteName' => 'Oldal neve',
            'siteHomepage' => 'Kezdőoldal',
            'apiKey' => 'API kulcs',
        );
        $validator->setAttributeNames($niceNames);

        if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            Site::updateData("site_name", $request->input("siteName"));
            Site::updateData("site_homepage", $request->input("siteHomepage"));
            Site::updateData("api_key", $request->input("apiKey"));
            return redirect()->back()->with('success', 'Sikeres adatrögzítés!');
        }
    }
}
