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

Route::get('/' , 'Controller@showMain')->name('record-main');

Route::get('/backoffice-daily-report', 'Controller@backOfficeDailyReport')->name('bo-rp-dl'); 
Route::post('/backoffice-daily-report', 'Controller@backOfficeDailyReport')->name('bo-rp-ds'); 
