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
    	$users = DB::table('users')->get();
     return view('success_login',['applications' =>$user_applications, 'user_type'=> Auth::user()->user_type,'users' =>$users]);
    }
    function addApplication()
    {
    	if(Auth::user()->user_type == 'employee'){
    		$data = [
    				'date_from' => 'date',
    				'date_to' => 'date',
    				'reason' => 'text',	
    		];
    	}
    	return view('form',[
    		'user_type'=>Auth::user()->user_type, 
    		'form_action' => '/application/submit', 
    		'form_data' => $data
    	]);
    }
    function addUser()
    {
    	if(Auth::user()->user_type == 'admin'){
    		$data = [
    				'first_name' => 'text',
    				'last_name' => 'text',
    				'email' => 'email',
    				'password' => 'password',
    				'type' => 'text'
    		];
    	}
    	return view('form',[
    		'user_type'=>Auth::user()->user_type, 
    		'form_action' => '/user/submit', 
    		'form_data' => $data
    	]);
    	
    }

    function logout()
    {
     Auth::logout();
     return redirect('main');
    }
}
