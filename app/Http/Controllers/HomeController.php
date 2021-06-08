<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
    public function index()
    {
        //Get user info
        $loggedInUser = Auth::user();
        $loggedInUser->last_login = Carbon::now();
        $loggedInUser->save();
        Session(['user_name', $loggedInUser->name]);
        Session(['role', $loggedInUser->role]);
        if($loggedInUser->role == 'S'){
            $users = User::all();
            $devices = Device::with('userDevices')->get();
            return view('super/dashboard')->with(['users'=>$users])
                                            ->with(['devices'=>$devices]);
        }elseif($loggedInUser->role =='R'){
            $users = User::where([['reseller_id',$loggedInUser->reseller_id],['role','U']])->get();

            $devices = Device::where('reseller_id',$loggedInUser->reseller_id)->get();
            return view('home')->with(['users'=>$users])
                    ->with(['userDevices'=>$devices]);
        }
        else{
            $users = $loggedInUser;
            $userDevices = UserDevices::where('user_id',$loggedInUser->id)->get();
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
        return view('auth/login');
    }




    public function addUserDevice(Request $req){
        $user = Auth::user();
        $searchDevice = Device::where([['serial_number',$req->serial_number],['device_number', $req->device_number]])->first();
        if($searchDevice != null){ // if device is registered in database by Super Admin
            $userDevice = UserDevices::where([['user_id',$user->id],['device_id',$searchDevice->id]])->get();
            if($userDevice != null){
                $added = new UserDevices;
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
                    'description' =>'Already Exists'
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
}
