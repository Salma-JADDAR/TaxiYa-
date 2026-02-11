<?php
// database/seeders/ReservationSeeder.php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use App\Models\Place;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // Créer 50 réservations
        Reservation::factory()
            ->count(50)
            ->create()
            ->each(function ($reservation) {
                // Mettre à jour le statut de la place
                $reservation->place->update(['statut' => 'réservée']);
                
                // Décrémenter les places disponibles du trajet
                $reservation->trajet->decrement('places_disponibles');
            });
    }
}