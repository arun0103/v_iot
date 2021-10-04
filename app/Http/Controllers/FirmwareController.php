<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Firmware;
use Auth;

class FirmwareController extends Controller
{
    //
    public function addNewFirmware(Request $req){


        // return response()->json($req);
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
}
