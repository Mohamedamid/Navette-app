<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnonceController;

// Route protégée par le middleware AuthMiddleware
// Only authenticated users can access this route
Route::get('/', [AuthController::class, 'index'])->middleware('auth');

// Login routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'AuthLogin']);

// Registration routes
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/company', [AnnonceController::class, 'index'])->name('company')->middleware('auth');
Route::get('/company', [AnnonceController::class, 'index'])->name('company')->middleware('auth');
Route::get('/form', [AnnonceController::class, 'display'])->name('form')->middleware('auth');
Route::post('/form', [AnnonceController::class, 'store'])->name('store')->middleware('auth');
Route::post('/voyages/update-status/{id}', [AnnonceController::class, 'updateStatus'])->name('voyage.updateStatus');