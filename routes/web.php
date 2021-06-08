<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\UserProfile;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/profile', function () {
    $user = Auth::user();
    $userProfile = UserProfile::where('user_id',$user->id)->first();
    // dd($userProfile);
    //$profile = $user;//->with('profile');
    if($userProfile == null){
        $userProfile = new UserProfile();
        $userProfile->user_id = $user->id;
        $userProfile->profession = "Not Defined";
        $userProfile->institution = "Not Defined";
        $userProfile->save();
    }

    $userP = User::where('id',$user->id)->with('profile')->first();
    // dd($userP);
    return view('user.profile')->with(['user'=>$userP]);
})->name('userProfile');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');


//Charts
Route::get('/line-chart', [App\Http\Controllers\ChartController::class, 'showChart'])->name('line-chart');

Route::group(['middleware' => 'auth'], function() {
    // uses 'auth' middleware plus all middleware from $middlewareGroups['super']
    // Route::resource('blog','BlogController'); //Make a CRUD controller


    Route::post('/addNewReseller',[App\Http\Controllers\ResellerController::class,'addNewReseller']);
    Route::put('/editReseller',[App\Http\Controllers\ResellerController::class,'editReseller']);
    Route::get('/reseller/{id}',[App\Http\Controllers\ResellerController::class,'getResellerById']);
    Route::delete('/deleteReseller',[App\Http\Controllers\ResellerController::class, 'delete']);
    Route::get('/resellerDevices/{id}',[App\Http\Controllers\ResellerController::class, 'getResellerDevices']);
    Route::post('/addResellerDevice',[App\Http\Controllers\ResellerController::class, 'addResellerDevice']);
    Route::post('/addNewUser',[App\Http\Controllers\SuperController::class,'create_user']);

    Route::post('/addNewDevice',[App\Http\Controllers\SuperController::class,'create_device']);
    Route::post('/assignUserDevice',[App\Http\Controllers\SuperController::class,'assignUserDevice']);//not used i guess
    Route::post('/addUserDevice', [App\Http\Controllers\HomeController::class,'addUserDevice']);

});
Route::get('/devices',[App\Http\Controllers\SuperController::class,'devices'])->name('devices');

Route::delete('/deleteUserDevice/{id}', [App\Http\Controllers\DeviceController::class, 'deleteUserDevice']);
Route::get('/viewDeviceUsers/{id}', [App\Http\Controllers\DeviceController::class, 'viewDeviceUsers']);
