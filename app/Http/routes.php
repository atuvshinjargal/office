<?php


Route::get('login', 'Auth\AuthController@login');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('not-found', 'HomeController@notFound');

    Route::get('/', [
        'as'   => '/',
        'uses' => 'CommandController@index'
    ]);
    Route::get('calendar', [
        'as'   => 'calendar',
        'uses' => 'HomeController@calendar'
    ]);
    Route::get('/', [
        'as'   => 'home',
        'uses' => 'HomeController@index'
    ]);
    Route::get('my-tasks', [
        'as'   => 'tasks',
        'uses' => 'HomeController@tasks'
    ]);
    Route::get('my-tasks/{id}', [
        'as'   => 'task',
        'uses' => 'HomeController@task'
    ]);
    Route::post('my-tasks/{id}', [
        'as'   => 'task.update',
        'uses' => 'HomeController@taskSave'
    ]);
    Route::get('calendar-tasks', [
        'as'   => 'home.calendar.tasks',
        'uses' => 'HomeController@calendarTasks'
    ]);

    Route::resource('clients', 'ClientController',
        ['only' => ['index', 'show']]);

    Route::get('clients/login/{id}', [
        'as'   => 'clients.login',
        'uses' => 'ClientController@login'
    ]);
    Route::resource('tasks', 'TaskController');
    Route::get('tasks/search/client', [
        'as'   => 'tasks.find.client',
        'uses' => 'TaskController@findClient'
    ]);
    Route::get('tasks/note/{id}', [
        'as'   => 'tasks.note',
        'uses' => 'TaskController@note'
    ]);
    Route::post('tasks/note/{id}', [
        'as'   => 'tasks.note.save',
        'uses' => 'TaskController@noteSave'
    ]);
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('categories', 'CategoryController');
    Route::resource('commands', 'CommandController');
    Route::resource('posts', 'PostController');

});
