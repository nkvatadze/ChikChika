<?php

use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function () {
    Route::get('/home', \App\Http\Livewire\HomeComponent::class)
        ->middleware('verified')->name('home');

    Route::controller(UserController::class)->prefix('users')->name('users.')
        ->group(function () {
            Route::get('/edit', 'edit')->name('edit');
            Route::patch('/', 'update')->name('update');
        });
});

require __DIR__ . '/auth.php';
