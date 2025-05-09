<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CheckPasswordHashing extends Command
{
    protected $signature = 'passwords:check';
    protected $description = 'Vérifie et corrige les mots de passe non hachés avec Bcrypt';

    public function handle()
    {
        $users = User::all();
        $count = 0;

        foreach ($users as $user) {
            if (!$user->isPasswordHashedWithBcrypt()) {
                $this->info("Correction du mot de passe pour l'utilisateur: {$user->email}");
                $user->password = Hash::make($user->password);
                $user->save();
                $count++;
            }
        }

        $this->info("{$count} mots de passe ont été corrigés.");
    }
} 