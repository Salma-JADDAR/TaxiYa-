<?php
// app/Models/Place.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'trajet_id',
        'position',
        'type',
        'statut'
    ];

    protected $casts = [
        'position' => 'integer',
    ];

    // Relation avec le trajet
    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    // Relation avec la réservation
    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }

    // Méthodes
    public function reserve()
    {
        if ($this->isAvailable()) {
            $this->statut = 'réservée';
            return $this->save();
        }
        return false;
    }

    public function release()
    {
        $this->statut = 'disponible';
        return $this->save();
    }

    public function isAvailable()
    {
        return $this->statut === 'disponible';
    }

    public function occuper()
    {
        $this->statut = 'occupée';
        return $this->save();
    }
}