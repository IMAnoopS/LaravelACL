<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompaniesC;
use App\Http\Controllers\EmployeeC;

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


//Google Login
Route::get('auth/google', 'App\Http\Controllers\Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'App\Http\Controllers\Auth\GoogleController@handleGoogleCallback');
Route::get('success','App\Http\Controllers\Auth\GoogleController@success');
  

//Linkdin Login
Route::get('auth/linkdin', 'App\Http\Controllers\Auth\LinkdinController@redirectToLinkdin');
Route::get('auth/linkdin/callback', 'App\Http\Controllers\Auth\LinkdinController@handleLinkdinCallback');
Route::get('successlinkdin','App\Http\Controllers\Auth\LinkdinController@successlinkdin');

Auth::routes(['verify' => true]);
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('companies', CompaniesC::class);
    Route::resource('employees', EmployeeC::class);
    

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

