<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'statut',
        // ajoute ici d'autres colonnes si nécessaire, comme :
        // 'description', 'date_debut', 'date_fin'
    ];
}
