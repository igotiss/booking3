<?php

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

// Public routes
Route::get('stays', [\App\Http\Controllers\Api\StayApiController::class, 'index']);
Route::get('types', [\App\Http\Controllers\Api\StayApiController::class, 'getTypes']);
Route::get('rating/{stay_id}', [\App\Http\Controllers\Api\StayApiController::class, 'getRating']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
