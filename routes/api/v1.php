<?php

use App\Code\V1\Auth\UI\Controllers\LoginController;
use App\Code\V1\Auth\UI\Controllers\RegistrationController;
use App\Code\V1\Users\UI\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'createToken']);
Route::post('register', [RegistrationController::class, 'register']);

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('', [UsersController::class, 'all']);
        Route::get('{id}', [UsersController::class, 'read']);
        Route::post('', [UsersController::class, 'create']);
        Route::put('/{id}', [UsersController::class, 'update']);
    });
});
