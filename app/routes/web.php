<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/nplusone', [BookController::class, 'nPlusOneProblem']);
Route::get('/eager', [BookController::class, 'withEagerLoading']);
