<?php
// database/factories/ReservationFactory.php

namespace Database\Factories;

use App\Models\User;
use App\Models\Trajet;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        $statuts = ['confirmée', 'en_attente', 'annulée', 'terminée'];

        return [
            'voyageur_id' => User::factory()->voyageur(),
            'trajet_id' => Trajet::factory(),
            'place_id' => Place::factory(),
            'date_reservation' => $this->faker->dateTime(),
            'statut' => $this->faker->randomElement($statuts),
            'prix_paye' => $this->faker->randomFloat(2, 10, 200),
        ];
    }
}