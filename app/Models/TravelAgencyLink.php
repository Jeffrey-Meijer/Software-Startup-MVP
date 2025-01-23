<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelAgencyLink extends Model
{
    use HasFactory;
    protected $table = 'travel_agency_link';
    public $timestamps = false;

    protected $fillable = [
        'destination_id',
        'travel_agency_id',
        'price',
    ];
}
