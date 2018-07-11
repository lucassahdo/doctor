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
    Route::get('/schedule/manage/table', ['as' => 'schedule.manage.table', 'uses' => 'ScheduleController@table']);
    Route::get('/schedule/new', ['as' => 'schedule.new', 'uses' => 'ScheduleController@new']);
    Route::get('/schedule/edit/{id}', ['as' => 'schedule.edit', 'uses' => 'ScheduleController@edit']);
    Route::post('/schedule/create', ['as' => 'schedule.create', 'uses' => 'ScheduleController@create']);
    Route::get('/schedule/delete/{id}', ['as' => 'schedule.delete', 'uses' => 'ScheduleController@delete']);
    Route::post('/schedule/update/{id}', ['as' => 'schedule.update', 'uses' => 'ScheduleController@update']);

    /**
     * Patient routes
     */
    Route::get('/patient/manage', ['as' => 'patient.manage', 'uses' => 'PatientController@manage']);
    Route::get('/patient/manage/table', ['as' => 'patient.manage.table', 'uses' => 'PatientController@table']);
    Route::get('/patient/new', ['as' => 'patient.new', 'uses' => 'PatientController@new']);
    Route::get('/patient/edit/{id}', ['as' => 'patient.edit', 'uses' => 'PatientController@edit']);
    Route::post('/patient/create', ['as' => 'patient.create', 'uses' => 'PatientController@create']);
    Route::get('/patient/delete/{id}', ['as' => 'patient.delete', 'uses' => 'PatientController@delete']);
    Route::post('/patient/update/{id}', ['as' => 'patient.update', 'uses' => 'PatientController@update']);

    /**
     * Doctor routes
     */
    Route::get('/doctor/manage', ['as' => 'doctor.manage', 'uses' => 'DoctorController@manage']);
    Route::get('/doctor/manage/table', ['as' => 'doctor.manage.table', 'uses' => 'DoctorController@table']);
    Route::get('/doctor/new', ['as' => 'doctor.new', 'uses' => 'DoctorController@new']);
    Route::get('/doctor/edit/{id}', ['as' => 'doctor.edit', 'uses' => 'DoctorController@edit']);
    Route::post('/doctor/create', ['as' => 'doctor.create', 'uses' => 'DoctorController@create']);
    Route::get('/doctor/delete/{id}', ['as' => 'doctor.delete', 'uses' => 'DoctorController@delete']);
    Route::post('/doctor/update/{id}', ['as' => 'doctor.update', 'uses' => 'DoctorController@update']);

    /**
     * Doctor routes
     */
    Route::get('/attendant/manage', ['as' => 'attendant.manage', 'uses' => 'AttendantController@manage']);
    Route::get('/attendant/manage/table', ['as' => 'attendant.manage.table', 'uses' => 'AttendantController@table']);
    Route::get('/attendant/new', ['as' => 'attendant.new', 'uses' => 'AttendantController@new']);
    Route::get('/attendant/edit/{id}', ['as' => 'attendant.edit', 'uses' => 'AttendantController@edit']);
    Route::post('/attendant/create', ['as' => 'attendant.create', 'uses' => 'AttendantController@create']);
    Route::get('/attendant/delete/{id}', ['as' => 'attendant.delete', 'uses' => 'AttendantController@delete']);
    Route::post('/attendant/update/{id}', ['as' => 'attendant.update', 'uses' => 'AttendantController@update']);

    /**
     * Settings routes
     */
    Route::get('/settings/profile/{id}', ['as' => 'settings.profile', 'uses' => 'SettingsController@user_profile']);
    Route::get('/settings/users', ['as' => 'settings.users', 'uses' => 'SettingsController@users']);
    Route::get('/settings/user/new', ['as' => 'settings.user.new', 'uses' => 'SettingsController@user_new']);
    Route::get('/settings/user/edit/{id}', ['as' => 'settings.user.edit', 'uses' => 'SettingsController@user_edit']);
    Route::get('/settings/user/table', ['as' => 'settings.user.table', 'uses' => 'SettingsController@user_table']);
    Route::post('/settings/user/create', ['as' => 'settings.user.create', 'uses' => 'SettingsController@user_create']);
    Route::post('/settings/user/update/{id}', ['as' => 'settings.user.update', 'uses' => 'SettingsController@user_update']);
    Route::get('/settings/user/delete/{id}', ['as' => 'settings.user.delete', 'uses' => 'SettingsController@user_delete']);
    Route::get('/settings/preferences', ['as' => 'settings.preferences', 'uses' => 'SettingsController@preferences']);

});

