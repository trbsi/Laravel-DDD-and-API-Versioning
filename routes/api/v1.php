<?php

use App\Code\V1\Auth\UI\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'createToken']);