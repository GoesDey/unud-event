<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login.authenticate');
Route::post('/admin/logout', [LoginController::class, 'logout'])
   ->middleware('auth')
   ->name('admin.logout');

Route::middleware(['auth', 'role:admin'])
   ->prefix('admin')
   ->name('admin.')
   ->group(function () {
      Route::view('/', 'admin.dashboard')->name('dashboard');
      Route::get('/manage-event', App\Livewire\Admin\Event\Index::class)->name('manage-event');
      Route::get('/manage-event/add', App\Livewire\Admin\Event\Create::class)->name(
         'manage-event.create',
      );
      Route::get('/manage-event/{event}/edit', App\Livewire\Admin\Event\Edit::class)->name(
         'manage-event.edit',
      );
   });

Route::view('/', 'welcome')->name('home');
Route::view('/faq', 'user.faq')->name('faq');
