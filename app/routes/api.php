<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::group(['prefix' => 'v1'], function () {
    Route::get('/ami', function () {
         echo formatDate('2023-10-01 12:00:00');
    });
});
