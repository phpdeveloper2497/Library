<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class, 'login']);
Route::get('register',[AuthController::class, 'register']);
