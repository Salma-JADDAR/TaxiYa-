<?php
// app/Models/Taxi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxi extends Model
{
    use HasFactory;

    protected $fillable = [
        'chauffeur_id',
        'matricule',
        'marque',
        'modele',
        'capacite',
        'etat'
    ];

    protected $casts = [
        'capacite' => 'integer',
    ];

    // Relation avec le chauffeur
    public function chauffeur()
    {
        return $this->belongsTo(User::class, 'chauffeur_id');
    }

    // Relation avec les trajets
    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }

    // Méthodes
    public function changeEtat($nouvelEtat)
    {
        $this->etat = $nouvelEtat;
        return $this->save();
    }

    public function estDisponible()
    {
        return $this->etat === 'disponible';
    }

    public function getInfo()
    {
        return "{$this->marque} {$this->modele} - {$this->matricule}";
    }
}