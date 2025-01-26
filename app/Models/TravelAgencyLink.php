<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PHPUnit\Event\Tracer\Tracer;

class TravelAgencyLink extends Model
{
    protected $table = 'travel_agency_link'; 
    protected $fillable = ['destination_id', 'travel_agency_id', 'price']; 

    public function destination() : HasOne
    {
        return $this->hasOne(Destination::class);
    }
    public function travelAgency()
    {
        return $this->belongsTo(TravelAgency::class, 'travel_agency_id', 'id');
    }
}
