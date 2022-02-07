<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device_commands;
use App\Models\Firmware;
use App\Models\Device;
use Auth;

class CommandsController extends Controller
{
    public function getDeviceCommands($id){
        $commands = Device_commands::where('device_id',$id)->get();
        return response()->json($commands);
    }
    public function deleteCommand($id){
        $command = Device_commands::where('id',$id)->delete();
        return response()->json($command);
    }
    public function flush_module($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Flush";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function start_CIP($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Start CIP";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function current_time($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Current_time";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function current_date($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Current_date";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function stopDevice($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Stop";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function startDevice($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Start";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    // super start stop commands
        public function stopDevice_super($device_serial){
            $id = Device::where('serial_number',$device_serial)->pluck('id')->first();
            $command = new Device_commands();
            $command->device_id = $id;
            $command->command = "Stop";
            $command->created_by = Auth::user()->id;
            $command->save();
            return response()->json($command);
        }
        public function startDevice_super($device_serial){
            $id = Device::where('serial_number',$device_serial)->pluck('id')->first();
            $command = new Device_commands();
            $command->device_id = $id;
            $command->command = "Start";
            $command->created_by = Auth::user()->id;
            $command->save();
            return response()->json($command);
        }
    //
    public function getSetpointsFromDevice($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Setpoints-get";
        $command->created_by = Auth::user()->id;
        $command->save();
    }

    public function checkCommandStatus($command, $id){
        $commands = Device_commands::where([['device_id',$id],['command',$command]])->orderBy('id','desc')->first();
        return response()->json($commands);
    }
    public function resetFactorySettings($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Reset-factory-settings";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function resetAllAlarms($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Reset-all-alarms";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }

    // relay commands
    public function turn_relay_1_on($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-1-on";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_1_off($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-1-off";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_2_on($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-2-on";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_2_off($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-2-off";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_3_on($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-3-on";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_3_off($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-3-off";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_4_on($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-4-on";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_4_off($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-4-off";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_5_on($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-5-on";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_5_off($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-5-off";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_6_on($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-6-on";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_6_off($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-6-off";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_7_on($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-7-on";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_7_off($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-7-off";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_8_on($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-8-on";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_8_off($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-8-off";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_9_on($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-9-on";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    public function turn_relay_9_off($device_id){
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Relay-9-off";
        $command->created_by = Auth::user()->id;
        $command->save();
        return response()->json($command);
    }
    //firmware upgrade
    public function upgradeFirmware($device_id, $firmware_id){
        $firmware = Firmware::where('id',$firmware_id)->first();
        $command = new Device_commands();
        $command->device_id = $device_id;
        $command->command = "Firmware-upgrade";
        $command->created_by = Auth::user()->id;
        $command->device_response_data = $firmware->file_name;
        $command->save();
        return response()->json($command);
    }
}
