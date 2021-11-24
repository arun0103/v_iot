<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Device;
use App\Models\UserDevices;
use App\Models\RawLogs;
use App\Models\Setpoints;
use App\Models\Device_commands;
use App\Models\Device_settings;
use App\Models\DeviceSettingsLogs;
use App\Models\DeviceSetpointsChangeLog;

use App\Models\Maintenance_critic_acid;
use App\Models\Maintenance_pre_filter;
use App\Models\Maintenance_post_filter;
use App\Models\Maintenance_general_service;

use App\Notifications\MaintenanceUpdate;
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
        $device = Device::where('id',$id)->with('model')->first();
        return response()->json($device);
    }
    //Registering new devices
    public function create_device(Request $request){
        $loggedInUser = Auth::user();
        $message = null;
        $deviceCount = Device::where('serial_number',$request->serial_number)->orWhere('device_number',$request->device_number)->count();
        if($deviceCount == 0){ // if the serial number and device number are unique
            if($loggedInUser->role == 'S'){ // if user is super admin
                $device = new Device();
                $device->serial_number = $request->serial_number ;
                $device->device_number = $request->device_number ;
                $device->model_id = $request->model;
                $device->firmware = $request->firmware;
                $device->manufactured_date= date('Y-m-d',strtotime($request->manufactured_date));
                $device->created_by = $loggedInUser->id ;
                $device->save();
                $savedDevice = Device::where('id',$device->id)->with('model')->first();
                $message =[
                    'message'=>'Success',
                    'description'=> 'Device Added',
                    'data'=>$savedDevice
                ];
                // add device's maintenance settings to default value
                $device_setting = new Device_settings();
                $device_setting->device_id = $device->id;
                $device_setting->critic_acid = 25000;
                $device_setting->pre_filter = 25000;
                $device_setting->post_filter = 25000;
                $device_setting->general_service = 365;
                $device_setting->save();
                // add device's default setpoints
                $device_setpoints = new Setpoints();
                $device_setpoints->device_id = $device->id;
                $device_setpoints->pure_EC_target = 1;
                $device_setpoints->prepurify_time = 1;
                $device_setpoints->purify_time = 1;
                $device_setpoints->waste_time = 1;
                $device_setpoints->HF_waste_time = 1;
                $device_setpoints->CIP_dose = 1;
                $device_setpoints->CIP_dose_rec = 1;
                $device_setpoints->CIP_dose_total = 1;
                $device_setpoints->CIP_flow_total = 1;
                $device_setpoints->CIP_flow_flush = 1;
                $device_setpoints->CIP_flow_rec = 1;
                $device_setpoints->CIP_flush_time = 1;
                $device_setpoints->WV_check_time = 1;
                $device_setpoints->wait_HT_time = 1;
                $device_setpoints->p_flow_target = 1;
                $device_setpoints->low_flow_purify_alarm = 1;
                $device_setpoints->low_flow_waste_alarm = 1;
                $device_setpoints->CIP_cycles = 1;
                $device_setpoints->temperature_alarm = 1;
                $device_setpoints->max_CIP_prt = 1;
                $device_setpoints->pump_p_factor = 1;
                $device_setpoints->dynamic_p_factor = 1;
                $device_setpoints->p_max_volt = 1;
                $device_setpoints->w_max_volt = 1;
                $device_setpoints->w_value = 1;
                $device_setpoints->flow_k_factor = 1;
                $device_setpoints->volume_unit = 1;
                $device_setpoints->bypass_option = 1;
                $device_setpoints->start_pressure = 1;
                $device_setpoints->stop_pressure = 1;
                $device_setpoints->bypass_pressure = 1;
                $device_setpoints->CIP_pressure = 1;
                $device_setpoints->wait_time_before_CIP = 1;
                $device_setpoints->bypass_time = 1;
                $device_setpoints->save();
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
    public function saveEditedDevice($device_id, Request $req){
        $device = Device::where('id',$device_id)->with("model")->first();
        $device->model_id = $req->model_id;
        $device->serial_number = $req->serial_number;
        $device->device_number = $req->device_number;
        $device->manufactured_date = date('Y-m-d',strtotime($req->manufactured_date));
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
        if(Auth::user()->role =="S")
            $device_serial = $device_id;
        else
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
        // notify reseller and customer of device
        $device_detail = Device::where('id', $device_id)->with('userDevices')->first();
        // return response()->json($device_detail);
        if($device_detail->reseller_id != null){
            //getting device reseller detail
            $reseller = User::where([['reseller_id',$device_detail->reseller_id],['role','R']])->first();
            // send email
            $reseller->notify(new MaintenanceUpdate("General Service",$reseller));
        }
        if($device_detail->userDevices != null){
            $DeviceUsers = UserDevices::where('device_id',$device_id)->with('userDetails')->get();
            foreach($DeviceUsers as $deviceUser){
                //getting device user detail
                $user = User::where('id',$deviceUser->user_id)->first();
                $user->notify(new MaintenanceUpdate('General Service',$user));
            }
        }
        return response()->json($maintenance);
    }
    public function resetCriticAcid($device_id, $volume){
        $maintenance = new Maintenance_critic_acid();
        $maintenance->device_id = $device_id;
        $maintenance->volume_value = $volume;
        $maintenance->maintained_by = Auth::user()->id;
        $maintenance->save();
        // notify reseller and customer of device
        $device_detail = Device::where('id', $device_id)->with('userDevices')->first();
        // return response()->json($device_detail);
        if($device_detail->reseller_id != null){
            //getting device reseller detail
            $reseller = User::where([['reseller_id',$device_detail->reseller_id],['role','R']])->first();
            // send email
            $reseller->notify(new MaintenanceUpdate("Critic Acid",$reseller));
        }
        if($device_detail->userDevices != null){
            $DeviceUsers = UserDevices::where('device_id',$device_id)->with('userDetails')->get();
            foreach($DeviceUsers as $deviceUser){
                //getting device user detail
                $user = User::where('id',$deviceUser->user_id)->first();
                $user->notify(new MaintenanceUpdate('Critic Acid',$user));
            }
        }
        return response()->json($maintenance);
    }
    public function resetPreFilter($device_id, $volume){
        $maintenance = new Maintenance_pre_filter();
        $maintenance->device_id = $device_id;
        $maintenance->volume_value = $volume;
        $maintenance->maintained_by = Auth::user()->id;
        $maintenance->save();
        // notify reseller and customer of device
        $device_detail = Device::where('id', $device_id)->with('userDevices')->first();
        // return response()->json($device_detail);
        if($device_detail->reseller_id != null){
            //getting device reseller detail
            $reseller = User::where([['reseller_id',$device_detail->reseller_id],['role','R']])->first();
            // send email
            $reseller->notify(new MaintenanceUpdate("Pre-filter",$reseller));
        }
        if($device_detail->userDevices != null){
            $DeviceUsers = UserDevices::where('device_id',$device_id)->with('userDetails')->get();
            foreach($DeviceUsers as $deviceUser){
                //getting device user detail
                $user = User::where('id',$deviceUser->user_id)->first();
                $user->notify(new MaintenanceUpdate('Pre-filter',$user));
            }
        }
        return response()->json($maintenance);
    }
    public function resetPostFilter($device_id, $volume){
        $maintenance = new Maintenance_post_filter();
        $maintenance->device_id = $device_id;
        $maintenance->volume_value = $volume;
        $maintenance->maintained_by = Auth::user()->id;
        $maintenance->save();
        // notify reseller and customer of device
        $device_detail = Device::where('id', $device_id)->with('userDevices')->first();
        // return response()->json($device_detail);
        if($device_detail->reseller_id != null){
            //getting device reseller detail
            $reseller = User::where([['reseller_id',$device_detail->reseller_id],['role','R']])->first();
            // send email
            $reseller->notify(new MaintenanceUpdate("Post-filter",$reseller));
        }
        if($device_detail->userDevices != null){
            $DeviceUsers = UserDevices::where('device_id',$device_id)->with('userDetails')->get();
            foreach($DeviceUsers as $deviceUser){
                //getting device user detail
                $user = User::where('id',$deviceUser->user_id)->first();
                $user->notify(new MaintenanceUpdate('Post-filter',$user));
            }
        }
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
        $maintenance_logs = DeviceSettingsLogs::where('device_id',$device_id)->with('changerDetails:id,name,role')->orderBy('id','DESC')->get();
        $control_logs = Device_commands::where('device_id',$device_id)->with('creatorDetails:id,name,role')->orderBy('id','DESC')->get();
        $setpoints_logs = DeviceSetPointsChangeLog::where('device_id',$device_id)->with('changerDetails:id,name,role')->orderBy('id','DESC')->get();
        $notifications = [
            'maintenance'=>$maintenance_logs,
            'controls'=>$control_logs,
            'setpoints'=>$setpoints_logs
        ];
        return response()->json($notifications);
    }
}
