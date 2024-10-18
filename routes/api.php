<?php

use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthenticationController::class, 'store'])
    ->name('login');

Route::post('/logout', [AuthenticationController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth:sanctum');
