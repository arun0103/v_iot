<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reseller;
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
        elseif($loggedInUser->role == 'R'){

            $resellerUser = User::where('reseller_id', $loggedInUser->reseller_id)->get();
            return view('admin/users')->with(['users'=>$resellerUser]);
        }
        return view('home');
    }
    public function usersOnly(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == 'S'){
            $all = User::orderby('created_at','desc')->get();
            return view('admin/users')->with(['users'=>$all]);
        }
        elseif($loggedInUser->role == 'R'){
            $resellerUser = User::where([['role','U'],['reseller_id', $loggedInUser->reseller_id]]);
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
            //dd($all);
            $users = User::all();
            return view('user/devices')->with(['devices'=>$all])->with(['users'=>$users]);
        }
        elseif($loggedInUser->role == 'R'){
            $users = User::where([['reseller_id',$loggedInUser->reseller_id],['role','U']])->get();
            $devices = Device::where('reseller_id',$loggedInUser->reseller_id)->get();

            return view('user/devices')->with(['devices'=>$devices])->with(['users'=>$users]);
        }
        return view('home');
    }
    public function create_device(Request $request){
        $loggedInUser = Auth::user();
        $message = null;
        $deviceCount = Device::where('serial_number',$request->serial_number)->orWhere('device_number',$request->device_number)->count();
        if($deviceCount == 0){ // if the serial number and device number are unique
            if($loggedInUser->role == 'S'){ // if user is super admin
                $device = new Device();
                $device->serial_number = $request->serial_number ;
                $device->device_number = $request->device_number ;
                $device->model = $request->model;
                $device->firmware = $request->firmware;
                $device->installation_date= date('Y-m-d',strtotime($request->installation_date));
                $device->reseller_id= $request->reseller_id ;
                $device->created_by = $loggedInUser->id ;
                $device->save();
                $message =[
                    'message'=>'Success',
                    'description'=> 'Device Added',
                    'data'=>$device
                ];

                // notify new user by email


            }else{
                $message =[
                    'message'=>'Error',
                    'description'=> 'Unauthorized access!',
                ];
            }
        }else{
            $message =[
                'message'=>'Error',
                'description'=> 'Duplicate device found!',
            ];
        }
        return $message;
        // $all = Device::all();
        // $users = User::all();
        //return view('user/devices')->with(['devices'=>$all])->with(['message'=>$message])->with(['users'=>$users]);
    }

    public function assignUserDevice(Request $request){
        $loggedInUser = Auth::user();
        $data =[];
        if($loggedInUser->role == 'S'){
            $device = Device::where('serial_number',$request->serial_number)->first();
            if($device == null){
                $data =[
                    'message' => 'Error',
                    'desc' => 'Device not found. Please contact Voltea'
                ];
                return $data;
            }
            if($request->user_type =='U'){
                $check = UserDevices::where([['user_id',$request->user_id],['device_id',$device->id]])->get();
                if($check->count()<1){
                    $assigned = new UserDevices();
                    $assigned->user_id = $request->user_id;
                    $assigned->device_id = $device->id;
                    $assigned->save();
                    $data =[
                        'data'=>$assigned,
                        'message'=>'Success',
                        'desc'=> 'Added successfully!'
                    ];
                }else{
                    $data =['message'=>'Error', 'desc'=> 'This device is already associated to the user!!'];
                }
                return $data;
            }elseif($request->user_type =='R'){
                if($device->reseller_id != null){
                    $data = [
                        'message' => "Error",
                        'desc'=> 'Already has a reseller!'
                    ];
                    return $data;
                }
            }
        }else{
            return ['message'=>'Error','desc'=>'Unauthorized'];
        }
    }




    //API calls
    public function getAllUsers(){
        $users = User::where('role','U')->get();
        dd($users);
        return response($users,200);
    }
    public function getAllResellers(){
        $resellers = Reseller::orderBy('created_at','desc')->get();
        $data = [];
        foreach($resellers as $reseller){
            $resellerDevices = Device::where('reseller_id',$reseller->id)->get();
            array_push($data, ['data'=>$reseller, 'device_count'=>count($resellerDevices)]);
        }
        return view('super.resellers')->with(['resellers'=>$data]);
    }
}
