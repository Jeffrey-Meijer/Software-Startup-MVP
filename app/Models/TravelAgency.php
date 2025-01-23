<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelAgency extends Model
{
    protected $table = 'travel_agency'; 
    protected $fillable = ['name', 'email', 'phone']; 

    // Relatie: een reisbureau kan meerdere bestemmingen hebben
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
