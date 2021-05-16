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

Route::get('/getUserProfile',[App\Http\Controllers\HomeController::class,'getProfileInfo'])->middleware('auth');

//Super Admin
Route::get('/getUsers',[App\Http\Controllers\SuperController::class,'getAllUsers']);






//User
Route::get('/searchDevice', [App\Http\Controllers\HomeController::class,'searchDevice']);
Route::post('/addUserDevice', [App\Http\Controllers\HomeController::class,'addUserDevice']);
Route::post('/addUserAvatar', [App\Http\Controllers\HomeController::class,'addUserAvatar']);
