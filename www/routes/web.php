<?php

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'MainController@index');

    // Group & Type
    Route::get('/group', function () { return redirect('/'); });
    Route::get('/group/{id}', 'GroupController@showGroup');
    Route::get('/group/{id}/type/{type}', 'GroupController@showType');

    // Device
    Route::get('/device/{id}', 'IconController@show')->name('device');
    Route::get('/device/checkConnection', 'IconController@checkConnection');

    // Admin
    Route::get('/admin', 'Admin\MainController@index');
        // general
        Route::get('/admin/general', 'Admin\GeneralController@index')->name('admin.general');
        Route::post('/admin/general/update', 'Admin\GeneralController@update')->name('admin.general.update');
        // modules
        Route::get('/admin/modules', 'Admin\ModuleController@index')->name('admin.modules');
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
        Route::post('/admin/group/get', 'Admin\GroupController@get')->name('admin.groupGet');
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
});

// Login
Route::get('/login', [ 'as' => 'login', 'uses' => 'LoginController@index']);
Route::post('/login/checklogin', 'LoginController@checklogin');
Route::get('/logout', 'LoginController@logout');

// Modules
Route::post('/module/switch/','Modules\SwitchController@switch');
Route::post('/module/switch/refresh', 'Modules\SwitchController@refresh');
Route::post('/module/sensor/getData', 'Modules\SensorController@getData');
