<?php
// database/factories/TaxiFactory.php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxiFactory extends Factory
{
    public function definition(): array
    {
        $marques = ['Toyota', 'Mercedes', 'BMW', 'Audi', 'Peugeot', 'Renault'];
        $modeles = ['Model X', 'Class C', 'Serie 3', 'A4', '308', 'Clio'];
        $etats = ['disponible', 'en_service', 'en_maintenance', 'hors_service'];

        return [
            'chauffeur_id' => User::factory()->chauffeur(),
            'matricule' => strtoupper($this->faker->bothify('??###??')),
            'marque' => $this->faker->randomElement($marques),
            'modele' => $this->faker->randomElement($modeles),
            'capacite' => $this->faker->numberBetween(4, 8),
            'etat' => $this->faker->randomElement($etats),
        ];
    }
}