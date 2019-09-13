<?php
/**
 * All Admin Routes Goes Here
 */
Route::group(['prefix'  =>  'admin'], function () {
    
    #Authntication Routes
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    #Authenticated Routes
    Route::group(['middleware' => ['auth:admin']], function () {
        #Dashboard
        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');
        
        #Settings
        Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
        Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');
    });

});