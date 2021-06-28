<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;

use App\Mail\WelcomeUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reseller;
use App\Models\Device;
use App\Models\UserProfile;
use App\Models\UserDevices;
use App\Notifications\HelloNewUser;
use App\Notifications\EmailUpdated;
use Auth;
use Hash;

class SuperController extends Controller
{
    public function users(){
        $loggedInUser = Auth::user();
        $reseller = Reseller::where('id',$loggedInUser->reseller_id)->first();
        if($loggedInUser->role == 'S'){
            $all = User::orderby('created_at','desc')->with('reseller')->get();
            return view('admin/users')->with(['users'=>$all]);
        }
        elseif($loggedInUser->role == 'R'){

            $resellerUser = User::where('reseller_id', $loggedInUser->reseller_id)->get();
            return view('admin/users')->with(['users'=>$resellerUser])->with('reseller',$reseller);
        }
        return view('home');
    }
    public function usersOnly(){
        $loggedInUser = Auth::user();
        $data = [];
        if($loggedInUser->role == 'S'){
            $all = User::where('role','U')->orderby('created_at','desc')->withCount('userDevices')->get();
            return view('admin/users')->with(['users'=>$all]);
        }
        elseif($loggedInUser->role == 'R'){
            $resellerUser = User::where('reseller_id', $loggedInUser->reseller_id)->with('reseller')->withCount('userDevices')->get();
            return view('admin/users')->with(['users'=>$resellerUser]);
        }
        return view('home');
    }
    public function create_user(Request $request){
        //return $request;
        $loggedInUser = Auth::user();

        $checkEmail = User::where('email',$request->email)->get();
        if($checkEmail->count() > 0){
            $data = [
                'status'=>'failed',
                'description'=>'Email already exists in database.'
            ];
            return response()->json($data);
        }

        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email ;
        $new_user->role= $request->role ;
        if($request->role == "R" ){
            $new_user->reseller_id = $request->reseller_id ;
        }
        if($loggedInUser->role == 'R'){
                $new_user->reseller_id = $loggedInUser->reseller_id;
            }
        $new_user->created_by = $loggedInUser->id ;
// uncomment below five lines
        // $random_password = "";
        // $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$";
        // for($i = 0; $i < 8 ; $i++){
        //     $random_password .= substr($characters, (rand() % (strlen($characters))),1);
        // }

// Delete it in production to generate random
        $random_password = "123456789";
//
        $new_user->password = Hash::make($random_password);
        $new_user->save();

        $userProfile = new UserProfile();
        $userProfile->user_id = $new_user->id;

        $reseller = Reseller::where('id',$new_user->reseller_id)->pluck('company_name');
        switch($request->role){
            case 'R':
                $userProfile->profession = $request->position;
                $userProfile->institution = $reseller;
                break;
        }
        $userProfile->save();

        // notify new user by email
        $new_user->notify(new HelloNewUser($new_user, $random_password));

        $created_user = User::where('id',$new_user->id)->with('reseller')->first();
        $data = [
            'status'=>'success',
            'user'=>$created_user
        ];

        return response()->json($data,200);


        // $all = User::all();
        // return view('admin/users')->with(['users'=>$all],['message'=>$message]);
    }
    public function edit_user(Request $request, $id){
        $loggedInUser = Auth::user();
        $edit_user = User::where('id',$id)->first();
        $old_email = null;
        $changes = 0;
        //return $request;
        // check email
        if($edit_user->email != $request->user_email){ // if user is editing email
            $checkEmail = User::where('email',$request->user_email)->get();
            if($checkEmail->count() > 0){ // if new email already exists with other user
                $data = [
                    'status'=>'failed',
                    'description'=>'Email already exists in database.'
                ];
                return response()->json($data);
            }else{ // change email to new one
                $old_email = $edit_user->email;
                $edit_user->email = $request->user_email;
                $changes++;
            }
        }
        if($edit_user->name != $request->user_name){
            $changes++;
            $edit_user->name = $request->user_name;
        }
        if($request->user_role != $edit_user->role){
            $edit_user->role = $request->user_role;
            $changes++;

            $userProfile = UserProfile::where('user_id',$id)->first();
            $reseller = Reseller::where('id',$request->reseller_id)->pluck('company_name');

            switch($request->user_role){
                case 'R':
                    $edit_user->reseller_id = $request->reseller_id ;
                    $userProfile->profession = $request->user_position;
                    $userProfile->institution = $reseller;
                    $userProfile->save();
                    break;
                case 'S':
                    $edit_user->reseller_id = null ;
                    $userProfile->profession = "Admin";
                    $userProfile->institution = "Voltea";
                    $userProfile->save();
                    break;
                default:
                    $edit_user->reseller_id = null ;
            }
        }
        if($changes == 0){
            $data = [
                'status'=>'halted',
                'description'=>'No changes found'
            ];
            return response()->json($data,200);
        }
        $edit_user->save();
        $updated_user = User::where('id',$edit_user->id)->with('reseller')->withCount('userDevices')->first();
        $data = [
            'status'=>'success',
            'user'=>$updated_user
        ];
        // notify new user by email if email is changed
        if($old_email != null)
            $edit_user->notify(new EmailUpdated($updated_user, $old_email));

        return response()->json($data,200);
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

                // link device with user and notify by email


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

    public function deleteUserById($id){
        $loggedInUser = Auth::user();

        $user = User::where('id',$id)->with('reseller')->first();
        //return $user;
        $data = [];
        switch($loggedInUser->role){
            case 'U':
                $data = [
                    'status'=>'NA',
                    'desc'=>"You are not authorized"
                ];
                return reponse()->json($data);
                break;
            case 'R': // reseller can delete only users except business owner
                switch($user->role){
                    case 'U':
                        $userProfile = UserProfile::where('user_id',$id)->delete();
                        $userDevices = UserDevices::where('user_id',$id)->delete();
                        $user->delete();
                        $data = [
                            'status'=>'Deleted!',
                            'desc'=>'Delete Successful',
                            'user'=>$user
                        ];
                        return response()->json($data);
                        break;
                    case 'R':
                        if($user->email == $user->reseller->email || $loggedInUser->email != $user->reseller->email){ // if deleting reseller is super reseller or logged user is not super reseller
                            $data = [
                                'status'=>'NA',
                                'desc'=>"You are not authorized"
                            ];
                            return reponse()->json($data);
                        }
                        $userProfile = UserProfile::where('user_id',$id)->delete();
                        $userDevices = UserDevices::where('user_id',$id)->delete();
                        $user->delete();
                        $data = [
                            'status'=>'Deleted!',
                            'desc'=>'Delete Successful',
                            'user'=>$user
                        ];
                        return response()->json($data);
                        break;
                    case 'S':
                        $data = [
                            'status'=>'NA',
                            'desc'=>"You cannot delete admins! Contact Super Admin"
                        ];
                        return response()->json($data);
                }
                break;
            case 'S':
                switch($user->role){
                    case 'U':
                    case 'R':
                        $userProfile = UserProfile::where('user_id',$id)->delete();
                        $userDevices = UserDevices::where('user_id',$id)->delete();
                        $user->delete();
                        $data = [
                            'status'=>'Deleted!',
                            'desc'=>'Delete Successful',
                            'user'=>$user
                        ];
                        return response()->json($data);
                        break;

                    case 'S':
                        $data = [
                            'status'=>'NA',
                            'desc'=>"You cannot delete admins! Only super admin can"
                        ];
                        return reponse()->json($data);
                }


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
    public function getResellersList(){
        $list = Reseller::get(['id','company_name']);
        return response()->json($list);
    }
}
