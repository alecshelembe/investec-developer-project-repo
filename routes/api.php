<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use Illuminate\Support\Facades\Http;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/fetch-account-info', [ApiAuthController::class, 'fetchAccountInfo']);
Route::post('/authenticate', [ApiAuthController::class, 'authenticate']);
Route::post('/fetch-account-balance', [ApiAuthController::class, 'fetchAccountBalance']);
Route::post('/location', [ApiAuthController::class, 'store', 'location']);
Route::get('/main-notification', [ApiAuthController::class, 'main_notification']);
