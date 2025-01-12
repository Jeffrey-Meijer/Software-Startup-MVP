<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $continents = ['Europa', 'Azië', 'Noord-Amerika', 'Zuid-Amerika', 'Afrika', 'Oceanië'];
        return view('filters.index', compact('continents'));
    }
    public function filter(Request $request)
    {
        $minPrice = $request->input('minPrice', 0);
        $maxPrice = $request->input('maxPrice', 5000);

        // Log::info("Prijs range: €{$minPrice} - €{$maxPrice}");

        return back()->with('success', "Filters toegepast: €{$minPrice} - €{$maxPrice}");
    }
}
