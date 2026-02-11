<?php
// database/factories/NotificationFactory.php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        $types = ['confirmation', 'rappel', 'annulation', 'changement'];

        return [
            'reservation_id' => Reservation::factory(),
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement($types),
            'message' => $this->faker->sentence(),
            'date_envoi' => $this->faker->dateTime(),
            'envoyee' => $this->faker->boolean(70),
            'lue' => $this->faker->boolean(50),
        ];
    }
}