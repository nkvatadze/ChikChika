<?php

use App\Http\Controllers\{Auth\EmailVerificationController,
    Auth\ForgotPasswordController,
    Auth\LoginController,
    Auth\RegisterController,
    Auth\ResetPasswordController,
    NotificationController,
    UserController
};
use App\Http\Livewire\{Followers, Followings, Home, ShowTweet, ShowUser};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationController::class, 'create'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');
});


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisterController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('login', [LoginController::class, 'store']);

    Route::get('forgot-password', [ForgotPasswordController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [ForgotPasswordController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [ResetPasswordController::class, 'store'])
        ->name('password.update');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('/', '/home');
    Route::get('/home', Home::class)->name('home');
    Route::get('/{user:username}/followers', Followers::class)->name('users.followers');
    Route::get('/{user:username}/followings', Followings::class)->name('users.followings');

    Route::controller(UserController::class)->prefix('users')->name('users.')
        ->group(function () {
            Route::get('/edit', 'edit')->name('edit');
            Route::patch('/', 'update')->name('update');
        });

    Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
});

Route::get('/{user:username}', ShowUser::class)->name('users.show');
Route::get('/tweets/{tweet}', ShowTweet::class)->name('tweets.show');
