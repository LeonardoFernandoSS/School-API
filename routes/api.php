<?php

use App\Http\Controllers\Api\AbilityController;
use App\Http\Controllers\Api\AbilityRoleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\RoleUserController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudentPhotoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserPhotoController;
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

        Route::resource('ability', AbilityController::class)->only(['index']);

        Route::resource('role', RoleController::class)->except(['edit', 'create']);

        Route::prefix('role/{role}')->group(function () {

            Route::post('sync', [AbilityRoleController::class, 'sync']);
            Route::post('related', [AbilityRoleController::class, 'related']);
            Route::post('unrelated', [AbilityRoleController::class, 'unrelated']);
        });

        Route::resource('user', UserController::class)->except(['edit', 'create']);

        Route::prefix('user/{user}')->group(function () {

            Route::post('photo', [UserPhotoController::class, 'upload']);
            Route::delete('photo', [UserPhotoController::class, 'delete']);
        });

        Route::prefix('user/{user}')->group(function () {

            Route::post('sync', [RoleUserController::class, 'sync']);
            Route::post('related', [RoleUserController::class, 'related']);
            Route::post('unrelated', [RoleUserController::class, 'unrelated']);
        });

        Route::resource('student', StudentController::class)->except(['edit', 'create']);

        Route::prefix('student/{student}')->group(function () {

            Route::post('photo', [StudentPhotoController::class, 'upload']);
            Route::delete('photo', [StudentPhotoController::class, 'delete']);
        });
    });
});
