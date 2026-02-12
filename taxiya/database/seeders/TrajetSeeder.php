<?php
// database/seeders/TrajetSeeder.php

namespace Database\Seeders;

use App\Models\Trajet;
use App\Models\User;
use Illuminate\Database\Seeder;

class TrajetSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Trajets populaires (30 trajets)
        Trajet::factory()
            ->populaire()
            ->avecChauffeurValide()
            ->count(30)
            ->create();

        // 2. Trajets courtes distances (50 trajets)
        Trajet::factory()
            ->courteDistance()
            ->avecChauffeurValide()
            ->count(50)
            ->create();

        // 3. Trajets longues distances (20 trajets)
        Trajet::factory()
            ->longueDistance()
            ->avecChauffeurValide()
            ->count(20)
            ->create();

        // 4. Trajets aléatoires (100 trajets)
        Trajet::factory()
            ->avecChauffeurValide()
            ->count(100)
            ->create();

        // 5. Trajets du jour (10 trajets)
        Trajet::factory()
            ->aujourdHui()
            ->avecChauffeurValide()
            ->count(10)
            ->create();

        // 6. Trajets complets (15 trajets)
        Trajet::factory()
            ->complet()
            ->avecChauffeurValide()
            ->count(15)
            ->create();

        // 7. Trajets pour chauffeurs non validés (à ne pas afficher)
        Trajet::factory()
            ->count(20)
            ->create([
                'chauffeur_id' => User::factory()->chauffeur()->create(['validated' => false])->id,
            ]);
    }
}