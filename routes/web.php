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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/main', 'MainController@index');
Route::post('/main/checklogin', 'MainController@checklogin');
Route::get('main/successlogin', 'MainController@successlogin');
Route::get('main/logout', 'MainController@logout');
Route::get('main/employee','MainController@addApplication');
Route::get('main/admin','MainController@addUser');

Route::post('user/submit','ApplicationController@userSubmit');
Route::post('application/submit','ApplicationController@applicationSubmit');
Route::get('application/approve/{application_id}','ApplicationController@approve');
Route::get('application/reject/{application_id}','ApplicationController@reject');