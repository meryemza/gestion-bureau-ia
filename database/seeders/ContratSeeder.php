<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contrat;
use App\Models\Employe;
use Carbon\Carbon;

class ContratSeeder extends Seeder
{
    public function run(): void
    {
        $johnEmp = Employe::whereHas('user', fn ($q) => $q->where('email', 'john.doe@example.com'))->first();
        $janeEmp = Employe::whereHas('user', fn ($q) => $q->where('email', 'jane.smith@example.com'))->first();

        if ($johnEmp) {
            Contrat::firstOrCreate([
                'employee_id' => $johnEmp->id,
                'type'        => 'CDI',
                'start_date'  => Carbon::now()->subYear(),
            ]);
        }

        if ($janeEmp) {
            Contrat::firstOrCreate([
                'employee_id' => $janeEmp->id,
                'type'        => 'CDD',
                'start_date'  => Carbon::now()->subMonths(3),
                'end_date'    => Carbon::now()->addMonths(3),
            ]);
        }
    }
}
