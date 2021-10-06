<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Firmware;
use App\Models\Device;
use Auth;

class FirmwareController extends Controller
{
    //
    public function addNewFirmware(Request $req){
        // move file to the folder
        $req->file->move(public_path('uploads/firmwares'), $req->file_name);

        /* Store $file_name name in DATABASE from HERE */
        $new = new Firmware();
        $new->model_id = $req->model_id;
        $new->file_name = $req->file_name;
        $new->description = $req->description;
        $new->uploaded_by = Auth::user()->id;
        $new->save();
        $addedFirmware = Firmware::where('id',$new->id)->with('model','uploader')->first();
        $response =[
            'message'=>"Success",
            'data' =>$addedFirmware
        ];
        return response()->json($response);
    }

    public function checkFirmware($fileName){
        $check = Firmware::where("file_name",$fileName)->first();
        if($check != null){
            return response()->json(['msg'=>'duplicate']);
        }
        return response()->json(['msg'=>'ok']);
    }

    public function firmware_detail($id){
        $find = Firmware::where('id',$id)->with('model','uploader')->first();
        return response()->json($find);
    }

    public function deleteFirmwware($id){
        $find = Firmware::where('id',$id)->with('model','uploader')->first();
        if(file_exists(public_path('uploads/firmwares/'.$find->file_name))){
            unlink(public_path('uploads/firmwares/'.$find->file_name));
        }
        $find->delete();
        return response($find);
    }

    public function edit_firmware(Request $req){
        $find = Firmware::where('id',$req->firmware_id)->first();
        $find->model_id = $req->model_id;
        $find->description = $req->description;
        $find->save();
        $updated_firmware = Firmware::where('id',$find->id)->with('model:id,name')->first();
        return response()->json($updated_firmware);
    }

    public function getFirmwares($device_id){
        //get the device model
        $device_detail = Device::where('id',$device_id)->first();
        $model_id = $device_detail->model_id;

        // get the firmwares made for the model
        $firmwares = Firmware::where('model_id',$model_id)->orderBy('id','DESC')->get(['id','file_name']);

        return response()->json($firmwares);
    }
    public function getFirmwareDescription($firmware_id){
        $firmware_description = Firmware::where('id',$firmware_id)->get('description');
        return response()->json($firmware_description);
    }
}
