<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MobileDataController;

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [MobileDataController::class, 'me']);
    Route::get('/items', [MobileDataController::class, 'items']);
    Route::get('/loans', [MobileDataController::class, 'loans']);
    Route::get('/loan-stats', [MobileDataController::class, 'loanStats']);
});
