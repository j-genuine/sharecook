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

Route::get('/', 'IndexController@index')->name('index');

Route::get('/test', function () { return view('test');});
Route::post('/test', 'TestController@postFile')->name("test_post");

Route::get('/terms', function () { return view('terms');});
Route::get('/inquiry', 'InquiryController@form')->name('inquiry');
Route::post('/inquiry', 'InquiryController@send')->name('inquiry.send');

Route::get('/workerinfo', 'WorkersInfoController@show')->name('workerinfo');
Route::get('/workerslist', 'WorkersInfoController@index')->name('workerslist');

/*** User領域 ***/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('users')->namespace('Users')->name('users.')->group(function(){
    	Route::resource('reserve', 'UserReservationsController', ['only' => ['create', 'store', 'edit', 'destroy' ]]);
    
        Route::get('/setting', 'UserSettingController@edit')->name("setting");
        Route::post('/setting', 'UserSettingController@update')->name("setting_update");
        Route::get('/unscribe', 'UserSettingController@unscribe')->name("unscribe");
        Route::delete('/unscribe', 'UserSettingController@destroy')->name("destroy");
    });
});

/*** Worker領域 ***/
Route::prefix('workers')->namespace('Workers')->name('workers.')->group(function(){
    Auth::routes();
    
    Route::get('/home', 'WorkersHomeController@index')->name('workers_home');
    Route::get('/temp_register', 'Auth\RegisterController@tempCreate')->name('temp_create');
    Route::post('/temp_register', 'Auth\RegisterController@tempStore')->name('temp_store');

    Route::group(['middleware' => ['auth:workers']], function () {
        Route::get('/schedule_edit', 'WorkerScheduleController@form')->name("schedule_edit");
        Route::post('/schedule_update', 'WorkerScheduleController@update')->name("schedule_update");
        
        Route::get('/setting', 'WorkerSettingController@edit')->name("setting");
        Route::post('/setting', 'WorkerSettingController@update')->name("setting_update");
        Route::post('/image_store', 'WorkerSettingController@storeImage')->name("image_store");
        Route::get('/unscribe', 'WorkerSettingController@unscribe')->name("unscribe");
        Route::delete('/unscribe', 'WorkerSettingController@destroy')->name("destroy");
        
        Route::resource('work_images', 'WorkImagesController', ['only' => ['index', 'store', 'edit', 'update', 'destroy' ]]);
    });
});

