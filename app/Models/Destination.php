<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    // Specificeer de gekoppelde tabel als deze afwijkt van conventies
    protected $table = 'destinations';

    // Vulbare velden (voor mass assignment)
    protected $fillable = [
        'name',
        'continent',
        'climate', 
        'price_category',
        'description',
        'image_url',
    ];

    // Optioneel: als de primaire sleutel geen 'id' is
    protected $primaryKey = 'destination_id';
}
