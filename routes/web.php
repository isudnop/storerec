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

Route::get('/record-amount', 'Controller@showMain')->name('record-main');

Route::post('/record-amount', 'Controller@saveRecord')->name('record-amount');

Route::get('/', function () {
    return view('main');
});

Route::group(['prefix' => 'backoffice'], function () {
    Route::get('/daily-report', function () {
        return view('backoffice-daily-report');
    });
    Route::post('/daily-report', function () {
        return view('backoffice-daily-report');
    });
});
