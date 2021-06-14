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
    // return view('vendor/emails/WelcomeUser');
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
})->name('userProfile')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');


//Charts
Route::get('/line-chart', [App\Http\Controllers\ChartController::class, 'showChart'])->name('line-chart');

// Route::group(['middleware' => 'auth'], function() {
    // uses 'auth' middleware plus all middleware from $middlewareGroups['super']
    // Route::resource('blog','BlogController'); //Make a CRUD controller


    Route::post('/addNewReseller',[App\Http\Controllers\ResellerController::class,'addNewReseller'])->middleware('auth');
    Route::put('/editReseller',[App\Http\Controllers\ResellerController::class,'editReseller'])->middleware('auth');
    Route::get('/reseller/{id}',[App\Http\Controllers\ResellerController::class,'getResellerById'])->middleware('auth');
    Route::delete('/deleteReseller',[App\Http\Controllers\ResellerController::class, 'delete'])->middleware('auth');
    Route::get('/resellerDevices/{id}',[App\Http\Controllers\ResellerController::class, 'getResellerDevices'])->middleware('auth');
    Route::post('/addResellerDevice',[App\Http\Controllers\ResellerController::class, 'addResellerDevice'])->middleware('auth');


    Route::post('/addNewDevice',[App\Http\Controllers\SuperController::class,'create_device'])->middleware('auth');
    Route::post('/assignUserDevice',[App\Http\Controllers\SuperController::class,'assignUserDevice'])->middleware('auth');//not used i guess
    Route::post('/addUserDevice', [App\Http\Controllers\HomeController::class,'addUserDevice'])->middleware('auth');

// });
Route::get('/devices',[App\Http\Controllers\SuperController::class,'devices'])->name('devices')->middleware('auth');

Route::delete('/deleteUserDevice/{id}', [App\Http\Controllers\DeviceController::class, 'deleteUserDevice'])->middleware('auth');
Route::get('/viewDeviceUsers/{id}', [App\Http\Controllers\DeviceController::class, 'viewDeviceUsers'])->middleware('auth');

//user
Route::delete('/deleteUser/{id}',[App\Http\Controllers\SuperController::class, 'deleteUserById'])->middleware('auth');
Route::post('/super/addUser',[App\Http\Controllers\SuperController::class,'create_user'])->middleware('auth');
Route::patch('/super/editUser/{id}',[App\Http\Controllers\SuperController::class,'edit_user'])->middleware('auth');
Route::get('/getResellersList',[App\Http\Controllers\SuperController::class, 'getResellersList'])->middleware('auth');
