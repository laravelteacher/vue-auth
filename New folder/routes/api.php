<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;



Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        // Below mention routes are public, user can access those without any restriction.
        // Create New User
        Route::post('register', 'AuthController@register');
        // Login User
        Route::post('login', 'AuthController@login');
        
        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');

        // Send reset password mail
        Route::post('reset-password', 'PasswordResetRequestController@sendEmail');
        
        // handle reset password form process
        Route::post('reset/password', 'AuthController@callResetPassword');
        
        // Below mention routes are available only for the authenticated users.
        Route::middleware('auth:api')->group(function () {
            // Get user info
            Route::get('user', 'AuthController@user');
            // Logout user from application
            Route::post('logout', 'AuthController@logout');
        });
    });


    /**
     * Basic Routes
     **/    
    Route::middleware('auth:api')->group(function () {
        Route::resource('user', 'UserController')->only(['index','show']);
    });
});