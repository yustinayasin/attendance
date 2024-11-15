<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/users/register', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::get('/users', [UserController::class, 'index']);

Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

// Protected User CRUD Routes
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::resource('users', UserController::class)->except(['create', 'edit']);

//     // Route to get the authenticated user's data
//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     });
// });
