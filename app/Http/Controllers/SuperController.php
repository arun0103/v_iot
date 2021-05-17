<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Device;
use App\Models\UserDevices;
use Auth;
use Hash;

class SuperController extends Controller
{
    public function users(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == 'S'){
            $all = User::orderby('created_at','desc')->get();
            return view('admin/users')->with(['users'=>$all]);
        }
        elseif($loggedInUser->role == 'A'){
            $resellerUser = User::where(created_by, $loggedInUser->id);
            return view('admin/users')->with(['users'=>$resellerUser]);
        }
        return view('home');
    }
    public function create_user(Request $request){
        $loggedInUser = Auth::user();
        $message = null;
        if($loggedInUser->role == 'S'){
            $new_user = new User();
            $new_user->name = $request->name;
            $new_user->email = $request->email ;
            $new_user->role= $request->role ;
            $new_user->created_by = $loggedInUser->id ;
            $new_user->password = Hash::make('test123');
            $new_user->save();
            $message = "User Added!";

            // notify new user by email


        }else{
            $message = "Not authorized to add user!!!";
        }
        $all = User::all();
        return view('admin/users')->with(['users'=>$all],['message'=>$message]);
    }

    public function devices(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == 'S'){
            $all = Device::all();
            $users = User::all();
            return view('user/devices')->with(['devices'=>$all])->with(['users'=>$users]);
        }
        elseif($loggedInUser->role == 'R'){
            $resellerUserDevices = Device::where(created_by, $loggedInUser->id);
            return view('user/devices')->with(['devices'=>$resellerUserDevices]);
        }
        return view('home');
    }
    public function create_device(Request $request){
        $loggedInUser = Auth::user();
        $message = null;
        if($loggedInUser->role == 'S'){
            $device = new Device();
            $device->serial_number = $request->serial_number ;
            $device->device_number = $request->device_number ;
            $device->manufactured_date= date('Y-m-d',strtotime($request->manufactured_date));
            $device->installation_date= date('Y-m-d',strtotime($request->installation_date));
            $device->reseller_id= $request->reseller_id ;
            $device->is_under_warranty= $request->is_under_warranty ;
            $device->created_by = $loggedInUser->id ;
            $device->save();
            $message =[
                'message'=>'success',
                'description'=> 'Device Added',
                'data'=>$device
            ];

            // notify new user by email


        }else{
            $message =[
                'message'=>'error',
                'description'=> 'Unauthorized access!',
            ];
        }
        $all = Device::all();
        $users = User::all();
        return view('user/devices')->with(['devices'=>$all])->with(['message'=>$message])->with(['users'=>$users]);
    }

    public function assignUserDevice(Request $request){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == 'S'){
            $device = Device::where('serial_number',$request->serial_number)->first();
            $assigned = UserDevices::create([
                'user_id'=>$request->user_id,
                'device_id'=>$device->device_id
            ]);
            return response()->json('message','Assigned');
        }
    }




    //API calls
    public function getAllUsers(){
        $users = User::all();
        return response($users,200);
    }
}
