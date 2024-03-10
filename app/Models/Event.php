<?php

namespace App\Models;

use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = [
        'titre',
        'description',
        'lieux',
        'place',
        'status',
       'categorie_id',
       'date',
       'auto',
       'created_by_user_id',
    ];


    // Définir des constantes pour les statuts
    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;


    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'reservations')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
