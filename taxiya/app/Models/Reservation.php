<?php
// app/Models/Reservation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'voyageur_id',
        'trajet_id',
        'place_id',
        'date_reservation',
        'statut',
        'prix_paye'
    ];

    protected $casts = [
        'date_reservation' => 'datetime',
        'prix_paye' => 'decimal:2',
    ];

    // Relation avec le voyageur
    public function voyageur()
    {
        return $this->belongsTo(User::class, 'voyageur_id');
    }

    // Relation avec le trajet
    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    // Relation avec la place
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    // Relation avec les notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Méthodes
    public function confirmReservation()
    {
        $this->statut = 'confirmée';
        $this->place->reserve();
        return $this->save();
    }

    public function cancelReservation()
    {
        $this->statut = 'annulée';
        $this->place->release();
        
        // Incrémenter les places disponibles du trajet
        $this->trajet->increment('places_disponibles');
        
        return $this->save();
    }

    public function getDetails()
    {
        return [
            'reservation' => $this,
            'trajet' => $this->trajet,
            'place' => $this->place,
            'voyageur' => $this->voyageur
        ];
    }
}