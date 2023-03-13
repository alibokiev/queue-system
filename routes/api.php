<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CabinetController;
use App\Http\Controllers\Api\ReceptionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::group(['middleware' => ['auth']], function () {
        Route::get('logout', [AuthController::class, 'logout']);
    });


    Route::middleware('auth:api')->group(function () {
        //user
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::get('/cabinet', [CabinetController::class, 'index']);
        Route::post('/cabinet/accept', [CabinetController::class, 'accept']);
        Route::post('/cabinet/done', [CabinetController::class, 'done']);

        Route::get('/reception', [ReceptionController::class, 'index']);
        Route::post('/reception', [ReceptionController::class, 'store']);
    });
});

// 404 json
Route::fallback([\App\Http\Controllers\HomeController::class, 'fallback']);
