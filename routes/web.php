<?php
use Illuminate\Http\Request;
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

Route::post('/store-flight-data', function (Request $request) {
    session(['flights' => json_decode($request->flights, true)]);
    return response()->json(['status' => 'ok']);
});

Route::get('/flight-results', function () {
    $flights = session('flights', []);
    return view('flights', compact('flights'));
});
// Route::get('/search/flight-tickets-from-{origin}-to-{destination}-{date}/{id}', [FlightController::class, 'show'])->name('book.flight');
Route::get('/search/flight-tickets-from-{from}-to-{to}-{date}/{id}', [FlightSearchController::class, 'search'])->name('flight.book');

