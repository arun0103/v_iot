<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class SuperController extends Controller
{
    public function users(){
        $loggedInUser = Auth::user();
        if($loggedInUser->role == 'S'){
            $all = User::all();
            return view('admin/users',['users',$all]);
        }
        elseif($loggedInUser->role == 'A'){
            $resellerUser = User::where(created_by, $loggedInUser->id);
            return view('admin/users',['users',$resellerUser]);
        }
        return view('home');
    }
    public function getAllUsers(){
        $users = User::all();
        return response($users,200);
    }
}
