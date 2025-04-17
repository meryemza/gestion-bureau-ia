<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $table = 'depenses'; // Si le nom de la table est différent, tu peux le spécifier ici.

    protected $fillable = [
        'montant',  // Liste des colonnes que tu veux rendre accessibles pour l'assignation de masse.
        'created_at',
        'updated_at',
    ];
}

