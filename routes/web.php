<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login.authenticate');
Route::post('/admin/logout', [LoginController::class, 'logout'])
   ->middleware('auth')
   ->name('admin.logout');


Route::middleware(['auth', 'role:admin'])->group(function () {
   Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
});

Route::view('/', 'welcome')->name('home');
Route::view('/faq', 'user.faq')->name('faq');
