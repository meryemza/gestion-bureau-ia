<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Absence;
use App\Models\Contrat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
public function run()
{
    $this->call([
        UserSeeder::class,
        EmployeeSeeder::class,
        AbsenceSeeder::class,
        ContratSeeder::class,
        ServiceEmployeeSeeder::class,
    ]);
}
}
