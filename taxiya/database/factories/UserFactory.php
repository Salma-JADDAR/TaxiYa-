<?php
// database/factories/UserFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'password' => Hash::make('password'),
            'type' => $this->faker->randomElement(['voyageur', 'chauffeur']),
            'validated' => $this->faker->boolean(80),
            'remember_token' => Str::random(10),
        ];
    }

    public function voyageur()
    {
        return $this->state([
            'type' => 'voyageur',
            'validated' => false,
        ]);
    }

    public function chauffeur()
    {
        return $this->state([
            'type' => 'chauffeur',
            'validated' => $this->faker->boolean(70),
        ]);
    }
}