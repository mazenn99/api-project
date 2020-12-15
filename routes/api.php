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

Route::group(['namespace' => 'Api' , 'middleware' => 'apiPass'] , function() {
    // Route Create User , Login User , Update Profile and password :
    Route::post('register' , 'AuthController@register');
    Route::post('login' , 'AuthController@login');
    Route::group(['middleware' => 'auth:api'] , function() {
        // using UserController
        Route::post('update-profile' , 'UserController@updateProfile');
        Route::post('update-password' , 'UserController@updatePassword');
    });
    // Route Create User , Login User , Update Profile and password :
});

