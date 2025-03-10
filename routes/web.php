<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\Permission;
use App\Http\Controllers\Tag;
use App\Http\Controllers\TagController;

Route::get('/', [AuthController::class, 'index'])->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'AuthLogin'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.submit');

Route::middleware(['auth'])->group(function () {
    Route::post('/voyages/update-status/{id}', [AnnonceController::class, 'updateStatus']);
    Route::delete('/destroy/{id}', [AnnonceController::class, 'destroy'])->name('destroy');
    Route::put('/update/{id}', [AnnonceController::class, 'update'])->name('update');
    Route::get('/edit/{id}', [AnnonceController::class, 'edit'])->name('edit');
    Route::post('/store', [AnnonceController::class, 'store'])->name('store');
    Route::get('/form', [AnnonceController::class, 'create'])->name('form');
    Route::get('/', [AnnonceController::class, 'index'])->name('company');
    Route::get('/tag', [TagController::class, 'index'])->name('index');
    Route::get('/permission', [Permission::class, 'index'])->name('indexPermission');
    Route::post('/permission', [Permission::class, 'store'])->name('permissionstore');
    Route::get('/permission/edit/{id}', [Permission::class, 'edit'])->name('editPermission');
    Route::put('/permission/update/{id}', [Permission::class, 'update'])->name('updatePermission');
    Route::delete('/permission/{id}', [Permission::class, 'destroy'])->name('destroyPermission');
    Route::post('/', [TagController::class, 'store'])->name('tags.store');
    Route::get('/edit/{id}', [TagController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [TagController::class, 'update'])->name('update');
    Route::delete('/{id}', [TagController::class, 'destroy'])->name('destroy');
});
