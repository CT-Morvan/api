<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BioimpedanceController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseMaximumController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\InjectUserIdInRequestMiddleware;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/exercises', [ExerciseController::class, 'list']);

Route::prefix('{user_id}')->middleware(['auth:sanctum', InjectUserIdInRequestMiddleware::class])->group(function () {
    Route::prefix('bioimpedances')->group(function () {
        Route::get('/', [BioimpedanceController::class, 'list']);
        Route::post('/', [BioimpedanceController::class, 'store']);
    });
    
    Route::prefix('exercise-maximums')->group(function () {
        Route::get('/list', [ExerciseMaximumController::class, 'list']);
        Route::post('/batch', [ExerciseMaximumController::class, 'batchStore']);
        Route::post('/{exercise_id}', [ExerciseMaximumController::class, 'store']);
        Route::get('/{exercise_id}', [ExerciseMaximumController::class, 'show']);
    });
});

Route::prefix('/users')->middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});

Route::prefix('/exercises')->middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    Route::post('/', [ExerciseController::class, 'store']);
    Route::delete('/{exercise}', [ExerciseController::class, 'destroy']);
});
