<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users',[App\Http\Controllers\SuperController::class,'usersOnly'])->name('users')->middleware('auth');

//Super Admin
Route::get('/getUsers',[App\Http\Controllers\SuperController::class,'getAllUsers'])->middleware('auth');



//Reseller
Route::get('/reseller',[App\Http\Controllers\SuperController::class,'getAllResellers'])->name('resellers')->middleware('auth');


//User
Route::get('/searchDevice', [App\Http\Controllers\HomeController::class,'searchDevice'])->middleware('auth');
Route::post('/addUserDevice', [App\Http\Controllers\HomeController::class,'addUserDevice'])->middleware('auth');
Route::post('/addUserAvatar', [App\Http\Controllers\ProfileController::class,'addUserAvatar'])->middleware('auth');
Route::post('/updateAvatar', [App\Http\Controllers\ProfileController::class,'updateAvatar'])->middleware('auth');
Route::post('/updateProfile', [App\Http\Controllers\ProfileController::class,'updateProfile'])->middleware('auth');

//Profile page routes
Route::get('/getUserProfile',[App\Http\Controllers\ProfileController::class,'getProfileInfo'])->middleware('auth');
Route::get('/getDevices', [App\Http\Controllers\ProfileController::class,'getDevices'])->middleware('auth');
Route::post('/updateProfileDetails',[App\Http\Controllers\UserProfileController::class,'update'])->middleware('auth');
Route::post('/updateProfilePersonalDetails',[App\Http\Controllers\UserProfileController::class,'updatePersonal'])->middleware('auth');
