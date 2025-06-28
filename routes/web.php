<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
      return view('home');
});
Route::get('/check-flights', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'origin' => $request->origin,
        'destination' => $request->destination,
        'departure_date' => $request->input('departure-date'),
        'adults' => $request->adult,
        'children' => $request->children
    ]);
})->name('check.flights');
