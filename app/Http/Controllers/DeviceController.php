<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Devices;
use App\Models\UserDevices;

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
}
