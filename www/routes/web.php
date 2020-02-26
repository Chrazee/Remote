<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Homepage
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'MainController@index');

    // Group & Type
    Route::get('/group', function () { return redirect('/'); });
    Route::get('/group/{id}', 'GroupController@showGroup');
    Route::get('/group/{id}/type/{type}', 'GroupController@showType');

    // Device
    Route::get('/device/{id}', 'IconController@show');
    Route::get('/device/checkConnection', 'IconController@checkConnection');

    // Admin
    Route::get('/admin', 'Admin\MainController@index');
        // general
        Route::get('/admin/general', 'Admin\GeneralController@index')->name('adminGeneral');
        Route::post('/admin/general/update', 'Admin\GeneralController@update')->name('adminSiteUpdate');
        // group
        Route::get('/admin/group', 'Admin\GroupController@show')->name('adminGroup');
        Route::get('/admin/group/edit', function () { return redirect('/admin/group'); });
        Route::get('/admin/group/edit/{id}', 'Admin\GroupController@edit');
        Route::post('/admin/group/update', 'Admin\GroupController@update');
        // devices
        Route::get('/admin/devices', 'Admin\DeviceController@show')->name('adminDevices');
        // modules
        Route::get('/admin/modules', 'Admin\ModuleController@show')->name('adminModules');
        // icons
        Route::get('/admin/icons', 'Admin\IconController@index')->name('adminIcons');
        Route::get('/admin/icons/devicetype', 'Admin\IconController@devicetype')->name('adminIconDeviceType');
        Route::get('/admin/icons/group', 'Admin\IconController@group')->name('adminIconGroup');
        Route::post('/admin/icons/upload/', 'Admin\IconController@upload')->name('admin.iconUpload');
        Route::post('/admin/icons/delete/{id}')->name('adminIconDelete');
});

// Login
Route::get('/login', [ 'as' => 'login', 'uses' => 'LoginController@index']);
Route::post('/login/checklogin', 'LoginController@checklogin');
Route::get('/logout', 'LoginController@logout');

// Modules
Route::post('/module/switch/','Modules\SwitchController@switch');
Route::post('/module/switch/refresh', 'Modules\SwitchController@refresh');
Route::post('/module/sensor/getData', 'Modules\SensorController@getData');
