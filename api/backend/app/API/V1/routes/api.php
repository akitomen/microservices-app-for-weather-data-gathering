<?php

use App\API\V1\Controllers\CityWeatherController;
use App\API\V1\Controllers\JwtAuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    /** Auth */
    Route::group( ['prefix' => 'auth'], function () {
        Route::get('login', [JwtAuthController::class, 'login']);
        Route::post('login', [JwtAuthController::class, 'login']);
        Route::post('user', [JwtAuthController::class, 'user']);
        Route::post('logout', [JwtAuthController::class, 'logout']);
        Route::post('refresh', [JwtAuthController::class, 'refresh']);
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/', [CityWeatherController::class, 'index']);
        Route::get('update/{city_id}', [CityWeatherController::class, 'update']);
    });

});
