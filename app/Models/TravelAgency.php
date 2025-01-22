<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelAgency extends Model
{
    use HasFactory;

    protected $table = 'travel_agency'; // De tabelnaam
    protected $fillable = ['name', 'email', 'phone']; // Vulbare velden

    // Relatie: een reisbureau kan meerdere bestemmingen hebben
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
