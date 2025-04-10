<?php

use App\Http\Controllers\OAuthController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


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
Route::post('/authenticate', [ApiAuthController::class, 'authenticate']);
Route::get('/fetch-account-info', [OAuthController::class, 'fetchAccountInfo'])->name('fetch.account.info');
Route::get('/fetch-cards', [OAuthController::class, 'fetchCards'])->name('fetch.cards');
Route::get('/fetch-account-balance/{accountId}', [OAuthController::class, 'fetchAccountBalance'])->name('fetchAccountBalance.account.info');
Route::get('/api/authenticate', [OAuthController::class, 'authenticate'])->name('authenticate');