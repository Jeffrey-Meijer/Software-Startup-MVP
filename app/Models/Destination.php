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
        'price',  // Toegevoegd voor de prijs
    ];

    // De primaire sleutel
    protected $primaryKey = 'destination_id';

    // Laravel beheert automatisch 'created_at' en 'updated_at'
    public $timestamps = true;
}
