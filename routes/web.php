<?php

use App\Http\Controllers\OAuthController;
use App\Http\Controllers\LandingPageController;
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

Route::get('/', [OAuthController::class, 'index']);

Route::get('/oauth/authenticate', [OAuthController::class, 'authenticate'])->name('authenticate');

