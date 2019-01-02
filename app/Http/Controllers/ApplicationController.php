<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VacationRequested;
use App\Notifications\ApplicationUpdated;
use App\Models\User;

class ApplicationController extends Controller
{
    //
    function index(){
    	return view('login');
    }
    function submit(Request $request){
        $user_id = $request->get('user');
        if($user_id && ($user_id == Auth::user()->id)){
            $validated = $this->validate($request,[
                'date_from' =>'required|date', 
                'date_to' => 'required|date|after_or_equal:date_from',
                'reason'=>'required']);
            
            try{
                    $db_user = DB::table('users')->where('id',$user_id)->first();
                    $application_data =  [
                        'user_id' => $user_id,
                        'date_submitted' => Carbon::now()->toDateString(),
                        'vacation_start' => $request->get('date_from'),
                        'vacation_end' => $request->get('date_to'),
                        'status' => 'pending',
                        'reason' => $request->get('reason'),
                        'created_at' => Carbon::now()->toDateString(),
                        'updated_at' => Carbon::now()->toDateString()
                    ];

                $result_id = DB::table('applications')->insertGetId($application_data);
                $application_data['application_id'] = $result_id;
                $application_data['last_name'] = $db_user->last_name;
                $application_data['first_name'] = $db_user->first_name;
                $admin_user = DB::table('users')->where('id',1)->first();
                $admin_user = User::find($admin_user->id);
                /*DB::table('application')->where('id',$result_id)*/
                Notification::send($admin_user,new VacationRequested($application_data));
                return redirect('main/successlogin');
            }catch(Exception $e){
                return view('test',['user'=>$e]);
            }
        }
        else
         {
           return view('test',['user'=>'user is not authenticated']);
         }
    }
    function reject($application_id){
        $qry = DB::table('applications')->where('id',$application_id);
        $qry->update(['status'=> 'rejected']);
        $data = $qry->first();
        $user = User::find($data->user_id);
        $application_data = ['status' => $data->status, 'date_submitted'=>$data->date_submitted];
        Notification::send($user,new ApplicationUpdated($application_data));

    }

 
}
