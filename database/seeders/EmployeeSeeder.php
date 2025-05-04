<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employe;           // ton modèle Employe
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // S’assure que les utilisateurs existent (au cas où UserSeeder n’a pas été appelé)
        $john = User::firstOrCreate(
            ['email' => 'john.doe@example.com'],
            ['name' => 'John Doe', 'password' => Hash::make('password'), 'role' => 'rh']
        );

        $jane = User::firstOrCreate(
            ['email' => 'jane.smith@example.com'],
            ['name' => 'Jane Smith', 'password' => Hash::make('password'), 'role' => 'rh']
        );

        Employe::firstOrCreate(
            ['user_id' => $john->id],
            [
                'name'     => 'John Doe',          // ← ajoute
                'position' => 'Développeur',       // ← si NOT NULL
                'email'    => 'john.doe@example.com', // ← si NOT NULL
                'salary'   => 25000,
            ]
        );
        
        Employe::firstOrCreate(
            ['user_id' => $jane->id],
            [
                'name'     => 'Jane Smith',
                'position' => 'Responsable RH',
                'email'    => 'jane.smith@example.com',
                'salary'   => 30000,
            ]
        );
        
}
}