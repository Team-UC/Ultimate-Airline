<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\isAdmin;

Route::get('/', function () {
      return view('home');
});

Route::get('/about', function () {
      return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Example CRUD routes
    Route::resource('users', AdminUserController::class);
    Route::resource('settings', AdminSettingController::class);
});
// routes/web.php
Route::get('auth/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/check-flights', [FlightController::class, 'check'])->name('check.flights');
Route::get('/autocomplete/cities', [FlightController::class, 'search']);

