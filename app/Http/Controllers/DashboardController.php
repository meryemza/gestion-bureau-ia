<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Absence;
use App\Models\Salaire;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\Recrutement;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSalary = Employe::sum('salary');
        $averageSalary = Employe::average('salary');
        $avgAge = Employe::average('age');
        $totalEmployees = Employe::count();
        $leftEmployees = Employe::where('status', 'left')->count();
        $turnoverRate = $totalEmployees > 0 ? round(($leftEmployees / $totalEmployees) * 100, 2) . '%' : '0%';

        $permanentRate = '80%';

        $headcountData = [
            Employe::where('gender', 'Homme')->count(),
            Employe::where('gender', 'Femme')->count(),
        ];

        $months = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('M');
        })->reverse()->values();

        $absencesByMonth = collect(range(0, 5))->map(function ($i) {
            $date = Carbon::now()->subMonths(5 - $i);
            return Absence::whereMonth('start_date', $date->month)
                ->whereYear('start_date', $date->year)
                ->count();
        });

        $salaireByMonth = collect(range(0, 5))->map(function ($i) {
            $date = Carbon::now()->subMonths(5 - $i);
            return Salaire::whereMonth('date_paiement', $date->month)
                ->whereYear('date_paiement', $date->year)
                ->sum('salaire_net');
        });

        $totalConges = 50;
        $congesUtilises = Conge::where('statut', 'accepte')
            ->whereYear('date_debut', now()->year)
            ->count();
        $congesRestants = max($totalConges - $congesUtilises, 0);

        $typesContrats = [
            'CDI' => Contrat::where('type', 'cdi')->count(),
            'CDD' => Contrat::where('type', 'cdd')->count(),
            'Stage' => Contrat::where('type', 'stage')->count(),
        ];

        $genderM = [];
        $genderF = [];
        $salaryPerMonth = [];
        $hiredPerMonth = [];
        $leftPerMonth = [];

        foreach ($months as $month) {
            $start = Carbon::createFromFormat('M', $month)->startOfMonth();
            $end = Carbon::createFromFormat('M', $month)->endOfMonth();

            $genderM[] = Employe::where('gender', 'Homme')
                ->whereBetween('created_at', [$start, $end])
                ->count();

            $genderF[] = Employe::where('gender', 'Femme')
                ->whereBetween('created_at', [$start, $end])
                ->count();

            $salaryPerMonth[] = Employe::whereBetween('created_at', [$start, $end])
                ->sum('salary');

            $hiredPerMonth[] = Employe::whereBetween('created_at', [$start, $end])->count();

            $leftPerMonth[] = Employe::where('status', 'left')
                ->whereBetween('updated_at', [$start, $end]) // ou created_at si nécessaire
                ->count();
        }

        // Recrutements par mois
        $recrutementLabels = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('M');
        })->reverse()->values();

        $recrutementData = $recrutementLabels->map(function ($month, $i) {
            $date = Carbon::now()->subMonths(5 - $i);
            return Recrutement::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        });

        // Congés acceptés par mois (depuis l'admin)
        $congesByMonth = collect(range(0, 5))->map(function ($i) {
            $date = Carbon::now()->subMonths(5 - $i);
            return Conge::where('statut', 'accepte')
                ->whereYear('date_debut', $date->year)
                ->whereMonth('date_debut', $date->month)
                ->count();
        });

        // 6 derniers mois
        $recrutementsByMonth = collect(range(0, 5))->map(function ($i) {
            $date = Carbon::now()->subMonths(5 - $i);
            return Recrutement::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        });

        return view('dashboard.rh', compact(
            'totalSalary',
            'averageSalary',
            'avgAge',
            'permanentRate',
            'turnoverRate',
            'headcountData',
            'months',
            'absencesByMonth',
            'salaireByMonth',
            'congesRestants',
            'congesUtilises',
            'typesContrats',
            'genderM',
            'genderF',
            'salaryPerMonth',
            'hiredPerMonth',
            'leftPerMonth',
            'recrutementLabels',
            'recrutementData',
            'congesByMonth',
            'recrutementsByMonth'
        ));
    }
}

