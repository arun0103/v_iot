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
})->name('login');
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
Route::get('/super-users',[App\Http\Controllers\SuperController::class,'getAllSuperUsers'])->middleware('auth')->name('superUsers');
//Reseller
Route::get('/reseller',[App\Http\Controllers\SuperController::class,'getAllResellers'])->middleware('auth')->name('resellers');
Route::get('/devices',[App\Http\Controllers\SuperController::class,'devices'])->middleware('auth')->name('devices');
Route::get('/firmwares',[App\Http\Controllers\SuperController::class,'firmwares'])->middleware('auth')->name('firmwares');

//Charts
Route::get('/line-chart', [App\Http\Controllers\ChartController::class, 'showChart'])->name('line-chart');


//Firmware
Route::post('/addNewFirmware', [App\Http\Controllers\FirmwareController::class,'addNewFirmware'])->middleware('auth');
Route::get('/checkFirmware/{fileName}', [App\Http\Controllers\FirmwareController::class,'checkFirmware'])->middleware('auth');
Route::get('/firmware_detail/{id}', [App\Http\Controllers\FirmwareController::class,'firmware_detail'])->middleware('auth');
Route::delete('/deleteFirmwware/{id}', [App\Http\Controllers\FirmwareController::class,'deleteFirmwware'])->middleware('auth');
Route::patch('/edit_firmware', [App\Http\Controllers\FirmwareController::class,'edit_firmware'])->middleware('auth');
Route::get('/getFirmwares/{id}', [App\Http\Controllers\FirmwareController::class,'getFirmwares'])->middleware('auth');
Route::get('/getFirmwareDescription/{id}', [App\Http\Controllers\FirmwareController::class,'getFirmwareDescription'])->middleware('auth');
Route::post('/firmware_upgrade/{id}', [App\Http\Controllers\CommandsController::class,'firmware_upgrade'])->middleware('auth');

// Route::group(['middleware' => 'auth'], function() {
    // uses 'auth' middleware plus all middleware from $middlewareGroups['super']
    // Route::resource('blog','BlogController'); //Make a CRUD controller

    Route::post('/changePassword',[App\Http\Controllers\HomeController::class,'changePassword'])->middleware('auth');

    Route::post('/addNewReseller',[App\Http\Controllers\ResellerController::class,'addNewReseller'])->middleware('auth');
    Route::put('/editReseller',[App\Http\Controllers\ResellerController::class,'editReseller'])->middleware('auth');
    Route::get('/reseller/{id}',[App\Http\Controllers\ResellerController::class,'getResellerById'])->middleware('auth');
    Route::delete('/deleteReseller',[App\Http\Controllers\ResellerController::class, 'delete'])->middleware('auth');
    Route::get('/resellerDevices/{id}',[App\Http\Controllers\ResellerController::class, 'getResellerDevices'])->middleware('auth');
    Route::post('/addResellerDevice',[App\Http\Controllers\ResellerController::class, 'addResellerDevice'])->middleware('auth');
    Route::get('/getAllResellersUser',[App\Http\Controllers\ResellerController::class, 'getAllResellersUser'])->middleware('auth');

    Route::get('/users',[App\Http\Controllers\SuperController::class,'usersOnly'])->name('users')->middleware('auth');

    Route::post('/assignUserDevice',[App\Http\Controllers\SuperController::class,'assignUserDevice'])->middleware('auth');//not used i guess
    Route::post('/addUserDevice', [App\Http\Controllers\HomeController::class,'addUserDevice'])->middleware('auth');

    // });

    Route::get('/resellerDevices',[App\Http\Controllers\SuperController::class,'resellerDevices'])->name('resellerDevices')->middleware('auth');

    // Resellers

    Route::get('/searchRegisteredDevice',[App\Http\Controllers\ResellerController::class, 'searchRegisteredDevice'])->middleware('auth');
    Route::post('/nameResellerDevice', [App\Http\Controllers\ResellerController::class,'nameResellerDevice'])->middleware('auth');


//device
Route::post('/addNewDevice',[App\Http\Controllers\DeviceController::class,'create_device'])->middleware('auth');
Route::get('/getMyDevicesSetpoints', [App\Http\Controllers\DeviceController::class, 'getMyDevicesSetpoints'])->middleware('auth');
Route::get('/device_detail/{id}', [App\Http\Controllers\DeviceController::class, 'getDeviceDetails'])->middleware('auth');
Route::delete('/deleteUserDevice/{id}', [App\Http\Controllers\DeviceController::class, 'deleteUserDevice'])->middleware('auth');
Route::delete('/deleteUserAccessFromDevice/{user_device_id}', [App\Http\Controllers\DeviceController::class, 'deleteUserAccessFromDevice'])->middleware('auth');
Route::get('/viewDeviceUsers/{id}', [App\Http\Controllers\DeviceController::class, 'viewDeviceUsers'])->middleware('auth');
Route::patch('/saveEditedDevice/{id}',[App\Http\Controllers\DeviceController::class,'saveEditedDevice'])->middleware('auth');

//Device notifications
Route::get('/getDeviceNotifications/{id}', [App\Http\Controllers\DeviceController::class, 'getDeviceNotifications'])->middleware('auth');


//user
Route::delete('/deleteUser/{id}',[App\Http\Controllers\SuperController::class, 'deleteUserById'])->middleware('auth');
Route::delete('/deleteSuperUser/{id}',[App\Http\Controllers\SuperController::class, 'deleteSuperUserById'])->middleware('auth');
Route::post('/super/addUser',[App\Http\Controllers\SuperController::class,'create_user'])->middleware('auth');
Route::post('/super/addSuperUser',[App\Http\Controllers\SuperController::class,'create_superUser'])->middleware('auth');
Route::patch('/super/editUser/{id}',[App\Http\Controllers\SuperController::class,'edit_user'])->middleware('auth');
Route::patch('/super/editSuperUser/{id}',[App\Http\Controllers\SuperController::class,'edit_superUser'])->middleware('auth');
Route::get('/getResellersList',[App\Http\Controllers\SuperController::class, 'getResellersList'])->middleware('auth');

Route::get('/changeUserPasswordOld',[App\Http\Controllers\UserProfileController::class, 'verifyOldPassword'])->middleware('auth');

//Dashboard routes
Route::get('/deviceDetail/{id}',[App\Http\Controllers\HomeController::class, 'getDeviceDetails'])->middleware('auth');
Route::get('/getDeviceAlarms/{id}',[App\Http\Controllers\DataController::class, 'getDeviceAlarms'])->middleware('auth');
Route::get('/deviceRelays/{id}',[App\Http\Controllers\DataController::class, 'getDeviceRelayStatus'])->middleware('auth');

/////device settings
Route::post('/saveCriticAcid/{id}',[App\Http\Controllers\DeviceController::class, 'saveCriticAcid'])->middleware('auth');
Route::post('/savePreFilter/{id}',[App\Http\Controllers\DeviceController::class, 'savePreFilter'])->middleware('auth');
Route::post('/savePostFilter/{id}',[App\Http\Controllers\DeviceController::class, 'savePostFilter'])->middleware('auth');
Route::post('/saveGeneralService/{id}',[App\Http\Controllers\DeviceController::class, 'saveGeneralService'])->middleware('auth');

//device commands
Route::get('/deviceCommands/{id}',[App\Http\Controllers\CommandsController::class, 'getDeviceCommands'])->middleware('auth');
Route::delete('/deleteCommand/{id}',[App\Http\controllers\CommandsController::class, 'deleteCommand'])->middleware('auth');
Route::post('/flush_module/{id}',[App\Http\Controllers\CommandsController::class, 'flush_module'])->middleware('auth');
Route::post('/start_cip/{id}',[App\Http\Controllers\CommandsController::class, 'start_cip'])->middleware('auth');
Route::post('/current_date/{id}',[App\Http\Controllers\CommandsController::class, 'current_date'])->middleware('auth');
Route::post('/current_time/{id}',[App\Http\Controllers\CommandsController::class, 'current_time'])->middleware('auth');
Route::post('/command/stop/{id}',[App\Http\Controllers\CommandsController::class, 'stopDevice'])->middleware('auth');
Route::post('/command/start/{id}',[App\Http\Controllers\CommandsController::class, 'StartDevice'])->middleware('auth');
Route::post('/command/getSetpointsFromDevice/{id}',[App\Http\Controllers\CommandsController::class, 'getSetpointsFromDevice'])->middleware('auth');
Route::post('/resetAllAlarms/{id}',[App\Http\Controllers\CommandsController::class, 'resetAllAlarms'])->middleware('auth');
Route::get('/command_status/{command}/{id}',[App\Http\Controllers\CommandsController::class, 'checkCommandStatus'])->middleware('auth');
// relay commands
Route::post('/turn_relay_1_on/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_1_on'])->middleware('auth');
Route::post('/turn_relay_1_off/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_1_off'])->middleware('auth');
Route::post('/turn_relay_2_on/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_2_on'])->middleware('auth');
Route::post('/turn_relay_2_off/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_2_off'])->middleware('auth');
Route::post('/turn_relay_3_on/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_3_on'])->middleware('auth');
Route::post('/turn_relay_3_off/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_3_off'])->middleware('auth');
Route::post('/turn_relay_4_on/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_4_on'])->middleware('auth');
Route::post('/turn_relay_4_off/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_4_off'])->middleware('auth');
Route::post('/turn_relay_5_on/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_5_on'])->middleware('auth');
Route::post('/turn_relay_5_off/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_5_off'])->middleware('auth');
Route::post('/turn_relay_6_on/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_6_on'])->middleware('auth');
Route::post('/turn_relay_6_off/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_6_off'])->middleware('auth');
Route::post('/turn_relay_7_on/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_7_on'])->middleware('auth');
Route::post('/turn_relay_7_off/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_7_off'])->middleware('auth');
Route::post('/turn_relay_8_on/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_8_on'])->middleware('auth');
Route::post('/turn_relay_8_off/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_8_off'])->middleware('auth');
Route::post('/turn_relay_9_on/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_9_on'])->middleware('auth');
Route::post('/turn_relay_9_off/{id}',[App\Http\Controllers\CommandsController::class, 'turn_relay_9_off'])->middleware('auth');


//Live
Route::get('/deviceLiveData/{id}',[App\Http\Controllers\DeviceController::class, 'getLiveData'])->middleware('auth');
Route::get('/refreshDashboardData',[App\Http\Controllers\DataController::class, 'refreshDashboardData'])->middleware('auth');
Route::get('/refreshStatusData/{id}',[App\Http\Controllers\DataController::class, 'refreshStatusData'])->middleware('auth');
Route::get('/refreshUserDashboardData',[App\Http\Controllers\DataController::class, 'refreshUserDashboardData'])->middleware('auth');
Route::get('/refreshDashboardRows',[App\Http\Controllers\DataController::class, 'refreshDashboardRows'])->middleware('auth');

//Setpoints
Route::get('/getUserDevicesSetpointsForCalculation',[App\Http\Controllers\DataController::class, 'getUserDevicesSetpointsForCalculation'])->middleware('auth');
Route::get('/getDeviceSetpointsForCalculation/{id}',[App\Http\Controllers\DataController::class, 'getDeviceSetpointsForCalculation'])->middleware('auth');
Route::get('/getDeviceSetpoints/{id}',[App\Http\Controllers\DataController::class, 'getDeviceSetpoints'])->middleware('auth');
Route::get('/getPureECTargetSetpoint/{id}',[App\Http\Controllers\DataController::class, 'getPureECTarget'])->middleware('auth');
Route::post('/saveDeviceSetpoints/{id}',[App\Http\Controllers\DataController::class, 'setDeviceSetpoints'])->middleware('auth');


//Maintenance
Route::post('/resetCriticAcid/{device_id}/{volume}',[App\Http\Controllers\DeviceController::class, 'resetCriticAcid'])->middleware('auth');
Route::post('/resetPreFilter/{device_id}/{volume}',[App\Http\Controllers\DeviceController::class, 'resetPreFilter'])->middleware('auth');
Route::post('/resetPostFilter/{device_id}/{volume}',[App\Http\Controllers\DeviceController::class, 'resetPostFilter'])->middleware('auth');
Route::post('/resetGeneralService/{device_id}/{volume}',[App\Http\Controllers\DeviceController::class, 'resetGeneralService'])->middleware('auth');

// Volume Chart
Route::get('/getVolumeHour/{id}',[App\Http\Controllers\DataController::class, 'getVolumeHour'])->middleware('auth');
Route::get('/getVolume24Hour/{id}',[App\Http\Controllers\DataController::class, 'getVolume24Hour'])->middleware('auth');
Route::get('/getVolumeCustom/{id}',[App\Http\Controllers\DataController::class, 'getVolumeCustom'])->middleware('auth');
