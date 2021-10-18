<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Device;
use App\Models\UserDevices;
use App\Models\Reseller;

use App\Notifications\HelloNewUser;
use App\Notifications\HelloNewReseller;

use Carbon\Carbon;

class ResellerController extends Controller
{
    //
    public function index(){
        $resellers = Reseller::orderBy('created_at','desc')->get();
        $data = [];
        foreach($resellers as $reseller){
            $resellerDevices = Device::where('reseller_id',$reseller->id)->get();
            array_push($data, ['data'=>$reseller, 'device_count'=>count($resellerDevices)]);
        }
        return view('super.resellers')->with(['resellers'=>$data]);//->with(['devices'=>$devices]);//->renderSections()['content'];
    }
    public function searchRegisteredDevice(Request $req){
        $search = Device::where([['serial_number',$req->serial_number],['device_number',$req->device_number]])->first();
        return response()->json($search);
    }

    public function addNewReseller(Request $req){
        $loggedInUser = Auth::user();
        $checkEmail = User::where('email',$req->email)->get();
        if(count($checkEmail) != 0){
            $data = [
                'status'=> 500,
                'message' => "Try another email",
            ];
            return response()->json($data);
        }

        $reseller = new Reseller();
        $reseller->company_name = $req->company_name;
        $reseller->email = $req->email;
        $reseller->address = $req->address;
        $reseller->phone = $req->phone;
        $reseller->created_by = $loggedInUser->id;

        $user = new User();
        if($reseller->save()){

            $user->name = $req->company_name;
            $user->email = $req->email;
            $user->role = 'R' ;
            $user->created_by = $loggedInUser->id ;
            $user->reseller_id = $reseller->id ;
            $random_password = "";
            $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$";
            for($i = 0; $i < 8 ; $i++){
                $random_password .= substr($characters, (rand() % (strlen($characters))),1);
            }
            $user->password = Hash::make($random_password);
            $user->save();
        }
        // notify email
        $user->notify(new HelloNewReseller($user, $random_password));

        $resellerDevices = Device::where('reseller_id',$reseller->id)->get();
        $data = [
            'status' => 201,
            'reseller' => $reseller,
            'user' =>$user,
            'reseller_device_count' => count($resellerDevices)
        ];
        return response()->json($data);
    }

    public function delete(Request $request){
        $reseller = Reseller::where('id',$request->id)->first();
        $resellerUser = User::where([['reseller_id', $request->id],['role','R']])->delete();
        $data = [
            'status'=>200,
            'data'=>$reseller->delete(),
        ];
        return $data;
    }
    public function getResellerById($id){
        $reseller = Reseller::where('id',$id)->first();
        return $reseller;//response()->json(["status"=>200,"data"=>$reseller]);
    }

    public function editReseller(Request $req){
        $reseller = Reseller::where('id',$req->reseller_id)->first();

        $reseller->company_name = $req->company_name;
        $reseller->email = $req->email;
        $reseller->phone = $req->phone;
        $reseller->address = $req->address;
        $reseller->created_by = Auth::user()->id;
        $reseller->save();

        return $reseller;

    }

    public function getResellerDevices($id){
        $resellerDevices = Device::where('reseller_id',$id)->with('latest_log')->withCount('userDevices')->get();
        return response()->json($resellerDevices);
    }
    public function getAllResellersUser(){
        $loggedInUser = Auth::user();
        $resellersUser = User::where([['reseller_id',$loggedInUser->reseller->id],['role','U']])->get();
        return response()->json($resellersUser);
    }
    // adds new device and user as well
    public function addResellerDevice(Request $req){
        $loggedInUser = Auth::user();
        $searchDevice = Device::where([['serial_number',$req->serial_number],['device_number', $req->device_number]])->with('model')->first();
        if($searchDevice == null){ //if the device is not registered in database by Super Admin
            $response =[
                'message' => 'Error',
                'description' =>'Device Not Found In Database. Please Call Voltea Office'
            ];
            return response($response);
        }
        if($searchDevice->count() >0){ // if device is registered in database by Super Admin
            if($searchDevice->reseller_id == null){ // if searched device has not been assigned to reseller before

                //search user
                $user = User::where('email',$req->user_email)->first();
                if($user == null){
                    // create new user
                    $newUser = new User();
                    $newUser->name = $req->user_name;
                    $newUser->email = $req->user_email;
                    $newUser->role = "U";
                    $newUser->address = json_encode($req->user_address);
                    $newUser->mobile = $req->user_mobile;
                    $newUser->created_by = $loggedInUser->id;
                    $newUser->reseller_id = $loggedInUser->reseller_id;
                    // uncomment below five lines for production to generate random password
                    $random_password = "";
                    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$";
                    for($i = 0; $i < 8 ; $i++){
                        $random_password .= substr($characters, (rand() % (strlen($characters))),1);
                    }

                    $newUser->password = Hash::make($random_password);
                    $newUser->save();
                    //notify user
                    $newUser->notify(new HelloNewUser($newUser, $random_password));

                    // associate device to newly created user
                    $userDevice = new UserDevices();
                    $userDevice->user_id = $newUser->id;
                    $userDevice->device_id = $searchDevice->id;
                    $userDevice->save();
                    $response =[
                        'message' => 'Success',
                        'data'=>[
                            'device'=>$searchDevice,
                            'user'=>$newUser
                        ]
                    ];
                }else{
                    $userDevice = new UserDevices();
                    $userDevice->user_id = $user->id;
                    $userDevice->device_id = $searchDevice->id;
                    $userDevice->save();
                    $response =[
                        'message' => 'Success',
                        'data'=>[
                            'device'=>$searchDevice,
                            'user'=>$user
                        ]
                    ];
                }
                // save the reseller id so that it is officially sold by the reseller
                $searchDevice->reseller_id = $loggedInUser->reseller->id;
                $searchDevice->save();

            }else{
                $response =[
                    'message' => 'Already registered',
                    'description' =>'Device is already registered to a reseller',
                    'device'=>$searchDevice
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

    // adds only device to reseller for testing purpose
    public function addNewResellerDevice(Request $req){
        $loggedInUser = Auth::user();
        $searchDevice = Device::where([['serial_number',$req->serial_number],['device_number', $req->device_number]])->with('model')->first();
        if($searchDevice == null){ //if the device is not registered in database by Super Admin
            $response =[
                'message' => 'Error',
                'description' =>'Device Not Found In Database. Please Call Voltea Office'
            ];
            return response($response);
        }
        if($searchDevice->count() >0){ // if device is registered in database by Super Admin
            if($searchDevice->reseller_id == null){ // if searched device has not been assigned to reseller before
                $searchDevice->reseller_id = $loggedInUser->reseller->id;
                $searchDevice->save();
                $response =[
                    'message' => 'Success',
                    'data'=> $searchDevice,
                ];
            }else{
                $response =[
                    'message' => 'Already registered',
                    'description' =>'Device is already registered to a reseller',
                    'device'=>$searchDevice
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
    // assign user to device by reseller
    public function assignUserDeviceByReseller(Request $req){
        $loggedInUser = Auth::user();
        $data =[];
        $searchDevice = Device::where('serial_number',$req->serial_number)->first();
        // return response($searchDevice);
        //search user
        $user = User::where('email',$req->user_email)->first();
        if($user == null){
            // create new user
            $newUser = new User();
            $newUser->name = $req->user_name;
            $newUser->email = $req->user_email;
            $newUser->role = "U";
            $newUser->address = json_encode($req->user_address);
            $newUser->mobile = $req->user_mobile;
            $newUser->created_by = $loggedInUser->id;
            $newUser->reseller_id = $loggedInUser->reseller_id;
            // uncomment below five lines for production to generate random password
            $random_password = "";
            $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$";
            for($i = 0; $i < 8 ; $i++){
                $random_password .= substr($characters, (rand() % (strlen($characters))),1);
            }

            $newUser->password = Hash::make($random_password);
            $newUser->save();
            //notify user
            $newUser->notify(new HelloNewUser($newUser, $random_password));

            // associate device to newly created user
            $userDevice = new UserDevices();
            $userDevice->user_id = $newUser->id;
            $userDevice->device_id = $searchDevice->id;
            $userDevice->save();
            $response =[
                'message' => 'Success',
                'data'=>[
                    'device'=>$searchDevice,
                    'user'=>$newUser
                ]
            ];
        }else{
            $userDevice = new UserDevices();
            $userDevice->user_id = $user->id;
            $userDevice->device_id = $searchDevice->id;
            $userDevice->save();
            $response =[
                'message' => 'Success',
                'data'=>[
                    'device'=>$searchDevice,
                    'user'=>$user
                ]
            ];
        }
        $now = Carbon::now();
        $searchDevice->installation_date = $now->toDateString();
        $searchDevice->save();
        return response()->json($response);
    }

    public function nameResellerDevice(Request $req){
        $device = Device::where('serial_number',$req->serial_number)->first();
        $device->device_name = $req->device_name;
        $device->save();
        return response()->json($device);
    }
}
