<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    protected $fillable = ['user_id', 'validated'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
}