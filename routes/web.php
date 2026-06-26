<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login.authenticate');
Route::post('/admin/logout', [LoginController::class, 'logout'])
   ->middleware('auth')
   ->name('admin.logout');


Route::middleware(['auth', 'role:admin'])->group(function () {
   Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
});

Route::view('/faq', 'user.faq')->name('faq');
