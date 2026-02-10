<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'dateReservation',
        'statut',
        'voyageur_id',
        'trajet_id',
        'place_id'
    ];

    public function voyageur()
    {
        return $this->belongsTo(Voyageur::class);
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
}
