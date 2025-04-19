<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'nom',
        'statut',
        'description',
        'date_debut',
        'date_fin',
    ];

    /**
     * Relation Many-to-Many avec les employés (users).
     * Un projet peut avoir plusieurs employés.
     */
    public function employes()
    {
        return $this->belongsToMany(User::class, 'projet_user');
    }
}

