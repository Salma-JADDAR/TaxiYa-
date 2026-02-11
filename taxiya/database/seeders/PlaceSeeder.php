<?php
// database/seeders/PlaceSeeder.php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\Trajet;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        // Pour chaque trajet, créer des places
        Trajet::all()->each(function ($trajet) {
            $nombrePlaces = $trajet->places_total;
            
            for ($i = 1; $i <= $nombrePlaces; $i++) {
                Place::factory()->create([
                    'trajet_id' => $trajet->id,
                    'position' => $i,
                    'statut' => 'disponible',
                ]);
            }
        });
    }
}