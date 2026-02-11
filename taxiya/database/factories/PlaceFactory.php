<?php
// database/factories/PlaceFactory.php

namespace Database\Factories;

use App\Models\Trajet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    public function definition(): array
    {
        $types = ['standard', 'premium', 'handicap'];
        $statuts = ['disponible', 'réservée', 'occupée'];

        return [
            'trajet_id' => Trajet::factory(),
            'position' => $this->faker->numberBetween(1, 8),
            'type' => $this->faker->randomElement($types),
            'statut' => $this->faker->randomElement($statuts),
        ];
    }
}