<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

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
        Session(['user_name', $loggedInUser->name]);
        Session(['role', $loggedInUser->role]);
        return view('home');
    }

    public function logout(){
        Auth::logout();
        // return response()->json(['message' => 'Logged Out'], 200);
        return view('welcome');
    }
}
