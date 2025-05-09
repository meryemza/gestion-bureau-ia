<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Employe;

class UserObserver
{
    public function created(User $user)
{
    if ($user->role === 'employe') {
        // Vérifie s'il existe déjà un employé avec cet email
        if (!Employe::where('email', $user->email)->exists()) {
            Employe::create([
                'user_id'     => $user->id,
                'email'       => $user->email,
                'name'        => $user->name,
                'salary'      => 0,
                'status'      => 'inactive',
                'gender'      => 'Unknown',
                'age'         => 0,
                'position'    => 'Unknown',
                'is_verified' => false,
            ]);
        }
    }
}

}