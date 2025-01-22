<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('travel_agency_link', function (Blueprint $table) {
            $table->id();
            $table->foreign('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->foreignId('travel_agency_id')->constrained('travel_agency')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_agency_link');
    }
};
