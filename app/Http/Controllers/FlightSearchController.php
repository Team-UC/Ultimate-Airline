<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlightSearchController extends Controller
{
    //
    public function search($from, $to, $date, $id)
    {
        // Format the date
        $formattedDate = \Carbon\Carbon::parse($date)->toDateString();
        $flights = session('flights');
    $flight = collect($flights)->firstWhere('id', $id);

        return view('flights.search_results', [
            'from' => $from,
            'to' => $to,
            'date' => $formattedDate,
            'id' => $id,
            'flight' => $flight,
        ]);
    }

}
