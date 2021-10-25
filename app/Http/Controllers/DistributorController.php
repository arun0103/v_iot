<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Device;
use App\Models\UserDevices;
use App\Models\Reseller;
use App\Models\Distributor;

use App\Notifications\HelloNewUser;
use App\Notifications\HelloNewReseller;
use App\Notifications\HelloNewDistributor;

class DistributorController extends Controller
{
    //
    function addNewDistributor(Request $req){
        $loggedInUser = Auth::user();
        $checkEmail = User::where('email',$req->email)->get();
        if(count($checkEmail) != 0){
            $data = [
                'status'=> 500,
                'message' => "Try another email",
            ];
            return response()->json($data);
        }

        $distributor = new Distributor();
        $distributor->company_name = $req->company_name;
        $distributor->email = $req->email;
        $distributor->address = $req->address;
        $distributor->phone = $req->phone;
        $distributor->created_by = $loggedInUser->id;

        $user = new User();
        if($distributor->save()){
            $user->name = $req->company_name;
            $user->email = $req->email;
            $user->role = 'D' ;
            $user->created_by = $loggedInUser->id ;
            $user->distributor_id = $distributor->id ;
            $random_password = "";
            $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$";
            for($i = 0; $i < 8 ; $i++){
                $random_password .= substr($characters, (rand() % (strlen($characters))),1);
            }
            $user->password = Hash::make($random_password);
            $user->save();
        }
        // notify email
        $user->notify(new HelloNewDistributor($user, $random_password));

        $distributorDevices = Device::where('distributor_id',$distributor->id)->get();
        $data = [
            'status' => 201,
            'distributor' => $distributor,
            'user' =>$user,
            'distributor_device_count' => count($distributorDevices)
        ];
        return response()->json($data);
    }
    function editDistributor(Request $req){
        $distributor = Distributor::where('id',$req->distributor_id)->first();

        $distributor->company_name = $req->company_name;
        $distributor->email = $req->email;
        $distributor->phone = $req->phone;
        $distributor->address = $req->address;
        $distributor->created_by = Auth::user()->id;
        $distributor->save();

        return $distributor;
    }
    public function deleteDistributor(Request $request){
        $distributor = Distributor::where('id',$request->id)->first();
        $distributorUser = User::where([['distributor_id', $request->id],['role','D']])->first();
        if($distributorUser != null)
            $distributorUser->delete();
        $data = [
            'status'=>200,
            'data'=>$distributor->delete(),
        ];
        return $data;
    }
    public function getDistributorById($id){
        $distributor = Distributor::where('id',$id)->first();
        return $distributor;//response()->json(["status"=>200,"data"=>$reseller]);
    }
    public function distributorResellers($id){
        $resellers = Reseller::where('distributor_id',$id)->get();
        return response()->json($resellers);
    }
    // adds only device to Distributor for testing purpose
    public function addNewDistributorDevice(Request $req){
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
            if($searchDevice->distributor_id == null){ // if searched device has not been assigned to reseller before
                $searchDevice->distributor_id = $loggedInUser->distributor->id;
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
}
