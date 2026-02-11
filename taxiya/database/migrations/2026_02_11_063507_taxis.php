<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_taxis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('taxis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chauffeur_id')->constrained('users');
            $table->string('matricule')->unique();
            $table->string('marque');
            $table->string('modele');
            $table->integer('capacite');
            $table->enum('etat', ['disponible', 'en_service', 'en_maintenance', 'hors_service'])->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taxis');
    }
};