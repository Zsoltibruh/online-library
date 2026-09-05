<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
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

Route::resource('users', UserController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('books', BookController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('authors', AuthorController::class)->only(['index', 'store', 'update', 'destroy']);
