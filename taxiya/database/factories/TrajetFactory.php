<?php
// database/factories/TrajetFactory.php

namespace Database\Factories;

use App\Models\User;
use App\Models\Taxi;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrajetFactory extends Factory
{
    public function definition(): array
    {
        $villes = ['Paris', 'Lyon', 'Marseille', 'Toulouse', 'Bordeaux', 'Lille', 'Nantes'];
        $statuts = ['planifié', 'en_cours', 'terminé', 'annulé'];
        $places = $this->faker->numberBetween(4, 8);

        return [
            'chauffeur_id' => User::factory()->chauffeur(),
            'taxi_id' => Taxi::factory(),
            'depart' => $this->faker->randomElement($villes),
            'arrivee' => $this->faker->randomElement(array_diff($villes, ['depart'])),
            'date' => $this->faker->dateTimeBetween('+1 days', '+30 days'),
            'heure' => $this->faker->time(),
            'prix' => $this->faker->randomFloat(2, 10, 200),
            'statut' => $this->faker->randomElement($statuts),
            'places_disponibles' => $places,
            'places_total' => $places,
        ];
    }
}