<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/profile', function () {
    return view('user.profile');
})->name('userProfile');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');


//Charts
Route::get('/line-chart', [App\Http\Controllers\ChartController::class, 'showChart'])->name('line-chart');

Route::group(['middleware' => ['auth', 'super']], function() {
    // uses 'auth' middleware plus all middleware from $middlewareGroups['super']
    // Route::resource('blog','BlogController'); //Make a CRUD controller
    Route::get('/admin/users',[App\Http\Controllers\SuperController::class,'users'])->name('users');
    Route::post('/addNewUser',[App\Http\Controllers\SuperController::class,'create_user']);

    Route::get('/devices',[App\Http\Controllers\SuperController::class,'devices'])->name('devices');
    Route::post('/addNewDevice',[App\Http\Controllers\SuperController::class,'create_device']);
  });
