<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    //route for store application form data 
    Route::post('/store','ApplicationController@submitApplication')->name('application.store');
    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        // route to dashboard index page 
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
        /// create route for reject or accept application manager role 
        Route::group(['middleware' => ['role:hr_manager']], function () {
           // get all applications for manager 
            Route::get('/get-applications-for-manager','ApplicationController@getApplicationsForManager')->name('application.getApplicationsForManager');
            // approve or reject application 
            Route::post('/application/manager/change-status','ApplicationController@acceptOrRejectApplicationByManager')->name('application.changeStatus.manager');
            
        });
        Route::group(['middleware' => ['role:hr_coordinator']], function () {
            // dashboard for hr coordinator 
            Route::get('/dashboard-coordinator','DashboardController@coordinator')->name('dashboard.coordinator');
            Route::get('/get-applications-for-coordinator','ApplicationController@getApplicationsForCoordinator')->name('application.getApplicationsForCoordinator');
            // approve or reject application 
            Route::post('/application/coordinator/change-status','ApplicationController@acceptOrRejectApplicationByCoordintor')->name('application.changeStatus.coordinator');
            // get report application to hr coordinator 
            Route::get('/application-report','ApplicationController@getReportApplicationsForCoordinator')->name('application.report');
            // get getApplicationsForCoordinator for coordinator 
            // Route::get('/getApplicationsForCoordinator','ApplicationController@getApplicationsForCoordinator')->name('application.getApplicationsForCoordinator');
        });
        // Route::get('/application/{id}/reject','ApplicationController@reject')->name('application.reject');
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
