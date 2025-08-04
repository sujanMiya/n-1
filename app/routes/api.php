<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\RegisterController;


Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::get('');
});
Route::group(['prefix' => 'v1'], function () {
    Route::get('/register', [AuthController::class, 'registerView'])->name('api.register.registerView');
    Route::post('/register', [AuthController::class, 'register'])->name('api.register.register');
    Route::get('/login', [AuthController::class, 'loginView'])->name('api.login.loginView');
    Route::post('/login', [AuthController::class, 'login'])->name('api.login.login');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/services', [ServiceController::class, 'index']);
});
