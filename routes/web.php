<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;

Route::get('/', function () {
      return view('home');
});
Route::get('/check-flights', [FlightController::class, 'check'])->name('check.flights');
Route::get('/autocomplete/cities', [FlightController::class, 'search']);
