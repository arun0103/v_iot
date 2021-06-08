<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        $loggedInUserProfile = UserProfile::where('user_id',Auth::user()->id)->first();
        $loggedInUserProfile->profession = $request->profession;
        $loggedInUserProfile->institution = $request->institution;
        $loggedInUserProfile->save();
        return $loggedInUserProfile;

    }
    public function updatePersonal(Request $request, UserProfile $userProfile)
    {
        $loggedInUser = Auth::user();
        $detailsChanged = 0;
        if($request->name!=null){
            $loggedInUser->name = $request->name;
            $detailsChanged++;
        }if($request->email!=null){
            $loggedInUser->email = $request->email;
            $detailsChanged++;
        }
        if($detailsChanged > 0 )
            $loggedInUser->save();
        $detailsChanged = 0;

        $loggedInUserProfile = UserProfile::where('user_id',$loggedInUser->id)->first();

        $loggedInUserProfile->phone = $request->phone;
        $loggedInUserProfile->mobile = $request->mobile;
        $loggedInUserProfile->address = $request->address;
        $loggedInUserProfile->save();

        $user = User::where(["id",Auth::user()->id])->with('profile')->get();
        return $user;

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
