<?php

Route::group(['middleware' => ['auth']], function() {
    // Main
    Route::get('/', 'MainController@index')->name('index');
    Route::get('/groups', 'MainController@groups')->name('groups');
    Route::get('/group/{id}', 'MainController@group')->name('group');
    Route::get('/group/{id}/type/{type}', 'MainController@type')->name('group.type');
    Route::get('/favorites', 'MainController@favorite')->name('favorites');
    Route::get('/device/{id}', 'MainController@device')->name('device');
    Route::post('/device/request', 'MainController@deviceRequest')->name('device.request');

    // Settings
    Route::get('/settings', 'Setting\IndexController@index')->name('settings');
    // Account
    Route::get('/settings/account', 'Setting\AccountController@index')->name('settings.account');
    Route::post('/settings/account/update/{id}', 'Setting\AccountController@update')->name('settings.account.update');
    // Group
    Route::get('/settings/groups', 'Setting\GroupController@index')->name('settings.groups');
    Route::get('/settings/groups/add', 'Setting\GroupController@add')->name('settings.group.add');
    Route::get('/settings/groups/show/{id}', 'Setting\GroupController@show')->name('settings.group.show');
    Route::post('/settings/groups/create', 'Setting\GroupController@create')->name('settings.group.create');
    Route::post('/settings/groups/update/{id}', 'Setting\GroupController@update')->name('settings.group.update');
    Route::post('/settings/groups/delete/{id}', 'Setting\GroupController@delete')->name('settings.group.delete');
    // Devices
    Route::get('/settings/devices', 'Setting\DeviceController@index')->name('settings.devices');
    Route::get('/settings/devices/add', 'Setting\DeviceController@add')->name('settings.device.add');
    Route::get('/settings/devices/show/{id}', 'Setting\DeviceController@show')->name('settings.device.show');
    Route::post('/settings/devices/create', 'Setting\DeviceController@create')->name('settings.device.create');
    Route::post('/settings/devices/update/{id}', 'Setting\DeviceController@update')->name('settings.device.update');
    Route::post('/settings/devices/delete/{id}', 'Setting\DeviceController@delete')->name('settings.device.delete');
    // Device-types
    Route::get('/settings/devicetypes', 'Setting\DeviceTypeController@index')->name('settings.devicetypes');
    Route::get('/settings/devicetypes/add', 'Setting\DeviceTypeController@add')->name('settings.devicetype.add');
    Route::get('/settings/devicetypes/show/{id}', 'Setting\DeviceTypeController@show')->name('settings.devicetype.show');
    Route::post('/settings/devicetypes/create', 'Setting\DeviceTypeController@create')->name('settings.devicetype.create');
    Route::post('/settings/devicetypes/update/{id}', 'Setting\DeviceTypeController@update')->name('settings.devicetype.update');
    Route::post('/settings/devicetypes/delete/{id}', 'Setting\DeviceTypeController@delete')->name('settings.devicetype.delete');
    // Modules
    Route::get('/settings/modules', 'Setting\ModuleController@index')->name('settings.modules');
    Route::get('/settings/modules/add', 'Setting\ModuleController@add')->name('settings.module.add');
    Route::get('/settings/modules/show/{id}', 'Setting\ModuleController@show')->name('settings.module.show');
    Route::post('/settings/modules/create', 'Setting\ModuleController@create')->name('settings.module.create');
    Route::post('/settings/modules/update/{id}', 'Setting\ModuleController@update')->name('settings.module.update');
    Route::post('/settings/modules/delete/{id}', 'Setting\ModuleController@delete')->name('settings.module.delete');
});

// Login
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/login/validate', 'Auth\LoginController@login')->name('login.validate');
