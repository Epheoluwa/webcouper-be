<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\FEauthController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [FEauthController::class, 'loginRoute'])->name('login');
Route::get('register', [FEauthController::class, 'index'])->name('register');
Route::post('register', [FEauthController::class, 'register']);
Route::post('login', [FEauthController::class, 'login']);


Route::middleware(['auth'])->group(function () {
    Route::get('/', [FrontendController::class, 'recipe'])->name('/');
    Route::get('resturants', [FrontendController::class, 'resturants'])->name('resturants');
    Route::get('profile', [FrontendController::class, 'profile'])->name('profile');
    Route::get('allusers', [FrontendController::class, 'allusers'])->name('allusers');
    Route::get('/fetchrecipes', [FrontendController::class, 'fetchrecipes'])->name('fetchrecipes');
    Route::get('/fetchresturants', [FrontendController::class, 'searchResturants'])->name('fetchresturants');
    Route::get('logout', [FEauthController::class, 'logout'])->name('logout');
    Route::get('deactivate', [FEauthController::class, 'deactivate'])->name('deactivate');
});
