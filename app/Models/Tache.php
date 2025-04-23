<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    // Déclaration des champs autorisés à l’assignation massive
    protected $fillable = [
        'titre',
        'description',
        'statut',
        'priorite',
         'projet_id',
    ];

    // Relation avec le modèle Projet
    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
