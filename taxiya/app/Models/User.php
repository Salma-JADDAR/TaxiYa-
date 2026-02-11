<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type',
        'validated'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'validated' => 'boolean',
    ];

    // Relation avec les taxis (pour les chauffeurs)
    public function taxis()
    {
        return $this->hasMany(Taxi::class, 'chauffeur_id');
    }

    // Relation avec les trajets créés (pour les chauffeurs)
    public function trajetsChauffeur()
    {
        return $this->hasMany(Trajet::class, 'chauffeur_id');
    }

    // Relation avec les réservations (pour les voyageurs)
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'voyageur_id');
    }

    // Relation avec les notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Vérifier si l'utilisateur est un chauffeur
    public function isChauffeur()
    {
        return $this->type === 'chauffeur';
    }

    // Vérifier si l'utilisateur est un voyageur
    public function isVoyageur()
    {
        return $this->type === 'voyageur';
    }

    // Scopes
    public function scopeChauffeurs($query)
    {
        return $query->where('type', 'chauffeur');
    }

    public function scopeVoyageurs($query)
    {
        return $query->where('type', 'voyageur');
    }
}