<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = User::where('role', 'employee')->get();

        foreach ($employees as $user) {
            Employee::create([
                'user_id' => $user->id,
                'salary' => rand(4000, 8000), // Ex. : salaires aléatoires
            ]);
        }
    }
}

