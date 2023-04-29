<?php

use \Modules\User\Http\Controllers\Auth\Signup\RegisterController;
use \Modules\User\Http\Controllers\Auth\Login\LoginController;

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

Route::prefix('auth')->as('api.auth.')->group(function () {
    /*
     ******************************
     *          Register
     *******************************
     */
    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register');

    /*
     ******************************
     *          Login
     *******************************
     */
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login');
});

include 'settings.php';
