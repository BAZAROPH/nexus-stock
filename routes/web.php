<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthController::class, 'loginView'])->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');


Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware('auth')->name('dashboard');
