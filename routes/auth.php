<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// 公共接口：注册、登录成功后都会返回 Sanctum token。
Route::post('/register', [RegisteredUserController::class, 'store'])->name('api.register');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('api.login');

// 受保护接口：要求来访者携带 Bearer Token（auth:sanctum）。
Route::middleware('auth:sanctum')->group(function (): void {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('api.logout');
});
