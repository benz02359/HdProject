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
/*Route::get('/', function () {
    return view('layouts.app');
});*/
//Route::resource('user','UserController');

//Auth::routes();
Route::get('/solution', 'HomeController@solution')->name('solution');
Route::get('/detail/{sid}','HomeController@detail')->name('detail');
Route::get('/customers', 'HomeController@users');
//Route::get('/test', 'HomeController@test');
//Route::get('/', 'ChatsController@index');
//Route::get('messages', 'ChatsController@fetchMessages');
//Route::post('messages', 'ChatsController@sendMessage');


/*Route::group(['middleware' => ['api','cors']], function () {
    Route::post('auth/login', 'ApiController@login');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('user', 'ApiController@getAuthUser');
    });
});*/

Route::get('/', function () {
    return view('admintest.welcome');
});
