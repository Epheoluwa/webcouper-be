<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return $request->user();
});

// Auth routes 
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/users', [FrontendController::class, 'fetchusers']);
Route::get('/fetchrecipes', [FrontendController::class, 'fetchrecipes']);
Route::get('/users/{username}', [FrontendController::class, 'fetchSingleUser']);
Route::get('/activate/{username}', [AuthController::class, 'activate']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/deactivate', [AuthController::class, 'deactivate']);
    // Route::get('/profile', [FrontendController::class, 'fetchAuthenticatedUsers']);
});


