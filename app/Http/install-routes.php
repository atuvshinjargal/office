<?php

Route::group(['prefix' => 'install'], function () {

    Route::get('/', 'InstallController@index');
    Route::get('server-requirements', 'InstallController@requirements');
    Route::get('directory-permissions', 'InstallController@permissions');
    Route::get('database', 'InstallController@database');
    Route::post('setup', 'InstallController@setup');
    Route::match(['get', 'post'], 'system-config', 'InstallController@systemConfig');
    Route::get('finish', 'InstallController@finish');
    Route::get('home', 'InstallController@home');

});
