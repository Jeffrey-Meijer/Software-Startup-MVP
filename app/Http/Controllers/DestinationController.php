<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::query();

        if ($request->has('minPrice') && $request->has('maxPrice')) {
            $query->whereBetween('price', [$request->minPrice, $request->maxPrice]);
        }
        if ($request->has('continent') && $request->continent != '') {
            $query->where('continent', $request->continent);
        }
        if ($request->has('climate') && $request->climate != '') {
            $query->where('climate', $request->climate);
        }

        $destinations = $query->get();
        $continents = Destination::distinct()->pluck('continent');
        $climates = Destination::distinct()->pluck('climate');

        // Pass the destination names to the view for the wheel
        $wheelData = $destinations->pluck('name'); // Assuming 'name' is the destination's name

        return view('welcome', [
            'destinations' => $destinations,
            'continents' => $continents,
            'climates' => $climates,
            'wheelData' => $wheelData, // Pass the data for the wheel
        ]);
    }
}
