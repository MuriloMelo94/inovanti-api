<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticationController::class, 'login'])
    ->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthenticationController::class, 'logout'])
        ->name('logout');

    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('products');
        Route::get('/{id}', 'show')->name('products.show');
        Route::post('/', 'store')->name('products.store');
        Route::put('/{id}', 'update')->name('products.update');
        Route::delete('/{id}', 'delete')->name('products.delete');
    });
});
