<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BioimpedanceController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseMaximumController;
use App\Http\Middleware\InjectUserIdInRequestMiddleware;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/exercises', [ExerciseController::class, 'list']);

Route::prefix('{user_id}')->middleware(['auth:sanctum', InjectUserIdInRequestMiddleware::class])->group(function () {
    Route::post('/bioimpedances', [BioimpedanceController::class, 'store']);
    
    Route::prefix('exercise-maximums')->group(function () {
        Route::post('/{exercise_id}', [ExerciseMaximumController::class, 'store']);
        Route::get('/{exercise_id}', [ExerciseMaximumController::class, 'show']);
    });
});
