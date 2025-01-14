<?php

namespace App\Http\Controllers;

use App\Models\Destination;

use Illuminate\Http\Request;

class WheelController extends Controller
{
    public function show()
    {
        $destinations = Destination::all();

        return view('wheel.show', compact('destinations'));
    }
}
