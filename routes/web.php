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

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLogin')->name('show_login');
        Route::get('/register', 'showRegister')->name('show_register');

        Route::post('/login', 'login')->name('login');
        Route::post('/register', 'register')->name('register');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/list-books', [BookController::class, 'list'])->name('books.list');

    Route::middleware(AccessChecker::class)->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('books', BookController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('authors', AuthorController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('reservations', ReservationController::class)->only(['index', 'store']);

        Route::controller(ReservationController::class)
            ->name('reservations.')
            ->group(function () {
                Route::get('/lost-reservations', 'lost')->name('lost');
                Route::get('/active-reservations', 'active')->name('active');
                Route::get('/overdue-reservations', 'overdue')->name('overdue');
                Route::patch('/reservations/{reservation}/return', 'return')->name('return');
            });

        Route::controller(LostBookController::class)
            ->name('lost-books.')
            ->group(function () {
                Route::patch('/lost-reservations/{reservation}/mark-as-lost', 'markAsLost')->name('mark_as_lost');
                Route::patch('/lost-reservations/{lostBook}/return', 'return')->name('return');
            });
    });
});
