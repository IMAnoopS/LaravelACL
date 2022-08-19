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

Route::post('register', 'App\Http\Controllers\API\RegisterController@register');
Route::post('login', 'App\Http\Controllers\API\RegisterController@login');
Route::group(['middleware' => ['auth:api']], function () {
Route::post('/logout', 'App\Http\Controllers\API\RegisterController@logout');

});
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('register','App\Http\Controllers\UserController@register');
//Route::post('login','App\Http\Controllers\UserController@login');
//Route::get('profile','App\Http\Controllers\UserController@getAuthenticatedUser');

Route::middleware('auth:api')->get('/user', function(Request $request){
    return $request->user();
});
