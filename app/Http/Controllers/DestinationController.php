<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::query();

        if ($request->has('priceCategory') && $request->priceCategory != '') {
            $query->where('price_category', $request->priceCategory);
        }
        if ($request->has('continent') && $request->continent != '') {
            $query->where('continent', $request->continent);
        }
        if ($request->has('climate') && $request->climate != '') {
            $query->where('climate', $request->climate);
        }

        $destinations = $query->get();
        $priceCategories = Destination::distinct()->pluck('price_category');
        $continents = Destination::distinct()->pluck('continent');
        $climates = Destination::distinct()->pluck('climate');

        // Pass the destination names to the view for the wheel
        $wheelData = $destinations->pluck('name'); // Assuming 'name' is the destination's name

        return view('welcome', [
            'destinations' => $destinations,
            'continents' => $continents,
            'climates' => $climates,
            'priceCategories' => $priceCategories,
            'wheelData' => $wheelData, // Pass the data for the wheel
        ]);
    }
}
