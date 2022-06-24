<?php

use App\Http\Controllers\API\TweetController;
use App\Http\Controllers\API\TweetLikeController;
use App\Http\Controllers\API\TweetReplyController;
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

        Route::prefix('tweets')->name('tweets.')->group(function () {
            Route::controller(TweetController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/{tweet}', 'show')->name('show');
            });

            Route::controller(TweetReplyController::class)->name('replies.')->group(function () {
                Route::get('/{tweet}/replies', 'index')->name('index');
                Route::post('/{tweet}/replies', 'store')->name('store');
            });

            Route::controller(TweetLikeController::class)->name('likes.')->group(function () {
                Route::post('/{tweet}/like', 'like')->name('like');
                Route::delete('/{tweet}/unlike', 'unlike')->name('unlike');

            });

        });
    });
});
