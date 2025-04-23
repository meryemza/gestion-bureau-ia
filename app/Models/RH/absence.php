<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'motif'];

    public function employe()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}