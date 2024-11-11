<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Middleware\UserOnline;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'apiRegister']);
Route::post('/login', [AuthController::class, 'apiLogin']);

Route::middleware([UserOnline::class])->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/item', [ItemsController::class, 'apiIndex']);
        Route::get('/bookmark/{id}', [ItemsController::class, 'apiCheckBook']);
        Route::get('/bookmark/user/{id}', [ItemsController::class, 'apiGetBooked']);
        Route::post('/bookmark/{id}', [ItemsController::class, 'apiBooked']);
    
        Route::get('profile/{user}', [ProfileController::class, 'apiGet']);
    
        Route::get('/request', [RequestController::class, 'apiIndex']);
        Route::post('/request/store', [RequestController::class, 'apiStore']);
        Route::delete('/request/{id}', [RequestController::class, 'apiDestroy']);
    
        Route::put('/profile/{profile}', [ProfileController::class, 'apiUpdate']);
    
        Route::post('logout', [AuthController::class, 'apiLogout']);
    });
});
