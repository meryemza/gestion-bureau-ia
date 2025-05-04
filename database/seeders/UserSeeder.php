<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'john.doe@example.com'],
            [
                'name'     => 'John Doe',
                'password' => Hash::make('password'),
                'role'     => 'rh',
            ]
        );

        User::firstOrCreate(
            ['email' => 'jane.smith@example.com'],
            [
                'name'     => 'Jane Smith',
                'password' => Hash::make('password'),
                'role'     => 'rh',
            ]
        );
    }
}

