<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlightController extends Controller
{
    
    public function check(Request $request)
    {
        $accessToken = $this->getAccessToken(); // step 3

        // Extract IATA codes from (XYZ)
        preg_match('/\((\w{3})\)$/', $request->origin, $originMatch);
        preg_match('/\((\w{3})\)$/', $request->destination, $destinationMatch);

        $originCode = $originMatch[1] ?? null;
        $destinationCode = $destinationMatch[1] ?? null;

        // Optional: Validate codes exist
        if (!$originCode || !$destinationCode) {
            return back()->withErrors(['message' => 'Invalid origin or destination format.']);
        }

        $response = Http::withToken($accessToken)->get('https://test.api.amadeus.com/v2/shopping/flight-offers', [
            'originLocationCode'      => $originCode,
            'destinationLocationCode' => $destinationCode,
            'departureDate'           => $request->input('departure-date'),
            'returnDate'              => $request->input('return-date'),
            'adults'                  => $request->adult,
            'max'                     => 35
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

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        $accessToken = $this->getAccessToken();

        $cityResponse = Http::withToken($accessToken)->get('https://test.api.amadeus.com/v1/reference-data/locations', [
            'subType' => 'CITY,AIRPORT',
            'keyword' => $query,
            'page[limit]' => 5,
        ]);

        if (!$cityResponse->ok()) {
            return response()->json([]);
        }

        $results = collect($cityResponse->json()['data'])->map(function ($item) {
            return [
                'city'    => $item['address']['cityName'] ?? 'Unknown City',
                'country' => $item['address']['countryName'] ?? 'Unknown Country',
                'airport' => $item['name'] ?? 'Unknown Airport',
                'value'   => $item['iataCode'] ?? '',
            ];
        });

        return response()->json($results);
    }


   
}


