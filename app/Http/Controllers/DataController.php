<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Device;
use App\Models\Setpoints;
use App\Models\RawLogs;
use App\Models\Device_commands;
use Carbon\Carbon;

class DataController extends Controller
{
    //
    public function getAllDeviceLatestDataEvery15Seconds(){
        $device = Device::with(['logs'=>function($query){
            $query->orderBy('log_dt','DESC')->first();
        }])->get();
        $today = date(Carbon::now());
        $thirtyOnedays = date(Carbon::now()->subDays(31));
        $previousDay = date(Carbon::now()->subDays(1));

        $allDevices= Device::with(['logs'=>function($query) use($thirtyOnedays, $today){
            $query->orderBy('id','Desc')->first();
        }])->get();
        $dataToSend =[];
        $volume = [];
        // get the first data and last data of tpv and subtract to get the monthly volume
        foreach($allDevices as $device){
            $data_count = count($device->logs);
            if($data_count != 0){
                // calculate daily volume
                $daily_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$previousDay,$today])->get();
                $daily_logs_count = count($daily_logs);
                $daily_volume = 0;
                if($daily_logs_count !=0){
                    $latest_tpv = $daily_logs[$daily_logs_count -1]->tpv;
                    $last_tpv = $daily_logs[0]->tpv;
                    $daily_volume = ($latest_tpv -$last_tpv)*0.2642007926;
                }
                //calculate monthly volume
                $monthly_logs = RawLogs::where('serial_number',$device->serial_number)->whereBetween('log_dt',[$thirtyOnedays,$today])->get();
                $monthly_logs_count = count($monthly_logs);
                $monthly_volume = 0;
                if($monthly_logs_count !=0){
                    $latest_tpv = $monthly_logs[$monthly_logs_count-1]->tpv;
                    $last_tpv = $monthly_logs[0]->tpv;
                    $monthly_volume = ($latest_tpv -$last_tpv)*0.2642007926;
                }
                //calculate total volume
                $first_record = RawLogs::where('serial_number',$device->serial_number)->first();
                $last_record = RawLogs::where('serial_number',$device->serial_number)->orderBy('id','Desc')->first();
                $total_volume = ($last_record->tpv - $first_record->tpv)*0.2642007926;
                $volume = [
                    'daily'=>$daily_volume,
                    'monthly'=>$monthly_volume,
                    'total'=>$total_volume
                ];
            }
            $deviceData = [
                'deviceDetails'=>$device,
                'deviceVolume'=>$volume
            ];
            array_push($dataToSend, $deviceData);
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
            $deviceCommand->save();

            return response()->json($setpoints,200);

        }
    }
}