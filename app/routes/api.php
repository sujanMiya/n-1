<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::group(['prefix' => 'v1'], function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('api.register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('api.register.store');
    Route::get('/login', [AuthController::class, 'index'])->name('api.login.index');
    Route::post('/login', [AuthController::class, 'store'])->name('api.login.store');
});
