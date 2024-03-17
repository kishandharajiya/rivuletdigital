<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // CREATE ALL THE TASK ROUTES
    Route::resource('tasks', TaskController::class);
    Route::prefix('tasks')->group(function () {
        Route::get('{task}/change-status', [TaskController::class,'changeStatusPage'])->name('tasks.change-status-page');
        Route::put('change-status/{task}', [TaskController::class,'changeStatus'])->name('tasks.change-status');
    });

    // CREATE USER ROUTES
    Route::resource('users', UserController::class);

    
});