<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Route::post('login',[AuthController::class, 'login']);

Route::resources([
    'users' => UserController::class,
    'books' => BookController::class,
    'categories' => CategoryController::class,
    'books.book' => BookController::class,
    'clients'=> ClientController::class,
    'orders' => OrderController::class,
]);


