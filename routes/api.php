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

Route::get('/users',[App\Http\Controllers\SuperController::class,'usersOnly'])->name('users');

//Super Admin
Route::get('/getUsers',[App\Http\Controllers\SuperController::class,'getAllUsers']);



//Reseller
Route::get('/reseller',[App\Http\Controllers\SuperController::class,'getAllResellers'])->name('resellers');


//User
Route::get('/searchDevice', [App\Http\Controllers\HomeController::class,'searchDevice']);
Route::post('/addUserDevice', [App\Http\Controllers\HomeController::class,'addUserDevice']);
Route::post('/addUserAvatar', [App\Http\Controllers\ProfileController::class,'addUserAvatar']);
Route::post('/updateAvatar', [App\Http\Controllers\ProfileController::class,'updateAvatar']);
Route::post('/updateProfile', [App\Http\Controllers\ProfileController::class,'updateProfile']);

//Profile page routes
Route::get('/getUserProfile',[App\Http\Controllers\ProfileController::class,'getProfileInfo'])->middleware('auth');
Route::get('/getDevices', [App\Http\Controllers\ProfileController::class,'getDevices']);
Route::post('/updateProfileDetails',[App\Http\Controllers\UserProfileController::class,'update'])->middleware('auth');
Route::post('/updateProfilePersonalDetails',[App\Http\Controllers\UserProfileController::class,'updatePersonal'])->middleware('auth');
