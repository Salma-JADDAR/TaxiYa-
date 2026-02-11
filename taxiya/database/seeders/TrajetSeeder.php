<?php
// database/seeders/TrajetSeeder.php

namespace Database\Seeders;

use App\Models\Trajet;
use Illuminate\Database\Seeder;

class TrajetSeeder extends Seeder
{
    public function run(): void
    {
        Trajet::factory()
            ->count(30)
            ->create();
    }
}