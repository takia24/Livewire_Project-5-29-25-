<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Livewire\Action\TaskManager;
use App\Livewire\Counter;

Route::get('/counter', Counter::class);



Route::get('/', function () {
    return auth()->check() ? redirect()->route('tasks') : redirect()->route('login');
})->name('home');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Task manager Livewire component
    Route::get('/tasks', TaskManager::class)->name('tasks');

    // Logout route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
