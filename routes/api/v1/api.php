<?php

use App\Code\V1\Auth\UI\Controllers\LoginController;
use App\Code\V1\Auth\UI\Controllers\RegistrationController;
use App\Code\V1\Users\UI\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'createToken']);
Route::post('registration', [RegistrationController::class, 'registration']);

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('', [UserController::class, 'getAllUsers']);
        Route::get('{id}', [UserController::class, 'read']);
        Route::post('', [UserController::class, 'create']);
        Route::put('/{id}', [UserController::class, 'update']);
    });
});
