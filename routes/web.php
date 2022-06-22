<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\Followers;
use App\Http\Livewire\Followings;
use App\Http\Livewire\Home;
use App\Http\Livewire\ShowTweet;
use App\Http\Livewire\ShowUser;
use App\Http\Livewire\Tweet;
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


require __DIR__ . '/auth.php';

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
});

Route::get('/{user:username}', ShowUser::class)->name('users.show');
Route::get('/tweets/{tweet}', ShowTweet::class)->name('tweets.show');

