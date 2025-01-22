<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TravelAgency;

class TravelAgencySeeder extends Seeder
{
    public function run()
    {
        TravelAgency::create([
            'name' => 'Sunshine Travel',
            'phone' => '0612345678',
            'email' => 'info@sunshinetravel.com',
        ]);

        TravelAgency::create([
            'name' => 'Adventure Tours',
            'phone' => '0623456789',
            'email' => 'contact@adventuretours.com',
        ]);
    }
}

