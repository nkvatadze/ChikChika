<?php

use App\Http\Controllers\API\TweetController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->name('api.')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {

        Route::controller(UserController::class)->prefix('me')->name('users.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::get('/followings', 'followings')->name('followings');
            Route::get('/follows', 'follows')->name('follows');
        });

        Route::controller(TweetController::class)->prefix('tweets')->name('tweets.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
});
