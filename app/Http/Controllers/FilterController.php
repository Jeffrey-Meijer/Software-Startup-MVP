<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        // Haal alle bestemmingen op
        $destinations = Destination::all();

        // Optioneel: Haal unike continenten en klimaten op uit de bestemmingen
        $continents = Destination::distinct()->pluck('continent');
        $climates = Destination::distinct()->pluck('climate');

        // Stuur data door naar de view
        return view('welcome', [
            'destinations' => $destinations,
            'continents' => $continents,
            'climates' => $climates
        ]);
        
    }
}
