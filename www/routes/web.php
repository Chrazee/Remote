<?php

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'IndexController@index')->name('index');

    // Group & Type
    //Route::get('/group', function () { return redirect('/'); });
    Route::get('/group/{id}', 'GroupController@show')->name('group');
    Route::get('/group/{id}/type/{type}', 'GroupController@type')->name('group.type');

    // Device
    Route::get('/device/{id}', 'DeviceController@show')->name('device');
    Route::post('/device/request', 'DeviceController@request')->name('device.request');

    // Favorites
    Route::get('/favorites', 'FavoriteController@index')->name('favorites');

    // Settings
    Route::get('/settings', 'Setting\IndexController@index')->name('settings');

    // Admin
    Route::get('/admin', 'Admin\IndexController@index')->name(('admin'));
        // general
        Route::get('/admin/general', 'Admin\GeneralController@index')->name('admin.general');
        Route::post('/admin/general/update', 'Admin\GeneralController@update')->name('admin.general.update');
            // icons
        Route::get('/admin/icons', 'Admin\IconController@index')->name('admin.icons');
        Route::get('/admin/icons/devicetype', 'Admin\IconController@devicetype')->name('admin.iconDeviceType');
        Route::get('/admin/icons/group', 'Admin\IconController@group')->name('admin.iconGroup');
        Route::post('/admin/icons/upload/', 'Admin\IconController@upload')->name('admin.iconUpload');
        Route::post('/admin/icons/delete/', 'Admin\IconController@delete')->name('admin.iconDelete');
        Route::post('/admin/icons/default/', 'Admin\IconController@default')->name('admin.iconDefault');
        // groups
        Route::get('/admin/groups', 'Admin\GroupController@show')->name('admin.group');
        Route::post('/admin/group/create', 'Admin\GroupController@create')->name('admin.group.create');
        Route::post('/admin/group/update', 'Admin\GroupController@update')->name('admin.group.update');
        Route::post('/admin/group/delete', 'Admin\GroupController@delete')->name('admin.group.delete');
        // devices
        Route::get('/admin/devices', 'Admin\DeviceController@index')->name('admin.devices');
        Route::post('/admin/device/create', 'Admin\DeviceController@create')->name('admin.device.create');
        Route::post('/admin/device/delete', 'Admin\DeviceController@delete')->name('admin.device.delete');
        Route::post('/admin/device/update', 'Admin\DeviceController@update')->name('admin.device.update');
        // deviceType
        Route::get('/admin/devicetype', 'Admin\DeviceTypeController@index')->name('admin.deviceType');
        Route::post('/admin/devicetype/create', 'Admin\DeviceTypeController@create')->name('admin.deviceType.create');
        Route::post('/admin/devicetype/delete', 'Admin\DeviceTypeController@delete')->name('admin.deviceType.delete');
        Route::post('/admin/devicetype/update', 'Admin\DeviceTypeController@update')->name('admin.deviceType.update');
        // modules
        Route::get('/admin/modules', 'Admin\ModuleController@index')->name('admin.modules');
        Route::post('/admin/module/create', 'Admin\ModuleController@create')->name('admin.module.create');
        Route::post('/admin/module/update', 'Admin\ModuleController@update')->name('admin.module.update');
        Route::post('/admin/module/delete', 'Admin\ModuleController@delete')->name('admin.module.delete');
});

// Login
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/login/validate', 'Auth\LoginController@login')->name('login.validate');
