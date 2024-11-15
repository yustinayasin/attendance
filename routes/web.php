<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

// Authentication Routes (UI routes)
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login')->middleware('guest');

Route::get('/employees/create', [EmployeeController::class, 'create']); // Show form to create new employee
Route::get('/employees/{id}', [EmployeeController::class, 'show']); // Show details of a specific employee
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit']); // Show form to edit an employee

// User CRUD UI Routes
Route::middleware(['auth'])->group(function () {
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
});
