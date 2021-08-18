<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device_commands;

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
        $command->save();
        return response()->json($command);
    }
    public function start_cip($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Start_CIP";
        $command->save();
        return response()->json($command);
    }
    public function current_time($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Current_time";
        $command->save();
        return response()->json($command);
    }
    public function current_date($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Current_date";
        $command->save();
        return response()->json($command);
    }
    public function stopDevice($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Stop";
        $command->save();
        return response()->json($command);
    }
    public function startDevice($id){
        $command = new Device_commands();
        $command->device_id = $id;
        $command->command = "Start";
        $command->save();
        return response()->json($command);
    }
    public function checkCommandStatus($command, $id){
        $commands = Device_commands::where([['device_id',$id],['command',$command]])->orderBy('id','desc')->first();
        return response()->json($commands);
    }
}
