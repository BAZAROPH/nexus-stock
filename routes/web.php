<?php

use App\Http\Controllers\AllocationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\WorkerTypeController;
use Illuminate\Queue\Worker;
use Illuminate\Support\Facades\Route;


// login management
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth', 'first_login')->name('logout');

// create user management routes
Route::get('first-login', [AuthController::class, 'firstLoginView'])->name('first.login')->middleware('auth');
Route::post('first-login', [AuthController::class, 'firstLogin'])->name('first.login.perform')->middleware('auth');
Route::get("/email/verify/{id}/{hash}", [AuthController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware('auth', "first_login")->name('dashboard');

// User Management
Route::get('/users', [UsersController::class, 'index'])->middleware('auth', 'first_login')->name('users.index');
Route::post('/users', [UsersController::class, 'store'])->middleware('auth', 'first_login')->name('users.store');
Route::post('/users/{user}', [UsersController::class, 'update'])->middleware('auth', 'first_login')->name('users.update');
Route::delete('/users/{user}', [UsersController::class, 'destroy'])->middleware('auth', 'first_login')->name('users.destroy');
Route::post('/users/{user}/restore', [UsersController::class, 'restore'])->middleware('auth', 'first_login')->name('users.restore');


// Permissions Management
Route::get("/permissions", [PermissionController::class, 'index'])->middleware('auth', 'first_login')->name('permissions.index');
Route::post("/permissions", [PermissionController::class, 'store'])->middleware('auth', 'first_login')->name('permissions.store');
Route::post("/permissions/{permission}", [PermissionController::class, 'update'])->middleware('auth', 'first_login')->name('permissions.update');
Route::delete("/permissions/{permission}", [PermissionController::class, 'destroy'])->middleware('auth', 'first_login')->name('permissions.destroy');
Route::post("/permissions/{id}/restore", [PermissionController::class, 'restore'])->middleware('auth', 'first_login')->name('permissions.restore');

// Roles Management
Route::get("/roles", [RoleController::class, 'index'])->middleware('auth', 'first_login')->name('roles.index');
Route::post("/roles", [RoleController::class, 'store'])->middleware('auth', 'first_login')->name('roles.store');
Route::post("/roles/{role}", [RoleController::class, 'update'])->middleware('auth', 'first_login')->name('roles.update');
Route::delete("/roles/{role}", [RoleController::class, 'destroy'])->middleware('auth', 'first_login')->name('roles.destroy');
Route::post("/roles/{role}/restore", [RoleController::class, 'restore'])->middleware('auth', 'first_login')->name('roles.restore');

// Sites Management
Route::get('/sites', [SiteController::class, 'index'])->middleware('auth', 'first_login')->name('sites.index');
Route::post('/sites', [SiteController::class, 'store'])->middleware('auth', 'first_login')->name('sites.store');
Route::post('/sites/{site}', [SiteController::class, 'update'])->middleware('auth', 'first_login')->name('sites.update');
Route::delete('/sites/{site}', [SiteController::class, 'destroy'])->middleware('auth', 'first_login')->name('sites.destroy');
Route::post('/sites/{id}/restore', [SiteController::class, 'restore'])->middleware('auth', 'first_login')->name('sites.restore');

//Worker Types Management
Route::get('/worker-types', [WorkerTypeController::class, 'index'])->middleware('auth', 'first_login')->name('worker_types.index');
Route::post('/worker-types', [WorkerTypeController::class, 'store'])->middleware('auth', 'first_login')->name('worker_types.store');
Route::post('/worker-types/{workerType}', [WorkerTypeController::class, 'update'])->middleware('auth', 'first_login')->name('worker_types.update');
Route::delete('/worker-types/{workerType}', [WorkerTypeController::class, 'destroy'])->middleware('auth', 'first_login')->name('worker_types.destroy');
Route::post('/worker-types/{id}/restore', [WorkerTypeController::class, 'restore'])->middleware('auth', 'first_login')->name('worker_types.restore');

// Worker Management
Route::get('/workers', [WorkerController::class, 'index'])->middleware('auth', 'first_login')->name('workers.index');
Route::post('/workers', [WorkerController::class, 'store'])->middleware('auth', 'first_login')->name('workers.store');
Route::post('/workers/{worker}', [WorkerController::class, 'update'])->middleware('auth', 'first_login')->name('workers.update');
Route::delete('/workers/{worker}', [WorkerController::class, 'destroy'])->middleware('auth', 'first_login')->name('workers.destroy');
Route::post('/workers/{id}/restore', [WorkerController::class, 'restore'])->middleware('auth', 'first_login')->name('workers.restore');

// Allocation Management
Route::get('/allocations', [AllocationController::class, 'index'])->middleware('auth', 'first_login')->name('allocations.index');
Route::post('/allocations', [AllocationController::class, 'store'])->middleware('auth', 'first_login')->name('allocations.store');
Route::post('/allocations/{allocation}', [AllocationController::class, 'update'])->middleware('auth', 'first_login')->name('allocations.update');
Route::delete('/allocations/{allocation}', [AllocationController::class, 'destroy'])->middleware('auth', 'first_login')->name('allocations.destroy');
Route::post('/allocations/{id}/restore', [AllocationController::class, 'restore'])->middleware('auth', 'first_login')->name('allocations.restore');

Route::get('/stocks', [StockController::class, 'index'])->middleware('auth', 'first_login')->name('stocks.index');

