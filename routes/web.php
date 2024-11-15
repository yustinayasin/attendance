<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication Routes (UI routes)
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login')->middleware('guest');

// User CRUD UI Routes
Route::middleware(['auth'])->group(function () {
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
});
