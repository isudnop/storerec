<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/' , 'Controller@showMain')->name('record-main');
Route::get('/record-amount', 'Controller@showMain')->name('record-amount');
Route::post('/record-amount', 'Controller@saveRecord')->name('save-record');

Route::get('/backoffice-login', 'LoginController@showLogin')->name('show-login');
Route::post('/backoffice-login', 'LoginController@doLogin')->name('do-login');

Route::match(['get', 'post'], '/backoffice-daily-report', 'Controller@backOfficeShowDailyReport')->name('bo-rp-dl');
Route::get('/backoffice-summary-report', 'Controller@backOfficeShowSummaryReport')->name('summary-report');

