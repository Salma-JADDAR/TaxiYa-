<?php
// app/Models/Notification.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'user_id',
        'type',
        'message',
        'date_envoi',
        'envoyee',
        'lue'
    ];

    protected $casts = [
        'date_envoi' => 'datetime',
        'envoyee' => 'boolean',
        'lue' => 'boolean',
    ];

    // Relation avec la réservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Méthodes
    public function sendEmail()
    {
        // Logique pour envoyer un email
        // À implémenter avec Laravel Mail
        $this->envoyee = true;
        $this->save();
        
        return true;
    }

    public function scheduleNotification()
    {
        // Logique pour planifier une notification
        return $this->save();
    }

    public function markAsRead()
    {
        $this->lue = true;
        return $this->save();
    }
}