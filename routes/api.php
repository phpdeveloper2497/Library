<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



Route::get('/users/{user}/restore', [UserController::class, 'restore'])->middleware('auth:sanctum');
Route::get('/users/{user}/forceDelete', [UserController::class, 'forceDelete'])->middleware('auth:sanctum');
Route::post('/users/{user}/updatePhoto', [UserController::class, 'updatePhoto'])->middleware('auth:sanctum');
Route::get('/bookings/data-should', [BookingController::class, 'booksReturnedToday'])->middleware('auth:sanctum');


//Route::put('/books/{id}/update', [BookController::class, 'update'])->middleware('auth:sanctum');
//Route::post('/clients/{client}/updatePhoto', [ClientController::class, 'updatePhoto'])->middleware('auth:sanctum');


//Route::get('bookings', function ()
//{
////    $booking = BookingController::;
////    Mail::to('bukharacity1997@gmail.com')->send(new \App\Mail\Booking\Confirmed($booking));
//});

Route::resources([
    'users' => UserController::class,
    'books' => BookController::class,
    'categories' => CategoryController::class,
    'books.book' => BookController::class,
    'clients' => ClientController::class,
    'bookings' => BookingController::class,
    'statuses' => StatusController::class
]);


