<?php

use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
    SupportController,
    ReplyController,
};
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');


/**
 * 
 * Reset password
 */

Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');


Route::middleware(['auth:sanctum'])->group(function () {


    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);


    Route::get('/courses/{id}/modules', [ModuleController::class, 'index']);

    Route::get('/modules/{id}/lessons', [LessonController::class, 'index']);
    Route::get('/modules/{id}', [LessonController::class, 'show']);

    Route::post('/lessons/viewed', [LessonController::class, 'viewed']);

    Route::get('/supports', [SupportController::class, 'index']);

    Route::post('/replies', [ReplyController::class, 'teste']);

    Route::post('/supports', [SupportController::class, 'store']);

    Route::get('/mysupports', [SupportController::class, 'mySupports']);
});
Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
