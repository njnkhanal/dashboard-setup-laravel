<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// for admin dashboard (prefix is used like (127.0.0.1:8000/admin/dashboard))
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
