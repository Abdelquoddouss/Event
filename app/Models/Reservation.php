<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

   
        protected $fillable = [
            'status',
            'event_id',
            'user_id',
        ];
        

        const STATUS_PENDING = 0; // En attente
        const STATUS_ACCEPTED = 1; // Acceptée
        const STATUS_REFUSED = 2; // Refusée
    protected $attributes = [
        'status' => self::STATUS_PENDING, // Utilisez la constante pour une meilleure lisibilité
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
