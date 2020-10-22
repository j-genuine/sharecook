<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/workerinfo', 'WorkersInfoController@show')->name('workerinfo');;

Route::prefix('workers')->namespace('Workers')->name('workers.')->group(function(){
    Auth::routes();
    
    Route::get('/home', 'WorkersHomeController@index')->name('workers_home');
        
    Route::get('/schedule_edit', 'WorkerScheduleController@form')->name("schedule_edit");
    Route::post('/schedule_update', 'WorkerScheduleController@update')->name("schedule_update");
});