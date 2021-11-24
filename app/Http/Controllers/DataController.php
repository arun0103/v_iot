<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Device;
use App\Models\UserDevices;
use App\Models\Setpoints;
use App\Models\RawLogs;
use App\Models\Device_commands;
use App\Models\DeviceSetpointsChangeLog;
use Carbon\Carbon;
use Auth;

class DataController extends Controller
{
    // for super admin
    public function refreshDashboardData(){
        $devices = Device::with('latest_log','setpoints','latest_maintenance_critic_acid','latest_maintenance_pre_filter','latest_maintenance_post_filter','latest_maintenance_general_service','device_settings')->get();
        // return response()->json($devices);
        $today = date(Carbon::now());
        $thirtyOnedays = date(Carbon::now()->subDays(31));
        $previousDay = date(Carbon::now()->subDays(1));
        // $allDevices= Device::with(['logs'=>function($query) use($thirtyOnedays, $today){
        //     $query->orderBy('id','Desc')->first();
        // }])->get();
        $dataToSend =[];
        $volume = [];
        // get the first data and last data of tpv and subtract to get the monthly volume
        foreach($devices as $device){
            if($device->latest_log != null){
                // calculate daily volume
                $daily_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$previousDay,$today])->get();
                $daily_logs_count = count($daily_logs);
                $daily_volume = 0;
                if($daily_logs_count !=0){
                    $latest_tpv = $daily_logs[$daily_logs_count -1]->tpv;
                    $last_tpv = $daily_logs[0]->tpv;
                    $daily_volume = ($latest_tpv -$last_tpv)*0.2642007926;
                }
                $daily_logs =[];
                //calculate monthly volume
                $monthly_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$thirtyOnedays,$today])->get();
                $monthly_logs_count = count($monthly_logs);
                $monthly_volume = 0;
                if($monthly_logs_count !=0){
                    $latest_tpv = $monthly_logs[$monthly_logs_count-1]->tpv;
                    $last_tpv = $monthly_logs[0]->tpv;
                    $monthly_volume = ($latest_tpv -$last_tpv)*0.2642007926;
                }
                $monthly_logs = [];
                //calculate total volume
                $last_record = RawLogs::where('serial_number',$device->serial_number)->orderBy('id','Desc')->first();
                $total_volume = $last_record->tpv*0.2642007926;
                if($monthly_volume > $total_volume || $monthly_volume < 0){
                    $monthly_volume = $total_volume;
                }
                if($daily_volume >$total_volume || $daily_volume <0){
                    $daily_volume = $total_volume;
                }
                $volume = [
                    'daily'=>round($daily_volume,2),
                    'monthly'=>round($monthly_volume,2),
                    'total'=>round($total_volume,2)
                ];
                $last_record = null;
            }
            $deviceData = [
                'deviceDetails'=>$device,
                'deviceVolume'=>$volume
            ];
            array_push($dataToSend, $deviceData);
        }
        return response()->json($dataToSend);
    }
    public function refreshStatusData($id){
        $device = Device::where('id',$id)->with('latest_log:serial_number,log_dt,step,ec,tpv,alarm,pressure,created_at','setpoints','latest_maintenance_critic_acid','latest_maintenance_pre_filter','latest_maintenance_post_filter','latest_maintenance_general_service','device_settings')->first();
        $today = date(Carbon::now());
        $thirtyOnedays = date(Carbon::now()->subDays(31));
        $previousDay = date(Carbon::now()->subDays(1));
        $volume = [];
        if($device->latest_log != null){
            // calculate daily volume
            $daily_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$previousDay,$today])->get();
            $daily_logs_count = count($daily_logs);
            $daily_volume = 0;
            if($daily_logs_count !=0){
                $latest_tpv = $daily_logs[$daily_logs_count -1]->tpv;
                $last_tpv = $daily_logs[0]->tpv;
                $daily_volume = ($latest_tpv -$last_tpv)*0.2642007926;
            }
            $daily_logs =[];
            //calculate monthly volume
            $monthly_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$thirtyOnedays,$today])->get();
            $monthly_logs_count = count($monthly_logs);
            $monthly_volume = 0;
            if($monthly_logs_count !=0){
                $latest_tpv = $monthly_logs[$monthly_logs_count-1]->tpv;
                $last_tpv = $monthly_logs[0]->tpv;
                $monthly_volume = ($latest_tpv -$last_tpv)*0.2642007926;
            }
            $monthly_logs = [];
            //calculate total volume
            $last_record = RawLogs::where('serial_number',$device->serial_number)->orderBy('id','Desc')->first();
            $total_volume = $last_record->tpv*0.2642007926;
            if($monthly_volume > $total_volume || $monthly_volume < 0){
                $monthly_volume = $total_volume;
            }
            if($daily_volume >$total_volume || $daily_volume <0){
                $daily_volume = $total_volume;
            }
            $volume = [
                'daily'=>round($daily_volume,2),
                'monthly'=>round($monthly_volume,2),
                'total'=>round($total_volume,2)
            ];
            $last_record = null;
        }
        $deviceData = [
            'deviceDetails'=>$device,
            'deviceVolume'=>$volume
        ];
        return response()->json($deviceData);
    }
    public function refreshStatusData_super($id){
        $device = Device::where('serial_number',$id)->with('latest_log:serial_number,log_dt,step,ec,tpv,alarm,pressure,created_at','setpoints','latest_maintenance_critic_acid','latest_maintenance_pre_filter','latest_maintenance_post_filter','latest_maintenance_general_service','device_settings')->first();
        $today = date(Carbon::now());
        $thirtyOnedays = date(Carbon::now()->subDays(31));
        $previousDay = date(Carbon::now()->subDays(1));
        $volume = [];
        if($device->latest_log != null){
            // calculate daily volume
            $daily_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$previousDay,$today])->get();
            $daily_logs_count = count($daily_logs);
            $daily_volume = 0;
            if($daily_logs_count !=0){
                $latest_tpv = $daily_logs[$daily_logs_count -1]->tpv;
                $last_tpv = $daily_logs[0]->tpv;
                $daily_volume = ($latest_tpv -$last_tpv)*0.2642007926;
            }
            $daily_logs =[];
            //calculate monthly volume
            $monthly_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$thirtyOnedays,$today])->get();
            $monthly_logs_count = count($monthly_logs);
            $monthly_volume = 0;
            if($monthly_logs_count !=0){
                $latest_tpv = $monthly_logs[$monthly_logs_count-1]->tpv;
                $last_tpv = $monthly_logs[0]->tpv;
                $monthly_volume = ($latest_tpv -$last_tpv)*0.2642007926;
            }
            $monthly_logs = [];
            //calculate total volume
            $last_record = RawLogs::where('serial_number',$device->serial_number)->orderBy('id','Desc')->first();
            $total_volume = $last_record->tpv*0.2642007926;
            if($monthly_volume > $total_volume || $monthly_volume < 0){
                $monthly_volume = $total_volume;
            }
            if($daily_volume >$total_volume || $daily_volume <0){
                $daily_volume = $total_volume;
            }
            $volume = [
                'daily'=>round($daily_volume,2),
                'monthly'=>round($monthly_volume,2),
                'total'=>round($total_volume,2)
            ];
            $last_record = null;
        }
        $deviceData = [
            'deviceDetails'=>$device,
            'deviceVolume'=>$volume
        ];
        return response()->json($deviceData);
    }
    public function refreshDashboardRows(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == "S"){
            $devices = Device::with('latest_log:serial_number,log_dt,ec,step,alarm,created_at','setpoints:device_id,pure_EC_target')->get();
        }else{
            $devices = Device::where('reseller_id',$loggedInUser->reseller_id)->with('latest_log:serial_number,log_dt,ec,step,alarm,created_at','setpoints:device_id,pure_EC_target')->get();
        }
        return response()->json($devices);

    }
    // for new dashboard super and resellers to count the devices and categorize
    public function refreshDashboardCounts(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == "S"){
            $devices = Device::with('latest_log:serial_number,log_dt,ec,step,alarm,created_at','setpoints:device_id,pure_EC_target')->get();
            $grouped_data = [];
            $idle_count = 0;
            $running_count = 0;
            $standby_count = 0;
            $disconnected_count = 0;
            foreach($devices as $device){
                if($device->latest_log != null){
                    switch($device->latest_log->step){
                        case 0:
                        case 1:
                        case 13:
                            $idle_count++;
                            break;
                        case 6:
                            $standby_count++;break;
                        default:
                            $running_count++;
                    }
                }else{
                    $disconnected_count++;
                }
            }
            $counts = [
                'idle'=>$idle_count,
                'running'=>$running_count,
                'standby'=>$standby_count,
                'disconnected'=>$disconnected_count
            ];
            return response()->json($counts);
        }else{
            $devices = Device::where('reseller_id',$loggedInUser->reseller_id)->with('latest_log:serial_number,log_dt,ec,step,alarm,created_at','setpoints:device_id,pure_EC_target')->get();
        }
        return response()->json($devices);

    }
    //for user
    public function refreshUserDashboardData(){
        $userDevicesIDs = UserDevices::where('user_id',Auth::user()->id)->pluck('device_id');
        //return response()->json($userDevicesIDs);
        $devices = Device::whereIn('id',$userDevicesIDs)->with('latest_log:serial_number,log_dt,created_at,ec,tpv,alarm,step','setpoints:device_id,pure_EC_target,volume_unit','latest_maintenance_critic_acid','latest_maintenance_pre_filter','latest_maintenance_post_filter','latest_maintenance_general_service','device_settings')->get();
        // return response()->json($devices);
        $today = date(Carbon::now());
        $thirtyOnedays = date(Carbon::now()->subDays(31));
        $previousDay = date(Carbon::now()->subDays(1));
        // $allDevices= Device::with(['logs'=>function($query) use($thirtyOnedays, $today){
        //     $query->orderBy('id','Desc')->first();
        // }])->get();
        $dataToSend =[];
        $volume = [];
        // get the first data and last data of tpv and subtract to get the monthly volume
        foreach($devices as $device){
            if($device->latest_log != null){
                // calculate daily volume
                $daily_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$previousDay,$today])->get();
                $daily_logs_count = count($daily_logs);
                $daily_volume = 0;
                if($daily_logs_count !=0){
                    $latest_tpv = $daily_logs[$daily_logs_count -1]->tpv;
                    $last_tpv = $daily_logs[0]->tpv;
                    $daily_volume = ($latest_tpv -$last_tpv)*0.2642007926;
                }
                $daily_logs =[];
                //calculate monthly volume
                $monthly_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$thirtyOnedays,$today])->get();
                $monthly_logs_count = count($monthly_logs);
                $monthly_volume = 0;
                if($monthly_logs_count !=0){
                    $latest_tpv = $monthly_logs[$monthly_logs_count-1]->tpv;
                    $last_tpv = $monthly_logs[0]->tpv;
                    $monthly_volume = ($latest_tpv -$last_tpv)*0.2642007926;
                }
                $monthly_logs = [];
                //calculate total volume
                $last_record = RawLogs::where('serial_number',$device->serial_number)->orderBy('id','Desc')->first();
                $total_volume = $last_record->tpv*0.2642007926;
                if($monthly_volume > $total_volume || $monthly_volume < 0){
                    $monthly_volume = $total_volume;
                }
                if($daily_volume >$total_volume || $daily_volume <0){
                    $daily_volume = $total_volume;
                    $monthly_volume = $total_volume;
                }
                $volume = [
                    'daily'=>round($daily_volume,2),
                    'monthly'=>round($monthly_volume,2),
                    'total'=>round($total_volume,2)
                ];
                $last_record = null;
            }
            $deviceData = [
                'deviceDetails'=>$device,
                'deviceVolume'=>$volume
            ];
            array_push($dataToSend, $deviceData);
        }
        return response()->json($dataToSend);
    }
    public function getUserDevicesSetpointsForCalculation(){
        $dataToSend = [];
        if(Auth::user()->role == "U" ||Auth::user()->role == "R"){
            $userDevices = UserDevices::where('user_id',Auth::user()->id)->with('setpoints')->get();
            foreach($userDevices as $device){
                $data = [
                    'device_id'=>$device->device_id,
                    'volume_unit'=>$device->setpoints[0]->volume_unit,
                    'CIP_cycles'=>$device->setpoints[0]->CIP_cycles
                ];
                array_push($dataToSend, $data);
            }
        }else if(Auth::user()->role == "S"){
            $userDevices = Device::with('setpoints')->get();
            foreach($userDevices as $device){
                $data = [
                    'device_id'=>$device->id,
                    'volume_unit'=>$device->setpoints->volume_unit,
                    'CIP_cycles'=>$device->setpoints->CIP_cycles
                ];
                array_push($dataToSend, $data);
            }
        }
        return response()->json($dataToSend);
    }
    public function getDeviceSetpointsForCalculation($device_id){
        if(Auth::user()->role =='S')
            $device_setpoints = Device::where('serial_number',$device_id)->with('setpoints')->first();
        else
            $device_setpoints = Device::where('id',$device_id)->with('setpoints')->first();
        $dataToSend = [
            'device_id'=>$device_setpoints->id,
            'volume_unit'=>$device_setpoints->setpoints->volume_unit,
            'CIP_cycles'=>$device_setpoints->setpoints->CIP_cycles,
            'pure_EC_target'=>$device_setpoints->setpoints->pure_EC_target
        ];
        return response()->json($dataToSend);
    }
    public function getDeviceAlarms($device_id){
        $device = Device::where('id',$device_id)->first();
        $allAlarms = RawLogs::where('serial_number',$device->serial_number)
                        ->groupBy(['id','log_dt','alarm'])->orderBy('log_dt','desc')->get(['id','log_dt','alarm']);
        //return response()->json($allAlarms);
        $dataToSend =[];

        $alarm_start_timestamp = $allAlarms[count($allAlarms)-1]->log_dt;
        $alarm_end_timestamp = $alarm_start_timestamp;
        // return response()->json($allAlarms);
        for($i=count($allAlarms)-1; $i>0; $i--){
            $data = $allAlarms[$i];
            if($allAlarms[$i]->alarm == $allAlarms[$i-1]->alarm){
                continue;
            }else{
                $alarm_end_timestamp = $allAlarms[$i-1]->log_dt;
                $data = [
                    'start'=>$alarm_start_timestamp,
                    'end' =>$alarm_end_timestamp,
                    'alarms'=>$allAlarms[$i]->alarm
                ];
                array_push($dataToSend,$data);
                $alarm_start_timestamp = $alarm_end_timestamp;
            }
        }
        if(count($allAlarms) ==1){
            $data =[
                'start' =>$alarm_start_timestamp,
                'end' =>$alarm_end_timestamp,
                'alarms' =>$allAlarms[0]->alarm
            ];
            array_push($dataToSend, $data);
        }
        return response()->json($dataToSend);
    }

    // get the setpoints of a device having id
    public function getDeviceSetpoints($id){
        $setpoints = Setpoints::where('device_id',$id)->first();
        return response()->json($setpoints);
    }
    public function setDeviceSetpoints($id, Request $req){
        $setpoints = Setpoints::where('device_id',$id)->first();
        if($setpoints == null){
            return response()->json(['message'=>'No previous setpoints found',400]);
        }else{
            if($setpoints->pure_EC_target != $req->pure_EC_target){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Pure EC Target";
                $log->old_value = $setpoints->pure_EC_target;
                $log->new_value = $req->pure_EC_target;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->prepurify_time != $req->prepurify_time){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Prepurify Time";
                $log->old_value = $setpoints->prepurify_time;
                $log->new_value = $req->prepurify_time;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->purify_time != $req->purify_time){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Purify Time";
                $log->old_value = $setpoints->purify_time;
                $log->new_value = $req->purify_time;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->waste_time != $req->waste_time){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Waste Time";
                $log->old_value = $setpoints->waste_time;
                $log->new_value = $req->waste_time;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->HF_waste_time != $req->HF_waste_time){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "HF Waste Time";
                $log->old_value = $setpoints->HF_waste_time;
                $log->new_value = $req->HF_waste_time;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_dose != $req->CIP_dose){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "CIP Dose";
                $log->old_value = $setpoints->CIP_dose;
                $log->new_value = $req->CIP_dose;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_dose_rec != $req->CIP_dose_rec){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "CIP Dose Rec";
                $log->old_value = $setpoints->CIP_dose_rec;
                $log->new_value = $req->CIP_dose_rec;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_dose_total != $req->CIP_dose_total){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "CIP Dose Total";
                $log->old_value = $setpoints->CIP_dose_total;
                $log->new_value = $req->CIP_dose_total;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_flow_total != $req->CIP_flow_total){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "CIP Flow Total";
                $log->old_value = $setpoints->CIP_flow_total;
                $log->new_value = $req->CIP_flow_total;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_flow_flush != $req->CIP_flow_flush){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "CIP Flow Flush";
                $log->old_value = $setpoints->CIP_flow_flush;
                $log->new_value = $req->CIP_flow_flush;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_flow_rec != $req->CIP_flow_rec){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "CIP Flow Rec";
                $log->old_value = $setpoints->CIP_flow_rec;
                $log->new_value = $req->CIP_flow_rec;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_flush_time != $req->CIP_flush_time){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "CIP Flush Time";
                $log->old_value = $setpoints->CIP_flush_time;
                $log->new_value = $req->CIP_flush_time;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->WV_check_time != $req->WV_check_time){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "WV Check Time";
                $log->old_value = $setpoints->WV_check_time;
                $log->new_value = $req->WV_check_time;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->wait_HT_time != $req->wait_HT_time){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Wait HT Time";
                $log->old_value = $setpoints->wait_HT_time;
                $log->new_value = $req->wait_HT_time;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->p_flow_target != $req->p_flow_target){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "P Flow Target";
                $log->old_value = $setpoints->p_flow_target;
                $log->new_value = $req->p_flow_target;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->low_flow_purify_alarm != $req->low_flow_purify_alarm){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Low Flow Purify Alarm";
                $log->old_value = $setpoints->low_flow_purify_alarm;
                $log->new_value = $req->low_flow_purify_alarm;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->low_flow_waste_alarm != $req->low_flow_waste_alarm){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Low Flow Waste Alarm";
                $log->old_value = $setpoints->low_flow_waste_alarm;
                $log->new_value = $req->low_flow_waste_alarm;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_cycles != $req->CIP_cycles){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "CIP Cycles";
                $log->old_value = $setpoints->CIP_cycles;
                $log->new_value = $req->CIP_cycles;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->temperature_alarm != $req->temperature_alarm){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Temperature Alarm";
                $log->old_value = $setpoints->temperature_alarm;
                $log->new_value = $req->temperature_alarm;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->max_CIP_prt != $req->max_CIP_prt){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Max CIP Prt";
                $log->old_value = $setpoints->max_CIP_prt;
                $log->new_value = $req->max_CIP_prt;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->pump_p_factor != $req->pump_p_factor){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Pump P Factor";
                $log->old_value = $setpoints->pump_p_factor;
                $log->new_value = $req->pump_p_factor;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->dynamic_p_factor != $req->dynamic_p_factor){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Dynamic P Factor";
                $log->old_value = $setpoints->dynamic_p_factor;
                $log->new_value = $req->dynamic_p_factor;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->p_max_volt != $req->p_max_volt){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "P Max Volt";
                $log->old_value = $setpoints->p_max_volt;
                $log->new_value = $req->p_max_volt;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->w_max_volt != $req->w_max_volt){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "W Max Volt";
                $log->old_value = $setpoints->w_max_volt;
                $log->new_value = $req->w_max_volt;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->w_value != $req->w_value){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "W Value";
                $log->old_value = $setpoints->w_value;
                $log->new_value = $req->w_value;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->flow_k_factor != $req->flow_k_factor){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Flow k Factor";
                $log->old_value = $setpoints->flow_k_factor;
                $log->new_value = $req->flow_k_factor;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->volume_unit != $req->volume_unit){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Volume Unit";
                $log->old_value = $setpoints->volume_unit;
                $log->new_value = $req->volume_unit;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->bypass_option != $req->bypass_option){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Bypass Option";
                $log->old_value = $setpoints->bypass_option;
                $log->new_value = $req->bypass_option;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->start_pressure != $req->start_pressure){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Start Pressure";
                $log->old_value = $setpoints->start_pressure;
                $log->new_value = $req->start_pressure;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->stop_pressure != $req->stop_pressure){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Stop Pressure";
                $log->old_value = $setpoints->stop_pressure;
                $log->new_value = $req->stop_pressure;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->bypass_pressure != $req->bypass_pressure){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Bypass Pressure";
                $log->old_value = $setpoints->bypass_pressure;
                $log->new_value = $req->bypass_pressure;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_pressure != $req->CIP_pressure){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "CIP Pressure";
                $log->old_value = $setpoints->CIP_pressure;
                $log->new_value = $req->CIP_pressure;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->wait_time_before_CIP != $req->wait_time_before_CIP){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $id;
                $log->parameter = "Wait Time Before CIP";
                $log->old_value = $setpoints->wait_time_before_CIP;
                $log->new_value = $req->wait_time_before_CIP;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            $setpoints->pure_EC_target = $req->pure_EC_target;
            $setpoints->prepurify_time = $req->prepurify_time;
            $setpoints->purify_time = $req->purify_time;
            $setpoints->waste_time = $req->waste_time;
            $setpoints->HF_waste_time = $req->HF_waste_time;
            $setpoints->CIP_dose = $req->CIP_dose;
            $setpoints->CIP_dose_rec = $req->CIP_dose_rec;
            $setpoints->CIP_dose_total = $req->CIP_dose_total;
            $setpoints->CIP_flow_total = $req->CIP_flow_total;
            $setpoints->CIP_flow_flush = $req->CIP_flow_flush;
            $setpoints->CIP_flow_rec = $req->CIP_flow_rec;
            $setpoints->CIP_flush_time = $req->CIP_flush_time;
            $setpoints->WV_check_time = $req->WV_check_time;
            $setpoints->wait_HT_time = $req->wait_HT_time;
            $setpoints->p_flow_target = $req->p_flow_target;
            $setpoints->low_flow_purify_alarm = $req->low_flow_purify_alarm;
            $setpoints->low_flow_waste_alarm = $req->low_flow_waste_alarm;
            $setpoints->CIP_cycles = $req->CIP_cycles;
            $setpoints->temperature_alarm = $req->temperature_alarm;
            $setpoints->max_CIP_prt = $req->max_CIP_prt;
            $setpoints->pump_p_factor = $req->pump_p_factor;
            $setpoints->dynamic_p_factor = $req->dynamic_p_factor;
            $setpoints->p_max_volt = $req->p_max_volt;
            $setpoints->w_max_volt = $req->w_max_volt;
            $setpoints->w_value = $req->w_value;
            $setpoints->flow_k_factor = $req->flow_k_factor;
            $setpoints->volume_unit = $req->volume_unit;
            $setpoints->bypass_option = $req->bypass_option;
            $setpoints->start_pressure = $req->start_pressure;
            $setpoints->stop_pressure = $req->stop_pressure;
            $setpoints->bypass_pressure = $req->bypass_pressure;
            $setpoints->CIP_pressure = $req->CIP_pressure;
            $setpoints->wait_time_before_CIP = $req->wait_time_before_CIP;

            $setpoints->save();

            $deviceCommand = new Device_commands();
            $deviceCommand->device_id = $id;
            $deviceCommand->command = "Setpoint";
            $deviceCommand->created_by = Auth::user()->id;
            $deviceCommand->save();

            return response()->json($setpoints,200);

        }
    }
    public function setUserDeviceSetpoints(Request $req){
        $setpoints = Setpoints::where('device_id',$req->device_id)->first();
        if($setpoints == null){
            return response()->json(['message'=>'No previous setpoints found',400]);
        }else{
            if($setpoints->pure_EC_target != $req->pure_EC_target){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $req->device_id;
                $log->parameter = "Pure EC Target";
                $log->old_value = $setpoints->pure_EC_target;
                $log->new_value = $req->pure_EC_target;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            if($setpoints->CIP_cycles != $req->CIP_cycles){
                $log = new DeviceSetpointsChangeLog();
                $log->device_id = $req->device_id;
                $log->parameter = "CIP Cycles";
                $log->old_value = $setpoints->CIP_cycles;
                $log->new_value = $req->CIP_cycles;
                $log->changed_by = Auth::user()->id;
                $log->save();
            }
            $setpoints->pure_EC_target = $req->pure_EC_target;
            $setpoints->CIP_cycles = $req->CIP_cycles;
            $setpoints->save();

            $deviceCommand = new Device_commands();
            $deviceCommand->device_id = $req->device_id;
            $deviceCommand->command = "Setpoint";
            $deviceCommand->created_by = Auth::user()->id;
            $deviceCommand->save();

            return response()->json($setpoints,200);
        }

    }

    public function getPureECTarget($id){
        $pureECtarget = Setpoints::where('device_id',$id)->pluck('pure_EC_target');
        return response()->json($pureECtarget);
    }

    public function getVolumeHour($device_id){
        $now = Carbon::now();
        $oneHourEarlier = $now->subHours(1);
        $timeFrom = $oneHourEarlier;
        $from = $timeFrom;
        $graph_labels = [];
        $graph_data = [];
        $device_detail = Device::where('id', $device_id)->first();
        for($i = 0; $i<6;$i++){
            $label = $from->hour . ":" . ($from->minute<10?("0".$from->minute):$from->minute );
            $to = $timeFrom->addMinutes(10);
            $dataFrom = RawLogs::where('serial_number',$device_detail->serial_number)->where('log_dt','>=',$from)->first();
            $dataTo = RawLogs::where('serial_number',$device_detail->serial_number)->where('log_dt','<=',$to)->orderBy('log_dt','desc')->first();
            $label .=  "-" . $to->hour . ":" .($to->minute<10?("0".$to->minute):$to->minute);
            if($dataFrom!=null && $dataTo!=null)
                $volume = $dataFrom->tpv - $dataTo->tpv;
            else
                $volume = 0;
            array_push($graph_labels,$label);
            array_push($graph_data, $volume);
            $from = $to;
        }
        $data_to_send = [
            'graph_labels'=>$graph_labels,
            'graph_data'=>$graph_data
        ];
        return response()->json($data_to_send);
    }
    public function getVolume24Hour($device_id){
        $now = Carbon::now();
        $oneHourEarlier = $now->subHours(24);
        $timeFrom = $oneHourEarlier;
        $from = $timeFrom;
        $graph_labels = [];
        $graph_data = [];
        $device_detail = Device::where('id', $device_id)->first();
        for($i = 0; $i<6;$i++){
            $label = $from->hour . ":" . ($from->minute<10?("0".$from->minute):$from->minute );
            $to = $timeFrom->addHours(2);
            $dataFrom = RawLogs::where('serial_number',$device_detail->serial_number)->where('log_dt','>=',$from)->first();
            $dataTo = RawLogs::where('serial_number',$device_detail->serial_number)->where('log_dt','<=',$to)->orderBy('log_dt','desc')->first();
            $label .=  "-" . $to->hour . ":" .($to->minute<10?("0".$to->minute):$to->minute);
            if($dataFrom!=null && $dataTo!=null)
                $volume = $dataFrom->tpv - $dataTo->tpv;
            else
                $volume = 0;
            array_push($graph_labels,$label);
            array_push($graph_data, $volume);
            $from = $to;
        }
        $data_to_send = [
            'graph_labels'=>$graph_labels,
            'graph_data'=>$graph_data
        ];
        return response()->json($data_to_send);
    }
    public function getDeviceRelayStatus($device_id){
        $device_detail = Device::where('id', $device_id)->first();
        $data = RawLogs::where('serial_number',$device_detail->serial_number)->orderBy('id','DESC')->first();
        if($data != null)
            return response()->json($data->output);
        else
            return response()->json(65535);


    }
    public function getDeviceLatestLog($id){
        $deviceDetail = Device::where('serial_number',$id)->with(['logs' =>function($query){
            $query->orderBy("id",'DESC')->first();
        }])->with('setpoints')->first();
        return response()->json($deviceDetail);
    }

    public function getIdleDevices(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == "S"){
            $devices = Device::whereHas('latest_log', function ($query) {
                $query->whereIn('step', [0,1,13]);
            })->with(['model'])->with('latest_log')->with(['userDevices','setpoints'])->get();
            $response = [
                'data'=>$devices
            ];
            return response()->json($response);
        }
    }
    public function getRunningDevices(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == "S"){
            $devices = Device::whereHas('latest_log',function($query){
                $query->whereIn('step',[2,3,4,5,7,8,9,10,11,12,14,15]);
            })->with(['model'])->with(['userDevices','setpoints'])->get();
            $response = [
                'data'=>$devices
            ];
            return response()->json($response);
        }
    }
    public function getStandByDevices(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == "S"){
            $devices = Device::whereHas('latest_log',function($query){
                $query->where('step',6);
            })->has('latest_log')->with(['model'])->with(['userDevices','setpoints'])->get();
            $response = [
                'data'=>$devices
            ];
            return response()->json($response);
        }
    }
    public function getDisconnectedDevices(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == "S"){
            $devices = Device::doesntHave('latest_log')->with(['model'])->with(['userDevices','setpoints'])->get();
            $response = [
                'data'=>$devices
            ];
            return response()->json($response);
        }
    }
}
