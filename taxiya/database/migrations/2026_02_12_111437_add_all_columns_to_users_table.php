<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_all_columns_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter les colonnes manquantes si elles n'existent pas
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->unique()->nullable()->after('email');
            }
            
            if (!Schema::hasColumn('users', 'type')) {
                $table->enum('type', ['voyageur', 'chauffeur', 'admin'])->default('voyageur')->after('password');
            } else {
                // Modifier l'enum pour inclure admin
               DB::statement("ALTER TABLE users MODIFY COLUMN type ENUM('voyageur', 'chauffeur', 'admin') DEFAULT 'voyageur'");
            }
            
            if (!Schema::hasColumn('users', 'validated')) {
                $table->boolean('validated')->default(false)->after('type');
            }
            
            if (!Schema::hasColumn('users', 'cin')) {
                $table->string('cin')->nullable()->after('validated');
            }
            
            if (!Schema::hasColumn('users', 'permis_numero')) {
                $table->string('permis_numero')->nullable()->after('cin');
            }
            
            if (!Schema::hasColumn('users', 'carte_grise')) {
                $table->string('carte_grise')->nullable()->after('permis_numero');
            }
            
            if (!Schema::hasColumn('users', 'experience_annees')) {
                $table->integer('experience_annees')->nullable()->default(0)->after('carte_grise');
            }
            
            if (!Schema::hasColumn('users', 'ville')) {
                $table->string('ville')->nullable()->after('experience_annees');
            }
            
            if (!Schema::hasColumn('users', 'adresse')) {
                $table->string('adresse')->nullable()->after('ville');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'cin',
                'permis_numero', 
                'carte_grise',
                'experience_annees',
                'ville',
                'adresse'
            ]);
        });
    }
};