<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reseller;
use App\Models\Device;
use App\Models\UserDevices;

use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        //Get user info
        $loggedInUser = Auth::user();
        $loggedInUser->last_login = Carbon::now();
        $loggedInUser->save();
        Session(['user_name', $loggedInUser->name]);
        Session(['user_id', $loggedInUser->id]);
        Session(['role', $loggedInUser->role]);
        $company_name = Reseller::where('id',$loggedInUser->reseller_id)->pluck('company_name');
        Session(['company', $company_name]);
        if($loggedInUser->role == 'S'){
            $users = User::all();
            $devices = Device::with('userDevices')->with('latest_log','device_settings','device_commands','setpoints')->get();
            foreach($devices as $device){
                if($device->latest_log != null){
                    $triggeredAlarms = [];
                    $alarms = decbin($device->latest_log->alarm);
                    for($i = strlen($alarms); $i < 24; $i++)    // assuming that data is sent less if top alarms are off
                        $alarms = "0".$alarms;                  // adding off status to top alarms so that we can calcuate serially
                    // dd($alarms);
                    //dd($device->logs[0]->alarm);
                    for($i = 0 ; $i < strlen($alarms) ; $i++){
                        if($alarms[$i] == "1"){
                            switch($i){
                                case 0: array_push($triggeredAlarms, "Reserved For future");break;
                                case 1: array_push($triggeredAlarms, "Reserved For future");break;
                                case 2: array_push($triggeredAlarms, "Reserved For future");break;
                                case 3: array_push($triggeredAlarms, "FLOWMETER COMM ERROR");break;
                                case 4: array_push($triggeredAlarms, "ATLAS TEMPERATURE ERROR");break;
                                case 5: array_push($triggeredAlarms, "ZERO EC ALARM");break;
                                case 6: array_push($triggeredAlarms, "ATLAS I2C COM ERROR");break;
                                case 7: array_push($triggeredAlarms, "LOW PRESSURE ALARM");break;
                                case 8: array_push($triggeredAlarms, "PAE AC INPUT FAIL");break;
                                case 9: array_push($triggeredAlarms, "PAE AC POWER DOWN");break;
                                case 10:array_push($triggeredAlarms, "PAE HIGH TEMPERATURE");break;
                                case 11:array_push($triggeredAlarms, "PAE AUX OR SMPS FAIL");break;
                                case 12:array_push($triggeredAlarms, "PAE FAN FAIL");break;
                                case 13:array_push($triggeredAlarms, "PAE OVER TEMP SHUTDOWN");break;
                                case 14:array_push($triggeredAlarms, "PAE OVER LOAD SHUTDOWN");break;
                                case 15:array_push($triggeredAlarms, "PAE OVER VOLT SHUTDOWN");break;
                                case 16:array_push($triggeredAlarms, "PAE COMMUNICATION ERROR");break;
                                case 17:array_push($triggeredAlarms, "CIP LOW LEVEL ALARM");break;
                                case 18:array_push($triggeredAlarms, "WASTE VALVE ALARM");break;
                                case 19:array_push($triggeredAlarms, "LEAKAGE ALARM");break;
                                case 20:array_push($triggeredAlarms, "CABINET TEMP ALARM");break;
                                case 21:array_push($triggeredAlarms, "BYPASS ALARM");break;
                                case 22:array_push($triggeredAlarms, "LOW FLOW WASTE ALARM");break;
                                case 23:array_push($triggeredAlarms, "LOW FLOW PURE ALARM");break;
                            }
                        }
                    }
                    $device->triggeredAlarms = $triggeredAlarms;
                }
            }
            // return $devices;
            return view('super/dashboard')->with(['users'=>$users])
                                            ->with(['devices'=>$devices]);
        }elseif($loggedInUser->role =='R'){
            $users = User::where([['reseller_id',$loggedInUser->reseller_id],['role','U']])->with('latest_log','device_settings','device_commands','setpoints')->get();

            $devices = Device::where('reseller_id',$loggedInUser->reseller_id)->get();
            return view('home')->with(['users'=>$users])
                    ->with(['userDevices'=>$devices]);
        }
        else{
            $users = $loggedInUser;
            $userDevices = UserDevices::where('user_id',$loggedInUser->id)->with("deviceDetails")->get();
        }
        //dd($userDevices);
        return view('home')->with(['users'=>$users])
                            ->with(['userDevices'=>$userDevices]);
    }

    public function login(){
        return view('auth/login');
    }

    public function logout(){
        Auth::logout();
        // return response()->json(['message' => 'Logged Out'], 200);
        return redirect()->route('login');
        return view('auth/login');
    }




    public function addUserDevice(Request $req){
        $user = Auth::user();
        $searchDevice = Device::where([['serial_number',$req->serial_number],['device_number', $req->device_number]])->first();
        if($searchDevice != null){ // if device is registered in database by Super Admin
            $userDevice = UserDevices::where([['user_id',$user->id],['device_id',$searchDevice->id]])->get();
            if($userDevice != null){
                $added = new UserDevices();
                $added->user_id = $user->id;
                $added->device_id = $searchDevice->id;
                $added->device_name = $req->device_name;
                $added->save();
                $response =[
                    'message' => 'Success',
                    'description' =>'Added',
                    'data' => $added
                ];
            }
            else{
                $response =[
                    'message' => 'Error',
                    'description' =>'Device already exists in your profile!'
                ];
            }
        }else{
            $response =[
                'message' => 'Error',
                'description' =>'Device Not Found In Database. Please Call Voltea Office'
            ];
        }
        return response($response);
    }

    public function searchDevice(Request $req){
        $searchDevice = Device::where([['serial_number',$req->serial_number],['device_number', $req->device_number]])->get();
        return response($searchDevice);
    }

    public function getDeviceDetails($id){

        $deviceDetail = Device::where('id',$id)->with(['logs' =>function($query){
                            $query->orderBy("id",'DESC')->first();
                        }])->first();
        return response()->json($deviceDetail);
    }
}
