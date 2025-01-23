<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelAgencyLink extends Model
{
    protected $table = 'travel_agency_link'; 
    protected $fillable = ['destination_id', 'travel_agency_id', 'price']; 
}
