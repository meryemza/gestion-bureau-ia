<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'titre',
        'montant',
        'statut',
        'date_echeance',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
