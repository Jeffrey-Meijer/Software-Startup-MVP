<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->id('filter_id');
            $table->enum('filter_type', ['Klimaat', 'Continent', 'Prijs']);
            $table->string('filter_value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('filters');
    }
};
