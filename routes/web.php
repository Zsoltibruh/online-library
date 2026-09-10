<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LostBookController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AccessChecker;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::controller(AuthController::class)
    ->name('auth.')
    ->group(function () {
        Route::get('/login', 'showLogin')->name('show_login');
        Route::get('/register', 'showRegister')->name('show_register');

        Route::post('/login', 'login')->name('login');
        Route::post('/register', 'register')->name('register');
        Route::post('/logout', 'logout')->name('logout')
            ->middleware('auth');
    });

Route::middleware(['auth', AccessChecker::class])->group(function () {
    Route::resource('users', UserController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('books', BookController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('authors', AuthorController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::controller(ReservationController::class)
        ->name('reservations.')
        ->group(function () {
            Route::get('/reservations', 'index')->name('index');
            Route::get('/lost-reservations', 'lost')->name('lost');
            Route::post('/reservations', 'store')->name('store');
            Route::patch('/reservations/{reservation}/return', 'return')->name('return');
        });
    Route::controller(LostBookController::class)
        ->name('lost_books.')
        ->group(function () {
            Route::patch('/lost-reservations/{reservation}/mark-as-lost', 'markAsLost')->name('mark_as_lost');
            Route::patch('/lost-reservations/{lostBook}/return', 'return')->name('return');
        });
});
