<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'adresse',
        'telephone',
        // Ajoute d'autres champs si besoin
    ];

    // Exemple de relation : un employeur a plusieurs contrats
    public function contrats()
    {
        return $this->hasMany(\App\Models\Contrat::class, 'employeur_id');
    }
}
