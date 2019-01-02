<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //
    function index(){
    	return view('login');
    }

    function checkLogin(Request $request){
    	$this->validate($request,[
    		'email' =>'required|email',
    		'password' => 'required|alphaNum|min:3'
    	]);

    	$user_data = [
    		'email' =>$request->get('email'),
    		'password' => $request->get('password')
    	];

    	 if(Auth::attempt($user_data))
	     {
	      return redirect('main/successlogin');
	     }
	     else
	     {
	      return back()->with('error', 'Wrong Login Details');
	     }
    }

    function successlogin()
    {
    	$user_id  = Auth::user()->id;
    	$user_applications = DB::table('applications')->where('user_id',$user_id)->get();
     return view('success_login',['applications' =>$user_applications]);
    }

    function logout()
    {
     Auth::logout();
     return redirect('main');
    }
}
