<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Device;
use App\Models\Setpoints;
use Carbon\Carbon;

class DataController extends Controller
{
    //
    public function getAllDeviceLatestDataEvery15Seconds(){
        $device = Device::with(['logs'=>function($query){
            $query->orderBy('log_dt','DESC')->first();
        }])->get();
        $today = date(Carbon::now());
        $thirtyOnedays = date(Carbon::now()->subDays(91));
        $previousDay = date(Carbon::now()->subDays(91));

        $allDevicesWithLogs= Device::with(['logs'=>function($query) use($thirtyOnedays, $today){
            $query->whereBetween('log_dt', [$thirtyOnedays,$today])->get();
        }])->get();
        // get the first data and last data of tpv and subtract to get the monthly volume
        foreach($allDevicesWithLogs as $device){
            $data_count = count($device->logs);
            if($data_count != 0){
                $data_count = $data_count-1;
                // var_dump($data_count);
                $monthly_volume = 0;
                $first_tpv = $device->logs[$data_count]->tpv;
                $last_tpv = $device->logs[0]->tpv;
                $monthly_volume = $first_tpv - $last_tpv;
                $device->monthly_volume = $monthly_volume;
                $daily_logs = $device->whereBetween('log_dt',[$previousDay,$today]);
            }
        }



        return response()->json([$allDevicesWithLogs,$data_count,$daily_logs]);
    }

    // get the setpoints of a device having id
    public function getSetpoints($id){
        $setpoints = Setpoints::where('device_id',$id)->first();
        return response()->json($setpoints);
    }
}
