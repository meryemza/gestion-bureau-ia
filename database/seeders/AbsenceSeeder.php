<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absence;
use App\Models\Employe;
use Carbon\Carbon;

class AbsenceSeeder extends Seeder
{
    public function run(): void
    {
        $johnEmp = Employe::whereHas('user', fn ($q) => $q->where('email', 'john.doe@example.com'))->first();
        $janeEmp = Employe::whereHas('user', fn ($q) => $q->where('email', 'jane.smith@example.com'))->first();

        if ($johnEmp) {
            Absence::firstOrCreate([
                'employee_id' => $johnEmp->id,
                'start_date'  => Carbon::now()->subDays(10),
                'end_date'    => Carbon::now()->subDays(7),
                'reason'      => 'Congé annuel',
                'status'      => 'Approuvé',
                'type'        => 'Congé',
            ]);
        }

        if ($janeEmp) {
            Absence::firstOrCreate([
                'employee_id' => $janeEmp->id,
                'start_date'  => Carbon::now()->addDays(5),
                'end_date'    => Carbon::now()->addDays(8),
                'reason'      => 'Congé maternité',
                'status'      => 'En attente',
                'type'        => 'Maternité',
            ]);
        }
    }
}

