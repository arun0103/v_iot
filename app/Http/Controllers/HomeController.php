<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Device;
use App\Models\UserDevices;

use Auth;
use Carbon\Carbon;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Get user info
        $loggedInUser = Auth::user();
        $loggedInUser->last_login = Carbon::now();
        $loggedInUser->save();
        Session(['user_name', $loggedInUser->name]);
        Session(['role', $loggedInUser->role]);
        if($loggedInUser->role == 'S'){
            $users = User::all();
            $userDevices = UserDevices::all();
            return view('super/dashboard')->with(['users'=>$users])
            ->with(['userDevices'=>$userDevices]);
        }elseif($loggedInUser->role =='R'){
            $users = User::where('added_by',$loggedInUser)->get();
            $userDevices = UserDevices::where('user_id',$loggedInUser->id)->get();
        }
        else{
            $users = $loggedInUser;
            $userDevices = UserDevices::where('user_id',$loggedInUser->id)->get();
        }
        //dd($userDevices);
        return view('home')->with(['population'=>$users])
                            ->with(['userDevices'=>$userDevices]);
    }

    public function logout(){
        Auth::logout();
        // return response()->json(['message' => 'Logged Out'], 200);
        return view('welcome');
    }

    public function getProfileInfo(){
        $user = Auth::user();
        return response()->json('data',$user);
    }

    public function addUserAvatar(Request $req){
        $req->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$req['avatar']->getClientOriginalExtension();

        $req->avatar->move(public_path('uploads/avatars'), $imageName);

        /* Store $imageName name in DATABASE from HERE */
        $user = Auth::user();
        $user->avatar = $imageName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }
    public function addUserDevice(Request $req){
        $user = Auth::user();
        $searchDevice = Device::where([['serial_number',$req->serial_number],['device_number', $req->device_number]])->first();
        if($searchDevice != null){
            $userDevice = UserDevices::where([['user_id',$user->id],['device_id',$searchDevice->id]])->get();
            if($userDevice != null){
                $added = new UserDevices;
                $added->user_id = $user->id;
                $added->device_id = $searchDevice->id;
                $added->save();
                $response =[
                    'message' => 'Success',
                    'description' =>'Added',
                    'data' => $added
                ];
            }
            else{
                $response =[
                    'message' => 'Error',
                    'description' =>'Already Exists'
                ];
            }
        }else{
            $response =[
                'message' => 'Error',
                'description' =>'Device Not Found In Database. Please Call Voltea Office'
            ];
        }
        return response($response);
    }

    public function searchDevice(Request $req){
        $searchDevice = Device::where([['serial_number',$req->serial_number],['device_number', $req->device_number]])->get();
        return response($searchDevice);
    }
}
