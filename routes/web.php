<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FlightSearchController;
use App\Http\Middleware\isAdmin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'home']);

Route::get('/about', function () {
      return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

// Route::get('/hotels', function () {
//     return view('hotels');
// });
Route::get('/hotels', function (Request $request) {
    $cityFromUrl = $request->query('city'); // gets ?city= from URL
    $cities = [
        ['name' => 'Dubai', 'country' => 'UAE', 'image' => 'dubai.jpg'],
        ['name' => 'Paris', 'country' => 'France', 'image' => 'paris.jpg'],
        ['name' => 'New York', 'country' => 'USA', 'image' => 'newyork.jpg'],
    ];

    return view('hotels', compact('cities', 'cityFromUrl'));
});


Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::get('/search/flight-tickets-from-{from}-to-{to}-{date}/{id}', [FlightSearchController::class, 'search'])
    ->name('flight.search');

Route::get('/login', function () {
    return view('login'); 
})->name('login'); 

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');


Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');

Route::post('/signup', [AuthController::class, 'handleSignup'])->name('signup.handle');

