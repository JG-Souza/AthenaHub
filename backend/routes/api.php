<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Rotas de autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Rotas de CRUD de Usuários
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/show/{id}', [UserController::class, 'show']);
    Route::post('/store', [UserController::class, 'store']);
    Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/index', [UserController::class, 'index']);
    Route::put('/update/{id}', [UserController::class, 'update']);
});

