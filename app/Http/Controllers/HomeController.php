<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function home(){

        $json = Storage::disk('local')->get('hotels.json');
        $cities = json_decode($json, true);
        //  $cities = [  // example array
        // ['name' => 'Paris', 'country' => 'France', 'image' => 'paris.jpg'],
        // ['name' => 'Tokyo', 'country' => 'Japan', 'image' => 'tokyo.jpg'],
    // ];

        return view('home', ['data'=> $cities]);
    }
}
