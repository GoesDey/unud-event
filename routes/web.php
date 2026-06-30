<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPageController;
use App\Livewire\SuperAdmin\Settings;
use App\Livewire\User\UserEvent;
use Illuminate\Support\Facades\Route;

Route::get('/events', UserEvent::class)->name('events');
Route::controller(UserPageController::class)->group(function () {
   Route::get('/', 'index')->name('home');
   Route::get('/events/{event}', 'detailEvent')->name('event-detail');
});

// Login
Route::get('/user/login', [LoginController::class, 'index'])->name('login');
Route::post('/user/login', [LoginController::class, 'login'])->name('login.authenticate');
Route::post('/user/logout', [LoginController::class, 'logout'])
   ->middleware('auth')
   ->name('admin.logout');

// Super Admin
Route::middleware(['auth', 'role:super_admin'])
   ->prefix('sadmin')
   ->name('super-admin.')
   ->group(function () {
      // Route::view('/dashboard', 'super-admin.dashboard')->name('dashboard');
      Route::get('/settings', Settings::class)->name('settings');
      Route::get('/manage-user', App\Livewire\SuperAdmin\User\Index::class)->name('manage-user');
      Route::get('/manage-user/add', App\Livewire\SuperAdmin\User\Create::class)->name(
         'manage-user.create',
      );
   });

// Admin
Route::middleware(['auth', 'role:admin'])
   ->prefix('admin')
   ->name('admin.')
   ->group(function () {
      // Route::view('/', 'admin.dashboard')->name('dashboard');
      Route::get('/manage-event', App\Livewire\Admin\Event\Index::class)->name('manage-event');
      Route::get('/manage-event/add', App\Livewire\Admin\Event\Create::class)->name(
         'manage-event.create',
      );
      Route::get('/manage-event/{event}/edit', App\Livewire\Admin\Event\Edit::class)->name(
         'manage-event.edit',
      );
   });

Route::view('/faq', 'user.faq')->name('faq');
