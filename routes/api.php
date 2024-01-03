<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::prefix('v1')->group(function () {
    // With token
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('role', [RoleController::class, 'index']);
        Route::post('role', [RoleController::class, 'store']);
    });

    // Without token
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
});
