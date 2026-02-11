<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_reservations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voyageur_id')->constrained('users');
            $table->foreignId('trajet_id')->constrained('trajets');
            $table->foreignId('place_id')->constrained('places');
            $table->dateTime('date_reservation');
            $table->enum('statut', ['confirmée', 'en_attente', 'annulée', 'terminée'])->default('en_attente');
            $table->decimal('prix_paye', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};