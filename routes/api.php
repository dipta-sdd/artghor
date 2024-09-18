<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorFamilyController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    Route::any('auth/me', [AuthController::class, 'me']);
    Route::post('auth/otp', [AuthController::class, 'otp']);
    Route::post('auth/verify', [AuthController::class, 'verify']);
});


Route::group(['prefix' => 'banner'], function ($router) {
    Route::controller(BannerController::class)->group(function () {
        Route::get('index', 'index');
        Route::post('create', 'create')->middleware(['auth:api', AdminMiddleware::class]);
        Route::delete('delete/{id}', 'delete')->middleware(['auth:api', AdminMiddleware::class]);
        Route::put('update', 'update')->middleware(['auth:api', AdminMiddleware::class]);
    });
});

Route::group(['prefix' => 'category'], function ($router) {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('read/{id}', 'read');
        Route::post('create', 'create')->middleware(['auth:api', AdminMiddleware::class]);
        Route::post('update/{id}', 'update')->middleware(['auth:api', AdminMiddleware::class]);
        Route::delete('delete/{id}', 'delete')->middleware(['auth:api', AdminMiddleware::class]);
    });
});


Route::group(['prefix' => 'subCategory'], function ($router) {
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('read/{id}', 'read');
        Route::post('create', 'create')->middleware(['auth:api', AdminMiddleware::class]);
        Route::post('update/{id}', 'update')->middleware(['auth:api', AdminMiddleware::class]);
        Route::delete('delete/{id}', 'delete')->middleware(['auth:api', AdminMiddleware::class]);
    });
});


Route::group(['prefix' => 'product'], function ($router) {
    Route::controller(ProductController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('read/{id}', 'read');
        Route::post('create', 'create')->middleware(['auth:api', AdminMiddleware::class]);
        Route::post('update/{id}', 'update')->middleware(['auth:api', AdminMiddleware::class]);
        Route::delete('delete/{id}', 'delete')->middleware(['auth:api', AdminMiddleware::class]);
    });
});

Route::group(['prefix' => 'colorFamily'], function ($router) {
    Route::controller(ColorFamilyController::class)->group(function () {
        Route::get('index', 'index');
        Route::get('read/{id}', 'read');
        Route::post('create', 'create')->middleware(['auth:api', AdminMiddleware::class]);
        Route::post('update/{id}', 'update')->middleware(['auth:api', AdminMiddleware::class]);
        Route::delete('delete/{id}', 'delete')->middleware(['auth:api', AdminMiddleware::class]);
    });
});


Route::group(['prefix' => 'cart'], function ($router) {
    Route::controller(CartController::class)->group(function () {
        Route::post('add/{product_id}', 'addToCart');
        Route::post('update/{id}', 'update');
        Route::delete('delete/{id}', 'delete');
        Route::get('get', 'showCart');
        Route::post('checkout', 'checkout');
        Route::post('confirm/{id}', 'confirmOrder');
    });
});
