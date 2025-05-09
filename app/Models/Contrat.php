<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'employe',
        'type',
        'date_debut',
        'date_fin',
        'statut',
        'salaire',
    ];

    public function employe()
    {
        return $this->belongsTo(\App\Models\Employe::class, 'employe_id');
    }
}
