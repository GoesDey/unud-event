<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPageController;
use App\Livewire\User\UserEvent;
use Illuminate\Support\Facades\Route;

Route::get('/events', UserEvent::class)->name('events');
Route::controller(UserPageController::class)->group(function (){
   Route::get('/', 'index')->name('home');
   Route::get('/events/{event}', 'detailEvent')->name('event-detail');
});


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
