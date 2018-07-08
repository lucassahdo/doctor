<?php

/**
 *  Login routes
 */
Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@index']);
Route::post('/login/in', ['as' => 'login.in', 'uses' => 'LoginController@in']);
Route::get('/login/out', ['as' => 'login.out', 'uses' => 'LoginController@out']);

/**
 * Protect routes from unauthenticated access
 */

Route::group(['middleware' => 'auth'], function () {
    /**
     *  Main routes
     */
    Route::get('/', ['as' => 'dashboard', 'uses' => 'MainController@dashboard']);
    Route::get('notfound', ['as' => 'notfound', 'uses' => 'MainController@notfound']);
    Route::get('about', ['as' => 'about', 'uses' => 'MainController@about']);

    /**
     * General routes
     */
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'MainController@dashboard']);

    /**
     * Schedule routes
     */
    Route::get('/schedule/manage', ['as' => 'schedule.manage', 'uses' => 'ScheduleController@manage']);
    Route::get('/schedule/new', ['as' => 'schedule.new', 'uses' => 'ScheduleController@new']);
    Route::get('/schedule/edit/{id}', ['as' => 'eschedule.edit', 'uses' => 'ScheduleController@edit']);
    Route::post('/schedule/create', ['as' => 'schedule.create', 'uses' => 'ScheduleController@create']);
    Route::get('/schedule/delete/{id}', ['as' => 'schedule.delete', 'uses' => 'ScheduleController@delete']);
    Route::post('/schedule/update/{id}', ['as' => 'schedule.update', 'uses' => 'ScheduleController@update']);

    /**
     * Settings routes
     */
    Route::get('/settings/profile/{id}', ['as' => 'settings.profile', 'uses' => 'SettingsController@profile']);
    Route::get('/settings/users', ['as' => 'settings.user', 'uses' => 'SettingsController@users']);
    Route::get('/settings/preferences', ['as' => 'settings.preferences', 'uses' => 'SettingsController@preferences']);
});

