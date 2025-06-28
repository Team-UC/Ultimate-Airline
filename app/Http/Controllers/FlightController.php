<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlightController extends Controller
{
    
    public function check(Request $request)
    {
        $accessToken = $this->getAccessToken(); // step 3

        $response = Http::withToken($accessToken)->get('https://test.api.amadeus.com/v2/shopping/flight-offers', [
            'originLocationCode'      => $request->origin,
            'destinationLocationCode' => $request->destination,
            'departureDate'           => $request->input('departure-date'),
            'returnDate'              => $request->input('return-date'),
            'adults'                  => $request->adult,
            'max'                     => 5
        ]);

        return $response->json();
    }

    private function getAccessToken()
    {
        $response = Http::asForm()->post('https://test.api.amadeus.com/v1/security/oauth2/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => env('AMADEUS_CLIENT_ID'),
            'client_secret' => env('AMADEUS_CLIENT_SECRET'),
        ]);

        return $response->json()['access_token'];
    }
}


