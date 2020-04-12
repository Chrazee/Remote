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

Route::group(['middleware' => ['auth', 'admin']], function() {
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
