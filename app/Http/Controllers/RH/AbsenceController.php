<?php
namespace App\Http\Controllers\RH;

use App\Models\Absence;
use App\Models\Employe;
use App\Models\Departement;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with('employee')->get();
            
        $employees = Employe::all();
        $presentCount = $absences->where('status', 'Présent')->count();
        $absentCount = $absences->where('status', 'Absent')->count();
    
        // Statistiques journalières
        $dailyStats = Absence::selectRaw('date, COUNT(*) as absents')
            ->groupBy('date')
            ->get()
            ->map(function ($item) {
                $totalEmployees = Employe::count();
                $presents = $totalEmployees - $item->absents;
                return (object)[
                    'date' => $item->date,
                    'absents' => $item->absents,
                    'presents' => $presents
                ];
            });
    
        // Statistiques mensuelles pour le graphique
        $absencesPerMonth = Absence::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        $monthsLabels = [
            1 => 'Jan', 2 => 'Fév', 3 => 'Mars', 4 => 'Avr', 5 => 'Mai', 6 => 'Juin',
            7 => 'Juil', 8 => 'Août', 9 => 'Sept', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
        ];
    
        $months = [];
        $absencesData = [];
    
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $monthsLabels[$i];
            $monthData = $absencesPerMonth->firstWhere('month', $i);
            $absencesData[] = $monthData ? $monthData->count : 0;
        }
    
        return view('rh.absences.index', compact(
            'absences',
            'employees',
            'presentCount',
            'absentCount',
            'dailyStats',
            'months',
            'absencesData'
        ));
    }
    



    public function create()
    {
        // Récupérer tous les employés pour le formulaire
        $employees = Employe::all();
        // Retourner la vue avec les employés
        return view('rh.absences.create', compact('employees'));
    

    }



    public function store(Request $request)
{
    $presences = $request->input('presences');  // Statuts : Présent ou Absent
    $reasons = $request->input('reasons');      // Justifications (si absent)
    $startDate = $request->input('start_date'); // Date de début commune
    $endDate = $request->input('end_date');     // Date de fin commune
    foreach ($presences as $employeeId => $status) {
        // On crée une absence pour chaque employé
        absence::create([
            'employee_id' => $employeeId,
            'status' => $status,
            'reason' => $status === 'Absent' ? ($reasons[$employeeId] ?? null) : null,
            'type' => 'normal', // ➔ tu choisis une valeur par défaut ici, par exemple 'normal'
            'start_date' => now(),   // ou une date depuis le formulaire
            'end_date' => now(),     // ou null ou une autre valeu
            'start_date' => $startDate ?? Carbon::today(),  // Si vide, mettre aujourd’hui
                'end_date' => $endDate ?? Carbon::today(),
        ]);
    }
     
    return redirect()->route('rh.absences.index')->with('success', 'Les absences ont été enregistrées.');
}



    // Affiche les détails d'une absence
    public function show(Absence $absence)
    {
        // Récupérer l'absence par son ID
        $absence = Absence::findOrFail($id);
        
        // Retourner la vue avec les détails de l'absence
        return view('rh.absences.show', compact('absence'));
    }



    // Affiche le formulaire pour modifier une absence
    public function edit($id)
    {
        // Récupérer l'absence par son ID
        $absence = Absence::findOrFail($id);

        // Récupérer tous les employés pour le formulaire
        $employes = Employe::all();
        
        // Retourner la vue avec les données de l'absence et les employés
        return view('rh.absences.edit', compact('absence', 'employes'));
    }




    // Met à jour les informations d'une absence
    public function showAbsences()
{
    // Récupérer les absences
    $totalAbsences = Absence::all();
    $presentCount = $totalAbsences->where('status', 'Présent')->count();
    $absentCount = $totalAbsences->where('status', 'Absent')->count();
    
    // Passer les données à la vue
    return view('rh.absences.index', compact('presentCount', 'absentCount'));
}



}
