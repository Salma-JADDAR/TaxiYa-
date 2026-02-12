<?php
// database/migrations/xxxx_xx_xx_xxxxxx_update_users_type_enum.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL ne permet pas de modifier directement l'enum
        DB::statement("ALTER TABLE users MODIFY COLUMN type ENUM('voyageur', 'chauffeur', 'admin') DEFAULT 'voyageur'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN type ENUM('voyageur', 'chauffeur') DEFAULT 'voyageur'");
    }
};