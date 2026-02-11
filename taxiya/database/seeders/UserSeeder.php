<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@taxi.com',
            'phone' => '0600000000',
            'password' => bcrypt('password'),
            'type' => 'chauffeur',
            'validated' => true,
        ]);

        // Créer des chauffeurs
        User::factory()
            ->chauffeur()
            ->count(10)
            ->create();

        // Créer des voyageurs
        User::factory()
            ->voyageur()
            ->count(50)
            ->create();
    }
}