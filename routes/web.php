<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\UserOnline;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::middleware([UserOnline::class])->group(function () {
    Route::middleware('auth')->group(function () {
        Route::resource('request', RequestController::class)->only('store', 'destroy');
        Route::resource('profile', ProfileController::class)->only('update');

        Route::get('request/pdf', [RequestController::class, 'generatePDF'])->name('request.pdf');
        Route::get('lending/pdf', [LendingController::class, 'generatePDF'])->name('lending.pdf');


        Route::middleware([IsUser::class])->group(function () {
            // User View
            Route::get('item', [HomeController::class, 'item'])->name('item');
            Route::get('lending', [HomeController::class, 'lending'])->name('lending');
            Route::get('bookmark', [HomeController::class, 'bookmark'])->name('bookmark');
            Route::get('about', [HomeController::class, 'about'])->name('about');
            Route::resource('dashboard', HomeController::class)->only('index');
            // User Feature
            Route::resource('item', ItemsController::class)->only('show');
            Route::resource('profile', ProfileController::class)->only('index');
            Route::post('bookmark/add/{itemId}', [ItemsController::class, 'addBookmark'])->name('bookmark.store');
            Route::delete('bookmark/destroy/{itemId}', [ItemsController::class, 'removeBookmark'])->name('bookmark.destroy');
            // Route::resource('request', RequestController::class)->only('store');
        });

        Route::middleware([IsAdmin::class])->group(function () {
            // Admin View
            Route::redirect('/admin', 'admin/dashboard');
            Route::get('/admin/dashboard', [DashboardController::class, 'index'])
                ->name('admin.dash');
            Route::get('/admin/about', [DashboardController::class, 'about'])
                ->name('admin.about');
            Route::get('/admin/profile', [DashboardController::class, 'profile'])->name('admin.profile');
            // Admin Resource
            Route::resource('admin/item', ItemsController::class)->except('show');
            Route::resource('admin/user', UserController::class);
            Route::resource('admin/category', CategoryController::class)->only('index', 'store', 'update', 'destroy');
            // Request & Lending
            Route::resource('admin/lending', LendingController::class);
            Route::resource('admin/request/pending', RequestController::class)->only('index');
            Route::get('admin/request/approved', [RequestController::class, 'approved'])->name('approved.index');
        });

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});


Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
