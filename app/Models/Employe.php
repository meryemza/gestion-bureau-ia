<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employees'; // 👈 Très important ici

    protected $fillable = ['user_id', 'salary'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
