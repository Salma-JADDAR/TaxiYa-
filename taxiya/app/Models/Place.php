<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'position',
        'type',
        'statut',
        'trajet_id'
    ];

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }
}
