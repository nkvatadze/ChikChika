<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\Home;
use App\Http\Livewire\ShowUser;
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

Route::redirect('/', '/home');

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/{user:username}', ShowUser::class)->name('users.show');

    Route::controller(UserController::class)->prefix('users')->name('users.')
        ->group(function () {
            Route::get('/edit', 'edit')->name('edit');
            Route::patch('/', 'update')->name('update');
        });
});

