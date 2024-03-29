<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryProductController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\ProductImageController;

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

Route::post('register',[RegisterController::class, 'register']);
Route::post('login',[RegisterController::class, 'login']);
Route::get('unautorized',[RegisterController::class, 'unautorized'])->name('unautorized');

Route::middleware('auth:api')->group(function () {
    Route::resource('categorys', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('category-products', CategoryProductController::class);
    Route::resource('images', ImageController::class);
    Route::resource('product-images', ProductImageController::class);
});
