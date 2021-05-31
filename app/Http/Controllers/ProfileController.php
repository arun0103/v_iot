<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Device;
use App\Models\UserDevices;
use Auth;

class ProfileController extends Controller
{
    public function getDevices(){
        $loggedInUser = Auth::user();
        switch($loggedInUser->role){
            case 'S':
                $devices = Device::all();
                break;
            case 'U':
                $devices = UserDevices::where('user_id',$loggedInUser->id)->with('deviceDetails')->get();
                break;


        }
        return response()->json(['data'=>$devices],200);
    }
    public function addUserAvatar(Request $req){
        $req->validate([
            'avatar' => 'required|image|mimes:jpeg,jpg,gif|max:2048',
        ]);

        $imageName = Auth::user()->id.'_'.time().'.'.$req['avatar']->getClientOriginalExtension();

        $req->avatar->move(public_path('uploads/avatars'), $imageName);

        /* Store $imageName name in DATABASE from HERE */
        $user = Auth::user();
        $user->avatar = $imageName;
        $user->save();
        $response =[
            'message'=>"Success",
            'imageName' =>$imageName
        ];
        return response($response);
        // return back()
        //     ->with('success','You have successfully upload image.')
        //     ->with('image',$imageName);
    }
    public function updateProfile(Request $req){
        $loggedInUser = Auth::user();
        $loggedInUser->name = $req->name;
        $loggedInUser->email= $req->email;
        $loggedInUser->save();
        return response()->json(['data',$loggedInUser]);
    }
}
