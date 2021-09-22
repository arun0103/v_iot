<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Device;
use App\Models\UserDevices;
use App\Models\RawLogs;
use App\Models\Device_commands;
use App\Models\Device_settings;
use App\Models\DeviceSettingsLogs;
use App\Models\DeviceSetpointsChangeLog;

use App\Models\Maintenance_critic_acid;
use App\Models\Maintenance_pre_filter;
use App\Models\Maintenance_post_filter;
use App\Models\Maintenance_general_service;
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
    public function getDeviceDetails($id){
        $device = Device::where('id',$id)->first();
        return response()->json($device);
    }
    public function saveEditedDevice($device_id, Request $req){
        $device = Device::where('id',$device_id)->first();
        $device->model_id = $req->model_id;
        $device->serial_number = $req->serial_number;
        $device->device_number = $req->device_number;
        $device->manufactured_date = $req->manufactured_date;
        $device->firmware = $req->firmware;
        $device->save();
        return response()->json($device);
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
                $associatedUsers = UserDevices::where('device_id',$device->id)->get();
                foreach($associatedUsers as $user)
                    $user->delete();
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

        if($test != null){
            $oldValue = $test->critic_acid;
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
        $log->parameter = "Critic acid";
        $log->old_value = $oldValue;
        $log->new_value = $test->critic_acid;
        $log->changed_by = Auth::user()->id;
        $log->save();
        return response()->json($test);
    }
    public function savePreFilter($id, Request $req){
        $test = Device_settings::where('device_id',$id)->first();
        if($test != null){
            $oldValue = $test->pre_filter;
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
        $log->parameter = "Pre filter";
        $log->old_value = $oldValue;
        $log->new_value = $test->pre_filter;
        $log->changed_by = Auth::user()->id;
        $log->save();
        return response()->json($test);
    }
    public function savePostFilter($id, Request $req){
        $test = Device_settings::where('device_id',$id)->first();
        if($test != null){
            $oldValue = $test->post_filter;
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
        $log->parameter = "Post filter";
        $log->old_value = $oldValue;
        $log->new_value = $test->post_filter;
        $log->changed_by = Auth::user()->id;
        $log->save();
        return response()->json($test);
    }
    public function saveGeneralService($id, Request $req){
        $test = Device_settings::where('device_id',$id)->first();
        if($test != null){
            $oldValue = $test->general_service;
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
        $log->parameter = "General service";
        $log->old_value = $oldValue;
        $log->new_value = $test->general_service;
        $log->changed_by = Auth::user()->id;
        $log->save();
        return response()->json($test);
    }

    public function getLiveData($device_id){
        $device_serial = Device::where('id',$device_id)->pluck('serial_number');
        $data = RawLogs::where('serial_number',$device_serial)->orderBy('log_dt','desc')->first();
        return response()->json($data);
    }
    // function to delete access of user to a device
    public function deleteUserAccessFromDevice($user_device_id){
        $userDevice = UserDevices::where('id',$user_device_id)->first();
        $device_id = $userDevice->device_id;
        $userDevice->delete();
        $check = UserDevices::where('id',$user_device_id)->get();
        if (count($check) <1)
            return response()->json(["deleted",$device_id]);
        else
            return response()->json("error");
    }

    //function to reset general service of device
    public function resetGeneralService($device_id, $volume){
        $maintenance = new Maintenance_general_service();
        $maintenance->device_id = $device_id;
        $maintenance->volume_value = $volume;
        $maintenance->maintained_by = Auth::user()->id;
        $maintenance->save();
        return response()->json($maintenance);
    }
    public function resetCriticAcid($device_id, $volume){
        $maintenance = new Maintenance_critic_acid();
        $maintenance->device_id = $device_id;
        $maintenance->volume_value = $volume;
        $maintenance->maintained_by = Auth::user()->id;
        $maintenance->save();
        return response()->json($maintenance);
    }
    public function resetPreFilter($device_id, $volume){
        $maintenance = new Maintenance_pre_filter();
        $maintenance->device_id = $device_id;
        $maintenance->volume_value = $volume;
        $maintenance->maintained_by = Auth::user()->id;
        $maintenance->save();
        return response()->json($maintenance);
    }
    public function resetPostFilter($device_id, $volume){
        $maintenance = new Maintenance_post_filter();
        $maintenance->device_id = $device_id;
        $maintenance->volume_value = $volume;
        $maintenance->maintained_by = Auth::user()->id;
        $maintenance->save();
        return response()->json($maintenance);
    }
    // function to send get setpoints commands to all the users devices
    public function getMyDevicesSetpoints(){
        $command_ids =[];
        $userDevices = UserDevices::where('user_id',Auth::user()->id)->get();
        //return response()->json($userDevices);
        foreach($userDevices as $device){
            $command = new Device_commands();
            $command->device_id = $device->device_id;
            $command->command = "Setpoints-get";
            $command->save();
            array_push($command_ids,$command->id);
        }
        // return response()->json($command_ids);
    }
    // function to get device notifications
    public function getDeviceNotifications($device_id){
        $maintenance_logs = DeviceSettingsLogs::where('device_id',$device_id)->with('changerDetails:id,name,role')->get();
        $control_logs = Device_commands::where('device_id',$device_id)->with('creatorDetails:id,name,role')->get();
        $setpoints_logs = DeviceSetPointsChangeLog::where('device_id',$device_id)->with('changerDetails:id,name,role')->get();
        $notifications = [
            'maintenance'=>$maintenance_logs,
            'controls'=>$control_logs,
            'setpoints'=>$setpoints_logs
        ];
        return response()->json($notifications);
    }
}
