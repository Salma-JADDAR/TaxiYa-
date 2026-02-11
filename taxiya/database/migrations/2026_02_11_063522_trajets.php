<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_trajets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chauffeur_id')->constrained('users');
            $table->foreignId('taxi_id')->constrained('taxis');
            $table->string('depart');
            $table->string('arrivee');
            $table->date('date');
            $table->time('heure');
            $table->decimal('prix', 8, 2);
            $table->enum('statut', ['planifié', 'en_cours', 'terminé', 'annulé'])->default('planifié');
            $table->integer('places_disponibles');
            $table->integer('places_total');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};