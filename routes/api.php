<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudentPhotoController;
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

Route::prefix('v1')->group(function () {

    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('logout', [AuthController::class, 'logout']);

        Route::resource('student', StudentController::class)->except(['edit','create']);

        Route::prefix('student/{student}')->group(function () {

            Route::post('photo', [StudentPhotoController::class, 'upload']);
            Route::delete('photo', [StudentPhotoController::class, 'delete']);
        });
        
    });
});
