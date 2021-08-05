<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Device;
use App\Models\UserDevices;
use App\Models\Device_settings;
use App\Models\DeviceSettingsLogs;
use Auth;

class DeviceController extends Controller
{
    public function getDevices(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == 'S')
            $devices = Device::all();
        else
            $devices = UserDevices::where('user_id',$userId)->get();
        return view('devices')->with(['devices'=>$devices]);
    }
    public function getUserDevices($userId){
        $userDevices = UserDevices::where('user_id',$userId)->get();
        return view('devices')->with(['devices'=>$devices]);
    }

    public function deleteUserDevice($id){
        $loggedInUser = Auth::user();
        switch($loggedInUser->role){
            case 'S':
                //check devices has any users
                $users = UserDevices::where('device_id',$id)->pluck('user_id')->count();
                if($users>0){
                    return ['status'=>405,'message'=>"Users are still using this device"];
                }
                else{//safe to delete
                    $data = [
                        'status'=>200,
                        'data'=>Device::where('id',$id)->delete(),
                    ];
                    return $data;
                }
                break;
            case 'R':
                $device = Device::where('id', $id)->first();
                $device->reseller_id = null;
                $device->save();
                $data = [
                    'status'=>200,
                    'data'=>$device
                ];
                return $data;
                break;
            case 'U':
                $userDevice = UserDevices::where([['device_id',$id],['user_id',$loggedInUser->id]])->first();
                $data = [
                    'status'=>200,
                    'data'=>$userDevice->delete(),
                ];
                return $data;
        }
    }

    public function viewDeviceUsers($id){
        $deviceUsers = UserDevices::where('device_id',$id)->with("userDetails")->get();
        return $deviceUsers;
    }

    public function saveCriticAcid($id, Request $req){
        $test = Device_settings::where('device_id',$id)->first();
        $oldValue = $test->critic_acid;
        if($test != null){
            $test->critic_acid = $req->critic_acid;
        }
        else{
            $oldValue = -1;
            $test = new Device_settings();
            $test->device_id = $id;
            $test->critic_acid = $req->critic_acid;
        }
        $test->save();
        $log = new DeviceSettingsLogs();
        $log->device_id = $id;
        $log->parameter = "critic acid";
        $log->old_value = $oldValue;
        $log->new_value = $test->critic_acid;
        $log->changed_by = Auth::user()->id;
        $log->save();
        return response()->json($test);
    }
    public function savePreFilter($id, Request $req){
        $test = Device_settings::where('device_id',$id)->first();
        $oldValue = $test->pre_filter;
        if($test != null){
            $test->pre_filter = $req->pre_filter;
        }
        else{
            $oldValue = -1;
            $test = new Device_settings();
            $test->device_id = $id;
            $test->pre_filter = $req->pre_filter;
        }
        $test->save();
        $log = new DeviceSettingsLogs();
        $log->device_id = $id;
        $log->parameter = "pre filter";
        $log->old_value = $oldValue;
        $log->new_value = $test->pre_filter;
        $log->changed_by = Auth::user()->id;
        $log->save();
        return response()->json($test);
    }
    public function savePostFilter($id, Request $req){
        $test = Device_settings::where('device_id',$id)->first();
        $oldValue = $test->post_filter;
        if($test != null){
            $test->post_filter = $req->post_filter;
        }
        else{
            $oldValue = -1;
            $test = new Device_settings();
            $test->device_id = $id;
            $test->post_filter = $req->post_filter;
        }
        $test->save();
        $log = new DeviceSettingsLogs();
        $log->device_id = $id;
        $log->parameter = "post filter";
        $log->old_value = $oldValue;
        $log->new_value = $test->post_filter;
        $log->changed_by = Auth::user()->id;
        $log->save();
        return response()->json($test);
    }
    public function saveGeneralService($id, Request $req){
        $test = Device_settings::where('device_id',$id)->first();
        $oldValue = $test->general_service;
        if($test != null){
            $test->general_service = $req->general_service;
        }
        else{
            $oldValue = -1;
            $test = new Device_settings();
            $test->device_id = $id;
            $test->general_service = $req->general_service;
        }
        $test->save();
        $log = new DeviceSettingsLogs();
        $log->device_id = $id;
        $log->parameter = "general service";
        $log->old_value = $oldValue;
        $log->new_value = $test->general_service;
        $log->changed_by = Auth::user()->id;
        $log->save();
        return response()->json($test);
    }

}
