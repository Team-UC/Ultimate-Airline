<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FlightSearchController;
use App\Http\Middleware\isAdmin;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home']);

Route::get('/about', function () {
      return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::get('/search/flight-tickets-from-{from}-to-{to}-{date}/{id}', [FlightSearchController::class, 'search'])
    ->name('flight.search');





