<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RH\Departement;


class Employe extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'user_id',       // ID de l'utilisateur associé
        'nom',           // Nom direct si besoin
        'salary',        // Salaire
        'department_id', // ID du département (ou service)
    ];

    // Relation : Employé appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Employé appartient à un département (service)
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'department_id');
    }

    // Relation : Employé a plusieurs absences
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
    public function service()
{
    return $this->belongsTo(Service::class);
}
}
