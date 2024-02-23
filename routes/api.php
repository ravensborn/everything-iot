<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MainController;
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

Route::prefix('v1')->group(function () {

    Route::post('/token/create', [AuthController::class, 'createToken']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/submit-support-request', [MainController::class, 'submitSupportRequest']);
    });

});


