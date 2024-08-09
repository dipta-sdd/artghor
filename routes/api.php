<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\Controller;
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
    Route::post('auth/me', [AuthController::class, 'me']);
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
