<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    // Тестовый маршрут
    Route::get('/ping', function () {
        return response()->json(['message' => 'API работает! 🚀']);
    });

    // Авторизация
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    // CRUD для тем и постов
    Route::apiResource('/threads', ThreadController::class);
    Route::apiResource('/posts', PostController::class);
});

