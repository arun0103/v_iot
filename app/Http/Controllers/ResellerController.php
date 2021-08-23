<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Device;
use App\Models\UserDevices;
use App\Models\Reseller;


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

        if($reseller->save()){
            $user = new User();
            $user->name = $reseller->company_name;
            $user->email = $reseller->email;
            $user->role = 'R' ;
            $user->created_by = $loggedInUser->id ;
            $user->reseller_id = $reseller->id ;
            $user->password = Hash::make('test123');
            $user->save();
        }
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

    public function addResellerDevice(Request $req){
        $user = Auth::user();
        $searchDevice = Device::where([['serial_number',$req->serial_number],['device_number', $req->device_number]])->first();
        if($searchDevice == null){ //if the device is not registered in database by Super Admin
            $response =[
                'message' => 'Error',
                'description' =>'Device Not Found In Database. Please Call Voltea Office'
            ];
            return response($response);
        }
        if($searchDevice->count() >0){ // if device is registered in database by Super Admin
            if($searchDevice->reseller_id == null){ // if searched device has not been assigned to reseller before
                $searchDevice->reseller_id = $user->reseller_id;
                $searchDevice->save();
                $userDevice = UserDevices::where([['user_id',$user->id],['device_id',$searchDevice->id]])->get();
                $response =[
                    'message' => 'Success',
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
