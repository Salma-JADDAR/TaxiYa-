<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    protected $fillable = [
        'depart',
        'arrivee',
        'date',
        'heure',
        'prix',
        'statut',
        'chauffeur_id'
    ];

    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
