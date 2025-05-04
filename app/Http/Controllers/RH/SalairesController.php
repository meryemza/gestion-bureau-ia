<?php 
// app/Http/Controllers/SalairesController.php

namespace App\Http\Controllers\RH;

use App\Models\Salaire;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;

class SalairesController extends Controller
{
   
    public function index()
    {
        // Récupérer tous les salaires avec relation employé
    $salaires = Salaire::with('employee')->latest()->get();

    // Nombre de salaires versés / non versés
    $paidCount = Salaire::where('status', 'Versé')->count();
    $unpaidCount = Salaire::where('status', 'Non versé')->count();

    // Mois de l'année (format Janvier, Février, etc.)
    $months = collect(range(1, 12))->map(function ($month) {
        return Carbon::create()->month($month)->locale('fr_FR')->isoFormat('MMMM');
    });

    // Total des salaires versés par mois
    $salaireData = [];
    foreach (range(1, 12) as $month) {
        $total = Salaire::whereMonth('created_at', $month)->sum('montant');
        $salaireData[] = $total;
    }

    return view('rh.salaires.index', compact('salaires', 'paidCount', 'unpaidCount', 'months', 'salaireData'));
}
    public function create()
    {
        $employes = User::all();
        return view('salaires.create', compact('employes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employe_id' => 'required',
            'salaire_base' => 'required|numeric',
            'prime' => 'nullable|numeric',
            'deduction' => 'nullable|numeric',
            'date_paiement' => 'required|date',
            'mois' => 'required|string',
        ]);

        $data['salaire_net'] = $data['salaire_base'] + ($data['prime'] ?? 0) - ($data['deduction'] ?? 0);

        Salaire::create($data);

        return redirect()->route('salaires.index')->with('success', 'Salaire enregistré.');
    }

    public function generatePDF($id)
    {
        $salaire = Salaire::with('employe')->findOrFail($id);
        $pdf = PDF::loadView('salaires.pdf', compact('salaire'));
        return $pdf->download('fiche_de_paie_'.$salaire->employe->name.'.pdf');
    }
}

