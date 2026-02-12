<?php
// database/migrations/xxxx_xx_xx_xxxxxx_fix_taxis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('taxis', function (Blueprint $table) {
            // Ajouter les colonnes manquantes
            if (!Schema::hasColumn('taxis', 'couleur')) {
                $table->string('couleur')->nullable()->after('modele');
            }
            
            if (!Schema::hasColumn('taxis', 'annee')) {
                $table->integer('annee')->nullable()->after('couleur');
            }
            
            if (!Schema::hasColumn('taxis', 'carte_grise')) {
                $table->string('carte_grise')->nullable()->after('annee');
            }
        });
    }

    public function down(): void
    {
        Schema::table('taxis', function (Blueprint $table) {
            $table->dropColumn(['couleur', 'annee', 'carte_grise']);
        });
    }
};