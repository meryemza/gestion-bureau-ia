<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    protected $fillable = [
        'employe_id', 'salaire_base', 'prime', 'deduction', 'salaire_net', 'date_paiement', 'mois'
    ];

    public function employe()
    {
        return $this->belongsTo(\App\Models\Employe::class, 'employe_id');
    }

}