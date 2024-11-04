<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'apiRegister']);
Route::post('/login', [AuthController::class, 'apiLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/item', [ItemsController::class, 'apiIndex']);

    Route::get('/request', [RequestController::class, 'apiIndex']);
    Route::post('/request/store', [RequestController::class, 'apiStore']);
    Route::delete('/request/{id}', [RequestController::class, 'apiDestroy']);

    Route::put('/profile/{profile}', [ProfileController::class, 'apiUpdate']);

    Route::post('logout', [AuthController::class, 'apiLogout']);
});
