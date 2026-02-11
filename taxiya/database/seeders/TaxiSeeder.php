<?php
// database/seeders/TaxiSeeder.php

namespace Database\Seeders;

use App\Models\Taxi;
use Illuminate\Database\Seeder;

class TaxiSeeder extends Seeder
{
    public function run(): void
    {
        Taxi::factory()
            ->count(15)
            ->create();
    }
}