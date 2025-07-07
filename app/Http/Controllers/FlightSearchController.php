<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlightSearchController extends Controller
{
    //
    public function search($from, $to, $date, $id)
    {
        // Format the date
        $formattedDate = \Carbon\Carbon::parse(str_replace('-', ' ', $date))->toDateString();

        return view('flights.search_results', [
            'from' => $from,
            'to' => $to,
            'date' => $formattedDate,
            'id' => $id,
        ]);
    }

}
