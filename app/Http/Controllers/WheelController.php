<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WheelController extends Controller
{
    public function show()
    {
        // This is just a dummy data to show how the wheel works. This should be replaced with actual data from a model
        $data = [
            'Option 1',
            'Option 2',
            'Option 3',
            'Option 4',
            'Option 5',
            'Option 6',
            'Option 7',
            'Option 8',
            'Option 9',
            'Option 10',
            'Option 11',
            'Option 12',
            'Option 13',
            'Option 14',
            'Option 15',
            'Option 16',
        ];

        return view('draairad', ['dataPoints' => $data]);
    }
}
