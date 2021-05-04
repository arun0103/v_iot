<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        $users = User::all();
        return view('home')->with(['population'=>$users]);
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
}
