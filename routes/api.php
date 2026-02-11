<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
//     Route::post('/dashboard', [\App\Http\Controllers\Api\AuthController::class, 'index'])->name('dashboard');
// });
