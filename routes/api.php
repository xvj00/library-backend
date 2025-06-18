<?php

use App\Http\Controllers\Librarian\BookingManagementController;
use App\Http\Controllers\ReservationController;
use \App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/author/store', [App\Http\Controllers\AuthorController::class, 'store']);
Route::post('edition/store', [App\Http\Controllers\EditionController::class, 'store']);
Route::post('genre/store', [App\Http\Controllers\GenreController::class, 'store']);
Route::post('book/store', [App\Http\Controllers\BookController::class, 'store']);
Route::get('books', [App\Http\Controllers\BookController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);




    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/users', [UserController::class, 'index']);
        Route::post('/admin/user/store', [UserController::class, 'store']);
        Route::post('/admin/user/update/{id}', [UserController::class, 'update']);
        Route::post('/admin/user/forceDelete/{id}', [UserController::class, 'forceDelete']);
        Route::post('/admin/user/restore/{id}', [UserController::class, 'restore']);
        Route::delete('/admin/user/destroy/{id}', [UserController::class, 'destroy']);

    });
    Route::post('reservations', [ReservationController::class, 'store']);
    Route::get('profile/reservations', [ReservationController::class, 'userReservations']);
    Route::post('profile/reservations/{book}/cancel', [ReservationController::class, 'cancel']);

    Route::middleware(['role:librarian'])->group(function () {
        Route::get('/librarian/reservations', [BookingManagementController::class, 'index']);
        Route::post('/librarian/reservations/{book}/cancel', [BookingManagementController::class, 'cancel']);
        Route::post('/librarian/reservations/{book}/confirm', [BookingManagementController::class, 'confirm']);
        Route::post('/librarian/reservations/{book}/given', [BookingManagementController::class, 'given']);
        Route::post('/librarian/reservations/{book}/returned', [BookingManagementController::class, 'returned']);
    });
});


