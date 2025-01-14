<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id('destination_id');
            $table->string('name');
            $table->enum('continent', ['Europa', 'Azië', 'Afrika', 'Noord-Amerika', 'Zuid-Amerika', 'Oceanië']);
            $table->enum('climate', ['Tropisch', 'Gematigd', 'Koud']);
            $table->enum('price_category', ['Budget', 'Gemiddeld', 'Luxueus']);
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};
