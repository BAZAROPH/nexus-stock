<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth', 'first_login')->name('logout');

Route::get('first-login', [AuthController::class, 'firstLoginView'])->name('first.login')->middleware('auth');
Route::post('first-login', [AuthController::class, 'firstLogin'])->name('first.login.perform')->middleware('auth');
Route::get("/email/verify/{id}/{hash}", [AuthController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware('auth', "first_login")->name('dashboard');


Route::get('/users', [UsersController::class, 'index'])->middleware('auth', 'first_login')->name('users.index');
Route::post('/users', [UsersController::class, 'store'])->middleware('auth', 'first_login')->name('users.store');
Route::post('/users/{user}', [UsersController::class, 'update'])->middleware('auth', 'first_login')->name('users.update');
Route::delete('/users/{user}', [UsersController::class, 'destroy'])->middleware('auth', 'first_login')->name('users.destroy');
Route::post('/users/{user}/restore', [UsersController::class, 'restore'])->middleware('auth', 'first_login')->name('users.restore');


