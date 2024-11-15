<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Authentication Routes
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// User Registration (Sign-up Route)
Route::post('/users/register', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::get('/users', [UserController::class, 'index']);

// Protected User CRUD Routes
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::resource('users', UserController::class)->except(['create', 'edit']);

//     // Route to get the authenticated user's data
//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     });
// });

