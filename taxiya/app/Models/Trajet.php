<?php
// app/Models/Trajet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'chauffeur_id',
        'taxi_id',
        'depart',
        'arrivee',
        'date',
        'heure',
        'prix',
        'statut',
        'places_disponibles',
        'places_total'
    ];

    protected $casts = [
        'date' => 'date',
        'prix' => 'decimal:2',
        'places_disponibles' => 'integer',
        'places_total' => 'integer',
    ];

    // Relation avec le chauffeur
    public function chauffeur()
    {
        return $this->belongsTo(User::class, 'chauffeur_id');
    }

    // Relation avec le taxi
    public function taxi()
    {
        return $this->belongsTo(Taxi::class);
    }

    // Relation avec les places
    public function places()
    {
        return $this->hasMany(Place::class);
    }

    // Relation avec les réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Méthodes
    public function getAvailablePlaces()
    {
        return $this->places()->where('statut', 'disponible')->get();
    }

    public function updateStatus()
    {
        if ($this->places_disponibles == 0) {
            $this->statut = 'complet';
        }
        return $this->save();
    }

    public function addPlace($data)
    {
        return $this->places()->create($data);
    }

    public function isAvailable()
    {
        return $this->statut === 'planifié' && $this->places_disponibles > 0;
    }
}