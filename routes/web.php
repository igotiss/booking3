<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

//User

Route::prefix('profile')->middleware('verified')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'showProfile'])->name('show_profile');
        Route::get('edit', [\App\Http\Controllers\UserController::class, 'editProfile'])->name('edit_profile');
        Route::patch('/', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('update_profile');
    });

