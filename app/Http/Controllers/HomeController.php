<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function home(){

        $json = Storage::disk('local')->get('hotels.json');
        $cities = json_decode($json, true);

        return view('home', ['data'=> $cities]);
    }
}
