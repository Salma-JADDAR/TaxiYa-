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
        // 🇲🇦 GRANDE LISTE DES VILLES MAROCAINES
        $villes = [
            // GRANDES VILLES
            'Casablanca',
            'Rabat',
            'Marrakech',
            'Fès',
            'Tanger',
            'Agadir',
            'Meknès',
            'Oujda',
            'Kénitra',
            'Tétouan',
            'Safi',
            'Mohammedia',
            'El Jadida',
            'Béni Mellal',
            'Nador',
            'Taza',
            'Settat',
            'Larache',
            'Khouribga',
            'Guelmim',
            'Dakhla',
            'Laâyoune',
            'Essaouira',
            
            // VILLES MOYENNES
            'Al Hoceïma',
            'Chefchaouen',
            'Ouarzazate',
            'Errachidia',
            'Tiznit',
            'Sidi Kacem',
            'Taourirt',
            'Sefrou',
            'Youssoufia',
            'Fnideq',
            'Martil',
            'Mdiq',
            'Asilah',
            'Berkane',
            'Figuig',
            'Tinghir',
            'Azilal',
            'Khénifra',
            'Oued Zem',
            'Ben Guerir',
            'Sidi Bennour',
            'Chichaoua',
            'Taroudant',
            'Inezgane',
            
            // VILLES CÔTIÈRES
            'Témara',
            'Salé',
            'Bouznika',
            'Skhirat',
            'El Haouzia',
            'Jorf Lasfar',
            'Tan-Tan',
            'Sidi Ifni',
            'Mirleft',
            'Taghazout',
            
            // VILLES IMPÉRIALES
            'Fès',
            'Marrakech',
            'Meknès',
            'Rabat',
            
            // VILLES DU NORD
            'Tanger',
            'Tétouan',
            'Al Hoceïma',
            'Nador',
            'Larache',
            'Ksar El Kebir',
            'Ouazzane',
            
            // VILLES DU SUD
            'Guelmim',
            'Tan-Tan',
            'Tarfaya',
            'Boujdour',
            'Dakhla',
            'Laâyoune',
            'Smara',
            
            // VILLES DE L'ATLAS
            'Ifrane',
            'Azrou',
            'Midelt',
            'Boulemane',
            'Imilchil',
            'Ait Melloul',
            'Ait Ourir',
            
            // VILLES UNIVERSITAIRES
            'Ben Guerir',
            'Al Hoceïma',
            'Kénitra',
            'Oujda',
            'Settat',
        ];

        // Enlever les doublons et réindexer
        $villes = array_values(array_unique($villes));
        
        $statuts = ['planifié', 'en_attente', 'complet', 'en_cours', 'terminé', 'annulé'];
        
        // Capacité fixe de 6 places pour Grand Taxi
        $places_total = 6;
        $places_disponibles = $this->faker->numberBetween(0, 6);

        return [
            'chauffeur_id' => User::factory()->chauffeur()->create(['validated' => true])->id,
            'taxi_id' => Taxi::factory(),
            'depart' => $this->faker->randomElement($villes),
            'arrivee' => $this->faker->randomElement($villes),
            'date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'heure' => $this->faker->randomElement(['08:00', '09:00', '10:00', '11:00', '12:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00']),
            'prix' => $this->faker->randomFloat(2, 50, 300),
            'statut' => $this->faker->randomElement($statuts),
            'places_disponibles' => $places_disponibles,
            'places_total' => $places_total,
        ];
    }

    /**
     * Trajets populaires entre grandes villes
     */
    public function populaire(): static
    {
        return $this->state(fn (array $attributes) => [
            'depart' => $this->faker->randomElement(['Casablanca', 'Rabat', 'Marrakech', 'Tanger']),
            'arrivee' => $this->faker->randomElement(['Casablanca', 'Rabat', 'Marrakech', 'Tanger']),
            'prix' => $this->faker->randomFloat(2, 80, 250),
        ]);
    }

    /**
     * Trajets courtes distances
     */
    public function courteDistance(): static
    {
        $courtesDistances = [
            ['Casablanca', 'Rabat'],
            ['Rabat', 'Casablanca'],
            ['Tanger', 'Tétouan'],
            ['Tétouan', 'Tanger'],
            ['Marrakech', 'Essaouira'],
            ['Fès', 'Meknès'],
            ['Meknès', 'Fès'],
            ['Agadir', 'Inezgane'],
            ['Laâyoune', 'Dakhla'],
        ];

        $trajet = $this->faker->randomElement($courtesDistances);

        return $this->state(fn (array $attributes) => [
            'depart' => $trajet[0],
            'arrivee' => $trajet[1],
            'prix' => $this->faker->randomFloat(2, 50, 120),
        ]);
    }

    /**
     * Trajets longue distance
     */
    public function longueDistance(): static
    {
        $longuesDistances = [
            ['Casablanca', 'Laâyoune'],
            ['Tanger', 'Dakhla'],
            ['Marrakech', 'Oujda'],
            ['Agadir', 'Nador'],
            ['Fès', 'Guelmim'],
        ];

        $trajet = $this->faker->randomElement($longuesDistances);

        return $this->state(fn (array $attributes) => [
            'depart' => $trajet[0],
            'arrivee' => $trajet[1],
            'prix' => $this->faker->randomFloat(2, 200, 500),
            'places_disponibles' => 6, // Plus de places disponibles pour longs trajets
        ]);
    }

    /**
     * Trajets avec chauffeur validé
     */
    public function avecChauffeurValide(): static
    {
        return $this->state(fn (array $attributes) => [
            'chauffeur_id' => User::factory()->chauffeur()->create(['validated' => true])->id,
        ]);
    }

    /**
     * Trajet complet (plus de places)
     */
    public function complet(): static
    {
        return $this->state(fn (array $attributes) => [
            'places_disponibles' => 0,
            'statut' => 'complet',
        ]);
    }

    /**
     * Trajet du jour
     */
    public function aujourdHui(): static
    {
        return $this->state(fn (array $attributes) => [
            'date' => now(),
        ]);
    }
}