<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {

    Route::middleware([IsUser::class])->group(function () {
        Route::resource('dashboard', HomeController::class)->only('index');
        Route::resource('item', ItemsController::class)->only('show');
        Route::resource('request', RequestController::class)->only('store');
    });

    Route::middleware([IsAdmin::class])->group(function () {
        Route::redirect('/admin', 'admin/dashboard');
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dash');
        Route::resource('admin/item', ItemsController::class)->except('show');
        Route::resource('admin/request', RequestController::class);
        Route::resource('admin/user', UserController::class);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
