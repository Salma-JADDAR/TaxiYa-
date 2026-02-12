<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Taxi;
use App\Models\Trajet;
use App\Models\Place;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============ 1. ADMIN ============
        User::firstOrCreate(
            ['email' => 'admin@taxiya.ma'],
            [
                'name' => 'Admin TaxiYa',
                'password' => Hash::make('admin123'),
                'type' => 'admin',
                'phone' => '0600000000',
                'validated' => true,
            ]
        );

        // ============ 2. CHAUFFEURS ============
        $drivers = [
            ['name' => 'Ahmed Driver', 'email' => 'ahmed@taxiya.ma', 'phone' => '0612345678'],
            ['name' => 'Karim Chauffeur', 'email' => 'karim@taxiya.ma', 'phone' => '0623456789'],
            ['name' => 'Sara Conductrice', 'email' => 'sara@taxiya.ma', 'phone' => '0634567890'],
            ['name' => 'Mohamed Taxi', 'email' => 'mohamed@taxiya.ma', 'phone' => '0645678901'],
            ['name' => 'Fatima Chauffeur', 'email' => 'fatima@taxiya.ma', 'phone' => '0656789012'],
        ];

        foreach ($drivers as $driverData) {
            User::firstOrCreate(
                ['email' => $driverData['email']],
                [
                    'name' => $driverData['name'],
                    'password' => Hash::make('password123'),
                    'type' => 'chauffeur',
                    'phone' => $driverData['phone'],
                    'validated' => true,
                ]
            );
        }

        // ============ 3. TAXIS (VERSION SIMPLIFIÉE) ============
        $chauffeurs = User::where('type', 'chauffeur')->get();
        $marques = ['Mercedes', 'Renault', 'Toyota', 'Dacia', 'Peugeot', 'Volkswagen'];
        $modeles = ['Grand Taxi', 'Classe E', 'Dokker', 'Berlingo', 'Expert', 'Caravelle'];
        
        foreach ($chauffeurs as $chauffeur) {
            // Supprimer les anciens taxis pour éviter les doublons
            Taxi::where('chauffeur_id', $chauffeur->id)->delete();
            
            // Créer un nouveau taxi SANS couleur ni annee
            Taxi::create([
                'chauffeur_id' => $chauffeur->id,
                'matricule' => strtoupper(substr($chauffeur->name, 0, 2)) . '-' . rand(10000, 99999),
                'marque' => $marques[array_rand($marques)],
                'modele' => $modeles[array_rand($modeles)],
                'capacite' => 6,
                'etat' => 'disponible',
            ]);
        }

        // ============ 4. TRAJETS ============
        $routes = [
            ['depart' => 'Safi', 'arrivee' => 'Marrakech', 'prix' => 70],
            ['depart' => 'Marrakech', 'arrivee' => 'Safi', 'prix' => 70],
            ['depart' => 'Rabat', 'arrivee' => 'Casablanca', 'prix' => 50],
            ['depart' => 'Casablanca', 'arrivee' => 'Rabat', 'prix' => 50],
            ['depart' => 'Tanger', 'arrivee' => 'Tétouan', 'prix' => 35],
            ['depart' => 'Tétouan', 'arrivee' => 'Tanger', 'prix' => 35],
            ['depart' => 'Agadir', 'arrivee' => 'Marrakech', 'prix' => 180],
            ['depart' => 'Fès', 'arrivee' => 'Meknès', 'prix' => 40],
            ['depart' => 'Casablanca', 'arrivee' => 'El Jadida', 'prix' => 80],
            ['depart' => 'Marrakech', 'arrivee' => 'Essaouira', 'prix' => 90],
        ];

        $chauffeurUsers = User::where('type', 'chauffeur')->where('validated', true)->get();
        $horaires = ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00'];

        foreach ($chauffeurUsers as $chauffeur) {
            $taxi = Taxi::where('chauffeur_id', $chauffeur->id)->first();
            if (!$taxi) continue;
            
            // Chaque chauffeur fait 3-4 trajets
            for ($i = 0; $i < 4; $i++) {
                $route = $routes[array_rand($routes)];
                $date = now()->addDays(rand(1, 7));
                $heure = $horaires[array_rand($horaires)];
                
                Trajet::create([
                    'chauffeur_id' => $chauffeur->id,
                    'taxi_id' => $taxi->id,
                    'depart' => $route['depart'],
                    'arrivee' => $route['arrivee'],
                    'date' => $date->toDateString(),
                    'heure' => $heure,
                    'prix' => $route['prix'],
                    'statut' => 'planifié',
                    'places_disponibles' => 6,
                    'places_total' => 6,
                ]);
            }
        }

        // ============ 5. VOYAGEUR ============
        User::firstOrCreate(
            ['email' => 'voyageur@taxiya.ma'],
            [
                'name' => 'Youssef Voyageur',
                'password' => Hash::make('password123'),
                'type' => 'voyageur',
                'phone' => '0611111111',
                'validated' => true,
            ]
        );

        // ============ 6. PLACES pour chaque trajet ============
        $trajets = Trajet::all();
        foreach ($trajets as $trajet) {
            for ($position = 1; $position <= 6; $position++) {
                Place::firstOrCreate(
                    [
                        'trajet_id' => $trajet->id,
                        'position' => $position,
                    ],
                    [
                        'type' => ($position <= 2) ? 'premium' : 'standard',
                        'statut' => 'disponible',
                    ]
                );
            }
        }

        $this->command->info('✅ Seeding terminé avec succès!');
        $this->command->info('👥 Chauffeurs: ' . User::where('type', 'chauffeur')->count());
        $this->command->info('🚖 Taxis: ' . Taxi::count());
        $this->command->info('🛣️ Trajets: ' . Trajet::count());
        $this->command->info('💺 Places: ' . Place::count());
    }
}