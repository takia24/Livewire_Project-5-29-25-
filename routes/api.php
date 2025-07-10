<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

// Sanctum token issue route
Route::post('/sanctum/token', [AuthController::class, 'issueToken'])
    ->name('sanctum.token');

// Authenticated API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('index');      // List tasks
    Route::post('/tasks', [TaskController::class, 'store'])->name('store');     // Create task
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('show');   // Show single task
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('update'); // Update task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('destroy'); // Delete task
});

// Get current authenticated user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
