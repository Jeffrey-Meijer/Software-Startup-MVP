<?php

namespace App\Http\Controllers;

use App\Models\TravelAgency;
use App\Models\TravelAgencyLink;
use Illuminate\Http\Request;

class TravelAgencyController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:255',
            'destination_id' => 'required|exists:destinations,destination_id',
            'price' => 'required|numeric|min:0',
        ]);

        // Maak het reisbureau aan
        $travelAgency = TravelAgency::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        // Koppel het reisbureau aan de bestemming
        TravelAgencyLink::create([
            'destination_id' => $request->destination_id,
            'travel_agency_id' => $travelAgency->id,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Reisbureau succesvol aangemaakt en gekoppeld aan een bestemming.');
    }
}
