<?php

use App\Http\Controllers\authentication\LoginController;
use App\Http\Controllers\authentication\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum','role:admin']);

Route::apiResource('/register', RegisterController::class);

Route::post('/login', [LoginController::class, 'login']);

Route::apiResource('/categories', CategoryController::class)
    ->only(['index', 'show']);
Route::apiResource('/categories', CategoryController::class)
    ->only(['store', 'update','destroy'])
    ->middleware(['auth:sanctum','role:admin']);

Route::apiResource('/products', ProductController::class)
    ->only(['index', 'show']);
Route::apiResource('/products', ProductController::class)
    ->only(['store', 'update','destroy'])
    ->middleware('auth:sanctum');

Route::apiResource('/transactions', TransactionController::class)->middleware('auth:sanctum');
