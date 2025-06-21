<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\Librarian\BookingManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/reservations', [ReservationController::class, 'store']);

    Route::prefix('profile')->group(function () {
        Route::patch('/update', [ProfileController::class, 'update']);
        Route::patch('/password', [ProfileController::class, 'passwordUpdate']);
        Route::delete('/delete', [ProfileController::class, 'destroy']);
        Route::get('/reservations', [ReservationController::class, 'index']);
        Route::post('/reservations/{book}/cancel', [ReservationController::class, 'cancel']);
    });

    Route::apiResource('books.reviews', ReviewController::class)->only(['store', 'index'])->shallow();
    Route::apiResource('reviews', ReviewController::class)->only(['show', 'update', 'destroy'])->shallow();

    Route::middleware('role:librarian')->prefix('librarian')->group(function () {
        Route::get('/reservations', [BookingManagementController::class, 'index']);
        Route::post('/reservations/{book}/cancel', [BookingManagementController::class, 'cancel']);
        Route::post('/reservations/{book}/confirm', [BookingManagementController::class, 'confirm']);
        Route::post('/reservations/{book}/given', [BookingManagementController::class, 'given']);
        Route::post('/reservations/{book}/returned', [BookingManagementController::class, 'returned']);
        Route::apiResource('genres', GenreController::class);
        Route::apiResource('authors', AuthorController::class);
        Route::apiResource('books', BookController::class);
        Route::apiResource('editions', EditionController::class);
    });
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('/users/{id}/force', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    });

});
