<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelAgency extends Model
{
    use HasFactory;

    protected $table = 'travel_agency'; // Geef expliciet de tabelnaam op

    protected $fillable = [
        'name',
        'phone',
        'email',
        'created_at',
        'updated_at',
    ];
}
