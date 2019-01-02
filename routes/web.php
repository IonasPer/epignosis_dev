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


Route::get('main/employee',function(){
	return view('employee');
});
Route::post('application/submit','ApplicationController@submit');

Route::get('application/approve/{application_id}',function(){
	$qry = DB::table('applications')->where('application_id',$application_id);
	$qry->update(['status','approved']);
	$data = $qry->first();
	$user = User::find($data->user_id);
	$application_data = ['status' => $data->status, 'date_submitted'=>$data->date_submitted];
	Notification::send($user,new ApplicationUpdated($application_data));
});
Route::get('application/reject/{application_id}','ApplicationController@reject');