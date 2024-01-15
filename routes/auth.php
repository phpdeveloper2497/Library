<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class, 'login']);
Route::get('logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register',[AuthController::class, 'register']);

