<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
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
            return Carbon::now()->subMonths($i)->format('M Y');
        })->reverse()->values();

        $genderM = [];
        $genderF = [];
        $salaryPerMonth = [];
        $hiredPerMonth = [];
        $leftPerMonth = [];

        foreach ($months as $month) {
            $start = Carbon::createFromFormat('M Y', $month)->startOfMonth();
            $end = Carbon::createFromFormat('M Y', $month)->endOfMonth();

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

        return view('dashboard.rh', compact(
            'totalSalary',
            'averageSalary',
            'avgAge',
            'permanentRate',
            'turnoverRate',
            'headcountData',
            'months',
            'genderM',
            'genderF',
            'salaryPerMonth',
            'hiredPerMonth',
            'leftPerMonth'
        ));
    }
}

