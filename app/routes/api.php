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
    Route::get('/register', [RegisterController::class, 'index'])->name('api.register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('api.register.store');
    Route::get('/login', [AuthController::class, 'index'])->name('api.login.index');
    Route::post('/login', [AuthController::class, 'store'])->name('api.login.store');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/services', [ServiceController::class, 'index']);
});
