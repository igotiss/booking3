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

// Users

Route::prefix('profile')
    ->name('profile.')
    ->middleware('verified')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'showProfile'])->name('show');
        Route::get('edit', [\App\Http\Controllers\UserController::class, 'editProfile'])->name('edit');
        Route::patch('/', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('update');
    });


// Stays
Route::prefix('stays')
    ->name('stays.')
    ->middleware('verified')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\StayController::class, 'index'])->name('own_index');
        Route::get('/{stay}', [\App\Http\Controllers\StayController::class, 'show'])->name('show');
        Route::post('/', [\App\Http\Controllers\StayController::class, 'store'])->name('store');
        Route::get('/edit/{stay}', [\App\Http\Controllers\StayController::class, 'edit'])->name('edit');
        Route::patch('/{stay}', [\App\Http\Controllers\StayController::class, 'update'])->name('update');
        Route::delete('/{stay}', [\App\Http\Controllers\StayController::class, 'destroy'])->name('destroy');

        // Rating
        Route::post('/rating/{stay}', [\App\Http\Controllers\RatingController::class, 'rate'])->name('rating');
    });
Route::get('create', [\App\Http\Controllers\StayController::class, 'create'])->name('create')->middleware('verified');

// Bookings
Route::prefix('booking')
    ->name('booking.')
    ->middleware('verified')
    ->group(function (){
        Route::get('/{stay}', [\App\Http\Controllers\BookingController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\BookingController::class, 'store'])->name('store');
        Route::get('/', [\App\Http\Controllers\BookingController::class, 'index'])->name('index');
        Route::post('/change/', [\App\Http\Controllers\BookingController::class, 'changeStatus'])->name('change');

    });
Route::get('/own_booking/', [\App\Http\Controllers\BookingController::class, 'indexOwn'])->name('booking.own-index')->middleware('verified');


// Feedbacks

Route::prefix('feedback')
    ->name('feedback.')
    ->middleware('verified')
    ->group(function (){
        Route::get('/', [\App\Http\Controllers\FeedbackController::class, 'index'])->name('index');
        Route::get('/{feedback}', [\App\Http\Controllers\FeedbackController::class, 'show'])->name('show');
        Route::get('/{feedback}', [\App\Http\Controllers\FeedbackController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\FeedbackController::class, 'store'])->name('store');
        Route::get('/edit/{feedback}', [\App\Http\Controllers\FeedbackController::class, 'edit'])->name('edit');
        Route::patch('/{feedback}', [\App\Http\Controllers\FeedbackController::class, 'update'])->name('update');
        Route::delete('/{feedback}', [\App\Http\Controllers\FeedbackController::class, 'destroy'])->name('delete');
    });

// Messages
Route::prefix('messages')
    ->name('messages.')
    ->middleware('verified')
    ->group(function (){
        Route::get('/', [\App\Http\Controllers\MessageController::class, 'index'])->name('index');
    });

Route::prefix('admin/messages')
    ->name('messages.')
    ->middleware('verified', )
    ->middleware( 'is_admin')
    ->group(function (){
        Route::get('/create', [\App\Http\Controllers\MessageController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\MessageController::class, 'store'])->name('store');
        Route::get('/edit/{message}', [\App\Http\Controllers\MessageController::class, 'edit'])->name('edit');
        Route::patch('/{message}', [\App\Http\Controllers\MessageController::class, 'update'])->name('update');
        Route::delete('/{message}', [\App\Http\Controllers\MessageController::class, 'destroy'])->name('delete');
    });
