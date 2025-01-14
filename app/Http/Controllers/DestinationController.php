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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'continent' => 'required|string',
            'climate' => 'required|string',
            'price_category' => 'required|string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        // Creëer een nieuwe bestemming, met timestamps
        $destination = Destination::create([
            'name' => $request->name,
            'price' => $request->price,
            'continent' => $request->continent,
            'climate' => $request->climate,
            'price_category' => $request->price_category,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Bestemming toegevoegd!');
    }
}
