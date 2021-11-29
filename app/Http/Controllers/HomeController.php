<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reseller;
use App\Models\Device;
use App\Models\UserDevices;

use Auth;
use Carbon\Carbon;
use Session;
use Hash;

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
        ini_set('max_execution_time', 180); //3 minutes
        //Get user info
        $loggedInUser = Auth::user();
        // redirect new user to change password
        if($loggedInUser->last_login == null){
            return view('common/changePassword');
        }
        $loggedInUser->last_login = Carbon::now();
        $loggedInUser->save();
        if($loggedInUser->role == 'S'){
            // $users = User::all();
            $devices = Device::with('device_settings','latest_log:serial_number,step,log_dt','setpoints:id,pure_EC_target')->get();
            //dd($devices);
            $idle_count =0;
            $running_count = 0;
            $standby_count =0;
            $disconnected_count = 0;
            $idle_devices = [];
            $running_devices = [];
            $standby_devices = [];
            $disconnected_devices = [];
            $now = Carbon::now();
            foreach($devices as $device){
                if($device->latest_log != null){
                    $log_carbon = Carbon::parse($device->latest_log->log_dt);
                    if($now->diffInSeconds($log_carbon) <=60){

                        switch($device->latest_log->step){
                            case 0:
                            case 1:
                            case 13:$idle_count++;
                                array_push($idle_devices, $device);
                                break;
                            case 6: $standby_count++;
                                array_push($standby_devices,$device);break;
                            default: $running_count++; array_push($running_devices,$device);
                        }
                    }else{
                        $disconnected_count++;
                        array_push($disconnected_devices,$device);
                    }
                    // dd($now->diffInSeconds($log_carbon));
                }else{
                    $disconnected_count++;
                    array_push($disconnected_devices,$device);
                }
            }
            $counts = [
                'idle'=>$idle_count,
                'running'=>$running_count,
                'standby'=>$standby_count,
                'disconnected'=>$disconnected_count
            ];
            $grouped_devices = [
                'idle'=>$idle_devices,
                'running'=>$running_devices,
                'standby'=>$standby_devices,
                'disconnected'=>$disconnected_devices
            ];


            //  dd($grouped_devices['idle']);
            return view('super/dashboard')->with(['devices'=>$grouped_devices])->with(['counts'=>$counts]);
        }elseif($loggedInUser->role =='R'){
            $users = User::where([['reseller_id',$loggedInUser->reseller->id],['role','U']])->get();
            $devices = Device::where('reseller_id',$loggedInUser->reseller->id)->with('latest_log','device_settings','device_commands','setpoints')->get();

            return view('reseller/dashboard')->with(['users'=>$users])
                    ->with(['devices'=>$devices]);
        }elseif($loggedInUser->role == 'D'){
            $devices = Device::where('distributor_id',$loggedInUser->distributor_id)->get();
            // dd($devices);

            return view('distributor/dashboard')->with(['devices'=>$devices]);
        }
        else{ // logged in user is user
            $users = $loggedInUser;
            $userDevices = UserDevices::where('user_id',$loggedInUser->id)->with("deviceDetails")->get();
            return view('user/dashboard')->with(['users'=>$users])
                            ->with(['userDevices'=>$userDevices]);
        }
    }
    public function changePassword(Request $req){
        $loggedInUser = Auth::user();
        $loggedInUser->password = Hash::make($req->password);
        $loggedInUser->last_login = Carbon::now();
        $loggedInUser->save();
        return redirect()->route('home');
    }

    public function login(){
        return view('auth/login');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        // return response()->json(['message' => 'Logged Out'], 200);
        return redirect()->route('login');
        return view('auth/login');
    }




    public function addUserDevice(Request $req){
        $user = Auth::user();
        $searchDevice = Device::where([['serial_number',$req->serial_number],['device_number', $req->device_number]])->first();
        //return response()->json($searchDevice);
        if($searchDevice != null){ // if device is registered in database by Super Admin
            $userDevice = UserDevices::where([['user_id',$user->id],['device_id',$searchDevice->id]])->get();
            //return response()->json([$userDevice, count($userDevice)]);
            if(count($userDevice) < 0){
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
