<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', ['as' => 'login', 'uses' => 'UserAuthenticationController@index']);
    Route::post('/', 'UserAuthenticationController@login');
    /**
     * Auth routes
     */
    Route::group(['middleware' => ['auth']], function () {
        /**
         * Dashboard routes
         */
        Route::get('logout', ['as' => 'logout', 'uses' => 'UserAuthenticationController@logout']);
        Route::get('dashboard/{month?}/{year?}', ['as' => 'dashboard', 'uses' => 'UserDashboardController@index']);
        Route::post('dashboard/enterTime', 'UserDashboardController@enterTime');
        /**
         * Admin routes
         */
        Route::group(['middleware' => ['auth.notAdmin']], function () {
            Route::get('admin', ['as' => 'admin', 'uses' => 'AdminDashboardController@index']);
            Route::post('admin/createUser', 'AdminDashboardController@createUser');
            Route::post('admin/employeeRates', 'AdminDashboardController@employeeRates');
            Route::post('admin/updateRates', 'AdminDashboardController@updateRates');
            Route::post('admin/getEmployeeTime', 'AdminDashboardController@getEmployeeTime');
            Route::post('admin/updateHours', 'AdminDashboardController@updateHours');
            Route::get('admin/calendar/{month?}/{year?}', ['as' => 'admin.overview', 'uses' => 'AdminCalendarController@index']);
            Route::get('admin/reports', ['as' => 'admin.reports', 'uses' => 'AdminReportsController@index']);
            Route::post('admin/reports/generate', 'AdminReportsController@generate');
        });
    });
});
