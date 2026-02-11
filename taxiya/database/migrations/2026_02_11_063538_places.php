<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_places_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trajet_id')->constrained('trajets')->onDelete('cascade');
            $table->integer('position');
            $table->enum('type', ['standard', 'premium', 'handicap']);
            $table->enum('statut', ['disponible', 'réservée', 'occupée'])->default('disponible');
            $table->timestamps();
            
            $table->unique(['trajet_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};