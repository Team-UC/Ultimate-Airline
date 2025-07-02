<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
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


Route::get('/check-flights', [FlightController::class, 'check'])->name('check.flights');
Route::get('/autocomplete/cities', [FlightController::class, 'search']);

